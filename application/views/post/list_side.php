<div class="container">
    <div class="row">
        <div class="sidebar col-sm-3 col-md-3 clearfix">
            <div class="card filter-list">
                <div class="side-group">
                    <div class="card-header">Topic</div>
                    <?php if ($this->ion_auth->logged_in()) {
                        $user = $this->ion_auth->user()->row();
                        ?>

                        <div class="card-block">
                            <div class=" ">
                                <a href="/post/create" class="btn btn-primary" style="width:100%">Create Post</a>
                            </div>

                        </div>
                    <?php } else { ?>
                        <div class="card-block">
                            <div class=" ">
                                <a href="/auth" class="btn btn-primary" style="width:100%">Login Account</a>
                            </div>

                        </div>
                    <?php } ?>

                </div>
                <!--div class="side-group">
                    <div class="card-header">Search</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div id="search" class="search my-1">
                                <input name="search" value="" placeholder="Search" type="text">
                                <ul class="searchbox">
                                    <a href="#" disabled="">
                                        <li>Please enter keywords.</li>
                                    </a>
                                </ul>
                                <button type="button" class="button-search"><i class="fa fa-search"></i></button>
                                <div class="clear"></div>
                            </div>
                        </li>
                    </ul>
                </div-->
                <div class="side-group">
                    <div class="card-header">Category</div>
                    <ul class="list-group" id="categories_list">
                    </ul>
                </div>
                <div class="side-group">
                    <div class="card-header">Consumed Day</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <input type="text" id="dayAmount" readonly
                                   style="border:0; color:black; ">
                        </li>
                        <li class="list-group-item">
                            <div id="dayRange"></div>
                        </li>
                    </ul>
                </div>
                <div class="side-group">
                    <div class="card-header">Price</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <input type="text" id="priceAmount" readonly
                                   style="border:0; color:black;">
                        </li>
                        <li class="list-group-item">
                            <div id="priceRange"></div>
                        </li>
                    </ul>
                </div>
                <!-- div class="side-group">
                    <div class="card-header">Rating</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <input type="text" id="rateAmount" readonly
                                   style="border:0; color:black; font-weight:bold;">
                        </li>
                        <li class="list-group-item">
                            <div id="rateRange"></div>
                        </li>
                    </ul>
                </div -->
            </div>
            <div id="posts_query">
                <input type="hidden" name="category_id" id="category_id"
                       value="<?php if (isset($category_id)) echo $category_id; ?>"/>
                <input type="hidden" name="user_id" id="user_id" value="<?php if (isset($user)) echo $user->id; ?>"/>
            </div>

            <?php if ($this->ion_auth->logged_in() && false) { ?>
                <div class="add-topic-btn">
                    <a href="/category/create" class="btn btn-primary">Add Category</a>
                </div>
            <?php } ?>
        </div>

