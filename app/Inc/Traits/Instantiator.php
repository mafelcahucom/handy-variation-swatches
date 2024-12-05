<?php
/**
 * App > Inc > Traits > Instantiator.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Inc\Traits;

defined( 'ABSPATH' ) || exit;

/**
 * The `Instantiator` class provides a method that can be inherited
 * by all the class who inherit `singleton`. The method can be
 * used to instantiate class.
 *
 * @since 1.0.0
 */
trait Instantiator {

	/**
	 * Protected class constructor to prevent direct object creation.
	 *
	 * @since 1.0.0
	 */
	protected function __construct() {}

	/**
	 * Instantiate all classes provided. Loop through the
	 * services classes and instantiate each class.
	 *
	 * @since 1.0.0
	 *
	 * @param  array $services Contains the services or classes to be instantiated.
	 * @return void
	 */
	private static function instantiate( $services = array() ) {
		if ( ! empty( $services ) ) {
			foreach ( $services as $service ) {
				if ( method_exists( $service, 'get_instance' ) ) {
					self::register( $service );
				}
			}
		}
	}

	/**
	 * Register or instantiate the given service class.
	 *
	 * @param  class $service Contains a service from $services.
	 * @return void
	 */
	private static function register( $service ) {
		$service::get_instance();
	}
}
