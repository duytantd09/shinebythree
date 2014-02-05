<?php
$categories = get_the_category();
$category = (isset($categories[0])) ? get_top_level_category($categories[0]->term_id) : null;
if($category):
?>
<div class="category">
	<a href="<?php echo get_category_link($category->term_id);?>" title="<?php esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ); ?>"><?php echo $category->name; ?></a>
</div>
<?php endif; ?>