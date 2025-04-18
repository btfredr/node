<?php
/**
 * Class that handle infinite scroll on blog.
 *
 * @package Hestia
 */

/**
 * Class Hestia_Infinite_Scroll
 */
class Hestia_Infinite_Scroll extends Hestia_Abstract_Main {

	/**
	 * Initialize the control. Add all the hooks necessary.
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_ajax_infinite_scroll', array( $this, 'infinite_scroll' ) );
		add_action( 'wp_ajax_nopriv_infinite_scroll', array( $this, 'infinite_scroll' ) );
	}

	/**
	 * Determine if infinite scroll script should be loaded.
	 *
	 * @return bool
	 */
	private function should_enqueue_infinite_scroll() {
		if ( Hestia_Public::is_blog() === false ) {
			return false;
		}
		$hestia_pagination_type = get_theme_mod( 'hestia_pagination_type', 'number' );
		return $hestia_pagination_type === 'infinite';
	}



	/**
	 * Enqueue scripts.
	 */
	public function enqueue_scripts() {
		if ( $this->should_enqueue_infinite_scroll() ) {
			wp_enqueue_script( 'hestia-infinit-scroll', get_template_directory_uri() . '/inc/infinite-scroll/script.js', array( 'jquery', 'masonry' ), HESTIA_VERSION, true );
			hestia_load_fa();
			$script_options = $this->get_infinite_scroll_options();
			wp_localize_script( 'hestia-infinit-scroll', 'infinite', $script_options );
		}
	}

	/**
	 * Get variables that should be passed to infinite scroll js script
	 *
	 * @return array
	 */
	public function get_infinite_scroll_options() {

		global $wp_query;
		$max_pages        = $wp_query->max_num_pages;
		$posts_id_to_skip = array_map(
			function( $p ) {
				return $p->ID;
			},
			$wp_query->posts
		);

		$result = array(
			'ajaxurl'     => admin_url( 'admin-ajax.php' ),
			'max_page'    => $max_pages,
			'nonce'       => wp_create_nonce( 'hestia-infinite-scroll' ),
			'postsToSkip' => $posts_id_to_skip,
		);

		if ( Hestia_Public::should_enqueue_masonry() === true ) {
			$result['masonry'] = true;
		}

		return $result;
	}

	/**
	 * Infinite scroll ajax callback function.
	 */
	public function infinite_scroll() {
		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'hestia-infinite-scroll' ) ) {
			return;
		}

		$page                    = isset( $_POST['page'] ) ? (int) $_POST['page'] : 1;
		$posts_id_to_skip        = ! empty( $_POST['postsToSkip'] ) ? array_unique( array_map( 'intval', $_POST['postsToSkip'] ) ) : array();
		$counter                 = ! empty( $_POST['loadedPost'] ) ? (int) $_POST['loadedPost'] : 0;
		$alternative_blog_layout = get_theme_mod( 'hestia_alternative_blog_layout', 'blog_normal_layout' );
		$posts_per_page          = (int) get_option( 'posts_per_page' );

		$args = array(
			'posts_per_page'      => $posts_per_page,
			'post_type'           => 'post',
			'paged'               => $page,
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish',
			'post__not_in'        => $posts_id_to_skip,
		);

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$counter ++;
				if ( $alternative_blog_layout === 'blog_alternative_layout2' ) {
					get_template_part( 'template-parts/content', 'alternative-2' );
				} elseif ( ( $alternative_blog_layout === 'blog_alternative_layout' ) && ( $counter % 2 === 0 ) ) {
					get_template_part( 'template-parts/content', 'alternative' );
				} else {
					get_template_part( 'template-parts/content' );
				}
			}
			wp_reset_postdata();
		}
		wp_die();
	}

}
