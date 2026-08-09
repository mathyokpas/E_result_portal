<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('academic_model');                   // Load Apllication Model Here
                $this->load->model('student_model');                    // Load Apllication Model Here
                $this->load->model('exam_question_model');              // Load Apllication Model Here
                $this->load->model('student_payment_model');            // Load Apllication Model Here
                $this->load->model('event_model');                      // Load Apllication Model Here
                $this->load->model('language_model');                      // Load Apllication Model Here
                $this->load->model('admin_model');                      // Load Apllication Model Here
    }

    /**default functin, redirects to login page if no admin logged in yet***/
    public function index() 
	{
    if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');
    if ($this->session->userdata('admin_login') == 1) redirect(base_url() . 'admin/dashboard', 'refresh');
    }
	  /************* / default functin, redirects to login page if no admin logged in yet***/

    /*Admin dashboard code to redirect to admin page if successfull login** */
    function dashboard() {
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / Admin dashboard code to redirect to admin page if successfull login** */


    function manage_profile($param1 = null, $param2 = null, $param3 = null){
    if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
    if ($param1 == 'update') {


        $data['name']   =   html_escape($this->input->post('name'));
        $data['email']  =   html_escape($this->input->post('email'));

        $this->db->where('admin_id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
        redirect(base_url() . 'admin/manage_profile', 'refresh');
       
    }

    if ($param1 == 'change_password') {
        $data['new_password']           =   sha1($this->input->post('new_password'));
        $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));

        if ($data['new_password'] == $data['confirm_new_password']) {
           
           $this->db->where('admin_id', $this->session->userdata('admin_id'));
           $this->db->update('admin', array('password' => $data['new_password']));
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }

        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url() . 'admin/manage_profile', 'refresh');
    }

        $page_data['page_name']     = 'manage_profile';
        $page_data['page_title']    = get_phrase('Manage Profile');
        $page_data['edit_profile']  = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }


    function enquiry_category($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'insert'){
   
        $this->crud_model->enquiry_category();

        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');
    }

    if($param1 == 'update'){

       $this->crud_model->update_category($param2);


        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

    if($param1 == 'delete'){

       $this->crud_model->delete_category($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

        $page_data['page_name']     = 'enquiry_category';
        $page_data['page_title']    = get_phrase('Manage Category');
        $page_data['enquiry_category']  = $this->db->get('enquiry_category')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function list_enquiry ($param1 = null, $param2 = null, $param3 = null){


        if($param1 == 'delete')
        {
            $this->crud_model->delete_enquiry($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/list_enquiry', 'refresh');
    
        }

        $page_data['page_name']     = 'list_enquiry';
        $page_data['page_title']    = get_phrase('All Enquiries');
        $page_data['select_enquiry']  = $this->db->get('enquiry')->result_array();
        $this->load->view('backend/index', $page_data);

    }



    function club ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->crud_model->insert_club();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
        }

        if($param1 == 'update'){
            $this->crud_model->update_club($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
        }


        if($param1 == 'delete'){
            $this->crud_model->delete_club($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
    
            }


        $page_data['page_name']     = 'club';
        $page_data['page_title']    = get_phrase('Manage Club');
        $page_data['select_club']  = $this->db->get('club')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function circular($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_circular();
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/circular', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_circular($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/circular', 'refresh');

        }


        if($param1 == 'delete'){
            $this->crud_model->delete_circular($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/circular', 'refresh');


        }

        $page_data['page_name']         = 'circular';
        $page_data['page_title']        = get_phrase('Manage Circular');
        $page_data['select_circular']   = $this->db->get('circular')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function parent($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_parent();
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/parent', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_parent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/parent', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_parent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/parent', 'refresh');

        }

        $page_data['page_name']         = 'parent';
        $page_data['page_title']        = get_phrase('Manage Parent');
        $page_data['select_parent']   = $this->db->get('parent')->result_array();
        $this->load->view('backend/index', $page_data);
    }


 





  


    function teacher ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->teacher_model->insetTeacherFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
        }

        if($param1 == 'update'){
            $this->teacher_model->updateTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
        }


        if($param1 == 'delete'){
            $this->teacher_model->deleteTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
    
        }

        $page_data['page_name']     = 'teacher';
        $page_data['page_title']    = get_phrase('Manage Teacher');
        $page_data['select_teacher']  = $this->db->get('teacher')->result_array();
        $this->load->view('backend/index', $page_data);

    }

    function get_designation($department_id = null){

        $designation = $this->db->get_where('designation', array('department_id' => $department_id))->result_array();
        foreach($designation as $key => $row)
        echo '<option value="'.$row['designation_id'].'">' . $row['name'] . '</option>';
    }

 


    function get_employees($department_id = null)
    {
        $employees = $this->db->get_where('teacher', array('department_id' => $department_id))->result_array();
        foreach($employees as $key => $employees)
            echo '<option value="' . $employees['teacher_id'] . '">' . $employees['name'] . '</option>';
    }

 


    /***********  The function manages Class Information  ***********************/
      function classes ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->class_model->createClassFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/classes', 'refresh');
        }

        if($param1 == 'update'){
            $this->class_model->updateClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/classes', 'refresh');
        }


        if($param1 == 'delete'){
            $this->class_model->deleteClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/classes', 'refresh');
    
        }

        $page_data['page_name']     = 'class';
        $page_data['page_title']    = get_phrase('Manage Class');
        $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages Section  ***********************/
    function section ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
        $this->section_model->createSectionFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/section', 'refresh');
        }

        if($param1 == 'update'){
        $this->section_model->updateSectionFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/section', 'refresh');
        }

        if($param1 == 'delete'){
        $this->section_model->deleteSectionFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/section', 'refresh');
        }

        $page_data['page_name']     = 'section';
        $page_data['page_title']    = get_phrase('Manage Section');
        $this->load->view('backend/index', $page_data);
    }

        function sections ($class_id = null){

            if($class_id == '')
            $class_id = $this->db->get('class')->first_row()->class_id;
            
            $page_data['page_name']     = 'section';
            $page_data['class_id']      = $class_id;
            $page_data['page_title']    = get_phrase('Manage Section');
            $this->load->view('backend/index', $page_data);

        }
    



    function get_class_section_subject($class_id){
        $page_data['class_id']  =   $class_id;
        $this->load->view('backend/admin/class_routine_section_subject_selector', $page_data);

    }

    function get_class_section_affective_areas($class_id){
        $page_data['class_id']  =   $class_id;
        $this->load->view('backend/admin/class_routine_section_affective_areas_selector', $page_data);

    }



    function section_subject_edit($class_id, $class_routine_id){

    $page_data['class_id']          =   $class_id;
    $page_data['class_routine_id']  =   $class_routine_id;
    $this->load->view('backend/admin/class_routine_section_subject_edit', $page_data);

    }

    function section_affective_areas_edit($class_id, $class_routine_id){

        $page_data['class_id']          =   $class_id;
        $page_data['class_routine_id']  =   $class_routine_id;
        $this->load->view('backend/admin/class_routine_section_affective_areas_edit', $page_data);
    
        }


    /***********  The function manages school dormitory  ***********************/
    function dormitory ($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'create'){
        $this->dormitory_model->createDormitoryFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/dormitory', 'refresh');
    }

    if($param1 == 'update'){
        $this->dormitory_model->updateDormitoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/dormitory', 'refresh');
    }


    if($param1 == 'delete'){
        $this->dormitory_model->deleteDormitoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/dormitory', 'refresh');

    }

    $page_data['page_name']     = 'dormitory';
    $page_data['page_title']    = get_phrase('Manage Dormitory');
    $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages hostel room  ***********************/
    function hostel_room ($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'create'){
        $this->dormitory_model->createHostelRoomFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/hostel_room', 'refresh');
    }

    if($param1 == 'update'){
        $this->dormitory_model->updateHostelRoomFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/hostel_room', 'refresh');
    }


    if($param1 == 'delete'){
        $this->dormitory_model->deleteHostelRoomFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/hostel_room', 'refresh');

    }

    $page_data['page_name']     = 'hostel_room';
    $page_data['page_title']    = get_phrase('Hostel Room');
    $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages hostel category  ***********************/
    function hostel_category ($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'create'){
        $this->dormitory_model->createHostelCategoryFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/hostel_category', 'refresh');
    }

    if($param1 == 'update'){
        $this->dormitory_model->updateHostelCategoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/hostel_category', 'refresh');
    }


    if($param1 == 'delete'){
        $this->dormitory_model->deleteHostelCategoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/hostel_category', 'refresh');

    }

    $page_data['page_name']     = 'hostel_category';
    $page_data['page_title']    = get_phrase('Hostel Category');
    $this->load->view('backend/index', $page_data);
    }



    /***********  The function manages academic syllabus ***********************/
    function academic_syllabus ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
        $this->academic_model->createAcademicSyllabus();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');
    }

    if($param1 == 'update'){
        $this->academic_model->updateAcademicSyllabus($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');
    }


    if($param1 == 'delete'){
        $this->academic_model->deleteAcademicSyllabus($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');

        }

        $page_data['page_name']     = 'academic_syllabus';
        $page_data['page_title']    = get_phrase('Academic Syllabus');
        $this->load->view('backend/index', $page_data);

    }

    function get_class_subject($class_id){
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
            foreach($subjects as $key => $subject)
            {
                echo '<option value="'.$subject['subject_id'].'">'.$subject['name'].'</option>';
              
            }
           
    }

    function get_class_affective_areas($class_id){
        $affective_areass = $this->db->get_where('affective_areas', array('class_id' => $class_id))->result_array();
            foreach($affective_areass as $key => $affective_areas)
            {
                echo '<option value="'.$affective_areas['affective_areas_id'].'">'.$affective_areas['name'].'</option>';
            }
           
    }

    function get_class_section($class_id){
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
            foreach($sections as $key => $section)
            {
                echo '<option value="'.$section['section_id'].'">'.$section['name'].'</option>';
            }
    }


    function download_academic_syllabus($academic_syllabus_code){
        $get_file_name = $this->db->get_where('academic_syllabus', array('academic_syllabus_code' => $academic_syllabus_code))->row()->file_name;
        // Loading download from helper.
        $this->load->helper('download');
        $get_download_content = file_get_contents('uploads/syllabus' . $get_file_name);
        $name = $file_name;
        force_download($name, $get_download_content);
    }

    function get_academic_syllabus ($class_id = null){

        if($class_id == '')
        $class_id = $this->db->get('class')->first_row()->class_id;
        
        $page_data['page_name']     = 'academic_syllabus';
        $page_data['class_id']      = $class_id;
        $page_data['page_title']    = get_phrase('Academic Syllabus');
        $this->load->view('backend/index', $page_data);

    }

    /***********  The function below add, update and delete student from students' table ***********************/
    function new_student ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->student_model->createNewStudent();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');
        }

        if($param1 == 'update'){
            $this->student_model->updateNewStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');
        }

        if($param1 == 'delete'){
            $this->student_model->deleteNewStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');

        }

        $page_data['page_name']     = 'new_student';
        $page_data['page_title']    = get_phrase('Manage Student');
        $this->load->view('backend/index', $page_data);

    }


    function student_information(){

        $page_data['page_name']     = 'student_information';
        $page_data['page_title']    = get_phrase('List Student');
        $this->load->view('backend/index', $page_data);
    }

    function daily_report(){

        $page_data['page_name']     = 'daily_report';
        $page_data['page_title']    = get_phrase('Daily Report');
        $this->load->view('backend/index', $page_data);
    }


    /**************************  search student function with ajax starts here   ***********************************/
    function getStudentClasswise($class_id){

        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/showStudentClasswise', $page_data);
    }

    /**************************  search student function with ajax ends here   ***********************************/

   
   
    function getIncomePayment($invoice_id){

        $page_data['invoice_id'] = $invoice_id;
        $this->load->view('backend/admin/showIncomePayment', $page_data);
    }

    function edit_student($student_id){

        $page_data['student_id']      = $student_id;
        $page_data['page_name']     = 'edit_student';
        $page_data['page_title']    = get_phrase('Edit Student');
        $this->load->view('backend/index', $page_data);
    }


    function resetStudentPassword ($student_id) {
        $password['password']               =   sha1($this->input->post('new_password'));
        $confirm_password['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
        if ($password['password'] == $confirm_password['confirm_new_password']) {
           $this->db->where('student_id', $student_id);
           $this->db->update('student', $password);
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }
        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url() . 'admin/student_information', 'refresh');
    }

    function manage_attendance($date = null, $month= null, $year = null, $class_id = null, $section_id = null ){
        $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
        
        if ($_POST) {
	
            // Loop all the students of $class_id
            $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach ($students as $key => $student) {
            $attendance_status = $this->input->post('status_' . $student['student_id']);
            $full_date = $year . "-" . $month . "-" . $date;
            $this->db->where('student_id', $student['student_id']);
            $this->db->where('date', $full_date);
    
            $this->db->update('attendance', array('status' => $attendance_status));
    
                   if ($attendance_status == 2) 
            {
                     if ($active_sms_gateway != '' || $active_sms_gateway != 'disabled') {
                        $student_name   = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->name;
                        $parent_id      = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->parent_id;
                        $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                        if($parent_id != null && $parent_id != 0){
                            $recieverPhoneNumber = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                            if($recieverPhoneNumber != '' || $recieverPhoneNumber != null){
                                $this->sms_model->send_sms($message, $recieverPhoneNumber);
                            }
                            else{
                                $this->session->set_flashdata('error_message' , get_phrase('Parent Phone Not Found'));
                            }
                        }
                        else{
                            $this->session->set_flashdata('error_message' , get_phrase('SMS Gateway Not Found'));
                        }
                    }
           }
        }
    
            $this->session->set_flashdata('flash_message', get_phrase('Updated Successfully'));
            redirect(base_url() . 'admin/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $section_id, 'refresh');
        }

        $page_data['date'] = $date;
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['page_name'] = 'manage_attendance';
        $page_data['page_title'] = get_phrase('Manage Attendance');
        $this->load->view('backend/index', $page_data);

    }

    function attendance_selector(){
        $date = $this->input->post('timestamp');
        $date = date_create($date);
        $date = date_format($date, "d/m/Y");
        redirect(base_url(). 'admin/manage_attendance/' .$date. '/' . $this->input->post('class_id'). '/' . $this->input->post('section_id'), 'refresh');
    }


    function attendance_report($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL) {
        
        $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
        
        
        if ($_POST) {
        redirect(base_url() . 'admin/attendance_report/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
        }
        
        $classes = $this->db->get('class')->result_array();
        foreach ($classes as $key => $class) {
            if (isset($class_id) && $class_id == $class['class_id'])
                $class_name = $class['name'];
            }
                    
        $sections = $this->db->get('section')->result_array();
            foreach ($sections as $key => $section) {
                if (isset($section_id) && $section_id == $section['section_id'])
                    $section_name = $section['name'];
        }
        
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['page_name'] = 'attendance_report';
        $page_data['page_title'] = "Attendance Report:" . $class_name . " : Section " . $section_name;
        $this->load->view('backend/index', $page_data);
    }


    /******************** Load attendance with ajax code starts from here **********************/
	function loadAttendanceReport($class_id, $section_id, $month, $year)
    {
        $page_data['class_id'] 		= $class_id;					// get all class_id
		$page_data['section_id'] 	= $section_id;					// get all section_id
		$page_data['month'] 		= $month;						// get all month
		$page_data['year'] 			= $year;						// get all class year
		
        $this->load->view('backend/admin/loadAttendanceReport' , $page_data);
    }
    /******************** Load attendance with ajax code ends from here **********************/
    

    /******************** print attendance report **********************/
	function printAttendanceReport($class_id=NULL, $section_id=NULL, $month=NULL, $year=NULL)
    {
        $page_data['class_id'] 		= $class_id;					// get all class_id
		$page_data['section_id'] 	= $section_id;					// get all section_id
		$page_data['month'] 		= $month;						// get all month
		$page_data['year'] 			= $year;						// get all class year
		
        $page_data['page_name'] = 'printAttendanceReport';
        $page_data['page_title'] = "Attendance Report";
        $this->load->view('backend/index', $page_data);
    }
    /******************** /Ends here **********************/
    


     /***********  The function below add, update and delete exam question table ***********************/
    function examQuestion ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->exam_question_model->createexamQuestion();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        if($param1 == 'update'){
            $this->exam_question_model->updateexamQuestion($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        if($param1 == 'delete'){
            $this->exam_question_model->deleteexamQuestion($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        $page_data['page_name']     = 'examQuestion';
        $page_data['page_title']    = get_phrase('Exam Question');
        $this->load->view('backend/index', $page_data);
    }
     /***********  The function below add, update and delete exam question table ends here ***********************/


    /***********  The function below add, update and delete examination table ***********************/
    function createExamination ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->exam_model->createExamination();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/createExamination', 'refresh');
        }

        if($param1 == 'update'){
            $this->exam_model->updateExamination($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/createExamination', 'refresh');
        }

        if($param1 == 'delete'){
            $this->exam_model->deleteExamination($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/createExamination', 'refresh');
        }

        $page_data['page_name']     = 'createExamination';
        $page_data['page_title']    = get_phrase('Create Exam');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function below add, update and delete examination table ends here ***********************/

    /***********  The function below add, update and delete student payment table ***********************/
    function student_payment ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'single_invoice'){
            $this->student_payment_model->createStudentSinglePaymentFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'mass_invoice'){
            $this->student_payment_model->createStudentMassPaymentFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'update_invoice'){
            $this->student_payment_model->updateStudentPaymentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'take_payment'){
            $this->student_payment_model->takeNewPaymentFromStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }


        if($param1 == 'delete_invoice'){
            $this->student_payment_model->deleteStudentPaymentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        $page_data['page_name']     = 'student_payment';
        $page_data['page_title']    = get_phrase('Student Payment');
        $this->load->view('backend/index', $page_data);
    }   
    /***********  / Student payment ends here ***********************/
    
    function get_class_student($class_id){
        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach($students as $key => $student)
            {
                echo '<option value="'.$student['student_id'].'">'.$student['name'].'</option>';
            }
    }


    function get_class_mass_student($class_id){

        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach($students as $key => $student)
        {
            echo '<div class="">
            <label><input type="checkbox" class="check" name="student_id[]" value="' . $student['student_id'] . '">' . '&nbsp;'. $student['name'] .'</label></div>';
        }

        echo '<br><button type ="button" class="btn btn-success btn-sm btn-rounded" onClick="select()">'.get_phrase('Select All').'</button>';
        echo '<button type ="button" class="btn btn-primary btn-sm btn-rounded" onClick="unselect()">'.get_phrase('Unselect All').'</button>';
    }

    function student_invoice(){

        $page_data['page_name']     = 'student_invoice';
       
        $page_data['page_title']    = get_phrase('Manage Invoice');
        $this->load->view('backend/index', $page_data);

    }

    function fully_paid_invoice(){

        $page_data['page_name']     = 'fully_paid_invoice';
        
        $page_data['page_title']    = get_phrase('fully_paid_invoice');
        $this->load->view('backend/index', $page_data);

    }

    function part_payment_invoice(){

        $page_data['page_name']     = 'part_payment_invoice';
        
        $page_data['page_title']    = get_phrase('part_payment_invoice');
        $this->load->view('backend/index', $page_data);

    }

    function students_yet_to_pay(){

        $page_data['page_name']     = 'students_yet_to_pay';
        
        $page_data['page_title']    = get_phrase('students_yet_to_pay');
        $this->load->view('backend/index', $page_data);

    }



    /***********  The function below manages school event ***********************/
    function noticeboard ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->event_model->createNoticeboardFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        if($param1 == 'update'){
            $this->event_model->updateNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        if($param1 == 'delete'){
            $this->event_model->deleteNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        $page_data['page_name']     = 'noticeboard';
        $page_data['page_title']    = get_phrase('School Event');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school events ends here ***********************/

     /***********  The function below manages school language ***********************/
     function manage_language ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'edit_phrase'){
            $page_data['edit_profile']  =   $param2;
        }

        if($param1 == 'add_language'){
            $this->language_model->createNewLanguage();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'add_phrase'){
            $this->language_model->createNewLanguagePhrase();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'delete_language'){
            $this->language_model->deleteLanguage($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        $page_data['page_name']     = 'manage_language';
        $page_data['page_title']    = get_phrase('Manage Language');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school language ends here ***********************/

    function updatePhraseWithAjax(){

        $checker['phrase_id']   =   $this->input->post('phraseId');
        $updater[$this->input->post('currentEditingLanguage')]  =   $this->input->post('updatedValue');

        $this->db->where('phrase_id', $checker['phrase_id'] );
        $this->db->update('language', $updater);

        echo $checker['phrase_id']. ' '. $this->input->post('currentEditingLanguage'). ' '. $this->input->post('updatedValue');

    }


    /***********  The function below manages school marks ***********************/
    function marks ($exam_id = null, $class_id = null, $student_id = null){

            if($this->input->post('operation') == 'selection'){

                $page_data['exam_id']       =  $this->input->post('exam_id'); 
                $page_data['class_id']      =  $this->input->post('class_id');
                $page_data['student_id']    =  $this->input->post('student_id');
                
                if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id']  > 0){

                    redirect(base_url(). 'admin/marks/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
                }
                else{
                    $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                    redirect(base_url(). 'admin/marks', 'refresh');
                }
            }

            if($this->input->post('operation') == 'update_student_subject_score'){

                $select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
                    foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){

                        $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score4']  =   $this->input->post('class_score4_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score5']  =   $this->input->post('class_score5_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score6']  =   $this->input->post('class_score6_' . $dispay_subject_from_subject_table['subject_id']);
                        
                        $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['total_score']  =   $page_data['class_score1'] +  $page_data['class_score2'] + 
                        $page_data['class_score3'] + 
                        $page_data['class_score4'] + 
                        $page_data['exam_score'];
                        
                        $page_data['low_in_class']  =   $this->input->post('low_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['high_in_class']  =   $this->input->post('high_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_average']  =   $this->input->post('class_average_' . $dispay_subject_from_subject_table['subject_id']);
                    
                    
                        $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['total_attendance']  =   $this->input->post('total_attendance_');
                        $page_data['attendance']  =   $this->input->post('attendance_' );
                    $page_data['no_of_abscent']  =   $this->input->post('no_of_abscent_' . $dispay_subject_from_subject_table['subject_id']);
                    
                    
                    $page_data['teacher']       =   $this->input->post('teacher_' );
                    $page_data['admin']       =   $this->input->post('admin_');
                     $page_data['next_term']       =   $this->input->post('next_term_');
$page_data['report1']  =   $this->input->post('report1');
$page_data['report2']  =   $this->input->post('report2');
$page_data['report3']  =   $this->input->post('report3');
$page_data['report4']  =   $this->input->post('report4');
$page_data['report5']  =   $this->input->post('report5');
$page_data['report6']  =   $this->input->post('report6');
$page_data['report7']  =   $this->input->post('report7');
$page_data['report8']  =   $this->input->post('report8');
$page_data['report9']  =   $this->input->post('report9');
$page_data['report10'] =   $this->input->post('report10');
$page_data['report11'] =   $this->input->post('report11');
$page_data['report12'] =   $this->input->post('report12');
$page_data['report13'] =   $this->input->post('report13');
$page_data['report14'] =   $this->input->post('report14');
$page_data['report15'] =   $this->input->post('report15');
$page_data['report16'] =   $this->input->post('report16');
$page_data['report17'] =   $this->input->post('report17');
$page_data['report18'] =   $this->input->post('report18');
$page_data['report19'] =   $this->input->post('report19');
$page_data['report20'] =   $this->input->post('report20');

$page_data['report21'] = $this->input->post('report21');
$page_data['report22'] = $this->input->post('report22');
$page_data['report23'] = $this->input->post('report23');
$page_data['report24'] = $this->input->post('report24');
$page_data['report25'] = $this->input->post('report25');
$page_data['report26'] = $this->input->post('report26');
$page_data['report27'] = $this->input->post('report27');
$page_data['report28'] = $this->input->post('report28');
$page_data['report29'] = $this->input->post('report29');
$page_data['report30'] = $this->input->post('report30');
$page_data['report31'] = $this->input->post('report31');
$page_data['report32'] = $this->input->post('report32');
$page_data['report33'] = $this->input->post('report33');
$page_data['report34'] = $this->input->post('report34');
$page_data['report35'] = $this->input->post('report35');
$page_data['report36'] = $this->input->post('report36');
$page_data['report37'] = $this->input->post('report37');
$page_data['report38'] = $this->input->post('report38');
$page_data['report39'] = $this->input->post('report39');
$page_data['report40'] = $this->input->post('report40');
$page_data['report41'] = $this->input->post('report41');
$page_data['report42'] = $this->input->post('report42');
$page_data['report43'] = $this->input->post('report43');
$page_data['report44'] = $this->input->post('report44');
$page_data['report45'] = $this->input->post('report45');
$page_data['report46'] = $this->input->post('report46');
$page_data['report47'] = $this->input->post('report47');
$page_data['report48'] = $this->input->post('report48');
$page_data['report49'] = $this->input->post('report49');
$page_data['report50'] = $this->input->post('report50');
$page_data['report51'] = $this->input->post('report51');
$page_data['report52'] = $this->input->post('report52');
$page_data['report53'] = $this->input->post('report53');
$page_data['report54'] = $this->input->post('report54');
$page_data['report55'] = $this->input->post('report55');
$page_data['report56'] = $this->input->post('report56');
$page_data['report57'] = $this->input->post('report57');
$page_data['report58'] = $this->input->post('report58');
$page_data['report59'] = $this->input->post('report59');
$page_data['report60'] = $this->input->post('report60');
$page_data['report61'] = $this->input->post('report61');
$page_data['report62'] = $this->input->post('report62');
$page_data['report63'] = $this->input->post('report63');
$page_data['report64'] = $this->input->post('report64');
$page_data['report65'] = $this->input->post('report65');
$page_data['report66'] = $this->input->post('report66');
$page_data['report67'] = $this->input->post('report67');
$page_data['report68'] = $this->input->post('report68');
$page_data['report69'] = $this->input->post('report69');
$page_data['report70'] = $this->input->post('report70');
$page_data['report71'] = $this->input->post('report71');

                       
                       
                        $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                        $this->db->update('mark', $page_data);  
                    }

                    $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                    redirect(base_url(). 'admin/marks/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
            }

        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
        $page_data['student_id']    =   $student_id;
        $page_data['subject_id']   =    $subject_id;
        $page_data['page_name']     =   'marks';
        $page_data['page_title']    = get_phrase('Student Marks');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/
/************    
    public function cummulative_score()
{
    $this->load->model('marks_model');
    $this->load->model('crud_model');

    $page_data['classes']  = $this->db->get('class')->result_array();
    $page_data['students'] = $this->db->get('student')->result_array();

    if ($_POST) {
        $student_id = $this->input->post('student_id');
        $class_id   = $this->input->post('class_id');

        $page_data['student_name'] = $this->db->get_where('student', ['student_id' => $student_id])->row()->name ?? '';
        $page_data['class_name']   = $this->db->get_where('class', ['class_id' => $class_id])->row()->name ?? '';

        $page_data['scores'] = $this->Mark_model->get_cumulative_scores($student_id, $class_id);
    }

    $this->load->view('backend/index', [
        'page_name' => 'cummulative',
        'page_title' => 'Cumulative Result',
        'classes' => $page_data['classes'],
        'students' => $page_data['students'],
        'scores' => $page_data['scores'] ?? [],
        'student_name' => $page_data['student_name'] ?? '',
        'class_name' => $page_data['class_name'] ?? '',
    ]);
}
*****************/
function cummulative($class_id = null, $student_id = null)
{
    if ($this->input->post('operation') == 'selection') {
        $class_id = $this->input->post('class_id');
        $student_id = $this->input->post('student_id');

        if ($class_id > 0 && $student_id > 0) {
            redirect(base_url() . 'admin/cummulative/' . $class_id . '/' . $student_id, 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'Please select class and student.');
            redirect(base_url() . 'admin/cummulative', 'refresh');
        }
    }

    $cumulative_scores = [];

    if ($class_id && $student_id) {
        $subjects = $this->db->get_where('subject', ['class_id' => $class_id])->result_array();

        foreach ($subjects as $subject) {
            $subject_id = $subject['subject_id'];

           // Fetch exam_ids for the three terms
$first_term_exam_id = $this->db->get_where('exam', [
    'name' => '2025/2026 FIRST TERM EXAMINATION'
])->row('exam_id');

$second_term_exam_id = $this->db->get_where('exam', [
    'name' => '2025/2026 SECOND TERM EXAMINATION'
])->row('exam_id');

$third_term_exam_id = $this->db->get_where('exam', [
    'name' => '2025/2026 THIRD TERM EXAMINATION'
])->row('exam_id');

// Fetch total_score for each term using exam_id
$first_term_score = $this->db->get_where('mark', [
    'class_id' => $class_id,
    'student_id' => $student_id,
    'subject_id' => $subject_id,
    'exam_id' => $first_term_exam_id
])->row('total_score');

$second_term_score = $this->db->get_where('mark', [
    'class_id' => $class_id,
    'student_id' => $student_id,
    'subject_id' => $subject_id,
    'exam_id' => $second_term_exam_id
])->row('total_score');

$third_term_score = $this->db->get_where('mark', [
    'class_id' => $class_id,
    'student_id' => $student_id,
    'subject_id' => $subject_id,
    'exam_id' => $third_term_exam_id
])->row('total_score');

            // Compute cumulative average
            $term_scores = [$first_term_score, $second_term_score, $third_term_score];
            $valid_scores = array_filter($term_scores, 'is_numeric');
            $average = count($valid_scores) > 0 ? array_sum($valid_scores) / count($valid_scores) : null;

            $cumulative_scores[] = [
                'subject_name' => $subject['name'],
                'first_term' => $first_term_score,
                'second_term' => $second_term_score,
                'third_term' => $third_term_score,
                'average' => $average
            ];
        }
    }

    $page_data['class_id'] = $class_id;
    $page_data['student_id'] = $student_id;
    $page_data['cumulative_scores'] = $cumulative_scores;
    $page_data['page_name'] = 'cummulative';
    $page_data['page_title'] = get_phrase('Cumulative Report');
    $this->load->view('backend/index', $page_data);
}


/******
 function cummulative ($exam_id = null, $class_id = null, $student_id = null){

            if($this->input->post('operation') == 'selection'){

                $page_data['exam_id']       =  $this->input->post('exam_id'); 
                $page_data['class_id']      =  $this->input->post('class_id');
                $page_data['student_id']    =  $this->input->post('student_id');
                
                if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id']  > 0){

                    redirect(base_url(). 'admin/cummulative/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
                }
                else{
                    $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                    redirect(base_url(). 'admin/cummulative', 'refresh');
                }
            }

            if($this->input->post('operation') == 'update_student_subject_score'){

                $select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
                    foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){

                        $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score4']  =   $this->input->post('class_score4_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score5']  =   $this->input->post('class_score5_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score6']  =   $this->input->post('class_score6_' . $dispay_subject_from_subject_table['subject_id']);
                        
                        $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['total_score']  =   $page_data['class_score1'] +  $page_data['class_score2'] +   $page_data['exam_score'];
                        
                        $page_data['low_in_class']  =   $this->input->post('low_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['high_in_class']  =   $this->input->post('high_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_average']  =   $this->input->post('class_average_' . $dispay_subject_from_subject_table['subject_id']);
                    
                    
                        $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['total_attendance']  =   $this->input->post('total_attendance_');
                        $page_data['attendance']  =   $this->input->post('attendance_' );
                    $page_data['no_of_abscent']  =   $this->input->post('no_of_abscent_' . $dispay_subject_from_subject_table['subject_id']);
                    
                    
                    $page_data['teacher']       =   $this->input->post('teacher_' );
                    $page_data['admin']       =   $this->input->post('admin_');
                     $page_data['next_term']       =   $this->input->post('next_term_');
$page_data['report1']  =   $this->input->post('report1');
$page_data['report2']  =   $this->input->post('report2');
$page_data['report3']  =   $this->input->post('report3');
$page_data['report4']  =   $this->input->post('report4');
$page_data['report5']  =   $this->input->post('report5');
$page_data['report6']  =   $this->input->post('report6');
$page_data['report7']  =   $this->input->post('report7');
$page_data['report8']  =   $this->input->post('report8');
$page_data['report9']  =   $this->input->post('report9');
$page_data['report10'] =   $this->input->post('report10');
$page_data['report11'] =   $this->input->post('report11');
$page_data['report12'] =   $this->input->post('report12');
$page_data['report13'] =   $this->input->post('report13');
$page_data['report14'] =   $this->input->post('report14');
$page_data['report15'] =   $this->input->post('report15');
$page_data['report16'] =   $this->input->post('report16');
$page_data['report17'] =   $this->input->post('report17');
$page_data['report18'] =   $this->input->post('report18');
$page_data['report19'] =   $this->input->post('report19');
$page_data['report20'] =   $this->input->post('report20');

$page_data['report21'] = $this->input->post('report21');
$page_data['report22'] = $this->input->post('report22');
$page_data['report23'] = $this->input->post('report23');
$page_data['report24'] = $this->input->post('report24');
$page_data['report25'] = $this->input->post('report25');
$page_data['report26'] = $this->input->post('report26');
$page_data['report27'] = $this->input->post('report27');
$page_data['report28'] = $this->input->post('report28');
$page_data['report29'] = $this->input->post('report29');
$page_data['report30'] = $this->input->post('report30');
$page_data['report31'] = $this->input->post('report31');
$page_data['report32'] = $this->input->post('report32');
$page_data['report33'] = $this->input->post('report33');
$page_data['report34'] = $this->input->post('report34');
$page_data['report35'] = $this->input->post('report35');
$page_data['report36'] = $this->input->post('report36');
$page_data['report37'] = $this->input->post('report37');
$page_data['report38'] = $this->input->post('report38');
$page_data['report39'] = $this->input->post('report39');
$page_data['report40'] = $this->input->post('report40');
$page_data['report41'] = $this->input->post('report41');
$page_data['report42'] = $this->input->post('report42');
$page_data['report43'] = $this->input->post('report43');
$page_data['report44'] = $this->input->post('report44');
$page_data['report45'] = $this->input->post('report45');
$page_data['report46'] = $this->input->post('report46');
$page_data['report47'] = $this->input->post('report47');
$page_data['report48'] = $this->input->post('report48');
$page_data['report49'] = $this->input->post('report49');
$page_data['report50'] = $this->input->post('report50');
$page_data['report51'] = $this->input->post('report51');
$page_data['report52'] = $this->input->post('report52');
$page_data['report53'] = $this->input->post('report53');
$page_data['report54'] = $this->input->post('report54');
$page_data['report55'] = $this->input->post('report55');
$page_data['report56'] = $this->input->post('report56');
$page_data['report57'] = $this->input->post('report57');
$page_data['report58'] = $this->input->post('report58');
$page_data['report59'] = $this->input->post('report59');
$page_data['report60'] = $this->input->post('report60');
$page_data['report61'] = $this->input->post('report61');
$page_data['report62'] = $this->input->post('report62');
$page_data['report63'] = $this->input->post('report63');
$page_data['report64'] = $this->input->post('report64');
$page_data['report65'] = $this->input->post('report65');
$page_data['report66'] = $this->input->post('report66');
$page_data['report67'] = $this->input->post('report67');
$page_data['report68'] = $this->input->post('report68');
$page_data['report69'] = $this->input->post('report69');
$page_data['report70'] = $this->input->post('report70');
$page_data['report71'] = $this->input->post('report71');

                       
                       
                        $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                        $this->db->update('mark', $page_data);  
                    }

                    $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                    redirect(base_url(). 'admin/cummulative/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
            }

        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
        $page_data['student_id']    =   $student_id;
        $page_data['subject_id']   =    $subject_id;
        $page_data['page_name']     =   'cummulative';
        $page_data['page_title']    = get_phrase('Student Marks');
        $this->load->view('backend/index', $page_data);
    }
    
    ********/
/***********  The function below manages school marks for kindergaten to Nursery only***********************/
     function marks_forKtoN ($exam_id = null, $class_id = null, $student_id = null){

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['student_id']    =  $this->input->post('student_id');
            
            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id']  > 0){

                redirect(base_url(). 'admin/marks_forKtoN/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                redirect(base_url(). 'admin/marks_forKtoN', 'refresh');
            }
        }

        if($this->input->post('operation') == 'update_student_subject_score'){

            $select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
                foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){

                    $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_score4']  =   $this->input->post('class_score4_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_score5']  =   $this->input->post('class_score5_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_score6']  =   $this->input->post('class_score6_' . $dispay_subject_from_subject_table['subject_id']);
                    
                    $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['total_score']  =   $page_data['class_score1'] +  $page_data['class_score2'] +  $page_data['class_score3'] 
                        + $page_data['class_score4'] +  $page_data['class_score5'] +  $page_data['class_score6'] +  $page_data['exam_score'];
                        
                    $page_data['low_in_class']  =   $this->input->post('low_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['high_in_class']  =   $this->input->post('high_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                   $page_data['class_average'] = $this->input->post
                   ('class_average_' . $dispay_subject_from_subject_table['subject_id']);
                    
                    $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
                   
                   
                    $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                    $this->db->update('mark', $page_data);  
                }

                $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                redirect(base_url(). 'admin/marks_forKtoN/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
        }

    $page_data['exam_id']       =   $exam_id;
    $page_data['class_id']      =   $class_id;
    $page_data['student_id']    =   $student_id;
    $page_data['subject_id']   =    $subject_id;
    $page_data['page_name']     =   'marks_forKtoN';
    $page_data['page_title']    = get_phrase('Student Marks');
    $this->load->view('backend/index', $page_data);
}
/***********  The function that manages school marks ends here ***********************/

 /***********  The function below manages school report card marks ***********************/
 
  function mark_report_card ($exam_id = null, $class_id = null, $student_id = null){

    if($this->input->post('operation') == 'selection'){

                $page_data['exam_id']       =  $this->input->post('exam_id'); 
                $page_data['class_id']      =  $this->input->post('class_id');
                $page_data['student_id']    =  $this->input->post('student_id');
                
                if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id']  > 0){

                    redirect(base_url(). 'admin/mark_report_card/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
                }
                else{
                    $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                    redirect(base_url(). 'admin/mark_report_card', 'refresh');
                }
            }

            if($this->input->post('operation') == 'update_student_subject_score'){

                $select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
                    foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){

                        $page_data['lowest_in_class']  =   $this->input->post('lowest_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['highest_in_class']  =   $this->input->post('highest_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_averages']  =   $this->input->post('class_averages_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['total_scores']  =   $this->input->post('total_scores_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['cum_average_score']  =   $this->input->post('cum_average_score_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['3rd_term_average']  =   $this->input->post('3rd_term_average_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['attendance']  =   $this->input->post('attendance_' . $dispay_subject_from_subject_table['subject_id']);
                        
                    
                        
                       
                        $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                        $this->db->update('mark', $page_data);  
                    }

                    $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                    redirect(base_url(). 'admin/mark_report_card/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
            }

        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
        $page_data['student_id']    =   $student_id;
        $page_data['subject_id']   =    $subject_id;
        $page_data['page_name']     =   'mark_report_card';
        $page_data['page_title']    = get_phrase('Student Marks');
        $this->load->view('backend/index', $page_data);
    }



 function view_student_report_card ($exam_id = null, $class_id = null, $student_id = null){

    if($this->input->post('operation') == 'selection'){

        $page_data['exam_id']       =  $this->input->post('exam_id'); 
        $page_data['class_id']      =  $this->input->post('class_id');
        $page_data['student_id']    =  $this->input->post('student_id');
        
        if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id']  > 0){

            redirect(base_url(). 'admin/view_student_report_card/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
        }
        else{
            $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
            redirect(base_url(). 'admin/view_student_report_card', 'refresh');
        }
    }

    if($this->input->post('operation') == 'update_student_affective_areas_score'){

        $select_affective_areas_first = $this->db->get_where('affective_areas', array('class_id' => $class_id ))->result_array();
            foreach ($select_affective_areas_first as $key => $dispay_affective_areas_from_affective_areas_table){
                $page_data['creativity']                 =   $this->input->post('creativity_' . $dispay_affective_areas_from_affective_areas_table['affective_areas_id']);
                $page_data['honesty']                    =   $this->input->post('honesty_' . $dispay_affective_areas_from_affective_areas_table['affective_areas_id']);
                $page_data['neatness']                   =   $this->input->post('neatness_' . $dispay_affective_areas_from_affective_areas_table['affective_areas_id']);
                $page_data['punctuality']                =   $this->input->post('punctuality_' . $dispay_affective_areas_from_affective_areas_table['affective_areas_id']);
                $page_data['relationship_with_peers']    =   $this->input->post('relationship_with_peers_' . $dispay_affective_areas_from_affective_areas_table['affective_areas_id']);
                $page_data['relationship_with_teachers']  =   $this->input->post('relationship_with_teachers_' . $dispay_affective_areas_from_affective_areas_table['affective_areas_id']);
                
                $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_affective_areas_from_affective_areas_table['affective_areas_id']));
                $this->db->update('mark', $page_data);  
            }

            $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
            redirect(base_url(). 'admin/view_student_report_card/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
    }

$page_data['exam_id']       =   $exam_id;
$page_data['class_id']      =   $class_id;
$page_data['student_id']    =   $student_id;
$page_data['affective_areas_id']   =    $affective_areas_id;
$page_data['page_name']     =   'view_student_report_card';
$page_data['page_title']    = get_phrase('view_student_report_card');
$this->load->view('backend/index', $page_data);
}

    /***********  The function below manages school marks ***********************/
     function student_marksheet_subject ($exam_id = null, $class_id = null, $subject_id = null){

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['subject_id']    =  $this->input->post('subject_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0){

                redirect(base_url(). 'admin/student_marksheet_subject/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                redirect(base_url(). 'admin/student_marksheet_subject', 'refresh');
            }
        }

        if($this->input->post('operation') == 'update_student_subject_score'){

            $select_student_first = $this->db->get_where('student', array('class_id' => $class_id ))->result_array();
                foreach ($select_student_first as $key => $dispay_student_from_student_table){

                    $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_student_from_student_table['student_id']);
                    $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_student_from_student_table['student_id']);
                    $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_student_from_student_table['student_id']);
                    $page_data['class_score4']  =   $this->input->post('class_score4_' . $dispay_student_from_student_table['student_id']);
                    $page_data['class_score5']  =   $this->input->post('class_score5_' . $dispay_student_from_student_table['student_id']);
                    $page_data['class_score6']  =   $this->input->post('class_score6_' . $dispay_student_from_student_table['student_id']);
                    
                    $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
                    $page_data['total_score']  =   $page_data['class_score1'] +  $page_data['class_score2'] +  $page_data['class_score3'] 
                        + $page_data['class_score4'] +  $page_data['class_score5'] +  $page_data['class_score6'] +  $page_data['exam_score'];
                        
                    
                    $page_data['low_in_class']  =   $this->input->post('low_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['high_in_class']  =   $this->input->post('high_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_average']  =   $this->input->post('class_average_' . $dispay_subject_from_subject_table['subject_id']);
                    
                    $page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);

                    $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
                    $this->db->update('mark', $page_data);  
                }

                $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                redirect(base_url(). 'admin/student_marksheet_subject/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }

    $page_data['exam_id']       =   $exam_id;
    $page_data['class_id']      =   $class_id;
    $page_data['student_id']    =   $student_id;
    $page_data['subject_id']   =    $subject_id;
    $page_data['page_name']     =   'student_marksheet_subject';
    $page_data['page_title']    = get_phrase('Student Marks');
    $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/



    
    /***********  The function below manages new admin ***********************/
    function newAdministrator ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->admin_model->createNewAdministrator();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        if($param1 == 'update'){
            $this->admin_model->updateAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        if($param1 == 'delete'){
            $this->admin_model->deleteAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        $page_data['page_name']     = 'newAdministrator';
        $page_data['page_title']    = get_phrase('New Administrator');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages administrator ends here ***********************/

    function updateAdminRole($param2){
        $this->admin_model->updateAllDetailsForAdminRole($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/newAdministrator', 'refresh');
    }
	
	
	 function set_language($lang) {
        $this->session->set_userdata('language', $lang);
       	redirect(base_url() . '', 'refresh');
        recache();
    }
	
	// Promote student to next class
function promote_student($student_id = '')
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    // Fetch current student info
    $student = $this->db->get_where('student', array('student_id' => $student_id))->row();

    if ($_POST) {
        $new_class_id = $this->input->post('new_class_id');
        $new_exam_id  = $this->input->post('new_exam_id');

        // Update student record
        $this->db->where('student_id', $student_id);
        $this->db->update('student', array(
            'class_id' => $new_class_id,
            'exam_id'  => $new_exam_id
        ));

        $this->session->set_flashdata('flash_message', get_phrase('student_promoted_successfully'));
       redirect(base_url() . 'admin/student_information', 'refresh');

        

    }

    // Load modal form if not submitted
    $page_data['student_id'] = $student_id;
    $page_data['student']    = $student;
    $page_data['page_name']  = 'promote_student';
    $this->load->view('backend/admin/promote_student', $page_data);
}

	

}
