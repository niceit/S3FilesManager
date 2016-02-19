<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Pretty</title>

    <link href="<?php echo $this->assetsUrl ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->assetsUrl ?>bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->assetsUrl ?>css/custom/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->assetsUrl ?>css/styles.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo $this->assetsUrl ?>js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo $this->assetsUrl ?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>js/plugins/ui/jquery.easytabs.min.js"></script>

    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>js/plugins/charts/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>js/plugins/charts/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>js/charts/pie.js"></script>
</head>

<body>

<!-- Top line begins -->
<div id="top">
    <div class="wrapper">
        <a href="" title="" class="logo col-lg-6">
            <img src="<?php echo $this->assetsUrl ?>images/icon-folder1.png" alt="" /> <span>S3 Pretty File Manager</span>
            <div class="clear"></div>
        </a>

        <!-- Right top nav -->
        <div class="topNav col-lg-6">
            <div class="bt-search col-lg-8">
                <form action="" method="post">
                    <input type="text" name="bt_search" placeholder="search for files..."  />
                    <a href=""><img src="<?php echo $this->assetsUrl ?>images/search.png" /> </a>
                </form>
            </div>
            <ul class="userNav col-lg-4">
                <li><a href="#" title="static" data-toggle="tooltip" data-placement="bottom" class="static"></a></li>
                <li><a href="#" title="static" data-toggle="tooltip" data-placement="bottom" class="settings"></a></li>
                <li><a href="#" title="static"  data-toggle="tooltip" data-placement="bottom" class="logout"></a></li>
                <li class="showTabletP"><a href="#" title="static" data-toggle="tooltip" data-placement="bottom" class="sidebar"></a></li>
            </ul>
            <div class="clear"></div>
            <script type="text/javascript">
                $('.userNav li a').tooltip();
            </script>
        </div>
        <div class="clear"></div>
    </div>
</div>
    <!-- Top line ends -->

    <!-- Sidebar begins -->
<div id="sidebar" class="col-lg-1">
    <div class="mainNav">

        <!-- Main nav -->
        <ul class="nav">
            <li><a href="index.html" title="" class="active"><img src="<?php echo $this->assetsUrl ?>images/icons/mainnav/dashboard.png" alt="" /><span>Dashboard</span></a></li>
            <li><a href="messages.html" title=""><img src="<?php echo $this->assetsUrl ?>images/icons/mainnav/messages.png" alt="" /><span>Messages</span></a></li>
            <li><a href="statistics.html" title=""><img src="<?php echo $this->assetsUrl ?>images/icons/mainnav/statistics.png" alt="" /><span>Statistics</span></a></li>
        </ul>
    </div>

</div>
    <!-- Sidebar ends -->


    <!-- Content begins -->
