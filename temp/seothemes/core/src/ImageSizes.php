<?php
/**
 * Add or remove image sizes through configuration.
 *
 * @package   SeoThemes\Core
 * @author    Lee Anthony <seothemeswp@gmail.com>
 * @author    Lee Anthony <seothemeswp@gmail.com>
 * @copyright 2018, D2Themes
 * @license   GPL-3.0-or-later
 */

namespace SeoThemes\Core;

/**
 * Add or remove image sizes through configuration.
 *
 * Example config (usually located at config/defaults.php):
 *
 * ```
 * use SeoThemes\Core\ImageSizes;
 *
 * $d2_image_sizes = [
 *     ImageSizes::REMOVE => [
 *         'example_image_size',
 *     ],
 *     ImageSizes::ADD    => [
 *         'featured' => [
 *             ImageSizes::WIDTH  => 620,
 *             ImageSizes::HEIGHT => 380,
 *             ImageSizes::CROP   => true,
 *         ],
 *         'hero'        => [
 *             ImageSizes::WIDTH  => 1280,
 *             ImageSizes::HEIGHT => 720,
 *             ImageSizes::CROP   => true,
 *         ],
 *     ],
 * ];
 *
 * return [
 *     ImageSizes::class => $d2_image_sizes,
 * ];
 * ```
 *
 * @package SeoThemes\Core
 */
class ImageSizes extends Component {

	const ADD    = 'add';
	const REMOVE = 'remove';
	const WIDTH  = 'width';
	const HEIGHT = 'height';
	const CROP   = 'crop';

	/**
	 * Add or remove image sizes through configuration.
	 *
	 * @since 0.1.0
	 *
	 * @link https://developer.wordpress.org/reference/functions/remove_image_size/
	 *
	 * @return void
	 */
	public function init() {
		if ( array_key_exists( self::REMOVE, $this->config ) ) {
			array_map( 'remove_image_size', $this->config[ self::REMOVE ] );
		}

		if ( array_key_exists( self::ADD, $this->config ) ) {
			$this->add_image_sizes( $this->config[ self::ADD ] );
		}
	}

	/**
	 * Add image sizes.
	 *
	 * @since 0.1.0
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_image_size/
	 *
	 * @param array $image_sizes Array of image sizes to add.
	 *
	 * @return void
	 */
	public function add_image_sizes( $image_sizes ) {
		foreach ( $image_sizes as $name => $args ) {
			$crop = ( array_key_exists( self::CROP, $args ) ? $args[ self::CROP ] : false );
			add_image_size( $name, $args[ self::WIDTH ], $args[ self::HEIGHT ], $crop );
		}
	}
}
