<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$brands = $args['brands'] ?? get_field('brands');
?>
<?php if (!empty($brands)) { ?>
    <div id="brands-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="swiper-holder">
            <div class="swiper-btn-prev"><?= inline('assets/images/swiper-btn.svg'); ?></div>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($brands as $brand) {
                        $icon_full = wp_get_attachment_image_url($brand, 'full');
                        $icon_wide = wp_get_attachment_image_url($brand, 'wide');
                        ?>
                        <div class="swiper-slide">
                            <div class="image"
                                 data-fancybox='gallery-brands' data-src='<?= $icon_full; ?>'>
                                <img src="<?= $icon_wide; ?>" alt="">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="swiper-btn-next"><?= inline('assets/images/swiper-btn.svg'); ?></div>
        </div>

        <div class="swiper-pagination"></div>
    </div>
<?php } ?>
