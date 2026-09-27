<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);

function velocitychild_theme_setup()
{


    //remove action from Parent Theme
    remove_action('justg_header', 'justg_header_menu');
    remove_action('justg_do_footer', 'justg_the_footer_open');
    remove_action('justg_do_footer', 'justg_the_footer_content');
    remove_action('justg_do_footer', 'justg_the_footer_close');
    remove_theme_support('widgets-block-editor');
}

if (!function_exists('justg_header_open')) {
    function justg_header_open()
    {
        echo '<header id="wrapper-header">';
        echo '<div id="wrapper-navbar" class="px-0" itemscope itemtype="http://schema.org/WebSite">';
    }
}
if (!function_exists('justg_header_close')) {
    function justg_header_close()
    {
        echo '</div>';
        echo '</header>';
    }
}

///add action builder part
add_action('justg_header', 'justg_header_toko26');
function justg_header_toko26()
{
    require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_do_footer', 'justg_footer_toko26');
function justg_footer_toko26()
{
    require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}

add_action('justg_before_wrapper_content', 'justg_before_wrapper_content');
function justg_before_wrapper_content()
{
    echo '<div class="card rounded-0 border-0 p-2 pt-4 container mx-auto">';
}
add_action('justg_after_wrapper_content', 'justg_after_wrapper_content');
function justg_after_wrapper_content()
{
    echo '</div>';
}


/**
 * Halaman Katalog & Profil Saya VD Store (Pengaturan VD Store > Halaman, halaman ber-[wp_store_catalog]
 * / [wp_store_profile], atau template katalog tema) selalu tampil penuh tanpa sidebar.
 */
function velocity_toko26_halaman_penuh()
{
    if (!is_page()) {
        return false;
    }
    $s = (array) get_option('wp_store_settings', []);
    foreach (['page_catalog', 'page_profile'] as $kunci) {
        if (!empty($s[$kunci]) && is_page((int) $s[$kunci])) {
            return true;
        }
    }
    $isi = (string) get_post_field('post_content', get_queried_object_id());
    return has_shortcode($isi, 'wp_store_catalog') || has_shortcode($isi, 'wp_store_profile')
        || strpos((string) get_page_template_slug(), 'katalog') !== false;
}

/**
 * Arsip produk VD Store (/produk/, kategori, merek, pencarian produk): kolom kiri berisi daftar kategori +
 * Filter & Urutkan, sidebar kanan disembunyikan supaya kartu produk tidak sempit.
 */
function velocity_toko26_halaman_arsip_produk()
{
    return is_post_type_archive('store_product') || is_tax(['store_product_cat', 'brand'])
        || (is_search() && get_query_var('post_type') === 'store_product');
}

/**
 * Daftar kategori produk untuk berpindah kategori di halaman arsip; kategori aktif ditandai.
 */
function velocity_toko26_kategori_filter()
{
    $kat = get_terms(['taxonomy' => 'store_product_cat', 'hide_empty' => false, 'orderby' => 'name']);
    if (is_wp_error($kat) || !$kat) {
        return '';
    }
    $aktif = is_tax('store_product_cat') ? (int) get_queried_object_id() : 0;
    $induk_aktif = $aktif ? array_merge([$aktif], get_ancestors($aktif, 'store_product_cat')) : [];
    $anak = [];
    foreach ($kat as $k) {
        $anak[(int) $k->parent][] = $k;
    }
    $item = function ($k, $tingkat) use (&$item, $anak, $aktif, $induk_aktif) {
        $kelas = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center' . ($tingkat ? ' ps-4' : '')
            . ((int) $k->term_id === $aktif ? ' active' : '');
        $html = '<a class="' . $kelas . '" href="' . esc_url(get_term_link($k)) . '"' . ((int) $k->term_id === $aktif ? ' aria-current="page"' : '') . '>'
            . esc_html($k->name) . '<span class="badge rounded-pill">' . (int) $k->count . '</span></a>';
        if (!empty($anak[$k->term_id]) && in_array((int) $k->term_id, $induk_aktif, true)) {
            foreach ($anak[$k->term_id] as $sub) {
                $html .= $item($sub, $tingkat + 1);
            }
        }
        return $html;
    };
    $semua = is_post_type_archive('store_product') && !$aktif;
    $html = '<div class="toko26-kategori-filter wps-card wps-p-4"><div class="wps-text-lg wps-font-medium wps-mb-3 wps-text-bold">Kategori</div><div class="list-group list-group-flush">'
        . '<a class="list-group-item list-group-item-action' . ($semua ? ' active' : '') . '" href="' . esc_url(get_post_type_archive_link('store_product')) . '"' . ($semua ? ' aria-current="page"' : '') . '>Semua Produk</a>';
    foreach ($anak[0] ?? [] as $k) {
        $html .= $item($k, 0);
    }
    return $html . '</div></div>';
}

if (!function_exists('justg_right_sidebar_check')) {
    /**
     * Sidebar kanan: di arsip produk berisi kotak Kategori + Filter & Urutkan; di halaman lain
     * main-sidebar (sidebar kiri demo toko26).
     */
    function justg_right_sidebar_check()
    {
        if (is_singular('fl-builder-template') || velocity_toko26_halaman_penuh()) {
            return;
        }
        if (velocity_toko26_halaman_arsip_produk()) {
            echo '<div class="right-sidebar widget-area pe-md-2 col-sm-12 col-md-3 order-md-1 order-3 px-1" id="right-sidebar" role="complementary">';
            echo '<aside class="mb-3">' . velocity_toko26_kategori_filter() . '</aside>';
            echo '<aside class="mb-3 d-none d-md-block">';
            echo do_shortcode('[wp_store_filters]');
            echo '</aside>';
            echo '</div>';
            return;
        }
        if (!is_active_sidebar('main-sidebar')) {
            return;
        }
?>
        <div class="widget-area right-sidebar col-sm-3 order-md-1 order-3 px-1" id="right-sidebar" role="complementary">
            <div class="sticky-top">
                <?php do_action('justg_before_main_sidebar'); ?>
                <?php dynamic_sidebar('main-sidebar'); ?>
                <?php do_action('justg_after_main_sidebar'); ?>
            </div>
        </div>
    <?php
    }
}

function vd_limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}
