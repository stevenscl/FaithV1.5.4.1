<?php get_header(); ?>
    <div class="banner">
    	<?php
			$bannerimg = 'default-banner.jpg';
		?>
		<img src="<?php bloginfo('template_directory');?>/images/<?php echo("$bannerimg") ?>">
    </div>
	<div class="inner container">
	   <div class="column-fluid">
	     <div class="content">
		 <div class="cur-title">
               <!-- breadcrumb begin -->
               <b>"<?php echo $s; ?>"</b>
			         <div class="breadcrumb">当前位置： <?php if (function_exists('cmp_breadcrumbs')) cmp_breadcrumbs(); ?></div>
          </div>
                <!-- breadcrumb end -->
            	<?php if (have_posts()) : ?>
                	<ul class="postlist">
						<?php while (have_posts()) : the_post(); ?>
                        <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><span><?php the_time('Y-m-d'); ?></span></li>
                    	<?php endwhile; ?>
               <?php else : ?>
                  <li>暂无文章，请更新！</li>
                <?php endif; ?>
                </ul>
                <div class="clearfix"></div>
	           <?php
                the_posts_pagination( array(
                'mid_size' => 6,
                'prev_text'          =>上页,
                'next_text'          =>下页,
                'before_page_number' => '<span class="meta-nav screen-reader-text">第 </span>',
                'after_page_number' => '<span class="meta-nav screen-reader-text"> 页</span>',
                ) );
                ?>
		</div>
		
	</div> 
		<?php get_sidebar(); ?>
    <div class="clearfix"></div>
    </div>
<?php get_footer(); ?>
