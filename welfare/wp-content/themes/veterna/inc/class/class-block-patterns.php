<?php
/**
 * Block Pattern Class
 *
 * @author Jegstudio
 * @package veterna
 */

namespace Veterna;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WP_Block_Pattern_Categories_Registry;

/**
 * Init Class
 *
 * @package veterna
 */
class Block_Patterns {

	/**
	 * Instance variable
	 *
	 * @var $instance
	 */
	private static $instance;

	/**
	 * Class instance.
	 *
	 * @return BlockPatterns
	 */
	public static function instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->register_block_patterns();
		$this->register_synced_patterns();
	}

	/**
	 * Register Block Patterns
	 */
	private function register_block_patterns() {
		$block_pattern_categories = array(
			'veterna-core' => array( 'label' => __( 'Veterna Core Patterns', 'veterna' ) ),
		);

		if ( defined( 'GUTENVERSE' ) ) {
			$block_pattern_categories['veterna-gutenverse'] = array( 'label' => __( 'Veterna Gutenverse Patterns', 'veterna' ) );
			$block_pattern_categories['veterna-pro'] = array( 'label' => __( 'Veterna Gutenverse PRO Patterns', 'veterna' ) );
		}

		$block_pattern_categories = apply_filters( 'veterna_block_pattern_categories', $block_pattern_categories );

		foreach ( $block_pattern_categories as $name => $properties ) {
			if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
				register_block_pattern_category( $name, $properties );
			}
		}

		$block_patterns = array(
            
		);

		if ( defined( 'GUTENVERSE' ) ) {
            $block_patterns[] = 'veterna-index-gutenverse-hero';			$block_patterns[] = 'veterna-gutenverse-blog';			$block_patterns[] = 'veterna-search-gutenverse-hero';			$block_patterns[] = 'veterna-gutenverse-blog';			$block_patterns[] = 'veterna-archive-gutenverse-hero';			$block_patterns[] = 'veterna-gutenverse-blog';			$block_patterns[] = 'veterna-index-gutenverse-hero';			$block_patterns[] = 'veterna-single-gutenverse-hero';			$block_patterns[] = 'veterna-single-gutenverse-single';			$block_patterns[] = 'veterna-404-gutenverse-hero';			$block_patterns[] = 'veterna-gutenverse-header';			$block_patterns[] = 'veterna-gutenverse-footer';
            
		}

		$block_patterns = apply_filters( 'veterna_block_patterns', $block_patterns );
		$pattern_list   = get_option( 'veterna_synced_pattern_imported', false );
		if ( ! $pattern_list ) {
			$pattern_list = array();
		}

		if ( function_exists( 'register_block_pattern' ) ) {
			foreach ( $block_patterns as $block_pattern ) {
				$pattern_file = get_theme_file_path( '/inc/patterns/' . $block_pattern . '.php' );
				$pattern_data = require $pattern_file;

				if ( (bool) $pattern_data['is_sync'] ) {
					$post = get_page_by_path( $block_pattern . '-synced', OBJECT, 'wp_block' );
					if ( empty( $post ) ) {
						/**Download Image */
						$content = wp_slash( $pattern_data['content'] );
						if ( $pattern_data['images'] ) {
							$images = json_decode( $pattern_data['images'] );
							foreach ( $images as $key => $image ) {
								$url  = $image->image_url;
								$data = Helper::check_image_exist( $url );
								if ( ! $data ) {
									$data = Helper::handle_file( $url );
								}
								$content = str_replace( $url, $data['url'], $content );
								$image_id = $image->image_id;
								if ( $image_id && 'null' !== $image_id ) {
									$content = str_replace( '"imageId\":' . $image_id, '"imageId\":' . $data['id'], $content );
								}
							}
						}
						$post_id = wp_insert_post(
							array(
								'post_name'    => $block_pattern . '-synced',
								'post_title'   => $pattern_data['title'],
								'post_content' => $content,
								'post_status'  => 'publish',
								'post_author'  => 1,
								'post_type'    => 'wp_block',
							)
						);
						if ( ! is_wp_error( $post_id ) ) {
							$pattern_category = $pattern_data['categories'];
							foreach( $pattern_category as $category ){
								wp_set_object_terms( $post_id, $category, 'wp_pattern_category' );
							}
						}
						$pattern_data['content']  = '<!-- wp:block {"ref":' . $post_id . '} /-->';
						$pattern_data['inserter'] = false;
						$pattern_data['slug']     = $block_pattern;

						$pattern_list[] = $pattern_data;
					}
				} else {
					register_block_pattern(
						'veterna/' . $block_pattern,
						require $pattern_file
					);
				}
			}
			update_option( 'veterna_synced_pattern_imported', $pattern_list );
		}
	}

	/**
	 * Register Synced Patterns
	 */
	 private function register_synced_patterns() {
		$patterns = get_option( 'veterna_synced_pattern_imported' );

		 foreach ( $patterns as $block_pattern ) {
			 register_block_pattern(
				'veterna/' . $block_pattern['slug'],
				$block_pattern
			);
		 }
	 }
}
