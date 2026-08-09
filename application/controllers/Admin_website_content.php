<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_website_content extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Website_content_model');
        $this->load->helper(['url','file']);
        $this->load->library('session');

        // ===== TEMPORARY DEBUG BLOCK — remove after diagnosing =====
        if ($this->session->userdata('role') !== 'superadmin') {
            echo '<pre>';
            echo "role value: ";
            var_dump($this->session->userdata('role'));
            echo "\nadmin_login: ";
            var_dump($this->session->userdata('admin_login'));
            echo "\nadmin_id: ";
            var_dump($this->session->userdata('admin_id'));
            echo "\nlogin_type: ";
            var_dump($this->session->userdata('login_type'));
            echo "\nname: ";
            var_dump($this->session->userdata('name'));
            echo "\n\nALL SESSION DATA:\n";
            print_r($this->session->all_userdata());
            echo '</pre>';
            exit;
        }
        // ===== END TEMPORARY DEBUG BLOCK =====

        if ($this->session->userdata('role') !== 'superadmin') {
            redirect(base_url() . 'admin/dashboard', 'refresh');
        }
    }

    public function index(){
        $data['sections'] = $this->Website_content_model->get_all_sections();
        $data['page_name'] = 'website_content_list';
        $data['page_title'] = 'Website Content';
        $this->load->view('backend/index', $data);
    }

    public function add_section(){
        if($this->input->method() === 'post'){
            $slug = $this->input->post('slug', TRUE);
            $title = $this->input->post('title', TRUE);
            $content = $this->input->post('content', FALSE);

            if($this->Website_content_model->get_section_by_slug($slug)){
                $this->session->set_flashdata('flash_message_error','Slug already exists');
                redirect(base_url('index.php?admin_website_content'),'refresh');
            }

            $this->Website_content_model->create_section([
                'slug' => $slug,
                'title' => $title,
                'content' => $content
            ]);
            $this->session->set_flashdata('flash_message','Section created');
            redirect(base_url('index.php?admin_website_content'),'refresh');
        }

        $data['page_name'] = 'website_content_add';
        $data['page_title'] = 'Add Section';
        $this->load->view('backend/index', $data);
    }

    public function edit_section($id = null){
        if(!$id) redirect(base_url('index.php?admin_website_content'),'refresh');

        if($this->input->method() === 'post'){
            $title = $this->input->post('title', TRUE);
            $content = $this->input->post('content', FALSE);
            $update = ['title'=>$title,'content'=>$content];

            if(!empty($_FILES['image']['name'])){
                $upload = $this->_do_upload('image');
                if(!$upload['ok']){
                    $this->session->set_flashdata('flash_message_error', $upload['error']);
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $old = $this->Website_content_model->get_section_by_id($id);
                if($old && !empty($old['image'])) @unlink(FCPATH . 'uploads/website/' . $old['image']);
                $update['image'] = $upload['file_name'];
            }

            $this->Website_content_model->update_section($id, $update);
            $this->session->set_flashdata('flash_message','Section updated');
            redirect(base_url('index.php?admin_website_content/edit_section/'.$id),'refresh');
        }

        $data['section'] = $this->Website_content_model->get_section_by_id($id);
        if(!$data['section']) redirect(base_url('index.php?admin_website_content'),'refresh');

        $data['page_name'] = 'website_content_edit';
        $data['page_title'] = 'Edit Section';
        $this->load->view('backend/index', $data);
    }

    public function delete_section($id){
        $this->Website_content_model->delete_section($id);
        $this->session->set_flashdata('flash_message','Section deleted');
        redirect(base_url('index.php?admin_website_content'),'refresh');
    }

    public function gallery(){
        $data['gallery'] = $this->Website_content_model->gallery_list();
        $data['page_name'] = 'website_gallery_list';
        $data['page_title'] = 'Gallery';
        $this->load->view('backend/index', $data);
    }

    public function gallery_add(){
        if($this->input->method() === 'post'){
            $title = $this->input->post('title', TRUE);
            $caption = $this->input->post('caption', FALSE);
            $order = (int)$this->input->post('display_order', 0);

            if(empty($_FILES['image']['name'])){
                $this->session->set_flashdata('flash_message_error','Please upload an image');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $upload = $this->_do_upload('image');
            if(!$upload['ok']){
                $this->session->set_flashdata('flash_message_error', $upload['error']);
                redirect($_SERVER['HTTP_REFERER']);
            }

            $this->Website_content_model->gallery_add([
                'title' => $title,
                'caption' => $caption,
                'image' => $upload['file_name'],
                'display_order' => $order
            ]);
            $this->session->set_flashdata('flash_message','Gallery image added');
            redirect(base_url('index.php?admin_website_content/gallery'),'refresh');
        }

        $data['page_name'] = 'website_gallery_add';
        $data['page_title'] = 'Add Gallery Image';
        $this->load->view('backend/index', $data);
    }

    public function gallery_edit($id = null){
        if(!$id) redirect(base_url('index.php?admin_website_content/gallery'),'refresh');
        if($this->input->method() === 'post'){
            $title = $this->input->post('title', TRUE);
            $caption = $this->input->post('caption', FALSE);
            $order = (int)$this->input->post('display_order',0);
            $update = ['title'=>$title,'caption'=>$caption,'display_order'=>$order];

            if(!empty($_FILES['image']['name'])){
                $upload = $this->_do_upload('image');
                if(!$upload['ok']){
                    $this->session->set_flashdata('flash_message_error', $upload['error']);
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $old = $this->Website_content_model->gallery_get($id);
                if($old) @unlink(FCPATH . 'uploads/website/'.$old['image']);
                $update['image'] = $upload['file_name'];
            }

            $this->Website_content_model->gallery_update($id, $update);
            $this->session->set_flashdata('flash_message','Gallery image updated');
            redirect(base_url('index.php?admin_website_content/gallery_edit/'.$id),'refresh');
        }

        $data['item'] = $this->Website_content_model->gallery_get($id);
        $data['page_name'] = 'website_gallery_edit';
        $data['page_title'] = 'Edit Gallery Image';
        $this->load->view('backend/index', $data);
    }

    public function gallery_delete($id){
        $this->Website_content_model->gallery_delete($id);
        $this->session->set_flashdata('flash_message','Gallery image deleted');
        redirect(base_url('index.php?admin_website_content/gallery'),'refresh');
    }

    private function _do_upload($field_name){
        $upload_path = FCPATH . 'uploads/website/';
        if(!is_dir($upload_path)) mkdir($upload_path, 0755, true);

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|webp|gif';
        $config['max_size'] = 4096;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload($field_name)){
            return ['ok'=>false, 'error'=>$this->upload->display_errors('','')];
        }
        $data = $this->upload->data();
        return ['ok'=>true, 'file_name'=>$data['file_name']];
    }
}
