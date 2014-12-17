<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Brand<small>Subheading</small>
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
                    <label class="pull-right"><a href="<?php echo base_url()."brand/brandList/"?>"><i class="fa  fa-list"></i> Brand List</label></a>
                </p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
                <?php echo form_open("brand/createBrand", array("class" => "form-horizontal", "role" => "form")); ?>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Brand Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" placeholder="ABNEGATION" value="<?php echo set_value("name", $brand['name']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="brand_type" class="col-sm-4 control-label">Brand Type <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="brand_type" name="brand_type" placeholder="T-shirt Plus Size" value="<?php echo set_value("brand_type", $brand['brand_type']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="col-sm-4 control-label">Country </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="country" name="country" placeholder="UK" value="<?php echo set_value("country", $brand['country']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_designer" class="col-sm-4 control-label">Is Designer's Brand? <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="is_designer" id="is_designer" value="<?php echo YES;?>" <?php echo set_radio("is_designer", YES, $brand['is_designer'] == YES ? TRUE : FALSE);?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_designer" id="is_designer" value="<?php echo NO;?>" <?php echo set_radio("is_designer", NO, $brand['is_designer'] == NO ? TRUE : FALSE);?>>No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-4 control-label">Brand Status</label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="status" value="<?php echo ACTIVE; ?>"<?php echo set_radio("status", ACTIVE, TRUE);?>>Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="status" value="<?php echo INACTIVE; ?>" <?php echo set_radio("status", INACTIVE);?>>In Active
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>