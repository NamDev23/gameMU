<aside class="right-sidebar">

  <div class="login-block">
    <span class="right-sidebar-title sidebar-title right-sidebar-title-top">
      <?php _e('Ngôn ngữ', 'mupc'); ?>
    </span>
    <?php echo do_shortcode('[wpml_language_switcher type="footer" flags=1 native=1 translated=1][/wpml_language_switcher]'); ?>
  </div><br>

  <div class="login-block">
    <span class="right-sidebar-title sidebar-title right-sidebar-title-top">
      <?php _e('Đăng nhập', 'mupc'); ?>
    </span>

    <?php if (!is_user_logged_in()) : ?>
      <form id="form-login">
        <button id="button-login">
          <a href="#" onclick="changeAction('login'); return false;"><?php _e('Đăng nhập', 'mupc'); ?></a>
        </button>
        <div id="login-links" style="font-size:12px">
          <a href="<?php echo wp_lostpassword_url(); ?>">Quên mật khẩu?</a>
          <br>
          <button id="button-register">
            <a href="#" onclick="changeAction('register'); return false;"><?php _e('Đăng ký', 'mupc'); ?></a>
          </button>
        </div>
      </form>
    <?php else : ?>
      <button id="button-logout">
        <a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
      </button>
    <?php endif; ?>

  </div>

</aside>

<script>
  function loadForm(actionType) {
    let xhr = new XMLHttpRequest();
    let url = window.location.origin + window.location.pathname + '?action=' + actionType;

    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        let parser = new DOMParser();
        let doc = parser.parseFromString(xhr.responseText, "text/html");
        let newContent = doc.querySelector('.content');

        if (newContent) {
          document.querySelector('.content').innerHTML = newContent.innerHTML;
        }
      }
    };
    xhr.send();
  }
</script>