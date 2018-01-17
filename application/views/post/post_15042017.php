<?php if ($posts) {
    foreach ($posts as $post) {
        ?>
        <div class="card mb-3">
            <div class="post-list-box <?= isset($thread) ? '' : 'hvr-glow' ?>">
                <div class="row clearfix">
                    <div class="col-sm-12 col-md-12 col-lg-4 ">
                        <div class="post-list-title-content">
                            <div class="post-list-preview-wrapper">
                                <!--  <img class="img-fluid" src="/vendor/img/post/tokyo.jpg"
                                       style="width:140px; height:100px;">-->

                                <div class="post-list-preview"
                                     style="background-image: url('/vendor/img/post/tokyo.jpg')">
                                </div>
                                <div class="text-center">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="post-list-title-wrapper">
                                    <h2 class="post-list-title"><a
                                                href="/post/show/<?php echo $post->id; ?>"><?php echo $post->title; ?>
                                        </a>
                                        <span style="font-size:12px;">(<?=$post->commentsNum?>)</span>
                                    </h2>

                                </div>
                                <div class="post-list-details">
                                    <div>
                                        <i class="fa fa-location-arrow" aria-hidden="true"></i><a
                                                href="/post?category_id=<?php echo $post->category->id; ?>"><span
                                                    alt="Trip Destination"><?php echo $post->category->name; ?></span></a>
                                    </div>
                                    <div>
                                        <i class="fa fa-money"
                                           aria-hidden="true"
                                           alt="Trip Used Price"></i><span><?php echo $post->price??"$1000 - $5000" ?></span>
                                    </div>
                                    <div>
                                        <i class="fa fa-tags" aria-hidden="true" alt="Tag"></i><span
                                                class="post-list-tags"><?php echo $post->tags??"<a href='#'>#trip</a>" ?></span>
                                    </div>
                                    <div>
                                        <i class="fa fa-map-signs" aria-hidden="true" alt="Custom Tag"></i><span
                                                class="post-list-tags"><?php echo $post->tags??"<a href='#'>#trip</a>" ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $uid = -1;
                            if ($this->ion_auth->logged_in()) {
                                $user = $this->ion_auth->user()->row();
                                $uid = $user->id;
                            }
                            ?>
                            <div class="post-list-bookmark-quick col-sm-12 col-md-12 col-lg-4 mx-auto">
                                <div class="text-right">
                                    <i class="fa fa-heart<?= $post->liked == 1 ? "" : "-o" ?>" aria-hidden="true"
                                       onclick="ajaxLike(this,<?= $uid ?>,<?= $post->id ?>)"></i><?=$post->likeNum?>
                                    <i class="btn-Bookmark fa fa-bookmark<?= $post->bookmarked == 1 ? "" : "-o" ?>"
                                       aria-hidden="true"
                                       onclick="ajaxBookmark(this,<?= $uid ?>,<?= $post->id ?>)"></i><?=$post->bookmarkNum?>
                                </div>
                                <div class="text-right"><span
                                            class="timeago"><?php echo $post->update_at; ?></span>
                                </div>
                                <div class="text-right">
                                    <a href="/user/<?php echo $post->user->id; ?>"><span><?php echo $post->user->username; ?></span></a><br/><br/><br/>
                                    <i class="fa fa-eye" aria-hidden="true"></i><span
                                            class="post-right-item"><?php echo $post->read; ?></span>
                                    <i class="fa fa-comment" aria-hidden="true"></i><span
                                            class="post-right-item"><?php echo $post->comment; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} else { ?>

    <div class="text-center">
        <p>There is the no more post</p>
        <p><a href="/post/create" class="btn btn-primary">Create Post</a></p>
    </div>

<?php } ?>


<?php if (isset($page)) { ?>
    <div class="pagination-container">
        <input type="hidden" name="page" id="page" value="<?php echo $page; ?>"/>
        <?php if ($page > 1) { ?>
            <ul class="pagination pull-left">
                <li>
                    <a href="javascript:void(0);" class="page-button" data-id="<?php echo $page - 1; ?>">
                        <span> < Previous</span>
                    </a>
                </li>
            </ul>
        <?php } ?>

        <ul class="pagination">
            <li>
                <span class="page-info"><?php echo $page; ?> Page</span>
            </li>
        </ul>

        <?php if ($posts) { ?>
            <ul class="pagination pull-right">
                <li>
                    <a href="javascript:void(0);" class="page-button" data-id="<?php echo $page + 1; ?>">
                        <span> Next > </span>
                    </a>
                </li>
            </ul>
        <?php } ?>

    </div>
<?php } ?>