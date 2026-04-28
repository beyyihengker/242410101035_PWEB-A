let data = JSON.parse(localStorage.getItem("barang"));

if (!data) {
    data = [
        {
            kode: "BRG-001",
            nama: "Nevadi Ki Basic Tee",
            kategori: "Kemeja",
            stok: 10,
            harga: 110000
        },
        {
            kode: "BRG-002",
            nama: "Celana Chino",
            kategori: "Celana",
            stok: 3,
            harga: 185000
        }
    ];

    localStorage.setItem("barang", JSON.stringify(data));
}

let penjualan = JSON.parse(localStorage.getItem("penjualan"));

if (!penjualan) {
    penjualan = [
        {
            kode: "TRX-001",
            tanggal: "2026-04-10",
            pelanggan: "Ahn Keonho",
            produk: "Nevadi Ki Basic Tee",
            kategori: "Kemeja",
            qty: 2,
            total: 220000,
            status: "Lunas"
        },
        {
            kode: "TRX-002",
            tanggal: "2026-04-11",
            pelanggan: "James Zhao",
            produk: "Celana Chino",
            kategori: "Celana",
            qty: 1,
            total: 185000,
            status: "Lunas"
        }
    ];

    localStorage.setItem("penjualan", JSON.stringify(penjualan));
}

const produkSelect = document.getElementById("produkSelect");
const qtyInput = document.getElementById("qty");
const pelangganInput = document.getElementById("pelanggan");
const statusSelect = document.getElementById("status");
const tanggalJual = document.getElementById("tanggalJual");
const btnTransaksi = document.getElementById("btnTransaksi");
const btnSimpan = document.getElementById("btnSimpan");
const searchInput = document.getElementById("searchInput");

const renderProduk = (list = data) => {
    const tbody = document.getElementById("dataProduk");
    tbody.innerHTML = "";

    list.forEach((item, index) => {
        tbody.innerHTML += `
        <tr>
            <td>${item.kode}</td>
            <td>${item.nama}</td>
            <td>${item.kategori}</td>
            <td>${item.stok}</td>
            <td>Rp ${item.harga.toLocaleString()}</td>
            <td>
                <button class="edit" data-index="${data.indexOf(item)}">Edit</button>
                <button class="hapus" data-index="${data.indexOf(item)}">Hapus</button>
            </td>
        </tr>
        `;
    });
};

const loadProduk = () => {
    produkSelect.innerHTML = '<option value="">Pilih Produk</option>';

    data.forEach((item, index) => {
        produkSelect.innerHTML += `
            <option value="${index}">
                ${item.nama} (Stok: ${item.stok})
            </option>
        `;
    });
};
const kategoriSelect = document.getElementById("cari-kategori");

kategoriSelect.addEventListener("change", () => {
    const kategori = kategoriSelect.value;

    if(kategori === ""){
        renderProduk();
        return;
    }

    const filtered = data.filter(item => item.kategori === kategori);
    renderProduk(filtered);
});
const hitungStatistik = () => {
    const totalItem = data.length;

    const totalPenjualan = penjualan.reduce((sum, item) => {
        return sum + item.total;
    }, 0);

    const stokMenipis = data.filter(item => item.stok < 5).length;

    const totalTerjual = penjualan.reduce((sum, item) => sum + item.qty, 0);

    document.getElementById("totalItem").innerText = totalItem;
    document.getElementById("totalPenjualan").innerText = "Rp " + totalPenjualan.toLocaleString();
    document.getElementById("stokMenipis").innerText = stokMenipis;
    document.getElementById("totalTerjual").innerText = totalTerjual;
};

btnSimpan.addEventListener("click", () => {
    const kode = document.getElementById("kode").value;
    const nama = document.getElementById("nama").value;
    const kategori = document.getElementById("kategoriForm").value;
    const stok = parseInt(document.getElementById("stok").value);
    const harga = parseInt(document.getElementById("harga").value);
    const editIndex = document.getElementById("editIndex").value;

    if(!kode || !nama || !kategori || !stok || !harga){
        alert("Semua field wajib diisi!");
        return;
    }

    if(stok <= 0 || harga <= 0){
        alert("Stok & harga harus lebih dari 0!");
        return;
    }

    const produkBaru = { kode, nama, kategori, stok, harga };

    if(editIndex !== ""){
        data[editIndex] = produkBaru;
    } else {
        data.push(produkBaru);
    }

    localStorage.setItem("barang", JSON.stringify(data));

    document.getElementById("formData").reset();
    document.getElementById("editIndex").value = "";

    renderProduk();
    loadProduk();
    hitungStatistik();
});

document.getElementById("dataProduk").addEventListener("click", (e) => {
    const index = e.target.dataset.index;

    if(e.target.classList.contains("hapus")){
        if(confirm("Hapus produk?")){
            data.splice(index, 1);
        }
    }

    if(e.target.classList.contains("edit")){
        const item = data[index];

        document.getElementById("kode").value = item.kode;
        document.getElementById("nama").value = item.nama;
        document.getElementById("kategoriForm").value = item.kategori;
        document.getElementById("stok").value = item.stok;
        document.getElementById("harga").value = item.harga;

        document.getElementById("editIndex").value = index;
    }

    localStorage.setItem("barang", JSON.stringify(data));
    renderProduk();
    loadProduk();
    hitungStatistik();
});

