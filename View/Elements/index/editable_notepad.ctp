<?php
/**
 * notepad  template
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @package     app.Plugin.Notepads.View.Elements.index
 */
?>

<p>
	<h3><?php echo h($notepad['Notepad']['title']); ?></h3>

	<p><?php echo h($notepad['Notepad']['content']); ?></p>
</p>
