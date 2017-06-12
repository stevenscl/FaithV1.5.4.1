<?php 
	//阿树框架
	require get_template_directory() . '/include/ashuwp_framework_core.php'; //必须 加载核心类
	require get_template_directory() . '/include/ashuwp_options_feild.php'; //可选 设置页面
	require get_template_directory() . '/include/config.php'; //配置文件-按需配置

	// 取消wordpress头部导航栏
	add_filter('show_admin_bar', '__return_false');

	// 注册菜单
    if(function_exists('register_nav_menus')){ 
        register_nav_menus( array( 
        	'top-menu' => '顶部导航',
            'header-menu' => '头部导航',
            'footer-menu' => '脚部快捷链接'
            )); 
    }

    // 为文章添加特色图片功能
    add_theme_support('post-thumbnails');


	// 自定义幻灯片类型
	add_action('init', 'slider_init');   
	function slider_init()    
	{   
	  $labels = array(   
	    'name' => '首页幻灯片',   
	    'singular_name' => '首页幻灯片',
		'menu_name' => '首页幻灯片',
		'name_admin_bar' => '幻灯片',
	    'add_new' => '新建幻灯片',   
	    'add_new_item' => '新建',   
	    'edit_item' => '编辑',   
	    'new_item' => '新增'  
	  );   
	  $args = array(   
	    'labels' => $labels,   
	    'public' => true, 
	    'show_ui' => true,    
	    'show_in_menu' => true,    
	    'query_var' => true,   
	    'rewrite' => true,   
	    'capability_type' => 'post',   
	    'has_archive' => false,    
	    'exclude_from_search' => true,
	    'menu_position' => 8,
	    'supports' => array( 'title'),
		'menu_icon' => 'dashicons-images-alt2'
	  );    
	  register_post_type('slider',$args); 
	}
	// 幻灯片管理列表
	add_filter('manage_slider_posts_columns', 'add_slider_columns');
	function add_slider_columns( $columns ) {
	    $columns = array(
			'cb' => '<input type="checkbox" />',
			//'id' => '序列',
	        'title' => '标题',
			'author' => '作者',
	        'linked' => '链接',
	        'thumbnail' => '预览',
			'date' => '日期'
	    );
	    return $columns;
	}
	// 管理列表赋值
	add_action('manage_slider_posts_custom_column', 'manage_slider_columns', 10, 2);
	function manage_slider_columns( $column, $post_id ) {
	    global $post;
	    switch( $column ) { 
			//case 'id': 
			//	echo $post_id;   
	        //break; 
	        case "linked":
	            if(get_post_meta($post->ID, "slider_link", true)){
	                echo get_post_meta($post->ID, "slider_link", true);
	            } else {echo '----';}
	        break;
	        case "thumbnail":
	                $thumb_url = get_post_meta($post->ID,'slider_pic',true);
	                //$ds_image = vt_resize( '',$ds_thumb , 95, 41, true );
	                echo '<img src="'.$thumb_url.'" width="50" height="50" alt="" />';
	                break;
	        default :
	            break;
	    }
	}
	//幻灯片设置
	$slider_meta = array (
	    '幻灯片设置' => array (
		    array( 'slider_pic', '图片地址：' ),
			array( 'slider_link', '链接地址：' ),		
	    ),		
	);
	add_action('admin_menu', 'create_meta_box');
	add_action('save_post', 'save_postdata', 1, 2);
	function create_meta_box() {
		global $slider_meta;
	    if (function_exists('add_meta_box')) {
	        foreach(array_keys($slider_meta) as $box_name) {
	            add_meta_box($box_name, __($box_name, 'sp'), 'sp_post_custom_box', 'slider', 'normal', 'high');
	        }
	    }
	}
	function sp_post_custom_box($obj, $box) {	
		global $slider_meta;
	    static $sp_nonce_flag = false;
	    if (!$sp_nonce_flag) {
	        echo_sp_nonce();
	        $sp_nonce_flag = true;
	    }
	    foreach((array)$slider_meta[$box['id']] as $sp_box) {
	        echo field_html($sp_box);
	    }
	}
	function field_html($args) {
	    switch ($args[2]) {
	    case 'textarea':
	        return text_area($args);
	    case 'checkbox':
	        // To Do
	    case 'radio':
	        // To Do
	    case 'text':
	    default:
	        return text_field($args);
	    }
	}
	function text_field($args) {
	    global $post;
	    // adjust data
	    $args[2] = get_post_meta($post ->ID, $args[0], true);
	    $args[1] = __($args[1], 'sp');
	    $label_format = '<label for="%1$s">%2$s</label><br />'.'<input style="width: 95%%;" type="text" name="%1$s" value="%3$s" /><br /><br />';
	    return vsprintf($label_format, $args);
	}
	function text_area($args) {
	    global $post;
	    $args[2] = get_post_meta($post ->ID, $args[0], true);
	    $args[1] = __($args[1], 'sp');
	    $label_format = '<label for="%1$s">%2$s</label><br />'.'<textarea style="width: 95%%;" name="%1$s">%3$s</textarea><br /><br />';
	    return vsprintf($label_format, $args);
	}
	function save_postdata($post_id, $post) {
		//幻灯片
		global $slider_meta;
	    if (!wp_verify_nonce($_POST['sp_nonce_name'], plugin_basename(__FILE__))) {
	        return $post ->ID;
	    }
	    if ('page' == $_POST['post_type']) {
	        if (!current_user_can('edit_page', $post ->ID)) return $post ->ID;
	    } else {
	        if (!current_user_can('edit_post', $post ->ID)) return $post ->ID;
	    }
	    foreach($slider_meta as $sp_box) {
	        foreach($sp_box as $sp_fields) {
	            $my_data[$sp_fields[0]] = $_POST[$sp_fields[0]];
	        }
	    }		
	    //版本
	    foreach($my_data as $key =>$value) {
	        if ('revision' == $post ->post_type) {
	            return;
	        }
	        $value = implode(',', (array) $value);
	        if (get_post_meta($post ->ID, $key, FALSE)) {
	            update_post_meta($post ->ID, $key, $value);
	        } else {
	            add_post_meta($post ->ID, $key, $value);
	        }
	        if (!$value) {
	            delete_post_meta($post ->ID, $key);
	        }
	    }
	}
	function echo_sp_nonce() {
	    echo sprintf('<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />', 'sp_nonce_name', wp_create_nonce(plugin_basename(__FILE__)));
	}
	if (!function_exists('get_custom_field')) {
	    function get_custom_field($field) {
	        global $post;
	        $custom_field = get_post_meta($post ->ID, $field, true);
	        echo $custom_field;
	    }
	}


	//小工具
	if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => '分频栏目一',
		'before_widget' => '<div class="cat-post-list cat-first-pic-list">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => '分频栏目二',
		'before_widget' => '<div class="cat-post-list cat-first-pic-list">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => '分频栏目三',
		'before_widget' => '<div class="cat-post-list cat-first-pic-list">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => '分频栏目四',
		'before_widget' => '<div class="cat-post-list cat-first-pic-list">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => '分频栏目五',
		'before_widget' => '<div class="cat-post-list cat-first-pic-list">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => '分频栏目六',
		'before_widget' => '<div class="cat-post-list cat-first-pic-list">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => '滚动栏目一',
		'before_widget' => '<div class="cat-scroll-pic-list">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => '滚动栏目二',
		'before_widget' => '<div class="cat-scroll-pic-list">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => '主页侧边栏',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => '通用侧边栏',
		'before_widget' => '<li class="widget_nav_menu">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}
   
   //编辑器增加按钮   
	function enable_more_buttons($buttons) {       
	$buttons[] = 'blockquote';       
	$buttons[] = 'fontselect';   
	$buttons[] = 'fontsizeselect';    
	return $buttons;     
	}     
	add_filter("mce_buttons_2", "enable_more_buttons");  

   
	/// 函数作用：取得文章的阅读次数
