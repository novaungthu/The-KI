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
                 <div class="pull-left">
                    <a class="btn btn-success" href="<?php echo base_url() . "shop/createShop/" ?>">Create Shop</a>
                </div>
                <div class="pull-right">
                    <?php echo form_open("shop/search/", array('class' => 'form-inline', 'role' => 'form')); ?>
                    <?php echo form_hidden("url", "shop/shopList/"); ?>
                    <div class="form-group">
                        <label class="sr-only" for="keyword">Email address</label>
                        <input type="text" class="form-control" id="search" placeholder="" name="keyword" value="">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="clearfix"></div>
                <?php if (isset($shopList['rows']) && count($shopList['rows'])) { ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Shop Name</th>
                                <th>Store Types</th>
                                <th>Post Code</th>
                                <th>Shop Address</th>
                                <th>Telephone</th>
                                <th>Website</th>
                                <th>Shop Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                            <?php foreach ($shopList['rows'] as $shop): ?>
                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td><?php echo $shop['name']; ?></td>
                                    <td><?php echo createStoreTypeString($shop['store_type'], true); ?></td>
                                    <td><?php echo $shop["post_code"]; ?></td>
                                    <td><?php echo char_limitter($shop["address_1"]); ?></td>
                                    <td><?php echo $shop['telephone_no']; ?></td>
                                    <td><?php echo generateWebsite($shop['website']); ?></td>
                                    <td><i class="<?php echo $shop['status'] == ACTIVE ? "fa fa-check text-success" : "fa fa-times-circle text-danger"?>"></i></td>
                                    <td>
                                        <span><a href="<?php echo base_url() . "shop/editShop/{$shop['id']}" ?>">Edit</a></span>
                                        <span><a href="<?php echo base_url() . "shop/addCategory/{$shop['id']}"; ?>">Category</a></span>
                                    </td>
                                </tr>
                                <?php $index ++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } ?>
                <div class="clearfix"></div>
                <div class="pull-right">
                    <?php echo $pagination_links; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>