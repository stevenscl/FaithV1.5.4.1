<?php
/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 4.4
**/

/**
*
*post meta test
*
**/
/*****Meta Box********/
$ashu_meta = array();
$meta_conf = array('title' => 'Meta box', 'id'=>'example_box', 'page'=>array('page','post'), 'context'=>'normal', 'priority'=>'low');

$ashu_meta[] = array(
  'name' => 'Text Input',
  'id'   => '_id_text',
  'desc' => 'Description or Notice',
  'std'  => 'Default content',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => 'Texearea Input',
  'id'   => '_id_textarea',
  'desc' => 'Description or Notice',
  'std'  => 'Default content',
  'type' => 'textarea'
);

$new_box = new ashuwp_postmeta_feild($ashu_meta, $meta_conf);

/**
*
*Tab style
*
**/
$tab_meta = array();
$tab_conf = array('title' => 'Tab Title', 'id'=>'tab_box', 'page'=>array('page','post'), 'context'=>'normal', 'priority'=>'low', 'tab'=>true);
/**first**/
$tab_meta[] = array(
  'name' => 'First Tab',
  'id'   => 'tab_first',
  'type' => 'open'
);

$tab_meta[] = array(
  'name'    => 'Radio',
  'id'      => '_id_radio',
  'desc'    => 'Please select your gender',
  'std'     => 'thirdness',
  'subtype' => array(
    'male'      => 'Male',
    'female'    => 'Female',
    'thirdness' => 'Third gender'
  ),
  'type'    => 'radio'
);

$tab_meta[] = array(
  'name'    => 'Checkbox',
  'id'      => '_id_checkbox',
  'desc'    => 'Which fruits do you like?',
  'std'     => array('apple','orange'),
  'subtype' => array(
    'apple'  => 'Apple',
    'orange' => 'Orange',
    'banana' => 'Banana',
    'lemon'  => 'Lemon'
  ),
  'type'    => 'checkbox'
);

$tab_meta[] = array(
  'type' => 'close'
);
/**second**/
$tab_meta[] = array(
  'name' => 'Second Tab',
  'id'   => 'tab_second',
  'type' => 'open'
);

$tab_meta[] = array(
  'name'    => 'Page select',
  'id'      => '_page_select',
  'desc'    => 'Please select a page',
  'std'     => '',
  'subtype' => 'page',
  'type'    => 'select'
);

$tab_meta[] = array(
  'name'    => 'Category select',
  'id'      => '_category_select',
  'desc'    => 'Please select a category',
  'std'     => '',
  'subtype' => 'category',
  'type'    => 'select'
);

$tab_meta[] = array(
  'type' => 'close'
);
/**third**/
$tab_meta[] = array(
  'name' => 'Third Tab',
  'id'   => 'tab_third',
  'type' => 'open'
);

$tab_meta[] = array(
  'name'    => 'Custom select',
  'id'      => '_custom_select',
  'desc'    => 'Which fruits do you like',
  'std'     => '',
  'subtype' => array(
    'apple'  => 'Apple',
    'orange' => 'Orange',
    'banana' => 'Banana',
    'lemon'  => 'Lemon'
  ),
  'type' => 'select'
);

$tab_meta[] = array(
  'name'  => 'Tinymce',
  'id'    => '_id_tinymce',
  'desc'  => 'Pleas add some content',
  'std'   => 'Hello, world.',
  'media' => 1,
  'type'  => 'tinymce'
);

$tab_meta[] = array(
  'type' => 'close'
);

/**fourth**/
$tab_meta[] = array(
  'name' => 'Fourth Tab',
  'id'   => 'tab_fourth',
  'type' => 'open'
);

