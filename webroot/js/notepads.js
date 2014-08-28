/**
 * @fileoverview Notepads Javascript
 * @author nakajimashouhei@gmail.com (Shohei Nakajima)
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
       * Notepad plugin URL
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
       * display header button
       *
       * @type {boolean}
       */
      $scope.dipslayHeaderBtn = true;

      /**
       * content object
       *
       * @type {{display: boolean}}
       */
      $scope.Content = {
        'display': true
      };

      /**
       * input form object
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
      };

      /**
       * preview object
       *
       * @type {{display: boolean, title: string, content: content}}
       */
      $scope.Preview = {
        'display': false,
        'title': '',
        'content': '',
        'label': false,
        'button': false
      };

      /**
       * status label object
       *
       * @type {{publish: boolean, approval: boolean, draft: boolean, disapproval: boolean}}
       */
      $scope.Label = {
        'publish': false,
        'approval': false,
        'draft': false,
        'disapproval': false
      };

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
       * result message id attribute
       *
       * @const
       */
      $scope.RESULT_MESSAGE_ATTR_ID = '#nc-notepads-result-';

      /**
       * result message id attribute
       *
       * @type {sring}
       */
      $scope.resultMessageAttrId = '';

      /**
       * result message id attribute
       *
       * @const
       */
      $scope.CONTENT_ATTR_ID = '#nc-notepads-content-';

      /**
       * result message id attribute
       *
       * @type {sring}
       */
      $scope.contentAttrId = '';

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
        $scope.postFormAreaAttrId = $scope.POST_FORM_ATTR_ID +
                'area-' + $scope.frameId;

        $scope.resultMessageAttrId =
            $scope.RESULT_MESSAGE_ATTR_ID + $scope.frameId;

        $scope.ContentAttrId = $scope.CONTENT_ATTR_ID + $scope.frameId;

        $scope.Content.display = true;

      };

      /**
       * show setting form
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
        $scope.Content.display = false;

        $($scope.resultMessageAttrId)
            .removeClass('alert-danger')
            .removeClass('alert-success');
        $($scope.resultMessageAttrId + ' .message').html(' ');

        $($scope.postFormAreaAttrId).html(' ');
      };

      /**
       * show preview
       *
       * @return {void}
       */
      $scope.showPreview = function() {
        $scope.Preview.display = true;
        $scope.Preview.label = true;

        $scope.Preview.title = $scope.Form.title;
        $scope.Preview.content = $scope.Form.content;
        $scope.Form.display = false;
      };

      /**
       * hide setting form
       *
       * @return {void}
       */
      $scope.hideSetting = function() {
        $scope.Form.display = false;
        $scope.Form.button = false;
        $scope.Preview.display = false;
        $scope.Preview.label = false;
        $scope.dipslayHeaderBtn = true;
        $scope.Content.display = true;
      };

      /**
       * hide preview
       *
       * @return {void}
       */
      $scope.hidePreview = function() {
        $scope.Form.display = true;
        $scope.Preview.display = false;
        $scope.Preview.label = false;
      };

      /**
       * post
       *     1: Publish
       *     2: Approve
       *     3: Draft
       *     4: Disapprove
       *
       * @param {string} status
       * @return {void}
       */
      $scope.post = function(postStatus) {
        //$scope.sendLock = true;

        $http.get($scope.GET_FORM_URL +
                $scope.frameId + '/' +
                $scope.notepad.Notepad.language_id + '/' + Math.random())
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
       * save
       *
       * @param {Object.<string>} postParams
       * @return {void}
       */
      $scope.sendPost = function(postParams) {
        $.ajax({
          method: 'POST' ,
          url: $scope.POST_FORM_URL + $scope.frameId + '/' + Math.random(),
          data: postParams,
          success: function(json, status, headers, config) {
            $scope.notepad = json.data;
            $($scope.contentAttrId + ' .nc-notepads-title')
                    .html(json.data.Notepad.title);
            $($scope.contentAttrId + ' .nc-notepads-content')
                    .html(json.data.Notepad.content);
            $scope.showResult('success', json.message);
          },
          error: function(json, status, headers, config) {
            if (! json.message) {
              $scope.showResult('error', headers);
            } else {
              $scope.showResult('error', json.message);
            }
          }
        });
      };

      /**
       * show result
       *
       * @param {string} type
       * @param {string} message
       * @return {void}
       */
      $scope.showResult = function(type, message) {
        if (type == 'error') {
          $($scope.resultMessageAttrId)
            .addClass('alert-danger')
            .removeClass('alert-success');
        }
        if (type == 'success') {
          $($scope.resultMessageAttrId)
            .removeClass('alert-danger')
            .addClass('alert-success');
        }

        $($scope.resultMessageAttrId + ' .message').html(message);
      };

      /**
       * show block setting
       *
       * @return {void}
       */
      $scope.showBlockSetting = function() {
        //$('#nc-block-setting-' + $scope.frameId).modal('show');
      };

    });
