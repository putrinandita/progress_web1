<?php $path = "../"; include '../header.php'; ?>

<div class="container">
  <div class="card" style="max-width: 600px; margin: 40px auto;">
    <h2>Edit Menu</h2>
    <form id="formEdit">
      <label>Nama Menu</label><input type="text" id="nama" required>
      <label>Harga</label><input type="number" id="harga" required>
      <label>Kategori</label>
      <select id="kategori">
        <option>Makanan</option><option>Minuman</option><option>Snack</option>
      </select>
      <div style="margin-top:20px;">
          <button type="submit" class="btn">Update</button>
          <button type="button" class="btn btn-secondary" onclick="location.href='list.php'">Batal</button>
      </div>
    </form>
  </div>
</div>

<script>
const id = Number(localStorage.getItem('editMenuId'));
const menus = JSON.parse(localStorage.getItem('menus')||'[]');
const data = menus.find(m=>m.id===id);

if(data){
    document.getElementById('nama').value = data.nama_menu;
    document.getElementById('harga').value = data.harga;
    document.getElementById('kategori').value = data.kategori;
} else { location.href='list.php'; }

document.getElementById('formEdit').addEventListener('submit', e=>{
    e.preventDefault();
    const updated = menus.map(m=> m.id===id ? {...m, 
        nama_menu: document.getElementById('nama').value,
        harga: document.getElementById('harga').value,
        kategori: document.getElementById('kategori').value
    } : m);
    localStorage.setItem('menus', JSON.stringify(updated));
    location.href='list.php';
});
</script>
</body></html>