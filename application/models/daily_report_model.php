<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Subject_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    // The function below insert into subject table //
    function createMarkFunction(){

        $page_data = array(
            
            'class_id'      => html_escape($this->input->post('class_id')),
            'teacher_id'    => html_escape($this->input->post('teacher_id')),
            'class_score1'    => html_escape($this->input->post('class_score1')),
            'class_score2'          => html_escape($this->input->post('class_score2')),
            'class_score3'      => html_escape($this->input->post('class_score3')),
            'class_score4'      => html_escape($this->input->post('class_score4')),
            'exam_score'      => html_escape($this->input->post('exam_score')),
            'total_score'      => html_escape($this->input->post('total_score')),
            'exam_id'    => html_escape($this->input->post('exam_id')),
            'student_id'    => html_escape($this->input->post('student_id'))
	    );

        $this->db->insert('mark', $page_data);
    }

// The function below update subject table //
    function updateMarkFunction($param2){
        $page_data = array(
            
            'class_id'      => html_escape($this->input->post('class_id')),
            'teacher_id'    => html_escape($this->input->post('teacher_id')),
            'class_score1'    => html_escape($this->input->post('class_score1')),
            'class_score2'          => html_escape($this->input->post('class_score2')),
            'class_score3'      => html_escape($this->input->post('class_score3')),
            'class_score4'      => html_escape($this->input->post('class_score4')),
            'exam_score'      => html_escape($this->input->post('exam_score')),
            'total_score'      => html_escape($this->input->post('total_score')),
            'exam_id'    => html_escape($this->input->post('exam_id')),
            'student_id'    => html_escape($this->input->post('student_id'))
	    );

        $this->db->where('subject_id', $param2);
        $this->db->update('mark', $page_data);
    }

    // The function below delete from subject table //
    function deleteSubjectFunction($param2){
        $this->db->where('subject_id', $param2);
        $this->db->delete('mark');
    }
	
	
}

