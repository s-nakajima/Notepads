<?php
/**
 * Notepad Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 * @package app.Plugin.Notepads.Test.Model.Case
 */

App::uses('Notepad', 'Notepads.Model');

/**
 * Notepad Test Case
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package app.Plugin.Notepads.Model
 */
class NotepadTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @var array
 */
	public $fixtures = array(
		'plugin.notepads.notepad',
		'plugin.notepads.language',
		'plugin.notepads.block',
		'plugin.notepads.blocks_language',
		'plugin.notepads.notepads_block',
		'plugin.notepads.part',
		'plugin.notepads.languages_part',
		'plugin.notepads.notepad_part_setting'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Notepad = ClassRegistry::init('Notepads.Notepad');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notepad);

		parent::tearDown();
	}

/**
 * testFindById
 *
 * @return void
 */
	public function testFindById() {
		$id = 1;
		$rtn = $this->Notepad->findById($id);
		$this->assertTrue(is_array($rtn));
	}

}
