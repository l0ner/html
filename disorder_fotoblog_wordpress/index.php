<?php include(TEMPLATEPATH . '/yapb_filter.php'); ?>
<?php get_header() ?>
		<?php if ( have_posts() ) : ?>
		<div id="nawigacja">
			<div class="poprzedni"><?php posts_nav_link('','','&laquo; Starsze wpisy') ?></div>
			<div class="nastepny"><?php posts_nav_link('','Nowsze wpisy &raquo;','') ?></div>
		</div>
		<?php while ( have_posts() ) : the_post(); ?>
		<div id="post">
			<div id="naglowek">
				<div id="tytul"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_date() ?>//<?php the_title(); ?>.</a></div>
				<div class="meta">Zamieszczony w: <?php the_category(', ') ?> o godzinie: <?php the_time('H:i') ?> dnia: <?php the_time('j-m-Y') ?> <?php edit_post_link(Edytuj); ?> <?php comments_popup_link('Brak komentarzy >>', '1 Komentarz >>', '% Komentarze >>'); ?> </div>
			</div>
			<!-- tu idzie fota-->
			<?php if (yapb_is_photoblog_post()): ?>
			<div id="foto">
				<div id="exif_holder" class="overlay" style="right:0;top:0;">
       				<div id="exif_panel">
			        <?echo get_exif();?>
      				</div>
				</div>
				<?php $uri_to_the_image = $post->image->uri; ?>
				<?php yapb_thumbnail('<a href="' . $uri_to_the_image . '" rel="lightbox">', array('class' => 'fota'), '</a>', array('w=780', 'q=100'), 'thumbnail'); ?>
			</div>
			<?php endif ?>
			<div id="tresc">
				<div id="tekst">
					<?php the_content('Czytaj dalej...'); ?>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
		<div id="nawigacja">
			<div class="poprzedni"><?php posts_nav_link('','','&laquo; Starsze wpisy') ?></div>
			<div class="nastepny"><?php posts_nav_link('','Nowsze wpisy &raquo;','') ?></div>
		</div>
		<?php else : ?>
			<div id="post">
				<div id="niemanic"><p>To czego szukasz najprawdopodobniej nie istnieje</p></div>
			</div>
		<?php endif; ?>
<?php get_footer() ?>
