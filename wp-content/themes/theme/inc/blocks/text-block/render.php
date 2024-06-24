<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$text = get_field('text');
?>
<?php if ($text) { ?>
    <div id="text-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <div class="block-title-wrapper">
                <h2 class="block-title"><?= $block_title; ?></h2>
            </div>
        <?php } ?>

        <div class="block__text text-block p2"><?= $text; ?></div>
    </div>
<?php } ?>
