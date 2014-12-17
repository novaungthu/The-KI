<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category<small>Subheading</small>
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
                    <label class="pull-right"><a href="<?php echo base_url() . "category/categoryList/{$shop_id}" ?>"><i class="fa  fa-list"></i> Category List</label></a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <?php echo form_open("category/createCategory/{$shop_id}", array("class" => "form-horizontal", "role" => "form")); ?>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Category Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" value="<?php echo set_value("name", ""); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="main_category" class="col-sm-4 control-label">Main Category <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <?php echo form_dropdown("main_category", $mainCategories, set_value("main_category", ""), 'class="form-control" id="main_category" required') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="brand" class="col-sm-4 control-label">Brand </label>
                    <div class="col-sm-8">
                        <?php echo form_dropdown("brand", $brands, set_value("brand", ""), 'class="form-control" id="brands"') ?>
                        <span class='help-block'><a href="<?php echo base_url() . "brand/createBrand/" ?>"><i class="fa fa-plus"></i>&nbsp;Add New brand</a></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-4 control-label">Status <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="status" value="<?php echo ACTIVE; ?>" <?php echo set_radio("status", ACTIVE, TRUE); ?>>Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="status" value="<?php echo INACTIVE; ?>" <?php echo set_radio("status", INACTIVE); ?>>In Active
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