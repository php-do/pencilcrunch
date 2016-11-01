# PencilCrunch
Complete School Management System created with the CodeIgniter PHP framework

#INSTALLATION
• Upload the downloaded zip file to your server in the public_html directory.
• Extract the zip file
• Create a new database from your server mysql.
• Create user to the database and link the database to the user.
• Open the file database.php from the directory /application/config/database.php
• Fill up these informations with your database hostname, database username, database password, database name respectively which you have created in the previous step.
• Open the file routes.php from the directory /application/config/routes.php
• Change default controller from ‘install’ to ‘login’

```php
'hostname' => '',
'username' => '',
'password' => '',
'database' => '',
```

• Now from server phpmyadmin go to your database. Select import and choose the file install.sql located in uploads/install.sql
• And you are ready to go now to browse the application.
• Default admin credentials
  Email: admin@example.com
  Password: 1234

#Source code structure
The application is developed on CodeIgniter framework and completely follows MVC. The details of this framework can be found in http:// www.codeigniter.com/

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

```php

```

```php

```
