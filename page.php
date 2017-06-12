<?php
/*
Template Name: 默认模版
*/
?>
<?php get_header(); ?>
    <!-- Banner begin -->
    <?php 
    global $ashu_option; 
    $bananer_url = $ashu_option['setting']['bananer_url'];
    if (!$bananer_url){ ?>
        <div class="banner">
        <img src="<?php bloginfo('template_directory');?>/images/default-bananer.jpg">
        </div>
    <?php } else {
    ?>

    <div class="banner">
        <img src="<?php echo $bananer_url ?>">
    </div>

    <?php } ?>
    <!-- Banner end -->
    <!-- Container begin -->
	<div class="inner container">
    <!-- Content begin-->
	   <div class="column-fluid">
	     <div class="content">
             <!-- CurrentPage begin -->
                <div class="cur-title">
                    <?php
                    $category = get_post_meta($post->ID, "cat-id", $single = true);
                    ?>
                    <b><?php  echo get_the_title($page->ID); ?></b>
                    <div class="breadcrumb">当前位置： <?php if (function_exists('cmp_breadcrumbs')) cmp_breadcrumbs(); ?></div>
                </div>
                <!-- CurrentPage end -->
                <!-- PostList begin -->
                <ul class="postlist">
                <?php
                query_posts($query_string.'&cat='.$category);
                if (have_posts()) : 
                     
                        while (have_posts()) : the_post(); ?>
                            <li><span><?php the_time('Y-m-d') ?></span><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></li>
                        <?php endwhile;?>
                
                <?php else : ?>
                    <li>暂无文章，请更新！</li>
                <?php endif;wp_reset_query();

                ?>
                </ul>
                <!-- PostList end -->
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
    <!-- Content end-->   
    <!-- Sidebar begin-->
    <?php get_sidebar(); ?>
    <!-- Sidebar end-->
    <div class="clearfix"></div>
    </div>
    <!-- Container end -->
<?php get_footer(); ?>