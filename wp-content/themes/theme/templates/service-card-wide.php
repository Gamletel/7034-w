<?php
$thumbnail = get_the_post_thumbnail_url($post, 'wide');
$title = get_the_title($post);
$description = get_field('description', $post);
$price = get_field('price', $post);
?>
<div class="service-card-wide">
    <?php if ($thumbnail) { ?>
        <div class="service-card-wide__thumbnail">
            <div class="image">
            <img src="<?= $thumbnail; ?>" alt="">
            </div>
        </div>
    <?php } ?>

    <div class="service-card-wide__content">
        <h4 class="service-card-wide__title"><?= $title; ?></h4>

        <?php if ($description) { ?>
            <div class="service-card-wide__description text-block p2"><?= $description; ?></div>
        <?php } ?>

        <div class="service-card-wide__bottom">
            <?php if ($price) {?>
                <h4 class="service-card-wide__price"><?= $price; ?></h4>
            <?php } ?>

            <div class="service-card-wide__btn btn" data-modal="callback">Оставить заявку</div>
        </div>
    </div>
</div>
