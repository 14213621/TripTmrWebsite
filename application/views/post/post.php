<?php if ($posts) {
    foreach ($posts as $post) {
        ?>
        <div class="card-block">
            <h4 class="card-title"><?php echo $post->title; ?></h4>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $post->price??"$1000 - $5000" ?></h6>
            <p class="card-text"><a
                        href="/post?category_id=<?php echo $post->category->id; ?>"><span
                            alt="Trip Destination"><?php echo $post->category->name; ?></span></a></p>
            <div id="share-area"></div>
        </div>
    <?php } ?>
<?php } else { ?>

    <div class="text-center">
        <p>There is no post here</p>
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