

<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Enter Student Score SHEET');?></div>
                <div class="panel-body table-responsive">
			
                    <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/marks' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Exam');?></label>
                                <div class="col-sm-12">
                                    <select name="exam_id" class="form-control select2">
                                        <option value=""><?php echo get_phrase('select_class');?></option>

                                        <?php $exams =  $this->db->get('exam')->result_array();
                                        foreach($exams as $key => $exam):?>
                                        <option value="<?php echo $exam['exam_id'];?>"<?php if($exam_id == $exam['exam_id']) echo 'selected="selected"' ;?>><?php echo $exam['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>

                            


                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-12">
                                    <select name="class_id"  class="form-control select2" onchange="show_students(this.value)">
                                        <option value=""><?php echo get_phrase('select_class');?></option>

                                        <?php $classes =  $this->db->get('class')->result_array();
                                        foreach($classes as $key => $class):?>
                                        <option value="<?php echo $class['class_id'];?>"<?php if($class_id == $class['class_id']) echo 'selected="selected"' ;?>>Class: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>

								
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Student');?></label>
                                <div class="col-sm-12">

                                <?php $classes = $this->crud_model->get_classes();
                                        foreach ($classes as $key => $row): ?>

                                    <select name="<?php if($class_id == $row['class_id']) echo 'student_id'; else echo 'temp';?>" id="student_id_<?php echo $row['class_id'];?>" style="display:<?php if($class_id == $row['class_id']) echo 'block'; else echo 'none';?>"  class="form-control">
                                        <option value="">Student of: <?php echo $row['name'] ;?></option>

                                        <?php $students = $this->crud_model->get_students($row['class_id']);
                                        foreach ($students as $key => $student): ?>
                                        <option value="<?php echo $student['student_id'];?>"<?php if(isset($student_id) && $student_id == $student['student_id']) echo 'selected="selected"';?>><?php echo $student['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                <?php endforeach;?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="" id="student_id_0" style="display:<?php if(isset($student_id) && $student_id > 0) echo 'none'; else echo 'block';?>"  class="form-control">
                                        <option value=""><?php echo get_phrase('Select Class First');?></option>
                                    </select>
                                </div>
                            </div>
                            
                            <input class="" type="hidden" value="selection" name="operation">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('Get Details');?></button>
                        </div>
		
                    </form>                
            </div>                
		</div>
	</div>
</div>

 <?php 
    // Initialize total score variable
    $total_score = 0;
    $count_me = 0;
    $sum_total_score = 0;
    
?>        

<?php if($class_id > 0 && $student_id > 0 && $exam_id > 0):?>	

    <?php $select_sunject_with_class_id  =   $this->crud_model->get_subjects_by_class($class_id);
            foreach ($select_sunject_with_class_id as $key => $class_subject_exam_student): 

                $verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'student_id' => $student_id, 'subject_id' => $class_subject_exam_student['subject_id']);
                $query = $this->db->get_where('mark', $verify_data);

                if($query->num_rows() < 1)
                    $this->db->insert('mark', $verify_data);
            endforeach;?>


					
    <div class="row">

    
	<div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('enter_student_score'); ?></div>
                <div class="panel-body table-responsive">
							   
    					<table cellpadding="0" cellspacing="0" border="0" class="table">
								<thead>
									<tr>
										<td><?php echo get_phrase('subject');?></td>
										<td><?php echo get_phrase('1st CA (10 marks)');?></td>
										<td><?php echo get_phrase('2nd CA (10 marks)');?></td>
										<td><?php echo get_phrase('3rd CA (10 marks)');?></td>
										<td><?php echo get_phrase('Notes/Assign (10 marks)');?></td>
																				<td><?php echo get_phrase('exam score(60 marks)');?></td>
                                        <td><?php echo get_phrase('total score');?></td>
                                        <td><?php echo get_phrase('grade');?></td>
                                        
                                        <td><?php echo get_phrase('class average');?></td>
                                        

										<td><?php echo get_phrase('comment');?></td>
									</tr>
								</thead>
                    				<tbody>

        <?php $select_subject_with_class_id  =   $this->crud_model->get_subjects_by_class($class_id);
            foreach ($select_subject_with_class_id as $key => $class_subject_exam_student): 

                $verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'student_id' => $student_id, 'subject_id' => $class_subject_exam_student['subject_id']);
                $query = $this->db->get_where('mark', $verify_data);
                $update_subject_marks = $query->result_array();

                foreach ($update_subject_marks as $key => $general_select):

               
           ?>
                    	
										
			<?php echo form_open(base_url() . 'admin/marks/'. $exam_id . '/' . $class_id);?>
						<tr>
											<td>
												<?php echo $class_subject_exam_student['name'];?>
											</td>
											<td>
												<input type="number" class="class_score form-control" value="<?php echo $general_select['class_score1'];?>" name="class_score1_<?php echo $class_subject_exam_student['subject_id'];?>" onchange="class_score_change()" onkeyup="AddInputs()">
											</td>
											  <td>
												<input type="number" class="class_score form-control" value="<?php echo $general_select['class_score2'];?>" name="class_score2_<?php echo $class_subject_exam_student['subject_id'];?>" onchange="class_score_change()" onkeyup="AddInputs()">
											</td>
											 <td>
												<input type="number" class="class_score form-control" value="<?php echo $general_select['class_score3'];?>" name="class_score3_<?php echo $class_subject_exam_student['subject_id'];?>" onchange="class_score_change()" onkeyup="AddInputs()">
											</td>
											 <td>
												<input type="number" class="class_score form-control" value="<?php echo $general_select['class_score4'];?>" name="class_score4_<?php echo $class_subject_exam_student['subject_id'];?>" onchange="class_score_change()" onkeyup="AddInputs()">
											</td>
											  
                                            
											  <td>
												<input type="number" class="exam_score form-control" value="<?php echo $general_select['exam_score'];?>" name="exam_score_<?php echo $class_subject_exam_student['subject_id'];?>" onchange="exam_score_change()" onkeyup="AddInputs()">
											</td>
                                            <td>
								            <?php echo $total_score = $general_select['exam_score']  + $general_select['class_score1'] +
								            $general_select['class_score3'] +
								            $general_select['class_score4'] +
								            $general_select['class_score2'] ;
								            if ($total_score >0){

$count_me++;
$sum_total_score += $total_score;
 
}
?>
							                </td>
                                            <td><?php
