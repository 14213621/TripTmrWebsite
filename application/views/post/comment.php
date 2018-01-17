<?php
$c = 0;
if ($comments) {
    foreach ($comments as $comment) { ?>
        <div class="card mb-3">
            <div class="card-header"># <?= ++$c ?>
                <span class=""><a
                            href="/user/<?php echo $comment->user->id; ?>"><?php echo $comment->user->username; ?></a></span><span
                        class="float-right timeago"><?php echo $comment->create_at; ?></span>
            </div>
            <div class="card-block">
                <blockquote class="card-blockquote">
                    <p><?php echo $comment->content; ?></p>
                </blockquote>
            </div>
        </div>
    <?php }
} ?>
<!--

        <div class="comment-list-item">
            <div class="row">
                <div class="hidden-sm-down col-sm-2 col-md-2"><img src="/vendor/img/post/default-avatar.png" width="50"></div>
                <div class="col-xs-12 col-sm-10 col-md-10">
                    <div class="meta">
                        <a href="/user?user_id=<?php //echo $comment->user->id; ?>">
                            <i class="glyphicon glyphicon-user"></i>
                            <span><?php //echo $comment->user->username; ?></span>
                        </a>
                        <i class="glyphicon glyphicon-time"></i>
                        <span class="timeago"><?php echo $comment->create_at; ?></span>
                    </div>
                    <p class="comment-content"><?php echo $comment->content; ?></p></div>
            </div>
        </div>

-->