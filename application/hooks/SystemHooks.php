<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Joel A. Jaime Blandino <joel.alexander.jaime@gmail.com>
 * @name SystemHooks
 * @description This class is used to validate if anyuser encounters
 * the session started and validate where to do the redirection */
class SystemHooks{
	
	/**
	 * Instance from CI
	 * @type null */
	protected $instance 	= null;

	/**
	 * Login URI
	 * @type string */
	protected $login_uri 	= 'login';

	/**
	 * Login URL
	 * @type string */
	protected $login_url 	= 'index.php?login';

	/**
	 * Method contruct
	 * @description parent extends */
	public function __construct(){
		$this->instance =& get_instance();
	}

	/**
	 * Is The User Loged
	 * @description: validate if the admin
	 * is loged in the system dashboard */
	public function IsTheUserLoged(){

		// ¿is the admin_login index equal to 1?
		$is_different = ( $this->instance->session->userdata('admin_login') == 1 );

		// If the index exists and this actual url is equeal to login :)
		if( $is_different && $this->instance->uri->uri_string === $this->login_uri ){
			
			// redirect to admin dashboard
            redirect( site_url( 'admin/dashboard' ), 'refresh' );
        }
	}

	/**
	 * Is The User Offline
	 * @description: validate if the user
	 * is out of system session */
	public function IsTheUserOffline(){

		// return url or last url, whatever
		$return_url = $this->instance->uri->uri_string;

		// ¿is the admin_login index equal to 1?
		$is_offline = (
			( $this->instance->session->userdata('admin_login') 	!= 1 ) &&
			( $this->instance->session->userdata('teacher_login') 	!= 1 ) &&
			( $this->instance->session->userdata('student_login') 	!= 1 ) &&
			( $this->instance->session->userdata('parent_login') 	!= 1 )
		);
		
		if( $is_offline && $this->instance->uri->uri_string !== $this->login_uri ){
			
			// redirect to login page
            redirect( site_url( "login?next=$return_url" ), 'refresh' );
		}
	}

	/**
	 * Is In Maintenance Mode
	 * Method to validate if the system it's down
	 * it's like maintenance mode from laravel */
	public function IsInMaintenanceMode(){

		// Obtain maintenance_mode index from config file
        $config_maintenance = $this->instance->config->item("maintenance_mode");

        // validate if it's true
        if( $config_maintenance ){

        	// load view and terminate output
            echo $this->instance->load->view('system/maintenance_mode', false, true);
            die();
        }
    }
}