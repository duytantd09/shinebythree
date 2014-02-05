<ul class="social-links">
	<?php if($facebook_url = get_field('facebook_url', 'options')): ?>
	<li>
		<a class="facebook-btn" href="<?php echo $facebook_url;?>" target="_blank"></a>
	</li>
	<?php endif; ?>
	<?php if($twitter_url = get_field('twitter_url', 'options')): ?>
	<li>
		<a class="twitter-btn" href="<?php echo $twitter_url;?>" target="_blank"></a>
	</li>
	<?php endif; ?>
	
	<?php if($instagram_url = get_field('instagram_url', 'options')): ?>
	<li>
		<a class="instagram-btn" href="<?php echo $instagram_url;?>" target="_blank"></a>
	</li>
	<?php endif; ?>
	
	<?php if($tumblr_url = get_field('tumblr_url', 'options')): ?>
	<li>
		<a class="tumblr-btn" href="<?php echo $tumblr_url;?>" target="_blank"></a>
	</li>
	<?php endif; ?>
	
	<?php if($pinterest_url = get_field('pinterest_url', 'options')): ?>
	<li>
		<a class="pinterest-btn" href="<?php $pinterest_url;?>" target="_blank"></a>
	</li>
	<?php endif; ?>
	
	<?php if($youtube_url = get_field('youtube_url', 'options')): ?>
	<li>
		<a class="youtube-btn" href="<?php $youtube_url;?>" target="_blank"></a>
	</li>
	<?php endif; ?>
	
</ul>