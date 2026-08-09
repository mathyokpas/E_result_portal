<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class   Class_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }



    // The function below insert into class table //
    function createClassFunction(){

        $page_data = array(
            'name' => html_escape($this->input->post('name')),
            'name_numeric' => html_escape($this->input->post('name_numeric')),
            'teacher_id' => $this->input->post('teacher_id')
			);

        $this->db->insert('class', $page_data);
    }

// The function below update class table //
    function updateClassFunction($param2){
        $page_data = array(
            'name' => html_escape($this->input->post('name')),
            'name_numeric' => html_escape($this->input->post('name_numeric')),
            'teacher_id' => $this->input->post('teacher_id')
			);

        $this->db->where('class_id', $param2);
        $this->db->update('class', $page_data);
    }

    // The function below delete from class table //
    function deleteClassFunction($param2){
        $this->db->where('class_id', $param2);
        $this->db->delete('class');
    }
	
    public function get_all_classes()
{
    return $this->db->get('class')->result_array();
}
        

	
	
}

