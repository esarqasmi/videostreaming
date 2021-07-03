<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_posts'))
{
    function get_posts($cat_name,$lang){
	$ci=& get_instance();
	$ci->load->database();
	$ci->load->model('content_model');  
	$posts=$ci->content_model->get_content_list_by_category('post', $lang, $cat_name); 

      return $posts;
    }   
}



if ( ! function_exists('get_posts_hod'))
{
    function get_posts_hod($cat_name,$lang){
	$ci=& get_instance();
	$ci->load->database();
	$ci->load->model('content_model');  
	$posts=$ci->content_model->get_content_list_by_category_hod('post', $lang, $cat_name); 

      return $posts;
    }   
}


if ( ! function_exists('get_posts_asc'))
{
    function get_posts_asc($cat_name,$lang){
	$ci=& get_instance();
	$ci->load->database();
	$ci->load->model('content_model');  
	$posts=$ci->content_model->get_content_list_by_category_asc('post', $lang, $cat_name); 

      return $posts;
    }   
}


if ( ! function_exists('get_posts_by_content_type'))
{
    function get_posts_by_content_type($content_type,$lang){
	$ci=& get_instance();
	$ci->load->database();
	$ci->load->model('content_model');   
	$list_content = $ci->content_model->get_content_list($content_type,$lang);  
      return $list_content;
    }   
}
//get posts by category_id  // for listing page
if ( ! function_exists('get_posts_by_cat_id'))
{
    function get_posts_by_cat_id($id,$lang, $content_type){
	$ci=& get_instance();
	$ci->load->database();
	$ci->load->model('content_model');  
	$posts=$ci->content_model->get_content_list_by_category($lang, $id,$content_type);
 
      return $posts;
    }   
}


if ( ! function_exists('get_meta'))
{
    function get_meta($content_id,$lang='en'){
	$ci=& get_instance();
	$ci->load->database();
	$ci->load->model('content_model');  
	$meta=$ci->content_model->get_post_meta($content_id, $lang); 
 
      return $meta;
    }   
}

if ( ! function_exists('load_gallery'))
{
    function load_gallery($gallery_id,$lang){
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->load->model('gallery_model');  
	$urls=$ci->gallery_model->get_gallery_by_id($gallery_id,$lang);
 
      return $urls;
    }   
}



function is_serialized( $data ) {
    // if it isn't a string, it isn't serialized
    if ( !is_string( $data ) )
        return false;
    $data = trim( $data );
    if ( 'N;' == $data )
        return true;
    if ( !preg_match( '/^([adObis]):/', $data, $badions ) )
        return false;
    switch ( $badions[1] ) {
        case 'a' :
        case 'O' :
        case 's' :
            if ( preg_match( "/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data ) )
                return true;
            break;
        case 'b' :
        case 'i' :
        case 'd' :
            if ( preg_match( "/^{$badions[1]}:[0-9.E-]+;\$/", $data ) )
                return true;
            break;
    }
    return false;
}

//get category ID from name provided
if ( ! function_exists('get_category_ID')){
    function get_category_ID($cat_name) {
        
     $ci=& get_instance();
     $ci->load->database(); 
      
     $sql = "SELECT id,category FROM category where category_slug ='".$cat_name."' LIMIT 1"; 
     $query = $ci->db->query($sql);
      
         $category_id = ''; 
          
         if($query->num_rows()>0)
         {  
              $category_id=$query->result(); 
              $category_id=$category_id[0];
              $category_id=$category_id->id;
             // $category_id=$category_id->category;
             
         } 
     return $category_id;
 }   
 }
