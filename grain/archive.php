<?php 
/*     
	This file is part of Grain Theme for WordPress.
	------------------------------------------------------------------
	File version: $Id: archive.php 176 2008-06-23 09:47:19Z sunside $	
*/

	get_header(); 
?>

	<div id="content" class="narrowcolumn">

		<?php if (have_posts()) : ?>

		 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

	<?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle"><?php

			$string = __("Archive for category %CATEGORY.", "grain");
			$string = str_replace('%CATEGORY', '<span class="name">'.single_cat_title('', false).'</span>', $string);
			echo $string;

		?></h2>
	
	<?php /* If this is a tag archive */ } elseif (is_tag()) { ?>
		<h2 class="pagetitle"><?php

			$string = __("Archive for tag %TAG.", "grain");
			$string = str_replace('%TAG', '<span class="name">'.single_cat_title('', false).'</span>', $string);
			echo $string;

		?></h2>
	
 	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php
		
			$string = __("Daily archive for %DATE.", "grain");
			$string = str_replace('%DAY', apply_filters('the_time', get_the_time( 'l' ), 'l'), $string);
			$format = grain_filter_dt($GrainOpt->get(GRAIN_DTFMT_DAILYARCHIVE));
			$string = str_replace('%DATE', apply_filters('the_time', get_the_time( $format ), $format), $string);
			echo $string;
			
		?></h2>
		
	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php
		
			$string = __("Monthly archive for %DATE.", "grain");
			$format = grain_filter_dt($GrainOpt->get(GRAIN_DTFMT_MONTHLYARCHIVE));
			$string = str_replace('%DATE', apply_filters('the_time', get_the_time( $format ), $format), $string);
			echo $string;
		?></h2>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle"><?php
			$string = __("Yearly archive for %YEAR.", "grain");
			$string = str_replace('%YEAR', apply_filters('the_time', get_the_time( 'Y' ), 'Y'), $string);
			$string = str_replace('%DATE', apply_filters('the_time', get_the_time( 'Y' ), 'Y'), $string);
			echo $string;
			?></h2>
		
	  <?php /* If this is a search */ } elseif (is_search()) { ?>
		<h2 class="pagetitle"><?php echo __("Search results", "grain"); ?></h2>

	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle"><?php echo __("Archive of authors", "grain"); ?></h2>

		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle"><?php echo __("Blog archive", "grain"); ?></h2>

		<?php } ?>


		<div id="navigation-top" class="navigation">
			<div class="alignleft"><?php next_posts_link(__("&laquo; next page", "grain")) ?></div>
			<div class="alignright"><?php previous_posts_link(__("previous page &raquo;", "grain")) ?></div>
		</div>

		<div id="archive-list">
		<?php while (have_posts()) : the_post(); ?><div class="archive-post"><?php 
				
				$image = NULL;
				if (class_exists(YapbImage)) $image = YapbImage::getInstanceFromDb($post->ID);
				
				// display
				echo '<div class="archive-photo">';
				do_action(GRAIN_ARCHIVE_BEFORE_THUMB);
				echo grain_mimic_ygi_archive($image, $post, "archive");
				do_action(GRAIN_ARCHIVE_AFTER_THUMB);					
				echo '</div>';
			?></div><?php 
			endwhile; ?>
		</div>

		<div id="navigation-bottom" class="navigation">
			<div class="alignleft"><?php next_posts_link(__("&laquo; next page", "grain")) ?></div>
			<div class="alignright"><?php previous_posts_link(__("previous page &raquo;", "grain")) ?></div>
		</div>
	
	<?php else : 

		grain_inject_error_searchform();

	endif; ?>
		
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
