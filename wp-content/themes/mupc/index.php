<?php get_header();




?>


<div class="container">

  <?php get_sidebar('left') // get cột trái sidebar-left.php 
  ?>
  <main class="content">
    <?php

    if (isset($_GET['action']) && $_GET['action'] === 'verify_email' && isset($_GET['token'])) {
      $token = sanitize_text_field($_GET['token']);

      // Tìm user có meta email_verification_token = $token
      $users = get_users(array(
        'meta_key'   => 'email_verification_token',
        'meta_value' => $token,
        'number'     => 1,
      ));

      if (!empty($users)) {
        $user = $users[0];
        // Xác minh thành công: xóa token, set meta is_email_verified = 1
        delete_user_meta($user->ID, 'email_verification_token');
        update_user_meta($user->ID, 'is_email_verified', 1);

        echo "<p>Email của bạn đã được xác minh thành công!</p>";
      } else {
        echo "<p>Token không hợp lệ hoặc đã hết hạn.</p>";
      }
      exit;
    }

    if (is_user_logged_in()) {
      // Ví dụ hiển thị dashboard hoặc giao diện home cho người dùng đã đăng nhập
      $current_user = wp_get_current_user();
    ?>
      <div class="dashboard">
        <h2>Chào mừng, <?php echo esc_html($current_user->display_name); ?></h2><br><br>

        <!-- Menu chứa các nút -->
        <div class="menu_option">
          <button id="btnInfo" class="active">Thông tin</button>
          <button id="btnChangePass">Đổi mật khẩu</button>
          <button id="btnNapMCash">Nạp mcash</button>
          <button id="btnChuyenMCash">Chuyển mcash</button>
          <button id="btnemail">Xác minh email</button>
          <button id="btnchangename">Đổi tên nhân vật</button>
        </div>

        <!-- Box chứa thông tin -->
        <div id="boxInfo" class="content-box active">
          <?php
          // Gọi hàm lấy thông tin user
          $user_info = get_current_user_info();

          if ($user_info === false) {
          ?>
            <p>Bạn chưa đăng nhập. <a href="?action=login">Đăng nhập</a></p>
          <?php
          } else {
            // Hiển thị thông tin user bằng HTML
          ?>
            <div class="user-info-box">
              <h2>Thông tin người dùng</h2>
              <br><br>
              <p><strong>Tên đăng nhập:</strong>
                <?php echo esc_html($user_info['username']); ?>
              </p>
              <p><strong>Email:</strong>
                <?php echo esc_html($user_info['email']); ?>
                <?php
                // Kiểm tra user đã xác minh email chưa
                $verified = get_user_meta($current_user->ID, 'is_email_verified', true);
                if ($verified == 1) {
                  echo ' <span style="color: green;">(Đã xác minh)</span>';
                } else {
                  echo ' <span style="color: red;">(Chưa xác minh)</span>';
                }
                ?>
              </p>
              <p><strong>Tên hiển thị:</strong> <?php echo esc_html($user_info['display_name']); ?></p>

              <?php if (isset($user_info['phone'])) : ?>
                <p><strong>Số điện thoại:</strong> <?php echo esc_html($user_info['phone']); ?></p>
              <?php endif; ?>
            </div>
          <?php
          }
          ?>
        </div>

        <!-- Box đổi mật khẩu -->
        <div id="boxChangePass" class="content-box">
          <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="change_password_action">
            <?php wp_nonce_field('change_password_action'); ?>

            <div class="change-password-box">
              <h2>Đổi mật khẩu</h2>
              <br><br>

              <p>
                <label for="old_password">Mật khẩu cũ</label><br><br>
                <input type="password" id="old_password" name="old_password" required>
              </p>

              <p>
                <label for="new_password">Mật khẩu mới</label><br><br>
                <input type="password" id="new_password" name="new_password" required>
              </p>

              <p>
                <label for="re_new_password">Xác nhận mật khẩu mới</label><br><br>
                <input type="password" id="re_new_password" name="re_new_password" required>
              </p>

              <p>
                <button class="btn-changePass" type="submit">Đổi mật khẩu</button>
              </p>
            </div>
          </form>
        </div>

        <!-- Box nạp mcash -->
        <div id="boxNapMCash" class="content-box">
          <!-- Tab lựa chọn: MOMO và Ngân hàng -->
          <div class="napmcash-tabs">
            <button id="btnMomo" class="active">MOMO</button>
            <button id="btnBank">Ngân hàng</button>
          </div>
          <!-- Nội dung form nạp tiền -->
          <div class="napmcash-form">
            <!-- Form dành cho MOMO -->
            <div id="momoForm" class="form-content active">
              <table class="form-table">
                <tr>
                  <!-- Cột chứa hình ảnh MOMO -->
                  <td class="image-col">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/momo.png" alt="MOMO" style="max-width: 80px;">
                  </td>
                  <!-- Cột chứa thông tin người nhận -->
                  <td class="info-col">
                    <strong>Cách nạp qua MOMO</strong>
                    <ul>
                      <li>Chuyển tiền tới số đt: <b>0862968396</b></li>
                      <li>Họ tên người nhận: <b>Đinh Thị Diệu Linh</b></li>
                      <li>Nội dung chuyển tiền là ID cần nạp</li>
                    </ul>
                  </td>
                </tr>
              </table>
            </div>
            <!-- Form dành cho Ngân hàng -->
            <div id="bankForm" class="form-content">
              <table class="form-table">
                <tr>
                  <!-- Cột chứa hình ảnh logo ngân hàng (thay link hình theo thực tế) -->
                  <td class="image-col">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/acb.jpeg" alt="Ngân hàng" style="max-width: 180px;">
                  </td>
                  <!-- Cột chứa thông tin người nhận -->
                  <td class="info-col">
                    <strong>Cách nạp qua Ngân hàng</strong>
                    <ul>
                      <li>Ngân Hàng: <b>ACB - Ngân hàng Thương mại Cổ phần Á Châu</b></li>
                      <li>Chuyển tiền tới STK: <b>838608888</b></li>
                      <li>Tên tài khoản: <b>Đinh Thị Diệu Linh</b></li>
                      <li>Nội dung chuyển tiền là ID cần nạp</li>
                    </ul>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>


        <!-- Thêm boxEmail để gửi link xác minh -->
        <div id="boxEmail" class="content-box">
          <h3>Xác minh email</h3>
          <p>Email hiện tại của bạn: <strong><?php echo esc_html($current_user->user_email); ?></strong></p>
          <p>Nhấn nút để gửi link xác minh:</p>

          <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="send_verification_link">
            <?php wp_nonce_field('send_verification_link'); ?>
            <button type="submit">Gửi link xác minh</button>
          </form>
        </div>

      </div>

    <?php
    } elseif (isset($_GET['action']) && $_GET['action'] == 'login') {
      include 'form-login.php'; // Gọi file form-login.php
    } elseif (isset($_GET['action']) && $_GET['action'] == 'register') {
      include 'form-register.php'; // Gọi file form-register.php
    } else {
    ?>
      <div class="img-carousel-block block">
        <div class="content-title"><?php _e('Screenshots', 'mupc'); ?> <a href="/all-media"><?php _e('Xem toàn bộ', 'mupc'); ?></a></div>
        <div id="carousel" class="carousel">
          <button id="img-carousel-back" class="arrow prev disabled"></button>
          <div class="gallery">
            <ul class="images">

              <?php $images = get_field('thuvienanh', 'option');

              ?>
              <?php foreach ($images as $image) : ?>

                <li><a href="<?php echo $image; ?>" data-lightbox="side"><img src="<?php echo $image; ?>">
                    <div id="img_border"></div>
                  </a></li>
              <?php endforeach; ?>



            </ul>
          </div>
          <button id="img-carousel-next" class="arrow next"></button>
        </div>
      </div>

      <div class="video-block block">


        <div class="adverts-block block">
          <div class="content-title"><?php _e('Thông báo', 'mupc'); ?></div>
          <table class="an-table">

            <?php
            $lang = get_language_shortcode();
            if ($lang = 'vi') {
              $tinhot = new WP_Query(array(
                'numberposts' => 5,
                'post_type'   => 'post',
                'category_name' => 'tin-hot',
                'order'       => 'desc',
              ));
            } else {

              $tinhot = new WP_Query(array(
                'numberposts' => 5,
                'post_type'   => 'post',
                'category_name' => 'tin-hot-2',
                'order'       => 'desc',
              ));
            }
            ?>

            <!-- list tin tức thông báo --->
            <?php while ($tinhot->have_posts()) : $tinhot->the_post();
              $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
              <tr>
                <td><img src="<?php echo get_template_directory_uri() ?>/images/images-an_icon.png"></td>
                <td><a href="<?php the_permalink() ?>" target="_blank "><?php the_title() ?> </a></td>
                <td><?php echo get_the_date('d/m/Y'); ?></td>
              </tr>
            <?php endwhile; ?>

          </table>
          <br>
        </div>
        <!-- new feed -->
        <div class="news-block">
          <?php

          $lang = get_language_shortcode();
          if ($lang == 'vi') {
            $urlvn = 'danh-muc/tin-tuc/?lang=vi';
          } else {
            $urlen = 'category/tin-tuc-2/';
          }

          ?>
          <?php if ($lang == 'vi') {  ?>
            <div class="content-title"><?php _e('Tin Tức', 'mupc'); ?><a target="_blank" href="<?php echo $urlvn ?>"><?php _e('Xem tất cả tin tức', 'mupc'); ?></a></div>
          <?php } else { ?>

            <div class="content-title"><?php _e('Tin Tức', 'mupc'); ?><a target="_blank" href="<?php echo $urlen ?>"><?php _e('Xem tất cả tin tức', 'mupc'); ?></a></div>

          <?php } ?>

          <?php
          $lang = get_language_shortcode();
          if ($lang = 'vi') {
            $feed = new WP_Query(array(
              'numberposts' => 5,
              'post_type'   => 'post',
              'category_name' => 'new-feed',
              'order'       => 'desc',
            ));
          } else {

            $feed = new WP_Query(array(
              'numberposts' => 5,
              'post_type'   => 'post',
              'category_name' => 'new-feed-2',
              'order'       => 'desc',
            ));
          }
          ?>

          <?php while ($feed->have_posts()) : $feed->the_post();
            $img = get_the_post_thumbnail_url(get_the_ID(), 'full');
          ?>
            <div class="news">
              <div class="news-title flex-s-c">
                <a href="<?php the_permalink() ?>"><?php the_title() ?> </a>
                <span class="date">
                  <?php echo get_the_date('d/m/Y'); ?>
                </span>
              </div>


              <?php the_content(); ?>

              <div class="news-info flex-s-c">
                <span class="author"><?php _e('Tác giả', 'mupc'); ?>: <a href="#"><?php the_author() ?></a></span>

              </div>
            </div>

          <?php endwhile; ?>


          <script>
            jQuery(document).ready(function($) {
              $('.news-block img').each(function() {
                $(this).hide();
                var src = $(this).attr('src');
                var html =
                  '<div class="muframe"> <div><a href="' + src + '" data-lightbox="post"><img src=' + src + ' width="100%" data-lightbox="post"></div> </div> <br> <br>';

                $(this).replaceWith(html);
                //$(this).attr('data-lightbox','post');
                //console.log(html);

              })

            })
          </script>

          <!-- <div class="pagination flex-c-c">
              <a href="javascript:;.html" class="prev nav" style="color:#aea6a6;cursor:default;">Back</a><a
                class="page-number active" href="index.html">1</a><a class="page-number" href="index.html">2</a><a
                class="page-number" href="index.html">3</a><a class="page-number" href="index.html">4</a><a
                class="page-number" href="index.html">5</a><a href="index.html" class="next nav">Next</a>
            </div> -->
          <br>
          <hr>
          <br>
          <div class="muframe">
            <div style="width:486px">
              <article class="fb-page fb_iframe_widget" style="width:486px" data-href="<?php the_field('fanpage', 'option'); ?>" data-width="486" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=&amp;container_width=472&amp;hide_cover=false&amp;href=<?php the_field('fanpage', 'option'); ?>&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;width=486"><span style="vertical-align: bottom; width: 472px; height: 130px;">
                  <iframe name="f1dfd901d5cc2c" width="486px" height="1000px" data-testid="fb:page Facebook Social Plugin" title="fb:page Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://web.facebook.com/v6.0/plugins/page.php?adapt_container_width=true&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df222834c4e50384%26domain%3Dmu.bless.gs%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fmu.bless.gs%252Ffff4ec5ed1ca1c%26relation%3Dparent.parent&amp;container_width=472&amp;hide_cover=false&amp;href=<?php the_field('fanpage', 'option'); ?>&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;width=486" style="border: none; visibility: visible; width: 472px; height: 130px;" class="">
                  </iframe></span></article>
            </div>

          </div>
        </div>
      <?php
    }
      ?>
  </main>

  <?php get_sidebar('right'); // get cột phải sidebar-rigt.php  
  ?>

