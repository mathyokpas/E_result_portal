<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_content_model extends CI_Model {

    protected $content_table = 'website_content';
    protected $gallery_table = 'website_gallery';

    public function __construct(){
        parent::__construct();
    }

    // CONTENT (sections)
    public function get_all_sections(){
        return $this->db->order_by('slug','ASC')->get($this->content_table)->result_array();
    }

    public function get_section_by_id($id){
        return $this->db->get_where($this->content_table, ['id'=>$id])->row_array();
    }

    public function get_section_by_slug($slug){
        return $this->db->get_where($this->content_table, ['slug'=>$slug])->row_array();
    }

    public function create_section($data){
        return $this->db->insert($this->content_table, $data);
    }

    public function update_section($id, $data){
        return $this->db->where('id',$id)->update($this->content_table, $data);
    }

    public function delete_section($id){
        $row = $this->get_section_by_id($id);
        if($row && !empty($row['image'])){
            @unlink(FCPATH . 'uploads/website/' . $row['image']);
        }
        return $this->db->delete($this->content_table, ['id'=>$id]);
    }

    // GALLERY
    public function gallery_list(){
        return $this->db->order_by('display_order','ASC')->get($this->gallery_table)->result_array();
    }

    public function gallery_get($id){
        return $this->db->get_where($this->gallery_table, ['id'=>$id])->row_array();
    }

    public function gallery_add($data){
        return $this->db->insert($this->gallery_table, $data);
    }

    public function gallery_update($id, $data){
        return $this->db->where('id',$id)->update($this->gallery_table, $data);
    }

    public function gallery_delete($id){
        $row = $this->gallery_get($id);
        if($row && !empty($row['image'])){
            @unlink(FCPATH . 'uploads/website/' . $row['image']);
        }
        return $this->db->delete($this->gallery_table, ['id'=>$id]);
    }
}
