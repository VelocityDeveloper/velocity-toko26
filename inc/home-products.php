<?php
// The Query.
// $paged = (get_query_var('page')) ? get_query_var('page') : 1;
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    // 'paged' => $paged,
);
$the_query = new WP_Query($args);

// The Loop.
if ($the_query->have_posts()) {
    echo '<div class="row g-2">';
    while ($the_query->have_posts()) {
        $the_query->the_post();
        do_action('velocitytoko_product_loop');
    }
    echo '</div>';
    // echo $paged;
    echo '<div class="text-center mt-2 mb-3">';
    echo '<a class="btn btn-outline-secondary btn-sm px-4 border-theme color-theme fw-bold shadow-sm" href="' . get_site_url() . '/products">Produk lainnya</a>';
    echo '</div>';

    // Fungsi pagination
    // echo '<div class="pagination pagi-home text-center">';
    // echo paginate_links([
    //     'total' => $the_query->max_num_pages,
    //     'current' => $paged,
    //     'prev_text' => __('&laquo; Prev'),
    //     'next_text' => __('Next &raquo;'),
    // ]);
    // echo '</div>';
    // wp_reset_query();
} else {
    esc_html_e('Sorry, no products here.');
}


// Restore original Post Data.
wp_reset_postdata();
