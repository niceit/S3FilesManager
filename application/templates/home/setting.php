<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-bars"> </i>
                    <?php echo Languages::Text("SITE_SETTING_TITLE") ?>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php if (!empty($message)):
                    if ($message['status'] == "Error"):
                        ?>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                            </button>
                            <strong><?php echo $message['status'] ?>!</strong> <?php echo $message['mgs'] ?>
                        </div>
                        <?php else: ?>
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                            </button>
                            <strong><?php echo $message['status'] ?>!</strong> <?php echo $message['mgs'] ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <br />
                <form  action="" method="post" id="setting" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                        <h4>Common Settings:</h4>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="site_url">Site url<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="<?php echo $config_file['siteUrl'] ?>" name="siteUrl" type="text" id="site_url" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="<?php echo $config_file['email'] ?>" name="email" type="email" id="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <h4>Amazon S3 Settings:</h4>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="appId">AppId<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="<?php echo $config_file['s3']['appId'] ?>"  name="appId" type="text" id="appId" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="appSecret">AppSecret<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="<?php echo $config_file['s3']['appSecret'] ?>"  name="appSecret" type="text" id="appSecret" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="region">Region<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="region" class="region form-control" tabindex="-1">
                                <option value="">Choose Region</option>
                                <?php foreach ($regions as $key => $region) : ?>
                                    <option value="<?php echo $key ?>"
                                        <?php if ($key == $config_file['s3']['region']) : ?>
                                            selected="selected"
                                        <?php endif ?>
                                    ><?php echo '(' . $key . ') ' . $region ?></option>
                                <?php endforeach ?>
                            </select>
                            <br>
                            <p>
                                <b>Important:</b> Please choose the correct region which you registered at Amazon S3 Service.
                                If you use a region other than the US East (N. Virginia) endpoint to create a bucket, you must set the LocationConstraint bucket parameter to the same region.
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"> </i>
                                Save Changes
                            </button>
                        </div>
                    </div>

                </form>
                <form  action="" method="post" id="setting" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="form-group">
                        <h4>Amazon S3 Bucket Settings:</h4>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bucket">Bucket default<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php if (!empty($buckets)) : ?>
                                <select name="bucket" class="select_butket form-control" tabindex="-1">
                                    <option value="">Choose Bucket</option>
                                    <?php foreach ($buckets['Buckets'] as $bucket) : ?>
                                        <option <?php if($config_file['s3']['bucket'] == $bucket['Name']) echo 'selected="selected"'; ?> value="<?php echo $bucket['Name'] ?>"><?php echo $bucket['Name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            <?php else : ?>
                                <b style="color: red;">Amazon S3 Key and Secret configurations failed! Please double check information above.</b>
                            <?php endif ?>
                       </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"> </i>
                                Set default bucket
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <a href="<?php echo $this->baseUrl ?>" class="btn btn-primary">
                <i class="fa fa-backward"> </i>
                Back to dashboard
            </a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.listen('parsley:field:validate', function () {
            validateFront();
        });
        $('#setting .btn').on('click', function () {
            $('#setting').parsley().validate();
            validateFront();
        });
        var validateFront = function () {
            if (true === $('#setting').parsley().isValid()) {
                $('.bs-callout-info').removeClass('hidden');
                $('.bs-callout-warning').addClass('hidden');
            } else {
                $('.bs-callout-info').addClass('hidden');
                $('.bs-callout-warning').removeClass('hidden');
            }
        };
    });


</script>