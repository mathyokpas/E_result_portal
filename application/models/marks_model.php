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
            'class_score5'      => html_escape($this->input->post('class_score5')),
            'class_score6'      => html_escape($this->input->post('class_score6')),
            'exam_score'      => html_escape($this->input->post('exam_score')),
           'total_score'      =>  'class_score3' + 'class_score4' +   'class_score5' + 'class_score6' + 'class_score1' + 'class_score2',
            'low_in_class'      => html_escape($this->input->post('low_in_class')),
            'high_in_class'      => html_escape($this->input->post('high_in_class')),
            'class_average'      => html_escape($this->input->post('class_average')),
            'lowest_in_class'      => html_escape($this->input->post('lowest_in_class')),
            'highest_in_class'      => html_escape($this->input->post('highest_in_class')),
            'class_averages'      => html_escape($this->input->post('class_averages')),
            'total_scores'      => html_escape($this->input->post('total_scores')),
            'cum_average_score'      => html_escape($this->input->post('cum_average_score')),
            '3rd_term_average'      => html_escape($this->input->post('3rd_term_average')),
            'attendance'      => html_escape($this->input->post('attendance')),
             'no_of_abscent'      => html_escape($this->input->post('no_of_abscent')),
            'total_attendance'      => html_escape($this->input->post('total_attendance')),
            'next_term'      => html_escape($this->input->post('next_term')),
           
            'teacher'      => html_escape($this->input->post('teacher')),
            'admin'      => html_escape($this->input->post('admin')),
           'report1'  => html_escape($this->input->post('report1')),
    'report2'  => html_escape($this->input->post('report2')),
    'report3'  => html_escape($this->input->post('report3')),
    'report4'  => html_escape($this->input->post('report4')),
    'report5'  => html_escape($this->input->post('report5')),
    'report6'  => html_escape($this->input->post('report6')),
    'report7'  => html_escape($this->input->post('report7')),
    'report8'  => html_escape($this->input->post('report8')),
    'report9'  => html_escape($this->input->post('report9')),
    'report10' => html_escape($this->input->post('report10')),
    'report11' => html_escape($this->input->post('report11')),
    'report12' => html_escape($this->input->post('report12')),
    'report13' => html_escape($this->input->post('report13')),
    'report14' => html_escape($this->input->post('report14')),
    'report15' => html_escape($this->input->post('report15')),
    'report16' => html_escape($this->input->post('report16')),
    'report17' => html_escape($this->input->post('report17')),
    'report18' => html_escape($this->input->post('report18')),
    'report19' => html_escape($this->input->post('report19')),
    'report20' => html_escape($this->input->post('report20')),
