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

            ?>
            <?php $this->load->view("/ad/card") ?>


            <div class="form-group">
                <h4>View Profile</h4>
                <p></p>
                <div id="infoMessage"><?php echo $message??""; ?></div>
            </div>

            <div class="form-group">
                <label for="first_name">User ID: <?= $user->username ?></label>
            </div>
            <div class="form-group">
                <label for="first_name">First Name: <?= $user->first_name ?></label>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name: <?= $user->last_name ?></label>
            </div>
            <div class="form-group">
                <label for="email">Email address: <?= $user->email ?></label>
            </div>
            <div class="form-group">
                <label for="email">Last Login: <?= date("Y-m-d H:i:s", $user->last_login) ?></label>
            </div>
        </div>
    </div>
</div>