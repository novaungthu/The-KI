<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Brand List <small>Subheading</small>
                </h1>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                    <div class="pull-left">
                    <a class="btn btn-success" href="<?php echo base_url() . "brand/createBrand/" ?>">Create brand</a>
                </div>
                <div class="pull-right">
                    <?php echo form_open("brand/search/", array('class' => 'form-inline', 'role' => 'form')); ?>
                    <?php echo form_hidden("url", "brand/brandList/");?>
                    <div class="form-group">
                        <label class="sr-only" for="keyword">Email address</label>
                        <input type="text" class="form-control" id="search" placeholder="" name="keyword" value="">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="clearfix"></div>
                <?php if (isset($brandList['rows']) && count($brandList['rows'])) { ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Brand Name</th>
                                <th>Brand Type(s)</th>
                                <th>Country</th>
                                <th>Is Designer?</th>
                                <th>Shop Request</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = $this->uri->segment(4, 0) + 1; ?>
                            <?php foreach ($brandList['rows'] as $brand): ?>
                                <tr>
                                    <td align="center"><?php echo $index; ?></td>
                                    <td><?php echo $brand['name']; ?></td>
                                    <td><?php echo $brand['brand_type']; ?></td>
                                    <td align="center"><?php echo $brand['country']; ?></td>
                                    <td align="center"><i class="<?php echo $brand['is_designer'] == ACTIVE ? "fa fa-check text-success" : "fa fa-times-circle text-danger"?>"></i></td>
                                    <td align="center"><?php echo "..."; ?></td>
                                    <td align="center"><i class="<?php echo $brand['status'] == ACTIVE ? "fa fa-check text-success" : "fa fa-times-circle text-danger"?>"></i></td>
                                    <td align="center"><a href="<?php echo base_url()."brand/editBrand/{$brand['id']}"?>">Edit</a></td>
                                </tr>
                                <?php $index ++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <?php echo $pagination_links; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
