<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Theme
 */

get_header();
?>

	<main id="primary" class="site-main error-page">
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>

            <div class="error-page__wrapper">
                <h1 class="error-page__number"><span>4</span>04</h1>

                <div class="error-page__text">
                    <h2 class="error-page__title">Произошла ошибка</h2>

                    <div class="p2 error-page__subtitle">
                        Данная страница находится в разработке или её не существует. Пожалуйста, вернитесь на главную
                    </div>

                    <a href="/" class="btn">Вернуться на главную</a>
                </div>
            </div>
        </div>

	</main><!-- #main -->

<?php
get_footer();
