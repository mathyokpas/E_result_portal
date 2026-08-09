

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
                        <table border="2" style="width: 80vw; height: 20vh; border-collapse: collapse;">
    <tr>
        <th colspan="2" style="padding: 2px; text-align: center;">Area of Learning</th>
        <th style="padding: 2px; text-align: center;">Effort</th>
        <th style="padding: 2px; text-align: center;">Attainment</th>
        <th style="padding: 2px; text-align: center;">Progress</th>
        <th style="padding: 2px; text-align: center;">Comments</th>
    </tr>
     <tr>
    <td rowspan="3" style="padding: 2px; text-align: center;">English</td>
    <td style="padding: 2px; text-align: center;">Speaking and Listening</td>
    <td><textarea name="report1" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report1']; ?></textarea></td>
    <td><textarea name="report2" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report2']; ?></textarea></td>
    <td><textarea name="report3" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report3']; ?></textarea></td>
    <td><textarea name="report4" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report4']; ?></textarea></td>
</tr>
<tr>
    <td style="padding: 2px; text-align: center;">Reading</td>
    <td><textarea name="report5" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report5']; ?></textarea></td>
    <td><textarea name="report6" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report6']; ?></textarea></td>
    <td><textarea name="report7" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report7']; ?></textarea></td>
    <td><textarea name="report8" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report8']; ?></textarea></td>
</tr>
<tr>
    <td style="padding: 2px; text-align: center;">Writing</td>
    <td><textarea name="report9" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report9']; ?></textarea></td>
    <td><textarea name="report10" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report10']; ?></textarea></td>
    <td><textarea name="report11" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report11']; ?></textarea></td>
    <td><textarea name="report12" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report12']; ?></textarea></td>
</tr>
<tr>
    <td colspan="2" style="padding: 2px; text-align: center;">Mathematics</td>
    <td><textarea name="report13" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report13']; ?></textarea></td>
    <td><textarea name="report14" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report14']; ?></textarea></td>
    <td><textarea name="report15" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report15']; ?></textarea></td>
    <td><textarea name="report16" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report16']; ?></textarea></td>
</tr>
<tr>
    <td colspan="2" style="padding: 2px; text-align: center;">Basic Science and Technology (BST)</td>
    <td><textarea name="report17" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report17']; ?></textarea></td>
    <td><textarea name="report18" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report18']; ?></textarea></td>
    <td><textarea name="report19" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report19']; ?></textarea></td>
    <td><textarea name="report20" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report20']; ?></textarea></td>
</tr>

</table>

<table border="2" style="width: 75vw; height: 20vh; border-collapse: collapse; color: #00a3cc; font-family: Calibri; font-weight: bold; border: 2px solid #00a3cc;">
    <div style="text-align: center; font-weight: bold; font-size: 20px; color: #00a3cc;">NURSERY Progressive Report</div>
    <tr style="color: #00a3cc; font-size: 20px; padding: 5px; border: 2px solid #00a3cc;">
        <th colspan="2" style="padding: 2px; text-align: center; color: #00a3cc; font-size: 20px; border: 2px solid #00a3cc;">Area of Learning</th>
        <th style="padding: 2px; text-align: center; color: #00a3cc; font-size: 20px; border: 2px solid #00a3cc;">Effort</th>
        <th style="padding: 2px; text-align: center; color: #00a3cc; font-size: 20px; border: 2px solid #00a3cc;">Attainment</th>
        <th style="padding: 2px; text-align: center; color: #00a3cc; font-size: 20px; border: 2px solid #00a3cc;">Progress</th>
        <th style="padding: 2px; text-align: center; color: #00a3cc; font-size: 20px; border: 2px solid #00a3cc;">Comments</th>
    </tr>
     <tr>
        <td colspan="2" style="padding: 2px; text-align: center;">Letter Work / Literacy</td>
        <td><textarea name="report60" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report60']; ?></textarea></td>
        <td><textarea name="report61" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report61']; ?></textarea></td>
        <td><textarea name="report62" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report62']; ?></textarea></td>
        <td><textarea name="report63" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report63']; ?></textarea></td>
    </tr>
    <tr>
        <td colspan="2" style="padding: 2px; text-align: center;">Number Work / Numeracy</td>
        <td><textarea name="report64" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report64']; ?></textarea></td>
        <td><textarea name="report65" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report65']; ?></textarea></td>
        <td><textarea name="report66" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report66']; ?></textarea></td>
        <td><textarea name="report67" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report67']; ?></textarea></td>
    </tr>
    <tr>
        <td colspan="2" style="padding: 2px; text-align: center;">Knowledge and Understanding of the World (KUW)</td>
        <td><textarea name="report68" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report68']; ?></textarea></td>
        <td><textarea name="report69" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report69']; ?></textarea></td>
        <td><textarea name="report70" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report70']; ?></textarea></td>
        <td><textarea name="report71" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report71']; ?></textarea></td>
    </tr>
