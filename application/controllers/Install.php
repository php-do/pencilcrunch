<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Marcos Fermin
 *	PencilCrunch School Management System
 *	marcosdavid1794@gmail.com
 */

class Install extends CI_Controller {
    
    /***default function, redirects to login page if no admin logged in yet***/
    public function index(){

        $this->load->view('backend/install');
        
    }
}
