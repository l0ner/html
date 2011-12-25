<?php get_header() ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div id="post">
			<div id="naglowek">
				<div id="tytul">//<?php the_title(); ?>.</div>
				<div class="meta"><?php edit_post_link(Edytuj); ?></div>
			</div>
			<div id="tresc">
				<div id="tekst">
					<?php the_content(); ?>
					
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