</table>
<br>
<table border="2" style="width: 80vw; height: 40vh; border-collapse: collapse;">
    <tr>
        <th rowspan="2" style="padding: 2px; text-align: center;">Area of Learning</th>
        <th colspan="3" style="padding: 2px; text-align: center;">Effort</th>
        <th colspan="3" style="padding: 2px; text-align: center;">Progress</th>
    </tr>
    <tr>
        <th style="padding: 2px; text-align: center;">A</th>
        <th style="padding: 2px; text-align: center;">B</th>
        <th style="padding: 2px; text-align: center;">C</th>
        <th style="padding: 2px; text-align: center;">A</th>
        <th style="padding: 2px; text-align: center;">B</th>
        <th style="padding: 2px; text-align: center;">C</th>
    </tr>
     <tr>
    <td style="padding: 2px; text-align: center;">Religion and National Values(RVN)</td>
    <td><textarea name="report21" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report21']; ?></textarea></td>
    <td><textarea name="report22" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report22']; ?></textarea></td>
    <td><textarea name="report23" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report23']; ?></textarea></td>
    <td><textarea name="report24" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report24']; ?></textarea></td>
    <td><textarea name="report25" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report25']; ?></textarea></td>
    <td><textarea name="report26" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report26']; ?></textarea></td>
</tr>
<tr>
    <td style="padding: 2px; text-align: center;">Pre-Vocational Studies(PVS)</td>
    <td><textarea name="report27" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report27']; ?></textarea></td>
    <td><textarea name="report28" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report28']; ?></textarea></td>
    <td><textarea name="report29" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report29']; ?></textarea></td>
    <td><textarea name="report30" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report30']; ?></textarea></td>
    <td><textarea name="report31" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report31']; ?></textarea></td>
    <td><textarea name="report32" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report32']; ?></textarea></td>
</tr>
<tr>
    <td style="padding: 2px; text-align: center;">History / Geography</td>
    <td><textarea name="report33" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report33']; ?></textarea></td>
    <td><textarea name="report34" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report34']; ?></textarea></td>
    <td><textarea name="report35" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report35']; ?></textarea></td>
    <td><textarea name="report36" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report36']; ?></textarea></td>
    <td><textarea name="report37" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report37']; ?></textarea></td>
    <td><textarea name="report38" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report38']; ?></textarea></td>
</tr>
<tr>
    <td style="padding: 2px; text-align: center;">Social Studies</td>
    <td><textarea name="report39" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report39']; ?></textarea></td>
    <td><textarea name="report40" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report40']; ?></textarea></td>
    <td><textarea name="report41" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report41']; ?></textarea></td>
    <td><textarea name="report42" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report42']; ?></textarea></td>
    <td><textarea name="report43" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report43']; ?></textarea></td>
    <td><textarea name="report44" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report44']; ?></textarea></td>
</tr>
<tr>
    <td style="padding: 2px; text-align: center;">Creative Arts</td>
    <td><textarea name="report45" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report45']; ?></textarea></td>
    <td><textarea name="report46" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report46']; ?></textarea></td>
    <td><textarea name="report47" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report47']; ?></textarea></td>
    <td><textarea name="report48" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report48']; ?></textarea></td>
    <td><textarea name="report49" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report49']; ?></textarea></td>
    <td><textarea name="report50" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report50']; ?></textarea></td>
</tr>

</table>
<table border="2" style="width: 80vw; height: 20vh; border-collapse: collapse;">
    <tr>
        <th  style="padding: 2px; text-align: center;">Progress</th>
        <th  style="padding: 2px; text-align: center;">Current Attainment</th>
        <th  style="padding: 2px; text-align: center;">Effort</th>
    </tr>
    <tr>
    <td><textarea name="report51" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report51']; ?></textarea></td>
    <td><textarea name="report52" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report52']; ?></textarea></td>
    <td><textarea name="report53" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report53']; ?></textarea></td>
   
       
    </tr>
    <tr>
    <td><textarea name="report54" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report54']; ?></textarea></td>
    <td><textarea name="report55" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report55']; ?></textarea></td>
    <td><textarea name="report56" style="width: 100%; height: 100%; resize: none;"><?php echo $general_select['report56']; ?></textarea></td>
   
         
    </tr>
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