$total_score = $general_select['exam_score'] + $general_select['class_score1'] + $general_select['class_score3'] + $general_select['class_score4'] + $general_select['class_score2'];

if ($total_score >= 70) {
    $grade = "A";
    $comment = "EXCELLENT";
} elseif ($total_score >= 60) {
    $grade = "B";
    $comment = "VERY GOOD";
} elseif ($total_score >= 50) {
    $grade = "C";
    $comment = "GOOD";
} elseif ($total_score >= 40) {
    $grade = "D";
    $comment = "POOR";
} elseif ($total_score >= 1) {
    $grade = "E";
    $comment = "FAIL";
} elseif ($total_score >= 0) {
    $grade = "F";
    $comment = "FAIL";
} else {
    $grade = "F";
    $comment = "INVALID SCORE";
}

echo "$grade";
?>

</td>
                                         
                                            <td>
												<input type="text" step="0.01"class="class_score form-control" value="<?php echo $general_select['class_average'];?>" name="class_average_<?php echo $class_subject_exam_student['subject_id'];?>" >
											</td>
			
											<td>
												<?php echo $comment;?>
										</td>
										 <input type="hidden" name="mark_id_<?php echo $class_subject_exam_student['subject_id'] ;?>" value="<?php echo $general_select['mark_id'];?>" />
                                            
                                            <input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
                                            <input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                                            <input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
                                            
                                            <input type="hidden" name="operation" value="update_student_subject_score" />		

						</tr>

        <?php 
            endforeach;
                endforeach;
        ?>
                    <tr><td colspan="2">Number of times school opened:</td><td colspan="2">
                     <input type="number" class="class_score008800 form-control" value="<?php echo $general_select['total_attendance'];?>" name="total_attendance_" onchange="class_score_change()" onkeyup="AddInputs()">
                     </td>
                     <td colspan="2">Number of times attended:</td>
                     <td colspan="2"><input type="number" class="class_score6001 form-control" value="<?php echo $general_select['attendance'];?>" name="attendance_" onchange="class_score_change()" onkeyup="AddInputs()">
                                        </td>
                    <td colspan="2">Number of times abscent:</td>
                     <td colspan="2"><?php echo $general_select['total_attendance'] - $general_select['attendance'];?>
                                        </td>
                    </tr>
                    <tr><td colspan="3">Total Scores</td><td colspan="3">
                    <?php echo $sum_total_score;?>
                     </td>
                     <td colspan="3">Average Scores</td>
                     <td colspan="3"><?php if ($count_me > 0) {
                $average_score = $sum_total_score / $count_me;
                echo number_format($average_score, 2); // Format the average to 2 decimal places
            }
            log_message('debug', 'Marks function reached');
