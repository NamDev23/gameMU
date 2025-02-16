<?php
?>
<form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="custom_register_action">
    <?php wp_nonce_field('custom_register_action'); ?>

    <div class="box_login">
        <div class="box_title">ĐĂNG KÝ</div>
        <div class="form_fields">
            <div class="form_group">
                <label for="username">Tài khoản</label>
                <input type="text" class="common_input" id="username" name="username" pattern="[a-zA-Z0-9]{6,20}" placeholder="Từ 6 tới 20 ký tự, không dấu" required>
            </div>

            <div class="form_group">
                <label for="login_password">Mật mã</label>
                <input type="password" class="common_input" id="login_password" name="password" placeholder="Từ 6 tới 50 ký tự" required>
            </div>
            <div class="form_group">
                <label for="re-login_password">Nhập lại mật mã</label>
                <input type="password" class="common_input" id="re-login_password" name="re_password" placeholder="Nhập lại mật khẩu" required>
            </div>
            <div class="form_group">
                <label for="pw2"> Mã vòng trong game </label>
                <input type="text" class="pw2" id="pw2" name="pw2" placeholder="6 số"required>
            </div>
            <div class="form_group">
                <label for="email"> Email</label>
                <input type="email" class="common_input" id="email" name="email" required>
            </div>
            <div class="form_group">
                <label for="phone"> Số điện thoại</label>
                <input type="tel" class="common_input" id="phone" name="phone" pattern="^0[0-9]{9}$" placeholder="Nhập số điện thoại (10 chữ số, bắt đầu bằng 0)" required>
            </div>
            <div class="form_group">
                <label for="captcha">Mã chống spam</label>
                <div class="captcha_container">
                    <input type="text" class="captcha" id="captcha" name="captcha" placeholder="4 số" maxlength="4" minlength="4" required>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/captcha.php'); ?>" alt="Captcha" class="captcha_img" onclick="this.src='<?php echo esc_url(get_template_directory_uri() . '/captcha.php'); ?>?'+Math.random();">
                </div>
            </div>

            <div class="form_group btn_group">
                <input type="submit" value="Đăng ký" class="button">
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
    .captcha_container {
        display: flex;
        align-items: center;
        gap: 10px;
        /* Khoảng cách giữa input và ảnh */
    }

    /* Ô nhập CAPTCHA */
    .captcha {
        flex: 1;
        height: 35px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background: #333;
        color: black;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    /* Ảnh CAPTCHA */
    .captcha_img {
        height: 35px;
        /* Chiều cao bằng với input */
        border-radius: 4px;
        border: 1px solid #888;
        cursor: pointer;
        /* Thêm hiệu ứng click để reload */
    }

    /* Hiệu ứng hover khi di chuột vào ảnh CAPTCHA */
    .captcha_img:hover {
        opacity: 0.8;
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