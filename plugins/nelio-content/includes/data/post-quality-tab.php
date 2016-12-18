<?php
/**
 * List of settings.
 *
 * @package    Nelio_Content
 * @subpackage Nelio_Content/includes/data
 * @author     David Aguilera <david.aguilera@neliosoftware.com>
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(

	array(
		'type'    => 'select',
		'name'    => 'qa_min_word_count',
		/* translators: a single setting's label */
		'label'   => _x( 'Post Length (words)', 'text', 'nelio-content' ),
		'desc'    => _x( 'How many words your blog posts should have. If a post has fewer words, Nelio Content will warn the author and suggest him to write more content.', 'text', 'nelio-content' ),
		'default' => '500',
		'options' => array(
			array(
				'value' => '300',
				'label' => number_format_i18n( 300 ),
			),
			array(
				'value' => '500',
				'label' => number_format_i18n( 500 ),
			),
			array(
				'value' => '800',
				'label' => number_format_i18n( 800 ),
			),
			array(
				'value' => '1000',
				'label' => number_format_i18n( 1000 ),
			),
			array(
				'value' => '1200',
				'label' => number_format_i18n( 1200 ),
			),
			array(
				'value' => '1500',
				'label' => number_format_i18n( 1500 ),
			),
			array(
				'value' => '2000',
				'label' => number_format_i18n( 2000 ),
			),
		),
	),

	array(
		'type'    => 'checkbox',
		'name'    => 'qa_is_yoast_seo_integrated',
		'label'   => _x( 'Yoast SEO Integration', 'text', 'nelio-content' ),
		'desc'    => _x( 'Integrate Yoast SEO score in Nelio Content\'s post analysis.', 'command', 'nelio-content' ),
		'default' => false,
	),

);
