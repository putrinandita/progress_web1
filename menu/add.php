<?php $path = "../"; include '../header.php'; ?>

<div class="container">
  <div class="card" style="max-width: 600px; margin: 40px auto;">
    <h2>Tambah Menu</h2>
    <form id="formAdd">
      <label>Nama Menu</label><input type="text" id="nama" required>
      <label>Harga</label><input type="number" id="harga" required>
      <label>Kategori</label>
      <select id="kategori">
        <option>Makanan</option><option>Minuman</option><option>Snack</option>
      </select>
      <label>Foto</label><input type="file" id="foto" accept="image/*">
      <img id="preview" style="max-height:100px; display:none; margin:10px auto;">
      
      <div style="margin-top:20px;">
          <button type="submit" class="btn">Simpan</button>
          <button type="button" class="btn btn-secondary" onclick="location.href='list.php'">Batal</button>
      </div>
    </form>
  </div>
</div>

<script>
let base64 = null;
document.getElementById('foto').addEventListener('change', e=>{
    const f = e.target.files[0];
    if(f){ const r=new FileReader(); r.onload=x=>{ document.getElementById('preview').src=x.target.result; document.getElementById('preview').style.display='block'; base64=x.target.result;}; r.readAsDataURL(f); }
});

document.getElementById('formAdd').addEventListener('submit', e=>{
    e.preventDefault();
    const menus = JSON.parse(localStorage.getItem('menus')||'[]');
    const id = menus.length ? Math.max(...menus.map(m=>m.id))+1 : 1;
    menus.push({
        id: id,
        nama_menu: document.getElementById('nama').value,
        harga: document.getElementById('harga').value,
        kategori: document.getElementById('kategori').value,
        foto: base64
    });
    localStorage.setItem('menus', JSON.stringify(menus));
    location.href='list.php';
});
</script>
</body></html>