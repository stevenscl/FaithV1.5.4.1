/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 4.4
**/
jQuery(document).ready(function($){
  var upload_frame,
      gallery_frame,
      value_id;
      
  $('.ashu_upload_button').on( 'click', function( event ){
    
    event.preventDefault();
    
    value_id =$( this ).attr('id');
    
    if(upload_frame){
      upload_frame.open();
      return;
    }
    
    upload_frame = wp.media({
      title: 'Insert image',
      button: {
        text: 'Insert'
      },
      multiple: false
    });
    
    upload_frame.on('select',function(){
      var attachment = upload_frame.state().get('selection').first().toJSON();
      //$('#'+value_id+'_upload').val(attachment.url).trigger('change');
      $('input[name='+value_id+']').val(attachment.url).trigger('change');
    });
    
    upload_frame.open();
    
  });
  
  $('.ashuwp_field_upload').on('change focus blur', function(){
      $select = '#' + $(this).attr('name') + '_preview';
      $value = $(this).val();
      if($value){
        var index1=$value.lastIndexOf('.');
        var index2=$value.length;
        var file_type=$value.substring(index1,index2);
        img_src = ashu_file_preview.img_base;
        if($.inArray(file_type,['.png','.jpg','.gif','.bmp'])!='-1'){
          img_src = $value;
        }else if($.inArray(file_type,['.zip','.rar','.7z','.gz','.tar','.bz','.bz2'])!='-1'){
          img_src += ashu_file_preview.img_path.archive;
        }else if($.inArray(file_type,['.mp3','.wma','.wav','.mod','.ogg','.au'])!='-1'){
          img_src += ashu_file_preview.img_path.audio;
        }else if($.inArray(file_type,['.avi','.mov','.wmv','.mp4','.flv','.mkv'])!='-1'){
          img_src += ashu_file_preview.img_path.video;
        }else if($.inArray(file_type,['.swf'])!='-1'){
          img_src += ashu_file_preview.img_path.interactive;
        }else if($.inArray(file_type,['.php','.js','.css','.json','.html','.xml'])!='-1'){
          img_src += ashu_file_preview.img_path.code;
        }else if($.inArray(file_type,['.doc','.docx','.pdf','.wps'])!='-1'){
          img_src += ashu_file_preview.img_path._document;
        }else if($.inArray(file_type,['.xls','.xlsx','.csv','.et','.ett'])!='-1'){
          img_src += ashu_file_preview.img_path.spreadsheet;
        }else if($.inArray(file_type,['.txt','.rtf'])!='-1'){
          img_src += ashu_file_preview.img_path._text;
        }else{
          img_src += ashu_file_preview.img_path._default;
        }
        $file_view = '<img src ="'+img_src+'" />';
        $($select).html('').append($file_view);
      }
  });
  
  $('.gallery_container').on('click', 'a.add_gallery', function(event){
    event.preventDefault();
    
    gallery_input = $(this).parent().find('.gallery_input');
    gallery_view = $(this).parent().find('.gallery_view');
    attachment_ids = gallery_input.val();
    
    if( gallery_frame ){
      gallery_frame.open();
      return;
    }
    
    gallery_frame = wp.media({
      title: 'Add to gallary',
      button: {
        text: 'Add to gallary'
      },
      multiple: true
    });
    
    gallery_frame.on('select', function(){
      var selection = gallery_frame.state().get('selection');
      selection.map( function( attachment ){
        attachment = attachment.toJSON();

        if ( attachment.id ) {
          attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
          gallery_view.append('<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment.url + '" /><ul class="actions"><li><a href="#" class="delete" title="Delete image">Delete</a></li></ul></li>');
        }
      });
      
      gallery_input.val(attachment_ids);
      
    });
    
    gallery_frame.open();
    
  });
  
  $('.gallery_container').on('click', 'a.delete', function(event){
    
    gallery_container = $(this).closest('.gallery_container');
    
    $(this).closest('li.image').remove();
    
    var attachment_ids = '';
    gallery_container.find('li.image').css('cursor','default').each(function() {
      var attachment_id = $(this).attr( 'data-attachment_id' );
        attachment_ids = attachment_ids + attachment_id + ',';
    });
    
    gallery_container.find('.gallery_input').val( attachment_ids );
    
    return false;
  });
  
  $('.gallery_view').sortable({
    items: 'li.image',
    cursor: 'move',
    scrollSensitivity:40,
    forcePlaceholderSize: true,
    forceHelperSize: false,
    helper: 'clone',
    opacity: 0.65,
    placeholder: 'wc-metabox-sortable-placeholder',
    start:function(event,ui){
      ui.item.css('background-color','#f6f6f6');
    },
    stop:function(event,ui){
      ui.item.removeAttr('style');
    },
    update: function(event, ui) {
      var attachment_ids = '';
      $(this).find('li.image').css('cursor','default').each(function() {
        var attachment_id = $(this).attr( 'data-attachment_id' );
            attachment_ids = attachment_ids + attachment_id + ',';
      });
      $(this).parent().find('.gallery_input').val( attachment_ids );
    }
  });
  
  $('.ashuwp_color_picker').wpColorPicker();
  
  $( '.ashuwp_feild_tabs' ).tabs();
  
});