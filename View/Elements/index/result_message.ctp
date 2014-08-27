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

<div class="alert ng-hide" ng-class="Result.class" ng-show="Result.display">
	<span class="pull-right" ng-click="Result.display=false">
		<span class="glyphicon glyphicon-remove"> </span>
	</span>
	<span class='message'>{{Result.message}}</span>
</div>
