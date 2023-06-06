<?php
/**
 * Plugin_Name	
 *  * @package   Plugin_Name\RestApi
 */

namespace Plugin_Name\Rest;

/**
 * Example class for REST
 */
class RestApi {

	public function init() {
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ), 10 );

	}

	public function register_rest_routes() {
		
	}

}
