<div class="clearfix"></div>
<div class="row">
    <input type="hidden" name="region" value="<?php echo $region ?>">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-bars"> </i>
                    &nbsp;
                    <?php echo Languages::Text('HEADER_BUCKET_TABLE') ?>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="dashboard-widget-content">
                    <div class="col-md-6 col-sm-6 col-xs-12 form-horizontal">
                        <input type="hidden" id="old_bucket" value="<?php //echo $bucket_default; ?>" />
                        <input type="hidden" id="old_bucket_upload" value="<?php //echo $bucket_default; ?>" />
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-5 col-xs-12">Choose available Buckets</label>
                            <div class="col-md-7 col-sm-7 col-xs-12 select_butket_div">
                                <select name="bucket" class="select_butket form-control" tabindex="-1">
                                    <?php if (!empty($buckets)) : ?>
                                        <?php foreach ($buckets['Buckets'] as $bucket) : ?>
                                            <option <?php if ($bucket_default == $bucket['Name']) echo 'selected="selected"'; ?> value="<?php echo $bucket['Name'] ?>"><?php echo $bucket['Name'] ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <button id="btn-create-new-bucket" type="button" class="btn btn-primary"><i class="fa fa-plus-square"></i> Create new bucket</button>
                        <button id="btn-create-new-folder" type="button" class="btn btn-primary"><i class="fa fa-folder-open-o"></i> Create new folder</button>
                        <button id="upload-file" type="button" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Upload file</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-bars"> </i>
                    <?php echo Languages::Text('HEADER_FOLDER_TABLE') ?>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="dashboard-widget-content">
                    <div id="contentFolder" class="contentFolder"></div>
                </div>
            </div>
        </div>
        <button id="" type="button" class="btn btn-info"><i class="fa fa-refresh"></i> Reload</button>
        <button id="btn-create-new-folder" type="button" class="btn btn-info">
            <i class="fa fa-folder-open-o"></i>
            Create folder
        </button>
    </div>

    <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            <i class="fa fa-bars"> </i>
                            &nbsp;
                            <?php echo Languages::Text('HEADER_FILE_TABLE') ?>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-2 search-files">
                                <a id="clear-search" href="javascript:;" class="btn btn-info">
                                    <i class="fa fa-eraser"> </i>
                                    Clear search
                                </a>
                            </div>
                            <div class="col-md-5 search-files">
                                <div class="input-group search">
                                    <input id="txt-name" type="text" class="form-control" placeholder="Input file name here">
                                    <span class="input-group-btn">
                                        <button id="btn-search" type="button" class="btn btn-primary">
                                            <i class="fa fa-search"> </i>
                                            Search
                                        </button>
                                    </span>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 breadcrumbs" >
                        </div>
                        <div class="dashboard-widget-content">
                            <div class="contentfrefix" id="contentfrefix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- POPUP PREVIEW IMAGE -->
<div id="popup-image" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"  id="myModalLabel2">
                    <i class="fa fa-spotify"> </i>
                    <?php echo Languages::Text('HEADER_IMAGE_POPUP') ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="content-image"></div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END POPUP PREVIEW IMAGE -->

<!-- CREATE BUCKET POPUP -->
<div id="create-new-bucket-popup" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">
                    <i class="fa fa-bars"> </i>
                    <?php echo Languages::Text('HEADER_CREATE_BUCKET_POPUP') ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="content-create-bucket form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bucket name: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="name-bucket" type="text" class="form-control" placeholder="Fill your bucket name here">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <p style="font-size: 12px;">
                                <b>Note</b> : You are not charged for creating a bucket; you are charged only for storing objects in the bucket and for transferring objects in and out of the bucket. The charges you will incur through following the examples in this guide are minimal (less than $1). For more information, go to <a href="http://aws.amazon.com/s3/pricing/" target="_blank">Amazon S3 Pricing</a>.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer">
                <button type="button" id="save-bucket" class="btn btn-success" style="margin-top: 5px;">
                    <i class="fa fa-check"> </i>
                    Create
                </button>
                <button type="button" data-dismiss="modal" class="btn btn-primary">
                    <i class="fa fa-close"> </i>
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END CREATE BUCKET POPUP -->

