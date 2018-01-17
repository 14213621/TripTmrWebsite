<div class="container" id="viewProfile">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <?php $this->load->view('user/side'); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 mb-2">
            <?php echo form_open("auth/forgot_password", array("id" => "forgotPasswordForm")); ?>

            <div class="form-group">
                <h4><?php echo lang('forgot_password_heading'); ?></h4>
                <p>Please input your register identity. System will send you the re-activation email and authorize you to reset the password.</p>
                <div id="infoMessage"><?php echo $message; ?></div>
            </div>


            <div class="form-group">
                <label for="identity"><?php echo(($type == 'email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label)); ?></label>
                <br/>
                <?php echo form_input($identity); ?>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Send email confirmation</button>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>