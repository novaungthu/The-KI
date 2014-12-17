<div class="row">
    <div class="col-lg-12">
        <?php echo form_open("shop/addCategory/{$shop['id']}/", array("role" => "form", "class" => "form-horizontal")); ?>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Category Name(s) <span class="mandatory">*</span></label>
            <div class="col-sm-6" >
                <select name="category[]" multiple="multiple" class="form-control" data-placeholder="Select category(s)" style="width:400px;">
                   <?php foreach($categoryList as $key => $value){?>
                   <option value="<?php echo $key;?>"><?php echo $value;?></option>
                   <?php }?>
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
    <?php if (isset($shop['categories']) && count($shop['categories'])) { ?>
        <div class="col-lg-12">
            <table class="table table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Size Description</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    <?php foreach ($shop['categories'] as $category) { ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo $category['name']; ?></td>
                            <td><?php ?></td>
                            <td><?php echo showShopCategorySize($category);?></td>
                            <td align="center"><i class="<?php echo $category['status'] == ACTIVE ? "fa fa-check text-success" : "fa fa-times-circle text-danger"?>"></i></td>
                            <td><?php echo faceBookTimeStamp($category['created_date']); ?></td>
                            <td align="center"><a class="btn btn-sm btn-info" href="<?php echo base_url() . "shop/editCategory/{$category['id']}" ?>" data-toggle="modal" data-target="#editCategoryModal">Edit</a></td>
                        </tr>
                        <?php $index +=1;
                    } ?>
                </tbody>
            </table>
        </div>
<?php } ?>
</div>