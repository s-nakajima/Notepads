<?php
/**
 * Notepad Model
 *
 * @property Notepad $Notepad
 * @property Language $Language
 * @property Block $Block
 * @property Part $Part
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 * @package app.Plugin.Notepads.Model
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
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package app.Plugin.Notepads.Model
 */
class Notepad extends NotepadsAppModel {

/**
 * Notepads status publish
 *
 * @var int
 */
	const STATUS_PUBLISHED = '1';

/**
 * Notepads status approval
 *
 * @var int
 */
	const STATUS_APPROVED = '2';

/**
 * Notepads status draft
 *
 * @var int
 */
	const STATUS_DRAFTED = '3';

/**
 * Notepads status disapproval
 *
 * @var int
 */
	const STATUS_DISAPPROVED = '4';

/**
 * Validation rules
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @var array
 */
	public $validate = array(
		'notepad_block_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid request.',
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid request.',
			),
			'range' => array(
				'rule' => array('range', 0, 5),
				'message' => 'Invalid request.',
			),
		),
		'language_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid request.',
			),
		),
	);

/**
 * belongsTo associations
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @var array
 */
	public $belongsTo = array(
		'NotepadsBlock' => array(
			'className' => 'NotepadsBlock',
			'foreignKey' => 'notepad_block_id',
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
 * @param int $languageId languages.id
 * @param boolean $editable false:publish latest content|true:all latest content
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return array Notepad
 */
	public function getContent($blockId, $languageId, $editable = 0) {
		// TODO: Notepad 課題 1
		//		$editable = 0 の場合、公開情報を取得し、それ以外はidが最新のデータを取得する
		//		条件は、blockId、languageId毎に取得する
	}

/**
 * save notepad
 *
 * @param array $data received post data
 * @param int $frameId frames.id
 * @param int $roomId rooms.id
 * @return mixed array Notepad, false error
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

		//ブロックID取得
		$frame = $this->__getFrame($data, $frameId);
		if (! $frame) {
			return false;
		}
		$blockId = $frame[$this->Frame->name]['block_id'];

		//DBへの登録
		$dataSource = $this->getDataSource();
		$dataSource->begin();
		try {
			// TODO: Notepad 課題 2
			//		各テーブルへの登録処理を書く

			if (! $blockId) {
				//blocksテーブル登録

				//framesテーブルのblock_idを更新

				//notepads_blocksテーブル登録

				//notepad_settingsテーブル登録
			}

			//notepadsテーブル登録
			$insertData = array();

			//コミット
			$dataSource->commit();

			//保存結果を返す
			return $insertData;
		} catch (Exception $ex) {
			CakeLog::error($ex->getTraceAsString());
			//ロールバック
			$dataSource->rollback();
			return false;
		}
	}

/**
 * get frame
 *
 * @param aray $data received post data
 * @param int $frameId frames.id
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return mixed array frame, false error
 */
	private function __getFrame($data, $frameId) {
		$frameId = (int)$frameId;
		if (! $data || ! $frameId) {
			return false;
		}
		//frameID chaeck
		if (! isset($data[$this->Frame->name]['frame_id']) ||
			$frameId !== (int)$data[$this->Frame->name]['frame_id']) {
			return false;
		}

		//フレーム取得
		return $this->Frame->findById($frameId);
	}
}
