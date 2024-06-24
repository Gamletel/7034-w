<?php

class WooThemeFunctions
{
    /*
     * WC GLOBAL
     */
    function change_existing_currency_symbol($currency_symbol, $currency)
    {
        switch ($currency) {
            case 'RUB':
                $currency_symbol = 'руб';
                break;
        }
        return $currency_symbol;
    }

    public function error_fade_out()
    {
        // если находимся не на странице оформления заказа, то ничего не делаем
        if (!is_checkout()) {
            return;
        }

        wc_enqueue_js("
		$( document.body ).on( 'checkout_error', function(){
			setTimeout( function(){
				$('.woocommerce-error').fadeOut( 300 );
			}, 2000);
		})
	");
    }

    public function wc_refresh_mini_cart_count($fragments)
    {
        ob_start();
        $products_count = WC()->cart->get_cart_contents_count();
        if ($products_count > 99) {
            $products_count = '99+';
        }
        ?>
        <div id="cart-count">
            <?php echo $products_count; ?>
        </div>
        <?php
        $fragments['#cart-count'] = ob_get_clean();
        return $fragments;
    }

    public function woo_custom_cart_button_text()
    {
        return __('ДОБАВИТЬ В КОРЗИНУ', 'woocommerce');
    }

    function custom_sale_price($price, $product)
    {
        if ($product->is_on_sale()) {
            $sale_price = $product->get_sale_price();
            $regular_price = $product->get_regular_price();
            return '
<div class="product-price">
    <div class="price">
        <div class="sale-price main-price">' . $sale_price . ' ' . get_woocommerce_currency_symbol() . '</div>
        
        <div class="regular-price additional-price">' . $regular_price . ' ' . get_woocommerce_currency_symbol() . '</div>
    </div>
</div>';
        } else {
            $regular_price = $product->get_regular_price();
            return '
<div class="product-price">
    <div class="price">
        <div class="regular-price main-price">' . $regular_price . ' <?= get_woocommerce_currency_symbol(); ?></div>
    </div>
</div>';
        }

        return $price;
    }


    function custom_variable_product_price($price, $product)
    {
        $prices = $product->get_variation_prices('min', true);
        $maxprices = $product->get_variation_price('max', true);
        $min_price = current($prices['price']);
        //$max_price = current( $maxprices['price'] );
        $minPrice = sprintf(__('От %1$s <br>', 'woocommerce'), wc_price($min_price));
        $maxPrice = sprintf(__('до %1$s', 'woocommerce'), wc_price($maxprices));
        return $minPrice . ' ' . $maxPrice;
    }

    public function custom_breadcrumbs()
    {
        ?>
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>
        </div>
    <?php }

    public function register_my_widgets()
    {
        register_sidebar(
            array(
                'name' => 'Фильтр товаров',
                'id' => "sidebar-shop",
                'description' => '',
                'class' => '',
                'before_sidebar' => '',
                'after_sidebar' => '',
            )
        );
    }

    /*
     * CATEGORY-CARD
     */

    public function remove_count()
    {
        $html = '';
        return $html;
    }

    public function add_category_background()
    {
        inline('assets/images/category-bg.svg');
    }

    public function category_image_wrapper($category)
    {
        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
        $image = wp_get_attachment_image_src($thumbnail_id, 'full');
        $image = $image[0];
        $image = str_replace(' ', '%20', $image);
        ?>
        <div class="image-wrapper">
            <img src="<?= esc_url($image); ?>" alt="">
        </div>
        <?php
    }

    public function open_category_content_wrapper()
    {
        ?>
        <div class="category-content">
    <?php }

    public function category_link($category)
    {
        $link = get_category_link($category);
        $terms = get_terms('product_cat', [
            'hide_empty' => false,
            'parent' => $category->term_id,
        ]);
        ?>

        <?php if (!$terms && !is_product_category()) { ?>
        <a href="<?= $link; ?>" class="link">
            Подробнее

            <?= inline('assets/images/arrow.svg'); ?>
        </a>
    <?php } else if (is_product_category()) { ?>
        <div class="link">
            Подробнее

            <?= inline('assets/images/arrow.svg'); ?>
        </div>

        <div class="subcats">
            <div class="container">
                <div class="close-subcats">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <g clip-path="url(#clip0_528_41776)">
                            <path d="M11.0518 0L7 4.05177L2.94823 0L0 2.94823L4.0518 7L0 11.0518L2.9482 14L7 9.9482L11.0518 14L14 11.0518L9.9482 6.99997L14 2.9482L11.0518 0Z"
                                  fill="#C9CCCE"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_528_41776">
                                <rect width="14" height="14" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>

                <div class="subcats__wrapper">
                    <?php foreach ($terms as $item) {
                        $link = get_term_link($item);
                        $title = $item->name;
                        $thumbnail_id = get_term_meta($item->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_image_src($thumbnail_id, 'full');
                        $image = $image[0];
                        $image = str_replace(' ', '%20', $image);
                        ?>
                        <a href="<?= $link; ?>" class="subcat">
                            <?php if ($image) { ?>
                                <img src="<?= esc_url($image); ?>" alt="" class="subcat__thumbnail">
                            <?php } ?>

                            <?php if ($title) { ?>
                                <span class="p2 subcat__title">
                                    <?= $title; ?>
                                </span>
                            <?php } ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <a href="<?= $link; ?>" class="link">
            Подробнее

            <?= inline('assets/images/arrow.svg'); ?>
        </a>
    <?php }
    }

    public function close_category_content_wrapper()
    {
        ?>
        </div>
    <?php }

    public function custom_category_top_part($category)
    {
        $shortDescription = get_field('s-description', $category);
        ?>
        <div class="category-top">
            <h4 class="woocommerce-loop-category__title">
                <?php
                echo esc_html($category->name);
                if ($category->count > 0) {
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html($category->count) . ')</mark>', $category);
                }
                ?>
            </h4>

            <div class="btn-main disabled-color">
                Подробнее
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L16 12L9 19" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>
            <?php
            if ($shortDescription) { ?>
                <div class="short-descr">
                    <?php echo $shortDescription; ?>
                </div>
                <?php
            } ?>
        </div>
        <?php
    }

    /*
     * ARCHIVE-PRODUCT
     */
    public function products_per_page($cols)
    {
        return 12;
    }

    function wp_kama_woocommerce_show_page_title_filter($title)
    {

        if (is_product_category() || is_product_taxonomy()) {
            return false;
        } else {
            return true;
        }
    }

    public function archive_category_banner()
    {
        if (!is_shop()) {
            $query_id = get_queried_object_id();
            $term = get_term($query_id);
            $term_id = $term->term_id;
            $title = $term->name;
            $description = $term->description;
            $archive_image = wp_get_attachment_image_url(get_field('banner_image', $term), 'wide');
            $advantages = get_field('advantages_block', $term);
            $subcategories = get_terms(array(
                'hide_empty' => false,
                'taxonomy' => 'product_cat',
                'parent' => $query_id,
            ));
            $term_parent_id = $term->parent;

            if ($term_parent_id != 0) {
                $subcategories = get_terms(array(
                    'hide_empty' => false,
                    'taxonomy' => 'product_cat',
                    'parent' => $term_parent_id,
                ));
            }
            ?>
            <div class="container">
                <?php if ($description && $archive_image) { ?>
                    <div class="header__main-banner">
                        <div class="main-banner__text">
                            <h2 class="main-banner__title">
                                <?= $title; ?>
                            </h2>

                            <?php if ($description) { ?>
                                <div class="main-banner__description p2">
                                    <?= $description; ?>
                                </div>
                            <?php } ?>
                        </div>

                        <?php if ($archive_image) { ?>
                            <div class="main-banner__image">
                                <img src="<?= $archive_image; ?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ($advantages) {
                    get_template_part('inc/blocks/advantages-block/render',
                        null,
                        array(
                            'block_title' => $advantages['block_title'],
                            'advantages' => $advantages['advantages'],
                        ));
                    wp_enqueue_style('advantages-block', get_template_directory_uri() . '/inc/blocks/advantages-block/block.css', array(), 2);
                    wp_enqueue_script('advantages-block', get_template_directory_uri() . '/inc/blocks/advantages-block/block.js', array(), 2);
                } ?>

                <h1 class="page-title shop-title"><?= $title; ?></h1>

                <?php if (!empty($subcategories)) { ?>
                    <div class="header__subcategories">
                        <?php foreach ($subcategories as $item) {
                            $link = get_term_link($item);
                            $name = $item->name;
                            $id = $item->term_id;
                            ?>
                            <a href="<?= $link; ?>"
                               class="subcategory tab btn disabled <?php if ($term_id == $id) {
                                   echo 'active';
                               } ?>">
                                <?= $name; ?>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
    }

    public function archive_advantages()
    {
        if (!is_shop()) {
            $archive_advantages = theme('archive_advantages');

            get_template_part('inc/blocks/advantages-block/render',
                null,
                array('hasBG' => $archive_advantages['hasBG'],
                    'advantages' => $archive_advantages['advantages'],
                ));
            wp_enqueue_style('advantages-block', get_template_directory_uri() . '/inc/blocks/advantages-block/block.css', array(), 2);
            wp_enqueue_script('advantages-block', get_template_directory_uri() . '/inc/blocks/advantages-block/block.js', array(), 2);
        }
    }

    public function archive_subcategories()
    {
        if (!is_shop()) {
            $query_id = get_queried_object_id();
            $term = get_term($query_id);
            $terms = get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => $query_id,
                'hide_empty' => false,
            ));

            get_template_part('inc/blocks/categories-block/render',
                null,
                array('terms' => $terms,
                ));
            wp_enqueue_style('categories-block', get_template_directory_uri() . '/inc/blocks/categories-block/block.css', array(), 2);
            wp_enqueue_script('categories-block', get_template_directory_uri() . '/inc/blocks/categories-block/block.js', array(), 2);
        }
    }

    public function archive_products_title()
    {
        echo '<div class="container">
                <h1 class="page-title">
                    Каталог
                </h1>
              </div>';
    }

    public function archive_products_advantages()
    {
        $archive_products_advantages = theme('archive_products_advantages');
        if (is_product_category()) {
            ?>

            <div class="container">
                <?php get_template_part('inc/blocks/advantages-v2-block/render',
                    null,
                    array('advantages' => $archive_products_advantages['advantages'],
                        'image_1' => $archive_products_advantages['image_1'],
                        'image_2' => $archive_products_advantages['image_2'],
                    ));
                wp_enqueue_style('advantages-v2-block', get_template_directory_uri() . '/inc/blocks/advantages-v2-block/block.css', array(), 2);
                wp_enqueue_script('advantages-v2-block', get_template_directory_uri() . '/inc/blocks/advantages-v2-block/block.js', array(), 2);
                ?>
            </div>
            <?php
        }
    }

    public function archive_products_additional_blocks()
    {
        if (is_product_category()) {
            $query_id = get_queried_object_id();
            $term = get_term($query_id);
            $seo_block = get_field('seo_block', $term);

            $footer_stock_block = theme('footer_stock_block');
            $footer_brands_block = theme('footer_brands_block');
            ?>
            <div class="catalog__additional-blocks">
                <div class="container">
                    <?php get_template_part('inc/blocks/stock-block/render',
                        null,
                        array(
                            'title' => $footer_stock_block['title'],
                            'text' => $footer_stock_block['text'],
                            'image' => $footer_stock_block['image'],
                        ));
                    wp_enqueue_style('stock-block', get_template_directory_uri() . '/inc/blocks/stock-block/block.css', array(), 2);
                    wp_enqueue_script('stock-block', get_template_directory_uri() . '/inc/blocks/stock-block/block.js', array(), 2);

                    get_template_part('inc/blocks/brands-block/render',
                        null,
                        array(
                            'block_title' => $footer_brands_block['block_title'],
                            'brands' => $footer_brands_block['brands'],
                        ));
                    wp_enqueue_style('brands-block', get_template_directory_uri() . '/inc/blocks/brands-block/block.css', array(), 2);
                    wp_enqueue_script('brands-block', get_template_directory_uri() . '/inc/blocks/brands-block/block.js', array(), 2);

                    get_template_part('inc/blocks/seo-block/render',
                        null,
                        array(
                            'text' => $seo_block['text'],
                            'image' => $seo_block['image'],
                        ));
                    wp_enqueue_style('seo-block', get_template_directory_uri() . '/inc/blocks/seo-block/block.css', array(), 2);
                    wp_enqueue_script('seo-block', get_template_directory_uri() . '/inc/blocks/seo-block/block.js', array(), 2);
                    ?>
                </div>
            </div>
            <?php
        }
    }

    /*
     * PRODUCT-CARD
     */
    public function open_product_card_top_part()
    { ?>
        <div class="product-card__top">
    <?php }

    public function product_card_tags()
    {
        global $product;
        $terms = get_terms([
            'taxonomy' => 'product_tag',
            'include' => $product->get_tag_ids()
        ]);
        ?>
        <?php if ($terms) { ?>
        <div class="product-card__tags tags">
            <?php foreach ($terms as $term) {
                $name = $term->name;
                ?>
                <div class="tag"><?= $name; ?></div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php }

    public function close_product_card_top_part()
    { ?>
        </div>
    <?php }

    public function product_card_top_part()
    {
        global $product;
        $tags = $product->tag_ids;
        $thumbnail = woocommerce_get_product_thumbnail('full');
        ?>
        <div class="product-card__top">
            <?php if ($tags) { ?>
                <div class="product-card__tags tags">
                    <?php foreach ($tags as $tag) {
                        $term = get_term($tag);
                        $name = $term->name;
                        $text_color = get_field('text_color', $term);
                        $bg_color = get_field('bg_color', $term);
                        $tag_style = 'style="background-color:' . $bg_color . '; color: ' . $text_color . ';"';
                        ?>
                        <div class="tag" <?= $tag_style; ?>>
                            <?= $name; ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="product-card__thumbnail">
                <?= $thumbnail; ?>
            </div>
        </div>
        <?php
    }

    public function product_card_bottom_part()
    {
        global $product;
        global $WoocommerceCompare;
        $sku = $product->get_sku();
        ?>
        <div class="product-card__bottom">
            <a href="<?= $product->get_permalink(); ?>">
                <?php if ($sku) { ?>
                    <div class="product-card__sku p3">
                        Артикул: <?= $sku; ?>
                    </div>
                <?php } ?>

                <?php woocommerce_template_loop_product_title(); ?>
            </a>

            <div class="product-card__price">
                <?= $product->get_price_html(); ?>

                <?= woocommerce_template_loop_add_to_cart(); ?>
            </div>
        </div>
    <?php }

    function wp_kama_woocommerce_product_add_to_cart_text_filter($__, $that)
    {
        $that = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M3 3H3.26835C3.74213 3 3.97922 3 4.17246 3.08548C4.34283 3.16084 4.48871 3.2823 4.59375 3.43616C4.71289 3.61066 4.75578 3.84366 4.8418 4.30957L7.00004 16L17.4195 16C17.8739 16 18.1016 16 18.2896 15.9198C18.4554 15.8491 18.5989 15.7348 18.7051 15.5891C18.8255 15.424 18.8763 15.2025 18.9785 14.7597L20.5477 7.95972C20.7022 7.29025 20.7796 6.95561 20.6946 6.69263C20.6201 6.46207 20.4639 6.26634 20.256 6.14192C20.0189 6 19.6758 6 18.9887 6H5.15388M18 21C17.4477 21 17 20.5523 17 20C17 19.4477 17.4477 19 18 19C18.5523 19 19 19.4477 19 20C19 20.5523 18.5523 21 18 21ZM8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20C9 20.5523 8.55228 21 8 21Z" stroke="#3679F3" stroke-linecap="round" stroke-linejoin="round"/>
</svg>';
        return $that;
    }

    public function product_card_additional_blocks()
    {
        global $product;
        $cross_sells = $product->get_cross_sell_ids();

        get_template_part('inc/blocks/products-block/render',
            null,
            array('block_title' => 'Сопутствующие товары',
                'products' => $cross_sells,
            ));
        wp_enqueue_style('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.css', array(), 2);
        wp_enqueue_script('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.js', array(), 2);
    }

    public function show_additional_blocks()
    {

    }

    /*
     * PRODUCT-PAGE
     */
    public function show_custom_title()
    {
        global $product;
        echo '<h1 class="page-title">' . get_the_title($product->get_id()) . '</h1>';
    }

    public function custom_product_swiper()
    {
        global $product;

//        $video = get_field('video', $product->get_id());
        $thumbnail = wp_get_attachment_image($product->get_image(), 'full');
        $images = $product->get_gallery_image_ids();
        ?>

        <div class="single-product__gallery">
            <div class="swiper product-main-swiper">
                <div class="swiper-wrapper">
                    <?php if ($thumbnail) { ?>
                        <div class="swiper-slide">
                            <div class="image" data-fancybox='gallery' data-src='<?= $thumbnail; ?>'>
                                <img src="<?= $thumbnail; ?>" alt="">
                            </div>
                        </div>
                    <?php } ?>

                    <?php foreach ($images as $image) {
                        $image_url = wp_get_attachment_image_url($image, 'full');
                        ?>
                        <div class="swiper-slide">
                            <div class="image" data-fancybox='gallery' data-src='<?= $image_url; ?>'>
                                <img src="<?= $image_url; ?>" alt="">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="product-thumbs-swiper">
                <div class="swiper-btn-mini-prev">
                    <?= inline('assets/images/swiper-mini-btn.svg'); ?>
                </div>

                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php if ($thumbnail) { ?>
                            <div class="swiper-slide">
                                <div class="image">
                                    <img src="<?= $thumbnail; ?>" alt="">
                                </div>
                            </div>
                        <?php } ?>

                        <?php foreach ($images as $image) {
                            $image_url = wp_get_attachment_image_url($image, 'full');
                            ?>
                            <div class="swiper-slide">
                                <div class="image">
                                    <img src="<?= $image_url; ?>" alt="">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="swiper-btn-mini-next">
                    <?= inline('assets/images/swiper-mini-btn.svg'); ?>
                </div>
            </div>

            <?php /* if ($video) {
                $image = wp_get_attachment_image_url($video['image'], 'full');
                $link = $video['link'];
                ?>
                <div class="video" data-fancybox data-src='http://www.youtube.com/embed/<?= $link; ?>'>
                    <img src="<?= $image; ?>" alt="">

                    <div class="play">
                        <?= inline('assets/images/play.svg'); ?>
                    </div>
                </div>
            <?php }  */ ?>
        </div>
        <?php
    }

    public function open_product_main_info()
    { ?>
        <div class="single-product__main-info">
    <?php }

    public function close_product_main_info()
    {
        ?>
        </div>
    <?php }

    public function product_info()
    {
        global $product;

        $sku = $product->get_sku();
        $description = $product->get_description();
        $attributes = $product->get_attributes();
        $description_block = get_field('description_block', $product);
        ?>
        <div class="single-product__info">
            <?php if ($sku) { ?>
                <div class="single-product__sku p2">
                    <span class="sku__title">Артикул: </span>

                    <span class="sku__value"><?= $sku; ?></span>
                </div>
            <?php } ?>
            <?php if ($description) { ?>
                <div class="single-product__description">
                    <h5 class="description__title">Описание</h5>

                    <div class="description__text text-block p2"><?= $description; ?></div>

                    <h6 class="description__readmore">Читать полностью</h6>
                </div>
            <?php } ?>

            <?php if (!empty($attributes)) { ?>
                <div class="single-product__attributes">
                    <h5 class="attributes__title">Характеристики</h5>

                    <div class="attributes__holder">
                        <?php foreach ($attributes as $attribute) {
                            $name = $attribute['name'];
                            $options = $attribute['options'];
                            $label_name = get_taxonomy($name)->labels->singular_name;
                            ?>
                            <div class="attribute">
                                <h6 class="attribute__name p2">
                                    <?php if ($label_name) {
                                        echo $label_name;
                                    } else {
                                        echo $name;
                                    } ?>
                                </h6>

                                <?php if (!empty($options)) {
                                    $optionsAmount = count($options) ?>
                                    <h6 class="attribute__value">
                                        <?php foreach ($options as $key => $option) { ?>
                                            <?= $option; ?>

                                            <?php if ($key + 1 != $optionsAmount) { ?>
                                                ,
                                            <?php } ?>
                                        <?php } ?>
                                    </h6>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>

                    <h6 class="attributes__readmore">Все характеристики</h6>
                </div>
            <?php } ?>

            <div class="single-product__info-bottom">
                <div class="single-product__price">
                    <?= $product->get_price_html() ?>
                </div>

                <div class="single-product__btns">
                    <?= woocommerce_template_single_add_to_cart(); ?>
                </div>
            </div>
        </div>
        <?php
    }

    public function top_row()
    {
        global $product;
        $terms = get_terms([
            'taxonomy' => 'product_tag',
            'include' => $product->get_tag_ids()
        ]);
        ?>
        <div class="top-row">
            <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
                <span class="sku_wrapper p3"><?php esc_html_e('SKU:', 'woocommerce'); ?> <span
                            class="sku p3"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></span></span>
            <?php endif; ?>

            <?php if ($terms) { ?>
                <div class="tags">
                    <?php foreach ($terms as $term) {
                        $name = $term->name;
                        ?>
                        <div class="tag"><?= $name; ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php }

    public function additional_attributes()
    {
        global $product;
        $additional_attributes = get_field('additional_attributes', $product->get_id());
        if ($additional_attributes) { ?>
            <div class="additional-attributes">
                <?php foreach ($additional_attributes as $item) {
                    $icon = wp_get_attachment_image_url($item['icon'], 'full');
                    $value = $item['value'];
                    ?>
                    <div class="additional-attribute">
                        <?php if ($icon) { ?>
                            <img src="<?= $icon; ?>" alt="" class="style-svg">
                        <?php } ?>

                        <?php if ($value) { ?>
                            <div class="p2"><?= $value; ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
    }

    public function show_additional_options()
    {
        global $product;
        $additional_options = get_field('additional_options', $product->get_id());
        if ($additional_options) { ?>
            <div class="additional-options">
                <div class="p2 additional-options__title">Дополнительные опции</div>

                <div class="additional-options__wrapper">
                    <?php foreach ($additional_options as $key => $option) {
                        $name = $option['name'];
                        ?>
                        <div class="additional-option">
                            <input type="checkbox" name="additional-option" id="additional-option-<?= $key; ?>"
                                   class="additional-option__checkbox">

                            <label class="p2 additional-option__title"
                                   for="additional-option-<?= $key; ?>">
                                <div class="additional-option__checkbox-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="7" viewBox="0 0 9 7"
                                         fill="none">
                                        <path d="M1 3.50002L3.33348 6L8 1" stroke="#34A0E1" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <?= $name; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php }

    public function show_variation_title()
    {
        echo '<div class="p2 variation-price-title">Стоимость</div>';
    }

    public function woocommerce_custom_single_add_to_cart_text()
    {
        return __('Добавить в корзину', 'woocommerce');
    }

    public function add_to_favorite_btn()
    {
        global $product;
        $in_favorites = WCFAVORITES()->check_item($product->get_id());
        $text = get_option('favorites_category_product_text', 'В избранные');
        ?>

        <button type="button" data-product_id="<?= $product->get_id() ?>"
                class="favorites ajax_add_to_favorites <?php if ($in_favorites) {
                    echo 'added';
                } ?>" aria-label="<?= $text ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M12 8.19444C10 3.5 3 4 3 10C3 16.0001 12 21 12 21C12 21 21 16.0001 21 10C21 4 14 3.5 12 8.19444Z"
                      stroke="#262D31" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    <?php }

    public function product_bottom_block()
    {
        global $product;

        $attributes = $product->get_attributes();
        $description = get_field('description_block', $product->get_id());
        $services = get_field('services_block', $product->get_id());
        $related_products = wc_get_related_products($product->get_id(), 6);
        ?>
        <div class="single-product__bottom-block block-margin">
            <div class="tabs">
                <?php if (!empty($description)) { ?>
                    <div class="tab btn disabled" data-tab="description">Описание</div>
                <?php } ?>

                <?php if (!empty($attributes)) { ?>
                    <div class="tab btn disabled" data-tab="attributes">Характеристики</div>
                <?php } ?>

                <?php if (!empty($services)) { ?>
                    <div class="tab btn disabled" data-tab="services">Услуги</div>
                <?php } ?>

                <?php if (!empty($related_products)) { ?>
                    <div class="tab btn disabled" data-tab="related">Похожие товары</div>
                <?php } ?>
            </div>

            <div class="content">
                <?php if (!empty($description)) { ?>
                    <div class="additional-block tab-block" data-tab="description">
                        <div class="description">
                            <?php foreach ($description as $item) {
                                $text = $item['text'];
                                $image = wp_get_attachment_image_url($item['image'], 'wide');
                                ?>
                                <div class="item">
                                    <?php if ($text) { ?>
                                        <div class="item__text text-block p2"><?= $text; ?></div>
                                    <?php } ?>

                                    <?php if ($image) { ?>
                                        <img src="<?= $image; ?>" alt="" class="item__image">
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($attributes)) { ?>
                    <div class="additional-block attributes tab-block" data-tab="attributes">
                        <?php wc_display_product_attributes($product); ?>
                    </div>
                <?php } ?>

                <?php if (!empty($services)) { ?>
                    <div class="additional-block services" data-tab="services">
                        <?php get_template_part('inc/blocks/services-block/render',
                            null,
                            array(
                                'show_all' => false,
                                'services' => $services,
                            ));
                        wp_enqueue_style('services-block', get_template_directory_uri() . '/inc/blocks/services-block/block.css', array(), 2);
                        wp_enqueue_script('services-block', get_template_directory_uri() . '/inc/blocks/services-block/block.js', array(), 2); ?>
                    </div>
                <?php } ?>

                <?php if (!empty($related_products)) { ?>
                    <div class="additional-block related-products" data-tab="related">
                        <?php get_template_part('inc/blocks/products-block/render',
                            null,
                            array(
                                'products' => $related_products,
                            ));
                        wp_enqueue_style('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.css', array(), 2);
                        wp_enqueue_script('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.js', array(), 2); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }

    public function product_additional_blocks()
    {
        global $product;
        $related_products = wc_get_related_products($product->get_id(), 7);
        ?>
        <div class="container">
            <div class="product__additional-blocks">
                <?php
                get_template_part('inc/blocks/products-block/render',
                    null,
                    array('block_title' => 'Похожие товары',
                        'products' => $related_products,
                    ));
                wp_enqueue_style('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.css', array(), 2);
                wp_enqueue_script('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.js', array(), 2);
                ?>
            </div>
        </div>
    <?php }

    public function if_product_not_stock()
    {
        global $product;

        if ($product->get_price() == '') {
            echo '<p class="stock out-of-stock">Товар отсутсвует</p>';
        }
    }

    public function jk_related_products_args($args)
    {
        $args['posts_per_page'] = 5; // количество "Похожих товаров"
        return $args;
    }

    /*
     * PAGE-CART
     */
    public function custom_cart_item_price($price, $values, $cart_item_key)
    {

        $is_on_sale = $values['data']->is_on_sale();
        $_product = $values['data'];
        $regular_price = $_product->get_regular_price();

        if ($is_on_sale) {
            $sale_price = $_product->get_sale_price();
            $price = '
<div class="product-price">
    <h4 class="sale-price">' . wc_price($sale_price) . '</h4>
    
    <div class="regular-price">' . wc_price($regular_price) . '</div>
</div>';
        } else {
            $price = '
<div class="product-price">
<h4 class="main-price">' . wc_price($regular_price) . '</h4>
</div>';
        }

        return $price;
    }

    public function cart_products_amount()
    {
        ?>
        <div class="cart-count">
            <div class="p2 count__title">Товары в корзине</div>

            <h6 class="count__number"><?= WC()->cart->get_cart_contents_count() ?></h6>
        </div>
        <?php
    }

    public function filter_woocommerce_cart_subtotal($subtotal, $compound, $cart)
    {
        $subtotal = 0;
        foreach (WC()->cart->get_cart() as $key => $cart_item) {
            $subtotal += $cart_item['data']->get_regular_price() * $cart_item['quantity'];
        }
        $subtotal = wc_price($subtotal);
        return $subtotal;
    }

    public function print_cart_weight()
    {
        ?>
        <tr class="order-weight">
            <th class="p1">Общая масса</th>

            <td data-title="Масса"><?= WC()->cart->get_cart_contents_weight(); ?> кг</td>
        </tr>
        <?php
    }

    public function print_cart_volume()
    {
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();
        $totalVolume = 0;

        foreach ($items as $item => $values) {
            $_product = wc_get_product($values['data']->get_id());
            $volume = get_field('volume', $_product->get_id());
            $quantity = $values['quantity'];
            if ($volume) {
                $totalVolume += $volume * $quantity;
            }
        }
        ?>
        <tr class="order-volume">
            <th class="p1">Объем</th>

            <td data-title="Масса"><?= $totalVolume; ?> м <sup class="number">3</sup>
            </td>
        </tr>
        <?php
    }

    public function custom_woocommerce_empty_cart_action()
    {
        if (isset($_GET['empty_cart']) && 'yes' === esc_html($_GET['empty_cart'])) {
            WC()->cart->empty_cart();

            $referer = wp_get_referer() ? esc_url(remove_query_arg('empty_cart')) : wc_get_cart_url();
            wp_safe_redirect($referer);
        }
    }

    public function custom_woocommerce_empty_cart_button()
    {
        echo '<a href="' . esc_url(add_query_arg('empty_cart', 'yes')) . '" class="clear-cart p3" title="' . esc_attr('Empty Cart', 'woocommerce') . '">
<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
  <g clip-path="url(#clip0_156_5322)">
    <path d="M7.89414 0L5 2.89412L2.10588 0L0 2.10588L2.89414 5L0 7.89412L2.10586 9.99998L5 7.10586L7.89414 10L10 7.89412L7.10586 4.99998L10 2.10586L7.89414 0Z" fill="#565666"/>
  </g>
  <defs>
    <clipPath id="clip0_156_5322">
      <rect width="10" height="10" fill="white"/>
    </clipPath>
  </defs>
</svg>

Очистить корзину
</a>';
    }

    public function invoice()
    {
        ?>
        <div id="invoice-btn" class="btn invert">Сформировать накладную</div>
        <?php
    }

    /*
     * PAGE-CHECKOUT
     */
    public function carrie_customer_default_shipping_country($value, $customer)
    {
        $value = !empty($value) ? $value : 'RU';
        return $value;
    }

    public function custom_override_checkout_fields($fields)
    {
        unset($fields['billing']['billing_country']); // Отключаем страны оплаты
        unset($fields['shipping']['shipping_country']);// Отключаем страны доставки
        return $fields;
    }

    public function custom_thankyou_text($order, $permission)
    {
        $order = 'Заказ успешно оформлен!';

        return $order;
    }

    public function custom_checkout_order_review()
    {
        ?>
        <div class="cart-count">
            <div class="p2 count__title">Товаров в корзине</div>

            <h6 class="count__number"><?= WC()->cart->get_cart_contents_count() ?></h6>
        </div>
        <?php
    }

    public function open_additional_field_block()
    {
        ?>
        <div class="additional-section__wrapper">
        <h4>Адрес доставки</h4>
        <div class="additional-section__fields">
        <?php
    }

    public function close_additional_field_block()
    {
        ?>
        </div>
        </div>
        <?php
    }

    public function show_shipping_methods()
    {
        ?>
        <div class="shipping-methods-wrapper">
            <h4 class="inputs__title">Способ получения</h4>

            <?php wc_cart_totals_shipping_html(); ?>
        </div>
        <?php
    }

    public function change_cart_shipping_method_full_label($label, $method)
    {
        $price = $method->cost > 0 ? '(+' . $method->cost . ' руб.)' : '(Бесплатно)';
        $label = '
<div class="method__content">
    <div class="method__text">
        <h6 class="method__name">' . $method->get_label() . '</h6>
    
    </div>
    
    <div class="method__price p3">' . $price . '</div>
</div>';

        return $label;
    }

    public function open_payment_methods_block()
    { ?>
        <div class="payment-methods-wrapper">
        <h4 class="inputs__title">Способы оплаты</h4>
    <?php }

    public function close_payment_methods_block()
    { ?>
        </div>
        <?php
    }

    public function second_place_order_button()
    {
        $order_button_text = apply_filters('woocommerce_order_button_text', __("Place order", "woocommerce"));
        echo '<button type="submit" class="button btn alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>';

        wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce');
    }

    /*
     * PAGE-FAVORITES
     * */

    public function updateFavorites()
    {
        if (WCFAVORITES()->count_items() > 99) {
            echo '99+';
        } else {
            echo WCFAVORITES()->count_items();
        }
        wp_die();
    }

    public function wc_clear_favorite_url()
    {
        if (isset($_REQUEST['clear-fav'])) {
            unset($_COOKIE['WC_FAVORITES']);
        }
    }
}