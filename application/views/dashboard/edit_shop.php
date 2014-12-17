<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-6">
            <h5>Shop's Details</h5>
            <?php echo form_open("shop/editShop/{$shop['id']}", array('class' => 'form-horizontal', 'role' => 'form')); ?>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="name-input">Name <span class="text-danger text-center">*</span></label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="name-static"><?php echo $shop['name']; ?></p>
                    <input type="text" name="name" value="<?php echo set_value("name", $shop['name']) ?>" class="form-control input-sm hide" id="name-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a  href="javascript:void(0)" onClick="return false" class="toggleDetails" id="name">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Shop Type <span class="text-danger text-center">*</span></label>
                <div class="col-sm-6">
                    <?php $store_types = json_decode(STORE_TYPE, true); ?>
                    <p class="form-control-static" id="store_type-static"><?php echo $store_types[$shop['store_type']]; ?></p>
                    <span class="hide" id="store_type-input">
                        <?php $autoCheck = explode(",", $shop['store_type']); ?>
                        <?php foreach (json_decode(STORE_TYPE) as $key => $value): ?>
                            <label class="radio-inline">
                                <input type="radio" name="store_type" id="store_type" value="<?php echo $key; ?>" <?php echo set_checkbox("store_type[]", $key, in_array($key, $autoCheck) ? TRUE : FALSE); ?>><?php echo $value; ?>
                            </label>
                        <?php endforeach; ?>
                    </span>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="store_type">Edit</a></p>
                </div>
            </div>
            <div class="form-group hide" id="dep_store_row">
                <label class="col-sm-3 control-label">Department Store <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="dep_store-static">
                        <span class=""><?php echo array_key_exists($shop['department_id'], $departments) ? $departments[$shop['department_id']] : ""; ?></span>
                    </p>
                    <div id="dep_store-input" class="hide">
                        <select name="dep_store" class="form-control input-sm" >
                            <option value="">Select department</option>
                            <?php foreach ($departments as $key => $value): ?>
                                <option value="<?php echo $key; ?>" <?php echo $key == set_value('dep_store', $shop['department_id']) ? 'selected="selected"' : "" ?>><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="dep_store">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Price Range <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <?php $price_range = json_decode(PRICE_RANGE, true); ?>
                    <p class="form-control-static" id="price_range-static">
                        <span class=""><?php echo $price_range[$shop['price_range']]; ?></span>
                    </p>
                    <div id="price_range-input" class="hide">
                        <select name="price_range" class="form-control input-sm " >
                            <option value="">Select Price Range</option>
                            <?php foreach (json_decode(PRICE_RANGE) as $key => $value): ?>
                                <option value="<?php echo $key; ?>" <?php echo set_value('price_range', $shop['price_range']) == $key ? 'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="price_range">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Is Online? <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="is_online-static">
                        <span class="<?php echo YES == $shop['is_online'] ? "text-success" : "text-danger" ?>"><?php echo YES == $shop['is_online'] ? "Yes" : "No"; ?></span>
                    </p>
                    <div id="is_online-input" class="hide">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="is_online" value="<?php echo YES; ?>" <?php echo set_radio("is_online", YES, $shop['is_online'] == YES ? TRUE : FALSE); ?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="is_online" value="<?php echo NO; ?>" <?php echo set_radio("is_online", NO, $shop['is_online'] == NO ? TRUE : FALSE); ?>>No
                        </label>
                    </div>
                </div>
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="is_online">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Email <span class="text-danger text-center">*</span></label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="email-static"><?php echo $shop['email']; ?></p>
                    <input type="text" name="email" value="<?php echo set_value("email", $shop['email']) ?>" class="form-control input-sm hide" id="email-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="email">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Telephone <span class="text-danger text-center">*</span></label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="telephone-static"><?php echo $shop['telephone_no']; ?></p>
                    <input type="text" name="telephone_no" value="<?php echo set_value("telephone_no", $shop['telephone_no']) ?>" class="form-control input-sm hide" id="telephone-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="telephone">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Group Phone</label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="group_phone-static"><?php echo $shop['group_phone']; ?></p>
                    <input type="text" name="group_phone" value="<?php echo set_value("group_phone", $shop['group_phone']) ?>" class="form-control input-sm hide" id="group_phone-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="group_phone">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Website</label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="website-static"><?php echo $shop['website']; ?></p>
                    <input type="text" name="website" value="<?php echo set_value("website", $shop['website']) ?>" class="form-control input-sm hide" id="website-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="website">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Memo</label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="memo-static"><?php echo $shop['memo']; ?></p>
                    <textarea name="memo" class="form-control input-sm hide" id="memo-input"><?php echo set_value("memo", $shop['memo']); ?></textarea>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="memo">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Notes</label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="note-static"><?php echo $shop['note']; ?></p>
                    <textarea name="note" class="form-control input-sm hide" id="note-input"><?php echo set_value("note", $shop['note']); ?></textarea>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="note">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Affiliate Programme</label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="af_programme-static">
                        <span class="<?php echo YES == $shop['affiliate_programme'] ? "text-success" : "text-danger" ?>"><?php echo YES == $shop['affiliate_programme'] ? "Yes" : "No"; ?></span>
                    </p>
                    <div id="af_programme-input" class="hide">
                        <label class="radio-inline">
                            <input type="radio" name="af_programme" id="af_programme" value="<?php echo YES; ?>" <?php echo set_radio("af_programme", YES, $shop['affiliate_programme'] == YES ? TRUE : FALSE) ?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="af_programme" id="af_programme" value="<?php echo NO; ?>" <?php echo set_radio("af_programme", NO, $shop['affiliate_programme'] == NO ? TRUE : FALSE) ?>>No
                        </label>
                    </div>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="af_programme">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Mailing/Newsletter</label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="mail_newsletter-static">
                        <span class="<?php echo YES == $shop['newsletter'] ? "text-success" : "text-danger" ?>"><?php echo YES == $shop['newsletter'] ? "Yes" : "No"; ?></span>
                    </p>
                    <div id="mail_newsletter-input" class="hide">
                        <label class="radio-inline">
                            <input type="radio" name="mail_newsletter" id="mail_newsletter" value="<?php echo YES; ?>" <?php echo set_radio("mail_newsletter", YES, $shop['newsletter'] == YES ? TRUE : FALSE); ?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="mail_newsletter" id="mail_newsletter" value="<?php echo NO; ?>" <?php echo set_radio("mail_newsletter", NO, $shop['newsletter'] == NO ? TRUE : FALSE); ?>>No
                        </label>
                    </div>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="mail_newsletter">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="status-static">
                        <span class="<?php echo ACTIVE == $shop['status'] ? "text-success" : "text-danger" ?>"><?php echo ACTIVE == $shop['status'] ? "Active" : "InActive"; ?></span>
                    </p>
                    <div id="status-input" class="hide">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="status" value="<?php echo ACTIVE; ?>" <?php echo set_radio("status", YES, $shop['status'] == ACTIVE ? TRUE : FALSE); ?>>Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="status" value="<?php echo INACTIVE; ?>" <?php echo set_radio("status", NO, $shop['status'] == INACTIVE ? TRUE : FALSE); ?>>InActive
                        </label>
                    </div>
                </div>
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleDetails" id="status">Edit</a></p>
                </div>
            </div>
            <div class="form-group hide" id="btn-toggleDetails">
                <div class="col-sm-offset-3 col-sm-8">
                    <button type="submit" class="btn btn-info">Edit</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>
            <hr>
            <div class="clear"></div>
            <h5>Shop's Address
                <?php if (!empty($shop['latitude']) && !empty($shop['longitude'])) { ?>
                    <span><a href="javascript:void(0)" onClick="return false" data-target="#showMapModal"data-toggle="modal" class="pull-right"><i class="fa fa-map-marker"></i>&nbsp;Shop Location</a></span>
                <?php } ?>
            </h5>
            <div class="form-group">
                <label class="col-sm-3 control-label">Address 1</label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="address_1-static"><?php echo $shop['address_1']; ?></p>
                    <input type="text" name="address_1" value="<?php echo set_value("address_1", $shop['address_1']) ?>" class="form-control input-sm hide" id="address_1-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleAddress" id="address_1">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Address 2</label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="address_2-static"><?php echo $shop['address_2']; ?></p>
                    <input type="text" name="address_2" value="<?php echo set_value("address_2", $shop['address_2']) ?>" class="form-control input-sm hide" id="address_2-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleAddress" id="address_2">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Address 3</label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="address_3-static"><?php echo $shop['address_3']; ?></p>
                    <input type="text" name="address_3" value="<?php echo set_value("address_3", $shop['address_3']) ?>" class="form-control input-sm hide" id="address_3-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleAddress" id="address_3">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Lat, Long <span class="text-danger">*</span></label>
                <div class="col-sm-3">
                    <p class="form-control-static" id="latitude-static"><?php echo $shop['latitude']; ?></p>
                    <input type="text" name="latitude" value="<?php echo set_value("latitude", $shop['latitude']) ?>" class="form-control input-sm hide" id="latitude-input"/>
                </div> 
                <div class="col-sm-3">
                    <p class="form-control-static" id="longitude-static"><?php echo $shop['longitude']; ?></p>
                    <input type="text" name="longitude" value="<?php echo set_value("longitude", $shop['longitude']) ?>" class="form-control input-sm hide" id="longitude-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleAddress" id="latitude">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Post Code <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="post_code-static"><?php echo $shop['post_code']; ?></p>
                    <input type="text" name="post_code" value="<?php echo set_value("post_code", $shop['post_code']) ?>" class="form-control input-sm hide" id="post_code-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleAddress" id="post_code">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Region <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="region-static"><?php echo $shop['region']; ?></p>
                    <input type="text" name="region" value="<?php echo set_value("region", $shop['region']) ?>" class="form-control input-sm hide" id="region-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleAddress" id="region">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Town <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="town-static"><?php echo $shop['town']; ?></p>
                    <input type="text" name="town" value="<?php echo set_value("town", $shop['town']) ?>" class="form-control input-sm hide" id="town-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleAddress" id="town">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">County <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="county-static"><?php echo $shop['county']; ?></p>
                    <input type="text" name="county" value="<?php echo set_value("county", $shop['county']) ?>" class="form-control input-sm hide" id="county-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleAddress" id="county">Edit</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Country</label>
                <div class="col-sm-6">
                    <p class="form-control-static" id="country-static"><?php echo $shop['country']; ?></p>
                    <input type="text" name="country" value="<?php echo set_value("country", $shop['country']) ?>" class="form-control input-sm hide" id="country-input"/>
                </div> 
                <div class="col-sm-3 pull-right">
                    <p class="form-control-static"><a href="javascript:void(0)" onClick="return false" class="toggleAddress" id="country">Edit</a></p>
                </div>
            </div>
            <div class="form-group hide" id="btn-toggleAddress">
                <div class="col-sm-offset-3 col-sm-8">
                    <button type="submit" class="btn btn-info">Edit</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="col-lg-6">
            <h5>Shop's Special Services<a class="pull-right" href="javascript:void(0)" onClick="return false" id="addService">&nbsp;Add Service</a></h5>
            <!-- Shop List-->
            <?php echo form_open("shop/createService/{$shop['id']}/", array("role" => 'form', "class" => "form-horizontal")); ?>
            <?php if (array_key_exists("shopServices", $shop) && count($shop["shopServices"])) { ?>
                <?php foreach ($shop["shopServices"] as $service): ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <p class="form-control-static" id="service_<?php echo $service['id'] ?>-static"><?php echo $service['review_description']; ?></p>
                            <textarea name="description_<?php echo $service['id']; ?>" class="form-control input-sm hide" id="service_<?php echo $service['id']; ?>-input"><?php echo $service['review_description']; ?></textarea>
                        </div> 
                        <div class="col-sm-3">
                            <a href="javascript:void(0)" onClick="return false" class="toggleService" id="service_<?php echo $service['id']; ?>">Edit</a>
                            <button type="submit" class="btn btn-info btn-sm hide" id="btn-service_<?php echo $service['id']; ?>" name="editService" value="<?php echo $service['id']; ?>">Edit</button>
                            <a href="javascript:void(0)" onClick="return false" class="deleteService text-danger" id="service_<?php echo $service['id']; ?>">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } ?>
            <div id="addServiceForm" class="hide">
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <textarea type="text" name="description" value="<?php echo set_value("description", "") ?>" class="form-control input-sm" id="country-input"></textarea>
                    </div> 
                    <div class="col-sm-3 pull-right">
                        <button class="btn btn-success btn-sm" name="createService">Create</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <hr />
            <div class="clearfix"></div>
            <h5>Shop's Review<a class="pull-right" href="javascript:void(0)" onClick="return false" id="addReview">&nbsp;Add Review</a></h5>
            <!-- Review List -->
            <?php echo form_open("shop/createReview/{$shop['id']}/", array("role" => 'form', "class" => "form-horizontal")); ?>
            <?php if (array_key_exists("shopReviews", $shop) && count($shop['shopReviews'])): ?>
                <?php foreach ($shop['shopReviews'] as $review): ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <p class="form-control-static" id="review_<?php echo $review['id']; ?>-static"><?php echo $review['review_description']; ?></p>
                            <textarea  name="description_<?php echo $review['id'] ?>" class="form-control input-sm hide" id="review_<?php echo $review['id'] ?>-input"><?php echo set_value("description", $review['review_description']) ?></textarea>
                        </div> 
                        <div class="col-sm-3 pull-right">
                            <a href="javascript:void(0)" onClick="return false" class="toggleReview" id="review_<?php echo $review['id']; ?>">Edit</a>
                            <button type="submit" class="btn btn-info btn-sm hide" id="btn-review_<?php echo $review['id']; ?>" name="editReview" value="<?php echo $review['id']; ?>">Edit</button>
                            <a href="javascript:void(0)" onClick="return false" class="toggleReview text-danger" id="review_<?php echo $review['id']; ?>">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div id="addReviewForm" class="hide">
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <textarea  name="description"  class="form-control input-sm" id="country-input"><?php echo set_value("description", "") ?></textarea>
                    </div> 
                    <div class="col-sm-3 pull-right">
                        <button class="btn btn-success btn-sm">Create</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <hr />
            <div class="clearfix"></div>
            <h5>Shop's Schedule</h5>
            <?php showShopSchedule($shop['shopSchedules']); ?>
            <?php echo form_open("shop/createSchedule/{$shop['id']}", array("class" => "form-horizontal", "role" => "form")); ?>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="radio-inline">
                        <input type="radio" name="schedule_type" id="dateSelect" value="<?php echo DATE_RANGE; ?>" <?php echo set_radio("schedule_type", DATE_RANGE, TRUE); ?>>Date Range
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="schedule_type" id="dateSelect" value="<?php echo ALL_DAY; ?>" <?php echo set_radio("schedule_type", ALL_DAY); ?>>All Day
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="schedule_type" id="dateSelect" value="<?php echo EACH_DAY; ?>" <?php echo set_radio("schedule_type", EACH_DAY) ?>>Each Day
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="schedule_type" id="dateSelect" value="<?php echo SP_DATE; ?>" <?php echo set_radio("schedule_type", SP_DATE); ?>>Specific Date
                    </label>
                </div>
            </div>
            <div class="form-group form-group-sm" id="dateRange">
                <div class="col-sm-3">
                    <input type="text"  name="start_date" value="<?php echo set_value("start_date", ""); ?>" class="form-control col-sm-3 input-sm date start" placeholder="12/01/2014">
                </div>
                <div class="col-sm-3">
                    <input type="text"  name="start_time" value="<?php echo set_value("start_time", ""); ?>" class="form-control col-sm-3 input-sm time start ui-timepicker-input" placeholder="1:00am">
                </div>
                <div class="col-sm-3">
                    <input type="text"  name="end_date" value="<?php echo set_value("end_date", ""); ?>" class="form-control col-sm-3 input-sm date end" placeholder="5/9/2015">
                </div>
                <div class="col-sm-3">
                    <input type="text"  name="end_time" value="<?php echo set_value("end_time", ""); ?>" class="form-control col-sm-3 input-sm time end ui-timepicker-input" placeholder="4:00pm">
                </div>
            </div>
            <div class="form-group form-group-sm">
                <div class="col-sm-3 hide" id="dateOnly">
                    <input type="text"  class="form-control col-sm-3 input-sm date" placeholder="12/01/2014" name="sp_date" value="<?php echo set_value("sp_date", ""); ?>">
                </div>
                <div id="timeRange" class="hide">
                    <div class="col-sm-3">
                        <input type="text"  class="form-control col-sm-3 input-sm time start ui-timepicker-input" placeholder="1:00am" name="sp_start_time" value="<?php echo set_value("sp_start_time", ""); ?>">
                    </div>
                    <label class="control-label col-sm-1">To</label>
                    <div class="col-sm-3">
                        <input type="text"  class="form-control col-sm-3 input-sm time end ui-timepicker-input" placeholder="1:00am" name="sp_end_time" value="<?php echo set_value("sp_end_time", ""); ?>">
                    </div>
                </div>
            </div>

            <div class="form-group form-group-sm hide" id="checkDate">
                <div class="col-sm-12">
                    <?php foreach (json_decode(DAYS) as $key => $value): ?>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="check_date[]" value="<?php echo $key; ?>" <?php echo set_checkbox("check_date[]", $key); ?>><?php echo $value; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group hide" id="radioDate">
                <div class="col-sm-12">
                    <?php foreach (json_decode(DAYS) as $key => $value): ?>
                        <label class="radio-inline">
                            <input type="radio" name="radio_date" value="<?php echo $key ?>"><?php echo $value; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <textarea name="note" class="form-control"><?php echo set_value("note", ""); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success">Create</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
    $(function() {
        var concession = <?php echo CONCESSION; ?>;
        var store_type = <?php echo set_value("store_type", $shop['store_type']); ?>;
        if (store_type == concession) {
               $('#dep_store').hasClass("hide") ? "" : $('#dep_store').removeClass("hide");
                $('#dep_store_row').hasClass("hide") ? $('#dep_store_row').removeClass("hide") : "";
                $('#dep_store-static').hasClass("hide") ? $('#dep_store-static').removeClass("hide") : "";
        }

        // default store type
        $('input[type=radio][name=store_type]').change(function() {
            toggleStoreType(this.value);
        });
        function toggleStoreType(value) {
            if (value == concession) {
                $('#dep_store').hasClass("hide") ? "" : $('#dep_store').addClass("hide");
                $('#dep_store_row').hasClass("hide") ? $('#dep_store_row').removeClass("hide") : "";
                $('#dep_store-static').hasClass("hide") ? "" : $('#dep_store-static').addClass("hide");
                $('#dep_store-input').hasClass("hide") ? $('#dep_store-input').removeClass("hide") : "";
            } else {
                $("#dep_store_row").hasClass("hide") ? "" : $('#dep_store').addClass("hide");
            }
        }
    });

</script>
