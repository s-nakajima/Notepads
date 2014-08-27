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
     * 表示の設定
     *
     * @type {{setting: boolean, previewing: boolean}}
     */
   $scope.View = {
    'setting': false,
    'previewing': false
   }

      /**
       * コンテンツの状態設定
       * ラベルとボタンの表示制御 : お知らせの状態の格納
       *
       * @type {{publish: boolean, approval: boolean, draft: boolean, disapproval: boolean}}
       */
      $scope.label = {
        'publish' : false,
        'approval' : false,
        'draft' : false,
        'disapproval' : false
      };

      /**
       * Initialize
       *
       * @return {void}
       */
      $scope.initialize = function(notepad, frameId, langId) {
         $scope.notepad = notepad;
         $scope.frameId = frameId;
         $scope.langId = langId;
      };

      /**
       * 設定フォームを表示する。
       *
       * @return {void}
       */
      $scope.showSetting = function() {
        //$('#nc-block-setting-' + $scope.frameId).modal('show');
      };

    /**
     * 各ボタン処理
     *     Cancel: 閉じる
     *     Preview: プレビュー
     *     PreviewClose: プレビューの終了
     *     Draft: 下書き
     *     Reject: 差し戻し
     *     PublishRequest: 公開申請
     *     Publish: 公開
     *
     * @param {stirng} type
     * @return {void}
     */
    $scope.post = function(status) {
//      //idセット
//      $scope.setId(frameId, blockId, dataId);
//
//      //閉じる
//      if (type === 'Cancel') {
//        $scope.closeEditForm(frameId);
//        return;
//      }
//      //プレビュー
//      if (type === 'Preview') {
//        $scope.showPreview();
//        return;
//      }
//      //プレビューの終了
//      if (type === 'PreviewClose') {
//        $scope.closePreview();
//        return;
//      }
//
//      /** todo:非同期通信中のボタン無効化 */
//
//      //上記以外
//      $scope.sendPost(type, blockId, dataId);
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
