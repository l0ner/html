<?php
/*     
	This file is part of Grain Theme for WordPress.
	------------------------------------------------------------------
	File version: $Id: paths.php 146 2008-06-21 01:54:30Z sunside $

*//**

	Path definitions
	
	@package Grain Theme for WordPress
	@subpackage Path Definitions
*/
	
	if(!defined('GRAIN_THEME_VERSION') ) die(basename(__FILE__));


	/* definitions */

	/** 
	 * The path to Grain relative from the blog's root.
	 * This is not to be confused with the actual relative URL, as this may be different.
	 */ 
	define('GRAIN_RELATIVE_PATH', substr(TEMPLATEPATH, strlen(ABSPATH)));
	
	/** 
	 * The absolute path to Grain's directory.
	 * This is an alias for TEMPLATEPATH
	 */ 
	define('GRAIN_ABSOLUTE_PATH', TEMPLATEPATH);
	
	/** 
	 * The URL to Grain's directory.
	 * This is an alias for get_bloginfo('template_directory')
	 */ 
	define('GRAIN_TEMPLATE_DIR', get_bloginfo('template_directory'));
	
	/** 
	 * The URL to Grain's directory.
	 * This is an alias for get_bloginfo('template_directory')
	 */ 
	define('GRAIN_ADMIN_PATH', "/".GRAIN_RELATIVE_PATH."/admin");

?>