<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theme
 */

get_header();
?>

    <main id="primary" class="archive archive-reviews">
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>

            <h1 class="page-title">
                Отзывы
            </h1>

            <div class="archive__content block-margin">
                <div class="archive__wrapper">
                    <?php if (have_posts()) { ?>

                        <div class="archive__holder">
                            <?php
                            /* Start the Loop */
                            while (have_posts()) :
                                the_post();
                                get_template_part('templates/review-card');

                            endwhile; ?>
                        </div>

                        <?php

                        pagination();

                    } else {

                        get_template_part('template-parts/content', 'none');

                    }
                    ?>
                </div>

                <div class="archive__form">
                    <div class="form">
                        <h3 class="form__title">
                            Оставить отзыв
                        </h3>

                        <div class="form__subtitle p2">
                            Отзыв пройдёт модерацию и появится на сайте
                        </div>

                        <div class="btn" data-modal="review">Оставить отзыв</div>
                    </div>
                </div>
            </div>

            <?php
            $archive_reviews_qas_block = theme('archive_reviews_qas_block');
            get_template_part('inc/blocks/qas-block/render',
                null,
                array(
                    'block_title' => $archive_reviews_qas_block['block_title'],
                    'qas' => $archive_reviews_qas_block['qas'],
                ));
            wp_enqueue_style('qas-block', get_template_directory_uri() . '/inc/blocks/qas-block/block.css', array(), 2);
            wp_enqueue_script('qas-block', get_template_directory_uri() . '/inc/blocks/qas-block/block.js', array(), 2); ?>
        </div>
    </main><!-- #main -->

<?php
// get_sidebar();
get_footer();
