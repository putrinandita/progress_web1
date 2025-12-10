<?php $path = ""; include 'header.php'; ?>

<div class="container">
  <div class="card">
    <div class="header">
      <div>
        <h2>Dashboard</h2>
        <span>Halo, <b id="adminName">Admin</b>!</span>
      </div>
      <button class="btn btn-danger" id="logout"><i class="fa-solid fa-power-off"></i> Logout</button>
    </div>
    
    <hr style="border:0; border-top:1px solid #ffe0e9;">

    <h3>Menu Cepat</h3>
    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
        <button class="btn" onclick="location.href='menu/list.php'"><i class="fa-solid fa-utensils"></i> Kelola Menu</button>
        <button class="btn" onclick="location.href='transaksi/add.php'"><i class="fa-solid fa-cash-register"></i> Kasir / Transaksi</button>
        <button class="btn btn-secondary" onclick="location.href='transaksi/list.php'"><i class="fa-solid fa-list"></i> Riwayat Transaksi</button>
    </div>

    <div style="margin-top: 30px;">
        <h3>Ringkasan Toko</h3>
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fa-solid fa-burger fa-2x" style="color:#ff8ba7"></i>
                <h4>Total Menu</h4>
                <div class="number" id="countMenu">0</div>
            </div>
            <div class="stat-card">
                <i class="fa-solid fa-receipt fa-2x" style="color:#ff8ba7"></i>
                <h4>Total Transaksi</h4>
                <div class="number" id="countTrans">0</div>
            </div>
            <div class="stat-card">
                <i class="fa-solid fa-coins fa-2x" style="color:#ff8ba7"></i>
                <h4>Pendapatan</h4>
                <div class="number" id="totalOmset">Rp 0</div>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
if (!sessionStorage.getItem('adminLogged')) location.href = 'index.php';
document.getElementById('adminName').textContent = sessionStorage.getItem('adminUser');

document.getElementById('logout').addEventListener('click', ()=>{
  if(confirm('Keluar?')){ sessionStorage.clear(); location.href='index.php'; }
});

// Load Statistik dari LocalStorage
const menus = JSON.parse(localStorage.getItem('menus')||'[]');
const trans = JSON.parse(localStorage.getItem('transaksi')||'[]');
const total = trans.reduce((a,b)=> a + Number(b.total_harga||0), 0);

document.getElementById('countMenu').textContent = menus.length;
document.getElementById('countTrans').textContent = trans.length;
document.getElementById('totalOmset').textContent = 'Rp ' + total.toLocaleString('id-ID');
</script>
</body></html>