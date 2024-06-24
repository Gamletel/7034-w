<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$title = $args['title'] ?? get_field('title');
$text = $args['text'] ?? get_field('text');
$image = $args['image'] ?? get_field('image');
if ($image) {
    $image_url = wp_get_attachment_image_url($image, 'wide');
}
$btn = get_field('btn');
$btn_link = $btn['link'];
$btn_text = $btn['text'];
?>
<?php if ($title && $text) { ?>
    <div id="stock-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <div class="block__title"><?= $title; ?></div>

        <?php if ($btn_link && $btn_text) { ?>
            <div class="block__content">
                <h3 class="block__text"><?= $text; ?></h3>

                <a href="<?= $btn_link; ?>" class="btn invert"><?= $btn_text; ?></a>
            </div>
        <?php } else { ?>

            <h2 class="block__text"><?= $text; ?></h2>
        <?php } ?>

        <?php if ($image) { ?>
            <div class="block__image">
                <img src="<?= $image_url; ?>" alt="">
            </div>
        <?php } ?>
    </div>
<?php } ?>