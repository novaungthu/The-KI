<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Update Profile<small>Subheading</small> </h1>
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
                </p>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-8">
                <?php echo form_open("user/updateProfile/", array("class" => "form-horizontal", "role" => "form")); ?>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">User Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" placeholder="User Name" value="<?php echo set_value("name", $user['user_name']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">Email<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="email" name="email" placeholder="xxx@gmail.com" value="<?php echo set_value("email", $user['email']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-4 control-label">User Status<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="status" value="<?php echo ACTIVE; ?>" <?php echo set_radio("status", ACTIVE, ACTIVE == $user['status'] ? TRUE : FALSE); ?>>Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="status" value="<?php echo INACTIVE; ?>" <?php echo set_radio("status", INACTIVE, INACTIVE == $user['status'] ? TRUE : FALSE); ?>>In Active
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <p id="wrap-pwd-link" class="<?php echo 1 == $pwd_change_request ? 'hide' : '' ?>"><a href="#">Change Password</a></p>    
                    </div>
                </div>

                <span id="wrap-pwd" class="<?php echo 1 == $pwd_change_request ? '' : 'hide' ?>">
                    <div class="form-group">
                        <label for="cur_pasword" class="col-sm-4 control-label">Current Pasword : <span class="mandatory">*</span></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" placeholder="Current Password" name="cur_password" value="<?php echo set_value('cur_password', ''); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Password : <span class="mandatory">*</span></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php echo set_value('password', ''); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="con_password" class="col-sm-4 control-label">Confirm Password : <span class="mandatory">*</span></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="con_password" placeholder="Confirm Password" name="con_password" value="<?php echo set_value('con_password', ''); ?>">
                        </div>
                    </div>
                </span>      
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-info">Update</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#wrap-pwd-link').click(function(e) {
                e.preventDefault();
                $('#wrap-pwd-link').hide();
                $('#wrap-pwd').show();
                $('#wrap-pwd').removeClass('hide');
            });
        });
    </script>