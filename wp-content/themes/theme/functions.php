<?php

//=========== BASE CONFIG ============

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

add_action( 'pre_get_posts', 'reviews_per_page' );
function reviews_per_page( $reviews ){
    if( !is_admin() && $reviews->is_main_query() && $reviews->is_post_type_archive('reviews')){
        $reviews->set( 'posts_per_page', 6 );
        $reviews->set( 'posts_per_archive_page', 6 );
    }
}

add_action( 'pre_get_posts', 'stocks_per_page' );
function stocks_per_page( $stocks ){
    if( !is_admin() && $stocks->is_main_query() && $stocks->is_post_type_archive('stocks')){
        $stocks->set( 'posts_per_page', 5 );
        $stocks->set( 'posts_per_archive_page', 5 );
    }
}

add_action( 'pre_get_posts', 'services_per_page' );
function services_per_page( $services ){
    if( !is_admin() && $services->is_main_query() && $services->is_post_type_archive('services')){
        $services->set( 'posts_per_page', 5 );
        $services->set( 'posts_per_archive_page', 5 );
    }
}

/*
  PAGINATION
*/
function pagination()
{
    global $wp_query;

    $prev = __('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M21 12L3 12M3 12L8 17M3 12L8 7" stroke="#818187" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>');
    $next = __('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M3 12H21M21 12L16 7M21 12L16 17" stroke="#818187" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>');

    $args = array(
        'total' => $wp_query->max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'prev_text' => $prev,
        'next_text' => $next,
        'type' => 'array',
        'end_size' => 1,
        'mid_size' => 1,
    );

    $pag = paginate_links($args);

    if (isset($pag)) {
        if (get_query_var('paged') == 0) {
            array_unshift($pag, '<span class="prev page-numbers disabled">' . $prev . '</span>');
        }
        if ($wp_query->max_num_pages == get_query_var('paged')) {
            array_push($pag, '<span class="next page-numbers disabled">' . $next . '</span>');
        }
        $pag = preg_replace('~/page/1/?([\'"])~', '/"', $pag);

        echo '<div class="nav-links">' . implode("", $pag) . '</div>';
    }
}

function theme_setup()
{

    load_theme_textdomain('theme', get_template_directory() . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('widgets');
    add_theme_support('widgets-block-editor');
    add_theme_support('woocommerce');

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

}

add_action('after_setup_theme', 'theme_setup');


function theme_scripts()
{

    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style('nouislider', get_template_directory_uri() . '/assets/css/nouislider.css');
    wp_enqueue_style('fonts', get_template_directory_uri() . '/assets/fonts/fonts.css');
    wp_enqueue_style('swiperCss', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css');
    wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/css/fancybox.min.css');

    wp_enqueue_script('swiperJs', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('swiperJsCustom', get_template_directory_uri() . '/assets/js/swiper.js', array('jquery', 'swiperJs'), _S_VERSION, true);
    wp_enqueue_script('fancyboxJs', get_template_directory_uri() . '/assets/js/fancybox.min.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('inputmask', get_template_directory_uri() . '/assets/js/inputmask.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('mobileMenu', get_template_directory_uri() . '/assets/js/modules/mobileMenu.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('themeModal', get_template_directory_uri() . '/assets/js/modules/themeModal.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'mobileMenu', 'themeModal', 'fancyboxJs', 'inputmask'), _S_VERSION, true);

}

add_action('wp_enqueue_scripts', 'theme_scripts');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


/*========= SUPPORT ES6 MODULES ===========*/
function scripts_as_es6_modules($tag, $handle, $src)
{

    if ('mobileMenu' === $handle || 'themeModal' === $handle || 'main' === $handle) {
        return str_replace('<script ', '<script type="module"', $tag);
    }

    return $tag;
}

// add_filter( 'script_loader_tag', 'scripts_as_es6_modules', 10, 3 );


/*========= ADD CANNONICAL LINKS ===========*/
add_filter('wpseo_canonical', 'return_canon');
function return_canon()
{
    if (is_paged()) {
        $canon_page = get_pagenum_link(1);
        return $canon_page;
    }
}


//============= THEME FUNCTIONS =============

require get_template_directory() . '/inc/template-functions.php';


/*=========== MENUS ==============*/

register_nav_menu('TopMenu', 'Верхнее меню');
register_nav_menu('footCat', 'Каталог подвал');
register_nav_menu('footMenu', 'Меню подвал');
register_nav_menu('mobileMenu', 'Мобильное меню');