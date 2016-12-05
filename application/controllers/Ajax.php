<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Joel A. Jaime Blandino <joel.alexander.jaime@gmail.com>
 * @name Ajax
 * @description This class is for asynchronous actions using
 * XMLHttpRequest where it can only be accessed by ajax */
class Ajax extends CI_Controller{
	
	/**
	 * Available Methods
	 * @type array */
	protected $available_methods = [
		'users.login'
	];

	/**
	 * Default Response
	 * @type array */
	protected $default_response = [
		'error'		=>	404,
		'message'	=>	'Not found'
	];

	/**
	 * Method construct
	 * @description method to validate if this
	 * request is XMLHttpRequest */
	public function __construct(){
		parent::__construct();

		// ¿this request is XMLHttpRequest?
		if( !$this->input->is_ajax_request() ){
			// No, so send not found resource
			$this->responseNotFound();
		}
	}

	public function index(){

		// Obtain post Request
		$post = $this->input->post();

		// ¿This method exists and it's available?
		if( !isset( $post['method'] ) || !in_array( $post['method'], $this->available_methods ) ){
			$this->responseNotFound();
		}

		// Validate method and call this action
		switch( strtolower( $post['method'] ) ){

			// Method to login user in the platform
			case 'users.login':

			break;

			default:break;
		}

	}

	/**
	 * Method to send 404 error
	 * @description this method send 404 headers
	 * and response to navigator. */
	public function responseNotFound(){

		// obviously, error 404, it's not found
		header("HTTP/1.0 404 Not Found");

		// Content type is json, like real api:P
		header('Content-Type: text/json');

		// encoding json to send response
		echo json_encode( $this->default_response );
		exit;
	}
}