'report21' => html_escape($this->input->post('report21')),
'report22' => html_escape($this->input->post('report22')),
'report23' => html_escape($this->input->post('report23')),
'report24' => html_escape($this->input->post('report24')),
'report25' => html_escape($this->input->post('report25')),
'report26' => html_escape($this->input->post('report26')),
'report27' => html_escape($this->input->post('report27')),
'report28' => html_escape($this->input->post('report28')),
'report29' => html_escape($this->input->post('report29')),
'report30' => html_escape($this->input->post('report30')),
'report31' => html_escape($this->input->post('report31')),
'report32' => html_escape($this->input->post('report32')),
'report33' => html_escape($this->input->post('report33')),
'report34' => html_escape($this->input->post('report34')),
'report35' => html_escape($this->input->post('report35')),
'report36' => html_escape($this->input->post('report36')),
'report37' => html_escape($this->input->post('report37')),
'report38' => html_escape($this->input->post('report38')),
'report39' => html_escape($this->input->post('report39')),
'report40' => html_escape($this->input->post('report40')),
'report41' => html_escape($this->input->post('report41')),
'report42' => html_escape($this->input->post('report42')),
'report43' => html_escape($this->input->post('report43')),
'report44' => html_escape($this->input->post('report44')),
'report45' => html_escape($this->input->post('report45')),
'report46' => html_escape($this->input->post('report46')),
'report47' => html_escape($this->input->post('report47')),
'report48' => html_escape($this->input->post('report48')),
'report49' => html_escape($this->input->post('report49')),
'report50' => html_escape($this->input->post('report50')),
'report51' => html_escape($this->input->post('report51')),
'report52' => html_escape($this->input->post('report52')),
'report53' => html_escape($this->input->post('report53')),
'report54' => html_escape($this->input->post('report54')),
'report55' => html_escape($this->input->post('report56')),
'report56' => html_escape($this->input->post('report56')),
'report57' => html_escape($this->input->post('report57')),
'report58' => html_escape($this->input->post('report58')),
'report59' => html_escape($this->input->post('report59')),
'report60' => html_escape($this->input->post('report60')),
'report61' => html_escape($this->input->post('report61')),
'report62' => html_escape($this->input->post('report62')),
'report63' => html_escape($this->input->post('report63')),
'report64' => html_escape($this->input->post('report64')),
'report65' => html_escape($this->input->post('report65')),
'report66' => html_escape($this->input->post('report66')),
'report67' => html_escape($this->input->post('report67')),
'report68' => html_escape($this->input->post('report68')),
'report69' => html_escape($this->input->post('report69')),
'report70' => html_escape($this->input->post('report70')),
'report71' => html_escape($this->input->post('report71')),


           
            
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
            'class_score5'      => html_escape($this->input->post('class_score5')),
            'class_score6'      => html_escape($this->input->post('class_score6')),
            'exam_score'      => html_escape($this->input->post('exam_score')),
            'total_score'      => 'class_score3' + 'class_score4' +   'class_score5' + 'class_score6' + 'class_score1' + 'class_score2',
            'low_in_class'      => html_escape($this->input->post('low_in_class')),
            'high_in_class'      => html_escape($this->input->post('high_in_class')),
            'class_average'      => html_escape($this->input->post('class_average')),
            'lowest_in_class'      => html_escape($this->input->post('lowest_in_class')),
            'highest_in_class'      => html_escape($this->input->post('highest_in_class')),
            'class_averages'      => html_escape($this->input->post('class_averages')),
            'total_scores'      => html_escape($this->input->post('total_scores')),
            'cum_average_score'      => html_escape($this->input->post('cum_average_score')),
            '3rd_term_average'      => html_escape($this->input->post('3rd_term_average')),
            'attendance'      => html_escape($this->input->post('attendance')),
             'no_of_abscent'      => html_escape($this->input->post('no_of_abscent_')),
            'total_attendance'      => html_escape($this->input->post('total_attendance_')),
             'next_term'      => html_escape($this->input->post('next_term')),
           
            'teacher'      => html_escape($this->input->post('teacher')),
            'admin'      => html_escape($this->input->post('admin')),
            
            'report1'  => html_escape($this->input->post('report1')),
    'report2'  => html_escape($this->input->post('report2')),
    'report3'  => html_escape($this->input->post('report3')),
    'report4'  => html_escape($this->input->post('report4')),
    'report5'  => html_escape($this->input->post('report5')),
    'report6'  => html_escape($this->input->post('report6')),
    'report7'  => html_escape($this->input->post('report7')),
    'report8'  => html_escape($this->input->post('report8')),
    'report9'  => html_escape($this->input->post('report9')),
    'report10' => html_escape($this->input->post('report10')),
    'report11' => html_escape($this->input->post('report11')),
    'report12' => html_escape($this->input->post('report12')),
    'report13' => html_escape($this->input->post('report13')),
    'report14' => html_escape($this->input->post('report14')),
    'report15' => html_escape($this->input->post('report15')),
    'report16' => html_escape($this->input->post('report16')),
    'report17' => html_escape($this->input->post('report17')),
    'report18' => html_escape($this->input->post('report18')),
    'report19' => html_escape($this->input->post('report19')),
    'report20' => html_escape($this->input->post('report20')),
