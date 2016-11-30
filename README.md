# PencilCrunch
Complete School Management System created with the CodeIgniter PHP framework

#INSTALLATION
* Upload the project (or downloaded zip file) to your server in the public_html directory.
* Extract the zip file (if downloaded as zip file)
* Create a new database from your server mysql.
* Create user to the database and link the database to the user.
* Open the file database.php from the directory /application/config/database.php
* Fill up these informations with your database hostname, database username, database password, database name respectively which you have created in the previous step.
* Open the file routes.php from the directory /application/config/routes.php
* Change default controller from ‘install’ to ‘login’

```php
'hostname' => '',
'username' => '',
'password' => '',
'database' => '',
```

* Now from server phpmyadmin go to your database. Select import and choose the file install.sql located in uploads/install.sql
* And you are ready to go now to browse the application.
* Default admin credentials
  Email: admin@example.com
  Password: 1234

#Source code structure
The application is developed on CodeIgniter framework and completely follows MVC. The details of this framework can be found in http://www.codeigniter.com/

The root directory contains
- application
contains the core files of the application 
- assets
contains all css styles and javascript files
- system
contains all the configurations and library files of the framework
- uploads
- admin_image
contains the profile image uploaded by admin himself
- student_image
contains the uploaded images of students
- teacher_image
contains the images of teachers
- document
contains the study materials uploaded by teacher
- index.php
this file on loading calls all the codeIgniter functions


application
- config
contains the configuration files of the application
- controllers
- Admin.php
- Login.php
- Modal.php
- Multilanguage.php
- Parents.php
- Simplexlsx.class.php
- Student.php
- Teacher.php
- helpers
- libraries
- models
- Crud_model.php
- Email_model.php
- Sms_model.php
- views
- backend
- admin
contains all the view files of admin panel
- parent
contains all the view files of parent panel 
- student
contains all the view files of student panel
- teacher
contains all the view files for teacher panel
- footer.php
- forgot_password.php
- header.php
- includes_bottom.php
contains links to javascript, jquery & library files
- includes_top.php
contains links to css files
- index.html
- index.php
- login.php
the login page
- modal.php

#Source code description

Admin Controller( /application/controllers/Admin.php)

Admin dashboard:
```php
/***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
```
The dashboard function loads the view file named dashboard.php and redirects to login page if the admin login is not true.

Manage students

The function student has the ability to add, edit or delete students form the system. An email is sent to the student on creating his/her account by admin. 

The function parent has the ability to add, edit or delete parents form the system. An email is sent to the parent on creating his/her account by admin. 

Manage exams
```php
/****MANAGE EXAMS*****/
    function exam($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');
            
            $this->db->where('exam_id', $param3);
            $this->db->update('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                'exam_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        $page_data['exams']      = $this->db->get('exam')->result_array();
        $page_data['page_name']  = 'exam';
        $page_data['page_title'] = get_phrase('manage_exam');
        $this->load->view('backend/index', $page_data);
    }
```

Send SMS on Exam Marks
```php
  /****** SEND EXAM MARKS VIA SMS ********/
    function exam_marks_sms($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_sms') {

            $exam_id    =   $this->input->post('exam_id');
            $class_id   =   $this->input->post('class_id');
            $receiver   =   $this->input->post('receiver');

            // get all the students of the selected class
            $students = $this->db->get_where('student' , array(
                'class_id' => $class_id
            ))->result_array();
            // get the marks of the student for selected exam
            foreach ($students as $row) {
                if ($receiver == 'student')
                    $receiver_phone = $row['phone'];
                if ($receiver == 'parent' && $row['parent_id'] != '') 
                    $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;
                

                $this->db->where('exam_id' , $exam_id);
                $this->db->where('student_id' , $row['student_id']);
                $marks = $this->db->get('mark')->result_array();
                $message = '';
                foreach ($marks as $row2) {
                    $subject       = $this->db->get_where('subject' , array('subject_id' => $row2['subject_id']))->row()->name;
                    $mark_obtained = $row2['mark_obtained'];  
                    $message      .= $row2['student_id'] . $subject . ' : ' . $mark_obtained . ' , ';
                    
                }
                // send sms
                $this->sms_model->send_sms( $message , $receiver_phone );
            }
            $this->session->set_flashdata('flash_message' , get_phrase('message_sent'));
            redirect(base_url() . 'index.php?admin/exam_marks_sms' , 'refresh');
        }
                
        $page_data['page_name']  = 'exam_marks_sms';
        $page_data['page_title'] = get_phrase('send_marks_by_sms');
        $this->load->view('backend/index', $page_data);
    }
```

Manage Daily Attendance

The attendance module holds the commands for entering attendance status for a particular student of a particular class for a particular day.
```php
	/****** DAILY ATTENDANCE *****************/
	function manage_attendance($date='',$month='',$year='',$class_id='')
	{
		if($this->session->userdata('admin_login')!=1)redirect('login' , 'refresh');
		
		if($_POST)
		{
			// Loop all the students of $class_id
            $students   =   $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach ($students as $row)
            {
                $attendance_status  =   $this->input->post('status_' . $row['student_id']);

                $this->db->where('student_id' , $row['student_id']);
                $this->db->where('date' , $this->input->post('date'));

                $this->db->update('attendance' , array('status' => $attendance_status));
            }

			$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			redirect(base_url() . 'index.php?admin/manage_attendance/'.$date.'/'.$month.'/'.$year.'/'.$class_id , 'refresh');
		}
        $page_data['date']     =	$date;
        $page_data['month']    =	$month;
        $page_data['year']     =	$year;
        $page_data['class_id'] =	$class_id;
		
        $page_data['page_name']  =	'manage_attendance';
        $page_data['page_title'] =	get_phrase('manage_daily_attendance');
		$this->load->view('backend/index', $page_data);
	}
	function attendance_selector()
	{
		redirect(base_url() . 'index.php?admin/manage_attendance/'.$this->input->post('date').'/'.
					$this->input->post('month').'/'.
						$this->input->post('year').'/'.
							$this->input->post('class_id') , 'refresh');
	}
```

Private Messaging

The messaging function holds the commands for sending messages to the users of the system. It's made in such a way that the communicating persons can transfer message privately only between them.

Profile Settings

The function profile_settings holds the logical expressions for
- updating current profile informations.
- uploading a profile picture.
- updating or changing login password. 

The function settings holds the logical expressions for
- updating system informations like company name or email and other system informations.
- uploading a company logo.
- Changing system themes


The Model Files (/application/models)

models
- Crud_model.php
contains the basic functions for create, retrieve, update and delete which works in association of controllers or views.
- Email_model.php
contains the functions that send email on different events.
- Sms_model.php
contains the functions that send SMS on different events.


The View Files (/application/views)

views

- admin
contains all the view files of admin panel
- parent
contains all the view files of parent panel
- student
contains all the view files of student panel
- teacher
contains all the view files of teacher panel
- footer.php
contains the footer informations of the application 
- forgot_password.php
page for resetting password by email
- header.php
contains the header view of the application
- includes_bottom.php
contains links to javascript files
- includes_top.php
contains links to css files
- index.html


- index.php
includes the footer, header, javascript, css, modals at the time of  page loading.
- login.php
the login page
- modal.php
contains the modal views which are used in the view of different panels. 
