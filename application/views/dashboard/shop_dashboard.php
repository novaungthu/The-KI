<style>
    #map-canvas{
        margin:0;
        padding:0;
        height:100%;
    }
    #map-canvas {
        width:570px;
        height:480px;
    }
</style>


<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="<?php echo $cur_page == "editShop" ? "active" : ""; ?>"><a href="#editShop" role="tab" data-toggle="tab">Shop</a></li>
                    <li role="presentation" class="<?php echo $cur_page == "addCategory" ? "active" : ""; ?>"><a href="#addCategory" role="tab" data-toggle="tab">Category</a></li>
                    <li role="presentation"  class="<?php echo $cur_page == "addBrand" ? "active" : ""; ?>"><a href="#addBrand" role="tab" data-toggle="tab">Brand</a></li>
                    <li role="presentation"  class="<?php echo $cur_page == "addPhoto" ? "active" : ""; ?>"><a href="#addPhoto" role="tab" data-toggle="tab">Photo</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $shop['name']; ?> <small></small> </h1>
                <?php
                if (isset($alert) || $this->session->flashdata('alert_text')) {
                    if (isset($alert)) {
                        notificationBar($alert);
                    } else {
                        notificationBar(array('text' => $this->session->flashdata('alert_text'), 'class' => $this->session->flashdata('alert_class')));
                    }
                }
                ?>
                <p>
                    <label><span class="text-danger">*</span> Required Field.</label>
                </p>
            </div>
        </div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane <?php echo $cur_page == "editShop" ? "active" : ""; ?>" id="editShop">
                <?php echo $this->load->view("dashboard/edit_shop"); ?>
            </div>
            <div role="tabpanel" class="tab-pane <?php echo $cur_page == "addCategory" ? "active" : ""; ?>" id="addCategory">
                <?php echo $this->load->view("dashboard/add_category"); ?>
            </div>
            <div role="tabpanel" class="tab-pane <?php echo $cur_page == "addBrand" ? "active" : ""; ?>" id="addBrand">
                <?php echo $this->load->view("dashboard/add_brand"); ?>
            </div>
            <div role="tabpanel" class="tab-pane <?php echo $cur_page == "addPhoto" ? "active" : ""; ?>" id="addPhoto">
                <?php echo $this->load->view("dashboard/add_photo"); ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal Confirmation -->

<!-- Location Modall -->
<div class="modal fade" id="showMapModal" tabindex="-1" role="dialog" aria-labelledby="showMapModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><?php echo $shop['name']; ?> shop's location on google map</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div id="map-canvas" class=""></div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Category Model -->  
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">  
    <div class="modal-dialog">  
        <div class="modal-content" id="editCategoryModalContent"></div>  
    </div>  
</div>  


