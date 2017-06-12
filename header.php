<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Description & Keywords SEO -->
		<?php
		$description = '';
		$keywords = '';
		if (is_home() || is_page()) {
			$description = "南京邮电大学通达学院团委官方网站";
			$keywords = "南京邮电大学,南京邮电大学通达学院, 团委, 团委官网,南邮通达团委官网,南京邮电大学通达学院团委官网";
		}
		elseif (is_single()) {
   			$description1 = get_post_meta($post->ID, "description", true);
   			$description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));
   			$description = $description1 ? $description1 : $description2;
   			$keywords = get_post_meta($post->ID, "keywords", true);
   			if($keywords == '') {
   				$tags = wp_get_post_tags($post->ID);
   				foreach ($tags as $tag ) {
   					$keywords = $keywords . $tag->name . ", ";    
   				}
      			$keywords = rtrim($keywords, ', ');
      		}
      	}
		elseif (is_category()) {
   			$description = category_description();
   			$keywords = single_cat_title('', false);
		}
		elseif (is_tag()) {
   			$description = tag_description();
   			$keywords = single_tag_title('', false);
		}
		$description = trim(strip_tags($description));
		$keywords = trim(strip_tags($keywords));
		?>
		<meta name="description" content="<?php echo $description; ?>" />
		<meta name="keywords" content="<?php echo $keywords; ?>" />
		<title><?php if ( is_home() || is_front_page()) {
        bloginfo('name'); echo " - "; bloginfo('description');
    } elseif ( is_category() ) {
        single_cat_title(); echo " - "; bloginfo('name');
    } elseif (is_single() || is_page() ) {
        single_post_title();echo " - "; bloginfo('name');
    }  elseif (is_tag() ) {
        single_tag_title();echo " - "; bloginfo('name');
    } 
       elseif (is_search() ) {
        echo "搜索结果"; echo " - "; bloginfo('name');
    } elseif (is_404() ) {
        echo '页面未找到!';
    } else {
        wp_title('',true);
    } ?>
    </title>
    	<!-- stylesheet -->
      <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css ?>" type="text/css">
    	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v=<?php echo time(); ?>" type="text/css">

    	<!-- RSS2.0 -->
    	<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
		  <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />
		  <!-- script -->
		  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.8.2.min.js"></script>
		  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.bxslider.min.js"></script>
		  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/index.js"></script>
    	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    	<?php wp_head(); ?>
    </head>
    	<?php flush(); ?>
    <body>
    <!-- Topbar Begin -->
    	<section class="topbar">
    		<div class="inner">
        		<div class="topbar-lt">欢迎访问我们的网站。</div>
        		<div class="topbar-rt">
                	<div class="subnav">
                        <?php if(function_exists('wp_nav_menu')) {
        echo strip_tags( wp_nav_menu(array( 'theme_location' => 'top-menu','container' => false,'items_wrap' => '%3$s','echo' => false, 'depth' => 0) ) , '<a>' ); 
      }?>
                        <a href="<?php echo get_option('home'); ?>/wp-login.php?action=register">注册</a>
            			<a href="<?php echo get_option('home'); ?>/wp-login.php">登录</a>
        			</div>
    			</div>
			</div>
		</section>
	<!-- Topbar End -->
	<!-- Header Begin-->
   	<header class="header">
   	<div class="inner">
   	<!-- Logo Begin -->
       	<h1 class="logo fadeInLeft">
        	<a href="<?php echo get_option('home'); ?>" rel="home">
        		<img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="南邮通达团委">
        	</a>
       	</h1>
    <!-- Logo End -->
    <div id="mobile-nav">
        <a id="mobile-menu">菜单</a>
        <a id="mobile-so">搜索</a>
	</div>
	<div id="so-box" >
    	<a id="btn-so"></a>
    	<div id="search-box" style="box-sizing: content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;">
    	<form method="get" id="searchform" action="http://localhost/" >
       		<input type="text" placeholder="输入关键字" name="s" id="ls" class="searchInput" style="box-sizing: content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;" x-webkit-speech />
       		<input type="submit" id="searchsubmit" title="搜索" value="搜索"/>
    	</form>
    	</div>
	</div>
  <?php 
  global $ashu_option; 
  $twjs = $ashu_option['setting']['twjs'];
  $bgxt = $ashu_option['setting']['bgxt'];
  $dzyx = $ashu_option['setting']['dzyx'];
  $zxzx = $ashu_option['setting']['zxzx'];
  $lyfk = $ashu_option['setting']['lyfk'];
  ?>
	<div id="mid-box">
    	<div><a href="<?php echo $lyfk ?>"><img src="<?php bloginfo('template_directory');?>/images/book.png" alt=""><i>留言反馈</i></a></div>
    	<div><a href="<?php echo $zxzx ?>"><img src="<?php bloginfo('template_directory');?>/images/faq.png" alt=""><i>在线咨询</i></a></div>
    	<div><a href="<?php echo $dzyx ?>"><img src="<?php bloginfo('template_directory');?>/images/mail.png" alt=""><i>电子邮箱</i></a></div>
	   	<div><a href="<?php echo $bgxt ?>"><img src="<?php bloginfo('template_directory');?>/images/office.png" alt=""><i>办公系统</i></a></div>
      <div><a href="<?php echo $twjs ?>"><img src="<?php bloginfo('template_directory');?>/images/yuanxi.png" alt=""><i>团委介绍</i></a></div>
    </div>
	</div>
	</header>
	<!-- Header end -->	
	<!-- Main Menu Begin-->
	<nav class="main-menu">
		<div class="inner">
			<ul class="navi">
			<?php if(function_exists('wp_nav_menu')) {
  				wp_nav_menu(array( 'theme_location' => 'header-menu','depth' => 2) ); 
			}?>
			</ul>
		</div>
	</nav>
	<!-- Main Menu End-->
