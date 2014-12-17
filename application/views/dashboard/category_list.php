<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ahernes <small>( Cateogry List )</small>
                </h1>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <div class="pull-right">
                    <?php echo form_open("category/search/", array('class' => 'form-inline', 'role' => 'form')); ?>
                    <?php echo form_hidden("url", "category/categoryList/");?>
                   <div class="form-group">
                        <label class="sr-only" for="keyword">Email address</label>
                        <input type="text" class="form-control" id="search" placeholder="" name="keyword" value="">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="clearfix"></div>
                <?php if (isset($categoryList['rows']) && count($categoryList['rows'])) { ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category Name</th>
                                <th>Main Category</th>
                                <th>Brand</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                            <?php foreach ($categoryList['rows'] as $category): ?>
                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td><?php echo $category['name'];?></td>
                                    <td><?php echo array_key_exists($category['main_id'], $mainCategories) ? $mainCategories[$category['main_id']] : "...";?></td>
                                    <td><?php echo array_key_exists($category['brand_id'], $brands) ? $brands[$category['brand_id']] : "...";?></td>
                                    <td><?php echo $category['status'];?></td>
                                    <td><a href="<?php echo base_url()."category/editCategory/{$category['shop_id']}/{$category['id']}"?>">Edit</a></td>
                                </tr>
                                <?php $index ++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>