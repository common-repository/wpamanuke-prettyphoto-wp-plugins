<?php
/*
Plugin Name: WPAmanuke Pretty Photo WP Plugins
Plugin URI: http://wpamanuke.com/amanuke-wp-prettyphoto-plugins/
Description: Add prettyPhoto support to your wordpress blogs. It will enable prettyPhoto jquery in image which you insert to post/page. It work by adding class=”amanuke_prettyPhoto” in your link to image. This plugin use <a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/">prettyPhoto Jquery</a> which is licensed under Creative Commons Attribution 2.5,  so you must download the plugin separately.
Version: 0.1
Stable: 0.1
Author: Iryono S
Author URI: http://www.wpamanuke.com
*/

require_once 'admin_page.php';

function amanuke_prettyPhoto_image_attachment_fields_to_edit($form_fields, $post) {
// $form_fields is a special array of fields to include in the attachment form
// $post is the attachment record in the database
// $post->post_type == 'attachment'
// (attachments are treated as posts in WordPress)

// add our custom field to the $form_fields array
// input type="text" name/id="attachments[$attachment->ID][custom1]"
if ( substr($post->post_mime_type, 0, 5) == 'image' ) {
	
	$prefix = "amanuke_pp_";
	$form_fields["custom8"]["label"] = __("Custom Field with Extra Rows");
	$form_fields["custom8"]["tr"] = "
	<tr id='MySpecialRow'>
	<td colspan='2' style='background:#000;color:#fff;'>
	Pretty Photo Property
	</td>
	</tr>";
	
	$use_prettyphoto = get_post_meta($post->ID, $prefix . "use_prettyphoto", true);
	$checked1 = "";
	$checked2 = "";
	
	if ($use_prettyphoto=="no") 
		$checked2 = " checked='checked'";
	else
		$checked1 = " checked='checked'";
		
	$form_fields['use_prettyphoto'] = array(
			'label' => __('Open using Pretty Photo'),
			'input' => 'html',
			'html'  => "
				<input type='radio' name='attachments[$post->ID][use_prettyphoto]' id='use_prettyphoto' value='yes'". $checked1 ."/>
				<label for='use_prettyphoto'>" . __('Yes') . "</label>
				<input type='radio' name='attachments[$post->ID][use_prettyphoto]' id='use_prettyphoto' value='no'". $checked2 ."/>
				<label for='use_prettyphoto'>" . __('No') . "</label>",
		);
         	
	
	$url_lightbox_type_array['image'] = 'image';
	$url_lightbox_type_array['youtube'] = 'youtube';
	$url_lightbox_type_array['vimeo'] = 'vimeo';
	$url_lightbox_type_array['iframe'] = 'iframe';
	$url_lightbox_type_array['quicktime'] = 'quicktime';
	$url_lightbox_type_array['flash'] = 'flash';
	$url_lightbox_type_array['openblank'] = 'openblank';
	$url_lightbox_type_array['openurl'] = 'openurl';
	
	$select = get_post_meta($post->ID, $prefix . "url_lightbox_type", true);
	$out = "";
	foreach ($url_lightbox_type_array as $key => $value) {
		if ($key==$select)
			$out = $out . "<option value='$key' selected>$value</option>";
		else
			$out = $out . "<option value='$key'>$value</option>";
	}
	$form_fields["url_lightbox_type"]["label"] = __("URL Lightbox Type");
	$form_fields["url_lightbox_type"]["input"] = "html";
	$form_fields["url_lightbox_type"]["html"] = "
	<select name='attachments[{$post->ID}][url_lightbox_type]' id='attachments[{$post->ID}][url_lightbox_type]'>
	$out 
	</select>";
	$form_fields["url_lightbox_type"]["helps"] = "Put helpful text here.";
	
	
	
	$form_fields["url_lightbox"] = array(
	"label" => __("URL"),
	"input" => "text", // this is default if "input" is omitted
	"value" => get_post_meta($post->ID, "_url_lightbox", true)
	);
	
	$form_fields["url_lightbox"]["label"] = __("URL Lightbox");
	$form_fields["url_lightbox"]["input"] = "text";
	$form_fields["url_lightbox"]["value"] = get_post_meta($post->ID, $prefix . "url_lightbox", true);
	$form_fields["url_lightbox"]["helps"] = "Image / Video / Iframe / Flash <br /> which you want to show when you clik the image.<br />
Image example Use :
<b> http://www.domain.com/image.jpg </b> <br />
For iframe the format must be like this : <br /> <b>http://www.domain.com?iframe=true</b> <br />
For youtube sample like this
<b> http://www.youtube.com/watch?v=qqXi8WmQ_WM </b>";
	
	$form_fields["url_lightbox_group"]["label"] = __("Lightbox Group");
	$form_fields["url_lightbox_group"]["input"] = "text";
	$form_fields["url_lightbox_group"]["value"] = get_post_meta($post->ID, $prefix . "url_lightbox_group", true);
	$form_fields["url_lightbox_group"]["helps"] = "Fill the unique group text, Remember space , comma not allowed. For example : <br/> data1";
	


	$form_fields["custom9"]["label"] = __("Custom Field with Extra Rows");
	
	$form_fields["custom9"]["tr"] = "
	<tr id='MySpecialRow'>
	<td colspan='2' style='background:#000;color:#fff;'>
	&nbsp;
	</td>
	</tr>";
}	
	return $form_fields;

}
// attach our function to the correct hook
add_filter("attachment_fields_to_edit", "amanuke_prettyPhoto_image_attachment_fields_to_edit", null, 2);