log_message('debug', 'Page Data: ' . print_r($page_data, true));?></td>
                     </tr>
                    
                    
                    <tr ><td colspan="3">teacher's comment:</td> <td colspan="9" border="2">
                                            <textarea name="teacher_" class="class_score form-control"><?php echo $general_select['teacher'];?></textarea>
                                    </td>
                                    </tr>
                    <tr><td colspan="3">School Admiministrator's comment:</td> <td colspan="9">
                                            <textarea name="admin_" class="class_score form-control"><?php echo $general_select['admin'];?></textarea>
                                    </td>
                                    <tr><td colspan="3">School Admiministrator's signature:</td><td><img src="<?php echo base_url();?>uploads/adminsign.jpeg" width="150" height="50" alt="home" /></td>
        </tr>
        <tr ><td colspan="3">Next term begins:</td> <td colspan="9" border="2">
                                            <textarea name="next_term_" class="class_score form-control"><?php echo $general_select['next_term'];?></textarea>
                                    </td>
                                   
                                    <input type="hidden" name="mark_id_<?php echo $class_subject_exam_student['subject_id'] ;?>" value="<?php echo $general_select['mark_id'];?>" />
                                            
                                            <input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
                                            <input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                                            <input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
                                            
                                            <input type="hidden" name="operation" value="update_student_subject_score" />
                                </tr>
                       
  
