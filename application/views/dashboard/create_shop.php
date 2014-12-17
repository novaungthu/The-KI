<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Shop<small>Subheading</small></h1>
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
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
                <?php echo form_open("shop/createShop", array("class" => "form-horizontal", "role" => "form")); ?>
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">Shop Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name"  name="name" placeholder="Artigiano" value="<?php echo set_value("name", ""); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="store_type" class="col-sm-4 control-label">Store Type <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <?php foreach (json_decode(STORE_TYPE) as $key => $value): ?>
                            <label class="radio-inline">
                                <input type="radio" name="store_type" value="<?php echo $key; ?>" <?php echo set_radio("store_type", $key); ?> id="store_type"><?php echo $value; ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group hide" id="dep_store">
                    <label for="dep_store" class="col-sm-4 control-label">Department Store <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select name="dep_store" class="form-control" >
                            <option value="">Select department</option>
                            <?php foreach ($departments as $key => $value): ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price_range" class="col-sm-4 control-label">Price range<span class="text-danger">*</span></label> 
                    <div class="col-sm-8">
                        <select name="price_range" class="form-control" >
                            <option value="">Select Price Range</option>
                            <?php foreach (json_decode(PRICE_RANGE) as $key => $value): ?>
                                <option value="<?php echo $key; ?>" <?php echo set_value('price_range', '') == $key ? 'selected="selected"' : '';?>><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_online" class="col-sm-4 control-label">Is Online Store?<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="is_online" value="<?php echo YES; ?>" <?php echo set_radio("is_online", YES); ?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_online" value="<?php echo NO; ?>" <?php echo set_radio("is_online", NO, TRUE); ?>>No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="email" placeholder="customersupport@ki.com" name="email" value="<?php echo set_value("email", ""); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="style" class="col-sm-4 control-label">Style <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control" name="style">
                            <option value="">Select Style</option>
                            <?php foreach (json_decode(STYLE, true) as $style) { ?>
                                <option value="<?php echo $style; ?>" <?php echo set_value('style', '') == $style ? 'selected="selected"' : '';?>><?php echo $style; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telephone_no" class="col-sm-4 control-label">Telephone <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="telephone_no" placeholder="0161 491 4040" name="telephone_no" value="<?php echo set_value("telephone_no", ""); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_phone" class="col-sm-4 control-label">Group Phone</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="group_phone" placeholder="020 7735 8133" name="group_phone" value="<?php echo set_value("group_phone", ""); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="wesite" class="col-sm-4 control-label">Website </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="wesite"  placeholder="http://www.artigiano.co.uk/" name="website" value="<?php echo set_value("website", ""); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="memo" class="col-sm-4 control-label">Memo </label>
                    <div class="col-sm-8">
                        <textarea name="memo" class="form-control"><?php echo set_value("memo", ""); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="note" class="col-sm-4 control-label">Notes </label>
                    <div class="col-sm-8">
                        <textarea name="note" class="form-control"><?php echo set_value("note", ""); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="af_programme" class="col-sm-4 control-label">Affiliate Programme </label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="af_programme" id="af_programme" value="<?php echo YES; ?>" <?php echo set_radio("af_programme", YES) ?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="af_programme" id="af_programme" value="<?php echo NO; ?>" <?php echo set_radio("af_programme", NO, TRUE) ?>>No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mail_newsletter" class="col-sm-4 control-label">Mailing/Newsletter </label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="mail_newsletter" id="mail_newsletter" value="<?php echo YES; ?>" <?php echo set_radio("mail_newsletter", YES); ?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="mail_newsletter" id="mail_newsletter" value="<?php echo NO; ?>" <?php echo set_radio("mail_newsletter", NO, TRUE); ?>>No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-4 control-label">Shop Status <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="status" value="<?php echo ACTIVE; ?>" <?php echo set_radio("status", ACTIVE, TRUE); ?>>Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="status" value="<?php echo INACTIVE; ?>" <?php echo set_radio("status", INACTIVE) ?>>In Active
                        </label>
                    </div>
                </div>
                <h4>Shop Address</h4>
                <div class="form-group">
                    <label for="addrss_1" class="col-sm-4 control-label">Address 1 <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address_1" placeholder="Peel Ave" name="address_1" value="<?php echo set_value("address_1", ""); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address_2" class="col-sm-4 control-label">Address 2 </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address_2" placeholder="The Trafford Centre" name="address_2" value="<?php echo set_value("address_2", ""); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address_3" class="col-sm-4 control-label">Address 3 </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address_3" placeholder="" name="address_3" value="<?php echo set_value("address_3", ""); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="post_code" class="col-sm-4 control-label">Post Code <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="post_code" placeholder="M17 8JL " name="post_code" value="<?php echo set_value("post_code", ""); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="latitude" class="col-sm-4 control-label">Latitude <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="latitude" placeholder="52.394611" name="latitude" value="<?php echo set_value("latitude", ""); ?>" required>
                    </div>
                    <label for="longitude" class="col-sm-2 control-label">Longitude <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="longitude" placeholder="-81.0432789" name="longitude" value="<?php echo set_value("longitude", ""); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="region" class="col-sm-4 control-label">Region <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="region" placeholder="East" name="region" value="<?php echo set_value("region", ""); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="town" class="col-sm-4 control-label">Town <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="town" placeholder="Manchester" name="town" value="<?php echo set_value("town", ""); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="county" class="col-sm-4 control-label">County <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="county" placeholder="Trafford" name="county" value="<?php echo set_value("county", ""); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="col-sm-4 control-label">Country </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="country" placeholder="Wales" name="country" value="<?php echo set_value("country", ""); ?>"/>

                    </div>
                    </label>
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
    <!-- /.container-fluid -->
</div>
<script>
    $(function() {
        var concession = <?php echo CONCESSION; ?>;
        // default store type
        $('input[type=radio][name=store_type]').change(function() {
            toggleStoreType(this.value);
        });
        function toggleStoreType(value) {
            if (value == concession) {
                $('#dep_store').hasClass("hide") ? $('#dep_store').removeClass("hide") : "";
            } else {
                $("#dep_store").hasClass("hide") ? "" : $('#dep_store').addClass("hide");
            }
        }
    });

</script>