/**
* @param array $post
* @param array $attachment
* @return array
*/
function amanuke_prettyPhoto_image_attachment_fields_to_save($post, $attachment) {
// $attachment part of the form $_POST ($_POST[attachments][postID])
// $post attachments wp post array - will be saved after returned
// $post['post_type'] == 'attachment'

	$prefix = "amanuke_pp_";
	if( isset($attachment['use_prettyphoto']) ){
		update_post_meta($post['ID'], $prefix . 'use_prettyphoto', $attachment['use_prettyphoto']);
	}
	if( isset($attachment['url_lightbox_type']) ){
		update_post_meta($post['ID'], $prefix . 'url_lightbox_type', $attachment['url_lightbox_type']);
	}
	if( isset($attachment['url_lightbox']) ){
		update_post_meta($post['ID'], $prefix . 'url_lightbox', $attachment['url_lightbox']);
	}
	if( isset($attachment['url_lightbox_group']) ){
		update_post_meta($post['ID'], $prefix . 'url_lightbox_group', $attachment['url_lightbox_group']);
	}

	return $post;
}
add_filter("attachment_fields_to_save","amanuke_prettyPhoto_image_attachment_fields_to_save",null,2);



function amanuke_prettyPhoto_get_image_send_to_editor_prettyphoto($id, $alt, $title, $align, $url='', $rel = false, $size, $use_prettyphoto,$url_lightbox_type,$url_lightbox,$url_lightbox_group) {

	$html = get_image_tag($id, $alt, $title, $align, $size);

	if ( $url ){
		$class = "";
		if ($url_lightbox_type!="") {
			switch ($url_lightbox_type) {
				case "openurl" :
						$class = '';
					break;
				case "openblank" :
						$class = ' target="_blank" ';
					break;
				default : {
					if ($url_lightbox_group!="") {
						$class = ' class="amanuke_prettyPhoto['. $url_lightbox_group .']" ';
					}
					else
						$class = ' class="amanuke_prettyPhoto" ';
				}
			}
		}
		if ($url_lightbox!="")
			$url = $url_lightbox;
		
		
		if ($use_prettyphoto =='yes'){	
			
			$html = '<a '. $class .'title ="'.$title.'" href="' . clean_url($url) ."\">$html</a>";
			
		} else {
		
			$html = '<a href="' . clean_url($url) . "\"$rel>$html</a>";
			
		}
	}

	$html = apply_filters( 'image_send_to_editor', $html, $id, $alt, $title, $align, $url, $size );

	return media_send_to_editor($html);
}