function record_visitors()
{
	if (is_singular()) 
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');  
/// 函数名称：post_views 
/// 函数作用：取得文章的阅读次数
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
}




//面包屑导航
function cmp_breadcrumbs() {
	$delimiter = '»'; // 分隔符
	$before = '<span class="current">'; // 在当前链接前插入
	$after = '</span>'; // 在当前链接后插入
	if ( !is_home() && !is_front_page() || is_paged() ) {
		echo ''.__( '' , 'cmp' );
		global $post;
		$homeLink = home_url();
		echo ' <a itemprop="breadcrumb" href="' . $homeLink . '">' . __( '首页' , 'cmp' ) . '</a> ' . $delimiter . ' ';
		if ( is_category() ) { // 分类 存档
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
			}
			echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_day() ) { // 天 存档
			echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) { // 月 存档
			echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) { // 年 存档
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) { // 文章
			if ( get_post_type() != 'post' ) { // 自定义文章类型
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else { // 文章 post
				$cat = get_the_category(); $cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
				echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) { // 附件
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) { // 页面
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) { // 父级页面
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_search() ) { // 搜索结果
			echo $before ;
			printf( __( '搜索结果为: %s', 'cmp' ),  get_search_query() );
			echo  $after;
		} elseif ( is_tag() ) { //标签 存档
			echo $before ;
			printf( __( 'Tag Archives: %s', 'cmp' ), single_tag_title( '', false ) );
			echo  $after;
		} elseif ( is_author() ) { // 作者存档
			global $author;
			$userdata = get_userdata($author);
			echo $before ;
			printf( __( 'Author Archives: %s', 'cmp' ),  $userdata->display_name );
			echo  $after;
		} elseif ( is_404() ) { // 404 页面
			echo $before;
			_e( 'Not Found', 'cmp' );
			echo  $after;
		}
		if ( get_query_var('paged') ) { // 分页
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo sprintf( __( '( Page %s )', 'cmp' ), get_query_var('paged') );
		}
		echo '';
	}
}


	/*search*/
function __search_by_title_only( $search, &$wp_query )
{
	global $wpdb;
 
	if ( empty( $search ) )
        return $search;
 
    $q = $wp_query->query_vars;    
    $n = ! empty( $q['exact'] ) ? '' : '%';
 
    $search =
    $searchand = '';
 
    foreach ( (array) $q['search_terms'] as $term ) {
    	$term = esc_sql( like_escape( $term ) );
    	$search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
    	$searchand = ' AND ';
    }
 
    if ( ! empty( $search ) ) {
    	$search = " AND ({$search}) ";
    	if ( ! is_user_logged_in() )
    		$search .= " AND ($wpdb->posts.post_password = '') ";
    }
 
    return $search;
}
add_filter( 'posts_search', '__search_by_title_only', 500, 2 );


//自定义背景
$defaults = array(   
    'default-color'          => '',   
    'default-image'          => '',   
    'wp-head-callback'       => '_custom_background_cb',   
    'admin-head-callback'    => '',   
    'admin-preview-callback' => ''  
);   
add_theme_support( 'custom-background', $defaults ); 


//登入
//Login Page
	function custom_login() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/login.css" />'."\n";
		echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/jquery.min.js"></script>'."\n";
	}
	add_action('login_head', 'custom_login');

	//Login Page Title
	function custom_headertitle ( $title ) {
		return get_bloginfo('name');
	}
	add_filter('login_headertitle','custom_headertitle');

	//Login Page Link
	function custom_loginlogo_url($url) {
		return esc_url( home_url('/') );
	}
	add_filter( 'login_headerurl', 'custom_loginlogo_url' );

	//Login Page Footer
	function custom_html() {
		echo '<div class="footer">'."\n";
		echo '<p>Copyright &copy; '.date('Y').' All Rights | Author by Faith</p>'."\n";
		echo '</div>'."\n";
		echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/resizeBg.js"></script>'."\n";
		echo '<script type="text/javascript">'."\n";
		echo 'jQuery("body").prepend("<div class=\"loading\"><img src=\"'.get_bloginfo('template_directory').'/images/login_loading.gif\" width=\"58\" height=\"10\"></div><div id=\"bg\"><img /></div>");'."\n";
		echo 'jQuery(\'#bg\').children(\'img\').attr(\'src\', \''.get_bloginfo('template_directory').'/images/login_bg.jpg\').load(function(){'."\n";
		echo '	resizeImage(\'bg\');'."\n";
		echo '	jQuery(window).bind("resize", function() { resizeImage(\'bg\'); });'."\n";
		echo '	jQuery(\'.loading\').fadeOut();'."\n";
		echo '});';
		echo '</script>'."\n";
	}
	add_action('login_footer', 'custom_html');


   include_once(TEMPLATEPATH .'/widget/categoryposts.php'); 
   include_once(TEMPLATEPATH .'/widget/firstpicposts.php');
   include_once(TEMPLATEPATH .'/widget/scrollpicposts.php');
   include_once(TEMPLATEPATH .'/widget/subcatlist.php');
   include_once(TEMPLATEPATH .'/widget/hotviewposts.php');
 ?>
