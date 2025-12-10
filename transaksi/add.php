<?php $path = "../"; include '../header.php'; ?>

<div class="container">
  <div class="card">
    <h2><i class="fa-solid fa-cart-shopping"></i> Kasir</h2>
    <div style="display:flex; gap:20px; flex-wrap:wrap;">
        <div style="flex:1; min-width: 300px;">
            <form id="addItem">
                <label>Pilih Menu</label><select id="menu_id"></select>
                <label>Jumlah</label><input type="number" id="qty" value="1" min="1">
                <button type="submit" class="btn" style="width:100%">+ Tambah ke Keranjang</button>
            </form>
            <br>
            <button class="btn btn-secondary" style="width:100%" onclick="location.href='../dashboard.php'">Kembali ke Dashboard</button>
        </div>

        <div style="flex:2; min-width: 300px;">
            <div class="card" style="margin:0; background:#fff;">
                <h3>Keranjang</h3>
                <table id="tblCart"><thead><tr><th>Menu</th><th>Jml</th><th>Subtotal</th><th>Aksi</th></tr></thead><tbody></tbody></table>
                <div style="text-align:right; margin-top:20px; font-size:1.2rem; font-weight:bold;">
                    Total: <span id="grandTotal" style="color:var(--primary)">Rp 0</span>
                </div>
                <button id="btnBayar" class="btn" style="width:100%; margin-top:15px; justify-content:center;">PROSES PEMBAYARAN</button>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
let cart = [];
const menus = JSON.parse(localStorage.getItem('menus')||'[]');
const sel = document.getElementById('menu_id');

// Isi Dropdown Menu
menus.forEach(m=> sel.innerHTML+=`<option value="${m.id}" data-harga="${m.harga}" data-nama="${m.nama_menu}">${m.nama_menu} - Rp ${m.harga}</option>`);

function renderCart(){
    const tbody = document.querySelector('#tblCart tbody'); tbody.innerHTML='';
    let total = 0;
    cart.forEach((c,i)=>{
        const sub = c.harga*c.qty; total+=sub;
        tbody.innerHTML+=`<tr><td>${c.nama}</td><td class="center">${c.qty}</td><td align="right">${sub.toLocaleString()}</td><td><button class="btn btn-danger" style="padding:5px 10px;" onclick="delCart(${i})">X</button></td></tr>`;
    });
    document.getElementById('grandTotal').innerText = 'Rp '+total.toLocaleString();
}
function delCart(i){ cart.splice(i,1); renderCart(); }

document.getElementById('addItem').addEventListener('submit', e=>{
    e.preventDefault();
    const opt = sel.options[sel.selectedIndex];
    if(!opt) return;
    cart.push({id: sel.value, nama: opt.dataset.nama, harga: Number(opt.dataset.harga), qty: Number(document.getElementById('qty').value)});
    renderCart();
});

document.getElementById('btnBayar').addEventListener('click', ()=>{
    if(!cart.length) return alert('Keranjang kosong!');
    const trans = JSON.parse(localStorage.getItem('transaksi')||'[]');
    const total = cart.reduce((a,b)=>a+(b.harga*b.qty),0);
    trans.push({
        id: Date.now(), 
        tanggal: new Date().toLocaleString(),
        total_harga: total,
        items: cart
    });
    localStorage.setItem('transaksi', JSON.stringify(trans));
    alert('Transaksi Berhasil Disimpan!');
    location.href='list.php';
});
</script>
</body></html>