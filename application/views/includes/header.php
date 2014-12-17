<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo isset($title) ? $title : "The Ki"; ?></title>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.js"></script>
        <?php echo link_tag('assets/css/bootstrap.min.css') ?>
        <script type="text/javascript" src="<?php echo base_url()."assets/js/bootstrap.min.js";?>"></script>
        <?php echo link_tag('assets/font_awesome/css/font-awesome.min.css') ?>
        <?php echo link_tag('assets/css/default.css') ?>
        <?php echo link_tag('assets/css/app.css') ?>
    </head>
    <body>
    
        <div class="container">
            <div class="header-panel">
                <div class="row">
                    <div class="col-lg-5">
                        <ul class="register-link">
                            <li><a href="<?php echo base_url()."user/login";?>">Sign in</a></li>
                            <li><a href="<?php echo base_url()."user/register";?>">Register</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <div class="logo">
                            <h1>The Ki</h1>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <ul class="wish-links">
                            <li><a href="#">WishList</a></li>
                            <li class="mybag">
                                <a href="#">
                                    <span class="name">My Bag</span>
                                    <span class="items">no items</span>
                                    <span class="price">$0.00</span>
                                </a>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="nav-panel">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="df-nav">
                            <li><a  href="#">Home</a></li>
                            <li class="browse">
                                Browse
                                <ul>
                                    <li><a href="#">Recently Added</a></li>
                                    <li><a href="#">Featured Listings</a></li>
                                    <li><a href="#">Popular Listings</a></li>
                                    <li><a href="#">Popular Locations</a></li>
                                </ul>
                            </li>
                            <li><a  href="#">Find a Store</a></li>
                            <li><a  href="#">Find an Online Shop</a></li>
                            <li><a  href="#"> Find a Brand</a></li>
                            <li><a  href="#">Blogs</a></li>
                            <li><a  href="#">Offers</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
            
        
        