
    <link href="<?php echo base_url();?>/public/global/css/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/public/css/fileupload.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            
                <h3 class="page-title"> Multiple File Upload
                </h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row">
                    <div class="col-md-12">
                    <div class="portlet light portlet-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-cloud-upload font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">Upload Videos</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn white goto-back">
                                    <label class="btn btn-transparent green btn-outline btn-circle btn-sm active">
                                        Go back
                                        <i class="fa fa-undo"></i>                                    
                                    </label>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form id="fileupload" action="<?php echo base_url();?>index.php/video/upload" method="POST" enctype="multipart/form-data">
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div class="col-lg-5">
                                        <div class="portlet light portlet-fix bordered">
                                            <div class="portlet-title">
                                                <h4> Upload Videos </h4>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="form-horizontal" id="submit_form">
                                                    <div class="form-wizard">
                                                        <div class="form-body">
                                                            <div class="tab-content">                                        
                                                                <div class="tab-pane active" id="tab1">
                                                                    <!-- <div class="form-group">
                                                                        <label class="control-label col-md-3">filename
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" name="filename" id="filename"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-3">contents
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <textarea type="text" class="form-control" name="contents" id="contents" ></textarea>
                                                                        </div>
                                                                    </div>  -->
                                                                    <div class="form-group">
                                                                        <div class="col-md-3"></div>
                                                                        <div class="col-md-7">
                                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                <span class="btn green btn-file">
                                                                                    <span class="fileinput-new"> Select file </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" name="upload[]" id="uploadFiles" multiple> 
                                                                                </span>
                                                                                <span class="fileinput-filename"> </span> &nbsp;
                                                                                <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="fileinput fileinput-new btn-add" data-provides="fileinput" style="width: 100%;">
                                                                                <span class="btn green btn-file" style="width: 100%;">
                                                                                    <span class="fileinput-new"> Upload </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>                           
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- The fileinput-button span is used to style the file input field as button -->
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- The global progress information -->
                                    <div class="col-lg-7">
                                        <!-- The global progress bar -->
                                        <div class="portlet light portlet-fix bordered">
                                            <div class="portlet-title">
                                                <h4> Status </h4>
                                            </div>
                                            <div class="portlet-body">
                                                <table role="presentation" class="table table-striped clearfix">
                                                    <tbody class="files"> 

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                
                            </form>
                        </div>
                    </div>
                </div>
                <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-upload fade">
                        <td>
                            <span class="preview"></span>
                        </td>
                        <td>
                            <p class="name">{%=file.name%}</p>
                            <strong class="error text-danger label label-danger"></strong>
                        </td>
                        <td>
                            <p class="size">Processing...</p>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                        </td>
                        <td> {% if (!i && !o.options.autoUpload) { %}
                            <button class="btn blue start" disabled>
                                <i class="fa fa-upload"></i>
                                <span>Start</span>
                            </button> {% } %} {% if (!i) { %}
                            <button class="btn red cancel">
                                <i class="fa fa-ban"></i>
                                <span>Cancel</span>
                            </button> {% } %} </td>
                    </tr> {% } %} </script>
                <!-- The template to display files available for download -->
                <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-download fade">
                        <td>
                            <span class="preview"> {% if (file.thumbnailUrl) { %}
                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                                    <img src="{%=file.thumbnailUrl%}">
                                </a> {% } %} </span>
                        </td>
                        <td>
                            <p class="name"> {% if (file.url) { %}
                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                                <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
                            <div>
                                <span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
                        <td>
                            <span class="size">{%=o.formatFileSize(file.size)%}</span>
                        </td>
                        <td> {% if (file.deleteUrl) { %}
                            <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                                <i class="fa fa-trash-o"></i>
                                <span>Delete</span>
                            </button>
                            <input type="checkbox" name="delete" value="1" class="toggle"> {% } else { %}
                            <button class="btn yellow cancel btn-sm">
                                <i class="fa fa-ban"></i>
                                <span>Cancel</span>
                            </button> {% } %} </td>
                    </tr> {% } %} </script>
            </div>
            <!-- END CONTENT BODY -->
        </div>
    </div>
    
    <script src="<?php echo base_url();?>/public/global/javascript/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>/public/javascript/fileupload.js" type="text/javascript"></script>