<!-- OBJECT PROPERTIES POPUP -->
<div id="detail-file" data-backdrop="static" data-keyboard="false"  class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div style="width: 80%" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"  id="myModalLabel2">
                    <i class="fa fa-file"> </i>
                    <?php echo Languages::Text("HEADER_OBJECT_PROPERTIES")?>
                </h4>
            </div>
            <div class="modal-body" id="content-detail"></div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-close"> </i>
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END OBJECT PROPERTIES POPUP -->

<div id="edit-header"data-backdrop="static" data-keyboard="false"  class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div style="width: 80%" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title title-popup"  id="myModalLabel2">Update Content Type</h4>
            </div>
            <div class="modal-body" id="content-detail">
            </div>
        </div>
    </div>
</div>

<!-- CREATE FOLDER POPUP -->
<div id="create-folder" data-backdrop="static" data-keyboard="false"  class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div style="width: 85%" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title title-popup" id="myModalLabel2">
                    <i class="fa fa-bars"> </i>
                    <?php echo Languages::Text('HEADER_CREATE_FOLDER_POPUP') ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="col-md-4" id="list-folder"></div>
                <div class="content-create-folder col-md-8" >
                    <div class="form-group">
                        <div  class="input-group">
                            <span>Will create folder under: </span><span class="selected-folder">/</span>
                        </div>
                        <div class="bucket-select-path col-md-6">
                            <input type="hidden" name="select_folder_path" value="/">
                            <input class="form-control" type="text" name="folder_name" value="" placeholder="Input new folder name without /">
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="save-folders" class="btn btn-primary">
                                <i class="fa fa-check"> </i>
                                Save
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <br>
                        <p style="font-size: 12px">
                            <b>Note:</b> Choose available folder on the left panel to specify the target path where your new folder will be created.
                            Each folder you choose, it's meant a new sub folder will be created under the path you selected.
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CREATE FOLDER POPUP -->

<!-- UPLOAD FILE POPUP -->
<div id="upload-file-modal" data-backdrop="static" data-keyboard="false"  class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div style="width: 85%" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title title-popup" id="myModalLabel2">
                    <i class="fa fa-bars"> </i>
                    <?php echo Languages::Text('HEADER_UPLOAD_POPUP') ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="col-md-4 list-folder-upload-file" ></div>
                <div class="content-upload-file col-md-8" >
                    <div class="input-group">
                        <span>Upload directory: </span><span class="selected-folder">/</span>
                    </div>
                    <!-- The file upload form used as target for the file upload widget -->
                    <form id="fileupload" class="cloud-upload-form"  method="POST" data-id="1" enctype="multipart/form-data">

                        <input type="hidden" name="AWSAccessKeyId" value="">
                        <input type="hidden" name="acl" value="public-read">
                        <input type="hidden" name="success_action_status" value="201">
                        <input type="hidden" name="Content-Type" value="">
                        <input type="hidden" name="policy" value="">
                        <input type="hidden" name="signature" value="">
                        <input type="hidden" name="key" value="/">


                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                        <div class="row fileupload-buttonbar">
                            <div class="col-lg-12">
                                <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn btn-success fileinput-button">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Add files...</span>
                                    <input type="file" name="file" >
                                </span>
                                <button type="submit" class="btn btn-primary start">
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Start upload</span>
                                </button>

                                <!-- The global file processing state -->
                                <span class="fileupload-process"></span>
                            </div>

                        </div>
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                    </form>
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END UPLOAD FILE POPUP -->

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade  row-{%=htmlspecialchars(file.name)%}">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td class="processing-{%=htmlspecialchars(file.name)%}">
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td  class="td-action action-{%=htmlspecialchars(file.name)%}">
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>