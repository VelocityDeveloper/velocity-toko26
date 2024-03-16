<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?> p-0" id="content" tabindex="-1">

        <div class="row m-0">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2" id="main">
                <?php require_once(get_stylesheet_directory() . '/inc/home-slider.php'); ?>
                <div class="text-center">
                    <h5 class="color-theme fw-bold"><?php echo get_option('blogname') . ' - ' . get_option('blogdescription'); ?></h5>
                </div>
                <div class="card mb-3 rounded-0 bg-gray border-0 color-theme py-2 px-3 fs-6 fw-bold">
                    Produk Terbaru <?php echo get_option('blogname'); ?>
                </div>

                <?php
                require_once(get_stylesheet_directory() . '/inc/home-products.php');
                require_once(get_stylesheet_directory() . '/inc/home-blogs.php');
                ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