</div>
<!-- .container -->


<?php get_footer() ?>


<script>
  function changeAction(actionType) {
    // Cập nhật URL nhưng không tải lại trang
    let newUrl = window.location.origin + window.location.pathname + '?action=' + actionType;
    window.history.pushState({
      path: newUrl
    }, '', newUrl);

    // Gọi AJAX để hiển thị form login hoặc register
    loadForm(actionType);
  }

  function loadForm(actionType) {
    let xhr = new XMLHttpRequest();
    let url = window.location.origin + window.location.pathname + '?action=' + actionType;

    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        let parser = new DOMParser();
        let doc = parser.parseFromString(xhr.responseText, "text/html");
        let newContent = doc.querySelector('.content'); // Lấy phần tử theo class

        if (newContent) {
          document.querySelector('.content').innerHTML = newContent.innerHTML;
        }
      }
    };
    xhr.send();
  }
</script>
<script>
  // Lấy các phần tử nút và box
  const btnInfo = document.getElementById('btnInfo');
  const btnChangePass = document.getElementById('btnChangePass');
  const btnNapMCash = document.getElementById('btnNapMCash');

  const boxInfo = document.getElementById('boxInfo');
  const boxChangePass = document.getElementById('boxChangePass');
  const boxNapMCash = document.getElementById('boxNapMCash');

  // Hàm reset tất cả các button và box về trạng thái ban đầu
  function resetTabs() {
    // Xóa class active của tất cả các button
    btnInfo.classList.remove('active');
    btnChangePass.classList.remove('active');
    btnNapMCash.classList.remove('active');

    // Ẩn tất cả các box
    boxInfo.classList.remove('active');
    boxChangePass.classList.remove('active');
    boxNapMCash.classList.remove('active');
  }

  // Xử lý sự kiện click cho từng button
  btnInfo.addEventListener('click', () => {
    resetTabs();
    btnInfo.classList.add('active');
    boxInfo.classList.add('active');
  });

  btnChangePass.addEventListener('click', () => {
    resetTabs();
    btnChangePass.classList.add('active');
    boxChangePass.classList.add('active');
  });

  btnNapMCash.addEventListener('click', () => {
    resetTabs();
    btnNapMCash.classList.add('active');
    boxNapMCash.classList.add('active');
  });

  document.getElementById('btnMomo').addEventListener('click', function() {
    // Cập nhật trạng thái active cho các button
    document.getElementById('btnMomo').classList.add('active');
    document.getElementById('btnBank').classList.remove('active');
    // Hiển thị form MOMO, ẩn form Ngân hàng
    document.getElementById('momoForm').classList.add('active');
    document.getElementById('bankForm').classList.remove('active');
  });

  document.getElementById('btnBank').addEventListener('click', function() {
    // Cập nhật trạng thái active cho các button
    document.getElementById('btnBank').classList.add('active');
    document.getElementById('btnMomo').classList.remove('active');
    // Hiển thị form Ngân hàng, ẩn form MOMO
    document.getElementById('bankForm').classList.add('active');
    document.getElementById('momoForm').classList.remove('active');
  });
  const btnemail = document.getElementById('btnemail');
  const boxEmail = document.getElementById('boxEmail');

  // Trong hàm resetTabs(), xóa class active của btnemail và boxEmail
  function resetTabs() {
    btnInfo.classList.remove('active');
    btnChangePass.classList.remove('active');
    btnNapMCash.classList.remove('active');
    btnemail.classList.remove('active');

    boxInfo.classList.remove('active');
    boxChangePass.classList.remove('active');
    boxNapMCash.classList.remove('active');
    boxEmail.classList.remove('active');
  }

  // Sự kiện click cho btnemail
  btnemail.addEventListener('click', () => {
    resetTabs();
    btnemail.classList.add('active');
    boxEmail.classList.add('active');
  });
