<?php

/*
 * Plugin Name: Emmet Theme Engine
 * Description: Adds Portfolio and Front Page Sections to Emmet theme.
 * Version: 1.2.7
 * Author: MotoPress
 * Author URI: http://www.getmotopress.com/
 * License: GPLv2 or later
 * Text Domain: mp-emmet
 * Domain Path: /languages
 */

// Path to classes folder in Plugin
defined('MP_EMMET_PLUGIN_CLASS_PATH') || define('MP_EMMET_PLUGIN_CLASS_PATH', plugin_dir_path(__FILE__) . 'classes/');
defined('MP_EMMET_PLUGIN_PATH') || define('MP_EMMET_PLUGIN_PATH', plugin_dir_url(__FILE__));

class MP_EMMET_PLUGIN {

    public function __construct() {
        load_plugin_textdomain('mp-emmet', false, dirname(plugin_basename(__FILE__)) . '/languages/');
        $this->include_files();
        $this->init_plugin_emmet();

        add_action('admin_init', array($this, 'admin_init'));
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
        //Sections  
        $this->init_sections();
    }

    public function init_plugin_emmet() {
        new MP_Emmet_Plugin_Widget_Registrator();
    }

    /*
     * Include sections classes
     */

    public function include_files() {
        //Include posttype 
        //Include posttype
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/posttype/portfolio.php';

        //Include widgets 
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/widget/Registrator.php';

        //Include sections 
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/sections/contact.php';
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/sections/features.php';
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/sections/portfolio.php';
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/sections/plan.php';
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/sections/map.php';
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/sections/testimonials.php';
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/sections/install.php';
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/sections/team.php';

        //Inclide footer defaults widget
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/footer/footer.php';


        //Inclide customizer for sections         
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/customiser/customiser.php';
    }

    /*
     * Init sections  
     */

    public function init_sections() {
        new MP_Emmet_Plugin_Contact();
        new MP_Emmet_Plugin_Features();
        new MP_Emmet_Plugin_Portfolio();
        new MP_Emmet_Plugin_Plan();
        new MP_Emmet_Plugin_Map();
        new MP_Emmet_Plugin_Testimonials();
        new MP_Emmet_Plugin_Install();
        new MP_Emmet_Plugin_Team();
    }

    /*
     * Admin init
     */

    public function admin_init() {
        add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));
        add_action('load-widgets.php', array($this, 'widget_load'));
    }

    /*
     * Load  color picker scripts
     */

    public function widget_load() {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        
    }

    /*
     * Register admin scripts
     */

    public function register_admin_scripts($hook) {
        if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
        $dependency = array(
            'jquery'
        );
        if (wp_register_script('mp_emmet_plugin_widget', MP_EMMET_PLUGIN_PATH . 'js/widget.js', $dependency, '1.0', true)) {
            wp_enqueue_script('mp_emmet_plugin_widget');
        }
        if ( 'widgets.php' != $hook ) {
            return;
        }
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }

    /*
     * Register  scripts
     */

    public function register_scripts() {
        if (is_page_template('template-front-page.php')) {
            $dependency = array(
                'jquery'
            );
            if (wp_register_script('mp_emmet_recaptcha', MP_EMMET_PLUGIN_PATH . 'js/mp_emmet_recaptcha.js', $dependency, '1.0', true)) {
                wp_enqueue_script('mp_emmet_recaptcha');
            }
        }
    }

}

new MP_EMMET_PLUGIN;
