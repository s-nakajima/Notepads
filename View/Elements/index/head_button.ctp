<?php
/**
 * index/status_label template elements
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @package     app.Plugin.Notepads.View.Elements.index
 */
?>

<p class="text-right" ng-hide="View.isSetting">
	<?php if ($blockEditable) : ?>
		<button class="btn btn-default ng-disabled"
				ng-click="showBlockSetting()" ng-disabled="sendLock">
			<span class="glyphicon glyphicon-cog">
				<?php echo __('Block setting'); ?>
			</span>
		</button>
	<?php endif; ?>

	<?php if ($contentEditable) : ?>
		<button class="btn btn-primary"
				ng-click="showSetting()" ng-disabled="sendLock">
			<span class="glyphicon glyphicon-pencil">
				<?php echo __('Edit'); ?>
			</span>
		</button>
	<?php endif; ?>

	<?php if ($contentPublishable) : ?>
		<button class="btn btn-danger ng-hide"
				ng-show="label.approval" ng-click="post('Publish')" ng-disabled="sendLock">
			<span class="glyphicon glyphicon-share-alt">
				<?php echo __('Publish'); ?>
			</span>
		</button>
	<?php endif; ?>
</p>

