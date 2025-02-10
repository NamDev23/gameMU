<div class="form-container">
    <h2>Đăng nhập</h2>
    <form method="post" action="<?php echo wp_login_url(); ?>">
        <input type="text" name="log" placeholder="Tên đăng nhập" required>
        <input type="password" name="pwd" placeholder="Mật khẩu" required>
        <button type="submit">Đăng nhập</button>
    </form>
</div>