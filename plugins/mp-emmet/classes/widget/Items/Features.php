<?php
/**
 * Features  widget class
 *
 */
require_once 'Default.php';

class MP_Emmet_Plugin_Widget_Features extends MP_Emmet_Plugin_Widget_Default {

    function __construct() {
        $this->setClassName('theme_widget_features');
        $this->setName(__('Feature', 'mp-emmet'));
        $this->setDescription(__('Feature', 'mp-emmet'));
        $this->setIdSuffix('features');
        parent::__construct();
    }

    public function img_url($instance) {
        global $wpdb;
        $image_src =(!empty($instance['image_uri']) ) ? esc_attr($instance['image_uri']) : '';
        if (!empty($image_src)):
            $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
            $id = $wpdb->get_var($query);
            if (is_null($id)):
                return $image_src;
            endif;
            $image_uri = wp_get_attachment_image_src($id, array(168, 168));
            return $image_uri[0];
        endif;
        return '';
    }

    function widget($args, $instance) {
        extract($args);
        $column_xs = (!empty($instance['column_xs']) ) ? esc_attr($instance['column_xs']) : '12';
        $column_sm = (!empty($instance['column_sm']) ) ? esc_attr($instance['column_sm']) : '6';
        $column_md = (!empty($instance['column_md']) ) ? esc_attr($instance['column_md']) : '3';
        $column_lg = (!empty($instance['column_lg']) ) ? esc_attr($instance['column_lg']) : '3';
        $name = (!empty($instance['name']) ) ? esc_html($instance['name']) : '';
        $text = (!empty($instance['text']) ) ? esc_html($instance['text']) : '';
        $image_uri = $this->img_url($instance);
        $link = (!empty($instance['link']) ) ? esc_url($instance['link']) : '';
        $button = (!empty($instance['button']) ) ? esc_html($instance['button']) : '';

        if ($column_xs === 'none' || $column_sm === 'none' || $column_md === 'none' || $column_lg === 'none') {
            echo $before_widget;
        } else {
            echo '<div class="widget theme_widget_features  col-xs-' . $column_xs . ' col-sm-' . $column_sm . ' col-md-' . $column_md . ' col-lg-' . $column_lg . '">';
        }
        ?>
        <div class = "features-box">
            <?php if (!empty($image_uri)):
                ?>
                <div class="features-icon">
                    <img src="<?php echo $image_uri; ?>" alt="<?php echo $name; ?>">
                </div>
            <?php endif; ?>
            <?php if (!empty($name)): ?>
                <h4 class="features-title"><?php echo $name; ?></h4>
            <?php endif; ?>
            <?php
            if (!empty($text)):
                echo '<p class="features-content">';
                echo htmlspecialchars_decode($text);
                echo '</p>';
            endif;
            ?>	
            <?php if (!empty($link) && !empty($button)): ?>
                <a class="features-more" href="<?php echo $link; ?>" title="<?php echo $button; ?>"><?php echo $button; ?></a>
            <?php endif; ?>
        </div>
        <?php
        if ($column_xs === 'none' || $column_sm === 'none' || $column_md === 'none' || $column_lg === 'none') {
            echo $after_widget;
        } else {
            echo '</div>';
        }
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['text'] = stripslashes(wp_filter_post_kses($new_instance['text']));
        $instance['name'] = strip_tags($new_instance['name']);
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['button'] = strip_tags($new_instance['button']);
        $instance['image_uri'] = strip_tags($new_instance['image_uri']);
        $instance['column_xs'] = strip_tags($new_instance['column_xs']);
        $instance['column_sm'] = strip_tags($new_instance['column_sm']);
        $instance['column_md'] = strip_tags($new_instance['column_md']);
        $instance['column_lg'] = strip_tags($new_instance['column_lg']);
        return $instance;
    }

