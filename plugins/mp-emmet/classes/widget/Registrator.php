<?php

class MP_Emmet_Plugin_Widget_Registrator {
	protected $widgets = array(
		'/widget/Items/RecentPosts.php',
		'/widget/Items/About.php',
		'/widget/Items/Authors.php',
		'/widget/Items/Features.php',
		'/widget/Items/Plan.php',
		'/widget/Items/Team.php',
		'/widget/Items/Testimonial.php',
		'/widget/Items/GoogleMap.php',
		'/widget/Items/Break.php'
	);
	protected $widgetsPro = array(
		'/widget/Items/FeatureBlock.php'
	);

	public function __construct() {
		// Allow child themes/plugins to add widgets to be loaded.
		$widgets = apply_filters( 'sp_widgets', $this->widgets );
		foreach ( $widgets as $w ) {
			include_once MP_EMMET_PLUGIN_CLASS_PATH . $w;
		}
		$theme_slug = get_template();
		if ( $theme_slug === 'emmet' ) {
			$widgetsPro = apply_filters( 'sp_widgets', $this->widgetsPro );
			foreach ( $widgetsPro as $w ) {
				include_once MP_EMMET_PLUGIN_CLASS_PATH . $w;
			}
		}
	}

}