</script>
<style>
  /* CSS cho menu button */
  .menu_option {
    display: flex;
    flex-wrap: wrap;
    /* border-bottom: 1px solid #ccc;
              margin-bottom: 10px; */
  }

  .menu button {
    /* padding: 10px 20px;
              border: none;
              background-color: #f0f0f0; */
    cursor: pointer;
    font-size: 16px;
    flex: 0 0 calc(33.33% - 10px);
    /* mỗi button chiếm khoảng 1/3 chiều rộng trừ đi khoảng cách */
    box-sizing: border-box;
    /* transition: background-color 0.3s; */
  }

  .menu button.active {
    background-color: #ddd;
    font-weight: bold;
  }

  /* CSS cho box chứa nội dung */
  .content-box {
    border: 1px solid #ccc;
    padding: 20px;
    display: none;
    /* ẩn mặc định */
  }

  .content-box.active {
    display: block;
  }

  #boxChangePass {
    /* display: flex; */
    text-align: center;
    justify-content: center;
    align-items: center;
  }

  #btn-changePass {
    display: flex !important;
    text-align: center !important;
    align-items: center !important;
    justify-content: center !important;

  }

  /* Một vài style cho form */
  form div {
    margin-bottom: 10px;
  }

  label {
    display: inline-block;
    width: 150px;
    font-weight: bold;
  }

  input {
    padding: 5px;
    width: 200px;
  }

  /* Style cho box nạp mcash */
  #boxNapMCash {
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 600px;
    margin: 20px auto;
    background-color: #D1CBBF;
    font-family: Arial, sans-serif;
  }

  /* Style cho các tab button */
  .napmcash-tabs {
    display: flex;
    gap: 10px;
    /* Khoảng cách giữa 2 button, điều chỉnh theo ý bạn */
    /* Nếu cần căn giữa container, có thể thêm: */
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
  }

  .napmcash-tabs button {
    border: 1px solid #ccc;
    cursor: pointer;
  }


  /* Style cho nội dung form */
  .napmcash-form .form-content {
    display: none;
  }

  .napmcash-form .form-content.active {
    display: block;
  }

  /* Style cho bảng form */
  .form-table {
    width: 100%;
    border-collapse: collapse;
  }

  .form-table .image-col {
    width: 100px;
    text-align: center;
    vertical-align: top;
  }

  .form-table .info-col {
    padding-left: 10px;
  }

  .user-info-box h2 {
    font-size: 20px;
    /* Tăng cỡ chữ tùy ý */
    font-weight: bold;
    /* In đậm */
    color: #333;
    /* Màu chữ */
    /* margin-bottom: 10px; */
    /* Khoảng cách dưới */
  }
</style>