searchInput.addEventListener("input", () => {
    const keyword = searchInput.value.toLowerCase();

    if(keyword === ""){
        renderProduk();
        return;
    }

    const filtered = data.filter(item =>
        item.nama.toLowerCase().includes(keyword) ||
        item.kode.toLowerCase().includes(keyword)
    );

    renderProduk(filtered);
});

const generateKode = () => {
    const last = penjualan.length + 1;
    return "TRX-" + String(last).padStart(3, "0");
};

btnTransaksi.addEventListener("click", () => {

    if(!produkSelect.value || !qtyInput.value || !pelangganInput.value || !statusSelect.value || !tanggalJual.value){
        alert("Lengkapi data transaksi!");
        return;
    }

    const produk = data[produkSelect.value];
    const qtyBaru = parseInt(qtyInput.value);
    const editIndex = document.getElementById("editIndexJual").value;

    if(editIndex !== ""){
        const transaksiLama = penjualan[editIndex];

        const produkLamaIndex = data.findIndex(p => p.nama === transaksiLama.produk);
        data[produkLamaIndex].stok += transaksiLama.qty;

        if(qtyBaru > produk.stok){
            alert("Stok tidak cukup!");
            data[produkLamaIndex].stok -= transaksiLama.qty;
            return;
        }

        penjualan[editIndex] = {
            kode: transaksiLama.kode,
            tanggal: tanggalJual.value,
            pelanggan: pelangganInput.value,
            produk: produk.nama,
            kategori: produk.kategori,
            qty: qtyBaru,
            total: produk.harga * qtyBaru,
            status: statusSelect.value
        };

        produk.stok -= qtyBaru;

    } else {
        if(qtyBaru > produk.stok){
            alert("Stok tidak cukup!");
            return;
        }

        const transaksi = {
            kode: generateKode(),
            tanggal: tanggalJual.value,
            pelanggan: pelangganInput.value,
            produk: produk.nama,
            kategori: produk.kategori,
            qty: qtyBaru,
            total: produk.harga * qtyBaru,
            status: statusSelect.value
        };

        produk.stok -= qtyBaru;
        penjualan.push(transaksi);
    }

    localStorage.setItem("penjualan", JSON.stringify(penjualan));
    localStorage.setItem("barang", JSON.stringify(data));

    clearFormJual();
    document.getElementById("editIndexJual").value = "";

    renderPenjualan();
    renderProduk();
    loadProduk();
    hitungStatistik();
});

const renderPenjualan = () => {
    const tbody = document.getElementById("dataPenjualan");
    tbody.innerHTML = "";

    const last5 = penjualan.slice(-5).reverse();

    last5.forEach((item, index) => {
        tbody.innerHTML += `
        <tr>
            <td>${item.kode}</td>
            <td>${new Date(item.tanggal).toLocaleDateString('id-ID')}</td>
            <td>${item.pelanggan}</td>
            <td>${item.produk}</td>
            <td>${item.kategori}</td>
            <td>${item.qty}</td>
            <td>Rp ${item.total.toLocaleString()}</td>
            <td>${item.status}</td>
            <td>
                <div class="aksi-btn">
                    <button class="btn-tbl editJual" data-index="${index}">Edit</button>
                    <button class="btn-tbl hapusJual" data-index="${index}">Hapus</button>
                </div>
            </td>
        </tr>
        `;
    });

    const total5 = last5.reduce((sum, item) => sum + item.total, 0);

    document.getElementById("totalTransaksi").innerText =
        "Rp " + total5.toLocaleString();
};

document.getElementById("dataPenjualan").addEventListener("click", (e) => {

    const index = e.target.dataset.index;

    if(e.target.classList.contains("hapusJual")){
        if(confirm("Hapus transaksi?")){
            penjualan.splice(index, 1);
            localStorage.setItem("penjualan", JSON.stringify(penjualan));
            renderPenjualan();
            hitungStatistik();
        }
    }

    if(e.target.classList.contains("editJual")){
        const item = penjualan[index];

        pelangganInput.value = item.pelanggan;
        qtyInput.value = item.qty;
        statusSelect.value = item.status;
        tanggalJual.value = item.tanggal;

        const produkIndex = data.findIndex(p => p.nama === item.produk);
        produkSelect.value = produkIndex;

        document.getElementById("editIndexJual").value = index;
    }
});

const clearFormJual = () => {
    produkSelect.value = "";
    qtyInput.value = "";
    pelangganInput.value = "";
    statusSelect.value = "";
    tanggalJual.value = "";
    document.getElementById("editIndexJual").value = "";
};

renderProduk();
loadProduk();
renderPenjualan();
hitungStatistik();

const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", () => {
    navMenu.classList.toggle("active");
});