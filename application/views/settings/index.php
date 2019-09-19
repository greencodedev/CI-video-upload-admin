<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <h3 class="page-title"> FTP Settings.
        </h3>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="form_wizard_1">
                    <div class="portlet-body form">
                        <div class="form-horizontal" id="submit_form">
                            <div class="form-wizard">
                                <div class="form-body">
                                    <div class="tab-content">                                        
                                        <div class="tab-pane active" id="tab1">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Server path
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="path" id="path_server" disabled value="<?php echo $settingInfo['upload_path']?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">FTP hostname
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="hostname" id="ftp_hostname" disabled value="<?php echo $settingInfo['ftp_hostname']?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">FTP username
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="username" id="ftp_username" disabled value="<?php echo $settingInfo['ftp_username']?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">FTP password
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="password" class="form-control" name="password" id="ftp_password" disabled value="<?php echo $settingInfo['ftp_password']?>"/>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button class="btn btn-outline green button-next button-reset"> Reset
                                                <i class="fa fa-angle-right"></i>
                                            </button>
                                            <button class="btn green button-submit hide"> Submit
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

<script src="<?php echo base_url();?>/public/javascript/ftp-settings.js" type="text/javascript"></script>