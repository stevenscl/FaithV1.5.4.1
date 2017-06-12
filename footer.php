<footer class="footer">
	<div class="container">
		<!-- Footbar Begin -->
    	<div class="footbar row">
          <div class="col-md-2 col-xs-6 col-sm-4" align="center"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/sl.png"><p>社团联合会</p></a></div>
          <div class="col-md-2 col-xs-6 col-sm-4" align="center"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/xsh.png"><p>学生会</p></a></div>
          <div class="col-md-2 col-xs-6 col-sm-4" align="center"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/tm.png"><p>团委秘书处</p></a></div>
          <div class="col-md-2 col-xs-6 col-sm-4" align="center"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/kx.png"><p>科学与技术协会</p></a></div>
          <div class="col-md-2 col-xs-6 col-sm-4" align="center"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/dyt.png"><p>大艺团</p></a></div>
          <div class="col-md-2 col-xs-6 col-sm-4" align="center"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/zbh.png"><p>治保会</p></a></div>
    	</div>
      <div class="footbar row">
          <div class="col-md-3 col-xs-6 col-sm-6" align="center"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/qx.png"><p>青年志愿者协会</p></a></div>
          <div class="col-md-3 col-xs-6 col-sm-6" align="center"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/tdzs.png"><p>通达之声</p></a></div>
          <div class="col-md-3 col-xs-6 col-sm-6" align="center"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/xx.png"><p>大学生心理协会</p></a></div>
          <div class="col-md-3 col-xs-6 col-sm-6" align="center"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/xmt.png"><p>新媒体中心</p></a></div>
      </div>
      </div>
    	<!-- Footbar End -->
    <div id="picmenu" class="container-fluid">
    <div class="container footermenu">
    <div class="row">
        <div id="footerlogo" class="col-md-3 col-xs-12 col-sm-4" align="center">
            <img src="<?php bloginfo('template_url'); ?>/images/footerlogo.png">
        </div>
        <div id="menufirst" class="col-md-3 col-sm-4">
          <ul><!--#begineditable name="底部文字链接列表" viewid="70394"-->    
            <p>快捷链接</p>
            <li><?php if(function_exists('wp_nav_menu')) {
        echo strip_tags( wp_nav_menu(array( 'theme_location' => 'footer-menu','container' => false,'items_wrap' => '%3$s','echo' => false, 'depth' => 0) ) , '<a>' ); 
      }?></li>
      <!--#endeditable-->
          </ul>
        </div>
        <?php 
        global $ashu_option; 
        $xlwb = $ashu_option['setting']['xlwb'];
        $gfwx = $ashu_option['setting']['gfwx'];
        $yqlj = $ashu_option['setting']['yqlj'];
        $wzwh = $ashu_option['setting']['wzwh'];
        ?>
        <div id="menusecond" class="col-md-3 col-sm-4" align="center">
          <a href="<?php echo $xlwb ?>"><img src="<?php bloginfo('template_url'); ?>/images/xlwb.jpg"></a>
          <a href="<?php echo $gfwx ?>"><img src="<?php bloginfo('template_url'); ?>/images/wx.png"></a>
          <a href="<?php echo $yqlj ?>"><img src="<?php bloginfo('template_url'); ?>/images/yqlj.png"></a>
          <a href="<?php echo $wzwh ?>"><img src="<?php bloginfo('template_url'); ?>/images/txwb.jpg"></a>
        </div>
        <div id="menuthird" class="col-md-3" align="center">
          <img src="<?php bloginfo('template_url'); ?>/images/sydw.png">
        </div>
        </div>
    </div>
    </div>
</footer>
<!-- Copyright begin -->
    <div class="container-fluid copyright">
    <div class="container copyrightent">
    <div class="row">
      <div class="col-md-12"><p>Copyright © 2017 南京邮电大学通达学院团委 All Rights Reserved.</p></div>
    </div>
    </div>
    </div>
<!-- Copyright end -->
    <?php wp_footer(); ?>
</body>
</html>
