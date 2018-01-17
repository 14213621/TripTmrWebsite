<?php
/**
 * Created by PhpStorm.
 * User: Ca
 * Date: 17/4/2017
 * Time: 17:32
 */
$json = json_decode($post->content, true);
?>
<div class="tab-day">
    <ul class="nav nav-tabs" role="tablist">
        <?php for ($day = 1; $day <= sizeof($json); $day++) { ?>
            <li class="nav-item dayTab">
                <a class="nav-link <?php echo $day == 1 ? "active" : "" ?>" data-toggle="tab" href="#tab<?= $day ?>"
                   role="tab">Day <?= $day ?></a>
            </li>
        <?php } ?>
        <?php if ($edit) { ?>
            <li class="nav-item nav-extra">
                <a class="nav-link">+</a>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="tab-content">
    <?php for ($day = 0; $day < sizeof($json); $day++) { ?>
        <div class="tab-pane <?php echo ($day == 0) ? 'active' : '' ?>" id="tab<?= $day + 1 ?>" role="tabpanel">
            <div class="timeline  <?= ($edit == true) ? "editable" : "" ?>">
                <div class="line text-muted"></div>
                <div class="separator text-muted">
                    <time><?= $post->update_at ?></time>
                </div>

                <div class="article-list">
                    <?php for ($ar = 0; $ar < sizeof($json[$day]); $ar++) {
                        $row = $json[$day][$ar]; ?>
                        <article class="panel panel-outline <?= $edit ? "btn-group" : "" ?>">
                            <div class="panel-heading icon <?= iconClass($row['type']) ?>"
                                 data-toggle="dropdown"
                                 aria-haspopup="true"
                                 aria-expanded="false"
                                 data-type="<?= $row['type'] ?>">
                                <i class="fa <?= iconName($row['type']) ?>" aria-hidden="true"></i>
                            </div>
                            <?php ($edit == true && $row['type'] != "start") ? $this->load->view('template/option_dropdown') : "" ?>
                            <div class="panel-body" <?= ($edit == true && $row['type'] != "start") ? "contenteditable=\"false\"" : "" ?>>
                                <?= $row['content'] ?>
                            </div>
                        </article>
                    <?php } ?>
                </div>
                <?php if ($edit) { ?>

                    <article class="panel panel-outline">
                        <div class="panel-heading icon icon-white icon-hover btn-addarticle">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <div class="panel-body">
                            Add More
                        </div>
                    </article>
                <?php } ?>
                <!-- /Panel -->
            </div>
        </div>
        <!-- /Timeline -->
    <?php } ?>
</div>

<?php
function iconClass($name)
{
    switch ($name) {
        case "start":
            return "icon-start";
        case "gallery":
            return "icon-black";
        case "transport":
            return "icon-black";
        case "end":
            return "icon-end";
        case "bed":
            return "icon-blue";
        case "comment":
        default:
            return "icon-black";
    }
}

function iconName($name)
{
    switch ($name) {
        case "start":
            return "fa-plane";
        case "gallery":
            return "fa-file-image-o";
        case "transport":
            return "fa-car";
        case "end":
            return "fa-plane";
        case "bed":
            return "fa-bed";
        case "comment":
        default:
            return "fa-comment-o";
    }
}

?>

