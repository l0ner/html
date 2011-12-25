<?php
/*     
	This file is part of Grain Theme for WordPress.
	------------------------------------------------------------------
	File version: $Id: postoptionskeys.php 178 2008-06-23 19:16:35Z sunside $

*//**

	Grain post option definitions
	
	@package Grain Theme for WordPress
	@subpackage Post Options
*/
	
	if(!defined('GRAIN_THEME_VERSION') ) die(basename(__FILE__));
		
	
	$GrainPostOpt->defineFlagOpt('GRAIN_POSTOPT_HIDE_EXIF', "hide_exif", FALSE);
	$GrainPostOpt->defineValueOpt('GRAIN_POSTOPT_POSTTYPE', "posttype", GRAIN_POSTTYPE_PHOTO, FALSE, TRUE);

?>