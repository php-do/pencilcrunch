
	<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
    	<thead>
        	<tr>
            	<th><?php echo get_phrase('select_date');?></th>
            	<th><?php echo get_phrase('select_month');?></th>
            	<th><?php echo get_phrase('select_year');?></th>
            	<th><?php echo get_phrase('select_class');?></th>
            	<th><?php echo get_phrase('select_date');?></th>
           </tr>
       </thead>
		<tbody>
        	<form method="post" action="<?php echo base_url();?>teacher/attendance_selector" class="form">
            	<tr class="gradeA">
                    <td>
                    	<select name="date" class="form-control">
                        	<?php for($i=1;$i<=31;$i++):?>
                            	<option value="<?php echo $i;?>" 
                                	<?php if(isset($date) && $date==$i)echo 'selected="selected"';?>>
										<?php echo $i;?>
                                        	</option>
                            <?php endfor;?>
                        </select>
                    </td>
                    <td>
                    	<select name="month" class="form-control">
                        	<?php 
							for($i=1;$i<=12;$i++):
								if($i==1)$m='january';
								else if($i==2)$m='february';
								else if($i==3)$m='march';
								else if($i==4)$m='april';
								else if($i==5)$m='may';
								else if($i==6)$m='june';
								else if($i==7)$m='july';
								else if($i==8)$m='august';
								else if($i==9)$m='september';
								else if($i==10)$m='october';
								else if($i==11)$m='november';
								else if($i==12)$m='december';
							?>
                            	<option value="<?php echo $i;?>"
                                	<?php if($month==$i)echo 'selected="selected"';?>>
										<?php echo $m;?>
                                        	</option>
                            <?php 
							endfor;
							?>
                        </select>
                    </td>
                    <td>
                    	<select name="year" class="form-control">
                        	<?php for($i=2020;$i>=2010;$i--):?>
                            	<option value="<?php echo $i;?>"
                                	<?php if(isset($year) && $year==$i)echo 'selected="selected"';?>>
										<?php echo $i;?>
                                        	</option>
                            <?php endfor;?>
                        </select>
                    </td>
                    <td>
                    	<select name="class_id" class="form-control">
                        	<?php 
							$classes	=	$this->db->get('class')->result_array();
							foreach($classes as $row):?>
                        	<option value="<?php echo $row['class_id'];?>"
                            	<?php if(isset($class_id) && $class_id==$row['class_id'])echo 'selected="selected"';?>>
									<?php echo $row['name'];?>
                              			</option>
                            <?php endforeach;?>
                        </select>

                    </td>
                    <td align="center"><input type="submit" value="<?php echo get_phrase('manage_attendance');?>" class="btn btn-info"/></td>
                </tr>
            </form>
		</tbody>
	</table>

<?php if($date!='' && $month!='' && $year!='' && $class_id!=''):?>

<center>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
        
            <div class="tile-stats tile-white-gray">
                <div class="icon"><i class="entypo-suitcase"></i></div>
                <?php
                   $full_date	=	$year.'-'.$month.'-'.$date;
                    $timestamp = strtotime($full_date);
                    $day = strtolower(date('l', $timestamp));
                 ?>
                <h2><?php echo ucwords($day);?></h2>
                
                <h3>Attendance of class <?php echo ($class_id);?></h3>
                <p><?php echo $date.'-'.$month.'-'.$year;?></p>
            </div>
        </div>
    </div>
</center>






<div class="row">
<div class="col-sm-offset-3 col-md-6">
    <table  class="table table-bordered">
		<thead>
			<tr class="gradeA">
            	<th><?php echo get_phrase('roll');?></th>
            	<th><?php echo get_phrase('name');?></th>
            	<th><?php echo get_phrase('status');?></th>
			</tr>
        </thead>
        <tbody>
        		
        	<?php 
			//STUDENTS ATTENDANCE
			$students	=	$this->db->get_where('student' , array('class_id'=>$class_id))->result_array();
				
			foreach($students as $row)
			{
				?>
				<tr class="gradeA">
					<td><?php echo $row['roll'];?></td>
					<td><?php echo $row['name'];?></td>
					<td align="center">
						<?php 
						//inserting blank data for students attendance if unavailable
						$verify_data	=	array(	'student_id' => $row['student_id'],
													'date' => $full_date);
						$query = $this->db->get_where('attendance' , $verify_data);
						if($query->num_rows() < 1)
						$this->db->insert('attendance' , $verify_data);
						
						//showing the attendance status editing option
						$attendance = $this->db->get_where('attendance' , $verify_data)->row();
						$status		= $attendance->status;
                    	?>
                        
                        <form method="post" action="<?php echo base_url();?>teacher/manage_attendance/<?php echo $date.'/'.$month.'/'.$year.'/'.$class_id;?>">
                            <select name="status" class="form-control" style="width:100px; float:left;">
                                <option value="0" <?php if($status == 0)echo 'selected="selected"';?>></option>
                                <option value="1" <?php if($status == 1)echo 'selected="selected"';?>>Present</option>
                                <option value="2" <?php if($status == 2)echo 'selected="selected"';?>>Absent</option>
                            </select>
                            <input type="hidden" name="student_id" 			value="<?php echo $row['student_id'];?>" />
                            <input type="hidden" name="date" 					value="<?php echo $full_date;?>" />
                            <input type="submit" class="btn btn-default" 	value="save" style="float:left; margin:0px 10px;">
                        </form>
                    </td>
				</tr>
				<?php 
			}
			?>
    </table>
</div>
</div>
<?php endif;?>