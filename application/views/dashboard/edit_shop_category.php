<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Shop List <small>Subheading</small>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php echo form_open("", array("role" => "form", "class" => "form-horizontal")); ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Category Name <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" name="name" value="<?php echo set_value("name", $category['name']) ?>" placeholder="" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="af_programme" value="<?php echo YES; ?>" <?php echo set_radio("status", YES, $category['status'] == YES ? TRUE : "")?>> Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="af_programme" value="<?php echo INACTIVE; ?>" <?php echo set_radio("status", NO, $category["status"] == INACTIVE ? TRUE : "")?>> InActive
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Price Point</label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="af_programme" id="af_programme" value="<?php echo YES; ?>" > Under 50
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="af_programme" id="af_programme" value="<?php echo NO; ?>" > Under 100
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="af_programme" id="af_programme" value="<?php echo NO; ?>" > Over 100
                        </label>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Category Type</label>
                    <div class="col-sm-3">
                        <select name="" class="form-control col-sm-3">
                            <?php foreach(json_decode(CLOTH_TYPE, TRUE) as $cloth):?>
                            <option><?php echo $cloth;?></option>
                        <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Category Size</label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="af_programme" id="af_programme" value="<?php echo YES; ?>" >Fixed Size
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="af_programme" id="af_programme" value="<?php echo NO; ?>" > Range Size
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">(Cloth) Size</label>
                    <div class="col-sm-2">
                        <select name="" class="form-control">
                            <option>Petite</option>
                            <option>Tall</option>
                        </select>
                    </div>
                    <label class="col-sm-1 control-label">Start</label>
                    <div class="col-sm-2">
                        <?php echo form_dropdown("start_size", json_decode(CLOTH_SIZE, true), "",'class="form-control"');?>
                    </div>
                    <label class="col-sm-1 control-label">End</label>
                    <div class="col-sm-2">
                        <?php echo form_dropdown("start_size", json_decode(CLOTH_SIZE, true), "",'class="form-control"');?>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-3 control-label">(Lingerie) Size</label>
                   <div class="col-sm-2">
                        <?php echo form_dropdown("start_size", json_decode(LINGERIE_SIZE_1, true), "",'class="form-control"');?>
                    </div>
                    <div class="col-sm-2">
                        <?php echo form_dropdown("start_size", json_decode(LINGERIE_SIZE_2, true), "",'class="form-control"');?>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-3 control-label">(Jewellery) Size</label>
                   <div class="col-sm-2">
                        <?php echo form_dropdown("start_size", json_decode(JEWELLERY_SIZE, true), "",'class="form-control"');?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">(Shoe) Size</label>
                   <div class="col-sm-2">
                        <?php echo form_dropdown("start_size", json_decode(SHOE_SIZE_1, true), "",'class="form-control"');?>
                    </div>
                    <div class="col-sm-2">
                        <?php echo form_dropdown("start_size", json_decode(SHOE_SIZE_2, true), "",'class="form-control"');?>
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-sm-3 control-label">Note</label>
                    <div class="col-sm-3">
                        <textarea name="note" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>