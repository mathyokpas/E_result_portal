


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script>
function getPDF(){

var HTML_Width = $(".canvas_div_pdf").width();
var HTML_Height = $(".canvas_div_pdf").height();
var top_left_margin = 15;
var PDF_Width = HTML_Width+(top_left_margin*2);
var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
var canvas_image_width = HTML_Width;
var canvas_image_height = HTML_Height;

var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
    canvas.getContext('2d');
    
    console.log(canvas.height+"  "+canvas.width);
    
    
    var imgData = canvas.toDataURL("image/jpeg", 1.0);
    var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
    
    
    for (var i = 1; i <= totalPDFPages; i++) { 
        pdf.addPage(PDF_Width, PDF_Height);
        pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
    }
    
    pdf.save("Student_Result.pdf");
});
};
</script>

<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Student Score SHEET');?></div>
                <div class="panel-body table-responsive">
			
                    <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'student/cummulative' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Session');?></label>
                                <div class="col-sm-12">
                                    <select name="exam_id" class="form-control select2">
                                        <option value=""><?php echo get_phrase('select_Exam');?></option>

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
                                        

                                        <?php $classes =  $this->db->get('class')->result_array();
                                        foreach($classes as $key => $class):?>
                                        <option value="<?php echo $class['class_id'];?>"<?php if($class_id == $class['class_id']) echo 'selected="selected"' ;?>>Class: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>
                            <!--
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
                            -->

								<!--
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
                                        -->     

                                        <div class="form-group">
                                            <!--
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Student');?></label>
                                    -->
                                <div class="col-sm-12">

                                <?php $classes = $this->crud_model->get_classes();
                                        foreach ($classes as $key => $row): ?>

                                    <input type="hidden" name="<?php if($class_id == $row['class_id']) echo 'student_id'; else echo 'temp';?>" id="student_id_<?php echo $row['class_id'];?>" style="display:<?php if($class_id == $row['class_id']) echo 'block'; else echo 'none';?>"  class="form-control"
                                    

                                       value="<?php  $student_id           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'student_id');
                                echo $student_id; ?>
                                        "<?php echo $student['student_id'];?>"<?php if(isset($student_id) && $student_id == $student['student_id']) echo 'selected="selected"';?><?php echo $student['name'];?></option>
                                        
                                    
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
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('Get Result');?></button>
                        </div>
                                        
		
                    </form>                
            </div>                
		</div>
	</div>
