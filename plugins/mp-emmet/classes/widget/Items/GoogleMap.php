<?php
/**
 * GoogleMap  widget class
 *
 */
require_once 'Default.php';

class MP_Emmet_Plugin_Widget_GoogleMap extends MP_Emmet_Plugin_Widget_Default {

    function __construct() {
        $this->setClassName('theme_widget_google-map');
        $this->setName(__('GoogleMap', 'mp-emmet'));
        $this->setDescription(__('GoogleMap', 'mp-emmet'));
        $this->setIdSuffix('googlemap');
        parent::__construct();
    }
    function widget($args, $instance) {
        extract($args);
        if (!( empty($instance['latidute']) || empty($instance['longitude']) )):
            $key = (!empty($instance['key']) ) ? "key=" . $instance['key'] : "";
            wp_register_script('mp-emmet-plugin-wppa-geo', "https://maps.googleapis.com/maps/api/js?" . $key, array('jquery'), '4.3');
            wp_enqueue_script('mp-emmet-plugin-wppa-geo');
            wp_localize_script('mp-emmet-plugin-wppa-geo', 'php_params', '');
            wp_register_script('mp-emmet-plugin-map-script',  MP_EMMET_PLUGIN_PATH. "js/map.js", array('jquery'), '1.0', true);
            wp_enqueue_script('mp-emmet-plugin-map-script');
            wp_localize_script('mp-emmet-plugin-map-script', 'php_params', '');
            $zoom = empty($instance['zoom']) ? 17 : esc_attr($instance['zoom']);
            $description = empty($instance['text']) ? '' : $instance['text'];
            $width = empty($instance['width']) ? '100%' : esc_attr($instance['width']);
            $height = empty($instance['height']) ? '625px' : esc_attr($instance['height']);
			
			$description = wp_kses($description, array(
				'strong' => array(),
				'a' => array('href'),
				'p' => array(),
				'br' => array(),
			));

            echo $before_widget;
            ?>
            <div class="map_block  ">
                <div id="map" style='width:<?php echo $width; ?>; height: <?php echo $height; ?>;'  data-latidute='<?php echo esc_attr($instance['latidute']); ?>' data-longitude='<?php echo esc_attr($instance['longitude']); ?>' data-zoom='<?php echo $zoom; ?>' data-description='<?php echo $description; ?>'></div>	
            </div>            
            <?php
            echo $after_widget;
        endif;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['text'] = stripslashes(wp_filter_post_kses($new_instance['text']));
        $instance['latidute'] = strip_tags($new_instance['latidute']);
        $instance['longitude'] = strip_tags($new_instance['longitude']);
        $instance['zoom'] = intval($new_instance['zoom']);
        $instance['width'] = strip_tags($new_instance['width']);
        $instance['height'] = strip_tags($new_instance['height']);
        $instance['key'] = strip_tags($new_instance['key']);
        return $instance;
    }

    function form($instance) {
        ?>

        <p><label for="<?php echo esc_attr($this->get_field_id('key')); ?>"><?php _e('API key', 'mp-emmet'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('key')); ?>" name="<?php echo esc_attr($this->get_field_name('key')); ?>" type="text" value="<?php
            if (!empty($instance['key'])): echo esc_attr($instance['key']);
            endif;
            ?>" /></p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('latidute')); ?>"><?php _e('You latidute', 'mp-emmet'); ?></label><br/>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('latidute')); ?>"
                   id="<?php echo esc_attr($this->get_field_id('latidute')); ?>" value="<?php
                   if (!empty($instance['latidute'])): echo esc_attr($instance['latidute']);
                   endif;
                   ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('longitude')); ?>"><?php _e('You longitude', 'mp-emmet'); ?></label><br/>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('longitude')); ?>"
                   id="<?php echo esc_attr($this->get_field_id('longitude')); ?>" value="<?php
                   if (!empty($instance['longitude'])): echo esc_attr($instance['longitude']);
                   endif;
                   ?>"
                   class="widefat" />
        </p>
        <p>
            <label  for="<?php echo esc_attr($this->get_field_id('zoom')) . '-label'; ?>"><?php _e('Zoom level', 'mp-emmet'); ?></label><br/>
            <input name="<?php echo esc_attr($this->get_field_name('zoom')); ?>" type="range" step="1" min="3" max='21' id="<?php echo $this->get_field_id('zoom'); ?>" 
                   value="<?php echo (!empty($instance['zoom']) ) ? esc_attr($instance['zoom']) : "17"; ?>" class="range-input"><label for='<?php echo esc_attr($this->get_field_id('zoom')); ?>' id="label-<?php echo esc_attr($this->get_field_id('zoom')); ?>" style='margin: 0 5px;vertical-align: top;'><?php echo (!empty($instance['zoom']) ) ? esc_attr($instance['zoom']) : "17"; ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('width')); ?>"><?php _e('Map width (default 100%)', 'mp-emmet'); ?></label><br/>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('width')); ?>"
                   id="<?php echo esc_attr($this->get_field_id('width')); ?>" value="<?php
                   if (!empty($instance['width'])): echo esc_attr($instance['width']);
                   endif;
                   ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('height')); ?>"><?php _e('Map height (default 625px)', 'mp-emmet'); ?></label><br/>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('height')); ?>"
                   id="<?php echo esc_attr($this->get_field_id('height')); ?>" value="<?php
                   if (!empty($instance['height'])): echo esc_attr($instance['height']);
                   endif;
                   ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php _e('Tooltip text', 'mp-emmet'); ?></label><br/>
            <textarea class="widefat" rows="8" cols="20" name="<?php echo esc_attr($this->get_field_name('text')); ?>"
                      id="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php
                          if (!empty($instance['text'])): echo htmlspecialchars_decode($instance['text']);
                          endif;
                          ?></textarea>
        </p>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget( "MP_Emmet_Plugin_Widget_GoogleMap" );'));
