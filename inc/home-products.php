<?php
// Produk terbaru VD Store di beranda (12 produk) + tautan ke arsip produk.
$the_query = new WP_Query(array(
    'post_type' => 'store_product',
    'posts_per_page' => 12,
));

if ($the_query->have_posts()) {
    echo '<div class="row g-2">';
    while ($the_query->have_posts()) {
        $the_query->the_post();
        velocity_toko26_kartu_produk();
    }
    echo '</div>';
    echo '<div class="text-center mt-2 mb-5">';
    echo '<a class="btn btn-outline-secondary btn-sm px-4 border-theme color-theme fw-bold shadow-sm" href="' . esc_url(get_post_type_archive_link('store_product')) . '">Produk lainnya</a>';
    echo '</div>';
} else {
    esc_html_e('Sorry, no products here.');
}

wp_reset_postdata();
