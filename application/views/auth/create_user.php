<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3 mgy-30">
            <div class="mgy-30">
                <h2 class="text-center mgy-10 hidden-md-down">Sign up to a member</h2>
                <p><?php echo lang('create_user_subheading'); ?></p>
                <?php echo form_open("auth/register", array('id' => 'registerForm')); ?>

                <div id="infoMessage"><?php echo $message; ?></div>
                <div class="form-group">
                    <h4 class=" hidden-lg-up">Create User Account</h4>
                </div>
                <!--
                <p>
                    <?php // echo lang('create_user_fname_label', 'first_name'); ?> <br/>
                    <?php // echo form_input($first_name); ?>
                </p>

                <p>
                    <?php // echo lang('create_user_lname_label', 'last_name'); ?> <br/>
                    <?php // echo form_input($last_name); ?>
                </p>
                -->
                <?php
                if ($identity_column !== 'email') {
                    echo '<div class="form-group">';
                    echo form_error('identity');
                    echo form_input($identity);
                    echo "</div>";
                }
                ?>

                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <?php echo form_input($email); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($password); ?>

                </div>
                <div class="form-group">
                    <?php echo form_input($password_confirm); ?>

                </div>


                <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>