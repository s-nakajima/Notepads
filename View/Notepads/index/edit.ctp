<?php
/**
 * edit template
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @package     app.Plugin.Notepads.View.Notepads.index
 */
?>
<?php echo $this->Html->script("/notepads/js/notepads.js"); ?>

<div ng-controller="Notepads"
	 ng-init="initialize(<?php echo h(json_encode($notepad)); ?>,
						<?php echo (int)$frameId; ?>,
						<?php echo (int)$langId; ?>)">


	<p>
		<?php
			//ヘッダーボタン(ブロック設定、編集、公開する)の表示
			echo $this->element('index/head_button');
		?>
	</p>

	<p ng-show="View.setting">
		<?php
			//本文の表示
			echo $this->element('index/notepad');
		?>
	</p>

	<p ng-show="View.previewing" id=""></p>

	<p>
		<?php
			//状態ラベルの表示
			echo $this->element('index/status_label');
		?>
	</p>

</div>