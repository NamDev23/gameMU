<?php
/*
Template Name: Quên mật khẩu
*/
get_header();
?>

<div class="container">
    <h2>Khôi phục mật khẩu</h2>
    <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="custom_forgot_password">
        <?php wp_nonce_field('custom_forgot_password'); ?>

        <label for="user_email">Nhập email đã đăng ký</label><br>
        <input type="email" id="user_email" name="user_email" required>

        <button type="submit">Gửi yêu cầu</button>
    </form>
</div>

<?php get_footer(); ?>