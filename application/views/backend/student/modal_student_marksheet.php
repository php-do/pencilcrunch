<?php
	$student_info	=	$this->crud_model->get_student_info($param2);
	foreach($student_info as $row1):
?>
<center>
	<div style="font-size: 20px;font-weight: 200;margin: 10px;"><?php echo $row1['name'];?></div>

<div class="panel-group joined" id="accordion-test-2">

	<?php 
	/////SEMESTER WISE RESULT, RESULTSHEET FOR EACH SEMESTER SEPERATELY
	$toggle = true;
	$exams	=	$this->crud_model->get_exams();
	foreach($exams as $row0):
							
	$total_grade_point	=	0;
	$total_marks		=	0;
	$total_subjects		=	0;
	?>
    <div class="panel panel-default">
            <div class="panel-heading">
            		<h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapse<?php echo $row0['exam_id'];?>">
                    <i class="entypo-rss"></i>  <?php echo $row0['name'];?>
                </a>
                </h4>
            </div>
            
            
    
        <div id="collapse<?php echo $row0['exam_id'];?>" class="panel-collapse collapse <?php if($toggle){echo 'in';$toggle=false;}?>" >
            <div class="panel-body">
            <center>
              <table class="table table-bordered " >
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Obtained marks</th>
                            <th>Highest mark</th>
                            <th>Grade</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $subjects	=	$this->crud_model->get_subjects_by_class($row1['class_id']);
                        foreach($subjects as $row2):
                        $total_subjects++;
                        ?>
                        <tr>
                            <td><?php echo $row2['name'];?></td>
                            <td>
                                <?php
                                //obtained marks
                                $verify_data	=	array(	'exam_id' => $row0['exam_id'] ,
                                                    'class_id' => $row1['class_id'] ,
                                                    'subject_id' => $row2['subject_id'] , 
                                                    'student_id' => $row1['student_id']);
                                                    
                                $query = $this->db->get_where('mark' , $verify_data);							 
                                $marks	=	$query->result_array();
                                foreach($marks as $row3):
                                    echo $row3['mark_obtained'];
                                    $total_marks	+=	$row3['mark_obtained'];
                                endforeach;
                                ?>
                            </td>
                            <td>
                                <?php
                                //highest marks
                                $verify_data	=	array(	'exam_id' => $row0['exam_id'] ,
                                                    'subject_id' => $row2['subject_id']);
                                $this->db->select_max('mark_obtained' , 'mark_highest');
                                $query = $this->db->get_where('mark' , $verify_data);							 
                                $marks	=	$query->result_array();
                                foreach($marks as $row4):echo $row4['mark_highest'];endforeach;
                                ?>
                            </td>
                            <td>
                                <?php 
                                $grade	=	$this->crud_model->get_grade($row3['mark_obtained']);
                                echo $grade['name'];
                                $total_grade_point	+=	$grade['grade_point'];
                                ?>
                            </td>
                            <td></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <hr />
                Total Marks : <?php	echo $total_marks;?>
                <hr />
                GPA(grade point average) : <?php echo round($total_grade_point/$total_subjects , 2);?>
            </center>
            </div>
      	</div>
    </div>
    <?php endforeach;?>
  </div>
</center>
<?php endforeach;?>