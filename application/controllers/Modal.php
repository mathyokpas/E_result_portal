public function popup($page_name = '', $param2 = '', $param3 = '')
{
    $account_type = $this->session->userdata('login_type');
    $page_data['param2'] = $param2;
    $page_data['param3'] = $param3;

    // Special case: promote_student modal is in backend/modal/
    if ($page_name == 'promote_student') {
        $page_data['student_id'] = $param2;
        $this->load->view('backend/modal/' . $page_name, $page_data);
    } else {
        // Default: load based on account type (admin, teacher, etc.)
        $this->load->view('backend/' . $account_type . '/' . $page_name . '.php', $page_data);
    }
}
