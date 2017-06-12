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
         <!-- Post Begin-->
			<?php while (have_posts()) : the_post(); ?>
            <article class="post"> 
				<h1 class="post-title"><?php the_title(); ?></h1>
                <p class="postmeta">时间：<?php the_time('Y-m-d'); ?> &nbsp;&nbsp;丨&nbsp;&nbsp; 分类：<a href="<?php $category= get_the_category();echo get_category_link($category[0]->term_id ) ?>"><?php  echo$category[0]->cat_name; ?></a> &nbsp;&nbsp;丨&nbsp;&nbsp; 浏览：<?php post_views('', '次'); ?>
                </p>
                <div class="entry">
                	<?php the_content(); ?>
				</div>
                <!-- Share begin -->
                <div class="share">
                    <span id="sharebtn">分享：</span>
                    <!-- Baidu Button BEGIN -->
                    <div id="bdshare" class="bdsharebuttonbox">
                        <a href="#" class="bds_more" data-cmd="more"></a>
                        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                        <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                        <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
                        <a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a>
                        <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                        <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                        <a href="#" class="bds_evernotecn" data-cmd="evernotecn" title="分享到印象笔记"></a>
                        <a href="#" class="bds_youdao" data-cmd="youdao" title="分享到有道云笔记"></a></div>
                        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                    <!-- Baidu Button END -->
                </div>
                <!-- Share end -->
                <div class="clearfix"></div>
                <!-- PostPrevNext begin -->
                <div class="post-prev-next">
			 	<?php if (get_previous_post()) { previous_post_link('上一篇: %link');} else {echo "没有了，已经是最后文章";} ?>
                    <br />
			 	<?php if (get_next_post()) { next_post_link('下一篇: %link');} else {echo "没有了，已经是最新文章";} ?>
			    </div>
                <!-- PostPrevNext end -->
                <?php endwhile; ?>
                <!-- Related begin -->
                <?php
                $backup = $post;
                $tags = wp_get_post_tags($post->ID);
                $tagIDs = array();
                if ($tags) {
                    echo '<div class="related"><h2>相关文章</h2>';
                    echo '<ul class="post-list">';
                    $tagcount = count($tags);
                    for ($i = 0; $i < $tagcount; $i++) {
                        $tagIDs[$i] = $tags[$i]->term_id;
                    }
                    $args=array(
                        'tag__in' => $tagIDs,
                        'post__not_in' => array($post->ID),
                        'showposts'=>8, // 显示相关日志篇数 
                        'caller_get_posts'=>1
                    );
                    $my_query = new WP_Query($args);
                    if( $my_query->have_posts() ) {
                        while ($my_query->have_posts()) : $my_query->the_post(); ?>
                            <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile;
                        echo '</ul></div>';
                    } else { ?>
                    <ul class="post-list">
                    <?php
                    query_posts(array('orderby' => 'rand', 'showposts' => 8)); //显示随机日志篇数
                    if (have_posts()) :
                        while (have_posts()) : the_post();?>
                        <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile;endif; ?>
                    </ul>
                <?php }
                }
                $post = $backup;
                wp_reset_query();
                ?>
                <!-- Related end -->
            </article>
        <!-- Post end-->
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