/**
 * printable_report.php
 * CodeIgniter 4 view — Teacher-editable printable report (paper-style replica)
 *
 * Expected / optional variables:
 * - $student_name, $application_number, $class_name
 * - $academic_year, $school_term, $pass_fail, $cgpa
 * - $no_times_opened, $no_times_present, $class_highest_final_score, $class_lowest_final_score
 * - $closing_date, $next_resumption_date, $class_average_score
 * - $attendance
 * - $exam_term
 * - $subjects            => array of subject names (optional)
 * - $general_select      => either an associative array for single-subject row OR array of associative rows per subject
 * - $total_score         => either scalar or array per-subject (your CA1 calculation should populate this)
 * - $report1, $report2... etc. may be used later for printable fields
 *
 * The form posts teacher-entered values as arrays (subjects[], class_score1[][] etc).
 */

    <tr>
        <td>
            <strong>Name of student:</strong><br>
            <input type="text" name="student_name" value="<?= isset($student_name) ? esc($student_name) : ''; ?>">
        </td>
        <td>
            <strong>Admission No:</strong><br>
            <input type="text" name="application_number" value="<?= isset($application_number) ? esc($application_number) : ''; ?>">
        </td>
        <td>
            <strong>Class:</strong><br>
            <input type="text" name="class_name" value="<?= isset($class_name) ? esc($class_name) : ''; ?>">
        </td>
    </tr>

    <tr>
        <td>
            <strong>Academic Year:</strong><br>
            <input type="text" name="academic_year" value="<?= isset($academic_year) ? esc($academic_year) : ''; ?>">
        </td>
        <td>
            <strong>School Term:</strong><br>
            <input type="text" name="school_term" value="<?= isset($school_term) ? esc($school_term) : (isset($exam_term) ? esc($exam_term) : ''); ?>">
        </td>
        <td>
            <strong>Pass/Fail:</strong><br>
            <input type="text" name="pass_fail" value="<?= isset($pass_fail) ? esc($pass_fail) : ''; ?>">
            <br><strong>CGPA:</strong><br>
            <input type="text" name="cgpa" value="<?= isset($cgpa) ? esc($cgpa) : ''; ?>">
        </td>
    </tr>

    <tr>
        <td>
            <strong>No of times school opened:</strong><br>
            <input type="text" name="no_times_opened" value="<?= isset($no_times_opened) ? esc($no_times_opened) : ''; ?>">
        </td>
        <td>
            <strong>No of times present:</strong><br>
            <input type="text" name="no_times_present" value="<?= isset($no_times_present) ? esc($no_times_present) : (isset($attendance) ? esc($attendance) : ''); ?>">
        </td>
        <td>
            <strong>Class Highest final score:</strong><br>
            <input type="text" name="class_highest_final_score" value="<?= isset($class_highest_final_score) ? esc($class_highest_final_score) : ''; ?>">
            <br><strong>Class Lowest final score:</strong><br>
            <input type="text" name="class_lowest_final_score" value="<?= isset($class_lowest_final_score) ? esc($class_lowest_final_score) : ''; ?>">
        </td>
    </tr>

    <tr>
        <td>
            <strong>Closing date:</strong><br>
            <input type="text" name="closing_date" value="<?= isset($closing_date) ? esc($closing_date) : ''; ?>">
        </td>
        <td>
            <strong>Next Resumption date:</strong><br>
            <input type="text" name="next_resumption_date" value="<?= isset($next_resumption_date) ? esc($next_resumption_date) : ''; ?>">
        </td>
        <td>
            <strong>Class Average Score:</strong><br>
            <input type="text" name="class_average_score" value="<?= isset($class_average_score) ? esc($class_average_score) : ''; ?>">
        </td>
    </tr>


