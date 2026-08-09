<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Student extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
  
    }

     /*student dashboard code to redirect to student page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('student_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('student Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / student dashboard code to redirect to student page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('student_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   html_escape($this->input->post('name'));
            $data['email']  =   html_escape($this->input->post('email'));
    
            $this->db->where('student_id', $this->session->userdata('student_id'));
            $this->db->update('student', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'student/manage_profile', 'refresh');
           
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('student_id', $this->session->userdata('student_id'));
               $this->db->update('student', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'student/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }


        function subject (){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $select_student_class_id = $student_profile->class_id;

            $page_data['page_name']     = 'subject';
            $page_data['page_title']    = get_phrase('Class Subjects');
            $page_data['select_subject']  = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }
        
        /***********  The function below manages school marks ***********************/
     function student_mark ($exam_id = null, $class_id = null, $student_id = null){

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['student_id']    =  $this->input->post('student_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){

                redirect(base_url(). 'student/student_mark/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Please select something'));
                redirect(base_url(). 'student/student_mark', 'refresh');
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
                    $page_data['total_score']  =   $this->input->post('total_score_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);

                    $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                    $this->db->update('mark', $page_data);  
                }

                $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                redirect(base_url(). 'student/student_mark/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
        }

        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
        $page_data['student_id']    =   $student_id;
        $page_data['subject_id']   =    $subject_id;
        $page_data['page_name']     =   'student_mark';
        $page_data['page_title']    = get_phrase('Student Result');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/
    
     /***********  The function below manages school marks ***********************/
    
        function student_mark1 ($exam_id = null, $class_id = null, $student_id = null){

            if($this->input->post('operation') == 'selection'){
    
                $page_data['exam_id']       =  $this->input->post('exam_id'); 
                $page_data['class_id']      =  $this->input->post('class_id');
                $page_data['student_id']    =  $this->input->post('student_id');
    
                if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){
    
                    redirect(base_url(). 'student/student_mark1/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
                }
                else{
                    $this->session->set_flashdata('error_message', get_phrase('Please select something'));
                    redirect(base_url(). 'student/student_mark1', 'refresh');
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
                        $page_data['total_score']  =   $this->input->post('total_score_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['low_in_class']  =   $this->input->post('low_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['high_in_class']    =   $this->input->post('high_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_average']  =   $this->input->post('class_average_' . $dispay_subject_from_subject_table['subject_id']);
                        
                        $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['teacher']       =   $this->input->post('teacher_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['admin']       =   $this->input->post('admin_' . $dispay_subject_from_subject_table['subject_id']);
    
                        $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                        $this->db->update('mark', $page_data);  
                    }
    
                    $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                    redirect(base_url(). 'student/student_mark1/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
            }
    
            $page_data['exam_id']       =   $exam_id;
            $page_data['class_id']      =   $class_id;
            $page_data['student_id']    =   $student_id;
            $page_data['subject_id']   =    $subject_id;
            $page_data['page_name']     =   'student_mark1';
            $page_data['page_title']    = get_phrase('Student Result');
            $this->load->view('backend/index', $page_data);
        }
        /***********  The function that manages school marks1 ends here ***********************/
         /***********  The function below manages school marks ***********************/
    
        function student_mark2 ($exam_id = null, $class_id = null, $student_id = null){

            if($this->input->post('operation') == 'selection'){
    
                $page_data['exam_id']       =  $this->input->post('exam_id'); 
                $page_data['class_id']      =  $this->input->post('class_id');
                $page_data['student_id']    =  $this->input->post('student_id');
    
                if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){
    
                    redirect(base_url(). 'student/student_mark2/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
                }
                else{
                    $this->session->set_flashdata('error_message', get_phrase('Please select something'));
                    redirect(base_url(). 'student/student_mark2', 'refresh');
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
                        $page_data['total_score']  =   $this->input->post('total_score_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['low_in_class']  =   $this->input->post('low_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['high_in_class']    =   $this->input->post('high_in_class_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_average']  =   $this->input->post('class_average_' . $dispay_subject_from_subject_table['subject_id']);
                        
                        $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['teacher']       =   $this->input->post('teacher_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['admin']       =   $this->input->post('admin_' . $dispay_subject_from_subject_table['subject_id']);
    
                        $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                        $this->db->update('mark', $page_data);  
                    }
    
                    $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                    redirect(base_url(). 'student/student_mark2/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
            }
    
            $page_data['exam_id']       =   $exam_id;
            $page_data['class_id']      =   $class_id;
            $page_data['student_id']    =   $student_id;
            $page_data['subject_id']   =    $subject_id;
            $page_data['page_name']     =   'student_mark2';
            $page_data['page_title']    = get_phrase('Student Result');
            $this->load->view('backend/index', $page_data);
        }
        /***********  The function that manages school marks1 ends here ***********************/
        
        function cummulative($class_id = null, $student_id = null)
{
    if ($this->input->post('operation') == 'selection') {
        $class_id = $this->input->post('class_id');
        $student_id = $this->input->post('student_id');

        if ($class_id > 0 && $student_id > 0) {
            redirect(base_url() . 'student/cummulative/' . $class_id . '/' . $student_id, 'refresh');
        } else {
            $this->session->set_flashdata('error_message', 'Please select class and student.');
            redirect(base_url() . 'student/cummulative', 'refresh');
        }
    }

    $cumulative_scores = [];  

    if ($class_id && $student_id) {
        $subjects = $this->db->get_where('subject', ['class_id' => $class_id])->result_array();

        foreach ($subjects as $subject) {
            $subject_id = $subject['subject_id'];

           // Fetch exam_ids for the three terms
$first_term_exam_id = $this->db->get_where('exam', [
    'name' => '2024/2025 FIRST TERM EXAMINATION'
])->row('exam_id');

$second_term_exam_id = $this->db->get_where('exam', [
    'name' => '2024/2025 SECOND TERM EXAMINATION'
])->row('exam_id');

$third_term_exam_id = $this->db->get_where('exam', [
    'name' => '2024/2025 THIRD TERM EXAMINATION'
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

        function teacher (){


            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $select_student_class_id = $student_profile->class_id;

            $return_teacher_id = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->row()->teacher_id;


            $page_data['page_name']     = 'teacher';
            $page_data['page_title']    = get_phrase('Class Teachers');
            $page_data['select_teacher']  = $this->db->get_where('teacher', array('teacher_id' => $return_teacher_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function class_mate (){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $page_data['select_student_class_id']  = $student_profile->class_id;
            $page_data['page_name']     = 'class_mate';
            $page_data['page_title']    = get_phrase('Class Mate');
            $this->load->view('backend/index', $page_data);
        }

        function class_routine(){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $page_data['class_id']  = $student_profile->class_id;

            $page_data['page_name']     = 'class_routine';
            $page_data['page_title']    = get_phrase('Class Timetable');
            $this->load->view('backend/index', $page_data);


        }

        function invoice($param1 = null, $param2 = null, $param3 = null){

            if($param1 == 'make_payment'){

                $invoice_id = $this->input->post('invoice_id');
                $payment_email = $this->db->get_where('settings', array('type' => 'paypal_email'))->row();
                $select_invoice = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();

                // SENDING USER TO PAYPAL TERMINAL.
                $this->paypal->add_field('rm', 2);
                $this->paypal->add_field('no_note', 0);
                $this->paypal->add_field('item_name', $select_invoice->title);
                $this->paypal->add_field('amount', $select_invoice->due);
                $this->paypal->add_field('custom', $select_invoice->invoice_id);
                $this->paypal->add_field('business', $payment_email->description);
                $this->paypal->add_field('notify_url', base_url('invoice/paypal_ipn'));
                $this->paypal->add_field('cancel_return', base_url('invoice/paypal_cancel'));
                $this->paypal->add_field('return', site_url('invoice/paypal_success'));

                $this->paypal->submit_paypal_post();
                //submitting info to the paypal teminal
            }


            if($param1 == 'paypal_ipn'){
                if($this->paypal->validate_ipn() == true){
                        $ipn_response = '';
                        foreach ($_POST as $key => $value){
                            $value = urlencode(stripslashes($value));
                            $ipn_response .= "\n$key=$value";
                        }

                    $page_data['payment_details']   = $ipn_response;
                    $page_data['payment_timestamp'] = strtotime(date("m/d/Y"));
                    $page_data['payment_method']    = '1';
                    $page_data['status']            = 'paid';
                    $invoice_id                = $_POST['custom'];
                    $this->db->where('invoice_id', $invoice_id);
                    $this->db->update('invoice', $page_data);

                    $data2['method']       =   '1';
                    $data2['invoice_id']   =   $_POST['custom'];
                    $data2['timestamp']    =   strtotime(date("m/d/Y"));
                    $data2['payment_type'] =   'income';
                    $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
                    $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
                    $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->student_id;
                    $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
                    $this->db->insert('payment' , $data2);

                }
            }

            if($param1 == 'paypal_cancel'){
                $this->session->set_flashdata('error_message', get_phrase('Payment Cancelled'));
                redirect(base_url() . 'student/invoice', 'refresh');
                }
    
            if($param1 == 'paypal_success'){
                $this->session->set_flashdata('flash_message', get_phrase('Payment Successful'));
                redirect(base_url() . 'student/invoice', 'refresh');
            }
           

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $student_profile = $student_profile->student_id;

            $page_data['invoices']     = $this->db->get_where('invoice', array('student_id' => $student_profile))->result_array();
            $page_data['page_name']     = 'invoice';
            $page_data['page_title']    = get_phrase('All Invoices');
            $this->load->view('backend/index', $page_data);
        }

        function payment_history(){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $student_profile = $student_profile->student_id;

            $page_data['invoices']     = $this->db->get_where('invoice', array('student_id' => $student_profile))->result_array();
            $page_data['page_name']     = 'payment_history';
            $page_data['page_title']    = get_phrase('Student History');
            $this->load->view('backend/index', $page_data);


        }

        public function promote_student($student_id = '')
{
    if ($this->input->post()) {
        $new_class_id = $this->input->post('new_class_id');
        $new_exam_id  = $this->input->post('new_exam_id');

        $this->student_model->promote_student($student_id, $new_class_id, $new_exam_id);

        $this->session->set_flashdata('flash_message', get_phrase('student_promoted_successfully'));
        redirect(base_url() . 'admin/student_information', 'refresh');
    } else {
        $page_data['student_id'] = $student_id;
        $page_data['classes']    = $this->class_model->get_all_classes(); // your model method 
        $page_data['exams']      = $this->exam_model->get_all_exams();    // we’ll define below
        $this->load->view('backend/admin/modal_promote_student', $page_data);
    }
}



}