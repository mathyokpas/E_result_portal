

<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Enter Student Score SHEET');?></div>
                <div class="panel-body table-responsive">
			
                    <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/cummulative' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
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

<?php if($class_id > 0 && $student_id > 0): ?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-book"></i>&nbsp;&nbsp;<?php echo get_phrase('cumulative_result'); ?>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('subject'); ?></th>
                            <th><?php echo get_phrase('1st_Term'); ?></th>
                            <th><?php echo get_phrase('2nd_Term'); ?></th>
                            <th><?php echo get_phrase('3rd_Term'); ?></th>
                            <th><?php echo get_phrase('Cumulative_Average'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($cumulative_scores) && !empty($cumulative_scores)): ?>
                            <?php foreach($cumulative_scores as $data): ?>
                         <td><?php echo ucfirst($data['subject_name']); ?></td>

                                    <td><?php echo $data['first_term']; ?></td>
                                    <td><?php echo $data['second_term']; ?></td>
                                    <td><?php echo $data['third_term']; ?></td>
                                    <td><strong><?php echo round($data['average'], 2); ?></strong></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center"><?php echo get_phrase('no_data_found'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php
// Only run if we have scores
if (isset($cumulative_scores) && !empty($cumulative_scores)) {
    $total_score = 0;
    $subject_count = 0;

    foreach ($cumulative_scores as $data) {
        // Add cumulative total per subject (sum of all 3 terms)
        $total_score += ($data['first_term'] + $data['second_term'] + $data['third_term']) / 3; 
        $subject_count++;
    }

    // Overall average
    $overall_average = $subject_count > 0 ? round($total_score / $subject_count, 2) : 0;

    // Promotion status
    $promotion_status = ($overall_average >= 50) ? 'Promoted' : 'Not Promoted';
    ?>
    
    <div style="margin-top: 20px; font-weight: bold;">
        Total Score (Cumulative): &nbsp; &nbsp;<?php echo round($total_score, 2);?> &nbsp; &nbsp; &nbsp; | &nbsp; 
        Average: &nbsp; &nbsp;<?php echo $overall_average; ?> &nbsp; | &nbsp; 
        <?php echo $promotion_status; ?>
    </div>



         <!-- Admin Signature Section -->
    <div style="text-align: center; margin-top: 40px;">
        <img src="<?php echo base_url();?>uploads/adminsign.jpeg" alt="Admin Signature" style="max-width: 200px; height: auto;">
        <div style="margin-top: 5px; font-weight: bold;">School Administrator</div>
    </div>
<?php } ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<script type="text/javascript">
function show_students(class_id) {
    for(let i = 0; i <= 50; i++) {
        try {
            document.getElementById('student_id_' + i).style.display = 'none';
            document.getElementById('student_id_' + i).setAttribute("name", "temp");
        } catch (err) {}
    }

    if (class_id == "") class_id = "0";

    document.getElementById('student_id_' + class_id).style.display = 'block';
    document.getElementById('student_id_' + class_id).setAttribute("name", "student_id");
}
</script>
