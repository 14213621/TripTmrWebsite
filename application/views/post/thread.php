<?php if ($posts) {
    ?>
    <div class="card-columns">
        <?php
        foreach ($posts as $post) {
            ?>
            <div class="card <?= isset($thread) ? 'mb-3' : 'hvr-glow' ?> ">
                <?php if ($post->bookmarked == 1) { ?>
                    <div class="thread-header text-center" style="">
                        <a href="/post/show/<?php echo $post->id; ?>"
                           style="font-size:12px; color:black;">Bookmarked</a></div>
                <?php } ?>

                <a href="/post/show/<?php echo $post->id; ?>"><img class="card-img-top img-fluid"
                                                                   src="<?= $post->coverphoto ?>"
                                                                   alt="<?php echo $post->title; ?>"></a>
                <div class="card-block" style="padding:10px 15px 5px 15px">
                    <h3 class="post-list-title"><a style="word-wrap: break-word"
                                                   href="/post/show/<?php echo $post->id; ?>"><?php echo $post->title; ?>
                        </a>
                        <?php $postuser = $this->ion_auth->user($post->user_id)->row() ?>
                        <span style="font-size:12px;">(<?= $post->commentsNum ?>) - <a
                                    href="/user/<?= $postuser->id ?>"><?= $postuser->username ?></a></span>
                    </h3>
                    <div class="post-list-details">
                        <div>
                            <i class="fa fa-map-pin" aria-hidden="true"></i><a
                                    href="/post?category_id=<?php echo $post->category->id; ?>"><span
                                        alt="Trip Destination"><?php echo $post->category->name; ?></span></a>
                        </div>
                        <div>
                            <i class="fa fa-usd"
                               aria-hidden="true"
                               alt="Trip Used Price"></i><span>$ <?php echo $post->price??"Not Provided" ?></span>
                        </div>
                        <div>
                            <i class="fa fa-male"
                               aria-hidden="true"
                               alt="Trip Used Price"></i><span><?php echo $post->day??"Not Provided" ?> Day(s)</span>
                        </div>
                        <!--
                        <div>
                            <i class="fa fa-tags" aria-hidden="true" alt="Tag"></i><span
                                    class="post-list-tags"><?php echo $post->tags??"<a href='#'>#trip</a>" ?></span>
                        </div>
                        <div>
                            <i class="fa fa-map-signs" aria-hidden="true" alt="Custom Tag"></i><span
                                    class="post-list-tags"><?php echo $post->tags??"<a href='#'>#trip</a>" ?></span>
                        </div>-->
                    </div>
                </div>

                <div class="thread-footer text-right" style="">
                    <a href="/post/show/<?php echo $post->id; ?>"
                       style="font-size:12px;">Read More</a></div>
            </div>
        <?php } ?>
    </div>
<?php } else { ?>

    <div class="text-center">
        <p>There is no post here.</p>
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