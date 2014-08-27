<?php
/**
 * NotepadSetting Model
 *
 * @property Block $Block
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
 * NotepadSetting Model
 *
 * @property Block $Block
 *
 * @author      Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @package     app.Plugin.Notepads.Model
 */
class NotepadSetting extends NotepadsAppModel {

/**
 * Use database config
 *
 * @author  Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @var     string
 */
	public $useDbConfig = 'master';

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
		)
	);
}
