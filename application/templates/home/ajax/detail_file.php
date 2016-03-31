<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#permissions">Permissions</a></li>
    <li><a data-toggle="tab" href="#http-headers">Http Headers</a></li>
    <li><a data-toggle="tab" href="#properties">Properties</a></li>
    <li><a data-toggle="tab" href="#preview">Preview</a></li>
</ul>

<div style="min-height: 400px" class="tab-content">
    <div id="permissions" class="tab-pane fade in active">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo $key; ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group">
                        <label style="margin-top: 10px" class="pull-left">URL: </label>
                        <div class="col-md-11 col-sm-11 col-xs-11">
                            <input type="text" class="form-control" value="<?php echo $url; ?>" disabled="disabled" placeholder="url...">
                        </div>
                    </div>
                    <form name="permission_form">
                        <input id="key" name="data[key]" value="<?php echo base64_encode($key); ?>" type="hidden" />
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 25%">User Name</th>
                                <th style="width: 25%">Full Control</th>
                                <th style="width: 25%">Read</th>
                                <th style="width: 25%">Write</th>
                                <!--<th style="width: 16%">Read Permissions</th>
                                <th style="width: 16%">Write Permissions</th>-->
                            </tr>
                            </thead>
                            <tbody id="grant_content" >
                                <tr>
                                    <td>Owner(rr)</td>
                                    <td><input type="checkbox" value="1" name="data[permission][owner][full]" <?php if (is_check_grant($permissions, 'owner', "FULL_CONTROL")) { echo 'checked="checked"'; } ?> class="flat"></td>
                                    <td><input type="checkbox" value="1" name="data[permission][owner][read]" <?php if (is_check_grant($permissions, 'owner', "READ")) { echo 'checked="checked"'; } ?> class="flat"></td>
                                    <td><input type="checkbox" value="1" name="data[permission][owner][write]" <?php if (is_check_grant($permissions, 'owner', "WRITE")) { echo 'checked="checked"'; } ?> class="flat"></td>
                                </tr>
                                <tr>
                                    <td>Authenticates Users</td>
                                    <td><input type="checkbox" value="1" name="data[permission][authenticated][full]" <?php if (is_check_grant($permissions, 'authenticated', "FULL_CONTROL")) { echo 'checked="checked"'; } ?> class="flat"></td>
                                    <td><input type="checkbox" value="1" name="data[permission][authenticated][read]" <?php if (is_check_grant($permissions, 'authenticated', "READ")) { echo 'checked="checked"'; } ?> class="flat"></td>
                                    <td><input type="checkbox" value="1" name="data[permission][authenticated][write]" <?php if (is_check_grant($permissions, 'authenticated', "WRITE")) { echo 'checked="checked"'; } ?> class="flat"></td>
                                </tr>
                                <tr>
                                    <td>All Users</td>
                                    <td><input type="checkbox" value="1" name="data[permission][all][full]" <?php if (is_check_grant($permissions, 'all', "FULL_CONTROL")) { echo 'checked="checked"'; } ?> type="checkbox" class="flat"></td>
                                    <td><input type="checkbox" value="1" name="data[permission][all][read]" <?php if (is_check_grant($permissions, 'all', "READ")) { echo 'checked="checked"'; } ?> type="checkbox" class="flat"></td>
                                    <td><input type="checkbox" value="1" name="data[permission][all][write]" <?php if (is_check_grant($permissions, 'all', "WRITE")) { echo 'checked="checked"'; } ?> type="checkbox" class="flat"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <p align="right">
                        <a href="javascript:;" class="btn btn-primary btn-save-permissions">
                            <i class="fa fa-check"> </i>
                            Save Changes
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="http-headers" class="tab-pane fade">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo $key; ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group">
                        <label style="margin-top: 10px" class="pull-left">URL: </label>
                        <div class="col-md-11 col-sm-11 col-xs-11">
                            <input type="text" class="form-control" value="<?php echo $url; ?>" disabled="disabled" placeholder="url...">
                        </div>
                    </div>
                    <table class="table table-striped header-file">
                        <thead>
                            <tr>
                                <th>Header</th>
                                <th>Value</th>
                                <th width="15%">Read Only</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>x-amz-id-2</td>
                                <td><?php echo $header['x-amz-id-2']; ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>x-amz-request-id</td>
                                <td><?php echo $header['x-amz-request-id']; ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Accept-ranges</td>
                                <td><?php echo $header['accept-ranges']; ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Content-length</td>
                                <td><?php echo $header['content-length']; ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Content-type</td>
                                <td class="row-type"><span class="name-contenttype"><?php echo $header['content-type']; ?></span></td>
                                <td><a class="edit-type btn btn-warning" href="javascript:;" onclick="PrettyS3FilesManager.File.editHeader()" ><i class="fa fa-edit"></i> Edit</a></td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td><?php echo $header['date']; ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Etag</td>
                                <td><?php echo $header['etag']; ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Last-modified</td>
                                <td><?php echo $header['last-modified']; ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Server</td>
                                <td><?php echo $header['server']; ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="properties" class="tab-pane fade">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo $key; ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div style="margin-bottom: 20px" class="form-group">
                        <label style="margin-top: 10px" class="pull-left">URL: </label>
                        <div class="col-md-11 col-sm-11 col-xs-11">
                            <input type="text" class="form-control" value="<?php echo $url; ?>" disabled="disabled" placeholder="url...">
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <table class="table table-striped header-file">
                        <thead>
                        <tr>
                            <th>Property</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ETag</td>
                                <td><?php echo $header['etag']; ?></td>
                            </tr>
                            <tr>
                                <td>Key</td>
                                <td><?php echo $key; ?></td>
                            </tr>
                            <tr>
                                <td>Server-side modified</td>
                                <td><?php echo $header['last-modified']; ?></td>
                            </tr>
                            <tr>
                                <td>Owner</td>
                                <td><?php echo $owner['DisplayName']."(" . $owner['ID'] . ")"; ?></td>
                            </tr>
                            <tr>
                                <td>Size</td>
                                <td><?php echo AppS3::formatTotalSize($property['ContentLength']) . ' (' . $property['ContentLength'] . ' bytes)'; ?></td>
                            </tr>
                            <tr>
                                <td>Storage class</td>
                                <td><?php if ( $property['StorageClass'] != '') echo $property['StorageClass']; ?></td>
                            </tr>
                            <tr>
                                <td>Server-side encrypted</td>
                                <td><?php if ( $property['ServerSideEncryption'] != '') echo $property['StorageClass'];?></td>
                            </tr>
                        </tbody>
                     </table>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="preview" class="tab-pane fade">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo $key; ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div style="margin-bottom: 20px" class="form-group">
                        <label style="margin-top: 10px" class="pull-left">URL: </label>
                        <div class="col-md-11 col-sm-11 col-xs-11">
                            <input type="text" class="form-control" value="<?php echo $url; ?>" disabled="disabled" placeholder="url...">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php if (AppS3::isFileImage($key, $url)): ?>
                        <img class="img-responsive" src="<?php echo $url; ?>">
                    <?php  endif; ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!--
    <div id="versions" class="tab-pane fade">
        versions
    </div>
    <div id="eventLog" class="tab-pane fade">
        eventLog
    </div> -->
</div>