</div>


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
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('student_score_sheet'); ?>
             <div class="col-md-12 text-center">
			<button onclick="getPDF()" id="downloadbtn"><b>Click to Download RESULT as PDF</b></button>
			<span id="genmsg" style="display:none;">Generating ...</span>
			</div></div>
            <div class="canvas_div_pdf">
                <div class="panel-body table-responsive">
                
                <table width="1000">
                          <tr>
                            <td class="pull-left"><a class="logo" href="#"><img src="<?php echo base_url();?>uploads/logo.png" width="150" height="150" alt="home" /></td>
                            <td>
                                <h2 align="center" style="color: #00a3cc; font-family:calibri;  font-weight:bold; font-size:18px;">MENTORS INTERNATIONAL ACADEMY</h2>
                                <p align="center" style="color: #00a3cc; font-family:calibri;  font-weight:bold; font-size: 18px;"><i class="fa fa-map-marker"></i>
          Jigo, Bwari, ABUJA. 
              
 <br/>
                                <i class="fa fa-envelope"></i>  E-MAIL: info@mentorsinternationalacademy.com: <i class="fa fa-phone"></i> TEL: 08101567024 </p>	
                            </td>
                            <td class="pull-right"> <?php
                            $key = $this->session->userdata('login_type') . '_id';
                            $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                            if (!file_exists($face_file)) {
                                $face_file = 'uploads/default.jpg';                                 
                            }
                            ?>
                        <a href="#" ><img src="<?php echo base_url() . $face_file;?>" alt="Click to upload student passport" class="img-circle" width="150" height="150">    
                        </td>
                          </tr>		
                        </table>
                        <table align="left" width="1000">
                        
                          <tr align="left" style="font-size:20px;">
                            
                        <td  class="pull-center">
                           
                                    <select readonly name="exam_id" class="form-control select2" style="border-color: white; color: #00a3cc; font-family:calibri;  font-weight:bold;">
                                        <option value=""    style="border-color: white;color: #00a3cc; font-family:calibri;  font-weight:bold; font-size:20px;"><?php echo get_phrase('select_Exam');?></option>

                                        <?php $exams =  $this->db->get('exam')->result_array();
                                        foreach($exams as $key => $exam):?>
                                        <option value="<?php echo $exam['exam_id'];?>"<?php if($exam_id == $exam['exam_id']) echo 'selected="selected"' ;?>><?php echo $exam['name'];?></option>
                                        <?php endforeach;?>
                                </select>
                                        </td>
                                        
                          </tr>	
                          </table>
                          <table style="color: #00a3cc; font-family:calibri;  font-weight:bold; border:1px;">
                       <tbody style="color: #00a3cc; font-family:calibri;  font-weight:bold; border:1px;">
                          <tr style="color: #00a3cc; font-family:calibri;  font-weight:bold; font-size: 18px; border-size:1px;">
                            <td style="font-size: 17px;">STUDENT'S NAME: &nbsp;&nbsp;</td>
                            <td ><?php $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;?>&nbsp;&nbsp;</td>
                            <td >ADMISSION NO:&nbsp;&nbsp;</td>
                            <td ><?php $application_number           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'application_number');
                                echo $application_number;?>&nbsp;</td>
                                <td> <select name="class_id"  class="form-control select2" onchange="show_students(this.value)" style="border-color: white; color: #00a3cc; font-family:calibri;  font-weight:bold;">
                                        

                                        <?php $classes =  $this->db->get('class')->result_array();
                                        foreach($classes as $key => $class):?>
                                        <option value="<?php echo $class['class_id'];?>"<?php if($class_id == $class['class_id']) echo 'selected="selected"' ;?>>Class: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                </select></td>
                            
                          </tr>
                          
                         
                        </tbody>
                         <?php
// Initialize variables
$sum_total_score = 0;
$count_me = 0;
$total_attendance = 0;
$highest_in_class = 0;
$lowest_in_class = 100; // Assuming 100 as the highest possible score

// Fetch all subjects associated with the given class ID
$select_subject_with_class_id = $this->crud_model->get_subjects_by_class($class_id);

