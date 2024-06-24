<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$block_subtitle = get_field('block_subtitle');
$btn = get_field('btn');
$btn_text = $btn['text'];
$btn_link = $btn['link'];
$image = wp_get_attachment_image_url(get_field('image'), 'wide');

$additional_block_title = get_field('additional_block_title');
$additional_block_subtitle = get_field('additional_block_subtitle');
$additional_block_btn_text = get_field('additional_block_btn_text');
$additional_block_btn_link = get_field('additional_block_btn_link');
$additional_block_image = wp_get_attachment_image_url(get_field('additional_block_image'), 'wide');
?>
<?php if ($block_title) { ?>
    <div id="mainbanner-block" class="<?= $classes; ?> <?= $align; ?>">
        <div class="main-block">
            <div class="block__content">
                <?php if ($block_title) { ?>
                    <h1 class="block__title"><?= $block_title; ?></h1>
                <?php } ?>

                <?php if ($block_subtitle) { ?>
                    <div class="block__subtitle p1"><?= $block_subtitle; ?></div>
                <?php } ?>

                <?php if ($btn_text && $btn_link) { ?>
                    <a href="<?= $btn_link; ?>" class="block__btn btn invert">
                        <?= $btn_text; ?>
                    </a>
                <?php } ?>
            </div>

            <?php if ($image) { ?>
                <div class="block__bg">
                    <img src="<?= $image; ?>" alt="">
                </div>
            <?php } ?>
        </div>

        <?php if ($additional_block_title) { ?>
            <div class="additional-block">
                <h2 class="additional-block__title"><?= $additional_block_title; ?></h2>

                <?php if ($additional_block_subtitle) { ?>
                    <div class="additional-block__subtitle p2"><?= $additional_block_subtitle; ?></div>
                <?php } ?>

                <?php if ($additional_block_btn_text && $additional_block_btn_link) { ?>
                    <a href="<?= $additional_block_btn_link; ?>" class="additional-block__link">
                        <?= $additional_block_btn_text; ?>

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <path d="M4.16671 10.5L15.8334 10.5M15.8334 10.5L10.8334 5.5M15.8334 10.5L10.8334 15.5"
                                  stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                <?php } ?>

                <?php if ($additional_block_image) { ?>
                    <div class="additional-block__image">
                        <img src="<?= $additional_block_image; ?>" alt="">
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
