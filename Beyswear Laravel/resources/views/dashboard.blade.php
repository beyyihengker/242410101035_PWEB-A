<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeysWear Fashion</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <nav>
        <div class="nav-inner">

            <div class="nav-brand">
                <img src="{{ asset('images/IMG_7126.PNG') }}">
                <div class="brand-text">
                    <h1>BeysWear Fashion</h1>
                    <p>Sistem Manajemen Retail</p>
                </div>
            </div>

            <ul class="nav-menu">
                <li><a href="#" class="aktif">Beranda</a></li>
                <li><a href="#">Penjualan</a></li>
                <li><a href="#">Produk</a></li>
                <li><a href="#">Laporan</a></li>
                <li><a href="#">Profil</a></li>
            </ul>

            <div class="hamburger" role="button">
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
    </nav>

    <div class="wrapper">

        <aside>

            <div class="sb-card">
                <p class="sb-title">Filter Kategori</p>

                <div class="filter-row">
                    <input type="checkbox" id="f-Kemeja" checked>
                    <label for="f-Kemeja">Kemeja</label>
                </div>
                <div class="filter-row">
                    <input type="checkbox" id="f-Celana" checked>
                    <label for="f-Celana">Celana</label>
                </div>
                <div class="filter-row">
                    <input type="checkbox" id="f-Dress">
                    <label for="f-Dress">Dress</label>
                </div>
                <div class="filter-row">
                    <input type="checkbox" id="f-Outer">
                    <label for="f-Outer">Outer / Jaket</label>
                </div>
                <div class="filter-row">
                    <input type="checkbox" id="f-Aksesori">
                    <label for="f-Aksesori">Aksesori</label>
                </div>
            </div>

            <div class="sb-card">
                <p class="sb-title">Filter Status</p>

                <div class="filter-row">
                    <input type="checkbox" id="s-lunas" checked>
                    <label for="s-lunas">Lunas</label>
                </div>
                <div class="filter-row">
                    <input type="checkbox" id="s-proses">
                    <label for="s-proses">Dalam Proses</label>
                </div>
                <div class="filter-row">
                    <input type="checkbox" id="s-batal">
                    <label for="s-batal">Dibatalkan</label>
                </div>
            </div>

        </aside>

    <main>

        <div class="statistik-grid">
            <div class="sb-card">
                <p class="sb-title">Total Item</p>
                <p class="sb-angka" id="totalItem">0</p>
                <p class="sb-label">jumlah produk</p>
            </div>

            <div class="sb-card">
                <p class="sb-title">Total Penjualan</p>
                <p class="sb-angka" id="totalPenjualan">Rp 0</p>
                <p class="sb-label">dari semua transaksi</p>
            </div>

            <div class="sb-card">
                <p class="sb-title">Stok Menipis</p>
                <p class="sb-angka" id="stokMenipis" style="color:#C06060;">0</p>
                <p class="sb-label">stok < 5</p>
            </div>

            <div class="sb-card">
                <p class="sb-title">Total Produk Terjual</p>
                <p class="sb-angka" id="totalTerjual">0</p>
                <p class="sb-label">dari semua transaksi</p>
            </div>
        </div>

        <section class="hero-section">
            <h2>Selamat Datang, Beyyi!</h2>
        </section>

        <section class="form-box">
            <p class="seksi-label" id="lbl-form">Cari Data Penjualan</p>
            <div class="form-row">

                <div class="form-grup">
                    <label for="searchInput">Nama Produk</label>
                    <input type="text" id="searchInput" placeholder="cth. Basic Tee…">
                </div>

                <div class="form-grup">
                    <label for="cari-kategori">Kategori</label>
                    <select id="cari-kategori">
                    <option value="">Semua Kategori</option>
                    <option>Kemeja</option>
                    <option>Celana</option>
                    <option>Dress</option>
                    <option>Outer / Jaket</option>
                    <option>Aksesori</option>
                    </select>
                </div>

                <div class="form-grup">
                    <label for="cari-tanggal">Tanggal</label>
                    <input type="date" id="cari-tanggal">
                </div>

                <button class="btn btn-primer" type="button">Cari</button>
                <button class="btn btn-sekunder" type="button">Reset</button>
            </div>
        </section>

        <section class="form-box">
            <p class="seksi-label">Tambah / Edit Data</p>

            <form id="formData" class="form-row">

                <input type="hidden" id="editIndex">

                <div class="form-grup">
                    <input type="text" id="kode" placeholder="Kode Barang" required>
                </div>

                <div class="form-grup">
                    <input type="text" id="nama" placeholder="Nama Produk" required>
                </div>

                <div class="form-grup">
                    <select id="kategoriForm" required>
                        <option value="">Pilih Kategori</option>
                        <option>Kemeja</option>
                        <option>Celana</option>
                        <option>Dress</option>
                        <option>Outer / Jaket</option>
                        <option>Aksesori</option>
                    </select>
                </div>

                <div class="form-grup">
                    <input type="number" id="stok" placeholder="Stok" required>
                </div>

                <div class="form-grup">
                    <input type="number" id="harga" placeholder="Harga" required>
                </div>

                <div class="form-grup">
                    <input type="date" id="tanggal" required>
                </div>

                <button id="btnSimpan" type="button" class="btn btn-primer">Simpan</button>

            </form>
        </section>

        <section class="tabel-box">
            <div class="tabel-header">
                <h3>Data Produk</h3>
            </div>

            <div class="tabel-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="dataProduk"></tbody>
                </table>
            </div>
        </section>

        <section class="form-box">
            <p class="seksi-label">Tambah Transaksi</p>

            <div class="form-row">

                <input type="text" id="pelanggan" placeholder="Nama Pelanggan">

                <select id="produkSelect"></select>

                <input type="number" id="qty" placeholder="Qty">

                <select id="status">
                    <option value="">Pilih Status</option>
                    <option>Lunas</option>
                    <option>Proses</option>
                    <option>Batal</option>
                </select>

                <input type="date" id="tanggalJual">

                <button id="btnTransaksi" class="btn btn-primer">Simpan Transaksi</button>

            </div>
        </section>

        <section class="tabel-box">
            <div class="tabel-header">
                <h3 id="lbl-tabel">Daftar Penjualan Terbaru</h3>
                <span class="chip">5 transaksi terakhir</span>
            </div>

            <div class="tabel-scroll">
                <table>
                    <caption style="display:none">Daftar 5 transaksi penjualan terbaru BeysWear Fashion</caption>

                    <thead>
                        <tr>
                            <th>Kode Trx</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="dataPenjualan"></tbody>

                    <tfoot>

                    <tr>
                        <td colspan="6" style="text-align:right; letter-spacing:.05em;">
                        Total 5 Transaksi:
                        </td>
                        <td colspan="3" id="totalTransaksi">Rp 0</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </section>

    </main>
    </div>

    <footer>
        <div class="footer-grid">

            <div class="footer-col">
                <h4>BeysWear Fashion</h4>
                <p> Retail fashion. </p>
                <p style="margin-top:12px;">
                    📍 Jl. Jawa No. 1, Jember<br>
                    📞 0812-3456-7890<br>
                    ✉ info@beyswear.com
                </p>
            </div>

            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Penjualan</a></li>
                    <li><a href="#">Manajemen Produk</a></li>
                    <li><a href="#">Laporan &amp; Statistik</a></li>
                    <li><a href="#">Pengaturan Akun</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="#">Panduan Pengguna</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat &amp; Ketentuan</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </div>

        </div>

        <p class="footer-bottom"> &copy; 2026 <strong>BeysWear Fashion</strong>. Semua hak dilindungi.
        </p>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>