if (!empty($select_subject_with_class_id)) {
    foreach ($select_subject_with_class_id as $class_subject_exam_student) {
        // Prepare the data for verification
        $verify_data = array(
            'exam_id' => $exam_id,
            'class_id' => $class_id,
            'student_id' => $student_id,
            'subject_id' => $class_subject_exam_student['subject_id']
        );

        // Check for existing marks
        $query = $this->db->get_where('mark', $verify_data);

        if ($query->num_rows() > 0) {
            // Get the single result as an associative array
            $general_select = $query->row_array();
            $total_score = $general_select['exam_score'] + $general_select['class_score1'] + $general_select['class_score2'] + $general_select['class_score3'] + $general_select['class_score4'] + $general_select['class_score5'] + $general_select['class_score6'];
            $attendance = $general_select['attendance'];

            // Update total score, attendance, and class performance
            if ($total_score > 0) {
                $count_me++;
                $sum_total_score += $total_score;
                $total_attendance += $attendance; // Accumulate attendance

                // Update highest and lowest scores for the class
                $highest_in_class = max($highest_in_class, $total_score);
                $lowest_in_class = min($lowest_in_class, $total_score);
            }
            ?>

            <!-- Display Subject, Score, and Attendance -->
             <!--
            <tr style="font-size:18px; border-color:#00a3cc">
                <td><?php echo $class_subject_exam_student['subject_name']; ?></td>
                <td><?php echo $total_score; ?></td>
                <td><?php echo $general_select['lowest_in_class']; ?></td>
                <td><?php echo $general_select['highest_in_class']; ?></td>
                <td><?php echo $general_select['cum_average_score']; ?></td>
                <td><?php echo $general_select['3rd_term_average']; ?></td>
                <td><?php echo $attendance; ?></td>
            </tr>
        -->
            <input type="hidden" name="mark_id_<?php echo $class_subject_exam_student['subject_id']; ?>" value="<?php echo $general_select['mark_id']; ?>" />
            <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>" />
            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />
            <input type="hidden" name="operation" value="update_student_subject_score" />

            <?php
        }
    }

    // Display the average score and totals if applicable
    if ($count_me > 0) {
        $average_score = $sum_total_score / $count_me;
        ?>
    <table style="color: #00a3cc; font-family: calibri; font-weight: bold; border: 1px solid #00a3cc; border-collapse: collapse;">
    <tr>
        <td style="color: #00a3cc; font-size: 20px; padding: 5px; border: 1px solid #00a3cc;">Average Scores</td>
        <td style="color: #00a3cc; font-size: 20px; padding: 5px; border: 1px solid #00a3cc;"><?php echo number_format($average_score, 2); ?></td>
       
        <td style="color: #00a3cc; font-size: 20px; padding: 5px; border: 1px solid #00a3cc;">Sum of Total Scores</td>
        <td style="color: #00a3cc; font-size: 20px; padding: 5px; border: 1px solid #00a3cc;"><?php echo $sum_total_score; ?></td>
       
        <td style="color: #00a3cc; font-size: 20px; padding: 5px; border: 1px solid #00a3cc;">Attended</td>
        <td style="color: #00a3cc; font-size: 20px; padding: 5px; border: 1px solid #00a3cc;"><?php echo $general_select['attendance']; ?></td>
       
        <td style="color: #00a3cc; font-size: 20px; padding: 5px; border: 1px solid #00a3cc;">Total Attendance</td>
        <td style="color: #00a3cc; font-size: 20px; padding: 5px; border: 1px solid #00a3cc;"><?php echo $general_select['total_attendance']; ?></td>
        <td style="color: #00a3cc; font-size: 20px; padding: 5px; border: 1px solid #00a3cc;"><strong>NEXT TERM BEGINS:</strong>&nbsp;</td>
                            <td style="color: #00a3cc; font-size: 20px; padding: 5px; border: 1px solid #00a3cc;"><?php echo $general_select['next_term']; ?></td>
    </tr>
</table>



        <?php
    } else {
        echo "<tr><td colspan='6'>No scores found.</td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>No subjects found for the given class ID.</td></tr>";
}
?>
                          
                          
                        </table>
                       
                       
    				
              <!-- 
              <h5 id="error_message" class="alert alert-warning" style="display:none">Class score must not be greater 10 and exam score must not be greater than 70</h5>
                      <button type="submit" class="btn btn-sm btn-rounded btn-block  btn-info"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('update_marks');?></button>
            -->
                  <?php echo form_close();?>
            <!--      <div><p>Teacher's Comment:</p><br>
                        <p>Head Teachers's Comment:</p>
                        
                  </div>
            -->
			</div>
        </div>
	</div>
 </div>

 

<?php endif;?>

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


</div>

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
        if (value > 20) {
            class_scores[i].value = 0;
                $('#error_message').show();
        }
    }
}
 

function exam_score_change() {
  var exam_scores = document.getElementsByClassName('exam_score');
    for (var i = exam_scores.length - 1; i >= 0; i--) {
      var value = exam_scores[i].value;
        if (value > 70) {
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
  var high_in_class = document.getElementsByClassName('exam_score');
    for (var i = high_in_class.length - 1; i >= 0; i--) {
      var value = high_in_class[i].value;
        if (value > 100) {
            low_in_class[i].value = 0;
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











