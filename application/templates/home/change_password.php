<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-bars"> </i>
                    Change password
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
                <form  action="" method="post" id="forgotpassword" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Login Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="<?php echo $member['username']; ?>" name="username" type="text" id="username" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_old">Current password<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="password_old" type="password" id="password_old" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_new">New Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  name="password_new"  type="password" id="lpassword_new"  required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"> </i>
                                Save Changes
                            </button>
                        </div>
                    </div>

                </form>
                <a href="<?php echo $this->baseUrl ?>" class="btn btn-primary">
                    <i class="fa fa-backward"> </i>
                    Back to dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.listen('parsley:field:validate', function () {
            validateFront();
        });
        $('#forgotpassword .btn').on('click', function () {
            $('#forgotpassword').parsley().validate();
            validateFront();
        });
        var validateFront = function () {
            if (true === $('#forgotpassword').parsley().isValid()) {
                $('.bs-callout-info').removeClass('hidden');
                $('.bs-callout-warning').addClass('hidden');
            } else {
                $('.bs-callout-info').addClass('hidden');
                $('.bs-callout-warning').removeClass('hidden');
            }
        };
    });
</script>