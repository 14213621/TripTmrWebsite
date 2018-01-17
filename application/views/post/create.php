<div class="main col-sm-9 clearfix">
    <?php $valid = $post && !$error; ?>
    <input type="hidden" value="1" id="editorModeOn">
    <input type="hidden" value="<?= $valid ? $post->id : "-1" ?>" id="post-id">
    <div class="card mb-3" id="trip-info">
        <div class="card-header"><?= $valid ? "Edit trip plan" : "Create A trip plan" ?></div>
        <div class="card-block">
            <?php echo form_open("post/" . $valid ? "createPost" : "createPost", array('id' => 'createPostForm')) ?>
            <div class="form-group row">
                <label class="col-3 col-form-label">Title</label>
                <div class="col-9">
                    <input class="form-control" name="title" type="text" id="post-title"
                           value="<?= ($valid) ? $post->title : "" ?>"
                           placeholder="Enter your trip title">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label">Location</label>
                <div class="col-9">
                    <select class="form-control" name="category_id" id="post-categoryid">
                        <option value=""></option>
                        <?php foreach ($categories as $category) { ?>
                            <option value=<?php echo $category->id; ?>
                                    <?php if ($post && $post->category->id == $category->id) { ?> selected="selected" <?php } ?> >
                                <?php echo $category->name; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label">Price Consumed ($HKD)</label>
                <div class="col-9">
                    <input class="form-control" id="post-price" name="price" type="number" min="0"
                           value="<?= ($valid) ? $post->price : "" ?>"
                           placeholder="" id="input_price" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label">Cover Photo</label>
                <div class="col-9">
                    <div class="uploadedCover"
                         style="<?= ($valid) ? "class='img-fluid'" : "" ?>"><?php if ($valid) {
                            ?>
                            <img src="<?= $post->coverphoto ?>" style="width: 300px;"
                                 class="fr-fic fr-dib fr-draggable fr-fil img-fluid"><a href='#!'
                                                                                        onclick='reUploadCover()'>[Remove]</a>
                        <?php } ?>
                    </div>
                    <label class="custom-file" id="coverphoto_upload" style="<?= ($valid) ? "display:none" : "" ?>">
                        <input type="file" id="coverphoto" class="custom-file-input" required>
                        <span class="custom-file-control"></span>
                    </label>
                    <input type="hidden" id="input_coverphoto_path" name="input_coverphoto_path" value="<?= ($valid)?$post->coverphoto:"" ?>">
                </div>
            </div>

            <input type="hidden" id="post-day" name="day" value="1">
            <input type="hidden" id="post-content" name="content" value="">
            <?= form_close() ?>
        </div>
        <div class="card-block">
            <?php
            if ($valid) { ?>
                <input type="hidden" id="post-editid" value="<?= $post->id ?>">
                <div id="#post-content"><?php $this->load->view('template/plan_template', array('edit' => true)) ?></div>
            <?php } else { ?>
                <div class="tab-day">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item dayTab">
                            <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">Day 1</a>
                        </li>
                        <li class="nav-item nav-extra">
                            <a class="nav-link">+</a>
                        </li>
                    </ul>
                </div>
                <!-- Tab panes -->
                <?php $edit = true ?>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1" role="tabpanel">
                        <!-- Timeline -->
                        <div class="timeline editable">
                            <div class="line text-muted"></div>
                            <div class="separator text-muted">
                                <time>You are in editor mode.</time>
                            </div>

                            <div class="article-list">
                                <?php echo form_open_multipart('/upload/do_upload', array('id' => 'ajaxupload')) ?>
                                <input type="file" id="my_file" style="display:none">
                                </form>
                                <article class="panel panel-outline <?= $edit ? "btn-group" : "" ?>">
                                    <div class=" panel-heading icon icon-start" data-toggle="dropdown"
                                         aria-haspopup="true"
                                         aria-expanded="false"
                                         data-type="start">
                                        <i class="fa fa-plane" aria-hidden="true"></i>
                                    </div>
                                    <div class="panel-body">
                                        <strong>Day 1</strong> has begin.
                                    </div>
                                </article>

                            </div>
                            <article class="panel panel-outline">
                                <div class="panel-heading icon icon-white icon-hover btn-addarticle">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </div>
                                <div class="panel-body">
                                    Add More
                                </div>
                            </article>
                            <!-- /Panel -->
                        </div>
                        <!-- /Timeline -->
                    </div>
                </div>
            <?php } ?>
            <button class="btn btn-danger">< Back</button>
            <button class="btn btn-primary" onclick="submitPlan()">Submit</button>
        </div>
    </div>

</div>

