<div class="main col-sm-9 col-md-9 clearfix" id="post-index">
    <?php
    $edit = false;
    if ($this->ion_auth->logged_in() && $post->user->id == $this->ion_auth->user()->row()->user_id) {

        // allow user to edit is show page
        //$edit = true;
        ?>
    <?php } ?>

    <div class="card">
        <?php if ($this->ion_auth->logged_in() && $post->user->id == $this->ion_auth->user()->row()->user_id) { ?>
            <div class="card-block">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <input type="hidden" value="<?php echo $post->id; ?>" id="post-id">
                    <button type="button" onclick="location.href = '/post/create?post_id=<?php echo $post->id; ?>'"
                            class="btn btn-primary">Edit
                    </button>
                    <button type="button" onclick="removeAlert()" class="btn btn-danger">Remove</button>
                </div>
            </div>
        <?php } ?>
        <div class="card-block" id="post-cover-photo"
             style="background: url(<?= $post->coverphoto ?>) no-repeat center center;min-height: 350px;">
            <div style="background:white; border: 1px solid black;background: white;border-radius: 5px;margin-top:10px;">
                <h4 class="card-title"><i class="fa fa-map-pin" aria-hidden="true"
                                          style="width:40px; color:#0a88ff; font-size:"></i><?php echo $post->title; ?>
                    <a
                            href="/post?category_id=<?php echo $post->category->id; ?>"
                            style="color:black;font-size:14px;"><span
                                alt="Trip Destination">(<?php echo $post->category->name; ?>)</span></a></h4>
                <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-usd" aria-hidden="true"
                                                             style="width:40px; color:green;"></i>$<?php echo $post->price??"$1000 - $5000" ?>
                </h6>

                <p class="card-text" style="margin-left:10px;">By <a style="color:black"
                                                                     href="/user/<?= $this->ion_auth->user($post->user_id)->row()->user_id ?>"><?= $this->ion_auth->user($post->user_id)->row()->username ?></a>
                </p>
                <div id="share-area"></div>
                <?php if ($this->ion_auth->logged_in()) {
                    $uid = $this->ion_auth->user()->row()->id ?>

                    <div style="background: azure;position: absolute;right: 0;top: 0;padding: 0px 5px;border-bottom-left-radius: 5px;"><span class="post-toolbar"><i
                                    class="btn-Bookmark fa fa-bookmark<?= $post->bookmarked == 1 ? "" : "-o" ?>"
                                    aria-hidden="true"
                                    onclick="ajaxBookmark(this,<?= $uid ?>,<?= $post->id ?>)"></i><span
                                    id="bookmarkCount"><?= $post->bookmarkNum ?></span></span><span
                                class="post-toolbar"><i class="fa fa-heart<?= $post->liked == 1 ? "" : "-o" ?>"
                                                        aria-hidden="true"
                                                        onclick="ajaxLike(this,<?= $uid ?>,<?= $post->id ?>)"></i><span
                                    id="likeCount"><?= $post->likeNum ?></span></span>
                    </div>

                <?php } ?>
            </div>
        </div>

        <div class="card-block">
            <div id="#post-content"><?php $this->load->view('template/plan_template', array('edit' => $edit)) ?></div>
        </div>
        <hr>
        <div class="card-block">
            <div class="comment-header">
                <label class="control-label">Comments</label>
            </div>
            <div id="showComment" class="comment-list">

            </div>
            <form class="form-horizontal" action="/post/commentPost" method="post"/>
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $post->id; ?>">
            <div class="control-group">
                <div class="controls">
                        <textarea name="content" id="content" rows="3" cols="50"
                                  class="form-control input-xlarge"></textarea>
                </div>
                <div id="contentAlert" class="alert-required">Email is not right</div>
            </div>
            <hr>

            <div class="control-group">
                <div class="controls">
                    <?php echo form_button(array('class' => 'btn btn-primary', 'name' => 'submit', 'id' => 'submit', 'type' => 'submit', 'content' => 'Submit')); ?>
                </div>
                <div id="submitAlert" class="alert-required">Email is not right</div>
            </div>
            </form>
        </div>
    </div>
</div>