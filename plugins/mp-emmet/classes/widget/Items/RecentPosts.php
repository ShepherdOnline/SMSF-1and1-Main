<?php
/**
 *  Show recent posts
 */
require_once 'Default.php';
require_once 'Interface/Cache.php';

class MP_Emmet_Plugin_Widget_RecentPosts extends MP_Emmet_Plugin_Widget_Default implements MP_Emmet_Plugin_Widget_Interface_Cache {

    const RECENT_POST_TRANSIENT = 'sDF12as';

    function __construct() {
        $this->setClassName('theme_widget_recent_posts');
        $this->setName(__('Recent posts', 'mp-emmet'));
        $this->setDescription(__('Show recent posts', 'mp-emmet'));
        $this->setIdSuffix('recent-posts');
        parent::__construct();
        add_action('save_post', array(&$this, 'action_clear_widget_cache'));
    }

    function action_clear_widget_cache($postID) {
        if (get_post_type($postID) == 'post') {
            $temp_number = $this->number;

            $settings = $this->get_settings();

            if (is_array($settings)) {
                foreach (array_keys($settings) as $number) {
                    if (is_numeric($number)) {
                        $this->number = $number;
                        $this->deleteWidgetCache();
                    }
                }
            }
            $this->number = $temp_number;
        }
    }

    function widget($args, $instance) {

        $cache = array();
        if (!$this->is_preview()) {
            $cache = wp_cache_get('widget_recent_posts', 'widget');
        }

        if (!is_array($cache)) {
            $cache = array();
        }

        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();

        $title = (!empty($instance['title']) ) ? $instance['title'] : '';
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $number = (!empty($instance['number']) ) ? absint($instance['number']) : 3;
        if (!$number)
            $number = 3;
        $show_thumbnail = isset($instance['show_thumbnail']) ? (bool) $instance['show_thumbnail'] : true;

        $r = new WP_Query(apply_filters('widget_posts_args', array(
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true
        )));

        if ($r->have_posts()) :
            ?>
            <?php echo $args['before_widget']; ?>
            <?php
            if ($title) {
                echo $args['before_title'] . esc_html($title) . $args['after_title'];
            }
            ?>
            <ul>
                <?php while ($r->have_posts()) : $r->the_post(); ?>
                    <li>
                        <?php if ($show_thumbnail) : ?>
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" class="entry-thumbnail">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </a>
                            <?php else: ?>
                                <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" class="entry-thumbnail empty-entry-thumbnail">
                                    <span class="date-post">
                                        <?php echo get_post_time('j M'); ?>
                                    </span>
                                </a>                                
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="entry-content">                        
                            <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php echo $args['after_widget']; ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

        endif;

        if (!$this->is_preview()) {
            $cache[$args['widget_id']] = ob_get_flush();
            wp_cache_set('widget_recent_posts', $cache, 'widget');
        } else {
            ob_end_flush();
        }
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
		$instance['show_thumbnail'] = isset($new_instance['show_thumbnail']);
		
        wp_cache_delete('widget_recent_posts', 'widget');

        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['widget_recent_entries']))
            delete_option('widget_recent_entries');

        return $instance;
    }


    function form($instance) {

        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 3;
        //$show_date = isset($instance['show_date']) ? (bool) $instance['show_date'] : true;
        ?>

        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'mp-emmet'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of posts to show:', 'mp-emmet'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox" <?php checked(isset($instance['show_thumbnail']) ? $instance['show_thumbnail'] : true); ?> id="<?php echo esc_attr($this->get_field_id('show_thumbnail')); ?>" name="<?php echo esc_attr($this->get_field_name('show_thumbnail')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_thumbnail')); ?>"><?php _e('Display post thumbnail?', 'mp-emmet'); ?></label></p>
        <?php
    }

    private function getRecentPosts($instance) {

        if (false === ($post_list = $this->getCachedWidgetData())) {

            $this->reinitWidgetCache($instance);
        } else {

            return $post_list;
        }
        return $this->getCachedWidgetData();
    }

    /**
     * Delete cache
     * @global type $sitepress WPML plugin
     * @param boolean $all - delete for all language cache
     */
    public function deleteWidgetCache() {
        global $sitepress;

        if ($sitepress && is_object($sitepress) && method_exists($sitepress, 'get_active_languages')) {
            foreach ($sitepress->get_active_languages() as $lang) {

                if (isset($lang['code'])) {
                    delete_site_transient($this->getTransientId($lang['code']));
                }
            }
        }

        delete_site_transient($this->getTransientId()); // clear cache
    }

    public function getCachedWidgetData() {
        return get_site_transient($this->getTransientId());
    }

    public function getExparationTime() {
        return self::EXPIRATION_HOUR;
    }

    public function getTransientId($code = '') {
        $key = self::RECENT_POST_TRANSIENT;
        if ($code) {
            $key .= '_' . $code;
        } elseif ($this->isWPML_PluginActive()) { // wpml
            $key .= '_' . ICL_LANGUAGE_CODE;
        }

        return $this->get_field_id($key);
    }

    public function reinitWidgetCache($instance) {
        $number = (int) $instance['number'];
        $recent_posts = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));

        set_site_transient($this->getTransientId(), $recent_posts, $this->getExparationTime());
    }

}

add_action('widgets_init', create_function('', 'return register_widget( "MP_Emmet_Plugin_Widget_RecentPosts" );'));
