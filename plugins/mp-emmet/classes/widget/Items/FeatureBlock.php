<?php
/**
 * Features  widget class
 *
 */
require_once 'Default.php';

class MP_Emmet_Plugin_Widget_Feature_Block extends MP_Emmet_Plugin_Widget_Default {

	function __construct() {
		$this->setClassName( 'theme_widget_feature_block' );
		$this->setName( __( 'Feature Block', 'mp-emmet' ) );
		$this->setDescription( __( 'Feature Block', 'mp-emmet' ) );
		$this->setIdSuffix( 'features_block' );
		parent::__construct();
	}

	public function img_url( $instance ) {
		global $wpdb;
		$image_src = ( ! empty( $instance['image_uri'] ) ) ? esc_url( $instance['image_uri'] ) : '';
		if ( ! empty( $image_src ) ):
			$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
			$id    = $wpdb->get_var( $query );
			if ( is_null( $id ) ):
				return $image_src;
			endif;
			$image_uri = wp_get_attachment_image_src( $id, array( 700, 700 ) );

			return $image_uri[0];
		endif;

		return '';
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title           = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text      = ( ! empty( $instance['text'] ) ) ? esc_html( $instance['text'] ) : '';
		$image_uri = $this->img_url( $instance );
		$link      = ( ! empty( $instance['link'] ) ) ? esc_url( $instance['link'] ) : '';
		$button    = ( ! empty( $instance['button'] ) ) ? esc_html( $instance['button'] ) : '';
		$bg        = ( ! empty( $instance['bg'] ) ) ? esc_html( $instance['bg'] ) : '#ffffff';
		$position = ( ! empty( $instance['position'] ) ) ? esc_html( $instance['position'] ) : 'right';
		$animation = ( ! empty( $instance['animation'] ) ) ? esc_html( $instance['animation'] ) : 'fadeInLeft';
		$img_animation = ( ! empty( $instance['img_animation'] ) ) ? esc_html( $instance['img_animation'] ) : 'fadeInRight';
		echo $before_widget;
		?>
		<div class="widget-section" style="background: <?php echo $bg; ?> ">
			<div class="container">
				<div class="row">
				<?php  if($position==='right'):?>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="section-content <?php if ( $animation != 'none' ): ?> animated anHidden" data-animation="<?php echo $animation; ?><?php endif; ?>">
							<?php if ( ! empty( $title ) ): ?>
								<h2 class="section-title"><?php echo $title; ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $text ) ): ?>
								<div class="section-description"><?php echo htmlspecialchars_decode( $text ); ?></div>
							<?php endif; ?>
							<?php if ( ! empty( $link ) && ! empty( $button ) ): ?>
								<div class="section-buttons">
									<a href="<?php echo $link; ?>" title="<?php echo $button; ?>"
									   class="button"><?php echo $button; ?></a>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php if ( ! empty( $image_uri ) ): ?>
						<div class="section-right <?php if ( $img_animation != 'none' ): ?> animated anHidden" data-animation="<?php echo $img_animation; ?><?php endif; ?>" style="background-image: url(<?php echo $image_uri; ?>);"></div>
					<?php endif; ?>
					<?php else:?>
					<?php if ( ! empty( $image_uri ) ): ?>
						<div class="section-left <?php if ( $img_animation != 'none' ): ?> animated anHidden" data-animation="<?php echo $img_animation; ?><?php endif; ?>" style="background-image: url(<?php echo $image_uri; ?>);"></div>
					<?php endif; ?>
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 col-sm-offset-5 col-lg-offset-5 col-md-offset-5">
						<div class="section-content <?php if ( $animation != 'none' ): ?> animated anHidden" data-animation="<?php echo $animation; ?><?php endif; ?>">
							<?php if ( ! empty( $title ) ): ?>
								<h2 class="section-title"><?php echo $title; ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $text ) ): ?>
								<div class="section-description"><?php echo htmlspecialchars_decode( $text ); ?></div>
							<?php endif; ?>
							<?php if ( ! empty( $link ) && ! empty( $button ) ): ?>
								<div class="section-buttons">
									<a href="<?php echo $link; ?>" title="<?php echo $button; ?>"
									   class="button"><?php echo $button; ?></a>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php
		echo $after_widget;
	}


	function update( $new_instance, $old_instance ) {

		$instance              = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text']      = stripslashes( wp_filter_post_kses( $new_instance['text'] ) );
		$instance['image_uri'] = esc_url( $new_instance['image_uri'] );
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['link']      = esc_url( $new_instance['link'] );
		$instance['button']    = strip_tags( $new_instance['button'] );
		$instance['bg']      =  strip_tags( $new_instance['bg'] );
		$instance['animation']      =  strip_tags( $new_instance['animation'] );
		$instance['img_animation']      =  strip_tags( $new_instance['img_animation'] );
        $instance['position'] = strip_tags($new_instance['position']);
		return $instance;
	}

	public function get_upload_image( $instance ) {
		echo '<img class="custom_media_image" src="';
		if ( ! empty( $instance['image_uri'] ) ) :
			echo $instance['image_uri'];
		endif;
		echo '" style="margin:0;padding:0;max-width:100%;';
		if ( ! empty( $instance['image_uri'] ) ) :
			echo 'display:block;';
		else:
			echo 'display:none;';
		endif;
		echo '" />';
	}

	function form( $instance ) {

	$instance = wp_parse_args( (array) $instance, array(
			'title'           => '',
			'bg'           => '#ffffff',
			'position'=>'right',
			'animation'=>'fadeInLeft',
			'img_animation'=>'fadeInRight',

		) );
		$title    = strip_tags( $instance['title'] );
		$bg    = $instance['bg'] ;
		$position=$instance['position'];
		$animation=$instance['animation'];
		$img_animation=$instance['img_animation'];
		?>
		<script type="text/javascript">
	    jQuery(document).ready(function($) {
	            jQuery('.color-picker').on('focus', function(){
	                var parent = jQuery(this).parent();
	                jQuery(this).wpColorPicker()
	                parent.find('.wp-color-result').click();
	            });
	    });
	</script>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mp-entrepreneur' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/></p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'mp-emmet' ); ?></label><br/>
            <textarea class="widefat" rows="8" cols="20"
                      name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"
                      id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php
	            if ( ! empty( $instance['text'] ) ): echo htmlspecialchars_decode( $instance['text'] );
	            endif;
	            ?></textarea>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'button' ) ); ?>"><?php _e( 'Button text:', 'mp-emmet' ); ?></label><br/>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'button' ) ); ?>"
			       id="<?php echo esc_attr( $this->get_field_id( 'button' ) ); ?>" value="<?php
			if ( ! empty( $instance['button'] ) ): echo esc_attr( $instance['button'] );
			endif;
			?>" class="widefat"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php _e( 'Button link:', 'mp-emmet' ); ?></label><br/>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>"
			       id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" value="<?php
			if ( ! empty( $instance['link'] ) ): echo esc_url( $instance['link'] );
			endif;
			?>" class="widefat"/>
		</p>
			<p><div><label for="<?php echo $this->get_field_id( 'bg' ); ?>"><?php _e( 'Background:', 'mp-entrepreneur' ); ?></label></div>
			<div><input class="widefat color-picker" id="<?php echo $this->get_field_id( 'bg' ); ?>"
			       name="<?php echo $this->get_field_name( 'bg' ); ?>" type="text"
			       value="<?php echo  $bg ; ?>"/></div>
			       </p>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'image_uri' ) ); ?>"><?php _e( 'Image:', 'mp-emmet' ); ?></label><br/>
			<?php $this->get_upload_image( $instance ); ?>
			<input type="text" class="widefat custom_media_url"
			       name="<?php echo esc_attr( $this->get_field_name( 'image_uri' ) ); ?>"
			       id="<?php echo esc_attr( $this->get_field_id( 'image_uri' ) ); ?>" value="<?php
			if ( ! empty( $instance['image_uri'] ) ): echo esc_attr( $instance['image_uri'] );
			endif;
			?>" style="margin-top:5px;">
			      <input type="button" class="button button-primary theme_media_button" id="custom_media_button"
			       name="<?php echo esc_attr( $this->get_field_name( 'image_uri' ) ); ?>"
			       value="<?php _e( 'Upload Image', 'mp-emmet' ); ?>"
			       style="margin-top:5px;"/>
		</p>
			<p>
				<label
					for="<?php echo esc_attr( $this->get_field_id( 'position' ) ); ?>"><?php _e( 'Image position:', 'mp-emmet' ); ?></label><br/>
				<select name="<?php echo esc_attr( $this->get_field_name( 'position' ) ); ?>"
				        id="<?php echo esc_attr( $this->get_field_id( 'position' ) ); ?>">
					<option value="right" <?php
					if ( $position === 'right' ): echo ' selected ';
					endif;
					?>><?php _e('Right'); ?>
					</option>
					<option value="left" <?php
					if ( $position === 'left' ): echo ' selected ';
					endif;
					?>><?php _e('Left'); ?>
					</option>
				</select>
			</p>
			<p>
				<label
					for="<?php echo esc_attr( $this->get_field_id( 'img_animation' ) ); ?>"><?php _e( 'Image animation:', 'mp-emmet' ); ?></label><br/>
				<?php $this->array_animation('img_animation', $img_animation); ?>
			</p>
			<p>
				<label
					for="<?php echo esc_attr( $this->get_field_id( 'animation' ) ); ?>"><?php _e( 'Content animation:', 'mp-emmet' ); ?></label><br/>
				<?php $this->array_animation('animation', $animation); ?>
			</p>

		<?php
	}
