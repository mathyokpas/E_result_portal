<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Affective_areas extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
        		$this->load->library('session');		
    }




    /***********  The function manages subject  ***********************/
    function affective_areas ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
        $this->affective_areas_model->createSubjectFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'affective_areas/affective_areas', 'refresh');
        }

        if($param1 == 'update'){
        $this->affective_areas_model->updateSubjectFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'affective_areas/affective_areas', 'refresh');
        }

        if($param1 == 'delete'){
        $this->affective_areas_model->deleteSubjectFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'affective_areas/affective_areas', 'refresh');
        }

        $page_data['page_name']     = 'affective_areas';
        $page_data['page_title']    = get_phrase('Manage Subject');
        $this->load->view('backend/index', $page_data);
    }


/**************************  search subject function with ajax starts here   ***********************************/
    function getAffective_areasByClasswise($class_id){

        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/displayAffective_areasClasswise', $page_data);
    }
/**************************  search subject function with ajax ends here   ***********************************/



}
