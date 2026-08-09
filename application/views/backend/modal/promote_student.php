<?php
$student_info = $this->db->get_where('student', array('student_id' => $student_id))->row();
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-arrow-up"></i> &nbsp; <?php echo get_phrase('promote_student'); ?>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'admin/promote_student/' . $student_id, array('class' => 'form-horizontal form-groups-bordered validate')); ?>

                <div class="form-group">
                    <label class="col-sm-12"><?php echo get_phrase('student_name'); ?></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $student_info->name; ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-12"><?php echo get_phrase('current_class'); ?></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control"
                               value="<?php echo $this->crud_model->get_type_name_by_id('class', $student_info->class_id); ?>"
                               readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-12"><?php echo get_phrase('promote_to_class'); ?></label>
                    <div class="col-sm-12">
                        <select name="new_class_id" class="form-control select2" required>
                            <option value=""><?php echo get_phrase('select_class'); ?></option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row):
                                ?>
                                <option value="<?php echo $row['class_id']; ?>">
                                    <?php echo $row['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-12"><?php echo get_phrase('exam_term'); ?></label>
                    <div class="col-sm-12">
                        <select name="new_exam_id" class="form-control select2" required>
                            <option value=""><?php echo get_phrase('select_exam'); ?></option>
                            <?php
                            $exams = $this->db->get('exam')->result_array();
                            foreach ($exams as $exam):
                                ?>
                                <option value="<?php echo $exam['exam_id']; ?>">
                                    <?php echo $exam['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="fa fa-arrow-up"></i> <?php echo get_phrase('promote'); ?>
                    </button>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
