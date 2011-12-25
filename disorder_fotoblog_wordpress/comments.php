			<?php if ($comments) : ?>
			<div id="komentarze">
				<?php foreach ($comments as $comment) : ?>
				<div class="komentarz">
					<div class="meta"><?php comment_author_link() ?> @ <?php comment_time() ?> <?php comment_date('j-m-Y') ?></div>
					<div class="tresc"><?php comment_text() ?></div>
				</div>
				<?php endforeach; /* end for each comment */ ?>
				<?php else : // this is displayed if there are no comments so far ?>
  					<?php if ('open' == $post-> comment_status) : ?>
  						<div class="komentarz"><p class="closed_none">Brak komentarzy!</p></div>
  					<?php else : // comments are closed ?><!-- If comments are closed. -->
  						<div class="komentarz"><p class="closed_none">Komentowanie wyłączone.</p></div>
  
 					<?php endif; ?>
			<?php endif; ?>
			</div>
			<?php if ('open' == $post-> comment_status) : ?>
			<div id="skomentuj"><h2>Zostaw komentarz:</h2>
				<form action="<?php echo get_settings('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
					<?php if ( $user_ID ) : ?>
						<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
					<?php else : ?>
					<input type="text" name="author" id="author" class="styled" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
					<input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" />
					<label for="author"><small>Imię:</small></label><br />
					<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
					<label for="email"><small>E-mail (wymagany)(nie zostanie opublikowany):</small></label><br />
					<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
					<label for="url"><small>Adres www:</small></label><br />
					<?php endif; ?>
					<textarea name="comment" id="comment" cols="111%" rows="10" tabindex="4"></textarea>
					<input name="submit" type="submit" id="submit" tabindex="5" value="Komentuj!" />
				</form>
			<?php endif; ?>
