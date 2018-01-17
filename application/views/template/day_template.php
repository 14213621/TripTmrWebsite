<?php $edit = true ?>
<div class="tab-pane" id="tab<?= $day ?>" role="tabpanel">
    <!-- Timeline -->
    <div class="timeline editable">
        <div class="line text-muted"></div>
        <div class="separator text-muted">
            <time>You are in editor mode.</time>
        </div>

        <div class="article-list">
            <article class="panel panel-outline <?= $edit ? "btn-group" : "" ?>">
                <div class=" panel-heading icon icon-start" data-toggle="dropdown"
                     aria-haspopup="true"
                     aria-expanded="false"
                     data-type="start">
                    <i class="fa fa-plane" aria-hidden="true"></i>
                </div>
                <? if ($edit ? "btn-group" : "") { ?>
                    <div class="dropdown-menu ">
                        <button class="dropdown-item icon-start" data-trip-option="start" type="button"
                                value="plane"><i class="fa fa-plane" aria-hidden="true"></i>
                        </button>
                        <button class="dropdown-item icon-black" data-trip-option="gallery" type="button"
                                value="">
                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                        </button>
                        <button class="dropdown-item icon-black" data-trip-option="transport" type="button"
                                value=""><i class="fa fa-car" aria-hidden="true"></i>
                        </button>
                        <button class="dropdown-item icon-black" data-trip-option="comment" type="button">
                            <i class="fa fa-comment-o" aria-hidden="true"></i></button>
                        <button class="dropdown-item icon-blue" data-trip-option="bed" type="button" value=""><i
                                    class="fa fa-bed" aria-hidden="true"></i>
                        </button>
                        <button class="dropdown-item icon-end" data-trip-option="end" type="button">
                            <i class="fa fa-plane" aria-hidden="true"></i></button>
                    </div>
                <? } ?>
                <div class="panel-body">
                    <strong>Day <?= $day ?></strong> has begin.
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