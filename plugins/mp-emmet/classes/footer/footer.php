<?php

/*
 * Class MP_Emmet_Plugin_Footer
 *
 * add actions for default widgets if footer
 */

class MP_Emmet_Plugin_Footer {

    private $args;
    private $instance;

    public function __construct() {
        $this->args = array(
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>'
        );
        $this->instance = array();
        
        
        add_action('mp_emmet_footer_default_widget_about', array($this, 'default_widget_about'));

        add_action('mp_emmet_footer_default_recent_posts', array($this, 'default_recent_posts'));

        add_action('mp_emmet_footer_default_widget_authors', array($this, 'default_widget_authors'));
    }

    /*
     * get dafault MP_Emmet_Plugin_Widget_About
     */

    public function default_widget_about() {

        wp_cache_delete('widget_about', 'widget');
		$instance = array(
			'title' => __('About us', 'mp-emmet'),
			'text' => __('The company with over 5 years experience of delivering best consulting services for personal and business needs.', 'mp-emmet'),
		);
        the_widget('MP_Emmet_Plugin_Widget_About', $instance, $this->args);
    }

    /*
     * get dafault MP_Emmet_Plugin_Widget_RecentPosts
     */

    public function default_recent_posts() {
        wp_cache_delete('theme_widget_recent_posts', 'widget');
		$instance = array(
			'title' => __('Recent Posts', 'mp-emmet'),
		);
        the_widget('MP_Emmet_Plugin_Widget_RecentPosts', $instance, $this->args);
    }

    /*
     * get dafault MP_Emmet_Plugin_Widget_Authors
     */

    public function default_widget_authors() {
        wp_cache_delete('widget_authors', 'widget');
		$instance = array(
			'title' => __('Authors', 'mp-emmet'),
		);
        the_widget('MP_Emmet_Plugin_Widget_Authors', $instance, $this->args);
    }

}

new MP_Emmet_Plugin_Footer();
