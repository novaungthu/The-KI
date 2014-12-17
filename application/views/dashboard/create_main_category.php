<div class="modal-header">
    <h4>Create new main category</h4>
</div>    
<?php echo form_open($url, array("role" => "form", "id" => "createMainCategory")); ?>
<div class="modal-body">
    <div class="alert alert-danger hide" role="alert" id="error-wrapper">
        <span class="sr-only">Error:</span>
        <span id="error-msg"></span>
    </div>
    <div class="form-group">
        <label for="name" class="control-label">Name: <span class="text-danger">*</span></label>
        <input type="text" class="form-control"  name="name" value="<?php echo set_value("name", array_key_exists("name", $category) ? $category['name'] : ""); ?>" required="">
    </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Create</button>
</div>
<?php echo form_close(); ?>