<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="icon" type="image/png" href="img/fav.png"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/flexcrollstyles.css" type="text/css" />
<script type='text/javascript' src="<?php bloginfo('stylesheet_directory'); ?>/script/flexcroll.js"></script> <!--custom scrollbars-->
</head>
<body>
	<div id="center"><!--center begin-->
		<div id="lewa"><!--lewa begin-->
			<div id="logo"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/logo.png"></div>
			<div id="menu"><!--menu begin-->
				<span style="font-size: 15px;">Menu:</span>
				<div class="pasek"></div>
				<ul class="menu">
					<?php wp_list_pages('depth=1&title_li=&sort_column=ID'); ?>
					<?php wp_list_categories('depth=1&title_li=&sort_column=ID'); ?>
				</ul>
			</div><!--menu end-->
			<div id="stopka"><!--stopka begin-->
				<div class="pasek"></div>
				Copyright © 2009 Pawel Soltys.<br />
				Powered by <a href="http://wordpress.org">Wordpress</a><br />
				CC:BY-SA-NC
				<div class="pasek" ></div>
			</div><!--stopka end-->
		</div><!--lewa end-->
		<div id="prawa"><!--prawa begin-->

			<?php query_posts("cat=3"); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div id="blog"><!--blog begin-->
				<div class="tytul">Ostatnio na blogu:</div>
				<div class="koment"><?php next_posts_link('&lt;&lt;Poprzedni wpis') ?></div>
				<div class="pasek"></div>
				<div id="post" class='flexcroll'><span class="tytul_post"><?php the_date() ?> @ <?php the_time() ?>: <?php the_title(); ?></span><br /><?php the_content(' Czytaj dalej...', strip_teaser, 'more_file'); ?></div>
				<div class="pasek"></div>
				<div class="meta">Zamieszczono o: 12:25 15-02-2009</div>
				<div class="koment"><a href="single.html">Brak komentarzy</a></div>
			</div><!--blog end-->
			<?php endwhile; ?><?php endif; ?>
			<div id="photoblog"><!--photoblog begin-->
				<div class="tytul">Ostatnio na fotoblogu:</div>
				<div class="koment"><a href="#">&lt;&lt;Poprzedni wpis</a></div>
				<div class="pasek"></div>
				<div id="fota">
					<a href="single.html"><img class="fota" src="<?php bloginfo('stylesheet_directory'); ?>/img/1.jpg" align="center" alt="obrazek1"/></a>
					<div id="wiecej_fota"><a href="single.html">Oglądaj duże&gt;&gt;</a></div>
				</div>
				<div class="pasek"></div>
				<div class="meta">Zamieszczono o: 12:25 15-02-2009</div>
				<div class="koment"><a href="single.html">Brak komentarzy</a></div>
			</div><!--photoblog end-->
		</div><!--prawa end-->
	</div><!--center end-->
</body>
</html>

