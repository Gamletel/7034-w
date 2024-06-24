<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';


$garants = get_field('garants');
$garants_title = $garants['title'];
$garants_text = $garants['text'];
$garants_icon = wp_get_attachment_image_url($garants['icon'], 'wide');

$back = get_field('back');
$back_title = $back['title'];
$back_text = $back['text'];
$back_icon = wp_get_attachment_image_url($back['icon'], 'wide');
?>
<div id="two-text-blocks" class="block-margin <?= $classes; ?> <?= $align; ?>">
    <?php if ($garants_text) {?>
        <div class="garants block__content">
            <?php if ($garants_title) {?>
                <h2 class="content__title">
                    <?= $garants_title; ?>
                </h2>
            <?php } ?>
            
            <?php if ($garants_text) {?>
                <div class="content__text text-block p2"><?= $garants_text; ?></div>
            <?php } ?>

            <?php if ($garants_icon) {?>
                <div class="content__icon">
                    <img src="<?= $garants_icon; ?>" alt="">
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if ($back_text) {?>
        <div class="back block__content">
            <?php if ($back_title) {?>
                <h2 class="content__title">
                    <?= $back_title; ?>
                </h2>
            <?php } ?>

            <?php if ($back_text) {?>
                <div class="content__text text-block p2"><?= $back_text; ?></div>
            <?php } ?>

            <?php if ($back_icon) {?>
                <div class="content__icon">
                    <img src="<?= $back_icon; ?>" alt="">
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
