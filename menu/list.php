<?php $path = "../"; include '../header.php'; ?>

<div class="container">
  <div class="card">
    <div class="header"><h2>Data Menu</h2></div>
    <div class="top-links">
      <button class="btn" onclick="location.href='add.php'"><i class="fa-solid fa-plus"></i> Tambah</button>
      <button class="btn btn-secondary" onclick="location.href='../dashboard.php'">Kembali</button>
    </div>
    <table id="tableMenu">
      <thead><tr><th>ID</th><th>Foto</th><th>Nama</th><th>Harga</th><th>Kategori</th><th>Aksi</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
</div>

<script>
if (!sessionStorage.getItem('adminLogged')) location.href = '../index.php';

function getMenus(){ return JSON.parse(localStorage.getItem('menus')||'[]'); }
function saveMenus(arr){ localStorage.setItem('menus', JSON.stringify(arr)); }

function render(){
  const tbody = document.querySelector('tbody'); tbody.innerHTML = '';
  const menus = getMenus();
  
  if(menus.length === 0) { tbody.innerHTML='<tr><td colspan="6" class="center">Data kosong.</td></tr>'; return; }

  menus.forEach(m=>{
    const img = m.foto ? `<img src="${m.foto}" style="width:50px; height:50px; object-fit:cover; border-radius:8px;">` : '-';
    tbody.innerHTML += `<tr>
      <td class="center">${m.id}</td><td class="center">${img}</td><td>${m.nama_menu}</td>
      <td align="right">Rp ${Number(m.harga).toLocaleString()}</td><td class="center">${m.kategori}</td>
      <td class="center">
        <button class="btn" onclick="edit(${m.id})"><i class="fa-solid fa-pen"></i></button>
        <button class="btn btn-danger" onclick="hapus(${m.id})"><i class="fa-solid fa-trash"></i></button>
      </td></tr>`;
  });
}

function hapus(id){ if(confirm('Hapus?')){ saveMenus(getMenus().filter(m=>m.id!==id)); render(); } }
function edit(id){ localStorage.setItem('editMenuId', id); location.href='edit.php'; }

// Data Dummy Pertama Kali
if (!localStorage.getItem('menus')) saveMenus([{id:1, nama_menu:'Kopi Susu', harga:15000, kategori:'Minuman', foto:null}]);
render();
</script>
</body></html>