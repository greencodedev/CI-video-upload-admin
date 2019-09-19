<style type="text/css">
    table td a.edit {
        display: inherit;
        padding: 5px 20px;
        background-color: #3d7cb1;
        color: white;
        text-decoration: none;
    }
    table td a.delete {
        display: inherit;
        padding: 5px 20px;
        background-color: #e7505a;
        color: white;
        text-decoration: none;
    }
</style>
<div class="page-content-wrapper">
    <input type="hidden" id="copy_input" />
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <?php if ($permission == 0) {?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span class="error-text"> Access is denied. </span>
        </div>
        <?php } else { 
            if ($permission == 1) {   
        ?>
        <h3 class="page-title"> Manage Infomations of My Videos </h3>
        <?php 
            } else {
        ?>
        <h3 class="page-title"> Manage Informations of All Videos</h3>
        <?php 
            }        
        ?>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-cloud-upload font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Manage Videos Table</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <button class="btn white goto-upload">
                                <label class="btn btn-transparent green btn-outline btn-circle btn-sm active">
                                    Upload Video
                                    <i class="fa fa-upload"></i>                                    
                                </label>
                                </button>
                            </div>
                            <?php 
                                if ($permission == 2) {   
                            ?>
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <button class="btn white goto-settings">
                                <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                    Settings
                                    <i class="fa fa-gear"></i>                                    
                                </label>
                                </button>
                            </div>
                            <?php 
                                }        
                            ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                    <?php 
                        if (count($videoInfos) == 0) { 
                    ?>
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span class="error-text"> No Data </span>
                        </div>
                    <?php
                        } else { 
                    ?>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th> title </th>
                                    <th> Real title </th>
                                    <th> path </th>
                                    <th> Copy Urls </th>
                                    <th> Delete </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($videoInfos as $video) {
                            ?>
                                <tr id="<?php echo $video->id;?>">
                                    <td class="origin_name"> <?php echo $video->origin_filename ?> </td>
                                    <td> <?php echo $video->uploaded_filename ?> </td>
                                    <td> <?php echo $video->copy_url ?> </td>
                                    <td>
                                        <input type="hidden" id="copyurl_input" value="<?php echo $server_url."/".$video->copy_url."/".$video->uploaded_filename;?>/playlistm3u8"/>
                                        <a class="edit" href="javascript:;"> 
                                            <div><span> Copy </span></div> </a>
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
<script src="<?php echo base_url();?>/public/javascript/video-datatables-editable.js" type="text/javascript"></script>