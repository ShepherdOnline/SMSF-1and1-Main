<?php
/**
 * Team  widget class
 *
 */
require_once 'Default.php';

class MP_Emmet_Plugin_Widget_Break extends MP_Emmet_Plugin_Widget_Default {

    function __construct() {
        $this->setClassName('theme_widget_break');
        $this->setName(__('Break', 'mp-emmet'));
        $this->setDescription(__('Use this widget to make next widget from new line.', 'mp-emmet'));
        $this->setIdSuffix('break');
        parent::__construct();
    }

    function widget($args, $instance) {
        extract($args);
        $text = '';
        if (isset($instance['visiblelgblock']) || isset($instance['visiblemdblock']) || isset($instance['visiblesmblock']) || isset($instance['visiblexsblock'])) {
            $lg = isset($instance['visiblelgblock']) ? ' visible-lg-block' : '';
            $md = isset($instance['visiblemdblock']) ? ' visible-md-block' : '';
            $sm = isset($instance['visiblesmblock']) ? ' visible-sm-block' : '';
            $xs = isset($instance['visiblexsblock']) ? ' visible-xs-block' : '';
            $text = '<div class="clearfix' . $lg . $md . $sm . $xs . '"></div>';
        }

        echo $text;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['visiblelgblock'] = $new_instance['visiblelgblock'];
        $instance['visiblemdblock'] = $new_instance['visiblemdblock'];
        $instance['visiblesmblock'] = $new_instance['visiblesmblock'];
        $instance['visiblexsblock'] = $new_instance['visiblexsblock'];
        return $instance;
    }

    function form($instance) {

        $visiblelgblock = isset($instance['visiblelgblock']) ? (bool) $instance['visiblelgblock'] : false;
        $visiblemdblock = isset($instance['visiblemdblock']) ? (bool) $instance['visiblemdblock'] : false;
        $visiblesmblock = isset($instance['visiblesmblock']) ? (bool) $instance['visiblesmblock'] : false;
        $visiblexsblock = isset($instance['visiblexsblock']) ? (bool) $instance['visiblexsblock'] : false;
        ?>
        <div style="margin-top:10px;"><p><?php _e('Use this widget to make next widget from new line.', 'mp-emmet'); ?></p></div>
        <p><input class="checkbox" type="checkbox" <?php checked($visiblelgblock); ?> id="<?php echo esc_attr($this->get_field_id('visiblelgblock')); ?>" name="<?php echo esc_attr($this->get_field_name('visiblelgblock')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('visiblelgblock')); ?>"><?php _e('Apply on wide-screen', 'mp-emmet'); ?></label></p>
        <p><input class="checkbox" type="checkbox" <?php checked($visiblemdblock); ?> id="<?php echo esc_attr($this->get_field_id('visiblemdblock')); ?>" name="<?php echo esc_attr($this->get_field_name('visiblemdblock')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('visiblemdblock')); ?>"><?php _e('Apply on desktop', 'mp-emmet'); ?></label></p>
        <p><input class="checkbox" type="checkbox" <?php checked($visiblesmblock); ?> id="<?php echo esc_attr($this->get_field_id('visiblesmblock')); ?>" name="<?php echo esc_attr($this->get_field_name('visiblesmblock')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('visiblesmblock')); ?>"><?php _e('Apply on tablet', 'mp-emmet'); ?></label></p>
        <p><input class="checkbox" type="checkbox" <?php checked($visiblexsblock); ?> id="<?php echo esc_attr($this->get_field_id('visiblexsblock')); ?>" name="<?php echo esc_attr($this->get_field_name('visiblexsblock')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('visiblexsblock')); ?>"><?php _e('Apply on mobile', 'mp-emmet'); ?></label></p>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget( "MP_Emmet_Plugin_Widget_Break" );'));
