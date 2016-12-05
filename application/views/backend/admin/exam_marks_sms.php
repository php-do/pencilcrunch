<hr />
<div class="row">
	<div class="col-md-12">
	
		<div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
			
			<!-- panel head -->
			<div class="panel-heading">
				<div class="panel-title"><?php echo get_phrase('send_marks');?> via SMS</div>
			</div>
			
			<!-- panel body -->
			<div class="panel-body">
			<?php echo form_open(base_url() . 'admin/exam_marks_sms/send_sms' , array('target'=>'_top'));?>

				<div class="form-group">
                    <div class="col-md-3">
                        <select name="exam_id" class="form-control" required>
                        	<option value=""><?php echo get_phrase('select_exam');?></option>
                    	<?php 
                    		$exams = $this->db->get('exam')->result_array();
                    		foreach ($exams as $row):
                    	?>
                        	<option value="<?php echo $row['exam_id'];?>"><?php echo $row['name'];?></option>
                        <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                        <select name="class_id" class="form-control" required>
                        	<option value=""><?php echo get_phrase('select_class');?></option>
                        <?php 
                        	$classes = $this->db->get('class')->result_array();
                        	foreach ($classes as $row):
                        ?>
                        	<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                        <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                        <select name="receiver" class="form-control" required>
                        	<option value=""><?php echo get_phrase('select_receiver');?></option>
                        	<option value="student"><?php echo get_phrase('students');?></option>
                        	<option value="parent"><?php echo get_phrase('parents');?></option>
                        </select>
                    </div>
                </div>
                
                  <div class="col-md-3">
                      <button type="submit" class="btn btn-primary"><?php echo get_phrase('send_marks');?> via SMS</button>
                  </div>

			<?php echo form_close();?>	
			</div>
			
		</div>
	
	</div>
</div>