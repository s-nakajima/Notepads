<?php
/**
 * NotepadsBlock Model
 *
 * @property Block $Block
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @package     app.Plugin.Notepads.Model
 */

App::uses('NotepadsAppModel', 'Notepads.Model');

/**
 * NotepadsBlock Model
 *
 * @property Block $Block
 *
 * @author      Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package     app.Plugin.Notepads.Model
 */
class NotepadsBlock extends NotepadsAppModel {

/**
 * Use database config
 *
 * @author  Shohei Nakajima <nakajimashouhei@gmail.com>
 * @var     string
 */
	public $useDbConfig = 'master';

/**
 * Validation rules
 *
 * @author  Shohei Nakajima <nakajimashouhei@gmail.com>
 * @var     array
 */
	public $validate = array(
		'block_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Security Error! Unauthorized input.',
			),
		),
	);

/**
 * belongsTo associations
 *
 * @author  Shohei Nakajima <nakajimashouhei@gmail.com>
 * @var     array
 */
	public $belongsTo = array(
		'Block' => array(
			'className' => 'Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Notepad' => array(
			'className' => 'Notepad',
			'foreignKey' => 'notepads_block_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'NotepadPartSetting' => array(
			'className' => 'NotepadPartSetting',
			'foreignKey' => 'notepads_block_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'NotepadSetting' => array(
			'className' => 'NotepadSetting',
			'foreignKey' => 'notepads_block_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
