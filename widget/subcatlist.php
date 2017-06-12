<?php 
function get_category_root_id($cat){
        $this_category = get_category($cat);   // 取得当前分类
        while($this_category->category_parent) // 若当前分类有上级分类时,循环
        {
            $this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类(往上爬)
        }
        return $this_category->term_id; // 返回根分类的id号
    }   
  
//定义小工具类   
class Faith_4 extends WP_Widget{   
       
    function __construct() {
 
    parent::__construct(
 
        // 小工具ID
        'Faith_subcatlist',
 
        // 小工具名称
        __('Faith-面包屑导航', 'Faith_4' ),
 
        // 小工具选项
        array (
            'description' => __( '为侧边栏提供面包屑导航', 'Faith_4' )
        )
 
    );
 
}
       
    function form(){   
  
    }   
       
    function update(){   

    }   
    
       
    function widget($args){  
        extract($args); //将数组展开 
        if (is_category() || is_single()) {    //分类 文章
            echo $before_widget;
            echo $before_title;
                $category = get_the_category();
                $catid = $category[0]->cat_ID;
                $parent = get_cat_name($category[0]->category_parent);
                ?>
                <?php if (!empty($parent)) {
                            echo $parent;
                            echo $after_title; ?>
            <ul>
            <?php wp_list_categories("orderby=ID&child_of=".get_category_root_id($catid)."&depth=1&hide_empty=0&title_li=&current_category=".$catid);?>
            </ul>
            <?php echo $after_widget;
                        } else {
                            echo $category[0]->cat_name;
                            $catid = $category[0]->cat_ID;
                            echo $after_title; ?>
            <ul>
            <?php wp_list_categories("orderby=ID&child_of=".$catid."&depth=1&hide_empty=0&title_li=&current_category=".$catid);?>
            </ul>
            <?php echo $after_widget;
                        } 
            
            
        } else if (is_page()){ 
            echo $before_widget;
            echo $before_title;
            wp_title('');
            echo $after_title; ?>
            <ul>
            <?php wp_nav_menu(array( 'theme_location' => 'header-menu','depth' => 1,'container' => false,'items_wrap' => '%3$s') ); ?>
            </ul>
            <?php echo $after_widget;
        } else if (is_search()){
            echo $before_widget;
            echo $before_title;
            echo '搜索结果';
            echo $after_title; ?>
            <ul>
            <?php wp_nav_menu(array( 'theme_location' => 'header-menu','depth' => 1,'container' => false,'items_wrap' => '%3$s') ); ?>
            </ul>
            <?php echo $after_widget;
        }

    }
}
function Faith_4(){   
    //注册小工具   
    register_widget('Faith_4');   
}   
//widges_init，小工具初始化的时候执行AshuPostViews函数，   
add_action('widgets_init','Faith_4');   
    
?>