<div class="modal-header">
    <h4>Edit Category</h4>
</div>    
<?php echo form_open("shop/editCategory/{$category['id']}", array("role" => "form", 'class' => 'form-horizontal', "id" => "editCategoryForm")); ?>
<?php echo form_hidden("name", $category['name']); ?>
<div class="modal-body">
    <div class="alert alert-danger hide" role="alert" id="category-error-wrapper">
        <span class="sr-only">Error:</span>
        <span id="category-error-msg"></span>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Name: </label>
        <div class="col-sm-9">
            <p class="form-control-static"><?php echo $category['name']; ?></p>
        </div>
    </div>
    <?php if (stripos($category['name'], "jewellery") !== false) { ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Size: <span class="text-danger">*</span></label>
            <div class="col-sm-2">
                <select name="jewellery_size[]" class="form-control" multiple="multiple">
                    <?php foreach (json_decode(JEWELLERY_SIZE) as $value): ?>
                        <option value="<?php echo $value; ?>" <?php echo stripos($category['start_size'], $value) !== FALSE ? 'selected="selected"' : "";?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php } else if (stripos($category['name'], "shoe") !== false) { ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Size: <span class="text-danger">*</span></label>
            <div class="col-sm-2">
                <select name="shoe_size_1[]" class="form-control" multiple="multiple">
                    <?php foreach (json_decode(SHOE_SIZE_1) as $value): ?>
                        <option value="<?php echo $value; ?>" <?php echo stripos($category['start_size'], $value) !== FALSE? 'selected="selected"' : "";?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-2">
                <select name="shoe_size_2[]" class="form-control" multiple="multiple">
                    <?php foreach (json_decode(SHOE_SIZE_2) as $value): ?>
                        <option value="<?php echo $value; ?>" <?php echo stripos($category['other_size'], $value) !== FALSE ? 'selected="selected"' : "";?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php } else if (stripos($category['name'], "lingerie") !== false) { ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Size: <span class="text-danger">*</span></label>
            <div class="col-sm-2">
                <select name="lingerie_size_1[]" class="form-control" multiple="multiple">
                    <?php foreach (json_decode(LINGERIE_SIZE_1) as $value): ?>
                        <option value="<?php echo $value; ?>" <?php echo stripos($category['start_size'], $value) !== FALSE ? 'selected="selected"' : "";?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-2">
                <select name="lingerie_size_2[]" class="form-control" multiple="multiple">
                    <?php foreach (json_decode(LINGERIE_SIZE_2) as $value): ?>
                        <option value="<?php echo $value; ?>" <?php echo stripos($category['other_size'], $value) !== FALSE ? 'selected="selected"' : "";?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php } else { ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Start Size: <span class="text-danger">*</span></label>
            <div class="col-sm-2">
                <select name="start_size" class="form-control">
                    <?php foreach (json_decode(CLOTH_SIZE) as $value): ?>
                        <option value="<?php echo $value; ?>" <?php echo $category['start_size'] == $value ? 'selected="selected"' : "";?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label class="col-sm-3 control-label">End Size: <span class="text-danger">*</span></label>
            <div class="col-sm-2">
                <select name="end_size" class="form-control">
                    <?php foreach (json_decode(CLOTH_SIZE) as $value): ?>
                        <option value="<?php echo $value; ?>" <?php echo $category['end_size'] == $value ? 'selected="selected"' : "";?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    
        <div class="form-group">
            <label class="col-sm-3 control-label">Petite/Tall: <span class="text-danger">*</span></label>
            <label class="radio-inline col-sm-2">
                <input type="checkbox" name="petite[]"  value="Petite" <?php echo stripos($category['petite'], 'Petite') !== FALSE? 'checked="checked"' : "";?>> Petite
                <input type="checkbox" name="petite[]"  value="Tall" <?php echo stripos($category['petite'], 'Tall') !== FALSE ? 'checked="checked"' : "";?>> Tall
            </label>
        </div>
    <?php } ?>
    <div class="form-group">
        <label class="col-sm-3 control-label">Status: <span class="text-danger">*</span></label>
        <label class="radio-inline">
            <input type="radio" name="status" id="status" value="<?php echo ACTIVE; ?>" <?php echo set_radio("status", YES, $category['status'] == ACTIVE ? TRUE : FALSE); ?>>Active
        </label>
        <label class="radio-inline">
            <input type="radio" name="status" id="status" value="<?php echo INACTIVE; ?>" <?php echo set_radio("status", NO, $category['status'] == INACTIVE ? TRUE : FALSE); ?>>InActive
        </label>
    </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Create</button>
</div>
<?php echo form_close(); ?>