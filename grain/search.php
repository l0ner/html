<?php 
/*     
	This file is part of Grain Theme for WordPress.
	------------------------------------------------------------------
	File version: $Id: search.php 52 2008-05-30 01:32:07Z sunside $
*/


	get_header(); 
?>

	<div id="content-archives" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle"><?php _e("Search results", "grain"); ?></h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__("&laquo; next page", "grain")) ?></div>
			<div class="alignright"><?php previous_posts_link(__("previous page &raquo;", "grain")) ?></div>
		</div>


                <div id="archive-list">
		<?php while (have_posts()) : the_post(); 
		?><div class="archive-post"><?php 
				
				if (!is_null($image = YapbImage::getInstanceFromDb($post->ID))) {
					echo '<div class="archive-photo">';
				
					// display
					do_action(GRAIN_ARCHIVE_BEFORE_THUMB);
					echo grain_mimic_ygi_archive($image, $post);
					do_action(GRAIN_ARCHIVE_AFTER_THUMB);
					
					echo '</div>';
				}
			?></div><?php 
			endwhile; ?>
		</div>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__("&laquo; next page", "grain")) ?></div>
			<div class="alignright"><?php previous_posts_link(__("previous page &raquo;", "grain")) ?></div>
		</div>
	
	<?php else : 
	
	grain_inject_error_searchform();
	
	endif; ?>
		
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>