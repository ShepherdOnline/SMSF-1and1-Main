<?php 
add_action('init', 'portfolio_register');  
   
function portfolio_register() {  
    $args = array(  
        'label' => __('Portfolio', 'mp-emmet'),  
        'singular_label' => __('Project', 'mp-emmet'),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'taxonomies' => array('category'),  
        'supports' => array('title', 'editor', 'thumbnail')  
       );  
   
    register_post_type( 'portfolio' , $args );  
}