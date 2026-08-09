<div class="row">
    <div class="col-md-12">
        <?php echo form_open(base_url() . 'admin/promote_student/' . $student_id , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo get_phrase('new_class');?></label>
            <div class="col-sm-8">
                <select name="new_class_id" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('select_class');?></option>
                    <?php foreach ($classes as $class): ?>
                        <option value="<?php echo $class['class_id']; ?>"><?php echo $class['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo get_phrase('new_session');?></label>
            <div class="col-sm-8">
                <select name="new_exam_id" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('select_session');?></option>
                    <?php foreach ($exams as $exam): ?>
                        <option value="<?php echo $exam['exam_id']; ?>"><?php echo $exam['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-8">
                <button type="submit" class="btn btn-info btn-block btn-rounded">
                    <i class="fa fa-arrow-up"></i>&nbsp;<?php echo get_phrase('promote_student');?>
                </button>
            </div>
        </div>

        <?php echo form_close();?>
    </div>
</div>
