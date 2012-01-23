<?php
/*     
	This file is part of Grain Theme for WordPress.
	------------------------------------------------------------------
	File version: $Id: upgrade.php 111 2008-06-18 02:07:27Z sunside $

*//**

	Upgrade mechanism
	
	@package Grain Theme for WordPress
	@subpackage Upgrade Mechanism
*/
	
	if(!defined('GRAIN_THEME_VERSION') ) die(basename(__FILE__));
	
	/* Includes */
	
	@require_once(TEMPLATEPATH . '/func/options.php');
	
	/* version helper */
		
	/**
	 * grain_get_version_array() - Gets an associative array with information about the current version
	 *
	 * @param string $versionString The version string
	 * @return array Information about the current version
	 */
	function grain_get_version_array($versionString) {
		$regexp = '#(?P<major>\d+)\.(?P<minor>\d+)(\.(?P<revision>\d+)((\.|\s*r)(?P<fix>\d+))?)?(\s*b(eta)?\s*(?P<beta>\d+))?#iu';
		preg_match($regexp, $versionString, $array);
		if(!$array) return null;

		return array( 
			'major' => empty($array['major']) ? 0 : $array['major'],
			'minor' => empty($array['minor']) ? 0 : $array['minor'],
			'revision' => empty($array['revision']) ? 0 : $array['revision'],
			'fix' => empty($array['fix']) ? 0 : $array['fix'],
			'beta' => empty($array['beta']) ? 0 : $array['beta']
		);
	}
	
	/**
	 * grain_compare_version() - Compares two versions
	 *
	 * @uses grain_get_version_array() To split the version strings into arrays
	 * @param string $versionString1 		The left version string
	 * @param string $versionString2 		The right version string
	 * @return int negative if left version is smaller, equal if identical, positive value if left version is bigger
	 */
	function grain_compare_version($versionString1, $versionString2) {
		$v1 = grain_get_version_array($versionString1);
		$v2 = grain_get_version_array($versionString2);
				
		// sanity check
		if( empty($v1) && !empty($v2) ) return -1;
		if( !empty($v1) && empty($v2) ) return +1;
		
		// check major version
		if( $v1['major'] < $v2['major'] ) return -1;
		if( $v1['major'] > $v2['major'] ) return +1;
		
		// check minor version
		if( $v1['minor'] < $v2['minor'] ) return -1;
		if( $v1['minor'] > $v2['minor'] ) return +1;
		
		// check revision
		if( $v1['revision'] < $v2['revision'] ) return -1;
		if( $v1['revision'] > $v2['revision'] ) return +1;
		
		// check fix
		if( $v1['fix'] < $v2['fix'] ) return -1;
		if( $v1['fix'] > $v2['fix'] ) return +1;

		// check beta version
		if( $v1['beta'] < $v2['beta'] ) return -1;
		if( $v1['beta'] > $v2['beta'] ) return +1;
		
		// equal
		return 0;
	}
	
	/* upgrader */
	
	/**
	 * grain_perform_upgrade() - Performs an automatic upgrade from older versions
	 *
	 * @uses get_option() 					To get an option
	 * @uses delete_option() 				To delete an option
	 * @access internal
	 */
	function grain_perform_upgrade() {
		global $GrainOpt;
		
		$version = $GrainOpt->get(GRAIN_VERSION_KEY);

		// check if the theme is below version 0.1.2r3
		if( $version == null ) {
			
			// prepare new options
			$options = array();
			
			// convert existing
			$options[GRAIN_INFOPAGE_ID] 			= get_option('grain_infopage_id');				delete_option('grain_infopage_id');
			$options[GRAIN_MNU_PERMALINK_VISIBLE] 	= get_option('grain_permalink_visible');		delete_option('grain_permalink_visible');
			$options[GRAIN_MNU_PERMALINK_TEXT] 		= get_option('grain_permalink_text');			delete_option('grain_permalink_text');
			$options[GRAIN_MNU_RANDOM_VISIBLE] 		= get_option('grain_random_visible');			delete_option('grain_random_visible');
			$options[GRAIN_MNU_NEWEST_VISIBLE] 		= get_option('grain_newest_visible');			delete_option('grain_newest_visible');
			$options[GRAIN_MNU_INFO_VISIBLE] 		= get_option('grain_info_visible');				delete_option('grain_info_visible');
			$options[GRAIN_NAV_BIDIR_ENABLED] 		= get_option('grain_bidir_nav_enabled');		delete_option('grain_bidir_nav_enabled');
			$options[GRAIN_SYND_FLAT_DELIMITER]		= get_option('grain_synd_flat_delimiter');		delete_option('grain_synd_flat_delimiter');
			$options[GRAIN_SYND_FLAT_ENABLED] 		= get_option('grain_flat_syndication');			delete_option('grain_flat_syndication');
			$options[GRAIN_SDBR_SYND_ENABLED] 		= get_option('grain_sidebar_syndication');		delete_option('grain_sidebar_syndication');
			$options[GRAIN_SDBR_MOSTCOMM_ENABLED] 	= get_option('grain_sidebar_mc_enabled');		delete_option('grain_sidebar_mc_enabled');
			$options[GRAIN_SDBR_MOSTCOMM_COUNT] 	= get_option('grain_sidebar_mc_count');			delete_option('grain_sidebar_mc_count');
			$options[GRAIN_SDBR_META_ENABLED] 		= get_option('grain_sidebar_meta_enabled');		delete_option('grain_sidebar_meta_enabled');
			$options[GRAIN_SDBR_BLOGROLL_ENABLED] 	= get_option('grain_sidebar_blogroll_enabled');	delete_option('grain_sidebar_blogroll_enabled');
			$options[GRAIN_SDBR_CALENDAR_ENABLED] 	= get_option('grain_sidebar_calendar_enabled');	delete_option('grain_sidebar_calendar_enabled');
			$options[GRAIN_2NDLANG_ENABLED]			= get_option('grain_2ndlang_enabled');			delete_option('grain_2ndlang_enabled');
			$options[GRAIN_2NDLANG_TAG] 			= get_option('grain_2ndlang_tag');				delete_option('grain_2ndlang_tag');
			$options[GRAIN_FEED_ATOM_ENABLED] 		= get_option('grain_atomfeed_enabled');			delete_option('grain_atomfeed_enabled');
			$options[GRAIN_MOSAIC_COUNT] 			= get_option('grain_mosaic_count');				delete_option('grain_mosaic_count');
			$options[GRAIN_MOSAIC_DISPLAY_YEARS] 	= get_option('grain_mosaic_years');				delete_option('grain_mosaic_years');
			$options[GRAIN_MOSAIC_ENABLED] 			= get_option('grain_mosaic_enabled');			delete_option('grain_mosaic_enabled');
			$options[GRAIN_MOSAIC_PAGEID] 			= get_option('grain_mosaicpage_id');			delete_option('grain_mosaicpage_id');
			$options[GRAIN_MOSAIC_LINKTITLE] 		= get_option('grain_mosaicpage_title');			delete_option('grain_mosaicpage_title');
			$options[GRAIN_EXTENDEDINFO_ENABLED] 	= get_option('grain_extended_comments');		delete_option('grain_extended_comments');
			$options[GRAIN_COPYRIGHT_END_OFFSET] 	= get_option('grain_copyright_end_year_offset');delete_option('grain_copyright_end_year_offset');
			$options[GRAIN_COPYRIGHT_END_YEAR] 		= get_option('copyright_end_year');				delete_option('copyright_end_year');
			$options[GRAIN_COPYRIGHT_START_YEAR] 	= get_option('copyright_start_year');			delete_option('copyright_start_year');
			$options[GRAIN_COPYRIGHT_CC_ENABLED] 	= get_option('grain_cc_license');				delete_option('grain_cc_license');
			$options[GRAIN_COPYRIGHT_CC_CODE] 		= get_option('grain_cc_code');					delete_option('grain_cc_code');
			$options[GRAIN_COPYRIGHT_HOLDER] 		= get_option('grain_copyright_person');			delete_option('grain_copyright_person');
			$options[GRAIN_COPYRIGHT_HOLDER_HTML] 	= get_option('grain_copyright_person_styled');	delete_option('grain_copyright_person_styled');

			// check for first-time installation
			$empty = TRUE;
			foreach($options as $key => $value ) {
				if( !empty($value) ) {
					$empty = FALSE;
					break;
				}
			}
			
			// no data found, this is likely not an upgrade - even if it would be, we have now cleaned up and are using defaults
			if($empty) {
				// this is not an upgrade, clear array
				grain_tweak_yapb();
				
				// clear array
				$options = array();
			}
			
			// set version
			$options[GRAIN_VERSION_KEY] = GRAIN_THEME_VERSION;
			
			// update
			add_option( GRAIN_OPTIONS_KEY, $options );
			
		} // if( $version == null )

	}

	/* first-time YAPB configuration */
	
	/**
	 * grain_tweak_yapb() - Sets some YAPB options
	 *
	 * @deprecated
	 * @uses get_option() 					To get an option
	 * @uses delete_option() 				To delete an option
	 * @access internal
	 */
	function grain_tweak_yapb() {
		// disable YAPB's automatic insertion
		// update_option('yapb_display_images_activate', '');
	}

	/* auto-perform the upgrade and first-time installation */
	
	grain_perform_upgrade();

?>