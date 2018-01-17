<?php
$c = 0;
foreach ($categories as $category) {
    $c += $category->count;
} ?>
<a href="/post?category_id=">
    <li class="list-group-item list-group-item-action">
        Show All
    </li>
</a>

<?php foreach ($categories as $category) { ?>
    <a href="/post?category_id=<?php echo $category->id; ?>">
        <li class="list-group-item list-group-item-action  justify-content-between"> 
            <?php echo $category->name; ?><span
                    class="badge badge-default badge-pill"><?=$category->count?></span>
        </li>
    </a>

<?php } ?>

<!--
        <li class="list-group-item justify-content-between">
            <a href="/post?category_id=<?php echo $category->id; ?>"><?php echo $category->name; ?></a>
            <span class="badge badge-default badge-pill"><?= $category->count ?></span>
        </li>
-->