<div class="container" id="viewProfile">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <?php $this->load->view('user/side'); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 mb-2">
            <?php
            /**
             * Created by PhpStorm.
             * User: Cary
             * Date: 26/12/2016
             * Time: 14:47
             */

            // check is user logged in
            if (!$this->ion_auth->logged_in())
                redirect('auth', 'refresh');

            // get current user information
            $user = $this->ion_auth->user($userid)->row();
            ?>

            <?php echo form_open(); ?>

            <div class="form-group">
                <h4><?php echo lang('edit_user_heading'); ?></h4>
                <p><?php echo lang('edit_user_subheading'); ?></p>
                <div id="infoMessage"><?php echo $message; ?></div>
                User: <?php echo $user->username ?>
            </div>


            <div class="form-group">
                <label for="first_name">First Name</label>
                <?php echo form_input($first_name); ?>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <?php echo form_input($last_name); ?>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <?php echo form_input($email); ?>
            </div>
            <div class="form-group">
                <label for="password">New Password:</label>
                <?php echo form_input($password); ?>
            </div>
            <div class="form-group">
                <label for="password_confirm">Re-enter Password:</label>
                <?php echo form_input($password_confirm); ?>
            </div>
            <?php echo form_hidden('id', $user->id); ?>
            <?php //echo form_hidden($csrf); ?>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Edit Information</button>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>
