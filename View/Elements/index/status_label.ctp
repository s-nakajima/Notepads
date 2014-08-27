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

<p>
	<span class="label label-info ng-hide"
		  ng-init="label.publish=<?php echo($notepad['Notepad']['status'] === Notepad::STATUS_PUBLISH ? 'true' : 'false'); ?>"
		  ng-class="{hidden: notepad.Notepad.status === <?php echo Notepad::STATUS_PUBLISH ?>}"
		  ng-show="label.publish"
	>
		<?php echo __('Publish'); ?>
	</span>

	<span class="label label-info ng-hide"
		  ng-init="label.approval=<?php echo($notepad['Notepad']['status'] === Notepad::STATUS_APPROVAL ? 'true' : 'false'); ?>"
		  ng-class="{hidden: notepad.Notepad.status === <?php echo Notepad::STATUS_APPROVAL ?>}"
		  ng-show="label.approval"
	>
		<?php echo __('Approval'); ?>
	</span>

	<span class="label label-info ng-hide"
		  ng-init="label.draft=<?php echo($notepad['Notepad']['status'] === Notepad::STATUS_DRAFT ? 'true' : 'false'); ?>"
		  ng-class="{hidden: notepad.Notepad.status === <?php echo Notepad::STATUS_DRAFT ?>}"
		  ng-show="label.draft"
	>
		<?php echo __('Draft'); ?>
	</span>

	<span class="label label-info ng-hide"
		  ng-init="label.disapproval=<?php echo($notepad['Notepad']['status'] === Notepad::STATUS_DISAPPROVAL ? 'true' : 'false'); ?>"
		  ng-class="{hidden: notepad.Notepad.status === <?php echo Notepad::STATUS_DISAPPROVAL ?>}"
		  ng-show="label.disapproval"
	>
		<?php echo __('Disapproval'); ?>
	</span>

</p>
