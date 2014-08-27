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

	<?php
		//ヘッダーボタン(ブロック設定、編集、公開する)の表示
		echo $this->element('index/head_button');
	?>

	<div ng-hide="Form.display">
		<?php
			//本文の表示
			echo $this->element('index/notepad');
		?>
	</div>


	<?php
		//プレビューの表示
		echo $this->element('index/preview');

		//状態ラベルの表示
		echo $this->element('index/status_label');

		//入力フォームの表示
		echo $this->element('index/form_content');

		//入力フォームのボタン表示
		echo $this->element('index/form_button');
	?>

</div>