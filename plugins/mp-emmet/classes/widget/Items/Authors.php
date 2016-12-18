<?php
/**
 * Authors widget class
 *
 */
require_once 'Default.php';

class MP_Emmet_Plugin_Widget_Authors extends MP_Emmet_Plugin_Widget_Default {

    function __construct() {
        $this->setClassName('widget_authors');
        $this->setName('Authors');
        $this->setDescription('Authors');
        $this->setIdSuffix('authors');
        parent::__construct();
    }

    function widget($args, $instance) {
        extract($args);
        $title = (!empty($instance['title']) ) ? esc_html($instance['title']) : '';
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $number = (!empty($instance['number']) ) ? absint($instance['number']) : 3;
        if (!$number)
            $number = 3;
        ?>
        <?php echo $args['before_widget'];
        ?>
        <?php
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>
        <?php
        $display_admins = true;
        $order_by = 'post_count';       
        $role = (!empty($instance['role']) ) ? $instance['role'] : '';
        $avatar_size = 72;
        $hide_empty = true;

        if (!empty($display_admins)) {
            $blogusers = get_users('orderby=' . $order_by . '&role=' . $role.'&order=DESC');
        } else {
            $admins = get_users('role=administrator');
            $exclude = array();
            foreach ($admins as $ad) {
                $exclude[] = $ad->ID;
            }
            $exclude = implode(',', $exclude);
            $blogusers = get_users('exclude=' . $exclude . '&orderby=' . $order_by . '&role=' . $role);
        }
        $authors = array();
        foreach ($blogusers as $bloguser) {
            $user = get_userdata($bloguser->ID);
            if (!empty($hide_empty)) {
                $numposts = count_user_posts($user->ID);
                if ($numposts < 1)
                    continue;
            }
            $authors[] = (array) $user;
        }
        echo '<ul class="contributors">';
        $count = 0;
        foreach ($authors as $author) {
            $count++;
            $display_name = esc_html(get_the_author_meta('display_name', $author['ID']));
            $avatar = get_avatar($author['ID'], $avatar_size);
            $author_profile_url = esc_url(get_author_posts_url($author['ID']));
            $numposts = count_user_posts($author['ID']);
            $post = __('Posts', 'mp-emmet');
            if ($numposts == 1):
                $post = __('Post', 'mp-emmet');
            endif;
            echo '<li><a href="', $author_profile_url, '" class="entry-thumbnail">', $avatar, '</a>';
            echo '<div class="entry-content"><a href="', $author_profile_url, '" class="contributor-link">', $display_name, '</a><span class="posts-count">', $numposts, ' ', $post, '</span>
                </div><div class="clearfix"></div></li>';
            if ($number == $count)
                break;
        }
        echo '</ul>';
        ?>
        <?php echo $args['after_widget']; ?>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['role'] = $new_instance['role'];
        return $instance;
    }

    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $display_admins = isset($instance['display_admins']) ? (bool) $instance['display_admins'] : false;
        $number = isset($instance['number']) ? absint($instance['number']) : 3;
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'mp-emmet'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo $title; ?>" /></p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('role')); ?>"><?php _e('Role:', 'mp-emmet'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('role')); ?>" name="<?php echo esc_attr($this->get_field_name('role')); ?>" >
                <option value=""><?php _e('All User Roles', 'mp-emmet') ?></option>
                <?php wp_dropdown_roles($instance['role']); ?>
            </select>
        </p>
        <p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of authors to show:', 'mp-emmet'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>


        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget( "MP_Emmet_Plugin_Widget_Authors" );'));
