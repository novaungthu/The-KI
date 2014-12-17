<div class="row">
    <div class="col-lg-12">
        <?php echo form_open("shop/addBrand/{$shop['id']}/", array("role" => "form", "class" => "form-horizontal")); ?>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Brand Name(s)<span class="mandatory">*</span></label>
            <div class="col-sm-7" >
                <select name="brands[]"  multiple="" class="form-control">
                    <option value="">Select brand(s).</option>
                    <?php foreach ($brandList as $key => $value) { ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-success">Add</button>
                <button type="reset" class="btn btn-default">Cancel</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12">
        <?php if (isset($shop['brands']) && count($shop['brands'])) { ?>
            <table class="table table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    <?php foreach ($shop['brands'] as $brand) { ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo $brand['name']; ?></td>
                            <td><a class="text text-danger" href="">Remove</a></td>
                        </tr>
                        <?php $index +=1;
                    }
                    ?>
                </tbody>
            </table>
<?php } ?>
    </div>
</div>