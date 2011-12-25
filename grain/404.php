<?php 
/*     
	This file is part of Grain Theme for WordPress.
	------------------------------------------------------------------
	File version: $Id: 404.php 8 2008-05-18 18:58:36Z sunside $
	
*/


	get_header(); 
?>

	<div id="content" class="narrowcolumn">

		<h2 class="center"><?php _e("Error 404 - Not found!", "grain"); ?></h2>
		<p><?php _e("Would you like to search for something?", "grain"); ?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
