<?php
$thumbnail = get_the_post_thumbnail_url($post, 'wide');
$title = get_the_title($post);
$short_description = get_field('short_description', $post);
$price = get_field('price', $post);
?>
<div class="service-card-medium">
    <?php if ($thumbnail) { ?>
        <div class="service-card-medium__thumbnail">
            <div class="image">
            <img src="<?= $thumbnail; ?>" alt="">
            </div>
        </div>
    <?php } ?>

    <div class="service-card-medium__content">
        <h4 class="service-card-medium__title"><?= $title; ?></h4>

        <?php if ($short_description) { ?>
            <div class="service-card-medium__short-description text-block p2"><?= $short_description; ?></div>
        <?php } ?>

        <div class="service-card-medium__bottom">
            <?php if ($price) {?>
                <h4 class="service-card-medium__price"><?= $price; ?></h4>
            <?php } ?>

            <div class="service-card-medium__btn btn-svg invert" data-modal="callback"><?= inline('assets/images/swiper-btn.svg'); ?></div>
        </div>
    </div>
</div>
