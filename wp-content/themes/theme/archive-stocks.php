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

    <main id="primary" class="archive archive-stocks">
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>

            <h1 class="page-title">
                Акции
            </h1>

            <div class="archive__content block-margin">
                <?php if (have_posts()) { ?>

                    <div class="archive__holder">
                        <?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();
                            get_template_part('templates/stock-card');

                        endwhile; ?>
                    </div>

                    <?php

                    pagination();

                } else {

                    get_template_part('template-parts/content', 'none');

                }
                ?>
            </div>
        </div>

    </main><!-- #main -->

<?php
// get_sidebar();
get_footer();
