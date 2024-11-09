<?php
/**
 * This file is used for writing all the re-usable custom functions.
 *
 * @since   1.0.0
 * @package    Boston_Industrial_Solutions
 * @subpackage Boston_Industrial_Solutions/includes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if the function exists.
 */
if ( ! function_exists( 'boston_get_posts' ) ) {
	/**
	 * Get the posts.
	 *
	 * @param string $post_type Post type.
	 * @param int    $paged Paged value.
	 * @param int    $posts_per_page Posts per page.
	 * @return object
	 * @since 1.0.0
	 */
	function boston_get_posts( $post_type = 'post', $paged = 1, $posts_per_page = -1 ) {
		// Prepare the arguments array.
		$args = array(
			'post_type'      => $post_type,
			'paged'          => $paged,
			'posts_per_page' => $posts_per_page,
			'post_status'    => 'publish',
			'fields'         => 'ids',
			'orderby'        => 'date',
			'order'          => 'DESC',
		);

		/**
		 * Posts/custom posts listing arguments filter.
		 *
		 * This filter helps to modify the arguments for retreiving posts of default/custom post types.
		 *
		 * @param array $args Holds the post arguments.
		 * @return array
		 */
		$args = apply_filters( 'boston_posts_args', $args );

		return new WP_Query( $args );
	}
}


if ( ! function_exists( 'boston_megamenu_html' ) ) {
	/**
	 * Function for prepare html for megamenu.
	 */
	function boston_megamenu_html() {
		$custom_logo_id        = get_theme_mod( 'custom_logo' );
		$site_logo             = wp_get_attachment_image_src( $custom_logo_id, 'medium' );
		$site_logo_src         = $site_logo[0];
		$mega_menu             = get_field( 'primary_menu', 'option' );
		$search_text           = ! empty( get_search_query() ) ? get_search_query() : '';
		$sticky_logo           = get_field( 'sticky_site_logo', 'option' );
		$sticky_logo_arr       = wp_get_attachment_image_src( $sticky_logo, 'full' );
		$sticky_logo           = ! empty( $sticky_logo_arr ) ? $sticky_logo_arr[0] : $site_logo_src;
		$shop_page             = get_field( 'shop_page', 'option' );
		$shop_page_url         = ! empty( $shop_page ) ? get_permalink( $shop_page ) : "javascript:void(0)";
		$contact_no            = get_field( 'contact_number', 'option' );
		$whatsapp_link         = get_field( 'whatsapp_link', 'option' );
		$whatsapp_url          = ! empty( $whatsapp_link ) ? $whatsapp_link : "javascript:void(0)";
		$request_quote_page    = get_field( 'select_pages', 'option' )['request_quote'];
		$request_quote_url     = ! empty( $request_quote_page ) ? get_permalink( $request_quote_page ) : "javascript:void(0)";
		$request_quote_session = WC()->session->get( 'request_a_quote_session' );
		$request_quote_session = ( is_array( $request_quote_session ) ) ? array_filter( array_values( $request_quote_session ) ) : array();
		$cart_product_count    = count( $request_quote_session );
		?>
		<header>
			<div class="bottom-header sticky-header">
				<div class="container">
					<div class="cover">
						<div class="left-logo">
							<a href="<?php echo esc_attr( site_url() . '/' ); ?>">
							<img src="<?php echo esc_url( $site_logo_src ); ?>">
							</a>
							</div>
							<div class="left-logo logo-sticky">
							<a href="<?php echo esc_attr( site_url() . '/' ); ?>">
							<img src="<?php echo esc_attr( $sticky_logo ); ?>">
							</a>
						</div>
						<div class="right-cover">
							<div class="boston_contact boston_call_btn">
								<a href="tel:17812812558">
									<img width="30" height="33" src="/wp-content/uploads/2023/06/i-1.svg">
								</a>
							</div>
							<div class="main-menu-icon">
								<a href="JavaScript:;" id="menu-icon" class=""> 
									<div class="toggle-icon">
										<img width="38" height="34" src="/wp-content/uploads/2023/06/i-2.svg">
									</div>
									<div class="close-icon">
										<img width="38" height="34" src="/wp-content/uploads/2023/06/close-icon.svg">
									</div>
								</a>
							</div>
						</div>
						<div class="right-nav-menu">
							<div class="nav-menu"><?php echo do_shortcode( '[maxmegamenu location="menu-1"]' ); ?></div>
							<div class="rightnew">
									<ul>
										<li class="bc-mini-cart"><a href="javascript:void(0);" class="headerserchicon"><i class="fas fa-search"></i></a></li>
										<li class="bc-mini-cart">
											<a href="javascript:voi(0);" class="headerhelp"><i class="far fa-question-circle"></i></a>
											<div class="togglephone">
												<ul>
													<li><a href="whatsapp://send?text=Hello World!&phone=+7812814116"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>(781) 281-4116</a></li>
													<li><a href="tel:+17812812558"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M497.4 361.8l-112-48a24 24 0 0 0 -28 6.9l-49.6 60.6A370.7 370.7 0 0 1 130.6 204.1l60.6-49.6a23.9 23.9 0 0 0 6.9-28l-48-112A24.2 24.2 0 0 0 122.6 .6l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.3 24.3 0 0 0 -14-27.6z"/></svg>(781) 281-2558</a></li>
												</ul>	
											</div>	
										</li>
										<li class="bc-mini-cart">
											<a href="<?php echo esc_url( $request_quote_url ); ?>"><i class="fas fa-shopping-cart"></i><span class="cart-count"><?php echo esc_html( $cart_product_count ); ?></span></a>
										</li>	
									</ul>	
								</div>

								<div class="newtogglesearchbox">
									<div class="search-box">
										<div class="header_search_close_icon">
                							<svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  								<line x1="0.945237" y1="30.9914" x2="30.6437" y2="1.2929" stroke="white" stroke-width="2"></line>
                  								<line x1="2.35945" y1="1.29289" x2="32.0579" y2="30.9914" stroke="white" stroke-width="2"></line>
                							</svg>	
            							</div>	
										<!-- <form id="boston_header_searchform" action="<?php echo esc_url( home_url() ); ?>">
											<input type="text" placeholder="Search" name="s" class="search-text" value="<?php echo esc_attr( $search_text ); ?>"> 
											<button type="submit"><i class="fa fa-search"></i></button>
										</form> -->
										<!--<?php //echo do_shortcode( '[fibosearch]' ); ?>-->
									</div>	
								</div>	

							<div class="search-box mobile-view">
								<form id="boston_header_searchform" action="<?php echo esc_url( home_url() ); ?>">
									<input type="text" placeholder="Search" name="s" class="search-text" value="<?php echo esc_attr( $search_text ); ?>"> 
									<button type="submit"><i class="fa fa-search"></i></button>
								</form>
							</div>
							<div class="right-scl-icon mobile-view">
							<ul>
								<li><a href="<?php echo esc_url( $whatsapp_url ); ?>"><i class="fa-brands fa-whatsapp"></i></a></li>
								<li><a href="<?php echo esc_url( $shop_page_url ); ?>">SHOP</a></li>
								<li class="bc-mini-cart"><a href="<?php echo esc_url( $request_quote_url ); ?>"><i class="far fa-shopping-cart"></i><span class="cart-count"><?php echo esc_html( $cart_product_count ); ?></span></a></li>
							</ul>
						</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<?php
	}
}
