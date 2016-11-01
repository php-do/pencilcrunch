<?php 
$edit_data		=	$this->db->get_where('transport' , array('transport_id' => $param2) )->result_array();

?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?admin/transport/do_update/'.$row['transport_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('route_name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="route_name" value="<?php echo $row['route_name'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('number_of_vehicle');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="number_of_vehicle" value="<?php echo $row['number_of_vehicle'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('route_fare');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="route_fare" value="<?php echo $row['route_fare'];?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_transport');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>