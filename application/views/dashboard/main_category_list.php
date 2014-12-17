<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Main Category List <small>Subheading</small>
                </h1>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn btn-success" href="<?php echo base_url() . "category/create/" ?>" data-toggle="modal" data-target="#remoteModal">Create Main Category</a>
                </div>
                <div class="pull-right">
                    <?php echo form_open("category/search/", array('class' => 'form-inline', 'role' => 'form')); ?>
                    <?php echo form_hidden("url", "category/mainCategoryList/"); ?>
                    <div class="form-group">
                        <label class="sr-only" for="keyword">Email address</label>
                        <input type="text" class="form-control" id="search" placeholder="" name="keyword" value="" required="">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="clearfix"></div>
                <?php if (isset($mainCategoryList['rows']) && count($mainCategoryList['rows'])) { ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = $this->uri->segment(4, 0) + 1; ?>
                            <?php foreach ($mainCategoryList["rows"] as $mainCategory): ?>
                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td><?php echo $mainCategory['name']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url() . "category/create/{$mainCategory['id']}" ?>" data-toggle="modal" data-target="#remoteModal" class="btn btn-sm btn-info">Edit</a>
                                        <a href="<?php echo base_url() . "category/create/{$mainCategory['id']}" ?>" data-toggle="modal" data-target="#remoteModal" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
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
<!-- Modal -->  
<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">  
    <div class="modal-dialog">  
        <div class="modal-content" id="remoteModalContent"></div>  
    </div>  
</div>  
<script>
    $(function() {
        $(document).on('submit', "#createMainCategory", function(event) {
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