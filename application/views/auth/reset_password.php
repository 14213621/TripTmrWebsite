<div class="container" id="viewProfile">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <?php $this->load->view('user/side'); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 mb-2">

            <div class="form-group">
                <h4><?php echo lang('reset_password_heading'); ?></h4>
                <p><?php echo lang('edit_user_subheading'); ?></p>
                <div id="infoMessage"><?php echo $message; ?></div>
            </div>
            <?php echo form_open('auth/reset_password/' . $code); ?>
            <div class="form-group">
                <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length); ?></label>
                <br/>
                <?php echo form_input($new_password); ?>
            </div>
            <div class="form-group">
                <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?> <br/>
                <?php echo form_input($new_password_confirm); ?>
            </div>
            <?php echo form_input($user_id); ?>
            <?php // echo form_hidden($csrf); ?>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>