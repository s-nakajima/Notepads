<?php
/**
 * Notepad Model
 *
 * @property Notepad $Notepad
 * @property Language $Language
 * @property Block $Block
 * @property Part $Part
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @package     app.Plugin.Notepads.Model
 */

App::uses('NotepadsAppModel', 'Notepads.Model');

/**
 * Notepad Model
 *
 * @property Notepad $Notepad
 * @property Language $Language
 * @property Block $Block
 * @property Part $Part
 *
 * @author      Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @package     app.Plugin.Notepads.Model
 */
class Notepad extends NotepadsAppModel {

/**
 * Use database config
 *
 * @author  Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @var     string
 */
	public $useDbConfig = 'master';

/**
 * Notepads status publish
 *
 * @var int
 */
	const STATUS_PUBLISH = 1;

/**
 * Notepads status key publish
 *
 * @var string
 */
	const STATUS_KEY_PUBLISH = 'Publish';

/**
 * Notepads status approval
 *
 * @var int
 */
	const STATUS_APPROVAL = 2;

/**
 * Notepads status key approval
 *
 * @var string
 */
	const STATUS_KEY_APPROVAL = 'Approval';

/**
 * Notepads status draft
 *
 * @var int
 */
	const STATUS_DRAFT = 3;

/**
 * Notepads status key draft
 *
 * @var string
 */
	const STATUS_KEY_DRAFT = 'Draft';

/**
 * Notepads status disapproval
 *
 * @var int
 */
	const STATUS_DISAPPROVAL = 4;

/**
 * Notepads status key disapproval
 *
 * @var string
 */
	const STATUS_KEY_DISAPPROVAL = 'Disapproval';

/**
 * Validation rules
 *
 * @author  Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @var     array
 */
	public $validate = array(
		'notepads_block_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Security Error! Unauthorized input.',
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Security Error! Unauthorized input.',
			),
			'range' => array(
				'rule' => array('range', 0, 5),
				'message' => 'Security Error! Unauthorized input.',
			),
		),
		'language_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Security Error! Unauthorized input.',
			),
		),
	);

/**
 * belongsTo associations
 *
 * @author  Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @var     array
 */
	public $belongsTo = array(
		'NotepadsBlock' => array(
			'className' => 'NotepadsBlock',
			'foreignKey' => 'notepads_block_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Language' => array(
			'className' => 'Language',
			'foreignKey' => 'language_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * get content
 *
 * @param int $blockId blocks.id
 * @param int $langId languages.id
 * @param boolean $editable false:publish latest content|true:all latest content
 * @author   Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @return   array Notepad
 */
	public function getContent($blockId, $langId, $editable = 0) {
		$conditions = array(
			'block_id' => $blockId,
			'language_id' => $langId,
		);
		if (! $editable) {
			$conditions['status'] = self::STATUS_PUBLISH;
		}
		return $this->find('first', array(
			'conditions' => $conditions,
			'order' => $this->name . '.id DESC',
		));
	}

/**
 * get status
 *
 * @param string $key status key
 * @author   Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @return   array status
 */
	public function getStatus($key = '') {
		$statusList = array(
			self::STATUS_KEY_PUBLISH => self::STATUS_PUBLISH,
			self::STATUS_KEY_APPROVAL => self::STATUS_APPROVAL,
			self::STATUS_KEY_DRAFT => self::STATUS_DRAFT,
			self::STATUS_KEY_DISAPPROVAL => self::STATUS_DISAPPROVAL,
		);
		if (! $key) {
			return $statusList;
		} else {
			return $statusList[$key];
		}
	}

/**
 * save notepad
 *
 * @param array $data received post data
 * @param int $frameId frames.id
 * @param int $roomId rooms.id
 * @return mixed
 */
	public function saveContent($data, $frameId, $roomId) {
		$models = array(
			'Frames.Frame' => 'Frame',
			'Block' => 'Block',
			'Notepads.NotepadsBlock' => 'NotepadsBlock',
			'Notepads.NotepadSetting' => 'NotepadSetting',
		);
		foreach ($models as $class => $model) {
			$this->$model = ClassRegistry::init($class);
			$this->$model->setDataSource('master');
		}

		$frameId = (int)$frameId;
		$userId = (int)$userId;
		$roomId = (int)$roomId;
		if (! $data || ! $frameId || ! $roomId) {
			return null;
		}
		//frameID chaeck
		if (! isset($data[$this->name]['frameId']) ||
			$frameId !== (int)$data[$this->name]['frameId']) {
			return null;
		}

		//ブロックID取得
		$frame = $this->Frame->findById($frameId);
		if (! $frame) {
			return null;
		}
		$blockId = $frame[$this->Frame->name]['block_id'];

		//DBへの登録
		$dataSource = $this->getDataSource();
		$dataSource->begin();
		try {
			if (! $blockId) {
				//blocksテーブル登録
				$block = array();
				$block[$this->Block->name]['room_id'] = $roomId;
				$block[$this->Block->name]['created_user'] = CakeSession::read('Auth.User.id');
				$block = $this->Block->save($block);

				//framesテーブル更新
				$frame[$this->Frame->name]['block_id'] = $block[$this->Block->name]['id'];
				$frame = $this->Frame->save($frame);

				//notepads_blocksテーブル登録
				$notepadsBlock = array();
				$notepadsBlock[$this->NotepadsBlock->name]['block_id'] = $block[$this->Block->name]['id'];
				$notepadsBlock[$this->NotepadsBlock->name]['created_user'] = CakeSession::read('Auth.User.id');
				$notepadsBlock = $this->NotepadsBlock->save($notepadsBlock);

				//notepad_settingsテーブル登録
				$notepadSetting = array();
				$notepadSetting[$this->NotepadSetting->name]['notepads_block_id'] = $block[$this->Block->name]['id'];
				$notepadSetting[$this->NotepadSetting->name]['created_user'] = CakeSession::read('Auth.User.id');
				$notepadSetting = $this->NotepadSetting->save($notepadSetting);
			}

			//notepadsテーブル登録
			$insertData = array();
			$insertData[$this->name]['notepads_block_id'] = $blockId;
			$insertData[$this->name]['created_user'] = CakeSession::read('Auth.User.id');
			$insertData[$this->name]['language_id'] = $data[$this->name]['language_id'];
			$insertData[$this->name]['status'] = $this->getStatus($data[$this->name]['status']);
			$insertData[$this->name]['title'] = $data[$this->name]['title'];
			$insertData[$this->name]['content'] = $data[$this->name]['content'];

			//保存結果を返す
			$insertData = $this->save($insertData);

			$dataSource->commit();
		} catch (Exception $ex) {
			CakeLog::error($ex->getTraceAsString());
			$dataSource->rollback();
			return false;
		}
		return $insertData;
	}

}
