<div class="main col-sm-9 col-md-9 clearfix" id="post-index">

    <?php // $this->load->view("/ad/card") ?>
    <div class="card mb-3">
        <div class="post-list-box">
            <div class="d-inline">Sort By |</div>
            <div class="btn-group" id="post-order" style="">
                <input type="hidden" id="post-orderoption" value="default">
                <button id="post-selected-order" class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Latest Plan
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" data-order="default">Latest Plan</a>
                    <a class="dropdown-item" href="#" data-order="oldest">Oldest Plan</a>
                    <a class="dropdown-item" href="#" data-order="lowcost">Spending (Low to High)</a>
                    <a class="dropdown-item" href="#" data-order="highcost">Spending (High to Low)</a>
                    <!--a class="dropdown-item" href="#" data-order="default">Distance (Nearest to Furthest)</a-->
                </div>
            </div>
        </div>
    </div>
    <!--
            <div class="mx-auto">
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description">Bookmarked</span>
                </label>
            </div>-->
    <div id="posts_list_container">
        <div id="posts_list">
        </div>
    </div>
</div>
<!--
<div class="col-sm-3 hidden-md-down">
    <div class="card mb-3">
        <img class="card-img-top" src="<?= base_url() ?>vendor/img/ad/adhere.png" alt="Card image cap">
        <div class="card-block">
            <p class="card-text">Please contact us for more information. >><a
                        href="mailto:triptmr@gmail.com">Here</a></a> </p>
        </div>
    </div>
    <div class="card mb-3">
        <img class="card-img-top" src="<?= base_url() ?>vendor/img/ad/adhere.png" alt="Card image cap">
        <div class="card-block">
            <p class="card-text">Please contact us for more information. >><a
                        href="mailto:triptmr@gmail.com">Here</a></a> </p>
        </div>
    </div>
</div>-->

	
