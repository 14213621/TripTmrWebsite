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
            $user = $this->ion_auth->user()->row();
            ?>

            <div class="form-group">
                <h4>My Bookmark</h4>
                <p>The following post are bookmarked by you.</p>
            </div>

            <!--div class="card mb-3">
                <div class="post-list-box">
                    <div class="d-inline">Sort By |</div>
                    <div class="btn-group" style="">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Latest Plan
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Overall (High to Low)</a>
                            <a class="dropdown-item" href="#">Most Bookmarked</a>
                            <a class="dropdown-item" href="#">Spending (Low to High)</a>
                            <a class="dropdown-item" href="#">Spending (High to Low)</a>
                            <a class="dropdown-item" href="#">Distance (Nearest to Furthest)</a>
                        </div>
                    </div>
                </div>
            </div-->
            <!--
                    <div class="mx-auto">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Bookmarked</span>
                        </label>
                    </div>-->
            <input type="hidden" id="post-list-mypost" value="<?= $user->id ?>">
            <div id="posts_list_container">
                <div id="posts_list">
                </div>
            </div>
        </div>
    </div>
</div>