function amanuke_prettyPhoto_image_media_send_to_editor_prettyphoto($html, $attachment_id, $attachment) {
	$post =& get_post($attachment_id);
	if ( substr($post->post_mime_type, 0, 5) == 'image' ) {
		$url = $attachment['url'];

		if ( isset($attachment['align']) )
			$align = $attachment['align'];
		else
			$align = 'none';

		if ( !empty($attachment['image-size']) )
			$size = $attachment['image-size'];
		else
			$size = 'medium';

		
		if (isset($attachment['use_prettyphoto']))	$use_prettyphoto = $attachment['use_prettyphoto'];
		else $use_prettyphoto = 'no';
		if (isset($attachment['url_lightbox_type']))	$url_lightbox_type = $attachment['url_lightbox_type'];
		else $url_lightbox_type = '';
		if (isset($attachment['url_lightbox']))	$url_lightbox = $attachment['url_lightbox'];
		else $url_lightbox = '';
		if (isset($attachment['url_lightbox_group']))	$url_lightbox_group = $attachment['url_lightbox_group'];
		else $url_lightbox_group = '';

			$rel = ( $url == get_attachment_link($attachment_id) );

		return amanuke_prettyPhoto_get_image_send_to_editor_prettyphoto($attachment_id, $attachment['post_excerpt'], $attachment['post_title'], $align, $url, $rel, $size, $use_prettyphoto,$url_lightbox_type,$url_lightbox,$url_lightbox_group);
	}
	return $html;
}


add_filter('media_send_to_editor', 'amanuke_prettyPhoto_image_media_send_to_editor_prettyphoto', 10, 3);

function amanuke_prettyPhoto_head_css() {
        $myCSSUrl = plugins_url('css/prettyPhoto.css', __FILE__); // Respects SSL, Style.css is relative to the current file
        wp_register_style('amanuke_prettyPhoto', $myCSSUrl);
        wp_enqueue_style( 'amanuke_prettyPhoto');
}
add_action('wp_enqueue_scripts', 'amanuke_prettyPhoto_head_css');

function amanuke_prettyPhoto_register_scripts() {  
    wp_deregister_script('jquery');  
    wp_register_script('jquery', plugins_url('js/jquery-1.6.1.min.js', __FILE__), false, null);  
    wp_enqueue_script('jquery');  
	wp_register_script('prettyPhoto_script', plugins_url('js/jquery.prettyPhoto.js', __FILE__));  
    wp_enqueue_script('prettyPhoto_script');  
    wp_register_script('amanuke_prettyPhoto_script', plugins_url('js/amanuke_prettyPhoto.js', __FILE__));  
    wp_enqueue_script('amanuke_prettyPhoto_script');  
	
	//Default Variable Javascript
	$amanuke_pp_options = get_option("amanuke_pp_options");
	$params = array(
		  'theme' =>  amanuke_pp_isset_var($amanuke_pp_options,'amanuke_pp_theme','facebook'),
		  'autoplay' =>  amanuke_pp_isset_var($amanuke_pp_options,'amanuke_pp_autoplay','false'),
		  'autoplay_slideshow' =>  amanuke_pp_isset_var($amanuke_pp_options,'amanuke_pp_autoplay_slideshow','false'),
		  'opacity' =>  amanuke_pp_isset_var($amanuke_pp_options,'amanuke_pp_opacity','0.8'),
		  'slideshow' =>  amanuke_pp_isset_var($amanuke_pp_options,'amanuke_pp_slideshow','5000')
	);
	wp_localize_script( 'amanuke_prettyPhoto_script', 'Amanuke_PP', $params );
	//Default Variable Javascript Ends
} 
if (!is_admin()) {  
    add_action("wp_enqueue_scripts", "amanuke_prettyPhoto_register_scripts", 11);  
} 
?>