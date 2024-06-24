<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$addresses = @settings('addresses');
$phones = @settings('phones');
$emails = @settings('emails');
$socials = @settings('socials');
$times = @settings('times');
?>
<div id="contacts-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
    <div class="block__contacts">
        <?php if (!empty($addresses)) { ?>
            <?php foreach ($addresses as $item) {
                $name = $item['name'];
                $value = $item['value'];
                ?>
                <div class="contacts">
                    <div class="contacts__title p2"><?= $name; ?></div>

                    <h6 class="contact">
                        <?= $value; ?>
                    </h6>
                </div>
            <?php } ?>
        <?php } ?>

        <?php if (!empty($phones)) { ?>
            <div class="contacts">
                <div class="contacts__title body-16">Телефон</div>

                <div class="contacts__wrapper">
                    <?php foreach ($phones as $item) {
                        $value = $item['value'];
                        $name = $item['name'];
                        ?>
                        <a href="tel:<?= $value; ?>" class="contact phone">
                            <?= $name; ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty($times)) {?>
            <div class="contacts">
                <div class="contacts__title body-16">Режим работы</div>

                <div class="contacts__wrapper">
                    <?php foreach ($times as $item) {
                        $value = $item['value'];
                        ?>
                        <div class="contact">
                            <?= $value; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty($emails)) { ?>
            <div class="contacts">
                <div class="contacts__title body-16">Электронная почта</div>

                <div class="contacts__wrapper">
                    <?php foreach ($emails as $item) {
                        $value = $item['value'];
                        $name = $item['name'];
                        ?>
                        <a href="mailto:<?= $value; ?>" class="contact email">
                            <?= $name; ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        
        <?php if (!empty($socials)) {?>
            <div class="block__socials">
                <?php foreach ($socials as $social) { 
                    $value = $social['value'];
                    $icon = wp_get_attachment_image_url($social['icon'], 'wide');
                    ?>
                    <a href="<?= $value; ?>" target="_blank" class="social">
                        <img src="<?= $icon; ?>" alt="">
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <div class="block__map"><?php render_map() ?></div>
</div>