<?php

/*
 * Class MP_Emmet_Plugin_Customizer
 *
 * add actions for default widgets if footer
 */

class MP_Emmet_Plugin_Customizer {

    public function __construct() {

        //Handles the theme's theme customizer functionality.
        add_action('customize_register', array($this, 'customize_register'));
    }

    /**
     * Sets up the theme customizer sections, controls, and settings.
     *
     * @access public
     * @param  object  $wp_customize
     * @return void
     */
    public function customize_register($wp_customize) {
        include_once MP_EMMET_PLUGIN_CLASS_PATH . '/customiser/customise-classes.php';
        /*
         * Add the 'features section'. 
         */
        $wp_customize->add_section(
                'theme_features_section', array(
            'title' => __('Features Section', 'mp-emmet'),
            'priority' => 84,
            'capability' => 'edit_theme_options',
            'description' => __('<i>Fill in this section by adding "Theme - Feature" widgets to "Customize > Widgets > Features section"</i><hr/>', 'mp-emmet')
                )
        );

        /*
         * Add the 'Hide faetures section?' setting. 
         */
        $wp_customize->add_setting('theme_features_show', array(
            'default' => 0,
            'sanitize_callback' => array($this, 'sanitize_checkbox'),
        ));
        /*
         *  Add the upload control for the 'features title section?' setting.
         */
        $wp_customize->add_control(
                new WP_Customize_Control(
                $wp_customize, 'theme_features_show', array(
            'label' => esc_html__('Hide this section', 'mp-emmet'),
            'section' => 'theme_features_section',
            'settings' => 'theme_features_show',
            'type' => 'checkbox',
            'priority' => 1,
                ))
        );
        /*
         * Add the 'features' setting. 
         */
        $wp_customize->add_setting('theme_features_title', array(
            'default' => __('features', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'features' setting.
         */
        $wp_customize->add_control('theme_features_title', array(
            'label' => __('Title', 'mp-emmet'),
            'section' => 'theme_features_section',
            'settings' => 'theme_features_title',
            'priority' => 2
        ));

        /*
         * Add the 'features' setting. 
         */
        $wp_customize->add_setting('theme_features_description', array(
            'default' => __('What makes emmet theme unique', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'features' setting.
         */

        $wp_customize->add_control(new MP_Emmet_Plugin_Customize_Textarea_Control($wp_customize, 'theme_features_description', array(
            'label' => __('Description', 'mp-emmet'),
            'section' => 'theme_features_section',
            'settings' => 'theme_features_description',
            'priority' => 3
        )));
        $wp_customize->add_setting('theme_features_animation', array(
            'default' => 'fadeInUp',
            'sanitize_callback' => array($this, 'sanitize_animation')
        ));
        $wp_customize->add_control('theme_features_animation', array(
            'label' => __('Widgets animation', 'mp-emmet'),
            'section' => 'theme_features_section',
            'type' => 'select',
            'choices' => $this->array_animation(),
            'priority' => 4,
        ));
        /*
         * Add section position
         */
        $wp_customize->add_setting('theme_features_position', array(
            'default' => 50,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_position')
        ));
        $wp_customize->add_control('theme_features_position', array(
            'label' => __('Section position', 'mp-emmet'),
            'section' => 'theme_features_section',
            'settings' => 'theme_features_position',
            'priority' => 30,
        ));
        /*
         * Add the 'portfolio section'. 
         */
        $wp_customize->add_section(
                'theme_portfolio_section', array(
            'title' => __('Portfolio Section', 'mp-emmet'),
            'priority' => 85,
            'capability' => 'edit_theme_options',
            'description' => __('<i>Go to "Dashboard > Portfolio" and add posts to fill this section</i><hr/>', 'mp-emmet')
                )
        );

        /*
         * Add the 'Hide portfolio section?' setting. 
         */
        $wp_customize->add_setting('theme_portfolio_show', array(
            'default' => 0,
            'sanitize_callback' => array($this, 'sanitize_checkbox'),
        ));
        /*
         *  Add the upload control for the 'portfolio title section?' setting.
         */
        $wp_customize->add_control(
                new WP_Customize_Control(
                $wp_customize, 'theme_portfolio_show', array(
            'label' => esc_html__('Hide this section', 'mp-emmet'),
            'section' => 'theme_portfolio_section',
            'settings' => 'theme_portfolio_show',
            'type' => 'checkbox',
            'priority' => 1,
                ))
        );
        /*
         * Add the 'portfolio' setting. 
         */
        $wp_customize->add_setting('theme_portfolio_title', array(
            'default' => __('Our portfolio', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'portfolio' setting.
         */
        $wp_customize->add_control('theme_portfolio_title', array(
            'label' => __('Title', 'mp-emmet'),
            'section' => 'theme_portfolio_section',
            'settings' => 'theme_portfolio_title',
            'priority' => 2
        ));

        /*
         * Add the 'portfolio' setting. 
         */
        $wp_customize->add_setting('theme_portfolio_description', array(
            'default' => __('In the portfolio section you can display your works consisting of screenshots and additional information', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'portfolio' setting.
         */
        $wp_customize->add_control(new MP_Emmet_Plugin_Customize_Textarea_Control($wp_customize, 'theme_portfolio_description', array(
            'label' => __('Description', 'mp-emmet'),
            'section' => 'theme_portfolio_section',
            'settings' => 'theme_portfolio_description',
            'priority' => 3
        )));
        /*
         * Add the 'install brand button label' setting. 
         */
        $wp_customize->add_setting('theme_portfolio_button_label', array(
            'default' => __('check all works', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'install brand button label' setting.
         */
        $wp_customize->add_control('theme_portfolio_button_label', array(
            'label' => __('Button label', 'mp-emmet'),
            'section' => 'theme_portfolio_section',
            'settings' => 'theme_portfolio_button_label',
            'priority' => 4
        ));
        /*
         * Add the 'portfolio button url' setting. 
         */
        $wp_customize->add_setting('theme_portfolio_button_url', array(
            'default' => '#',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'portfolio button url' setting.
         */
        $wp_customize->add_control('theme_portfolio_button_url', array(
            'label' => __('Button url', 'mp-emmet'),
            'section' => 'theme_portfolio_section',
            'settings' => 'theme_portfolio_button_url',
            'priority' => 5
        ));
        $wp_customize->add_setting('theme_portfolio_animation', array(
            'default' => 'fadeInLeft',
            'sanitize_callback' => array($this, 'sanitize_animation')
        ));
        $wp_customize->add_control('theme_portfolio_animation', array(
            'label' => __('Portfolio animation', 'mp-emmet'),
            'section' => 'theme_portfolio_section',
            'type' => 'select',
            'choices' => $this->array_animation(),
            'priority' => 6,
        ));
        /*
         * Add section position
         */
        $wp_customize->add_setting('theme_portfolio_position', array(
            'default' => 60,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_position')
        ));
        $wp_customize->add_control('theme_portfolio_position', array(
            'label' => __('Section position', 'mp-emmet'),
            'section' => 'theme_portfolio_section',
            'settings' => 'theme_portfolio_position',
            'priority' => 30,
        ));
        /*
         * Add the 'plan section'. 
         */
        $wp_customize->add_section(
                'theme_plan_section', array(
            'title' => __('Packages Section', 'mp-emmet'),
            'priority' => 86,
            'capability' => 'edit_theme_options',
            'description' => __('<i>Fill in this section by adding "Theme - Plan" widgets to "Customize > Widgets > Packages section"</i><hr/>', 'mp-emmet')
                )
        );

        /*
         * Add the 'Hide plan section?' setting. 
         */
        $wp_customize->add_setting('theme_plan_show', array(
            'default' => 0,
            'sanitize_callback' => array($this, 'sanitize_checkbox'),
        ));
        /*
         *  Add the upload control for the 'plan title section?' setting.
         */
        $wp_customize->add_control(
                new WP_Customize_Control(
                $wp_customize, 'theme_plan_show', array(
            'label' => esc_html__('Hide this section', 'mp-emmet'),
            'section' => 'theme_plan_section',
            'settings' => 'theme_plan_show',
            'type' => 'checkbox',
            'priority' => 1,
                ))
        );
        /*
         * Add the 'plan' setting. 
         */
        $wp_customize->add_setting('theme_plan_title', array(
            'default' => __('packages and pricing table', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'plan' setting.
         */
        $wp_customize->add_control('theme_plan_title', array(
            'label' => __('Title', 'mp-emmet'),
            'section' => 'theme_plan_section',
            'settings' => 'theme_plan_title',
            'priority' => 2
        ));

        /*
         * Add the 'plan' setting. 
         */
        $wp_customize->add_setting('theme_plan_description', array(
            'default' => __('Pricing section for your product', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'plan' setting.
         */
        $wp_customize->add_control(new MP_Emmet_Plugin_Customize_Textarea_Control($wp_customize, 'theme_plan_description', array(
            'label' => __('Description', 'mp-emmet'),
            'section' => 'theme_plan_section',
            'settings' => 'theme_plan_description',
            'priority' => 3
        )));
        $wp_customize->add_setting('theme_plan_animation_description', array(
            'default' => 'fadeInLeft',
            'sanitize_callback' => array($this, 'sanitize_animation')
        ));
        $wp_customize->add_control('theme_plan_animation_description', array(
            'label' => __('Description animation', 'mp-emmet'),
            'section' => 'theme_plan_section',
            'type' => 'select',
            'choices' => $this->array_animation(),
            'priority' => 4,
        ));
        $wp_customize->add_setting('theme_plan_animation', array(
            'default' => 'fadeInRight',
            'sanitize_callback' => array($this, 'sanitize_animation')
        ));
        $wp_customize->add_control('theme_plan_animation', array(
            'label' => __('Widgets animation', 'mp-emmet'),
            'section' => 'theme_plan_section',
            'type' => 'select',
            'choices' => $this->array_animation(),
            'priority' => 5,
        ));
        /*
         * Add section position
         */
        $wp_customize->add_setting('theme_plan_position', array(
            'default' => 70,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_position')
        ));
        $wp_customize->add_control('theme_plan_position', array(
            'label' => __('Section position', 'mp-emmet'),
            'section' => 'theme_plan_section',
            'settings' => 'theme_plan_position',
            'priority' => 30,
        ));
        /*
         * Add the 'team section'. 
         */
        $wp_customize->add_section(
                'theme_team_section', array(
            'title' => __('Team Section', 'mp-emmet'),
            'priority' => 89,
            'capability' => 'edit_theme_options',
            'description' => __('<i>Fill in this section by adding "Theme - Team" widgets to "Customize > Widgets > Team section"</i><hr/>', 'mp-emmet')
                )
        );

        /*
         * Add the 'Hide faetures section?' setting. 
         */
        $wp_customize->add_setting('theme_team_show', array(
            'default' => 0,
            'sanitize_callback' => array($this, 'sanitize_checkbox'),
        ));
        /*
         *  Add the upload control for the 'team title section?' setting.
         */
        $wp_customize->add_control(
                new WP_Customize_Control(
                $wp_customize, 'theme_team_show', array(
            'label' => esc_html__('Hide this section', 'mp-emmet'),
            'section' => 'theme_team_section',
            'settings' => 'theme_team_show',
            'type' => 'checkbox',
            'priority' => 1,
                ))
        );
        /*
         * Add the 'team' setting. 
         */
        $wp_customize->add_setting('theme_team_title', array(
            'default' => __('Our team', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'team' setting.
         */
        $wp_customize->add_control('theme_team_title', array(
            'label' => __('Title', 'mp-emmet'),
            'section' => 'theme_team_section',
            'settings' => 'theme_team_title',
            'priority' => 2
        ));

        /*
         * Add the 'team' setting. 
         */
        $wp_customize->add_setting('theme_team_description', array(
            'default' => __('Perfect to display the members of your staff, team or working force', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'team' setting.
         */
        $wp_customize->add_control(new MP_Emmet_Plugin_Customize_Textarea_Control($wp_customize, 'theme_team_description', array(
            'label' => __('Description', 'mp-emmet'),
            'section' => 'theme_team_section',
            'settings' => 'theme_team_description',
            'priority' => 3
        )));
        $wp_customize->add_setting('theme_team_animation_description', array(
            'default' => 'fadeInLeft',
            'sanitize_callback' => array($this, 'sanitize_animation')
        ));
        $wp_customize->add_control('theme_team_animation_description', array(
            'label' => __('Description animation', 'mp-emmet'),
            'section' => 'theme_team_section',
            'type' => 'select',
            'choices' => $this->array_animation(),
            'priority' => 4,
        ));
        $wp_customize->add_setting('theme_team_animation', array(
            'default' => 'fadeInUp',
            'sanitize_callback' => array($this, 'sanitize_animation')
        ));
        $wp_customize->add_control('theme_team_animation', array(
            'label' => __('Widgets animation', 'mp-emmet'),
            'section' => 'theme_team_section',
            'type' => 'select',
            'choices' => $this->array_animation(),
            'priority' => 5,
        ));
        /*
         * Add section position
         */
        $wp_customize->add_setting('theme_team_position', array(
            'default' => 90,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_position')
        ));
        $wp_customize->add_control('theme_team_position', array(
            'label' => __('Section position', 'mp-emmet'),
            'section' => 'theme_team_section',
            'settings' => 'theme_team_position',
            'priority' => 30,
        ));


        /*
         * Add the 'testimonials section'. 
         */
        $wp_customize->add_section(
                'theme_testimonials_section', array(
            'title' => __('Testimonials Section', 'mp-emmet'),
            'priority' => 91,
            'capability' => 'edit_theme_options',
            'description' => __('<i>Fill in this section by adding "Theme - Testimonial" widgets to "Customize > Widgets > Testimonials section"</i><hr/>', 'mp-emmet')
                )
        );

        /*
         * Add the 'Hide faetures section?' setting. 
         */
        $wp_customize->add_setting('theme_testimonials_show', array(
            'default' => 0,
            'sanitize_callback' => array($this, 'sanitize_checkbox'),
        ));
        /*
         *  Add the upload control for the 'testimonials title section?' setting.
         */
        $wp_customize->add_control(
                new WP_Customize_Control(
                $wp_customize, 'theme_testimonials_show', array(
            'label' => esc_html__('Hide this section', 'mp-emmet'),
            'section' => 'theme_testimonials_section',
            'settings' => 'theme_testimonials_show',
            'type' => 'checkbox',
            'priority' => 1,
                ))
        );
        /*
         * Add the 'testimonials' setting. 
         */
        $wp_customize->add_setting('theme_testimonials_title', array(
            'default' => __('testimonials', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'testimonials' setting.
         */
        $wp_customize->add_control('theme_testimonials_title', array(
            'label' => __('Title', 'mp-emmet'),
            'section' => 'theme_testimonials_section',
            'settings' => 'theme_testimonials_title',
            'priority' => 2
        ));

        /*
         * Add the 'testimonials' setting. 
         */
        $wp_customize->add_setting('theme_testimonials_description', array(
            'default' => __('What our happy customers say', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'testimonials' setting.
         */
        $wp_customize->add_control(new MP_Emmet_Plugin_Customize_Textarea_Control($wp_customize, 'theme_testimonials_description', array(
            'label' => __('Description', 'mp-emmet'),
            'section' => 'theme_testimonials_section',
            'settings' => 'theme_testimonials_description',
            'priority' => 3
        )));

        $wp_customize->add_setting('theme_testimonials_animation_description', array(
            'default' => 'fadeInLeft',
            'sanitize_callback' => array($this, 'sanitize_animation')
        ));
        $wp_customize->add_control('theme_testimonials_animation_description', array(
            'label' => __('Description animation', 'mp-emmet'),
            'section' => 'theme_testimonials_section',
            'type' => 'select',
            'choices' => $this->array_animation(),
            'priority' => 4,
        ));
        $wp_customize->add_setting('theme_testimonials_animation', array(
            'default' => 'fadeInUp',
            'sanitize_callback' => array($this, 'sanitize_animation')
        ));
        $wp_customize->add_control('theme_testimonials_animation', array(
            'label' => __('Widgets animation', 'mp-emmet'),
            'section' => 'theme_testimonials_section',
            'type' => 'select',
            'choices' => $this->array_animation(),
            'priority' => 5,
        ));
        /*
         * Add section position
         */
        $wp_customize->add_setting('theme_testimonials_position', array(
            'default' => 120,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_position')
        ));
        $wp_customize->add_control('theme_testimonials_position', array(
            'label' => __('Section position', 'mp-emmet'),
            'section' => 'theme_testimonials_section',
            'settings' => 'theme_testimonials_position',
            'priority' => 30,
        ));
        /*
         * Add the 'googlemap section'. 
         */
        $wp_customize->add_section(
                'theme_googlemap_section', array(
            'title' => __('Google Map Section', 'mp-emmet'),
            'priority' => 92,
            'capability' => 'edit_theme_options',
            'description' => __('<i>Fill in this section by adding "Theme - GoogleMap" widget to "Customize > Widgets > Google Map section"</i><hr/>', 'mp-emmet')
                )
        );
        /*
         * Add the 'Hide googlemap section?' setting. 
         */
        $wp_customize->add_setting('theme_googlemap_show', array(
            'default' => 0,
            'sanitize_callback' => array($this, 'sanitize_checkbox'),
        ));
        /*
         *  Add the upload control for the 'googlemap title section?' setting.
         */
        $wp_customize->add_control(
                new WP_Customize_Control(
                $wp_customize, 'theme_googlemap_show', array(
            'label' => esc_html__('Hide this section', 'mp-emmet'),
            'section' => 'theme_googlemap_section',
            'settings' => 'theme_googlemap_show',
            'type' => 'checkbox',
            'priority' => 1,
                ))
        );
        /*
         * Add section position
         */
        $wp_customize->add_setting('theme_googlemap_position', array(
            'default' => 130,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_position')
        ));
        $wp_customize->add_control('theme_googlemap_position', array(
            'label' => __('Section position', 'mp-emmet'),
            'section' => 'theme_googlemap_section',
            'settings' => 'theme_googlemap_position',
            'priority' => 30,
        ));
        /*
         * Add the 'contact section' setting. 
         */
        $wp_customize->add_section('theme_contactus_section', array(
            'title' => __('Contact Us Section', 'mp-emmet'),
            'priority' => 93
        ));
        /*
         *  Add the  'contact us show/hide' setting.
         */
        $wp_customize->add_setting('theme_contactus_show', array(
            'sanitize_callback' => array($this, 'sanitize_text'))
        );
        /*
         *  Add the upload control for the 'contact us show/hide' setting.
         */
        $wp_customize->add_control(
                'theme_contactus_show', array(
            'type' => 'checkbox',
            'label' => __('Hide this section', 'mp-emmet'),
            'section' => 'theme_contactus_section',
            'priority' => 1,
                )
        );
        /*
         * Add the 'contactus title' setting.
         */
        $wp_customize->add_setting('theme_contactus_title', array(
            'sanitize_callback' => array($this, 'sanitize_text'),
            'default' => __('Message form', 'mp-emmet'),
            'transport' => 'postMessage',
        ));
        /*
         *  Add the upload control for the 'contactus title' setting.
         */
        $wp_customize->add_control('theme_contactus_title', array(
            'label' => __('Title', 'mp-emmet'),
            'section' => 'theme_contactus_section',
            'settings' => 'theme_contactus_title',
            'priority' => 2,
        ));
        /*
         * Add the 'contactus description' setting.
         */
        $wp_customize->add_setting('theme_contactus_description', array(
            'sanitize_callback' => array($this, 'sanitize_text'),
            'default' => __('Contact us using the form below', 'mp-emmet'),
            'transport' => 'postMessage',
        ));
        /*
         *  Add the upload control for the 'contactus description' setting.
         */
        $wp_customize->add_control('theme_contactus_description', array(
            'label' => __('Description', 'mp-emmet'),
            'section' => 'theme_contactus_section',
            'settings' => 'theme_contactus_description',
            'priority' => 3,
        ));

        /*
         *  Add the 'contactus email' setting.
         */
        $wp_customize->add_setting('theme_contactus_email', array(
            'sanitize_callback' => array($this, 'sanitize_text'))
        );
        /*
         *  Add the upload control for the 'contactus email' setting.
         */
        $wp_customize->add_control('theme_contactus_email', array(
            'label' => __('Email address', 'mp-emmet'),
            'section' => 'theme_contactus_section',
            'settings' => 'theme_contactus_email',
            'priority' => 4,
        ));

        /*
         * Add the 'contactus button label' setting.
         */
        $wp_customize->add_setting('theme_contactus_button_label', array(
            'sanitize_callback' => array($this, 'sanitize_text'),
            'default' => __('Send Message', 'mp-emmet'),
            'transport' => 'postMessage',
        ));
        /*
         *  Add the upload control for the 'contactus button label' setting.
         */
        $wp_customize->add_control('theme_contactus_button_label', array(
            'label' => __('Button label', 'mp-emmet'),
            'section' => 'theme_contactus_section',
            'settings' => 'theme_contactus_button_label',
            'priority' => 5,
        ));
        /*
         * Add the  'recaptcha' setting.
         */
        $wp_customize->add_setting('theme_contactus_recaptcha_show', array(
            'sanitize_callback' => array($this, 'sanitize_text')
        ));
        /*
         *  Add the upload control for the 'recaptcha' setting.
         */
        $wp_customize->add_control(
                'theme_contactus_recaptcha_show', array(
            'type' => 'checkbox',
            'label' => __('Hide reCaptcha?', 'mp-emmet'),
            'section' => 'theme_contactus_section',
            'priority' => 6,
                )
        );

        /*
         * Add the 'site key' setting.
         */
        $wp_customize->add_setting('theme_contactus_sitekey', array(
            'sanitize_callback' => array($this, 'sanitize_text')
        ));
        /*
         *  Add the upload control for the 'site key' setting.
         */
        $wp_customize->add_control('theme_contactus_sitekey', array(
            'label' => __('Site key', 'mp-emmet'),
            'description' => '<a href="https://www.google.com/recaptcha/admin#list" target="_blank">' . __('Create an account here', 'mp-emmet') . '</a> to get the Site key and the Secret key for the reCaptcha.',
            'section' => 'theme_contactus_section',
            'settings' => 'theme_contactus_sitekey',
            'priority' => 7,
        ));
        /*
         * Add the 'secret key' setting.
         */
        $wp_customize->add_setting('theme_contactus_secretkey', array(
            'sanitize_callback' => array($this, 'sanitize_text')
        ));
        /*
         *  Add the upload control for the secret key' setting.
         */
        $wp_customize->add_control('theme_contactus_secretkey', array(
            'label' => __('Secret key', 'mp-emmet'),
            'section' => 'theme_contactus_section',
            'settings' => 'theme_contactus_secretkey',
            'priority' => 8,
        ));

        $wp_customize->add_setting('theme_contactus_animation', array(
            'default' => 'fadeIn',
            'sanitize_callback' => array($this, 'sanitize_animation')
        ));
        $wp_customize->add_control('theme_contactus_animation', array(
            'label' => __('Content animation', 'mp-emmet'),
            'section' => 'theme_contactus_section',
            'type' => 'select',
            'choices' => $this->array_animation(),
            'priority' => 9,
        ));
        /*
         * Add section position
         */
        $wp_customize->add_setting('theme_contactus_position', array(
            'default' => 140,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_position')
        ));
        $wp_customize->add_control('theme_contactus_position', array(
            'label' => __('Section position', 'mp-emmet'),
            'section' => 'theme_contactus_section',
            'settings' => 'theme_contactus_position',
            'priority' => 30,
        ));
        /*
         * Add the 'install section'. 
         */
        $wp_customize->add_section(
                'theme_install_section', array(
            'title' => __('Call To Action Section', 'mp-emmet'),
            'priority' => 83,
            'capability' => 'edit_theme_options'
                )
        );

        /*
         * Add the 'Hide install section?' setting. 
         */
        $wp_customize->add_setting('theme_install_show', array(
            'default' => 0,
            'sanitize_callback' => 'mp_emmet_sanitize_checkbox',
        ));
        /*
         *  Add the upload control for the 'Hide install section?' setting.
         */
        $wp_customize->add_control(
                new WP_Customize_Control(
                $wp_customize, 'theme_install_show', array(
            'label' => esc_html__('Hide this section', 'mp-emmet'),
            'section' => 'theme_install_section',
            'settings' => 'theme_install_show',
            'type' => 'checkbox',
            'priority' => 1,
                ))
        );
        /*
         * Add the 'install' setting. 
         */
        $wp_customize->add_setting('theme_install_title', array(
            'default' => __('Install Emmet theme now!', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'install' setting.
         */
        $wp_customize->add_control('theme_install_title', array(
            'label' => __('Title', 'mp-emmet'),
            'section' => 'theme_install_section',
            'settings' => 'theme_install_title',
            'priority' => 2
        ));

        /*
         * Add the 'install' setting. 
         */
        $wp_customize->add_setting('theme_install_description', array(
            'default' => __('The installation process is a real ease, it involves a couple of fast and clear steps to be fully completed. <br>Once you have uploaded the theme to your website and activated it, you will be presented with a detailed guided tour. ', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'install' setting.
         */
        $wp_customize->add_control(new MP_Emmet_Plugin_Customize_Textarea_Control($wp_customize, 'theme_install_description', array(
            'label' => __('Description', 'mp-emmet'),
            'section' => 'theme_install_section',
            'settings' => 'theme_install_description',
            'priority' => 3
        )));

        /*
         * Add the 'install brand button label' setting. 
         */
        $wp_customize->add_setting('theme_install_brandbutton_label', array(
            'default' => __('install now', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'install brand button label' setting.
         */
        $wp_customize->add_control('theme_install_brandbutton_label', array(
            'label' => __('First button label', 'mp-emmet'),
            'section' => 'theme_install_section',
            'settings' => 'theme_install_brandbutton_label',
            'priority' => 4
        ));
        /*
         * Add the 'install brand button url' setting. 
         */
        $wp_customize->add_setting('theme_install_brandbutton_url', array(
            'default' => '#',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'install brand button url' setting.
         */
        $wp_customize->add_control('theme_install_brandbutton_url', array(
            'label' => __('First button url', 'mp-emmet'),
            'section' => 'theme_install_section',
            'settings' => 'theme_install_brandbutton_url',
            'priority' => 5
        ));

        /*
         * Add the 'install brand button label' setting. 
         */
        $wp_customize->add_setting('theme_install_whitebutton_label', array(
            'default' => __('Read more', 'mp-emmet'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'install brand button label' setting.
         */
        $wp_customize->add_control('theme_install_whitebutton_label', array(
            'label' => __('Second button label', 'mp-emmet'),
            'section' => 'theme_install_section',
            'settings' => 'theme_install_whitebutton_label',
            'priority' => 6
        ));
        /*
         * Add the 'install brand button url' setting. 
         */
        $wp_customize->add_setting('theme_install_whitebutton_url', array(
            'default' => '#',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_text'),
            'transport' => 'postMessage'
        ));
        /*
         * Add the upload control for the 'install brand button url' setting.
         */
        $wp_customize->add_control('theme_install_whitebutton_url', array(
            'label' => __('Second button url', 'mp-emmet'),
            'section' => 'theme_install_section',
            'settings' => 'theme_install_whitebutton_url',
            'priority' => 7
        ));
        $wp_customize->add_setting('theme_install_animation', array(
            'default' => 'fadeIn',
            'sanitize_callback' => array($this, 'sanitize_animation')
        ));
        $wp_customize->add_control('theme_install_animation', array(
            'label' => __('Content animation', 'mp-emmet'),
            'section' => 'theme_install_section',
            'type' => 'select',
            'choices' => $this->array_animation(),
            'priority' => 8,
        ));
        /*
         * Add section position
         */
        $wp_customize->add_setting('theme_install_position', array(
            'default' => 40,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_position')
        ));
        $wp_customize->add_control('theme_install_position', array(
            'label' => __('Section position', 'mp-emmet'),
            'section' => 'theme_install_section',
            'settings' => 'theme_install_position',
            'priority' => 30,
        ));
    }

    /**
     * Sanitize position
     *
     * @access public
     * @return sanitized output
     */
    function sanitize_position($str) {
        if ($this->is_positive_integer($str)) {
            return intval($str);
        }
    }

    /**
     * Sanitize is positive integer
     *
     * @access public
     * @return sanitized output
     */
    function is_positive_integer($str) {
        return (is_numeric($str) && $str > 0 && $str == round($str));
    }

    /**
     * Array of animations
     */
    function array_animation() {
        $animation = array(
            'none' => 'None',
            'fadeIn' => 'Fade In',
            'fadeInLeft' => 'Fade In Left',
            'fadeInRight' => 'Fade In Right',
            'fadeInUp' => 'Fade In Up',
            'fadeInDown' => 'Fade In Down'
        );

        return $animation;
    }

    /**
     * Sanitization callback for color schemes.
     *     *
     * @param string $value Color scheme name value.
     * @return string Color scheme name.
     */
    function sanitize_animation($value) {
        $animation = $this->array_animation();

        if (!array_key_exists($value, $animation)) {
            $value = 'none';
        }

        return $value;
    }

    /**
     * Sanitize text
     *
     * @access public
     * @return sanitized output
     */
    function sanitize_text($txt) {
        return wp_kses( $txt, mp_emmet_plugin_allowed_html() );
    }

    /**
     * Sanitize checkbox
     *
     * @access public
     * @return sanitized output
     */
    function sanitize_checkbox($input) {
        if ($input == 1) {
            return 1;
        } else {
            return '';
        }
    }

}

new MP_Emmet_Plugin_Customizer();


function mp_emmet_plugin_allowed_html() {
    return array(
        'a'          => array(
            'href'  => array(),
            'title' => array(),
            'class' => array(),
        ),
        'br'         => array( 'class' => array(), ),
        'b'          => array( 'class' => array(), ),
        'strong'     => array( 'class' => array(), ),
        'p'          => array( 'class' => array(), ),
        'i'          => array( 'class' => array(), ),
        'table'      => array( 'class' => array(), ),
        'tbody'      => array( 'class' => array(), ),
        'thead'      => array( 'class' => array(), ),
        'tfoot'      => array( 'class' => array(), ),
        'tr'         => array( 'class' => array(), ),
        'th'         => array( 'class' => array(), 'colspan' => array(), 'rowspan' => array(), ),
        'td'         => array( 'class' => array(), 'colspan' => array(), 'rowspan' => array(), ),
        'img'        => array(
            'classs' => array(),
            'src'    => array(),
            'alt'    => array(),
            'width'  => array(),
            'height' => array(),
        ),
        'h1'         => array( 'class' => array(), ),
        'h2'         => array( 'class' => array(), ),
        'h3'         => array( 'class' => array(), ),
        'h4'         => array( 'class' => array(), ),
        'h5'         => array( 'class' => array(), ),
        'h6'         => array( 'class' => array(), ),
        'center' > array( 'class' => array(), ),
        'ol'         => array( 'class' => array(), ),
        'ul'         => array( 'class' => array(), ),
        'li'         => array( 'class' => array(), ),
        'blockquote' => array( 'class' => array(), ),
        'ins'        => array( 'class' => array(), ),
        'sup'        => array( 'class' => array(), ),
        'sub'        => array( 'class' => array(), ),
        'small'      => array( 'class' => array(), ),
        'cite'       => array( 'class' => array(), ),

    );
}