<div id="content" class="col-lg-11">
    <div class="contentTop row">
        <span class="pageTitle col-lg-3"><img src="<?php echo $this->assetsUrl ?>images/iconHome.gif" alt="" /> Dashboard</span>
        <div class="col-lg-9">
        <ul class="quickStats">
            <li>
                <a href="" class="blueImg bg-green"><img src="<?php echo $this->assetsUrl ?>images/icons/quickstats/plus.png" alt="" /></a>
                <div class="floatR"><a href="#"><span>Upload file</span></a></div>
            </li>
            <li>
                <a href="" class="redImg bg-green"><img src="<?php echo $this->assetsUrl ?>images/icon-basket.png" alt="" /></a>
                <div class="floatR"><a href="#"><span>Create bucket</span></a></div>
            </li>
            <li>
                <a href="" class="greenImg bg-green"><i class="glyphicon glyphicon-bookmark"></i></a>
                <div class="floatR"><a href="#"><span>Create Folder</span></a></div>
            </li>
        </ul>
        </div>
        <div class="clear"></div>
    </div>

    <!-- Main content -->
    <div class="block-summery">
        <ul class="quickStats summery">
            <li class="first">
                <a href="" class="s-sum"><img src="<?php echo $this->assetsUrl ?>images/stats.png" alt="" /></a>
                <div class="floatR"><span>Your Summary</span></div>
            </li>
            <li>
                <a href="" class="blueImg"><img src="<?php echo $this->assetsUrl ?>images/icon-basket.png" alt="" /></a>
                <div class="floatR"><strong class="blue">5489</strong><span>visits</span></div>
            </li>
            <li>
                <a href="" class="redImg"><img src="<?php echo $this->assetsUrl ?>images/icon-folder.png" alt="" /></a>
                <div class="floatR"><strong class="blue">4658</strong><span>users</span></div>
            </li>
            <li>
                <a href="" class="greenImg"><img src="<?php echo $this->assetsUrl ?>images/icon-files.png" alt="" /></a>
                <div class="floatR"><strong class="blue">1289</strong><span>orders</span></div>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
    <!-- Main content ends -->

    <div class="file-manager">
        <div class="widget b-file">
            <div class="whead table-responsive"><h6><img src="<?php echo $this->assetsUrl ?>images/document-library.png" class="file-img" /> <span class="text-file">Files Manager</span></h6><div class="clear"></div></div>
            <div class="sidebar-bucket col-lg-2">
                <div class="icon-bucket">
                   <ul>
                       <li class="s-icon-bucket">
                            <a href="#"><img src="<?php echo $this->assetsUrl ?>images/icon-basket.png" /> </a><span>Buckets</span>
                           <div class="clear"></div>
                       </li>
                       <li>
                        <a href="#"><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a> <a href="#" class="pr-bucket"><img src="<?php echo $this->assetsUrl ?>images/product.png" /></a><span>mainbucketspack</span>
                       </li>
                       <li>
                        <a href="#"><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a> <a href="#" class="pr-bucket"><img src="<?php echo $this->assetsUrl ?>images/product.png" /></a><span>mainbucketspack</span>
                       </li>
                       <li>
                        <a href="#"><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a> <a href="#" class="pr-bucket"><img src="<?php echo $this->assetsUrl ?>images/product.png" /></a><span>mainbucketspack</span>
                       </li>
                       <li>
                        <a href="#"><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a> <a href="#" class="pr-bucket"><img src="<?php echo $this->assetsUrl ?>images/product.png" /></a><span>mainbucketspack</span>
                       </li>

                       <li>
                        <a href="#"><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a> <a href="#" class="pr-bucket"><img src="<?php echo $this->assetsUrl ?>images/product.png" /></a><span>mainbucketspack</span>
                       </li>
                       <li>
                        <a href="#"><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a> <a href="#" class="pr-bucket"><img src="<?php echo $this->assetsUrl ?>images/product.png" /></a><span>mainbucketspack</span>
                       </li>
                   </ul>
                </div>
                <div class="refresh-bucket">
                    <ul class="quickStats block-refresh">
                         <li class="row">
                            <a href="" class="redImg"><img src="<?php echo $this->assetsUrl ?>images/icon-refresh.png" alt="" /></a>
                            <div class="floatR"><span>Refresh</span></div>
                        </li>
                        <li>
                            <a href="" class="blueImg"><img src="<?php echo $this->assetsUrl ?>images/icons/quickstats/plus.png" alt="" /></a>
                            <div class="floatR"><span>Create</span></div>
                        </li>
                    </ul>
                     <div class="clear"></div>
                </div>
                <div class="quick">
                    <div class="t-quick"> <span class="iconb" data-icon=""></span> <span>Quick uploads</span></div>
                    <div class="img-quick"><img src="<?php echo $this->assetsUrl ?>images/elements/uploader/drag.png" /> </div>
                </div>
                <div class="process-upload">
                    <div class="text-pro">
                        <span class="txt-pro">main-file.docx</span><span class="num-pro">78%</span>
                        <div id="progress" class="ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="80"><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="width: 80%;"></div></div>
                        <div class="clear"></div>
                    </div>
                    <div class="uploading">
                       <span class="txt-uploading"><img src="<?php echo $this->assetsUrl ?>images/elements/other/taskProgress.png" /> Uploading</span><span class="check-img"><img src="<?php echo $this->assetsUrl ?>images/icons/color/check.png" /> </span>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="usage">
                    <div class="t-usage">
                        <img src="<?php echo $this->assetsUrl ?>images/icons/color/statistics.png" /> <span>Usage Statistics</span>
                    </div>
                    <div class="block-usage">
                        <div class="total-usage"><img src="<?php echo $this->assetsUrl ?>images/icons/color/database.png" alt=""/> <span>Total space</span></div>
                        <div class="gb"><span class="green-1">25 GB</span></div>
                        <div class="clear"></div>
                    </div>
                    <div class="block-usage">
                        <div class="total-usage"><img src="<?php echo $this->assetsUrl ?>images/icons/color/database.png" alt=""/> <span>Space used</span></div>
                        <div class="gb"><span class="red">9 GB</span></div>
                        <div class="clear"></div>
                    </div>
                    <div class="block-usage">
                        <div class="total-usage"><img src="<?php echo $this->assetsUrl ?>images/icons/color/database.png" alt=""/> <span>Available space</span></div>
                        <div class="gb"><span class="green-2">16 GB</span></div>
                        <div class="clear"></div>
                    </div>
                    <div class="widget grid4 chartWrapper">
                         <div class="pie" id="donut"></div>
                    </div>
                </div>
            </div><!-- end sidebar-bucket -->
            <div class="content-bucket col-lg-10">
                <div class="brown">
                    <div class="table-bucket">
                        <div class="widget">
                            <div class="whead table-responsive"><h6><img src="<?php echo $this->assetsUrl ?>images/archives.png" class="brown-img" /> <span class="text-brown">Bucket Files Browser </span></h6><div class="clear"></div></div>
                            <div class="current">
                                <div class="text-current col-lg-6">
                                    <span>Current path: /</span>
                                </div>
                                <div class="bt-current col-lg-6">
                                    <a href="#" class="buttonS bGreen create-1"><span class="fs1 iconb" data-icon=""></span></a> <a href="#" class="buttonS bGreen create-2">Create folder</a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll check table table-bordered" id="checkAll">
                              <thead>
                                  <tr>
                                      <td><input type="checkbox" name="checkrow"></td>
                                      <td>Type</td>
                                      <td>Name</td>
                                      <td>Size</td>
                                      <td>Last modified</td>
                                      <td>Storage Class</td>
                                      <td>Action</td>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><input type="checkbox" name="checkrow"></td>
                                      <td class="ta-img"><img src="<?php echo $this->assetsUrl ?>images/folder.png" /> </td>
                                      <td class="other-table green">Movies and musics /</td>
                                      <td class="other-table">...</td>
                                      <td>31/12/2015<br>5:23:43 AM</td>
                                      <td class="other-table">STANDARD</td>
                                      <td class="other-table"><a href="#"><img src="<?php echo $this->assetsUrl ?>images/icon-folder1.png" /></a> <a href="#"><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a></td>
                                  </tr>
                                  <tr>
                                      <td><input type="checkbox" name="checkrow"></td>
                                      <td class="ta-img"><img src="<?php echo $this->assetsUrl ?>images/folder.png" /> </td>
                                      <td class="other-table green">Documents /</td>
                                      <td class="other-table">...</td>
                                      <td class="date-times">31/12/2015<br>5:23:43 AM</td>
                                      <td class="other-table">STANDARD</td>
                                      <td class="other-table"><a href="#"><img src="<?php echo $this->assetsUrl ?>images/icon-folder1.png" /></a> <a href="#"><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a></td>
                                  </tr>
                                   <tr>
                                      <td><input type="checkbox" name="checkrow"></td>
                                      <td class="ta-img"><img src="<?php echo $this->assetsUrl ?>images/archives.png" /> </td>
                                      <td class="other-table">Billing-for-january.docx</td>
                                      <td class="other-table">452.74 KB</td>
                                      <td class="date-times">31/12/2015<br>5:23:43 AM</td>
                                      <td class="other-table">STANDARD</td>
                                      <td class="other-table"><a href="#"><img src="<?php echo $this->assetsUrl ?>images/men.png" /></a><a href=""><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a></td>
                                  </tr>
                                  <tr>
                                      <td><input type="checkbox" name="checkrow"></td>
                                      <td class="ta-img"><img src="<?php echo $this->assetsUrl ?>images/thumb.png" /> </td>
                                      <td class="other-table">Billing-for-january.docx</td>
                                      <td class="other-table">452.74 KB</td>
                                      <td class="date-times">31/12/2015<br>5:23:43 AM</td>
                                      <td class="other-table">STANDARD</td>
                                      <td class="other-table"><a href="#"><img src="<?php echo $this->assetsUrl ?>images/bt-search.png" /></a><a href="#"><img src="<?php echo $this->assetsUrl ?>images/men.png" /></a><a href="#"><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a></td>
                                  </tr>
                                   <tr>
                                      <td><input type="checkbox" name="checkrow"></td>
                                      <td class="ta-img"><img src="<?php echo $this->assetsUrl ?>images/thumb.png" /> </td>
                                      <td class="other-table">Billing-for-january.docx</td>
                                      <td class="other-table">452.74 KB</td>
                                      <td class="date-times">31/12/2015<br>5:23:43 AM</td>
                                      <td class="other-table">STANDARD</td>
                                      <td class="other-table"><a href="#"><img src="<?php echo $this->assetsUrl ?>images/bt-search.png" /></a><a href="#"><img src="<?php echo $this->assetsUrl ?>images/men.png" /></a><a href="#"><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a></td>
                                  </tr>
                                  <tr>
                                      <td><input type="checkbox" name="checkrow"></td>
                                      <td class="ta-img"><img src="<?php echo $this->assetsUrl ?>images/orther.png" /> </td>
                                      <td class="other-table">header-stuffs-pack.zip</td>
                                      <td class="other-table">452.74 KB</td>
                                      <td class="date-times">31/12/2015<br>5:23:43 AM</td>
                                      <td class="other-table">STANDARD</td>
                                      <td class="other-table"><a href="#"><img src="<?php echo $this->assetsUrl ?>images/men.png" /></a><a href=""><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a></td>
                                  </tr>
                                  <tr>
                                      <td><input type="checkbox" name="checkrow"></td>
                                      <td class="ta-img"><img src="<?php echo $this->assetsUrl ?>images/document-library.png" /> </td>
                                      <td class="other-table">Billing-for-january.docx</td>
                                      <td class="other-table">452.74 KB</td>
                                      <td class="date-times">31/12/2015<br>5:23:43 AM</td>
                                      <td class="other-table">STANDARD</td>
                                      <td class="other-table"><a href="#"><img src="<?php echo $this->assetsUrl ?>images/men.png" /></a><a href=""><img src="<?php echo $this->assetsUrl ?>images/busy.png" /></a></td>
                                  </tr>
                              </tbody>
                            </table>
                            <div class="bt-brown">
                                <a href="#" class="buttonM bRed icon-img"><span class="fs1 iconb" data-icon=""></span></a> <a href="#" class="buttonM bRed icon-text">Remove Selected</a>
                                <div class="btn-group rightdd">
                                    <button class="buttonS bDefault floatL">Bulk actions</button>
                                    <button class="buttonS bDefault dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><span class="icos-add"></span>Add</a></li>
                                        <li><a href="#"><span class="icos-trash"></span>Remove</a></li>
                                        <li><a href="#" class=""><span class="icos-pencil"></span>Edit</a></li>
                                        <li><a href="#" class=""><span class="icos-heart"></span>Do whatever you like</a></li>
                                    </ul>
                                </div>
                                <a href="#" class="buttonM bBlue icon-img"><span class="fs1 iconb" data-icon=""></span></a> <a href="#" class="buttonM bBlue icon-text">Apply</a>
                            </div>
                        </div>
                    </div>
                </div><!--end brown-->

                <div class="property">
                    <div class="widget grid6">
                        <div class="whead top-pro"><h6><img src="<?php echo $this->assetsUrl ?>images/icons/color/old-versions.png" /><span>Properties</span></h6><div class="clear"></div></div>
                        <div class="text-top-pro">
                            <p><strong>Current selected file:</strong><span class="file-other">other-files.psd</span></p>
                            <div class="slide-pro">

                                  <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#Permissions" aria-controls="home" role="tab" data-toggle="tab">Permissions</a></li>
                                    <li role="presentation"><a href="#Headers" aria-controls="profile" role="tab" data-toggle="tab">Headers</a></li>
                                    <li role="presentation"><a href="#Properties" aria-controls="messages" role="tab" data-toggle="tab">Properties</a></li>
                                    <li role="presentation"><a href="#Preview" aria-controls="settings" role="tab" data-toggle="tab">Preview</a></li>
                                  </ul>

                                <!-- Tab panes -->
                                  <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="Permissions">
                                       <div class="widget">
                                            <table cellpadding="0" cellspacing="0" width="100%" class="tLight noBorderT">
                                                <thead>
                                                    <tr>
                                                        <td class="user-2">Username</td>
                                                        <td class="user-1">Full Control</td>
                                                        <td class="user-1">Read</td>
                                                        <td class="user-1">Write</td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Owner</td>
                                                        <td><input type="checkbox" /></td>
                                                        <td><input type="checkbox" /></td>
                                                        <td><input type="checkbox" /></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Authenticated Users</td>
                                                        <td><input type="checkbox" /></td>
                                                        <td><input type="checkbox" /></td>
                                                        <td><input type="checkbox" /></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>All users</td>
                                                        <td><input type="checkbox" /></td>
                                                        <td><input type="checkbox" /></td>
                                                        <td><input type="checkbox" /></td>
                                                        <td></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="check-apply">
                                            <input type="checkbox" /> <span>Apply for all sub folders (if selected object is a folder)</span>
                                        </div>
                                        <div class="apply-change">
                                            <a href="#" class="buttonM bBlue icon-img"><span class="fs1 iconb" data-icon=""></span></a> <a href="#" class="buttonM bBlue icon-text">Apply change</a>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="Headers">
                                        <div class="tab_content">
                                            <div class="widget">
                                                <table cellpadding="0" cellspacing="0" width="100%" class="tLight noBorderT">
                                                    <thead>
                                                        <tr>
                                                            <td>Content</td>
                                                            <td>Value</td>
                                                            <td>Editable?</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>x-amz-id-2</td>
                                                            <td>ufeWAOroEigGtTa69XUUDVR3Ota6ba/ah1uzi00UtfnQZaxdrFDwtvRrYXAjg+g/hKvFDusuR+8=</td>
                                                            <td class="green">YES</td>
                                                        </tr>
                                                        <tr class="bg-red">
                                                            <td>x-amz-request-id</td>
                                                            <td>7358F265A07BB7E5</td>
                                                            <td class="red">NONE</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Accept-Ranges</td>
                                                            <td>bytes</td>
                                                            <td class="green">YES</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="bt-head-tab">
                                                 <a href="#" class="buttonM bGreen icon-img"><span class="fs1 iconb" data-icon=""></span></a> <a href="#" class="buttonM bGreen icon-text" data-toggle="modal" data-target=".bs-example-modal-lg">Add</a>
                                                 <a href="#" class="buttonM bBlue icon-img"><span class="fs1 iconb" data-icon=""></span></a> <a href="#" class="buttonM bBlue icon-text">Edit</a>
                                                 <a href="#" class="buttonM bRed icon-img"><span class="fs1 iconb" data-icon=""></span></a> <a href="#" class="buttonM bRed icon-text">Delete</a>
                                            </div>

                                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                              <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                     <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="exampleModalLabel">Edit Header Content</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                          <div class="pop-text"><span>Correct the header information and click Save</span></div>
                                                        <form>
                                                          <div class="form-group">
                                                            <div class="col-lg-2 pop-lab"><label for="recipient-name" class="control-label lab-text">Content</label></div>
                                                             <div class="col-lg-10 pop-inp">
                                                                 <input type="text" class="form-control" placeholder="Content-Type" id="recipient-name">
                                                                 <div class="txt-cont"><span>Input the Header Content Name, ex : Content-Type, Accept-Ranges, etc...</span></div>
                                                             </div>
                                                              <div class="clear"></div>
                                                          </div>
                                                          <div class="form-group">
                                                             <div class="col-lg-2 pop-lab"> <label for="recipient-name" class="control-label lab-text">Value</label></div>
                                                             <div class="col-lg-10 pop-inp">
                                                                 <input type="text" class="form-control" placeholder="text/plain" id="recipient-name">
                                                                 <div class="txt-cont"><span>Header value, ex : text/plain, application/otc-stream, etc...</span></div>
                                                             </div>
                                                              <div class="clear"></div>
                                                          </div>
                                                        </form>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Send message</button>
                                                      </div>
                                                </div>
                                              </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="Properties">
                                        <div class="tab_content">
                                            <div class="widget">
                                                <table cellpadding="0" cellspacing="0" width="100%" class="tLight noBorderT">
                                                    <thead>
                                                        <tr>
                                                            <td>Properties</td>
                                                            <td>Value</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>ETag</td>
                                                            <td>cb010017ffac76cd0628f57ae2bdc117</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Server-side modified</td>
                                                            <td>12/30/2015 10:54:25 AM</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Owner</td>
                                                            <td>rr (5c84fc713145a6e5cec39a353a739cef5649caa3d77d092c4385ac7a4b8ff95f)</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="Preview">
                                        <div class="tab_content" >
                                            <div class="url-tab">
                                                <div class="col-lg-1 text-url"><span>url</span></div>
                                                <div class="col-lg-11 inp-url"><input type="text" class="form-control" /></div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="img-tab">
                                                <img src="<?php echo $this->assetsUrl ?>images/mem-slide.png" class="img-responsive" />
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                            </div>
                            <script type="text/javascript">
                                $('.slide-pro li a').click(function (e) {
                                    e.preventDefault()
                                    $(this).tab('show')
                                })
                            </script>
                        </div>
                    </div>


                </div><!-- end property -->
            </div><!-- end content-bucket -->
            <div class="clear"></div>
        </div>
    </div><!-- end file-manager -->

    <div class="footer-content">
        <span>Copyright @ 2016 - All right Resevered</span>
    </div><!-- end footer-content -->
</div>
    <!-- Content ends -->
<div class="clear"></div>
</body>
</html>
