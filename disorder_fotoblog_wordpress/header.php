<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/img/fav.png"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" />
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/mootools-1.11.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/blog.js"></script>
</head>
<body>
	<div id="center">
		<div id="logo_container">
			<div id="logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/logo1.png" alt="<?php bloginfo('name'); ?>"></a></div>
			<div class="pasek"></div>
		</div>
		<div id="menu">
			<ul class="menu">
					<li>MENU:</li>
					<?php wp_list_pages('depth=1&title_li=&sort_column=ID'); ?>
				</ul>
				<div class="pasek"></div>
		</div>
