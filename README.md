Velocity Child Theme Paket Toko Online Toko 26
=================
[toko26.velocitydeveloper.com](https://toko26.velocitydeveloper.com/)

Child Theme for the Velocity System WordPress theme.

### Required
Theme Velocity versi 2.7.0 keatas, [Download](https://github.com/VelocityDeveloper/velocity/releases)

### Required Plugins
**VD Store**, [Download](https://github.com/Velocity-Developer/vd-store/releases) — produk `store_product`,
kategori `store_product_cat`, merek `brand`. Sejak 1.1.0 tema tidak lagi memakai plugin Velocity Toko
maupun Kirki.

Integrasi VD Store ada di `inc/vd-store.php`, `css/vd-store.css`, dan template override di folder
`vd-store/` (arsip, kategori, merek, detail produk). Pencarian mencari produk.

### Beranda
Beranda = `index.php` (Settings > Reading: tulisan terbaru): kotak 1000px, bar kontak + profil/keranjang, menu,
gambar header (Header Image) di bawah menu, lalu sidebar kiri + slider, judul situs, bar "Produk Terbaru",
12 produk 4 kolom (Detail + keranjang), tombol "Produk lainnya", 2 artikel terbaru.

### Widget
Shortcode untuk widget Teks (susunan demo, dibaca installer lewat `velocity_tema_widget_sidebar()`; footer tanpa widget):

- Sidebar (kiri): `[toko26_kategori]`, `[toko26_kontak]`, `[toko26_bank]`, `[toko26_info_terbaru]`, `[toko26_testimoni jumlah="5"]` (ulasan produk VD Store), `[toko26_sosmed facebook="…" instagram="…" twitter="…" youtube="…"]`
- Lainnya: `[toko26_cari_produk]`, `[toko26_best_seller jumlah="5"]`, `[toko26_produk_terbaru jumlah="5"]`, `[toko26_ekspedisi]`

### Halaman
Halaman **Konfirmasi Pembayaran** = `[store_tracking]` (input nomor pesanan VD Store: tagihan, rekening, unggah bukti
transfer). Override tipis `vd-store/pages/tracking.php` membuat pencarian tetap di halaman tempat form dipasang
(tidak pindah ke halaman Tracking Order).
Arsip produk (`/produk/`, kategori, merek, pencarian produk): kolom kiri berisi daftar kategori untuk
berpindah kategori (yang aktif ditandai) + Filter & Urutkan VD Store; sidebar kanan disembunyikan supaya
kartu produk lebar.
Template **Velocity Toko Pricelist** (`page-pricelist.php`): tabel semua produk + tombol Cetak.
Halaman Katalog & Profil Saya VD Store (`page_catalog`/`page_profile`, `[wp_store_catalog]`/`[wp_store_profile]`) selalu tanpa sidebar.

### Customizer
Appearance > Customize > **Velocity Toko 26**: Warna (utama, sekunder), Popup Sambutan (aktif/nonaktif +
isi HTML, tampil sekali sehari per pengunjung), Font (judul & teks), Slider Home (5 slot gambar).
Logo & gambar header: Site Identity / Header Image. Latar website: Background tema induk. Warna teks/link:
Theme Colors tema induk.

### Usage
Simply download the zip and upload the zip (velocity-toko26.zip) under your WordPress dashboard at Appearance > Themes. Or extract and upload via FTP at wp-content/themes/.
