<?php get_header(); ?>

<section id="index">
	<?php while ( have_posts() ) : the_post();
		$layout = get_field('layout');
		//$layout = 2;
		switch($layout):
			case 1:
			default:
		?>
			<?php 
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full_width'); 
				$image_alignment = get_field('featured_image_alignment');
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('layout-1'); ?> style="background-image: url(<?php echo $image[0]; ?>); background-position: center <?php echo $image_alignment; ?>">
				<div class="container">
					<?php  get_template_part('inc/post-header'); ?>
					<div class="read-more">
						<a class="read-more-btn white-btn" href="<?php the_permalink(); ?>"><?php _e("Continue Reading", THEME_NAME); ?></a>
					</div>
				</div>
			</article>
			<?php break; ?>
		<?php case 2: ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('layout-2'); ?>>
				<?php  get_template_part('inc/post-header'); ?>
				<div class="featured-images">
					<div class="inner container">
						<a href="<?php the_permalink(); ?>" >
							<?php echo get_the_post_thumbnail($post->ID, 'post_portrait'); ?>
						</a>
					</div>
				</div>
				<div class="read-more">
					<a class="read-more-btn white-btn" href="<?php the_permalink(); ?>"><?php _e("Continue Reading", THEME_NAME); ?></a>
				</div>
			</article>
			<?php break; ?>
		<?php case 3: ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('layout-3'); ?>>
				<?php get_template_part('inc/post-header'); ?>
				<div class="featured-images row">
					<div class="container">
						<div class="inner clearfix">
							<div class="span five">
								<?php echo get_the_post_thumbnail($post->ID, 'post_portrait');  ?>
							</div>
							<div class="span five">
								<?php $image = get_field('featured_image_02'); ?>
								<img src="<?php echo $image['sizes']['post_portrait']; ?>" />
							</div>
						</div>
					</div>
				</div>
			</article>
			<?php break; ?>
		<?php case 4: ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('layout-4 row'); ?>>
				<div class="container">
					<div class="inner clearfix">
						<div class="span five">
							<?php echo get_the_post_thumbnail($post->ID, 'post_portrait');  ?>
						</div>
						<div class="span five">
							<a href="<?php the_permalink(); ?>">
								<?php get_template_part('inc/post-header'); ?>
							</a>
						</div>
					</div>
				</div>
			</article>
			<?php break; ?>
		<?php case 5: ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('layout-5 row'); ?>>
				<div class="container">
					<div class="inner clearfix">
						<div class="span five">
							<?php get_template_part('inc/post-header'); ?>
						</div>
						<div class="span five">
							<?php echo get_the_post_thumbnail($post->ID, 'post_portrait');  ?>	
						</div>
					</div>
				</div>
			</article>
				<?php break; ?>
		<?php case 6: ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('layout-6'); ?>>
				<div class="container">
					<?php  get_template_part('inc/post-header'); ?>
					<div class="read-more">
						<a class="read-more-btn white-btn" href="<?php the_permalink(); ?>#disqus_thread"><?php _e("Leave a comment", THEME_NAME); ?></a>
					</div>
				</div>
			</article>
				<?php break; ?>
		<?php endswitch; ?>
	<?php endwhile; // end of the loop. ?>
	<footer class="footer">
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

