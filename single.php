<?php get_header(); ?>

<div id="single">
	<?php while ( have_posts() ) : the_post(); ?>
	<?php $layout = get_field('layout'); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('layout-'.$layout); ?> style="<?php ?>">
		<?php switch($layout): 
			case 1:
			default: ?>
				<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full_width'); ?>
				<?php if($image): ?>
				<div class="featured-image full-width-image attachment-fixed" style="background-image: url(<?php echo $image[0]; ?>);">
					<img src="<?php echo $image[0]; ?>" />
				</div>
				<?php endif; ?>
				<?php get_template_part('inc/post-header'); ?>
				<?php break; ?>
			<?php case 2: ?>
				<?php get_template_part('inc/post-header'); ?>
				<div class="featured-image">
					<div class="container inner">
						<?php echo get_the_post_thumbnail($post->ID, 'large');  ?>
					</div>
				</div>
				<?php break; ?>
			<?php case 3: ?>
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
				<?php break; ?>
			<?php case 4: ?>
				<div class="row">
					<div class="container">
						<div class="inner clearfix">
							<div class="span five">
								<?php echo get_the_post_thumbnail($post->ID, 'post_portrait');  ?>
							</div>
							<div class="span five">
								<?php get_template_part('inc/post-header'); ?>
							</div>
						</div>
					</div>
				</div>
				<?php break; ?>
			<?php case 5: ?>
				<div class="row">
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
				</div>
			<?php break; ?>
		<?php endswitch; ?>
		<?php get_template_part('inc/content'); ?>

	</article>
	<footer class="footer">
		<div class="inner container">

			<?php get_template_part('inc/share-links'); ?>
			
			<?php if ( comments_open() || get_comments_number() ) comments_template(); ?>

			<nav class="navigation clearfix">
				<?php $prev_post = get_adjacent_fukn_post('previous'); ?>
				<?php if($prev_post):?>
				<a href="<?php echo get_permalink($prev_post->ID);?>" class="span five previous">
					<?php
	                $image_id = get_post_thumbnail_id($prev_post->ID);
	                $image = wp_get_attachment_image_src( $image_id, 'thumbnail' );
	                if($image) :
	                ?>
					<div class="span two featured-image thumbnail">
						<img src="<?php echo $image[0]?>" class="scale" />
					</div>
					<?php endif; ?>
					<div class="span eight content <?php if($image) echo 'has-thumbnail'; ?>">
						<p class="label"><?php _e("Previous Post", THEME_NAME); ?></p>
						<h5 class="title uppercase no-margin"><?php echo get_the_title($prev_post->ID) ?></h5>
					</div>
				</a>
				<?php endif; ?>
				
				<?php $next_post = get_adjacent_fukn_post('next');?>
				<?php if($next_post):?>
				<a href="<?php echo get_permalink($next_post->ID);?>" class="span five next">
					<?php
	                $image_id = get_post_thumbnail_id($next_post->ID);
	                $image = wp_get_attachment_image_src( $image_id, 'thumbnail' );
	                if($image) :
	                ?>
					<div class="span two featured-image thumbnail right">
						<img src="<?php echo $image[0]?>" class="scale" />
					</div>
					<?php endif; ?>
					<div class="span eight content text-right right <?php if($image) echo 'has-thumbnail'; ?>">
						<p class="label"><?php _e("Next Post", THEME_NAME); ?></p>
						<h5 class="title uppercase no-margin"><?php echo get_the_title($next_post->ID) ?></h5>
					</div>
					
				</a>
				<?php endif; ?>
			</nav>
			<?php wp_enqueue_script('masonry') ?>
			<div id="spotlight">
				<div class="inner">
					<header class="header spotlight-header">
						<h3 class="title"><?php _e("Spotlight", THEME_NAME); ?></h3>
						<?php $archive_page = get_field('archive_page', 'options'); ?>
						<a class="archive-btn" href="<?php get_permalink($archive_page->ID); ?>"><?php _e("View full archive", THEME_NAME); ?></a>
					</header>
					<div class="widget-area masonry clearfix" data-masonry-options="{ 'columnWidth': '.grid-sizer', 'itemSelector': '.item'}" >
						<div class="grid-sizer"></div>
						<?php dynamic_sidebar('spotlight'); ?>			
					</div>
				</div>
			</div>
		</div>
	</footer>
	<?php endwhile; // end of the loop. ?>
</div><!-- #page -->
<?php get_footer(); ?>