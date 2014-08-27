<?php
/**
 * latest template
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

<p>
	<?php
		//本文の表示
		echo $this->element('index/notepad');
	?>
</p>

<p ng-controller="Notepads"
   ng-init="initialize(<?php echo h(json_encode($notepad)); ?>,
						<?php echo (int)$frameId; ?>,
						<?php echo (int)$langId; ?>)">
	<?php
		//状態の表示
		echo $this->element('index/status_label');
	?>
</p>
