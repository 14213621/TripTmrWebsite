<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3 mgy-30">
            <div class="mgy-30">
                <h2 class="text-center mgy-10 hidden-md-down">Log in to enjoy</h2>
                <?php echo form_open('auth/login'); ?>
                <div id="infoMessage" style="color:grey;">Please active your email before login.<br/><?php echo $this->session->flashdata('message'); ?></div>
                    <div class="form-group">
                        <h4 class=" hidden-lg-up">Please sign in</h4>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="text" id="inputEmail" class="form-control" placeholder="Username" required=""
                               autofocus="" name="identity">
                    </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password"
                           required="" name="password">
                </div>
                <div class="d-flex">
                    <div class="mr-auto p-2"><a href="<?=base_url()?>auth/forgot_password">Forgot your password?</a></div>
                    <div class="p-2"><a href="<?=base_url()?>auth/register">Register Now</a></div>
                </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>