<header class="header post-header">
	<?php get_template_part('inc/post-category'); ?>
	<h2 class="title">
		<?php if(!is_single()): ?>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<?php else: ?>
		<?php the_title(); ?>
		<?php endif; ?>
	</h2>
	<div class="meta">
		<span class="date"><?php the_date(); ?></span>
		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
		<a class="comments" data-disqus-identifier="<?php the_permalink(); ?>" href="<?php the_permalink(); ?>#disqus_thread"><?php comments_number( __( '0', THEME_NAME ), __( '1', THEME_NAME ), __( '% Comments', THEME_NAME ) ); ?></a>
		<?php endif; ?></span>
		<span class="shares addthis_counter" addthis:url="<?php the_permalink(); ?>"><span></span></span>
	</div>
	<div class="excerpt">
		<?php the_excerpt(); ?>
	</div>
</header>