<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_content extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Website_content_model');

        if (!$this->session->userdata('login_type')) {
            redirect(base_url(), 'refresh');
        }
    }

    private function require_superadmin(){
        $role = $this->session->userdata('role') ?? $this->session->userdata('login_type');
        if($role !== 'superadmin'){
            show_error('You are not authorized to access this section', 403);
            return false;
        }
        return true;
    }

    public function index(){
        if(!$this->require_superadmin()) return;

        $data['rows'] = $this->Website_content_model->all_rows();
        $data['page_title'] = "Website Content";
        $data['page_name']  = "website_content_list";
        $this->load->view('backend/index', $data);
    }

    public function edit($id){
        if(!$this->require_superadmin()) return;

        $row = $this->Website_content_model->get_by_id($id);
        if(!$row){
            redirect(base_url().'index.php?admin/website_content','refresh');
        }

        $data['row'] = $row;
        $data['history'] = $this->Website_content_model->history_for($id);
        $data['page_title'] = "Edit: {$row['cms_key']}";
        $data['page_name']  = "website_content_edit";
        $this->load->view('backend/index', $data);
    }

    public function update(){
        if(!$this->require_superadmin()) return;

        $id = $this->input->post('id');
        $value = $this->input->post('cms_value', FALSE);
        $user  = $this->session->userdata('username') ?? 'superadmin';

        $this->Website_content_model->update_by_id($id, $value, $user);

        $this->session->set_flashdata('flash_message','Updated');
        redirect(base_url()."index.php?admin/website_content/edit/$id",'refresh');
    }

    public function autosave(){
        if(!$this->require_superadmin()) return;

        $id = $this->input->post('id');
        $value = $this->input->post('value', FALSE);
        $user  = $this->session->userdata('username');

        $ok = $this->Website_content_model->update_by_id($id, $value, $user);

        echo json_encode(['status'=>$ok?'ok':'error']);
    }

    public function revert($history_id){
        if(!$this->require_superadmin()) return;

        $user = $this->session->userdata('username');
        $this->Website_content_model->revert_history($history_id, $user);

        $this->session->set_flashdata('flash_message','Reverted');
        redirect(base_url().'index.php?admin/website_content','refresh');
    }

    public function upload_image(){
        if(!$this->require_superadmin()) return;

        $allowed_keys = ['home_hero_img_1','home_hero_img_2','home_hero_img_3','gallery_img_1'];

        $key = $this->input->post('key');
        if(!in_array($key, $allowed_keys)){
            $this->session->set_flashdata('flash_message_error','Invalid image key');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $site_root = realpath(FCPATH.'../mentorsinternationalacademy.com');
        $upload_dir = $site_root.'/img/uploads/';

        if(!is_dir($upload_dir)){
            mkdir($upload_dir, 0755, true);
        }

        $config['upload_path'] = $upload_dir;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['encrypt_name']  = TRUE;
        $config['max_size']      = 2048;

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('image_file')){
            $this->session->set_flashdata('flash_message_error', $this->upload->display_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }

        $file = $this->upload->data();
        $relative = 'img/uploads/'.$file['file_name'];

        $this->Website_content_model->upsert($key, $relative, $this->session->userdata('username'));

        $this->session->set_flashdata('flash_message','Image uploaded');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
