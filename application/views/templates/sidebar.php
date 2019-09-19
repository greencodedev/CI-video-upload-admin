<div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <?php 
                    if ($page == "upload_page") {
                ?>
                <li class="nav-item  start active">
                <?php
                    } else {
                ?>
                <li class="nav-item  start">
                <?php
                    }
                ?>                 
                    <a href="<?php echo base_url()?>index.php/video/all" class="nav-link nav-toggle">
                        <i class="icon-cloud-upload"></i>
                        <span class="title">Upload Videos</span>
                    </a>
                </li>
                <?php if ($permission == 2) { ?>
                <?php 
                    if ($page == "manage_user") {
                ?>
                <li class="nav-item active">
                <?php
                    } else {
                ?>
                <li class="nav-item ">
                <?php
                    }
                ?>  
                    <a href="<?php echo base_url()?>index.php/user/all" class="nav-link nav-toggle">
                        <i class="icon-user-following"></i>
                        <span class="title">Manage Users</span>
                    </a>
                </li>
                <?php 
                    if ($page == "settings") {
                ?>
                <li class="nav-item active">
                <?php
                    } else {
                ?>
                <li class="nav-item ">
                <?php
                    }
                ?>  
                    <a href="<?php echo base_url()?>index.php/settings/index" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <?php } ?>
                <?php 
                    if ($page == "user_profile") {
                ?>
                <li class="nav-item active">
                <?php
                    } else {
                ?>
                <li class="nav-item ">
                <?php
                    }
                ?>  
                    
                </li>
            </ul>
        </div>
    </div>