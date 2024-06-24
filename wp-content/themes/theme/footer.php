<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Company
 */

$footer_links_block = theme('footer_links_block');
$footer_links_block_links = $footer_links_block['links'];
$footer_additional_text = theme('footer_additional_text');
$phones = @settings('phones');
$socials = @settings('socials');

?>

<?php if (!empty($footer_links_block_links)) {
    ?>
    <div class="container">
        <?php get_template_part('inc/blocks/links-block/render',
            null,
            array(
                'block_title' => $footer_links_block['block_title'],
                'links' => $footer_links_block['links'],
            ));
        wp_enqueue_style('links-block', get_template_directory_uri() . '/inc/blocks/links-block/block.css', array(), 2);
        wp_enqueue_script('links-block', get_template_directory_uri() . '/inc/blocks/links-block/block.js', array(), 2);
        ?>
    </div>
<?php } ?>

<footer id="footer" class="site-footer">
    <div class="notice"></div>

    <div class="footer">
        <div class="footer__top">
            <div class="container">
                <div class="footer__top-wrapper">
                    <div class="menus">
                        <div class="menu">
                            <h6 class="menu__title">Меню</h6>

                            <?php
                            wp_nav_menu([
                                'theme_location' => 'mobileMenu',
                                'container' => false,
                                'menu' => 'Главное-футер',
                                'menu_class' => 'menuFooter',
                                'echo' => true,
                                'fallback_cb' => 'wp_page_menu',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth' => 2,
                            ]);
                            ?>
                        </div>

                        <div class="menu">
                            <h6 class="menu__title">Каталог</h6>

                            <?php
                            wp_nav_menu([
                                'theme_location' => 'mobileMenu',
                                'container' => false,
                                'menu' => 'Каталог-футер',
                                'menu_class' => 'menuFooter',
                                'echo' => true,
                                'fallback_cb' => 'wp_page_menu',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth' => 2,
                            ]);
                            ?>
                        </div>

                        <div class="menu">
                            <h6 class="menu__title">Сервис</h6>

                            <?php
                            wp_nav_menu([
                                'theme_location' => 'mobileMenu',
                                'container' => false,
                                'menu' => 'Сервис-футер',
                                'menu_class' => 'menuFooter',
                                'echo' => true,
                                'fallback_cb' => 'wp_page_menu',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth' => 2,
                            ]);
                            ?>
                        </div>

                        <div class="menu">
                            <h6 class="menu__title">О компании</h6>

                            <?php
                            wp_nav_menu([
                                'theme_location' => 'mobileMenu',
                                'container' => false,
                                'menu' => 'О-компании-футер',
                                'menu_class' => 'menuFooter',
                                'echo' => true,
                                'fallback_cb' => 'wp_page_menu',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth' => 2,
                            ]);
                            ?>
                        </div>
                    </div>

                    <div class="contacts">
                        <div class="btn" data-modal="callback">Задать вопрос</div>

                        <?php if (!empty($phones)) { ?>
                            <div class="contact">
                                <?php foreach ($phones as $item) {
                                    $value = $item['value'];
                                    $name = $item['name'];
                                    ?>
                                    <a href="tel:<?= $value; ?>" class="item phone">
                                        <?= $name; ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($socials)) { ?>
                            <div class="socials">
                                <?php foreach ($socials as $item) {
                                    $value = $item['value'];
                                    $icon = wp_get_attachment_image_url($item['icon'], 'wide');
                                    ?>
                                    <a href="<?= $value; ?>" target="_blank" class="social">
                                        <img src="<?= $icon; ?>" alt="">
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__bottom">
            <div class="container">
                <div class="footer__bottom-wrapper">
                    <a href="/privacy-policy" class="policy p3" target="_blank">
                        Политика конфиденциальности
                    </a>

                    <a href="https://grampus-studio.ru/?utm_source=client&utm_keyword=<?= get_site_url(); ?>;"
                       target="_blank" class="grampus p3">
                        Сайт разработан

                        <?= inline('assets/images/GRAMPUS.svg'); ?>
                    </a>

                    <?php if ($footer_additional_text) { ?>
                        <div class="additional-text p3"><?= $footer_additional_text; ?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php global $woocommerce;
$logo = wp_get_attachment_image_url(theme('logo_image'), 'full');
$logo_text = theme('logo_text');
$phone = @settings('phones')[0];
$phone_value = $phone['value'];
$phone_name = $phone['name'];
$date = date('d.m.Y H:i');
$items = $woocommerce->cart->get_cart();
$cart_amount = WC()->cart->cart_contents_total;
$cart_products_count = WC()->cart->get_cart_contents_count();

function getUnitCase( $value, $unit1, $unit2, $unit3 ){
    $value = abs( (int)$value );
    if( ($value % 100 >= 11) && ($value % 100 <= 19) ){
        return $unit3;
    }else{
        switch( $value % 10 ){
            case 1:
                return $unit1;
            case 2:case 3:case 4:
            return $unit2;
            default:
                return $unit3;
        }
    }
}

?>
<div id="invoice" class="invoice">
    <div class="invoice__header">
        <?php if ($logo || $logo_text) { ?>
            <div class="invoice__logo">
                <?php if ($logo) { ?>
                    <div class="logo__image">
                        <img src="<?= $logo; ?>" alt="">
                    </div>
                <?php } ?>

                <?php if ($logo_text) { ?>
                    <div class="logo__text"><?= $logo_text; ?></div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if ($phone) { ?>
            <a href="tel:<?= $phone_value; ?>" class="invoice__phone">
                <?= $phone_name; ?>
            </a>
        <?php } ?>
    </div>

    <h5 class="invoice__date">Корзина от <?= $date; ?></h5>

    <table class="products-table">
        <thead class="products-table__header">
        <td class="data">№</td>

        <td></td>

        <td class="data">Наименование</td>

        <td class="data">Артикул</td>

        <td class="data">Цена</td>

        <td class="data">Кол-во</td>

        <td class="data price">Сумма</td>
        </thead>

        <tbody>
        <?php
        $index = 0;
        foreach ($items as $key => $values) {
            $index++;
            $product = wc_get_product($values['data']->get_id());
            $thumbnail = $product->get_image();
            $title = $product->get_title();
            $sku = $product->get_sku();
            $quantity = $values['quantity'];
            $price = $product->get_price();
            $all_price = $price * $quantity;
            ?>
            <tr class="products-table__product">
                <td class="product__index"><?= $index; ?></td>

                <td class="product__thumbnail">
                    <?php if ($thumbnail) { ?>
                        <div class="thumbnail"><?= $thumbnail; ?></div>
                    <?php } ?>
                </td>

                <td class="product__title"><?= $title; ?></td>

                <td class="product__sku">
                    <?php if ($sku) { ?>
                        <?= $sku; ?>
                    <?php } ?>
                </td>

                <td class="product__price"><?= $price; ?></td>

                <td class="product__quantity"><?= $quantity; ?> шт.</td>

                <td class="product__all-price"><?= $all_price; ?> ₽</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <div class="invoice__after-table">
        <div class="after-table__date">
            Цены действительны на момент печати <?= $date; ?>
        </div>

        <div class="after-table__amount">
            Итого: <?= $cart_amount; ?> ₽
        </div>
    </div>
    
    <div class="invoice__products-count">
        <?= $cart_products_count; ?>

        <?= getUnitCase($cart_products_count, 'товар', 'товара', 'товаров'); ?>
    </div>
</div>

<div id="modal-callback" class="theme-modal">
    <div class="close-modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M9.47297 0L6 3.47295L2.52705 0L0 2.52705L3.47297 6L0 9.47295L2.52703 12L6 8.52703L9.47297 12L12 9.47295L8.52703 5.99998L12 2.52703L9.47297 0Z" fill="#818187"/>
        </svg>
    </div>
    <div class="form__holder">
        <?php get_form('callback') ?>
    </div>
</div>

<div id="modal-review" class="theme-modal">
    <div class="close-modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M9.47297 0L6 3.47295L2.52705 0L0 2.52705L3.47297 6L0 9.47295L2.52703 12L6 8.52703L9.47297 12L12 9.47295L8.52703 5.99998L12 2.52703L9.47297 0Z" fill="#818187"/>
        </svg>
    </div>
    <div class="form__holder">
        <?php get_form('review') ?>
    </div>
</div>

<div id="modal-success" class="theme-modal">
    <div class="close-modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M9.47297 0L6 3.47295L2.52705 0L0 2.52705L3.47297 6L0 9.47295L2.52703 12L6 8.52703L9.47297 12L12 9.47295L8.52703 5.99998L12 2.52703L9.47297 0Z" fill="#818187"/>
        </svg>
    </div>

    <h2 class="block-title">
        Форма отправлена
    </h2>

    <a href="/" class="btn">Закрыть</a>
</div>

<div id="modal-error" class="theme-modal">
    <div class="close-modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M9.47297 0L6 3.47295L2.52705 0L0 2.52705L3.47297 6L0 9.47295L2.52703 12L6 8.52703L9.47297 12L12 9.47295L8.52703 5.99998L12 2.52703L9.47297 0Z" fill="#818187"/>
        </svg>
    </div>

    <h2 class="block-title">
        Ошибка!
    </h2>

    <div class="p2">
        Во время отправки произошла ошибка, пожалуйста, попробуйте позже!
    </div>

    <a href="/" class="btn">Закрыть</a>
</div>

<?php wp_footer(); ?>

<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>


</body>
</html>