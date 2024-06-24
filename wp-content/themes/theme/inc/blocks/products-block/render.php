<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';
$block_id = $block['id'];
$block_title = $args['block_title'] ?? get_field('block_title');
$products = $args['products'] ?? get_field('products');
?>
<?php if (!empty($products)) { ?>
    <div id="products-block" class="products-block-<?= $block_id; ?> block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="swiper-holder">
            <div class="swiper-btn-prev"><?= inline('assets/images/swiper-btn.svg'); ?></div>

            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($products as $item) {
                        $product = wc_get_product($item);
                        $post_object = get_post($product->get_id());

                        setup_postdata($GLOBALS['post'] =& $post_object);
                        ?>
                        <div class="swiper-slide">
                            <?php wc_get_template_part('content', 'product'); ?>
                        </div>
                    <?php } wp_reset_postdata();?>
                </div>
            </div>

            <div class="swiper-btn-next"><?= inline('assets/images/swiper-btn.svg'); ?></div>
        </div>

        <div class="swiper-pagination"></div>

        <script>
            jQuery(document).ready(function($){

                new Swiper('#products-block.products-block-<?= $block_id; ?> .swiper',{
                    autoHeight: true,
                    breakpoints:{
                        320:{
                            slidesPerView: 1,
                            spaceBetween: 15,
                        },
                        375:{
                            slidesPerView: 2,
                            spaceBetween: 15,
                        },
                        769:{
                            slidesPerView: 3,
                            spaceBetween: 15,
                        },
                        1221:{
                            slidesPerView: 4,
                            spaceBetween: 30,
                        }
                    },
                    navigation:{
                        prevEl: '#products-block.products-block-<?= $block_id; ?> .swiper-btn-prev',
                        nextEl: '#products-block.products-block-<?= $block_id; ?> .swiper-btn-next',
                    },
                    pagination:{
                        el: '#products-block.products-block-<?= $block_id; ?> .swiper-pagination'
                    }
                })

            });
        </script>
    </div>
<?php } ?>
