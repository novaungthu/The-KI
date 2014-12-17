<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $category['name']; ?> <small></small> </h1>
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
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6">
                    <h5>Category's Details</h5>
                    <?php echo form_open("category/editCategory/{$category['shop_id']}/{$category['id']}", array('class' => 'form-horizontal', 'role' => 'form')); ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name-input">Name <span class="text-danger text-center">*</span></label>
                        <div class="col-sm-6">
                            <p class="form-control-static" id="name-static"><?php echo $category['name']; ?></p>
                            <input type="text" name="name" value="<?php echo set_value("name", $category['name']) ?>" class="form-control input-sm hide" id="name-input"/>
                        </div> 
                        <div class="col-sm-3 pull-right">
                            <p class="form-control-static"><a onClick="return false" class="toggleDetails" id="name">Edit</a></p>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name-input">Main Category <span class="text-danger text-center">*</span></label>
                        <div class="col-sm-6">
                            <p class="form-control-static" id="main_category-static"><?php echo $category['main_category_name']; ?></p>
                            <?php echo form_dropdown("main_category", $mainCategories, set_value("main_category", $category['main_id']), 'class="form-control input-sm hide" id="main_category-input" required') ?>
                        </div> 
                        <div class="col-sm-3 pull-right">
                            <p class="form-control-static"><a onClick="return false" class="toggleDetails" id="main_category">Edit</a></p>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name-input">Brand </label>
                        <div class="col-sm-6">
                            <p class="form-control-static" id="brand-static"><?php echo $category['brand_name']; ?></p>
                            <?php echo form_dropdown("brand", $brands, set_value("brand", $category['brand_id']), 'class="form-control input-sm hide" id="brand-input"') ?>
                        </div> 
                        <div class="col-sm-3 pull-right">
                            <p class="form-control-static"><a onClick="return false" class="toggleDetails" id="brand">Edit</a></p>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <p class="form-control-static" id="status-static">
                                <span class="<?php echo ACTIVE == $category['status'] ? "text-success" : "text-danger" ?>"><?php echo ACTIVE == $category['status'] ? "Active" : "InActive"; ?></span>
                            </p>
                            <div id="status-input" class="hide">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="<?php echo ACTIVE; ?>" <?php echo set_radio("status", YES, $category['status'] == ACTIVE ? TRUE : FALSE); ?>>Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="<?php echo INACTIVE; ?>" <?php echo set_radio("status", NO, $category['status'] == INACTIVE ? TRUE : FALSE); ?>>InActive
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 pull-right">
                            <p class="form-control-static"><a onClick="return false" class="toggleDetails" id="status">Edit</a></p>
                        </div>
                    </div>
                    <div class="form-group hide" id="btn-toggleDetails">
                        <div class="col-sm-offset-3 col-sm-8">
                            <button type="submit" class="btn btn-info">Edit</button>
                            <button type="reset" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="col-lg-6">
                    <h5>Category's Features</h5>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        // Shop Details
        $(".toggleDetails, .toggleAddress, .toggleService, .toggleReview").click(function() {
            var id = $(this).attr('id');
            var cl = $(this).attr('class');
            // hide static
            $('#' + id + "-static").hide();
            // show input
            $('#' + id + "-input").removeClass("hide");
            $("#" + id + "-input").focus();
            // hide edit button
            $("#btn-" + cl).removeClass("hide");
            $(this).hide();


        });
    });
</script>