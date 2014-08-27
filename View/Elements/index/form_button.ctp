<?php
/**
 * setting/form_button template elements
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @package     app.Plugin.AccessCounters.View.Elements.setting
 */
?>

<p class="text-center" ng-show="View.setting">
	<button class="btn btn-default"
			ng-disabled="sendLock" ng-click="hideSetting()">
		<span> <?php echo __('Cancel'); ?> </span>
	</button>

	<button class="btn btn-default"
			ng-click="showPreview()" ng-hide="View.previewing" ng-disabled="sendLock">

		<span class="glyphicon glyphicon-file"></span>
		<span><?php echo __('Preview'); ?></span>
	</button>

	<button class="btn btn-default"
			ng-click="hidePreview()" ng-show="View.previewing" ng-disabled="sendLock">

		<span class="glyphicon glyphicon-file"></span>
		<span><?php echo __('Close Preview'); ?></span>
	</button>

	<button class="btn btn-default"
			ng-click="post('Draft')" ng-hide="label.approval" ng-disabled="sendLock">

		<span class="glyphicon glyphicon-pencil"></span>
		<span><?php echo __('Draft'); ?></span>
	</button>

	<button class="btn btn-default"
			ng-click="post('disapproval')" ng-show="label.approval" ng-disabled="sendLock">

		<span class="glyphicon glyphicon-pencil"></span>
		<span><?php echo __('Disapproval'); ?></span>
	</button>

	<?php if (! $contentPublishable) : ?>
		<button class="btn btn-primary"
				ng-click="post('approval')" ng-disabled="sendLock">
			<span class="glyphicon glyphicon-share-alt"></span>
			<span><?php echo __('Approval'); ?></span>
		</button>
	<?php else : ?>
		<button class="btn btn-primary"
				ng-click="post('Publish')"	ng-disabled="sendLock">

			<span class="glyphicon glyphicon-share-alt"></span>
			<span><?php echo __('Publish'); ?></span>
		</button>
	<?php endif; ?>
</p>