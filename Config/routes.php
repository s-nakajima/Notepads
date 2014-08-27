<?php
/**
 * Notepads routes file
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <xxxxxxxxxxxxx@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @package     app.Plugin.Notepads.Config
 */

Router::connect('/notepads/:action', array(
	'plugin' => 'notepads', 'controller' => 'notepads'
));
