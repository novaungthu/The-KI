<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Department Store  List <small>Subheading</small>
                </h1>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn btn-success" href="<?php echo base_url() . "department/create/" ?>" data-toggle="modal" data-target="#remoteModal">Create Department</a>
                </div>
                <div class="pull-right">
                    <?php echo form_open("brand/search/", array('class' => 'form-inline', 'role' => 'form')); ?>
                    <?php echo form_hidden("url", "brand/brandList/"); ?>
                    <div class="form-group">
                        <label class="sr-only" for="keyword">Email address</label>
                        <input type="text" class="form-control" id="search" placeholder="" name="keyword" value="">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="clearfix"></div>
                <?php if (isset($departmentList['rows']) && count($departmentList['rows'])) { ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Store Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = $this->uri->segment(4, 0) + 1; ?>
                            <?php foreach ($departmentList['rows'] as $department): ?>
                                <tr>
                                    <td align="center"><?php echo $index; ?></td>
                                    <td><?php echo $department['name']; ?></td>
                                    <td align="center"><i class="<?php echo $department['status'] == ACTIVE ? "fa fa-check text-success" : "fa fa-times-circle text-danger" ?>"></i></td>
                                    <td align="center"><?php echo faceBookTimeStamp($department['created_date']); ?></td>
                                    <td align="center"><a class="btn btn-sm btn-info" href="<?php echo base_url() . "department/create/{$department['id']}" ?>" data-toggle="modal" data-target="#remoteModal">Edit</a></td>
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
<!-- Delete Modal-->

<!-- Modal -->  
<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">  
    <div class="modal-dialog">  
        <div class="modal-content" id="remoteModalContent"></div>  
    </div>  
</div>  
<script>
    $(function() {
        $(document).on('submit', "#createDepartment", function(event) {
            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.alert) {
                        location.reload();
                    } else {
                        $("#error-wrapper").hasClass("hide") ? $('#error-wrapper').removeClass("hide") : "";
                        $('#error-msg').html(data.message)
                    }
                }
            });
            event.preventDefault();
        });
        $('#remoteModal').on('hidden.bs.modal', function() {
            $(this).removeData('bs.modal');
        });
    });
</script>
