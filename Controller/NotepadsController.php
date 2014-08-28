<?php
/**
 * Notepads Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 * @package app.Plugin.Notepads.Controller
 */

App::uses('NotepadsAppController', 'Notepads.Controller');
App::uses('Notepad', 'Notepads.Model');

/**
 * Notepads Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package app.Plugin.Notepads.Controller
 */
class NotepadsController extends NotepadsAppController {

/**
 * use model
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @var array
 */
	public $uses = array(
		'Notepads.Notepad',
	);

/**
 * beforeFilter
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

/**
 * index
 *
 * @param int $frameId frames.id
 * @param string $lang language
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return CakeResponse
 */
	public function index($frameId = 0, $lang = '') {
		//フレーム初期化処理
		if (! $this->_initializeFrame($frameId, $lang)) {
			$this->response->statusCode(400);
			return $this->render(false);
		}

		//コンテンツの取得
		$notepad = $this->Notepad->getContent($this->viewVars['blockId'],
								$this->viewVars['languageId'],
								$this->viewVars['contentEditable']);

		//ログインしていない or 編集権限がない
		if (! CakeSession::read('Auth.User') || ! $this->viewVars['contentEditable']) {
			if (! $notepad) {
				return $this->render(false);
			}
			$this->set('notepad', $notepad);
			return $this->render('Notepads/index/publish');
		}

		if (! $notepad) {
			$notepad = $this->Notepad->create();
			$notepad[$this->Notepad->name]['title'] = '';
			$notepad[$this->Notepad->name]['content'] = '';
			$notepad[$this->Notepad->name]['language_id'] = $this->viewVars['languageId'];
		}
		$this->set('notepad', $notepad);

		//編集権限があり、セッティングモードOFF
		if (! Configure::read('Pages.isSetting')) {
			return $this->render('Notepads/index/latest');
		}

		//編集権限があり、セッティングモードON
		return $this->render('Notepads/index/edit');
	}

/**
 * view
 *
 * @param int $frameId frames.id
 * @param string $lang language
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return CakeResponse
 */
	public function view($frameId = 0, $lang = '') {
		return $this->render('Notepads/view');
	}

/**
 * get edit form
 *
 * @param int $frameId frames.id
 * @param int $languageId languages.id
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return CakeResponse
 */
	public function form($frameId = 0, $languageId = 0) {
		$this->layout = false;
		$this->isSetting = true;

		//フレーム初期化処理
		if (! $this->_initializeFrame($frameId)) {
			$this->response->statusCode(400);
			return $this->render(false);
		}

		//権限がない場合
		if (! $this->viewVars['contentEditable']) {
			return $this->render(false);
		}

		//引数の言語ID
		$languageId = (int)$languageId;

		//コンテンツの取得
		$notepad = $this->Notepad->getContent($this->viewVars['blockId'],
											$languageId,
											$this->viewVars['contentEditable']);
		if (! $notepad) {
			$notepad = $this->Notepad->create();
			$notepad[$this->Notepad->name]['language_id'] = $languageId;
			$notepad[$this->Notepad->name]['notepad_block_id'] = $this->viewVars['blockId'];
		}
		$this->set('notepad', $notepad);

		return $this->render('Notepads/edit/form');
	}

/**
 * edit notepad
 *
 * @param int $frameId frames.id
 * @return CakeResponse
 */
	public function edit($frameId = 0) {
		if (! $this->request->isPost()) {
			return $this->_renderJson(400, __d('notepads', 'I failed to save'));
		}

		//フレーム初期化処理
		$this->_initializeFrame($frameId);
		if (! $this->viewVars['contentEditable']) {
			//権限エラー
			return $this->_renderJson(403, __d('notepads', 'I failed to save'));
		}

		//保存
		$rtn = $this->Notepad->saveContent(
			$this->data,
			$frameId,
			$this->viewVars['roomId']
		);
		//成功結果を返す
		if (! $rtn) {
			//失敗結果を返す
			return $this->_renderJson(500, __d('notepads', 'I failed to save'), $rtn);
		} else {
			return $this->_renderJson(200, __d('notepads', 'Saved'), $rtn);
		}
	}
}