<!-- include input widgets; this is independent of Datepair.js -->
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/jquery.timepicker.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url() . "assets/js/"; ?>jquery.timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() . "assets/js/"; ?>bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() . "assets/js/"; ?>datepair.js"></script>
<script type="text/javascript" src="<?php echo base_url() . "assets/js/"; ?>jquery.datepair.js"></script>
<script type="text/javascript">
    $(function() {
        // Date and Time Picker
        $('#timeRange .time').timepicker({
            'showDuration': true,
            'timeFormat': 'g:ia'
        });
        $('#timeRange').datepair();
        $('#dateRange .time').timepicker({
            'showDuration': true,
            'timeFormat': 'g:ia'
        });
        $('#dateRange .date').datepicker({
            'format': 'm/d/yyyy',
            'autoclose': true
        });
        $('#dateOnly .date').datepicker({
            'format': 'm/d/yyyy',
            'autoclose': true
        });
        $('#dateRange').datepair();
        // initialize datepair

        // Shop Details
        $(".toggleDetails, .toggleAddress, .toggleService, .toggleReview").click(function() {
            var id = $(this).attr('id');
            var cl = $(this).attr('class');
            // hide static
            $('#' + id + "-static").hide();
            // show input
            $('#' + id + "-input").removeClass("hide");
            $("#" + id + "-input").focus();
            if (id === "latitude") {
                $("#longitude-static").hide();
                $("#longitude-input").removeClass("hide");
            }
            // hide edit button
            $("#btn-" + cl).removeClass("hide");
            $(this).hide();
        });
        // Add Service
        $("#addService, #addReview").click(function() {
            var id = $(this).attr("id");
            $("#" + id + "Form").removeClass("hide");
        });
        // Shop's Schedule
        var schedule = $("input[name='schedule_type']:checked").val();
        if(schedule > 0) {
            toggleSchedule(schedule);
        }
        // toggle radio change
        $('input[type=radio][name=schedule_type]').change(function() {
            toggleSchedule(this.value);
        });
        function toggleSchedule(value) {
            if ('10' === value) {
                // Date Rande
                $("#dateRange").hasClass("hide") ? $("#dateRange").removeClass("hide") : "";

                $("#dateOnly").hasClass("hide") ? "" : $("#dateOnly").addClass("hide");
                $("#timeRange").hasClass("hide") ? "" : $("#timeRange").addClass("hide");
                $("#checkDate").hasClass("hide") ? "" : $("#checkDate").addClass("hide");
                $("#radioDate").hasClass("hide") ? "" : $("#radioDate").addClass("hide");
            } else if ('11' === value) {
                //  All Day
                $("#timeRange").hasClass("hide") ? $("#timeRange").removeClass("hide") : "";
                $("#checkDate").hasClass("hide") ? $("#checkDate").removeClass("hide") : "";

                $("#dateRange").hasClass("hide") ? "" : $("#dateRange").addClass("hide");
                $("#dateOnly").hasClass("hide") ? "" : $("#dateOnly").addClass("hide");
                $("#radioDate").hasClass("hide") ? "" : $("#radioDate").addClass("hide");
            } else if ('12' === value) {
                // Each Day
                $("#timeRange").hasClass("hide") ? $("#timeRange").removeClass("hide") : "";
                $("#radioDate").hasClass("hide") ? $("#radioDate").removeClass("hide") : "";

                $("#dateRange").hasClass("hide") ? "" : $("#dateRange").addClass("hide");
                $("#dateOnly").hasClass("hide") ? "" : $("#dateOnly").addClass("hide");
                $("#checkDate").hasClass("hide") ? "" : $("#checkDate").addClass("hide");

            } else if ('13' === value) {
                // Specific Date
                $("#timeRange").hasClass("hide") ? $("#timeRange").removeClass("hide") : "";
                $("#dateOnly").hasClass("hide") ? $("#dateOnly").removeClass("hide") : "";
                $("#dateRange").hasClass("hide") ? "" : $("#dateRange").addClass("hide");

                $("#checkDate").hasClass("hide") ? "" : $("#checkDate").addClass("hide");
                $("#radioDate").hasClass("hide") ? "" : $("#radioDate").addClass("hide");
            }
        }
        // Update Category
           $(document).on('submit', "#editCategoryForm", function(event) {
            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.alert) {
                      console.log("true");
                        window.location.reload();
                    } else {
                        $("#category-error-wrapper").hasClass("hide") ? $('#category-error-wrapper').removeClass("hide") : "";
                        $('#category-error-msg').html(data.message)
                    }
                }
            });
            event.preventDefault();
        });
        $('#editCategoryModal').on('hidden.bs.modal', function() {
            $(this).removeData('bs.modal');
        });

    });
    // Delete 
</script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
    var laittude = "<?php echo $shop['latitude']; ?>";
    var longitude = "<?php echo $shop['longitude']; ?>";
    var map;
    var myCenter = new google.maps.LatLng(latitude, longitude);
    var marker = new google.maps.Marker({
        position: myCenter
    });

    function initialize() {
        var mapProp = {
            center: myCenter,
            zoom: 12,
            draggable: true,
            scrollwheel: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), mapProp);
        marker.setMap(map);

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(contentString);
            infowindow.open(map, marker);

        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    google.maps.event.addDomListener(window, "resize", resizingMap());

    $('#showMapModal').on('show.bs.modal', function() {
        //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
        resizeMap();
    })

    function resizeMap() {
        if (typeof map == "undefined")
            return;
        setTimeout(function() {
            resizingMap();
        }, 400);
    }

    function resizingMap() {
        if (typeof map == "undefined")
            return;
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    }

</script>
