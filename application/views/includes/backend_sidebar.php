<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">The Ki</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ucwords(base64_decode($this->session->userdata('user_name'))); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?php echo base_url() . "user/updateProfile/" ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?php echo base_url(); ?>user/logout/"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#shop"><i class="fa fa-home"></i> Shop <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                <ul id="shop" class="collapse">
                    <li>
                        <a href="<?php echo base_url() . "shop/createShop/" ?>">Create Shop</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() . "shop/shopList/" ?>">Shop List</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#user"><i class="fa fa-home"></i> User <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                <ul id="user" class="collapse">
                    <li>
                        <a href="<?php echo base_url() . "user/signUp/" ?>">Create User</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() . "user/userList/" ?>">User List</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#brand"><i class="fa fa-bar-chart-o"></i> Brand <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                <ul id="brand" class="collapse">
                    <li>
                        <a href="<?php echo base_url() . "brand/createBrand/" ?>">Create Brand</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() . "brand/brandList/" ?>">Brand List</a>
                    </li>
                </ul>
            </li>
            <li><a href="<?php echo base_url()."department/departmentList/"?>"><i class="fa fa-bar-chart-o"></i> Department Store</a></li>
            <li><a href="<?php echo base_url()."category/mainCategoryList/"?>"><i class="fa fa-ambulance"></i> Main Category</a></li>
            <li>
                <a href="<?php echo base_url() . "" ?>"><i class='fa fa-sign-out'></i> Logout </a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
