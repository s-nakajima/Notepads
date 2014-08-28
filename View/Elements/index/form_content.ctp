<?php
/**
 * setting/form_button template elements
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @package     app.Plugin.AccessCounters.View.Elements.index
 */
?>

<form method="post" accept-charset="utf-8" class="ng-hide"
	  id="nc-notepads-input-form-<?php echo (int)$frameId; ?>"
	  ng-show="Form.display" onsubmit="event.returnValue = false; return false;">

	<div class='form-group'>
		<?php
			//タイトル
			echo $this->Form->label('Notepad.title', __d('notepads', 'Title'));

			echo $this->Form->input('Notepad.title', array(
						'label' => false,
						'type' => 'text',
						'class' => 'form-control',
						'ng-model' => 'Form.title'
					)
				);
		?>
	</div>
	<div class='form-group'>
		<?php
			//内容
			echo $this->Form->label('Notepad.content', __d('notepads', 'Content'));

			echo $this->Form->input('Notepad.content', array(
						'label' => false,
						'type' => 'textarea',
						'class' => 'form-control',
						'ng-model' => 'Form.content'
					)
				);
		?>
	</div>
</form>
