<?php


/*********setting************/
$setting_info = array(
  'full_name' => '设置',
  'optionname'=>'setting',
  'child'=>false,
  'filename' => 'settingpage',
  'tab'=>true  //注意加上'tab'=>true
);
$setting_option = array();
/*tab1*/
$setting_option[] = array(
  'name' => '自定义链接',
  'id'   => 'linksetting',
  'type' => 'open'
);

$setting_option[] = array(
  'name'=>'团委介绍',
  'id'=>'twjs',
  'std'=>'https://',
  'desc'=>'团委介绍的链接地址',
  'type'=>'text'
); 
$setting_option[] = array(
  'name'=>'办公系统',
  'id'=>'bgxt',
  'std'=>'https://',
  'desc'=>'办公系统的链接地址',
  'type'=>'text'
); 
$setting_option[] = array(
  'name'=>'电子邮箱',
  'id'=>'dzyx',
  'std'=>'mailto:',
  'desc'=>'电子邮箱地址',
  'type'=>'text'
); 
$setting_option[] = array(
  'name'=>'在线咨询',
  'id'=>'zxzx',
  'std'=>'https://',
  'desc'=>'在线咨询的链接地址',
  'type'=>'text'
); 
$setting_option[] = array(
  'name'=>'留言反馈',
  'id'=>'lyfk',
  'std'=>'https://',
  'desc'=>'留言反馈的链接地址',
  'type'=>'text'
); 
$setting_option[] = array(
  'name'=>'新浪微博',
  'id'=>'xlwb',
  'std'=>'https://',
  'desc'=>'新浪微博的链接地址',
  'type'=>'text'
); 
$setting_option[] = array(
  'name'=>'官方微信',
  'id'=>'gfwx',
  'std'=>'https://',
  'desc'=>'官方微信的链接地址',
  'type'=>'text'
); 
$setting_option[] = array(
  'name'=>'友情链接',
  'id'=>'yqlj',
  'std'=>'https://',
  'desc'=>'友情链接的链接地址',
  'type'=>'text'
); 
$setting_option[] = array(
  'name'=>'网站维护',
  'id'=>'wzwh',
  'std'=>'mailto:',
  'desc'=>'网站维护的链接地址',
  'type'=>'text'
); 
$setting_option[] = array(
  'type' => 'close',
  'name' => ''
);
/*tab2*/
$setting_option[] = array(
  'name' => '自定义图片',
  'id'   => 'imgsetting',
  'type' => 'open'
);
$setting_option[] = array(
  'name'=>'分类目录bananer图',
  'id'=>'bananer_url',
  'std'=>'',
  'desc'=>'每次打开分类目录菜单下面的那张图片,推荐高度为180px',
  'button_text' => '上传',
  'type' => 'upload'
);
$setting_option[] = array(
  'type' => 'close',
  'name' => ''
);
$setting_page = new ashuwp_options_feild($setting_option, $setting_info);
?>