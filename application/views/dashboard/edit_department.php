<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Department Store<small>Subheading</small>
                </h1>
                <!-- Error Notification-->
                <?php
                if (isset($alert) || $this->session->flashdata('alert_text')) {
                    if (isset($alert)) {
                        notificationBar($alert);
                    } else {
                        notificationBar(array('text' => $this->session->flashdata('alert_text'), 'class' => $this->session->flashdata('alert_class')));
                    }
                }
                ?>
                <p>
                    <label><span class="text-danger">*</span> Required Field.</label>
                    <label class="pull-right"><a href="<?php echo base_url() . "department/departmentList/" ?>"><i class="fa  fa-list"></i> Department Store List</label></a>
                </p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12">
                <?php echo form_open("department/edit/{$id}", array("role" => "form", "class" => "form-horizontal")); ?>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Store name<span class="text-danger">*</span></label>
                    <div class="col-sm-6" >
                        <input type="text" value="<?php echo set_value("name", $department['name']); ?>"  class="form-control col-sm-6" placeholder="Add Name " name="name" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Store status<span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                        <label class="radio-inline">
                            <input type="radio" name="status" value="<?php echo ACTIVE; ?>" <?php echo set_radio("status", ACTIVE, $department['status'] == ACTIVE ? TRUE : FALSE); ?>>Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="<?php echo INACTIVE; ?>" <?php echo set_radio("status", INACTIVE, $department['status'] == INACTIVE ? TRUE : FALSE); ?>>InActive
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info">Edit</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>