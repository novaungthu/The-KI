<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User List <small>Subheading</small>
                </h1>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <div class="pull-right">
                    <?php echo form_open("user/search/", array('class' => 'form-inline', 'role' => 'form')); ?>
                    <?php echo form_hidden("url", "user/userList/");?>
                    <div class="form-group">
                        <label class="sr-only" for="keyword">Email address</label>
                        <input type="text" class="form-control" id="search" placeholder="" name="keyword" value="">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="clearfix"></div>
                <?php if (isset($userList['rows']) && count($userList['rows'])) { ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Last Login</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                            <?php foreach ($userList['rows'] as $user): ?>
                                <tr align="center">
                                    <td><?php echo $index; ?></td>
                                    <td><?php echo $user['user_name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><i class="<?php echo $user['status'] == ACTIVE ? "fa fa-check text-success" : "fa fa-times-circle text-danger"?>"></i></td>
                                    <td><?php echo faceBookTimeStamp($user['created_date']); ?></td>
                                    <td><?php echo faceBookTimeStamp($user['last_login']); ?></td>
                                    <td><?php echo "..."; ?></td>
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
</div>
<!-- /.container-fluid -->
