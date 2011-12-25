<?php
/*
Template Name: YAPB Photo Mosaic Page (Prototype)
*/
?>
<?php get_header() ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php global $post; ?>


		<div id="post">
			    <?php 
  // Let's get the last 1000 photoblog entries
  $photoblog_posts = get_posts(
    //'category=' . get_option('yapb_default_post_category') .
    '&numberposts=1000'
  );

  // Let's define the needed thumbnail format
  $thumbConfig = array(
    'q=100',
    'h=120',
    'zc=1',
    'fltr[]=usm|60|0.5|3'
  );
?>
			<div id="naglowek">
				<div id="tytul">//<?php the_title(); ?>.</div>
				<div class="meta"><?php edit_post_link(Edytuj); ?></div>
			</div>
			<div id="tresc">
				<div id="tekst">
					
<div class="ngg-galleryoverview">
  <?php foreach($photoblog_posts as $photoblog_post): ?>

    <?php if (!is_null($image = YapbImage::getInstanceFromDb($photoblog_post->ID))): ?>

      <div class="ngg-gallery-thumbnail-box"><div class="ngg-gallery-thumbnail"><a title="<?php echo $photoblog_post->post_title ?>" href="<?php echo get_permalink($photoblog_post->ID) ?>"><img src="<?php echo $image->getThumbnailHref($thumbConfig) ?>" alt="<?php echo $photoblog_post->post_title ?>" /></a></div></div>

    <?php endif ?>

  <?php endforeach ?>
</div>
					
				</div>
			</div>
		</div>
		<?php endwhile; ?>
		<?php else : ?>
			<div id="post">
				<div id="niemanic"><p>To czego szukasz najprawdopodobniej nie istnieje</p></div>
			</div>
		<?php endif; ?>
<?php get_footer() ?>
