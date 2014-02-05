<?php get_header(); ?>
<section id="archive">
	<div class="container inner">
		<header class="archive-header header">
			<h2 class="title"><?php _e("Archive", THEME_NAME); ?></h2>
			<div class="filters clearfix">
				<div class="span two omega alpha hide-on-tablet">
					<p class="label">
						<?php _e("You are viewing", THEME_NAME); ?>
						<span class="red"><?php echo single_term_title(); ?></span>
					</p>
				</div>
				<form class="span eight right omega alpha break-on-tablet" action="" mathod="GET">
					<input type="text" class="query" name="s" placeholder="Search" value="<?php echo esc_attr( get_search_query() ); ?>" />
					<?php wp_dropdown_categories(array('class' => 'category', 'show_option_all' => __("All Categories", THEME_NAME))); ?>
					<select class="date">
						<option value=""><?php _e("Select a date", THEME_NAME); ?></option>
						<?php wp_get_archives(array('format' => 'option')); ?>
					</select>
					
					<button type="submit" class="submit-btn search-btn" ></button>
				</form>
			</div>
		</header>
		<div class="posts clearfix">
			<?php $i = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php $class = ($i == 0) ? 'first': ''; ?>
			<?php if($i == 0): ?>
				<?php //$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full_width'); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('large'); ?>>
					<div class="featured-image">
						<?php the_post_thumbnail('thumbnail_large'); ?>
					</div>
					<header class="header post-header">
						<?php get_template_part('inc/post-category'); ?>
						<h2 class="title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						<div class="excerpt">
							<?php the_excerpt(); ?>
						</div>
						<div class="read-more">
							<a class="read-more-btn white-btn" href="<?php the_permalink(); ?>">&#9654;</a>
						</div>
					</header>
				</article>
			<?php else: ?>
				<?php ///$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full_width'); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
					<a href="<?php the_permalink(); ?>">
						<div class="featured-image">
							<?php the_post_thumbnail('thumbnail_large'); ?>
						</div>
						<header class="header post-header">
							<h4 class="title"><?php _e("View Post", THEME_NAME); ?><?php //the_title(); ?></h4>
						</header>
					</a>
				</article>
			<?php endif; ?>
			<?php $i++; ?>
			<?php endwhile; // end of the loop. ?>
		</div>
		<footer class="archive-footer footer">
			<div class="pagination">
				<?php
				global $wp_query;

				$big = 999999999;
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages
				) );
				?>
			</div>
		</footer>
</section><!-- #page -->
<?php get_footer(); ?>