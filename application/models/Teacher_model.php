<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Teacher_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


/**************************** The function below insert into bank and teacher tables   **************************** */
    function insetTeacherFunction (){

        $bank_data['account_holder_name'] = html_escape($this->input->post('account_holder_name'));
        $bank_data['account_number'] = html_escape($this->input->post('account_number'));
        $bank_data['bank_name'] = html_escape($this->input->post('bank_name'));
        $bank_data['branch'] = html_escape($this->input->post('branch'));

        $this->db->insert('bank', $bank_data);
        $bank_id = $this->db->insert_id();


        $teacher_array = array(
            'name'                  => html_escape($this->input->post('name')),
            'role'                  => html_escape($this->input->post('role')),
			'teacher_number'        => html_escape($this->input->post('teacher_number')),
			'birthday'              => $this->input->post('birthday'),
        	'sex'                   => html_escape($this->input->post('sex')),
            'religion'              => html_escape($this->input->post('religion')),
            'blood_group'           => html_escape($this->input->post('blood_group')),
            'address'               => html_escape($this->input->post('address')),
			'phone'                 => html_escape($this->input->post('phone')),
			'facebook'              => html_escape($this->input->post('facebook')),
        	'twitter'               => html_escape($this->input->post('twitter')),
            'googleplus'            => html_escape($this->input->post('googleplus')),
            'linkedin'              => html_escape($this->input->post('linkedin')),
            'qualification'         => html_escape($this->input->post('qualification')),
			'marital_status'        => html_escape($this->input->post('marital_status')),
			'password'              => sha1($this->input->post('password')),
        	'department_id'         => $this->input->post('department_id'),
            'designation_id'        => $this->input->post('designation_id'),
            'date_of_joining'       => $this->input->post('date_of_joining'),
            'joining_salary'        => html_escape($this->input->post('joining_salary')),
			'status'                => html_escape($this->input->post('status')),
			'date_of_leaving'       => $this->input->post('date_of_leaving')
            );
        
            $teacher_array['file_name'] = $_FILES["file_name"]["name"];
            $teacher_array['email'] = html_escape($this->input->post('email'));
            $teacher_array['bank_id'] = $bank_id;
            $check_email = $this->db->get_where('teacher', array('email' => $teacher_array['email']))->row()->email;	// checking if email exists in database
            if($check_email != null) 
            {
            $this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
            redirect(base_url() . 'admin/teacher/', 'refresh');
            }
            else
            {
            $this->db->insert('teacher', $teacher_array);
            $teacher_id = $this->db->insert_id();
            
                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/teacher_image/" . $_FILES["file_name"]["name"]);	// upload files
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');			// image with user ID
            }

    }


    function updateTeacherFunction($param2){

        $teacher_data = array(
            'name'                  => html_escape($this->input->post('name')),
            'role'                  => html_escape($this->input->post('role')),
			'birthday'              => $this->input->post('birthday'),
        	'sex'                   => html_escape($this->input->post('sex')),
            'religion'              => html_escape($this->input->post('religion')),
            'blood_group'           => html_escape($this->input->post('blood_group')),
            'address'               => html_escape($this->input->post('address')),
            'phone'                 => html_escape($this->input->post('phone')),
            'email'                 => html_escape($this->input->post('email')),
			'facebook'              => html_escape($this->input->post('facebook')),
        	'twitter'               => html_escape($this->input->post('twitter')),
            'googleplus'            => html_escape($this->input->post('googleplus')),
            'linkedin'              => html_escape($this->input->post('linkedin')),
            'qualification'         => html_escape($this->input->post('qualification')),
			'marital_status'        => html_escape($this->input->post('marital_status'))
            );

            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $teacher_data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg'); 			// image with user ID
    }


    function deleteTeacherFunction($param2){

        $this->db->where('teacher_id', $param2);
        $this->db->delete('teacher');
    }
	


	
	
}
