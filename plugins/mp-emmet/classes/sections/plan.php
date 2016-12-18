<?php

class MP_Emmet_Plugin_Plan {

    public function __construct() {
        add_action('mp_emmet_section_plan', array($this, 'get_html'));
    }

    /*
     * Get default sidebar 
     */

    public function get_default_sidebar() {
        $args = array(
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">',
            'after_widget' => '</div>',
        );
        $instance = array(
            'text' => __('100GB Storage</p> <p>All Themes</p> <p>Access to Tutorials</p> <p>Auto Backup</p> <p>Extended Security</p> <p>24/7 Techsupport','mp-emmet'),
            'name' => __('basic','mp-emmet'),
            'link' => '#plan',
            'background_color' => '#e7ac44',
            'background_color_hover' => '#f8c468',
            'pricing' => '15',
            'currency' => '$',
            'period' => '/mo'
        );
        wp_cache_delete('theme-widget-plan', 'widget');
        the_widget('MP_Emmet_Plugin_Widget_Plan', $instance, $args);
        $instance = array(
            'text' => __('100GB Storage</p> <p>All Themes</p> <p>Access to Tutorials</p> <p>Auto Backup</p> <p>Extended Security</p> <p>24/7 Techsupport','mp-emmet'),
            'name' => __('standard','mp-emmet'),
            'link' => '#plan',
            'background_color' => '#3ab0e2',
            'background_color_hover' => '#64c9f4',
            'pricing' => '20',
            'currency' => '$',
            'period' => '/mo'
        );
        the_widget('MP_Emmet_Plugin_Widget_Plan', $instance, $args);
        ?> <div class="clearfix visible-sm-block"></div> <?php
        $instance = array(
            'text' => __('100GB Storage</p> <p>All Themes</p> <p>Access to Tutorials</p> <p>Auto Backup</p> <p>Extended Security</p> <p>24/7 Techsupport','mp-emmet'),
            'name' => __('Premium','mp-emmet'),
            'sub_title' => __('Best Choice','mp-emmet'),
            'link' => '#plan',
            'background_color' => '#27b399',
            'background_color_hover' => '#37c4aa',
            'pricing' => '35',
            'currency' => '$',
            'recommend' => 'on',
            'period' => '/mo'
        );
        the_widget('MP_Emmet_Plugin_Widget_Plan', $instance, $args);
        $instance = array(
            'text' => __('100GB Storage</p> <p>All Themes</p> <p>Access to Tutorials</p> <p>Auto Backup</p> <p>Extended Security</p> <p>24/7 Techsupport','mp-emmet'),
            'name' => __('ultimate','mp-emmet'),
            'link' => '#plan',
            'background_color' => '#e96656',
            'background_color_hover' => '#f88a7c',
            'pricing' => '99',
            'currency' => '$',
            'period' => '/mo'
        );
        the_widget('MP_Emmet_Plugin_Widget_Plan', $instance, $args);
    }

    /*
     * Get sidebar 
     */

    public function get_sidebar() {
        $mp_emmet_plan_animation = esc_attr(get_theme_mod('theme_plan_animation', 'fadeInRight'));
        ?>
        <div class="row">
            <div <?php
            if ($mp_emmet_plan_animation != 'none'): echo 'class="animated anHidden"  data-animation="' . $mp_emmet_plan_animation . '"';
            endif;
            ?>>
                    <?php
                    /*
                     * mp_emmet_before_sidebar_plan hook
                     *
                     * @hooked mp_emmet_before_sidebar_plan - 10 
                     */
                    do_action('mp_emmet_before_sidebar_plan');
                    ?>
                    <?php
                    if (is_active_sidebar('sidebar-plan')) :
                        dynamic_sidebar('sidebar-plan');
                    else:
                        $this->get_default_sidebar();
                    endif;
                    ?>
                    <?php
                    /*
                     * mp_emmet_after_sidebar_plan hook
                     *
                     * @hooked mp_emmet_after_sidebar_plan - 10 
                     */
                    do_action('mp_emmet_after_sidebar_plan');
                    ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php
    }

    /*
     * Get title 
     */

    public function get_title() {
        $mp_emmet_plan_title = esc_html(get_theme_mod('theme_plan_title'));
        if (get_theme_mod('theme_plan_title', false) === false) :
            ?> 
            <h2 class="section-title"><?php _e('packages and pricing table','mp-emmet'); ?></h2>
            <?php
        else:
            if (!empty($mp_emmet_plan_title)):
                ?>
                <h2 class="section-title"><?php echo $mp_emmet_plan_title; ?></h2>
                <?php
            endif;
        endif;
    }

    /*
     * Get description 
     */

    public function get_description() {
        $mp_emmet_plan_description = wp_kses(get_theme_mod('theme_plan_description'),mp_emmet_plugin_allowed_html());
        $mp_emmet_plan_animation_description = esc_attr(get_theme_mod('theme_plan_animation_description', 'fadeInLeft'));

        if (get_theme_mod('theme_plan_description', false) === false) :
            ?>
            <div class="section-description  <?php if ($mp_emmet_plan_animation_description === 'none'): echo 'animated anHidden" data-animation="' . $mp_emmet_plan_animation_description;
            endif;
            ?>">
            <?php _e('Pricing section for your product','mp-emmet'); ?>
            </div>
            <?php
        else:
            if (!empty($mp_emmet_plan_description)):
                ?>
                <div class="section-description  <?php if ($mp_emmet_plan_animation_description === 'none'): echo 'animated anHidden" data-animation="' . $mp_emmet_plan_animation_description;
                endif;
                ?>">
                <?php echo $mp_emmet_plan_description; ?>
                </div>
                <?php
            endif;
        endif;
    }

    /*
     * Plan section
     */

    public function get_html() {
        ?>
        <section id="plan" class="plan-section grey-section default-section">
            <div class="container">
                <div class="section-content">
                    <?php
                    $this->get_title();
                    $this->get_description();
                    $this->get_sidebar();
                    ?>

                </div>
        </section>
        <?php
    }

}
