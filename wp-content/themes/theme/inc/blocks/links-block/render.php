<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$links = $args['links'] ?? get_field('links');
?>
<?php if (!empty($links)) { ?>
    <div id="links-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="links">
            <?php foreach ($links as $item) {
                $icon = wp_get_attachment_image_url($item['image'], 'wide');
                $link = $item['link'];
                $title = $item['title'];
                ?>
                <a href="<?= $link; ?>" class="link">
                    <h5 class="link__title"><?= $title; ?></h5>

                    <div class="link__btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M3 12H21M21 12L16 7M21 12L16 17" stroke="#3679F3" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    
                    <?php if ($icon) {?>
                        <div class="link__icon">
                            <img src="<?= $icon; ?>" class="style-svg" alt="">
                        </div>
                    <?php } ?>
                </a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
