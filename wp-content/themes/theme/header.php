<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme
 */

$logo = wp_get_attachment_image_url(theme('logo_image'), 'full');
$logo_text = theme('logo_text');
$phones = @settings('phones');
$emails = @settings('emails');
$socials = @settings('socials');

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css"
    />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="site-header">
    <div class="header">
        <div class="container">
            <div class="header__top">
                <?php
                wp_nav_menu([
                    'theme_location' => 'mobileMenu',
                    'container' => false,
                    'menu' => 'Главное',
                    'menu_class' => 'menuTop',
                    'echo' => true,
                    'fallback_cb' => 'wp_page_menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 2,
                ]);
                ?>

                <div class="header__contacts">
                    <?php if (!empty($phones)) {
                        $phone_value = $phones[0]['value'];
                        $phone_name = $phones[0]['name'];
                        ?>
                        <a href="tel:<?= $phone_value; ?>" class="phone"><?= $phone_name; ?></a>
                    <?php } ?>

                    <?php if (!empty($socials)) { ?>
                        <div class="socials">
                            <?php foreach ($socials as $social) {
                                $value = $social['value'];
                                $icon = wp_get_attachment_image_url($social['icon'], 'wide');
                                ?>
                                <a href="<?= $value; ?>" class="social" target="_blank">
                                    <img src="<?= $icon; ?>" alt="">
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="burger open_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="header__bottom">
                <?php if ($logo || $logo_text) { ?>
                    <a href="/" class="logo">
                        <?php if ($logo) { ?>
                            <img src="<?= $logo; ?>" alt="" class="logo__image">
                        <?php } ?>

                        <?php if ($logo_text) { ?>
                            <span class="logo__text"><?= $logo_text; ?></span>
                        <?php } ?>
                    </a>
                <?php } ?>

                <div class="catalog-btn-wrapper">
                    <a href="/catalog" class="catalog btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4.16669 14.1667L10.8334 14.1667M4.16669 10H15.8334M9.16669 5.83334L15.8334 5.83334"
                                  stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        Каталог
                    </a>

                    <?php
                    wp_nav_menu([
                        'theme_location' => 'mobileMenu',
                        'container' => false,
                        'menu' => 'Каталог',
                        'menu_class' => 'menuTop',
                        'echo' => true,
                        'fallback_cb' => 'wp_page_menu',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth' => 2,
                    ]);
                    ?>
                </div>

                <?php echo do_shortcode('[fibosearch]'); ?>

                <a href="<?= wc_get_cart_url(); ?>" class="btn-svg cart-btn wc-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 3H3.26835C3.74213 3 3.97922 3 4.17246 3.08548C4.34283 3.16084 4.48871 3.2823 4.59375 3.43616C4.71289 3.61066 4.75578 3.84366 4.8418 4.30957L7.00004 16L17.4195 16C17.8739 16 18.1016 16 18.2896 15.9198C18.4554 15.8491 18.5989 15.7348 18.7051 15.5891C18.8255 15.424 18.8763 15.2025 18.9785 14.7597L20.5477 7.95972C20.7022 7.29025 20.7796 6.95561 20.6946 6.69263C20.6201 6.46207 20.4639 6.26634 20.256 6.14192C20.0189 6 19.6758 6 18.9887 6H5.15388M18 21C17.4477 21 17 20.5523 17 20C17 19.4477 17.4477 19 18 19C18.5523 19 19 19.4477 19 20C19 20.5523 18.5523 21 18 21ZM8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20C9 20.5523 8.55228 21 8 21Z"
                              stroke="#3679F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <div id="cart-count" class="number count">
                        <?= WC()->cart->get_cart_contents_count(); ?>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div id="mobile-mnu">
        <div id="close-mnu">×</div>

        <a href="/" class="logo__holder">
            <img src="<?= $logo; ?>" alt="" class="logo">
        </a>

        <h2>Меню</h2>
        <?php
        wp_nav_menu([
            'theme_location' => 'mobileMenu',
            'container' => false,
            'menu' => 'Главное',
            'menu_class' => 'menuTop',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 2,
        ]);
        ?>

        <h2>Каталог</h2>
        <?php
        wp_nav_menu([
            'theme_location' => 'mobileMenu',
            'container' => false,
            'menu' => 'Каталог',
            'menu_class' => 'menuTop',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 2,
        ]);
        ?>

        <?php if (!empty($phones)) { ?>
            <div class="phones__holder">
                <?php foreach ($phones as $item) { ?>
                    <a href="tel:<?= $item['value']; ?>" class="phone__item">
                        <?= file_get_contents(TEMPLATEPATH . '/assets/images/phone.svg'); ?>
                        <?= $item['name']; ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if (!empty($emails)): ?>
            <div class="email__holder">
                <?php foreach ($emails as $item) { ?>
                    <a href="mailto:<?= $item['value']; ?>" class="email__item">
                        <?= file_get_contents(TEMPLATEPATH . '/assets/images/mail.svg'); ?>
                        <?php echo $item['name']; ?>
                    </a>
                <?php } ?>
            </div>
        <?php endif ?>
        <?php if (!empty($adresses)): ?>
            <div class="adresses__holder">
                <?php foreach ($adresses as $adress) { ?>
                    <?= $adress['value']; ?>
                <?php } ?>
            </div>
        <?php endif ?>
        <?php if (!empty($socials)): ?>
            <div class="soc__holder">
                <?php foreach ($socials as $item) { ?>
                    <a href="<?= $item['value']; ?>" class="soc__item" target="_blank">
                        <?= get_image($item['icon'], [24, 24]); ?>
                    </a>
                <?php } ?>
            </div>
        <?php endif ?>
    </div>
</header><!-- #masthead -->
