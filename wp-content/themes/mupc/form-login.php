<?php

/**
 * Template part: Form đăng nhập tùy chỉnh với captcha 4 số.
 * Lưu file này vào theme của bạn, ví dụ: login-form.php
 */
?>
<form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="login_form" autocomplete="off">
    <input type="hidden" name="action" value="custom_login_action">
    <?php wp_nonce_field('custom_login_action'); ?>
    <div class="box_login">
        <div class="box_title">ĐĂNG NHẬP</div>
        <div class="form_fields">
            <div class="form_group">
                <label for="username">Tài khoản</label>
                <input type="text" class="common_input" id="username" name="username" placeholder="Từ 6 tới 20 ký tự" maxlength="20" minlength="6" required>
            </div>

            <div class="form_group">
                <label for="password">Mật mã</label>
                <input type="password" class="common_input" id="login_password" name="password" placeholder="Từ 6 tới 50 ký tự" maxlength="50" minlength="6" required>
            </div>

            <div class="form_group">
                <label for="captcha">Mã chống spam</label>
                <div class="captcha_container">
                    <input type="text" class="captcha" id="captcha" name="captcha" placeholder="4 số" maxlength="4" minlength="4" required>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/captcha.php'); ?>" alt="Captcha" class="captcha_img" onclick="this.src='<?php echo esc_url(get_template_directory_uri() . '/captcha.php'); ?>?'+Math.random();">
                </div>
            </div>

            <div class="form_group btn_group">
                <input type="submit" value="Đăng nhập" class="button">
            </div>
        </div>
    </div>
</form>


<style>
    /* Căn chỉnh form */
    #form_login {
        max-width: 400px;
        margin: 50px auto;
        padding: 0 10px;
    }

    /* Box chứa form */
    .box_login {
        /* background-color: #222; */
        border: 1px solid #555;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }

    /* Tiêu đề */
    .box_title {
        font-size: 18px;
        color: #fff;
        font-weight: bold;
        padding: 10px;
        background: rgb(213, 155, 0);
        border-radius: 5px;
    }

    /* Các trường input */
    .form_fields {
        margin-top: 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* Căn chỉnh label và input */
    .form_group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #fff;
    }

    .form_group label {
        width: 120px;
        font-size: 14px;
    }

    /* Input */
    .common_input,
    .captcha {
        flex: 1;
        height: 30px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background: #333;
    }

    /* Captcha */
    .captcha_container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .captcha_code {
        background: #f44336;
        color: white;
        padding: 5px 10px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
    }

    /* Nút đăng nhập */
    .btn_group {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .button {
        font-size: 14px;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }
</style>