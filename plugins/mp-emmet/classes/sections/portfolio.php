<?php

class MP_Emmet_Plugin_Portfolio {

	public function __construct() {
		add_action( 'mp_emmet_section_portfolio', array( $this, 'get_html' ) );
	}

	/*
	 * Get default portfolio
	 */

	public function get_default_portfolio() {
		$mp_emmet_portfolio_animation = esc_attr( get_theme_mod( 'theme_portfolio_animation', 'fadeInLeft' ) );
		?>
		<div class="portfolio-list">
			<div class="portfolio-box  <?php
			if ( $mp_emmet_portfolio_animation != 'none' ): echo 'animated anHidden"  data-animation="' . $mp_emmet_portfolio_animation;
			endif;
			?>">
				<a href="#" class="portfolio-content">
					<img src="<?php echo MP_EMMET_PLUGIN_PATH . 'images/portfolio1.jpg'; ?>"
					     class="attachment-thumb-portfolio wp-post-image"
					     alt="<?php _e( 'Fitsy logo', 'mp-emmet' ); ?>">
					<div class="portfolio-hover">
						<div class="hover-content">
							<div>
								<h5 class="portfolio-title"><?php _e( 'Fitsy logo', 'mp-emmet' ); ?></h5>
								<div class="portfolio-categories">
									<span><?php _e( 'Logotypes', 'mp-emmet' ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="portfolio-box  <?php
			if ( $mp_emmet_portfolio_animation != 'none' ): echo 'animated anHidden"  data-animation="' . $mp_emmet_portfolio_animation;
			endif;
			?>">
				<a href="#" class="portfolio-content">
					<img src="<?php echo MP_EMMET_PLUGIN_PATH . 'images/portfolio2.jpg'; ?>"
					     class="attachment-thumb-portfolio wp-post-image"
					     alt="<?php _e( 'Fitsy logo', 'mp-emmet' ); ?>">
					<div class="portfolio-hover">
						<div class="hover-content">
							<div>
								<h5 class="portfolio-title"><?php _e( 'Fitsy logo', 'mp-emmet' ); ?></h5>
								<div class="portfolio-categories">
									<span><?php _e( 'Web-design', 'mp-emmet' ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="portfolio-box  <?php
			if ( $mp_emmet_portfolio_animation != 'none' ): echo 'animated anHidden"  data-animation="' . $mp_emmet_portfolio_animation;
			endif;
			?>">
				<a href="#" class="portfolio-content">
					<img src="<?php echo MP_EMMET_PLUGIN_PATH . 'images/portfolio3.jpg'; ?>"
					     class="attachment-thumb-portfolio wp-post-image"
					     alt="<?php _e( 'Fitsy logo', 'mp-emmet' ); ?>">
					<div class="portfolio-hover">
						<div class="hover-content">
							<div>
								<h5 class="portfolio-title"><?php _e( 'Fitsy logo', 'mp-emmet' ); ?></h5>
								<div class="portfolio-categories">
									<span><?php _e( 'Print', 'mp-emmet' ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="portfolio-box  <?php
			if ( $mp_emmet_portfolio_animation != 'none' ): echo 'animated anHidden"  data-animation="' . $mp_emmet_portfolio_animation;
			endif;
			?>">
				<a href="#" class="portfolio-content">
					<img src="<?php echo MP_EMMET_PLUGIN_PATH . 'images/portfolio4.jpg'; ?>"
					     class="attachment-thumb-portfolio wp-post-image"
					     alt="<?php _e( 'Fitsy logo', 'mp-emmet' ); ?>">
					<div class="portfolio-hover">
						<div class="hover-content">
							<div>
								<h5 class="portfolio-title"><?php _e( 'Fitsy logo', 'mp-emmet' ); ?></h5>
								<div class="portfolio-categories">
									<span><?php _e( 'Aplications', 'mp-emmet' ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="portfolio-box  <?php
			if ( $mp_emmet_portfolio_animation != 'none' ): echo 'animated anHidden"  data-animation="' . $mp_emmet_portfolio_animation;
			endif;
			?>">
				<a href="#" class="portfolio-content">
					<img src="<?php echo MP_EMMET_PLUGIN_PATH . 'images/portfolio5.jpg'; ?>"
					     class="attachment-thumb-portfolio wp-post-image"
					     alt="<?php _e( 'Fitsy logo', 'mp-emmet' ); ?>">
					<div class="portfolio-hover">
						<div class="hover-content">
							<div>
								<h5 class="portfolio-title"><?php _e( 'Fitsy logo', 'mp-emmet' ); ?></h5>
								<div class="portfolio-categories">
									<span><?php _e( 'Aplications', 'mp-emmet' ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="portfolio-box  <?php
			if ( $mp_emmet_portfolio_animation != 'none' ): echo 'animated anHidden"  data-animation="' . $mp_emmet_portfolio_animation;
			endif;
			?>">
				<a href="#" class="portfolio-content">
					<img src="<?php echo MP_EMMET_PLUGIN_PATH . 'images/portfolio6.jpg'; ?>"
					     class="attachment-thumb-portfolio wp-post-image"
					     alt="<?php _e( 'Fitsy logo', 'mp-emmet' ); ?>">
					<div class="portfolio-hover">
						<div class="hover-content">
							<div>
								<h5 class="portfolio-title"><?php _e( 'Fitsy logo', 'mp-emmet' ); ?></h5>
								<div class="portfolio-categories">
									<span><?php _e( 'llustrations', 'mp-emmet' ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="portfolio-box  <?php
			if ( $mp_emmet_portfolio_animation != 'none' ): echo 'animated anHidden"  data-animation="' . $mp_emmet_portfolio_animation;
			endif;
			?>">
				<a href="#" class="portfolio-content">
					<img src="<?php echo MP_EMMET_PLUGIN_PATH . 'images/portfolio7.jpg'; ?>"
					     class="attachment-thumb-portfolio wp-post-image"
					     alt="<?php _e( 'Fitsy logo', 'mp-emmet' ); ?>">
					<div class="portfolio-hover">
						<div class="hover-content">
							<div>
								<h5 class="portfolio-title"><?php _e( 'Fitsy logo', 'mp-emmet' ); ?></h5>
								<div class="portfolio-categories">
									<span><?php _e( 'Web-design', 'mp-emmet' ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="portfolio-box  <?php
			if ( $mp_emmet_portfolio_animation != 'none' ): echo 'animated anHidden"  data-animation="' . $mp_emmet_portfolio_animation;
			endif;
			?>">
				<a href="#" class="portfolio-content">
					<img src="<?php echo MP_EMMET_PLUGIN_PATH . 'images/portfolio8.jpg'; ?>"
					     class="attachment-thumb-portfolio wp-post-image"
					     alt="<?php _e( 'Fitsy logo', 'mp-emmet' ); ?>">
					<div class="portfolio-hover">
						<div class="hover-content">
							<div>
								<h5 class="portfolio-title"><?php _e( 'Fitsy logo', 'mp-emmet' ); ?></h5>
								<div class="portfolio-categories">
									<span><?php _e( 'Your category', 'mp-emmet' ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php
	}

	/*
	 * Get portfolio
	 */

	public function get_portfolio() {
		$mp_emmet_portfolio_animation = esc_attr( get_theme_mod( 'theme_portfolio_animation', 'fadeInLeft' ) );
		$posts_per_page = apply_filters( 'mp_emmet_portfolio_posts_per_page', 8);
		$args                         = array(
			'post_type'      => 'portfolio',
			'posts_per_page' => $posts_per_page
		);
		$prizes                       = new WP_Query( $args );
		if ( $prizes->have_posts() ) {
			?>
			<div class="portfolio-list ">
				<?php
				while ( $prizes->have_posts() ) {
					$prizes->the_post();
					?>
					<div class="portfolio-box  <?php
					if ( $mp_emmet_portfolio_animation != 'none' ): echo 'animated anHidden"  data-animation="' . $mp_emmet_portfolio_animation;
					endif;
					?>">
						<a href="<?php the_permalink(); ?>" class="portfolio-content">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'mp-emmet-thumb-medium' );
							} else {
								?>
								<div class="portfolio-empty-thumbnail">
                                    <span class="date-post">
                                        <?php echo get_post_time( 'j M' ); ?>
                                    </span>
								</div>
								<?php
							}
							?>
							<div class="portfolio-hover">
								<div class="hover-content">
									<div>
										<h5 class="portfolio-title"><?php the_title(); ?></h5>
										<?php
										$post_categories = wp_get_post_categories( get_the_ID() );
										$cats            = array();
										if ( ! empty( $post_categories ) ) :
											?>
											<div class="portfolio-categories">
												<?php
												foreach ( $post_categories as $c ) {
													$cat = get_category( $c );
													echo '<span> ' . $cat->name . ' </span>';
												}
												?>
											</div>
											<?php
										endif;
										?>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php }
				?>
				<div class="clearfix"></div>
			</div>
			<?php
		} else {
			$this->get_default_portfolio();
		}
	}

	/*
	 * Get title
	 */

	public function get_title() {
		$mp_emmet_portfolio_title = esc_html( get_theme_mod( 'theme_portfolio_title' ) );
		if ( get_theme_mod( 'theme_portfolio_title', false ) === false ) :
			?>
			<h2 class="section-title"><?php _e( 'our portfolio', 'mp-emmet' ); ?></h2>
			<?php
		else:
			if ( ! empty( $mp_emmet_portfolio_title ) ):
				?>
				<h2 class="section-title"><?php echo $mp_emmet_portfolio_title; ?></h2>
				<?php
			endif;
		endif;
	}

	/*
	 * Get description
	 */

	public function get_description() {
		$mp_emmet_portfolio_description = wp_kses( get_theme_mod( 'theme_portfolio_description' ), mp_emmet_plugin_allowed_html() );

		if ( get_theme_mod( 'theme_portfolio_description', false ) === false ) :
			?>
			<div
				class="section-description"><?php _e( 'In the portfolio section you can display your works consisting of screenshots and additional information', 'mp-emmet' ); ?></div>
			<?php
		else:
			if ( ! empty( $mp_emmet_portfolio_description ) ):
				?>
				<div class="section-description"><?php echo $mp_emmet_portfolio_description; ?></div>
				<?php
			endif;
		endif;
	}

	/*
	 * Get Buttons
	 */

	public function get_buttons() {
		$mp_emmet_portfolio_button_label = esc_html( get_theme_mod( 'theme_portfolio_button_label', __( 'check all works', 'mp-emmet' ) ) );
		$mp_emmet_portfolio_button_url   = esc_url( get_theme_mod( 'theme_portfolio_button_url','#portfolio' ) );
		?>
		<div class="section-buttons">
			<?php
			if ( ! empty( $mp_emmet_portfolio_button_label ) && ! empty( $mp_emmet_portfolio_button_url ) ):
				?>
				<a href="<?php echo $mp_emmet_portfolio_button_url; ?>"
				   title="<?php echo $mp_emmet_portfolio_button_label; ?>" class="button white-button">
					<?php echo $mp_emmet_portfolio_button_label; ?></a>
				<?php
			endif;
			?>
		</div>
		<?php
	}

	/*
	 * features section html
	 */

	public function get_html() {
		?>
		<section id="portfolio" class="portfolio-section white-section default-section">
			<div class="container">
				<div class="section-content">
					<?php
					$this->get_title();
					$this->get_description();
					$this->get_portfolio();
					$this->get_buttons();
					?>
				</div>
			</div>
		</section>
		<?php
	}
}
