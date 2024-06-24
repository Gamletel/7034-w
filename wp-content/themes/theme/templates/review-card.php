<?php
$id = $post->ID;
$title = get_the_title($post);
$date = get_field('date', $post);
$text = get_field('text', $post);
$images = get_field('images', $post);
?>
<?php if ($text) { ?>
    <div class="review-card">
        <div class="review-card__head">
            <h5 class="review-card__title"><?= $title; ?></h5>

            <?php if ($date) { ?>
                <div class="review-card__date p3"><?= $date; ?></div>
            <?php } ?>
        </div>

        <div class="review-card__text text-block p2"><?= $text; ?></div>

        <?php if (!empty($images)) { ?>
            <div class="review-card__images">
                <?php foreach ($images as $item) {
                    $image_full = wp_get_attachment_image_url($item, 'full');
                    $image_wide = wp_get_attachment_image_url($item, 'wide');
                    ?>
                    <div class="image">
                        <img src="<?= $image_wide; ?>"
                             data-fancybox='gallery-review-<?= $id; ?>' data-src='<?= $image_full; ?>' alt="">
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>