'report21' => html_escape($this->input->post('report21')),
'report22' => html_escape($this->input->post('report22')),
'report23' => html_escape($this->input->post('report23')),
'report24' => html_escape($this->input->post('report24')),
'report25' => html_escape($this->input->post('report25')),
'report26' => html_escape($this->input->post('report26')),
'report27' => html_escape($this->input->post('report27')),
'report28' => html_escape($this->input->post('report28')),
'report29' => html_escape($this->input->post('report29')),
'report30' => html_escape($this->input->post('report30')),
'report31' => html_escape($this->input->post('report31')),
'report32' => html_escape($this->input->post('report32')),
'report33' => html_escape($this->input->post('report33')),
'report34' => html_escape($this->input->post('report34')),
'report35' => html_escape($this->input->post('report35')),
'report36' => html_escape($this->input->post('report36')),
'report37' => html_escape($this->input->post('report37')),
'report38' => html_escape($this->input->post('report38')),
'report39' => html_escape($this->input->post('report39')),
'report40' => html_escape($this->input->post('report40')),
'report41' => html_escape($this->input->post('report41')),
'report42' => html_escape($this->input->post('report42')),
'report43' => html_escape($this->input->post('report43')),
'report44' => html_escape($this->input->post('report44')),
'report45' => html_escape($this->input->post('report45')),
'report46' => html_escape($this->input->post('report46')),
'report47' => html_escape($this->input->post('report47')),
'report48' => html_escape($this->input->post('report48')),
'report49' => html_escape($this->input->post('report49')),
'report50' => html_escape($this->input->post('report50')),
'report51' => html_escape($this->input->post('report51')),
'report52' => html_escape($this->input->post('report52')),
'report53' => html_escape($this->input->post('report53')),
'report54' => html_escape($this->input->post('report54')),
'report55' => html_escape($this->input->post('report56')),
'report56' => html_escape($this->input->post('report56')),
'report57' => html_escape($this->input->post('report57')),
'report58' => html_escape($this->input->post('report58')),
'report59' => html_escape($this->input->post('report59')),
'report60' => html_escape($this->input->post('report60')),
'report61' => html_escape($this->input->post('report61')),
'report62' => html_escape($this->input->post('report62')),
'report63' => html_escape($this->input->post('report63')),
'report64' => html_escape($this->input->post('report64')),
'report65' => html_escape($this->input->post('report65')),
'report66' => html_escape($this->input->post('report66')),
'report67' => html_escape($this->input->post('report67')),
'report68' => html_escape($this->input->post('report68')),
'report69' => html_escape($this->input->post('report69')),
'report70' => html_escape($this->input->post('report70')),
'report71' => html_escape($this->input->post('report71')),


           
           
            
            'exam_id'    => html_escape($this->input->post('exam_id')),
            'student_id'    => html_escape($this->input->post('student_id'))
	    );
       
        $this->db->where('subject_id', $param2);
        $this->db->update('mark', $page_data);
    }

public function get_cumulative_scores($student_id, $class_id)
{
    // Get exam IDs by term name
    $terms = [
        'first_term'  => '2025/2026 FIRST TERM EXAMINATION',
        'second_term' => '2025/2026 SECOND TERM EXAMINATION',
        'third_term'  => '2025/2026 THIRD TERM EXAMINATION'
    ];

    $exam_ids = [];
    foreach ($terms as $key => $name) {
        $exam = $this->db->get_where('exam', ['name' => $name])->row();
        $exam_ids[$key] = $exam->exam_id ?? null;
    }

    // Get unique subjects for this student/class
    $this->db->select('subject_id');
    $this->db->from('mark');
    $this->db->where('student_id', $student_id);
    $this->db->where('class_id', $class_id);
    $this->db->group_by('subject_id');
    $subjects = $this->db->get()->result_array();

    $results = [];

    foreach ($subjects as $subject) {
        $subject_id = $subject['subject_id'];

        $scores = [];
        foreach ($exam_ids as $term => $exam_id) {
            $this->db->select('total_score');
            $this->db->from('mark');
            $this->db->where([
                'student_id' => $student_id,
                'class_id' => $class_id,
                'subject_id' => $subject_id,
                'exam_id' => $exam_id
            ]);
            $query = $this->db->get()->row();

            $scores[$term] = $query->total_score ?? 0;
        }

        $average = round(array_sum($scores) / 3, 2);

        $subject_name = $this->db->get_where('subject', ['subject_id' => $subject_id])->row()->name ?? 'N/A';

        $results[] = [
            'subject_name' => $subject_name,
            'first_term'   => $scores['first_term'],
            'second_term'  => $scores['second_term'],
            'third_term'   => $scores['third_term'],
            'average'      => $average
        ];
    }

    return $results;
}



    // The function below delete from subject table //
    function deleteSubjectFunction($param2){
        
        $this->db->where('subject_id', $param2);
        $this->db->delete('mark');
    }
	
	
}

