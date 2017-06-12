<?php   
  
//定义小工具类AshuPostViews    
class Faith_1 extends WP_Widget{   
       
    function __construct() {
 
    parent::__construct(
 
        // 小工具ID
        'Faith_category_posts',
 
        // 小工具名称
        __('Faith-指定分类文章列表', 'Faith_1' ),
 
        // 小工具选项
        array (
            'description' => __( '按照选定的分类目录显示文章', 'Faith_1' )
        )
 
    );
 
}
       
    function form($instance){   

        //如果之前没有数据的话，设置两个默认量   
        $instance = wp_parse_args((array)$instance,array(   
        'title'=>'分类目录','showPosts'=>10,'catId'=>1   
        ));   
           
        $title = htmlspecialchars($instance['title']);   
        $showPosts = htmlspecialchars($instance['showPosts']); 
        $catId = htmlspecialchars($instance['catId']);  
       
        //表格布局的输出表单   
        $output = '<table>';   
        $output .= '<tr><td>标题：</td><td>';   
        $output .= '<input id="'.$this->get_field_id('title') .'" name="'.$this->get_field_name('title').'" type="text" value="'.$instance['title'].'" />'; 
        $output .= '<tr><td>分类ID：</td><td>';   
        $output .= '<input id="'.$this->get_field_id('catId') .'" name="'.$this->get_field_name('catId').'" type="text" value="'.$instance['catId'].'" />';  
        $output .= '</td></tr><tr><td>显示数量：</td><td>';   
        $output .= '<input id="'.$this->get_field_id('showPosts') .'" name="'.$this->get_field_name('showPosts').'" type="text" value="'.$instance['showPosts'].'" />';   
        $output .= '</td></tr></table>';   
        echo $output;   
        //这是表单函数，也就是控制后台显示的   
    }   
       
    function update($new_instance,$old_instance){   

        $instance = $old_instance;   
        //数据处理   
        $instance['title'] = strip_tags(stripslashes($new_instance['title'])); 
        $instance['catId'] = strip_tags(stripslashes($new_instance['catId']));   
        $instance['showPosts'] = strip_tags(stripslashes($new_instance['showPosts']));   
        //返回   
        return $instance;   
        //这是更新数据函数,小工具如果有设置选项，就需要保存更新数据   
    }   
       
    function widget($args,$instance){  
        extract($args); //将数组展开   
        $title = apply_filters('widget_title',empty($instance['title']) ? '分类目录' : $instance['title']);   
        $catId = empty($instance['catId']) ? 1 : $instance['catId'];
        $showPosts = empty($instance['showPosts']) ? 10 : $instance['showPosts']; 
        $category_link = get_category_link( $catId );  
        echo $before_widget;
        echo $before_title;
        ?>
        <a href="<?php echo $category_link; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
        <span><a href="<?php echo $category_link; ?>" "></a></span>
        <?php
        echo $after_title;

        echo '<ul>';   
        $this->faith_1_get_posts($showPosts,$catId); //使用ashu_get_hotpost函数获取文章   
        echo '</ul>';   
        echo $after_widget;    
        //这是控制小工具前台显示的函数   
    }   


     //$showposts参数为显示文章的数量   
    function faith_1_get_posts($showposts,$catId){   
         if (have_posts()) : 
                     query_posts('cat=' . $catId. '&showposts='.$showposts); 
                 ?>
                        <ul>

                        <?php while (have_posts()) : the_post(); ?>
                            <li><span><?php the_time('Y-m-d') ?></span><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></li>
                        <?php endwhile;?>
                        </ul>
                <?php else : ?>
                    <ul>
                        <li>暂无文章，请更新！</li>
                    </ul>
                <?php endif;  
    wp_reset_query();
}   

}
function Faith_1(){   
    //注册小工具   
    register_widget('Faith_1');   
}   
//widges_init，小工具初始化的时候执行AshuPostViews函数，   
add_action('widgets_init','Faith_1');   
    
?>