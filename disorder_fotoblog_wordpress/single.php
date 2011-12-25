<?php get_header() ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div id="nawigacja">
			<div class='poprzedni'><?php next_post_link('%link', '&laquo; Poprzedni post') ?></div>
			<div class='nastepny'><?php previous_post_link('%link', 'Następny post &raquo;') ?></div>
		</div>
		<div id="post">
			<div id="naglowek">
				<div id="tytul">//<?php the_title(); ?>.</div>
				<div class="meta">Zamieszczony w: <?php the_category(', ') ?> o godzinie: <?php the_time('H:i') ?> dnia: <?php the_time('j-m-Y') ?> <?php edit_post_link(Edytuj); ?></div>
			</div>
			<?php if (yapb_is_photoblog_post()): ?>
				<?php $uri_to_the_image = $post->image->uri; ?>
				<?php yapb_thumbnail('<div id="foto"><a href="' . $uri_to_the_image . '" rel="lightbox">', array('class' => 'fota'), '</a></div>', array('w=780', 'q=100'), 'thumbnail'); ?>
			<?php endif ?>
			<div id="tresc">
				<div id="tekst">
					<?php the_content(); ?>
				</div>
			</div>
			<?php comments_template(); ?>
		</div>
		<?php endwhile; ?>
		<?php else : ?>
			<div id="post">
				<div id="niemanic"><p>To czego szukasz najprawdopodobniej nie istnieje</p></div>
			</div>
		<?php endif; ?>
<?php get_footer() ?>
