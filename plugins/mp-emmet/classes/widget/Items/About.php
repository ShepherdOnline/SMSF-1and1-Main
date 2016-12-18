<?php
/**
 * About widget class
 *
 */
require_once 'Default.php';

class MP_Emmet_Plugin_Widget_About extends MP_Emmet_Plugin_Widget_Default {

    function __construct() {
        $this->setClassName('theme_widget_about');
        $this->setName(__('About Us', 'mp-emmet'));
        $this->setDescription(__('About us', 'mp-emmet'));
        $this->setIdSuffix('about');
        parent::__construct();
    }

    function widget($args, $instance) {
        extract($args);
        $title = empty($instance['title']) ? '' : $instance['title'];
        $text = empty($instance['text']) ? '' : $instance['text'];
        $logo = true;
        if (count($instance) && isset($instance['logo'])) {
            $logo = $instance['logo'] === null ? true : $instance['logo'];
        }
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . esc_html($title) . $after_title;
        }
        ?>
        <?php if ($logo): ?>
            <div class="site-logo ">
                <?php if (get_theme_mod('theme_logo', false) === false) : ?> 
                    <div class="header-logo "><img src="<?php echo (get_template_directory_uri() . '/images/headers/logo.png'); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"></div>
                <?php else: ?>
                    <?php if (get_theme_mod('theme_logo')) : ?> 
                        <div class="header-logo "><img src="<?php echo esc_url(get_theme_mod('theme_logo')); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"></div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="site-description">
                    <h1 class="site-title <?php if (!get_bloginfo('description')) : ?>empty-tagline<?php endif; ?>"><?php bloginfo('name'); ?></h1>
                    <?php if (get_bloginfo('description')) : ?>
                        <p class="site-tagline"><?php bloginfo('description'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="site-about"><?php echo wp_kses_data($text); ?></div>
        <?php
        $location = get_theme_mod('theme_location_info');
        $phone = get_theme_mod('theme_phone_info');
        ?>
        <div class="contact-info">
            <ul class=" info-list">
                <?php if (get_theme_mod('theme_location_info', false) === false) : ?>
                    <li class="address-wrapper"><?php echo MP_EMMET_DEFAULT_ADDRESS; ?></li>                                    
                <?php else: ?>
                    <?php if (!empty($location)): ?>
                        <li class="address-wrapper"><?php echo wp_kses_data($location); ?></li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (get_theme_mod('theme_phone_info', false) === false) : ?>
                    <li class="phone-wrapper"><?php echo MP_EMMET_DEFAULT_PHONE; ?></li>
                <?php else: ?>
                    <?php if (!empty($phone)): ?>
                        <li class="phone-wrapper"><?php echo wp_kses_data($phone); ?></li>
                    <?php endif; ?>
                <?php endif; ?>     
            </ul> 
        </div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        if (current_user_can('unfiltered_html'))
            $instance['text'] = $new_instance['text'];
        else
            $instance['text'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['text']))); 
        $instance['logo'] = isset($new_instance['logo']);
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'text' => ''));
        $title = strip_tags($instance['title']);
        $text = esc_textarea($instance['text']);
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'mp-emmet'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_textarea($text); ?></textarea>

        <p><input id="<?php echo esc_attr($this->get_field_id('logo')); ?>" name="<?php echo esc_attr($this->get_field_name('logo')); ?>" type="checkbox" <?php checked(isset($instance['logo']) ? $instance['logo'] : true); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('logo')); ?>"><?php _e('Show logo', 'mp-emmet'); ?></label></p>

        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget( "MP_Emmet_Plugin_Widget_About" );'));
