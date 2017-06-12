<!-- Slide begin -->
<div id="slidebanner">
	<div class="inner">
		<div class="xx xx-lt"><img src="<?php bloginfo('template_url'); ?>/images/xx-lt.png" alt="校训" /></div>
    	<ul id="slideshow">
		<?php

		$args = array('post_type'=>'slider','orderby'=>'menu_order','showposts'=> 5,'orderby'=>'date','order'=>'DESC');

		query_posts($args);

		?>

		<?php if (have_posts()) { ?>

			<?php while(have_posts()):the_post(); ?>

			<?php

			$wpg_img = get_post_meta($post->ID,'slider_pic',true);

			$wpg_link = get_post_meta($post->ID,'slider_link',true);

			?>

			<li><a href="<?php echo $wpg_link; ?>" rel="nofollow"><img src="<?php echo $wpg_img ?>" alt="<?php the_title(); ?>" /></a></li>

			<?php endwhile; ?>

		<?php } else { ?>
			<li><img src="<?php bloginfo('template_url'); ?>/images/bananerdefault.png"></li>
		<?php } wp_reset_query()?>

        </ul>
    	<div class="xx xx-rt"><img src="<?php bloginfo('template_url'); ?>/images/xx-rt.png" alt="校训" /></div>
	</div>
</div>    
<!-- Slide end -->
