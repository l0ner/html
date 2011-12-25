<?php
/*     
	This file is part of Grain Theme for WordPress.
	------------------------------------------------------------------
	File version: $Id: searchform.php 52 2008-05-30 01:32:07Z sunside $
*/


?><form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
	<div>
		<input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="<?php _e("search"); ?>" />
	</div>
</form>
