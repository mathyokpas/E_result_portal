<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Affective_areas_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    // The function below insert into subject table //
    function createSubjectFunction(){

        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            'class_id'      => html_escape($this->input->post('class_id')),
            'teacher_id'    => html_escape($this->input->post('teacher_id'))
         
	    );

        $this->db->insert('subject', $page_data);
    }

// The function below update subject table //
    function updateSubjectFunction($param2){
        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            'class_id'      => html_escape($this->input->post('class_id')),
            'teacher_id'    => html_escape($this->input->post('teacher_id'))
            
	    );

        $this->db->where('affective_areas_id', $param2);
        $this->db->update('affective_areas', $page_data);
    }

    // The function below delete from subject table //
    function deleteSubjectFunction($param2){
        $this->db->where('affective__id', $param2);
        $this->db->delete('affective_areas');
    }
	
	
}

