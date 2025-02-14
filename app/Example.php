<?php
/**
 * Example of how to create a custom component which accepts a config.
 *
 * @package   NeutronCreative\SafetyDance
 * @link      https://neutroncreative.com/safety-dance
 * @author    Neutron Creative Inc
 * @copyright Copyright © 2018 Neutron Creative Inc
 * @license   GPL-3.0-or-later
 */

namespace NeutronCreative\SafetyDance;

use SeoThemes\Core\Component;

/**
 * Example of how to create a custom component.
 *
 * Example config (usually located at config/defaults.php):
 *
 * ```
 * $core_example = [
 *     Example::SUB_CONFIG => [
 *         Example::KEY => 'value',
 *     ],
 * ];
 *
 * return [
 *     Example::class => $core_example,
 * ];
 * ```
 */
class Example extends Component {

	const SUB_CONFIG = 'sub-config';
	const KEY = 'key';

	/**
	 * Initialize class.
	 *
	 * @since 3.3.0
	 *
	 * @return void
	 */
	public function init() {
		if ( array_key_exists( self::SUB_CONFIG, $this->config ) ) {
			$this->test( $this->config[ self::SUB_CONFIG ] );
		}
	}

	/**
	 * Example method.
	 *
	 * @since 3.3.0
	 *
	 * @param array $config Components sub config.
	 *
	 * @return void
	 */
	protected function test( $config ) {
		// printf( '%s is the value of %s', $config[ self::KEY ], self::KEY );
	}
}
