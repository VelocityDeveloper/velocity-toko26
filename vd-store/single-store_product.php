<?php
/**
 * Detail produk VD Store bertampilan Toko 26: galeri, judul, harga, info, beli,
 * wishlist, pemesanan lain, bagikan, detail produk, produk terkait.
 *
 * @package justg
 */

defined('ABSPATH') || exit;

get_header();
$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="single-wrapper">
    <div class="<?php echo esc_attr($container); ?> p-0" id="content" tabindex="-1">
        <div class="row m-0">
            <?php do_action('justg_before_content'); ?>
            <main class="site-main col order-2" id="main">
                <?php while (have_posts()) :
                    the_post();
                    echo justg_breadcrumb(); ?>
                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                        <div class="single-produk mb-3">
                            <div class="row">
                                <div class="col-md-6 col-xl-5 mb-3">
                                    <?php echo do_shortcode('[wp_store_gallery]'); ?>
                                </div>
                                <div class="col-md">
                                    <h1 class="fs-4 fw-bold mb-3 text-dark"><?php the_title(); ?></h1>
                                    <?php $kategori = get_the_term_list(get_the_ID(), 'store_product_cat', '', ', ');
                                    if ($kategori && !is_wp_error($kategori)) : ?>
                                        <div class="mb-2"><small>Kategori: <?php echo $kategori; ?></small></div>
                                    <?php endif; ?>
                                    <div class="single-harga mb-3">Harga: <?php echo velocity_toko26_harga(); ?></div>
                                    <div class="mb-3"><?php echo do_shortcode('[wp_store_product_info]'); ?></div>
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="mb-3"><?php echo do_shortcode('[wp_store_add_to_cart qty="true" text="Beli" class="btn btn-sm btn-dark p-2 border-0 shadow-sm"]'); ?></div>
                                        <div class="mb-3 ps-2"><?php echo do_shortcode('[wp_store_add_to_wishlist label_add="Tambah ke Wishlist"]'); ?></div>
                                    </div>
                                    <div class="mb-3"><?php echo velocity_toko26_beli_lain(); ?></div>
                                    <?php if (shortcode_exists('velocity-sharepost')) : ?>
                                        <div class="mb-3"><?php echo do_shortcode('[velocity-sharepost]'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 pt-2">
                            <h3 class="title-single-part fs-5 fw-bold">Detail Produk</h3>
                            <?php // the_content() di sini diganti VD Store dengan tata letak bawaannya, jadi isi dibaca langsung. ?>
                            <div class="entry-content"><?php echo do_shortcode(wpautop(get_the_content())); ?></div>
                        </div>

                        <?php velocity_toko26_produk_terkait(); ?>

                    </article>
                <?php endwhile; ?>
            </main>
            <?php do_action('justg_after_content'); ?>
        </div>
    </div>
</div>

<?php
get_footer();
