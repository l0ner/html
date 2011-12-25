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
				<div class="meta">Zamieszczony w: <?php the_category(', ') ?> o godzinie: <?php the_time('H:i') ?> dnia: <?php the_time('j-m-Y') ?> <?php edit_post_link(Edytuj); ?></div>
			</div>
			<div id="tresc">
				<div id="tekst">
					<?php the_excerpt(); ?>
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
