<?php 
/*     
	This file is part of Grain Theme for WordPress.
	------------------------------------------------------------------
	File version: $Id: page.php 52 2008-05-30 01:32:07Z sunside $
*/



	get_header(); 
?>

	<div id="content-page" class="narrowcolumn">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content('<p class="serif"><strong>'.__("Read the whole story...", "grain").'</strong></p>'); ?>
	
				<?php link_pages('<p><strong>'.__("Pages:", "grain").'</strong> ', '</p>', 'number'); ?>
	
			</div>
		</div>
	  <?php endwhile; endif; ?>
	</div>

<?php get_sidebar(); ?>
<!-- (C) stat24 / podstrony -->
<script type="text/javascript">
<!--
document.writeln('<'+'scr'+'ipt type="text/javascript" src="http://s3.hit.stat24.com/_'+(new Date()).getTime()+'/script.js?id=10aan28_o0qClOSo1810N4ZizQAFEo_uCUhFGiWwrcH.n7/l=11"></'+'scr'+'ipt>');
//-->
</script>
<?php get_footer(); ?>
