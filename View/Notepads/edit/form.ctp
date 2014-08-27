<?php
/**
 * view template
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @package     app.Plugin.Notepads.View.Notepads
 */
?>

<div id="nc-notepads-post-form-area-<?php echo (int)$frameId; ?>">

<?php
	echo $this->Form->create(null, array('id' => 'nc-notepads-post-form-' . $frameId));

	//フレームID
	echo $this->Form->input('Frame.frame_id', array(
				'type' => 'hidden',
				'value' => (int)$frameId,
			)
		);

	//NotepadブロックID
	echo $this->Form->input('Notepad.notepads_block_id', array(
				'type' => 'hidden',
				'value' => (int)$notepad['Notepad']['notepads_block_id'],
			)
		);

	//言語ID
	echo $this->Form->input('Notepad.language_id', array(
				'type' => 'hidden',
				'value' => (int)$notepad['Notepad']['language_id'],
			)
		);

	//タイトル
	echo $this->Form->input('Notepad.title', array(
				'label' => false,
				'type' => 'text',
				'value' => '',
			)
		);

	//内容
	echo $this->Form->input('Notepad.content', array(
				'label' => false,
				'type' => 'textarea',
				'value' => '',
			)
		);

	//状態
	echo $this->Form->input('Notepad.status', array(
				'label' => false,
				'type' => 'select',
				'options' => Notepad::getStatus(),
			)
		);

	echo $this->Form->end();
?>

</div>