<!-- MAIN RESULT TABLE -->
<table class="report">
    <thead>
        <tr>
            <th class="sn">S/N</th>
            <th class="subjects-col">SUBJECTS</th>

            <!-- replicate paper column headings: various CAs, exam, term total, class avg, highest/lowest, position, grade, remarks -->
            <th class="col-ca">10% 1st CA</th>
            <th class="col-ca">10% 2nd CA</th>
            <th class="col-ca">5% (cw)</th>
            <th class="col-ca">5% (test)</th>
            <th class="col-exam">60% (Exam)</th>
            <th class="col-total">TERM TOTAL</th>
            <th class="col-classavg">Class Avg</th>
            <th class="col-classavg">Highest</th>
            <th class="col-classavg">Lowest</th>
            <th class="col-pos">Position</th>
            <th class="grade">GRADE</th>
            <th class="remarks">REMARKS</th>
        </tr>
    </thead>
    <tbody>
    <?php
    // Determine subjects list (use passed $subjects or fallback to default 18 rows)
    $default_subjects = [
        'English','Mathematics','French language','Music','Business Studies',
        'Nigerian Language','Religious Knowledge','Creative & Cultural arts','Basic Science',
        'Basic Technology','Computer Studies','Physical & Health Education','Social Studies',
        'Civic Education','Security Education','Agric. Science','Home Economics','History'
    ];

    $subjects_list = isset($subjects) && is_array($subjects) && count($subjects) ? $subjects : $default_subjects;

    // general_select may be an array of rows or a single assoc row - handle both
    $gs_is_multi = isset($general_select) && is_array($general_select) && array_keys($general_select) === range(0, count($general_select)-1);
    // If general_select is indexed array of rows -> multi, otherwise treat as single row to be reused
    foreach ($subjects_list as $i => $subject_name):
        // row data
        if ($gs_is_multi) {
            $row = isset($general_select[$i]) ? $general_select[$i] : [];
        } else {
            $row = isset($general_select) && is_array($general_select) ? $general_select : [];
        }

        // Prefer per-subject $total_score when available
        if (isset($total_score) && is_array($total_score) && isset($total_score[$i])) {
            $ca1_val = $total_score[$i];
        } elseif (isset($total_score) && !is_array($total_score) && $i === 0) {
            // fallback: if total_score is scalar assume it's for the current context -> show it in first row (common case)
            $ca1_val = $total_score;
        } else {
            // compute from row if possible
            $cs1 = isset($row['class_score1']) ? (float)$row['class_score1'] : (isset($row['class_score_1']) ? (float)$row['class_score_1'] : '');
            $cs2 = isset($row['class_score2']) ? (float)$row['class_score2'] : (isset($row['class_score_2']) ? (float)$row['class_score_2'] : '');
            $cs3 = isset($row['class_score3']) ? (float)$row['class_score3'] : (isset($row['class_score_3']) ? (float)$row['class_score_3'] : '');
            $cs4 = isset($row['class_score4']) ? (float)$row['class_score4'] : (isset($row['class_score_4']) ? (float)$row['class_score_4'] : '');
            $exam = isset($row['exam_score']) ? (float)$row['exam_score'] : (isset($row['exam']) ? (float)$row['exam'] : '');
            // default CA1/total calculation as per your spec:
            $ca1_val = ($exam !== '' || $cs1 !== '' || $cs2 !== '' || $cs3 !== '' || $cs4 !== '') ? ($exam + $cs1 + $cs2 + $cs3 + $cs4) : '';
        }

        // other fields defaults
        $class_avg = isset($row['class_average']) ? $row['class_average'] : '';
        $highest = isset($row['highest']) ? $row['highest'] : '';
        $lowest = isset($row['lowest']) ? $row['lowest'] : '';
        $position = isset($row['position']) ? $row['position'] : '';
        $grade = isset($row['grade']) ? $row['grade'] : '';
        $remark = isset($row['remark']) ? $row['remark'] : '';
        ?>
        <tr>
            <td class="sn center"><?= $i+1 ?></td>

            <td>
                <input type="text" name="subjects[<?= $i ?>][name]" value="<?= esc($subject_name) ?>">
            </td>

            <!-- CA and exam inputs: teachers will fill or edit -->
            <td class="center"><input type="text" name="subjects[<?= $i ?>][class_score1]" value="<?= isset($row['class_score1']) ? esc($row['class_score1']) : (isset($row['class_score_1']) ? esc($row['class_score_1']) : '') ?>"></td>
            <td class="center"><input type="text" name="subjects[<?= $i ?>][class_score2]" value="<?= isset($row['class_score2']) ? esc($row['class_score2']) : (isset($row['class_score_2']) ? esc($row['class_score_2']) : '') ?>"></td>
            <td class="center"><input type="text" name="subjects[<?= $i ?>][class_work]" value="<?= isset($row['class_work']) ? esc($row['class_work']) : (isset($row['cw']) ? esc($row['cw']) : '') ?>"></td>
            <td class="center"><input type="text" name="subjects[<?= $i ?>][class_test]" value="<?= isset($row['class_test']) ? esc($row['class_test']) : '' ?>"></td>
            <td class="center"><input type="text" name="subjects[<?= $i ?>][exam_score]" value="<?= isset($row['exam_score']) ? esc($row['exam_score']) : (isset($row['exam']) ? esc($row['exam']) : '') ?>"></td>

            <!-- TERM TOTAL uses $ca1_val (which follows your $total_score calculation) -->
            <td class="center"><input type="text" name="subjects[<?= $i ?>][term_total]" value="<?= esc($ca1_val) ?>"></td>

            <td class="center"><input type="text" name="subjects[<?= $i ?>][class_average]" value="<?= esc($class_avg) ?>"></td>
            <td class="center"><input type="text" name="subjects[<?= $i ?>][highest]" value="<?= esc($highest) ?>"></td>
            <td class="center"><input type="text" name="subjects[<?= $i ?>][lowest]" value="<?= esc($lowest) ?>"></td>
            <td class="center"><input type="text" name="subjects[<?= $i ?>][position]" value="<?= esc($position) ?>"></td>
            <td class="center"><input type="text" name="subjects[<?= $i ?>][grade]" value="<?= esc($grade) ?>"></td>
            <td><input type="text" name="subjects[<?= $i ?>][remark]" value="<?= esc($remark) ?>"></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

    <!-- TOTAL row like the sheet -->
    <tfoot>
        <tr>
            <td colspan="7" class="right"><strong>Total:</strong></td>
            <td class="center"><input type="text" name="overall_total" value="<?= isset($overall_total) ? esc($overall_total) : ''; ?>"></td>
            <td colspan="6" class="no-border"></td>
        </tr>
    </tfoot>
