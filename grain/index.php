<?php 
/*     
	This file is part of Grain Theme for WordPress.
	------------------------------------------------------------------
	File version: $Id: index.php 191 2008-06-24 20:00:06Z sunside $
*/

	if(!defined("GRAIN_THEME_VERSION")) {
		header("HTTP/1.0 403 Forbidden");
		@require_once(dirname(__FILE__)."/func/version.php");
		die("Please do not access this place directly.");
	}

	grain_set_expires_header();

	grain_start_buffering();
	grain_set_ispopup(FALSE);
	get_header(); 
	
	?>

	<div id="content-post" class="widecolumn">

<?php 

	// Prepare
	$grain_page_displayed = false;
	$hadPosts = have_posts();

	// Check if there are pages
	if ($hadPosts):
	
		while( have_posts() ) : the_post();
		
			// skip private pages
			if( is_private() ) continue;
		
			// set the currently visited page
			grain_announce_page( $post->ID );
		
			// set a flag that we have displayed a page
			$grain_page_displayed = true;
		
			?>
			<div class="post" id="post-<?php the_ID(); ?>">

			<?php 

			// inject widget sidebar
			grain_inject_sidebar_above();

			// inject navigation bar
			grain_inject_navigation_menu(GRAIN_IS_BODY_BEFORE); 

			// check post type and for attached image
			if( grain_posttype($post->ID) == GRAIN_POSTTYPE_SPLITPOST ):
			
				grain_do_splitpost_logic();
			
			elseif( grain_posttype($post->ID) == GRAIN_POSTTYPE_PHOTO ):

				grain_do_regularpost_logic();
		
			endif; // if( grain_posttype() == GRAIN_POSTTYPE_PHOTO ):
		
			// inject navigation bar
			grain_inject_navigation_menu(GRAIN_IS_BODY_AFTER);

			// inject widget sidebar
			grain_inject_sidebar_below();
	
			// Do extended info logic
			grain_do_extendedinfo_logic();

				
			?>				
			</div>

		<?php 

		// ensure that only ONE item is displayed
		break; // // while (have_posts()) : the_post();
		endwhile; // while (have_posts()) : the_post();

	endif;


	// if there was no post or if we could not find one to display, show an error message
	if( !$hadPosts || $grain_page_displayed === false ) 
	{
		// set the currently visited page
		grain_announce_page( 0 );
		
		// display an error
		if( grain_getpostcount() == 0 ) 
		{
			grain_inject_photopage_error(__("There is currently no page to display. Please check back later.", "grain"));	
		}
		else 
		{
			grain_inject_error_searchform();
		}
	}
	
	?>
	</div> <!-- content-post -->

<?php 

	get_footer(); 
	grain_endSession();
	grain_finish_buffering();

?>
<!-- (C) stat24 / Strona glowna -->
<script type="text/javascript">
<!--
document.writeln('<'+'scr'+'ipt type="text/javascript" src="http://s3.hit.stat24.com/_'+(new Date()).getTime()+'/script.js?id=bVAwOweiJ5Pekv4oTd8He2Xj74E1a2dHM0YY.ynKCib.w7/l=11"></'+'scr'+'ipt>');
//-->
</script>