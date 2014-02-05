<div class="content">
	<?php $id = (isset($id)) ? $id : $post->ID;?>

	<?php if($content = get_the_content($id)): ?>
	<div class="post-content">
		<div class="inner container">
			<?php the_content(); ?>
		</div>
	</div>
	<?php endif; ?>

	<?php $i = 0; ?>
	<?php if(get_field('content', $id)): ?>
	<?php while (has_sub_field('content', $id)) : ?>
	<?php
		$layout = get_row_layout();
		switch($layout){

			case 'row':	
				if(get_sub_field('column')):
	?>
				<div class="row">
					<div class="container">
						<div class="inner">

						<?php $total_columns = count( get_sub_field('column', $id)); ?>
						<?php while (has_sub_field('column', $id)) : ?>
							<?php
							switch($total_columns){
								case 2:
									$class = 'five';
									break;
								case 3:
									$class = 'one-third';
									break;
								case 4:
									$class = 'one-fourth';
									break;
								case 5:
									$class = 'one-fifth';
									break;
								case 1:
								default:
									$class = 'ten';
									break;
							} ?>
							<div class="break-on-tablet span <?php echo $class; ?>" >
								<?php 
								the_sub_field('content');
								// $sub_layout = get_row_layout(); 
								// switch($sub_layout):
									
								// 	case 'editor':
								// 		the_sub_field('content');
								// 		break;
								// 	case 'image':
								// 		$image = get_sub_field('image');
									//	<img src="<?php echo $image['url'];" />
									
									//	break;
								
								//endswitch; ?>
							</div>
						<?php endwhile; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
			<?php break;
			case 'scroller':	
				if($items = get_sub_field('items')):
			?>
			<div class="scroller">
				<div class="container">
					<div class="scroller-mask">
						<?php foreach($items as $item): ?>
						<div class="scroll-item" data-id="<?php echo $item['id']; ?>">
							<div class="image">
								<img src="<?php echo $item['sizes']['large']; ?>" />
							</div>
							<div class="description content text-<?php the_field('description_alignment', $item['id']) ?>">
								<?php echo $item['description']; ?>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<nav class="scroller-navigation">
						<button class="prev-btn"></button>
	                	<button class="next-btn"></button>
					</nav>
				</div>
			</div>
				<?php endif; ?>
				<?php break; 
			case 'full_width_image':
				$image = get_sub_field('image');
				if($image):
					$attachment = get_sub_field('attachment');
			?>
			<div class="full-width-image attachment-<?php the_sub_field('attachment'); ?>" style="background-image: url(<?php echo $image['sizes']['full_width']; ?>); padding-top: <?php the_sub_field('aspect_ratio'); ?>%;">
				<img src="<?php echo $image['sizes']['full_width']; ?>" />
			</div>
				<?php endif; ?>
				<?php break; 
			case 'title':	
			?>
				<header class="page-header">
					<div class="inner container">
						<h2 class="title"><?php echo get_the_title($id); ?></h2>
					</div>
				</header>
				<?php break; ?>
			
		<?php } ?>
	<?php $i++; ?>
	<?php endwhile; ?>
	<?php endif; ?>
</div>