</table>

<!-- SKILLS & BEHAVIOR BLOCK (replica at bottom left of sheet) -->
<table class="info small">
    <tr>
        <td style="width:50%;">
            <strong>SKILLS</strong><br>
            <small>Handwriting, Fluency, Games, Crafts, Musical skills</small>
            <table style="width:100%; border:none; margin-top:6px;">
                <tr>
                    <td style="width:20%;">5</td><td style="width:20%;">4</td><td style="width:20%;">3</td><td style="width:20%;">2</td><td style="width:20%;">1</td>
                </tr>
                <tr>
                    <td colspan="5"><input type="text" name="skills_summary" value="<?= isset($skills_summary) ? esc($skills_summary) : ''; ?>"></td>
                </tr>
            </table>
        </td>
        <td style="width:50%;">
            <strong>BEHAVIOR</strong><br>
            <small>Reliability, Punctuality, Attentiveness, Neatness, Politeness, Honesty</small>
            <table style="width:100%; border:none; margin-top:6px;">
                <tr>
                    <td style="width:20%;">5</td><td style="width:20%;">4</td><td style="width:20%;">3</td><td style="width:20%;">2</td><td style="width:20%;">1</td>
                </tr>
                <tr>
                    <td colspan="5"><input type="text" name="behavior_summary" value="<?= isset($behavior_summary) ? esc($behavior_summary) : ''; ?>"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- TEACHER & HEAD TEACHER REMARKS -->
<table class="info">
    <tr>
        <td style="width:60%;">
            <strong>CLASS TEACHER REMARKS</strong><br>
            <textarea name="class_teacher_remarks"><?= isset($class_teacher_remarks) ? esc($class_teacher_remarks) : ''; ?></textarea>
        </td>
        <td style="width:40%;">
            <strong>HEAD TEACHER REMARKS</strong><br>
            <textarea name="head_teacher_remarks"><?= isset($head_teacher_remarks) ? esc($head_teacher_remarks) : ''; ?></textarea>

            <p style="margin-top:8px;"><strong>Head teacher's signature:</strong><br><input type="text" name="head_teacher_signature" value="<?= isset($head_teacher_signature) ? esc($head_teacher_signature) : ''; ?>"></p>
        </td>
    </tr>
</table>

