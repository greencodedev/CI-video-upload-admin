<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <?php if ($permission != 2) {?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span class="error-text"> Access is denied. </span>
        </div>
        <?php } else { ?>
        <h3 class="page-title"> Manage User Informations
        </h3>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-users font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Users Table</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                    <?php 
                        if (count($userinfos) == 0) { 
                    ?>
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span class="error-text"> No Data </span>
                        </div>
                    <?php
                        } else { 
                            $permissions = [0 => 'candidate', 'uploader', 'admin'];
                    ?>
                        <!-- <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <button id="sample_editable_1_new" class="btn green"> Add New
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group pull-right">
                                        <button class="btn green btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:;"> Print </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;"> Save as PDF </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;"> Export to Excel </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th> Username </th>
                                    <th> Real Name </th>
                                    <th> email </th>
                                    <th> permission </th>
                                    <th> Edit </th>
                                    <th> Delete </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($userinfos as $user) {
                            ?>
                                <tr id="<?php echo $user->id;?>">
                                    <td> <?php echo $user->username ?> </td>
                                    <td> <?php echo $user->realname ?> </td>
                                    <td> <?php echo $user->email ?> </td>
                                    <td class="center"> <?php echo $permissions[$user->permission]; ?> </td>
                                    <td>
                                        <a class="edit" href="javascript:;"> Edit </a>
                                    </td>
                                    <td>
                                        <a class="delete" href="javascript:;"> Delete </a>
                                    </td>
                                </tr>
                            <?php 
                                }  
                            ?>
                            </tbody>
                        </table>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<script src="<?php echo base_url();?>/public/javascript/user-datatables-editable.js" type="text/javascript"></script>