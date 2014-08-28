<?php
/**
 * notepad  template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 * @package app.Plugin.Notepads.View.Elements.index
 */
?>

<div ng-show="Content.display"
		id="nc-notepads-content-<?php echo (int)$frameId; ?>">
	<h3 class="nc-notepads-title">
		<?php echo h($notepad['Notepad']['title']); ?>
	</h3>

	<p class="nc-notepads-content">
		<?php echo h($notepad['Notepad']['content']); ?>
	</p>
</div>
