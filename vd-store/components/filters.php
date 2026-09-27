<?php
/**
 * Filter & Urutkan VD Store tanpa daftar kategori: Toko 26 sudah punya kotak Kategori untuk
 * berpindah kategori di atasnya (velocity_toko26_kategori_filter()). Template asli plugin tetap
 * dipakai, jadi pembaruan VD Store ikut terbawa.
 *
 * @package justg
 */

defined('ABSPATH') || exit;

$show_category_filter = false;
require WP_STORE_PATH . 'templates/frontend/components/filters.php';
