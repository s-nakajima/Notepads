<?php
/**
 * NotepadPartSetting Model
 *
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
 * NotepadsPart Model
 *
 * @property Block $Block
 * @property Part $Part
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package app.Plugin.Notepads.Model
 */
class NotepadPartSetting extends NotepadsAppModel {

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
				'message' => 'Security Error! Unauthorized input.',
			),
		),
		'part_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Security Error! Unauthorized input.',
			),
		),
		'readable_content' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Security Error! Unauthorized input.',
			),
			'range' => array(
				'rule' => array('range', 0, 3),
				'message' => 'Security Error! Unauthorized input.',
			),
		),
		'editable_content' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Security Error! Unauthorized input.',
			),
			'range' => array(
				'rule' => array('range', 0, 3),
				'message' => 'Security Error! Unauthorized input.',
			),
		),
		'creatable_content' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Security Error! Unauthorized input.',
			),
			'range' => array(
				'rule' => array('range', 0, 3),
				'message' => 'Security Error! Unauthorized input.',
			),
		),
		'publishable_content' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Security Error! Unauthorized input.',
			),
			'range' => array(
				'rule' => array('range', 0, 3),
				'message' => 'Security Error! Unauthorized input.',
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
		'Part' => array(
			'className' => 'Part',
			'foreignKey' => 'part_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
