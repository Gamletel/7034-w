<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$image = $args['image'] ?? get_field('image');
if ($image) {
    $image_url = wp_get_attachment_image_url($image, 'wide');
}
$text = $args['text'] ?? get_field('text');
?>
<?php if ($text) { ?>
    <div id="seo-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($image) {?>
            <div class="image">
                <img src="<?= $image_url; ?>" alt="">
            </div>
        <?php } ?>

        <div class="text-block p2 simple-scroll-block"><?= $text; ?></div>
    </div>
<?php } ?>
