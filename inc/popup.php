<?php
/**
 * Popup sambutan ("Selamat datang di website kami") yang dulu disediakan plugin Velocity Toko.
 *
 * Pengaturan di Customizer > Velocity Toko 26 > Popup Sambutan. Nama theme mod sama dengan
 * versi lama (popupstatus, popup) supaya isi popup situs lama tetap terbaca. Popup tampil
 * sekali per pengunjung per hari (cookie velocity_popup).
 *
 * @package justg
 */

defined('ABSPATH') || exit;

add_action('customize_register', function ($wp_customize) {
    $wp_customize->add_section('section_popup', [
        'panel'       => 'panel_toko26',
        'title'       => __('Popup Sambutan', 'justg'),
        'description' => __('Jendela sambutan yang muncul saat pengunjung membuka situs (sekali sehari per pengunjung).', 'justg'),
        'priority'    => 14,
    ]);
    $wp_customize->add_setting('popupstatus', [
        'default'           => false,
        'sanitize_callback' => function ($v) {
            return !empty($v) && $v !== 'off';
        },
    ]);
    $wp_customize->add_control('popupstatus', [
        'label'   => __('Tampilkan popup sambutan', 'justg'),
        'section' => 'section_popup',
        'type'    => 'checkbox',
    ]);
    $wp_customize->add_setting('popup', [
        'default'           => '<p style="text-align:center">SELAMAT DATANG DI WEBSITE KAMI</p><p style="text-align:center">Dapatkan Promo menarik dari Kami</p>',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('popup', [
        'label'       => __('Isi Popup', 'justg'),
        'description' => __('Boleh berisi HTML: teks, tautan, gambar.', 'justg'),
        'section'     => 'section_popup',
        'type'        => 'textarea',
    ]);
});

/**
 * True kalau popup aktif dan berisi (nilai lama Velocity Toko: 'on' / true).
 */
function velocity_toko26_popup_aktif()
{
    $status = get_theme_mod('popupstatus', false);
    return ($status === true || $status === 'on' || $status === '1' || $status === 1) && trim((string) get_theme_mod('popup', '')) !== '';
}

add_action('wp_footer', function () {
    if (!velocity_toko26_popup_aktif()) {
        return;
    }
?>
    <div id="modalsambutan" class="modal fade" tabindex="-1" aria-label="<?php esc_attr_e('Sambutan', 'justg'); ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" style="z-index:999;right:0" class="btn border-0 close text-end px-2 position-absolute" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Tutup', 'justg'); ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body"><?php echo wp_kses_post(get_theme_mod('popup', '')); ?></div>
            </div>
        </div>
    </div>
    <button type="button" id="modalsambutan-pemicu" class="d-none" data-bs-toggle="modal" data-bs-target="#modalsambutan" aria-hidden="true" tabindex="-1"></button>
    <script>
        // Bootstrap tema induk (theme.min.js) tidak menyediakan window.bootstrap, hanya data-API:
        // popup dibuka lewat klik tombol pemicu tersembunyi sesudah semua skrip dimuat.
        window.addEventListener('load', function () {
            var pratinjau = <?php echo is_customize_preview() ? 'true' : 'false'; ?>;
            if (!pratinjau && document.cookie.indexOf('velocity_popup=1') !== -1) {
                return;
            }
            document.getElementById('modalsambutan-pemicu').click();
            document.cookie = 'velocity_popup=1; max-age=86400; path=/; SameSite=Lax';
        });
    </script>
<?php
}, 50);
