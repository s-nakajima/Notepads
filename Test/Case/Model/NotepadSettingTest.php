<?php
/**
 * NotepadsSetting Test Case
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @package     app.Plugin.Notepads.Test.Model.Case
 */

App::uses('NotepadsSetting', 'Notepads.Model');

/**
 * NotepadsSetting Test Case
 *
 * @author      Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @package     app.Plugin.Notepads.Model
 */
class NotepadsSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @author  Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @var     array
 */
	public $fixtures = array(
		'plugin.notepads.notepads_block',
		'plugin.notepads.notepad_setting',
		'plugin.notepads.block',
		'plugin.notepads.language',
		'plugin.notepads.blocks_language'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NotepadSetting = ClassRegistry::init('Notepads.NotepadSetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NotepadSetting);

		parent::tearDown();
	}

/**
 * testFindById
 *
 * @return void
 */
	public function testFindById() {
		$id = 1;
		$rtn = $this->NotepadSetting->findById($id);
		$this->assertTrue(is_array($rtn));
	}

}
