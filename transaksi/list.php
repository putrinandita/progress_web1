<?php $path = "../"; include '../header.php'; ?>

<div class="container">
  <div class="card">
    <div class="header"><h2>Riwayat Transaksi</h2></div>
    <div class="top-links">
        <button class="btn" onclick="location.href='add.php'">+ Transaksi Baru</button>
        <button class="btn btn-secondary" onclick="location.href='../dashboard.php'">Kembali</button>
    </div>
    <table id="tblTrans">
        <thead><tr><th>ID</th><th>Tanggal</th><th>Total Bayar</th><th>Aksi</th></tr></thead>
        <tbody></tbody>
    </table>
  </div>
</div>

<script>
function render(){
    const t = JSON.parse(localStorage.getItem('transaksi')||'[]').sort((a,b)=>b.id-a.id);
    const tbody = document.querySelector('#tblTrans tbody'); tbody.innerHTML='';
    if(t.length===0) { tbody.innerHTML='<tr><td colspan="4" class="center">Belum ada transaksi</td></tr>'; return;}

    t.forEach(x=>{
        tbody.innerHTML += `<tr>
            <td>${x.id}</td><td>${x.tanggal}</td><td align="right" style="font-weight:bold;">Rp ${Number(x.total_harga).toLocaleString()}</td>
            <td class="center">
                <button class="btn btn-danger" onclick="hapus(${x.id})"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>`;
    });
}
function hapus(id){
    if(confirm('Hapus riwayat ini?')){
        const t = JSON.parse(localStorage.getItem('transaksi')||'[]');
        localStorage.setItem('transaksi', JSON.stringify(t.filter(x=>x.id!==id)));
        render();
    }
}
render();
</script>
</body></html>