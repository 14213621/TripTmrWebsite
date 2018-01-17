<div class="list-group post-list-group">
    <?php if ($posts) {

        foreach ($posts as $post) {
            ?>
            <div class="list-group-item post-list-item">
                <div class="mr-auto">
                    <h2 class="list-group-item-heading"><a
                            href="/post/show/?post_id=<?php echo $post->id; ?>"><?php echo $post->title; ?></a>
                    </h2>
                    <div class="meta">
                        <i class="fa fa-clock-o" aria-hidden="true"></i><span
                            class="timeago"><?php echo $post->update_at; ?></span>
                        <i class="fa fa-user-circle" aria-hidden="true"></i><a
                            href="/user?user_id=<?php echo $post->user->id; ?>"><span><?php echo $post->user->username; ?></span></a>
                    </div>
                </div>
                <div>
                    <div class="pull-right last-comment-at">
                        <div class="meta">
                            <div id="post-list-right-container">
                                <label class="post-category-item">
                                    <a href="/post?category_id=<?php echo $post->category->id; ?>">
                                        <span><?php echo $post->category->name; ?></span>
                                    </a>
                                </label>
                                <label style="width:50px;">
                                    <i class="fa fa-eye" aria-hidden="true"></i><span
                                        class="post-right-item"><?php echo $post->read; ?></span></label>
                                <label style="width:50px;">
                                    <i class="fa fa-comment" aria-hidden="true"></i><span
                                        class="post-right-item"><?php echo $post->comment; ?></span></label>

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


</div>

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