<?php   
  
//定义小工具类AshuPostViews    
class Faith_5 extends WP_Widget{   
       
    function __construct() {
 
    parent::__construct(
 
        // 小工具ID
        'Faith_hotview_posts',
 
        // 小工具名称
        __('Faith-热门浏览', 'Faith_5' ),
 
        // 小工具选项
        array (
            'description' => __( '按照浏览次数的热门文章', 'Faith_5' )
        )
 
    );
 
}
       
    function form($instance){   

        $instance = wp_parse_args((array)$instance,array(   
        'title'=>'热评文章','showPosts'=>10   
        ));   
        $title = htmlspecialchars($instance['title']);   
        $showPosts = htmlspecialchars($instance['showPosts']);   
        $output = '<table>';   
        $output .= '<tr><td>标题:</td><td>';   
        $output .= '<input id="'.$this->get_field_id('title') .'" name="'.$this->get_field_name('title').'" type="text" value="'.$instance['title'].'" />';   
        $output .= '</td></tr><tr><td>文章数量：</td><td>';   
        $output .= '<input id="'.$this->get_field_id('showPosts') .'" name="'.$this->get_field_name('showPosts').'" type="text" value="'.$instance['showPosts'].'" />';   
        $output .= '</td></tr></table>';   
        echo $output;   
    }   
       
    function update($new_instance,$old_instance){   

        $instance = $old_instance;   
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));   
        $instance['showPosts'] = strip_tags(stripslashes($new_instance['showPosts']));   
        return $instance;    
    }   
       
    function widget($args,$instance){  
        extract($args);   
        $title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);   
        $showPosts = empty($instance['showPosts']) ? 10 : $instance['showPosts'];   
        echo '<li>';   
        echo '<h3>';
        echo '<span>';
        echo $title;
        echo '</span>';
        echo '</h3>';  
        echo '<ul>';   
            $this->hotpost($showPosts);   
        echo '</ul>';   
        echo '</li>';   
    }   


    function hotpost($showposts){   
    global $wpdb;      
    $result = $wpdb->get_results("SELECT post_id,meta_key,meta_value,ID,post_title FROM $wpdb->postmeta key1 INNER JOIN $wpdb->posts key2 ON key1.post_id = key2.ID where key2.post_type='post' AND key2.post_status='publish' AND key1.meta_key='views' ORDER BY CAST(key1.meta_value AS SIGNED) DESC LIMIT 0 , $showposts");   
    $output = '';   
    foreach ($result as $post) {   
  
        $postid = $post->ID;      
        if( mb_strlen($post->post_title,"UTF-8")>18 ){   
            $title = strip_tags($post->post_title);   
            $short_title = trim(mb_substr($title ,0,14,"UTF-8"));   
            $short_title .= '...';   
        }else{   
            $short_title = $post->post_title;   
        }   
  
            $output .= '<li class=""><a href="' . get_permalink($postid) . '" title="' . $title .'">' . $short_title .'</a><br /> <span class="">'.$post->meta_value .'Views</span></li>';   
        $i++;   
    }      
    echo $output;      
    }       

}
function Faith_5(){   
    //注册小工具   
    register_widget('Faith_5');   
}   
//widges_init，小工具初始化的时候执行AshuPostViews函数，   
add_action('widgets_init','Faith_5');   
    
?>