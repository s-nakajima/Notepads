<?php
/**
 * NotepadPartSettingFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 * @package app.Plugin.Notepads.Test.Model.Fixture
 */

/**
 * NotepadPartSettingFixture
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package app.Plugin.Notepads.Model
 */
class NotepadPartSettingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'notepad_block_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'part_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'read_content' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
		'edit_content' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
		'create_content' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
		'publish_content' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'notepad_block_id' => 1,
			'part_id' => 1,
			'read_content' => 1,
			'edit_content' => 1,
			'create_content' => 1,
			'publish_content' => 1,
		),
	);

}
