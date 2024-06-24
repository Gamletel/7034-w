<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$categories = get_field('categories');
?>
<?php if (!empty($categories)) { ?>
    <div id="categories-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="categories">
            <?php foreach ($categories as $category) {
                $category = get_term($category);
                wc_get_template(
                    'content-product_cat.php',
                    array(
                        'category' => $category,
                    )
                );
            } ?>
        </div>
    </div>
<?php } ?>
