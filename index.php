<?php $path = ""; include 'header.php'; ?>

<div class="container" style="max-width: 400px; margin-top: 80px;">
    <div class="card center">
        <div style="font-size: 3rem; color: #ff8ba7; margin-bottom: 10px;">
            <i class="fa-solid fa-mug-hot"></i>
        </div>
        <h2>Login Admin</h2>
        <div id="alert" style="color: red; margin-bottom: 10px;"></div>
        
        <form id="loginForm">
            <input type="text" id="username" placeholder="Username (admin)" required>
            <input type="password" id="password" placeholder="Password (admin)" required>
            <button type="submit" class="btn" style="width: 100%; justify-content: center;">Masuk</button>
        </form>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e){
    e.preventDefault();
    const u = document.getElementById('username').value;
    const p = document.getElementById('password').value;
    
    if (u === 'admin' && p === 'admin') {
        sessionStorage.setItem('adminLogged', 'true');
        sessionStorage.setItem('adminUser', u);
        window.location.href = 'dashboard.php';
    } else {
        document.getElementById('alert').textContent = 'Username atau password salah!';
    }
});
</script>
</body></html>