    public function get_upload_image($instance) {
        echo '<img class="custom_media_image" src="';
        if (!empty($instance['image_uri'])) :
            echo $instance['image_uri'];
        endif;
        echo '" style="margin:0;padding:0;max-width:100%;';
        if (!empty($instance['image_uri'])) :
            echo 'display:block;';
        else:
            echo 'display:none;';
        endif;
        echo '" />';
    }

    function form($instance) {
        $column_xs = (!empty($instance['column_xs']) ) ? $instance['column_xs'] : '12';
        $column_sm = (!empty($instance['column_sm']) ) ? $instance['column_sm'] : '6';
        $column_md = (!empty($instance['column_md']) ) ? $instance['column_md'] : '3';
        $column_lg = (!empty($instance['column_lg']) ) ? $instance['column_lg'] : '3';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('image_uri')); ?>"><?php _e('Image', 'mp-emmet'); ?></label><br/>
            <?php $this->get_upload_image($instance); ?>
            <input type="text" class="widefat custom_media_url" name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>"
                   id="<?php echo esc_attr($this->get_field_id('image_uri')); ?>" value="<?php
                   if (!empty($instance['image_uri'])): echo esc_attr($instance['image_uri']);
                   endif;
                   ?>"
                   style="margin-top:5px;">
            <input type="button" class="button button-primary theme_media_button" id="custom_media_button"
                   name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>" value="<?php _e('Upload Image', 'mp-emmet'); ?>"
                   style="margin-top:5px;"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('name')); ?>"><?php _e('Title', 'mp-emmet'); ?></label><br/>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('name')); ?>"
                   id="<?php echo esc_attr($this->get_field_id('name')); ?>" value="<?php
                   if (!empty($instance['name'])): echo esc_attr($instance['name']);
                   endif;
                   ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php _e('Text', 'mp-emmet'); ?></label><br/>
            <textarea class="widefat" rows="8" cols="20" name="<?php echo esc_attr($this->get_field_name('text')); ?>"
                      id="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php
                          if (!empty($instance['text'])): echo htmlspecialchars_decode($instance['text']);
                          endif;
                          ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('button')); ?>"><?php _e('Button text', 'mp-emmet'); ?></label><br />
            <input type="text" name="<?php echo esc_attr($this->get_field_name('button')); ?>" id="<?php echo esc_attr($this->get_field_id('button')); ?>" value="<?php
            if (!empty($instance['button'])): echo esc_attr($instance['button']);
            endif;
            if (count($instance) === 0) :
                _e('Read more', 'mp-emmet');
            endif;
            ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php _e('Button link', 'mp-emmet'); ?></label><br />
            <input type="text" name="<?php echo esc_attr($this->get_field_name('link')); ?>" id="<?php echo esc_attr($this->get_field_id('link')); ?>" value="<?php
            if (!empty($instance['link'])): echo esc_attr($instance['link']);
            endif;
            if (count($instance) === 0) :
                echo '#';
            endif;
            ?>" class="widefat" />
        </p>
        <div style="overflow:hidden;  margin: 0 0 1em;">
            <label for="colums"><?php _e('Widget Size (x of 12):', 'mp-emmet'); ?></label><br/>
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo esc_attr($this->get_field_id('column_xs')); ?>"><?php _e('Phone', 'mp-emmet'); ?></label><br/>
                <select name="<?php echo esc_attr($this->get_field_name('column_xs')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('column_xs')); ?>">
                    <option value="none" <?php
                    if ($column_xs === 'none'): echo ' selected ';
                    endif;
                    ?>>none</option>
                    <option value="1" <?php
                    if ($column_xs === '1'): echo ' selected ';
                    endif;
                    ?>>1</option>
                    <option value="2" <?php
                    if ($column_xs === '2'): echo ' selected ';
                    endif;
                    ?>>2</option>                
                    <option value="3" <?php
                    if ($column_xs === '3'): echo ' selected ';
                    endif;
                    ?>>3</option>
                    <option value="4" <?php
                    if ($column_xs === '4'): echo ' selected ';
                    endif;
                    ?>>4</option>
                    <option value="6" <?php
                    if ($column_xs === '6'): echo ' selected ';
                    endif;
                    ?>>6</option>
                    <option value="12" <?php
                    if ($column_xs === '12'): echo ' selected ';
                    endif;
                    ?>>12</option>
                </select>
            </p>  
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo esc_attr($this->get_field_id('column_sm')); ?>"><?php _e('Tablet', 'mp-emmet'); ?></label><br/>
                <select name="<?php echo esc_attr($this->get_field_name('column_sm')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('column_sm')); ?>">
                    <option value="none" <?php
                    if ($column_sm === 'none'): echo ' selected ';
                    endif;
                    ?>>none</option>
                    <option value="1" <?php
                    if ($column_sm === '1'): echo ' selected ';
                    endif;
                    ?>>1</option>
                    <option value="2" <?php
                    if ($column_sm === '2'): echo ' selected ';
                    endif;
                    ?>>2</option>                
                    <option value="3" <?php
                    if ($column_sm === '3'): echo ' selected ';
                    endif;
                    ?>>3</option>
                    <option value="4" <?php
                    if ($column_sm === '4'): echo ' selected ';
                    endif;
                    ?>>4</option>
                    <option value="6" <?php
                    if ($column_sm === '6'): echo ' selected ';
                    endif;
                    ?>>6</option>
                    <option value="12" <?php
                    if ($column_sm === '12'): echo ' selected ';
                    endif;
                    ?>>12</option>
                </select>
            </p>  
        </div>
        <div style="overflow:hidden;  margin: 0 0 1em;">
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo esc_attr($this->get_field_id('column_md')); ?>"><?php _e('Desktop', 'mp-emmet'); ?></label><br/>
                <select name="<?php echo esc_attr($this->get_field_name('column_md')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('column_md')); ?>">
                    <option value="none" <?php
                    if ($column_md === 'none'): echo ' selected ';
                    endif;
                    ?>>none</option>
                    <option value="1" <?php
                    if ($column_md === '1'): echo ' selected ';
                    endif;
                    ?>>1</option>
                    <option value="2" <?php
                    if ($column_md === '2'): echo ' selected ';
                    endif;
                    ?>>2</option>                
                    <option value="3" <?php
                    if ($column_md === '3'): echo ' selected ';
                    endif;
                    ?>>3</option>
                    <option value="4" <?php
                    if ($column_md === '4'): echo ' selected ';
                    endif;
                    ?>>4</option>
                    <option value="6" <?php
                    if ($column_md === '6'): echo ' selected ';
                    endif;
                    ?>>6</option>
                    <option value="12" <?php
                    if ($column_md === '12'): echo ' selected ';
                    endif;
                    ?>>12</option>

                </select>
            </p> 
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo esc_attr($this->get_field_id('column_lg')); ?>"><?php _e('Large Desktop', 'mp-emmet'); ?></label><br/>
                <select name="<?php echo esc_attr($this->get_field_name('column_lg')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('column_lg')); ?>">
                    <option value="none" <?php
                    if ($column_lg === 'none'): echo ' selected ';
                    endif;
                    ?>>none</option>
                    <option value="1" <?php
                    if ($column_lg === '1'): echo ' selected ';
                    endif;
                    ?>>1</option>
                    <option value="2" <?php
                    if ($column_lg === '2'): echo ' selected ';
                    endif;
                    ?>>2</option>                
                    <option value="3" <?php
                    if ($column_lg === '3'): echo ' selected ';
                    endif;
                    ?>>3</option>
                    <option value="4" <?php
                    if ($column_lg === '4'): echo ' selected ';
                    endif;
                    ?>>4</option>
                    <option value="6" <?php
                    if ($column_lg === '6'): echo ' selected ';
                    endif;
                    ?>>6</option>
                    <option value="12" <?php
                    if ($column_lg === '12'): echo ' selected ';
                    endif;
                    ?>>12</option>
                </select>
            </p> 
        </div>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget( "MP_Emmet_Plugin_Widget_Features" );'));
