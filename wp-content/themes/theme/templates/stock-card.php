<?php
$title = get_the_title($post);
$thumbnail = get_the_post_thumbnail_url($post, 'wide');
$additional_text = get_field('additional_text', $post);
$description = get_field('description', $post);
$btn = get_field('btn', $post);
$btn_text = $btn['text'];
$btn_link = $btn['link'];
?>
<?php if ($btn_link && $btn_text) { ?>
    <a href="<?= $btn_link; ?>" class="stock-card">
        <?php if ($additional_text) { ?>
            <div class="stock-card__additional-text"><?= $additional_text; ?></div>
        <?php } ?>

        <?php if ($thumbnail) { ?>
            <div class="stock-card__thumbnail">
                <img src="<?= $thumbnail; ?>" alt="">
            </div>
        <?php } ?>

        <div class="stock-card__content">
            <h3 class="stock-card__title"><?= $title; ?></h3>

            <?php if ($description) { ?>
                <div class="stock-card__description p2"><?= $description; ?></div>
            <?php } ?>

            <div class="stock-card__btn">
                <?= $btn_text; ?>

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                    <path d="M4.16732 10.5L15.834 10.5M15.834 10.5L10.834 5.5M15.834 10.5L10.834 15.5" stroke="#3679F3"
                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </a>
<?php } else { ?>
    <div class="stock-card">
        <?php if ($additional_text) { ?>
            <div class="stock-card__additional-text"><?= $additional_text; ?></div>
        <?php } ?>

        <?php if ($thumbnail) { ?>
            <div class="stock-card__thumbnail">
                <img src="<?= $thumbnail; ?>" alt="">
            </div>
        <?php } ?>

        <div class="stock-card__content">
            <h3 class="stock-card__title"><?= $title; ?></h3>

            <?php if ($description) { ?>
                <div class="stock-card__description p2"><?= $description; ?></div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
