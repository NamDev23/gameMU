<div class="form-container">
    <h2>Đăng ký</h2>
    <form method="post" action="<?php echo esc_url(site_url('wp-login.php?action=register', 'login_post')); ?>">
        <input type="text" name="user_login" placeholder="Tên đăng nhập" required>
        <input type="email" name="user_email" placeholder="Email" required>
        <button type="submit">Đăng ký</button>
    </form>
</div>