$tab_meta[] = array(
  'name' => 'Image Upload',
  'id'   => '_id_upload',
  'desc' => 'Pleas upload a image, Or fill the blank with image url',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_meta[] = array(
  'name' => 'Image gallery',
  'id'   => '_id_gallery',
  'desc' => 'Pleas upload images',
  'std'  => '',
  'button_text' => 'Add',
  'type' => 'gallery'
);

$tab_meta[] = array(
  'type' => 'close'
);

$tab_box = new ashuwp_postmeta_feild($tab_meta, $tab_conf);

/**
*
*taxonomy feild test
*
**/
/*****taxonomy feild ******/
$ashu_feild = array();
$taxonomy_cof = array('category','post_tag');

$ashu_feild[] = array(
  'name'      => 'Text Input',
  'id'        => '_id_text',
  'desc'      => 'description or notice',
  'std'       => 'Default content',
  'edit_only' => false,
  "type"      => "text"
);

$ashu_feild[] = array(
  'name'        => 'Image Upload',
  'id'          => '_id_upload',
  'desc'        => 'Pleas upload a image, Or fill the blank with image url',
  'std'         => '',
  'button_text' => 'Upload',
  'edit_only'   => true,
  'type'        => 'upload'
);

$ashuwp_termmeta_feild = new ashuwp_termmeta_feild($ashu_feild, $taxonomy_cof);

/**
*
*Optinos page
*
**/
/**General options**/
$page_info = array(
  'full_name' => 'General Options',
  'optionname'=>'general',
  'child'=>false,
  'filename' => 'generalpage'
);

$ashu_options = array();

$ashu_options[] = array(
  'name' => 'Text Input',
  'id'   => '_id_text',
  'desc' => 'description or notice',
  'std'  => 'Default content',
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => 'Color picker',
  'id'   => 'color_picker',
  'desc' => 'description or notice',
  'std'  => '',
  'type' => 'color'
);

$ashu_options[] = array(
  'name' => 'Textarea Input',
  'id'   => '_id_textarea',
  'desc' => 'Description or Notice',
  'std'  => 'Default content',
  'type' => 'textarea'
);

$option_page = new ashuwp_options_feild($ashu_options, $page_info);

/**Child options page width tab style**/
$child_info = array(
  'full_name' => 'Child Options',
  'optionname'=>'childoption',
  'child'=>true,
  'parent_slug'=>'generalpage',
  'filename' => 'childpage'
);

$child_option = array();
/**first tab**/
$child_option[] = array(
  'name' => 'First Tab',
  'id'   => 'option_tab1',
  'type' => 'open',
);

$child_option[] = array(
  'name'    => 'Radio',
  'id'      => '_id_radio',
  'desc'    => 'Please select your gender',
  'std'     => 'thirdness',
  'subtype' => array(
    'male'      => 'Male',
    'female'    => 'Female',
    'thirdness' => 'Third gender'
  ),
  'type'    => 'radio'
);

$child_option[] = array(
  'name'    => 'Checkbox',
  'id'      => '_id_checkbox',
  'desc'    => 'Which fruits do you like?',
  'std'     => array('apple','orange'),
  'subtype' => array(
    'apple'  => 'Apple',
    'orange' => 'Orange',
    'banana' => 'Banana',
    'lemon'  => 'Lemon'
  ),
  'type'    => 'checkbox'
);


$child_option[] = array(
  'name'    => 'Checkbox for category',
  'id'      => '_id_checkbox_category',
  'desc'    => '',
  'subtype' => 'category',
  'type'    => 'checkbox'
);

$child_option[] = array(
  'name'    => 'Checkbox for Page',
  'id'      => '_id_checkbox_page',
  'desc'    => '',
  'subtype' => 'page',
  'type'    => 'checkbox'
);



$child_option[] = array(
  'type' => 'close',
);
/**second tab**/
$child_option[] = array(
  'name' => 'Second Tab',
  'id'   => 'option_tab2',
  'type' => 'open',
);

$child_option[] = array(
  'name'    => 'Page select',
  'id'      => '_page_select',
  'desc'    => 'Pleas select a page',
  'std'     => '',
  'subtype' => 'page',
  'type'    => 'select'
);

$child_option[] = array(
  'name'    => 'Page select',
  'id'      => '_category_select',
  'desc'    => 'Pleas select a category',
  'std'     => '',
  'subtype' => 'category',
  'type'    => 'select'
);

$child_option[] = array(
  'type' => 'close',
);
/**third tab**/
$child_option[] = array(
  'name' => 'Third Tab',
  'id'   => 'option_tab3',
  'type' => 'open',
);

$child_option[] = array(
  'name'    => 'Custom select',
  'id'      => '_other_select',
  'desc'    => 'Which fruits do you like?',
  'std'     => '',
  'subtype' => array(
    'apple'  => 'Apple',
    'orange' => 'Orange',
    'banana' => 'Banana',
    'lemon'  => 'Lemon'
  ),
  'type' => 'select'
);

$child_option[] = array(
  'name'  => 'Tinymce Input',
  'id'    => '_id_tinymce',
  'desc'  => 'Pleas add some content',
  'std'   => 'Hello, world.',
  'media' => 1,
  'type'  => 'tinymce'
);

$child_option[] = array(
  'type' => 'close',
);

$child_page = new ashuwp_options_feild($child_option, $child_info);

/**Other top page**/
$top_page_info = array(
  'full_name' => 'Top page',
  'optionname'=>'toppage',
  'child'=>false,
  'filename' => 'toppage_slug',
  'tab'=>true
);

$top_page_option = array();

$top_page_option[] = array(
  'name' => 'Image Upload',
  'id'   => '_id_upload',
  'desc' => 'Pleas upload a image, Or fill the blank with image url',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$top_page_option[] = array(
  'name' => 'Gallery',
  'id'   => '_id_gallery',
  'desc' => 'Pleas upload a images',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'gallery'
);

$top_page = new ashuwp_options_feild($top_page_option, $top_page_info);

/**
*
*import-export page
*
**/
/****import-export*****/
$import_info = array(
  'full_name' => 'Import/Export',
  'child'=>true,
  'parent_slug'=>'generalpage',
  'filename' => 'import_page'
);
$import_page = new ashuwp_option_import_class($import_info);
?>