/*
* Return options animations
     */
    function array_animation($option, $curent) {
        ?>
        <select name="<?php echo esc_attr( $this->get_field_name( $option ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $option ) ); ?>">
			<option value="none" <?php if ( $curent === 'none' ): echo ' selected '; endif; ?>>
			<?php _e('None','mp-emmet'); ?>
			</option>
			<option value="fadeIn" <?php if ( $curent === 'fadeIn' ): echo ' selected '; endif; ?>>
			<?php _e('Fade In','mp-emmet'); ?>
			</option>
			<option value="fadeInRight" <?php if ( $curent === 'fadeInRight' ): echo ' selected '; endif; ?>>
			<?php _e('Fade In Right','mp-emmet'); ?>
			</option>
			<option value="fadeInLeft" <?php if ( $curent === 'fadeInLeft' ): echo ' selected '; endif; ?>>
			<?php _e('Fade In Left','mp-emmet'); ?>
			</option>
			<option value="fadeInUp" <?php if ( $curent === 'fadeInUp' ): echo ' selected '; endif; ?>>
			<?php _e('Fade In Up','mp-emmet'); ?>
			</option>
			<option value="fadeInDown" <?php if ( $curent === 'fadeInDown' ): echo ' selected '; endif; ?>>
			<?php _e('Fade In Down','mp-emmet'); ?>
			</option>
		</select>
      <?php
    }
}

add_action( 'widgets_init', create_function( '', 'return register_widget( "MP_Emmet_Plugin_Widget_Feature_Block" );' ) );
