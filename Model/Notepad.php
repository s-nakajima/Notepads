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
 * Notepads status approval
 *
 * @var int
 */
	const STATUS_APPROVAL = 2;

/**
 * Notepads status Draft
 *
 * @var int
 */
	const STATUS_DRAFT = 3;
/**
 * Notepads status disapproval
 *
 * @var int
 */
	const STATUS_DISAPPROVAL = 4;

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
				'rule' => array('range', 0, 4),
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
		)
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
	public function getContent($blockId, $langId, $editable = false) {
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

}
