<?php
/*     
	This file is part of Grain Theme for WordPress.
	------------------------------------------------------------------
	File version: $Id: navlinks.php 134 2008-06-20 00:42:50Z sunside $

*//**

	Navigation helper functions
	
	@package Grain Theme for WordPress
	@subpackage Navigation
*/
	
	if(!defined('GRAIN_THEME_VERSION') ) die(basename(__FILE__));

/* definitions */

	define("GRAIN_FIRST_POST", -1);
	define("GRAIN_NEWEST_POST", +1);
	define("GRAIN_SURROUNDED_POST", 0);

/* left/right navigation */

	/**
	 * grain_mimic_previous_post_link() - Gets a link to the previous post
	 *
	 * @since 0.1
	 * @see grain_mimic_next_post_link()
	 * @access private
	 * @param string $format Optional. The HTML markup in which the link shall be embedded. "%link" will be replaced with the actual anchor
	 * @param string $link Optional. The HTML markup of the link's title. "%title" will be replaced with the post's title
	 * @param bool $in_same_cat Optional. Set to TRUE if the next link in the same category shall be retrieved
	 * @param mixed $excluded_categories Optional. A list of excluded categories
	 * @return string HTML markup with the link to the previous post
	 */
	function grain_mimic_previous_post_link($format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories = '') {
		global $post;

		if ( is_attachment() )
			$prev = & get_post($post->post_parent);
		else
			$prev = get_previous_post($in_same_cat, $excluded_categories);

		if ( !$prev )
			return;

		$addon = "";
			//if( grain_extended_comments() ) $addon = '?info=' . ((isset($_REQUEST['info']) && $_REQUEST['info'] == 'on') ? 'on' : 'off');

		$title = apply_filters('the_title', $prev->post_title, $prev);
		$string = '<a rel="prev" href="'.get_permalink($prev->ID).$addon.'">';
		$link = str_replace('%title', $title, $link);
		$link = $string . $link . '</a>';

		$format = str_replace('%link', $link, $format);

		return $format;
	}

	/**
	 * grain_mimic_next_post_link() - Gets a link to the next post
	 *
	 * @since 0.1
	 * @see grain_mimic_previous_post_link()
	 * @access private
	 * @param string $format Optional. The HTML markup in which the link shall be embedded. "%link" will be replaced with the actual anchor
	 * @param string $link Optional. The HTML markup of the link's title. "%title" will be replaced with the post's title
	 * @param bool $in_same_cat Optional. Set to TRUE if the next link in the same category shall be retrieved
	 * @param mixed $excluded_categories Optional. A list of excluded categories
	 * @return string HTML markup with the link to the previous post
	 */
	function grain_mimic_next_post_link($format='%link &raquo;', $link='%title', $in_same_cat = false, $excluded_categories = '') {
		global $post;	
	
		$next = get_next_post($in_same_cat, $excluded_categories);

		if ( !$next )
			return;

		$title = apply_filters('the_title', $next->post_title, $next);
		$string = '<a rel="next" href="'.get_permalink($next->ID).'">';
		$link = str_replace('%title', $title, $link);
		$link = $string . $link . '</a>';
		$format = str_replace('%link', $link, $format);

		return $format;
	}
	
/* comment link generation */

	/**
	 * grain_generate_comments_link() - Generates a link to the comments
	 *
	 * The behavior of this function depends on the mode Grain is using. If in popup mode,
	 * this link will open the popup. If in extended info mode, this link will lead to the details.
	 *
	 * @since 0.1
	 * @access private
	 * @global $GrainOpt Grain options
	 * @using $post Global post object
	 * @return string HTML markup with the link to the comments
	 */
	function grain_generate_comments_link() {
		global $post, $GrainOpt;
		
		$grain_extended_comments = $GrainOpt->getYesNo(GRAIN_EXTENDEDINFO_ENABLED);
		$comments_open = $post->comment_status == "open";
		$link = '';

		// get the comment count
		$comment_count = grain_commentcount_string();

	    // display the comment popup link
		if( !$grain_extended_comments && !GRAIN_REQUESTED_OTEXINFO )
		{
			// get string
			$_hmn_comments_more = str_replace( "%", $comment_count, __("comments (%)", "grain") );
			
			// inf info enforcement is on, we skip directly to the comments on the popup
			$internal = ($GrainOpt->getYesNo(GRAIN_CONTENT_ENFORCE_INFO) && $GrainOpt->getYesNo(GRAIN_POPUP_JTC) ? '#comments' : '');
			// build link
			$link .= (!$comments_open ? '<del class="closed-comments">' : '');
			$link .= '<a class="open-popup" onclick="wpopen(this.href); return false" title="'.__("comments and details", "grain").'" accesskey="c" href="?comments_popup='.$post->ID.$internal.'">'.$_hmn_comments_more.'</a>';
			$link .= (!$comments_open ? '</del>' : '');
			
		}
		else
		{
			// get strings
			$_hmn_comments_more = str_replace( "%", $comment_count, __("details &amp; comments (%)", "grain") );
			$_hmn_comments_less = str_replace( "%", $comment_count, __("hide details", "grain") );
			
			// set text
			//$text = (isset($_SESSION['grain:info']) && $_SESSION['grain:info'] == 'on') ? $_hmn_comments_less : $_hmn_comments_more;
			$text = GRAIN_REQUESTED_EXINFO ? $_hmn_comments_less : $_hmn_comments_more;
			
			// select behavior (open/close)
			// $target = ($GrainOpt->getYesNo(GRAIN_CONTENT_ENFORCE_INFO) ? '#comments' : '#info');
			$target = "#info";
			$infomode = GRAIN_REQUESTED_EXINFO ? 'off' : 'on'.$target;
			
			// append info to permalink, based on whether it contains an ampersand or not
			$contains_amp = strstr(get_permalink($post->ID), '?');
			$permalink = get_permalink($post->ID) . ($contains_amp !== FALSE ? '&info='.$infomode : '?info='.$infomode);
			
			// build link
			$link .= (!$comments_open ? '<del class="closed-comments">' : '');
			$link .= '<a class="open-extended" title="'.__("comments and details", "grain").'" accesskey="i" rel="details" href="'.$permalink.'">'.$text.'</a>';
			$link .= (!$comments_open ? '</del>' : '');
		}
		
		return $link;
	}	
	
/* Header Menu */

	/**
	 * grain_inject_navigation_menu() - This function injects the navgation menu
	 *
	 * The navigation menu is defined in ./header.menu.php
	 *
	 * @since 0.1
	 * @access private
	 * @global $GrainOpt Grain options
	 */
	function grain_inject_navigation_menu($location) 
	{
		global $GrainOpt;
		$target = $GrainOpt->get(GRAIN_NAVBAR_LOCATION);
		
		if($location != $target ) return;
		
		global $post;
		
		if( $location == GRAIN_IS_HEADER )
			$class = "in-header";
		else
			$class = "in-body";
		?>

	<div id="headermenu" class="<?php echo $class; ?>">
		<?php
		include (TEMPLATEPATH . '/header.menu.php');
		?>
	</div>		
		
		<?php
	}	

?>