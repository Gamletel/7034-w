<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align   = (isset($block['align']) && !empty($block['align'])) ? 'align'.$block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$advantages = $args['advantages'] ?? get_field('advantages');
?>
<?php if (!empty($advantages)) {?>
<div id="advantages-block" class="block-margin <?=$classes;?> <?=$align;?>">
    <?php if ($block_title) {?>
        <h2 class="block-title"><?= $block_title; ?></h2>
    <?php } ?>
    
    <div class="advantages">
        <?php foreach ($advantages as $advantage) { 
            $icon = wp_get_attachment_image_url($advantage['icon'],'wide');
            $text = $advantage['text'];
            ?>
            <div class="advantage">
                <?php if ($icon) {?>
                    <div class="advantage__icon">
                        <img src="<?= $icon; ?>" alt="">
                    </div>
                <?php } ?>
                
                <?php if ($text) {?>
                    <div class="advantage__text p2"><?= $text; ?></div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
