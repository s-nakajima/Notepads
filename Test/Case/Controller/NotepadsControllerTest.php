<?php
/**
 * NotepadsController Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 * @package app.Plugin.Notepads.Test.Controller.Case
 */

App::uses('NotepadsController', 'Notepads.Controller');

/**
 * NotepadsController Test Case
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package app.Plugin.Notepads.Test.Controller.Case
 */
class NotepadsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @var array
 */
	public $fixtures = array(
		'app.Session',
		'app.SiteSetting',
		'app.SiteSettingValue',
		'plugin.notepads.notepad',
		'plugin.notepads.frame',
		'plugin.notepads.frames_language',
		'plugin.notepads.box',
		'plugin.notepads.plugin',
		'plugin.notepads.parts_rooms_user',
		'plugin.notepads.room',
		'plugin.notepads.user',
		'plugin.notepads.room_part',
	);

/**
 * setUp
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return void
 */
	public function setUp() {
		parent::setUp();
	}

/**
 * tearDown method
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
	}

/**
 * test index
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return void
 */
	public function testIndex() {
		$frameId = 1;
		$this->testAction('/notepads/notepads/index/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * test view
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return void
 */
	public function testView() {
		$frameId = 1;
		$this->testAction('/notepads/notepads/view/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

}
