/**
 * @fileoverview Notepads Javascript
 * @author xxxxxxxxxxxxx@gmail.com (Shohei Nakajima)
 */


/**
 * Notepads Javascript
 *
 * @param {string} Controller name
 * @param {function(scope, http, sce, timeout)} Controller
 */
NetCommonsApp.controller('Notepads',
                         function($scope , $http, $sce, $timeout) {

      /**
       * プラグインURL
       *
       * @const
       */
      $scope.PLUGIN_URL = '/notepads/notepads/';

      /**
       * form url
       *
       * @const
       */
      $scope.GET_FORM_URL = $scope.PLUGIN_URL + 'form/';

      /**
       * post url
       *
       * @const
       */
      $scope.POST_FORM_URL = $scope.PLUGIN_URL + 'edit/';

      /**
       * Notepad
       *
       * @type {Object.<string>}
       */
      $scope.notepad = {};

      /**
       * frame id
       *
       * @type {number}
       */
      $scope.frameId = 0;

      /**
       * ヘッダーボタン
       *
       * @type {boolean}
       */
      $scope.dipslayHeaderBtn = true;

      /**
       * フォームの設定
       *
       * @type {{display: boolean,
       *         title: string,
       *         content: content,
       *         button: boolean}}
       */
      $scope.Form = {
        'display': false,
        'title': '',
        'content': '',
        'button': false
      }

      /**
       * プレビューの設定
       *
       * @type {{display: boolean, title: string, content: content}}
       */
      $scope.Preview = {
        'display': false,
        'title': '',
        'content': '',
        'label': false,
        'button': false
      }

      /**
       * コンテンツの状態設定
       * ラベルとボタンの表示制御 : お知らせの状態の格納
       *
       * @type {{publish: boolean, approval: boolean, draft: boolean, disapproval: boolean}}
       */
      $scope.Label = {
        'publish' : false,
        'approval' : false,
        'draft' : false,
        'disapproval' : false
      };

      /**
       * 実行結果の設定
       *
       * @type {{display: boolean, title: string, content: string}}
       */
      $scope.Result = {
        'display': false,
        'class': '',
        'message': ''
      }

      /**
       * ヘッダーボタン
       *
       * @type {boolean}
       */
      $scope.sendLock = false;

      /**
       * input form id attribute
       *
       * @const
       */
      $scope.INPUT_FORM_ATTR_ID = '#nc-notepads-input-form-';

      /**
       * input form id attribute
       *
       * @type {sring}
       */
      $scope.inputFormAttrId = '';

      /**
       * post form id attribute
       *
       * @const
       */
      $scope.POST_FORM_ATTR_ID = '#nc-notepads-post-form-';

      /**
       * post form id attribute
       *
       * @type {sring}
       */
      $scope.postFormAttrId = '';

      /**
       * post form area id attribute
       *
       * @type {sring}
       */
      $scope.postFormAreaAttrId = '';

      /**
       * Initialize
       *
       * @return {void}
       */
      $scope.initialize = function(notepad, frameId) {
        $scope.notepad = notepad;
        $scope.frameId = frameId;

        $scope.inputFormAttrId = $scope.INPUT_FORM_ATTR_ID + $scope.frameId;
        $scope.postFormAttrId = $scope.POST_FORM_ATTR_ID + $scope.frameId;
        $scope.postFormAreaAttrId = $scope.POST_FORM_ATTR_ID + 'area-' + $scope.frameId;
      };

      /**
       * 設定フォームを表示する。
       *
       * @return {void}
       */
      $scope.showSetting = function() {
        $scope.Form.display = true;
        $scope.Form.button = true;
        $scope.Form.title = $scope.notepad.Notepad.title;
        $scope.Form.content = $scope.notepad.Notepad.content;

        $scope.Preview.display = false;
        $scope.Preview.label = false;

        $scope.dipslayHeaderBtn = false;

        $($scope.postFormAreaAttrId).html(' ');
      };

      /**
       * プレビューを表示する。
       *
       * @return {void}
       */
      $scope.showPreview = function() {
        $scope.Form.display = false;
        $scope.Preview.display = true;
        $scope.Preview.label = true;

        $scope.Preview.title = $scope.Form.title;
        $scope.Preview.content = $scope.Form.content;
      };

      /**
       * 設定フォームを終了する。
       *
       * @return {void}
       */
      $scope.hideSetting = function() {
        $scope.Form.display = false;
        $scope.Form.button = false;
        $scope.Preview.display = false;
        $scope.Preview.label = false;
        $scope.dipslayHeaderBtn = true;
      };

      /**
       * プレビューを終了する。
       *
       * @return {void}
       */
      $scope.hidePreview = function() {
        $scope.Form.display = true;
        $scope.Preview.display = false;
        $scope.Preview.label = false;
      };

      /**
       * 各ボタン処理
       *     Draft: 下書き
       *     Disapproval: 差し戻し
       *     Approval: 公開申請
       *     Publish: 公開
       *
       * @param {stirng} status
       * @return {void}
       */
      $scope.post = function(postStatus) {
        $scope.sendLock = true;

        $http.get($scope.GET_FORM_URL +
              $scope.frameId + '/' +
              $scope.notepad.Notepad.language_id + '/' + Math.random()
            )
          .success(function(data, status, headers, config) {
              //POST用のフォームセット
              $($scope.postFormAreaAttrId).html(data);
              //ステータスのセット
              $($scope.postFormAttrId +
                      ' select[name="data[Notepad][status]"]').val(postStatus);

              var postParams = {};
              //POSTフォームのシリアライズ
              var i = 0;
              var postSerialize =
                      $($scope.postFormAttrId).serializeArray();
              var length = postSerialize.length;
              for (var i = 0; i < length; i++) {
                postParams[postSerialize[i]['name']] =
                                            postSerialize[i]['value'];
              }

              //入力フォームのシリアライズ
              var i = 0;
              var inputSerialize =
                      $($scope.inputFormAttrId).serializeArray();
              var length = inputSerialize.length;
              for (var i = 0; i < length; i++) {
                postParams[inputSerialize[i]['name']] =
                                            inputSerialize[i]['value'];
              }

              //登録情報をPOST
              $scope.sendPost(postParams);
            })
          .error(function(data, status, headers, config) {
              //keyの取得に失敗
              if (! data) { data = 'error'; }
              $scope.showResult('error', data);
            });
      };

      /**
       * 登録処理
       *
       * @param {Object.<string>} postParams
       * @return {void}
       */
      $scope.sendPost = function(postParams) {
        $http.post(
              $scope.POST_FORM_URL + $scope.frameId + '/' + Math.random(),
              postParams
            )
          .success(function(data, status, headers, config) {
              $scope.notepad = data.notepad;
              $scope.showResult('success', data.message);
            })
          .error(function(data, status, headers, config) {
              if (! data.message) {
                $scope.showResult('error', headers);
              } else {
                $scope.showResult('error', data.message);
              }
            });
      };

      /**
       * メッセージ（実行結果）を表示
       *
       * @param {stirng} type
       * @param {stirng} text
       * @return {void}
       */
      $scope.showResult = function(type, message) {
        if (type == 'error') {
          $scope.Result.class = 'alert-danger';
        }
        if (type == 'success') {
          $scope.Result.class = 'alert-success';
        }

        $scope.Result.message = message;
        $scope.sendLock = false;
      };

      /**
       * ブロック設定のモーダルを表示させる。
       *
       * @return {void}
       */
      $scope.showBlockSetting = function() {
        //$('#nc-block-setting-' + $scope.frameId).modal('show');
      };

    });