<!-- GRADE SCALE (replica) -->
<table class="info small">
    <tr>
        <td><strong>SCORES</strong></td>
        <td><strong>GRADES</strong></td>
        <td><strong>REMARKS</strong></td>
        <td><strong>POINT</strong></td>
    </tr>
    <tr><td>1-39</td><td>F</td><td>FAIL</td><td>0.00</td></tr>
    <tr><td>40-49</td><td>D</td><td>POOR</td><td>1.00</td></tr>
    <tr><td>50-59</td><td>C</td><td>GOOD</td><td>2.00</td></tr>
    <tr><td>60-69</td><td>B</td><td>V.GOOD</td><td>3.00</td></tr>
    <tr><td>70-100</td><td>A</td><td>EXCELLENT</td><td>4.00</td></tr>


</table>
<table border="2" style="width: 80vw; height: 20vh; border-collapse: collapse;">
    
    <tr>
        <td style="padding: 2px; text-align: center;">Class Teacher's Comment:</td>
        <td><textarea name="report57" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report57']; ?></textarea></td>
   
    </tr>
    <tr>
        <td style="padding: 2px; text-align: center;">School Administrator's Comment:</td>
        <td><textarea name="report58" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report58']; ?></textarea></td>
   
    </tr>
    <tr>
        <td style="padding: 2px; text-align: center;">School Administrator's Signature:</td>
        <td style="padding: 2px;"><img src="<?php echo base_url();?>uploads/adminsign.jpeg" width="150" height="50" alt="home" /></td>
    </tr>
    <tr>
        <td style="padding: 2px; text-align: right; font-weight: bold;">Date:</td>
        <td><textarea name="report59" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report59']; ?></textarea></td>
   
    </tr>
</table>
                            
                         	
                    </tbody>
               </table>
               
              <h5 id="error_message" class="alert alert-warning" style="display:none">Class score must not be greater 10 and exam score must not be greater than 70</h5>
                      <button type="submit" class="btn btn-sm btn-rounded btn-block  btn-info"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('update_marks');?></button>
                 
                  <?php echo form_close();?>
            
			</div>
        </div>
	</div>
 </div>

 

<?php endif;?>



<script type="text/javascript">
    function show_students(class_id){
            for(i=0;i<=50;i++){
                try{
                    document.getElementById('student_id_'+i).style.display = 'none' ;
                    document.getElementById('student_id_'+i).setAttribute("name" , "temp");
                }
                catch(err){}
            }
            if (class_id == "") {
                class_id = "0";
        }
        document.getElementById('student_id_'+class_id).style.display = 'block' ;
        document.getElementById('student_id_'+class_id).setAttribute("name" , "student_id");
        var student_id = $(".student_id");
        for(var i = 0; i < student_id.length; i++)
            student_id[i].selected = "";
    }


function class_score_change() {
  var class_scores = document.getElementsByClassName('class_score');
    for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
        if (value > 10) {
            class_scores[i].value = 0;
                $('#error_message').show();
        }
    }
}
 

function exam_score_change() {
  var exam_scores = document.getElementsByClassName('exam_score');
    for (var i = exam_scores.length - 1; i >= 0; i--) {
      var value = exam_scores[i].value;
        if (value > 60) {
            exam_scores[i].value = 0;
                $('#error_message').show();
        }
    }
}

function low_in_class_change() {
  var low_in_class = document.getElementsByClassName('exam_score');
    for (var i = low_in_class.length - 1; i >= 0; i--) {
      var value = low_in_class[i].value;
        if (value > 100) {
            low_in_class[i].value = 0;
                $('#error_message').show();
        }
    }
}

function high_in_class_change() {
  var high_in_class = document.getElementsByClassName('high_in_class');
    for (var i = high_in_class.length - 1; i >= 0; i--) {
      var value = high_in_class[i].value;
        if (value > 100) {
            high_in_class[i].value = 0;
                $('#error_message').show();
        }
    }
}
function total_score_change() {
  var exam_scores = document.getElementsByClassName('total_score');
    for (var i = total_scores.length - 1; i >= 0; i--) {
      var value = total_scores[i].value;
        if (value > 100) {
            exam_scores[i].value = 0;
                $('#error_message').show();
        }
    }
}

</script>











