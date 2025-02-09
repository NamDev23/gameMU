
      <aside class="right-sidebar">

<div class="login-block">
  <span class="right-sidebar-title sidebar-title right-sidebar-title-top"> <?php _e( 'Ngôn ngữ', 'mupc' ); ?></span>
  <?php echo do_shortcode('[wpml_language_switcher type="footer" flags=1 native=1 translated=1][/wpml_language_switcher]'); ?>
</div><br>

<div class="login-block">


  <span class="right-sidebar-title sidebar-title right-sidebar-title-top"> <?php _e( 'Đăng nhập', 'mupc' ); ?></span>
  <form id="form-login" >
    <button id="button-login"><a href="<?php the_field('idlink', 'option'); ?>"><?php _e( 'Đăng nhập', 'mupc' ); ?></a></button>

    <div id="login-links" style="font-size:12px">
      <a href="<?php the_field('idlink', 'option'); ?>"><?php _e( 'Khôi phục mật khẩu', 'mupc' ); ?></a>
      <br>
      <a href="<?php the_field('idlink', 'option'); ?>"><?php _e( 'Đăng ký', 'mupc' ); ?></a>
    </div>

  </form>
</div>

<!--
<div class="download-block">
  <span class="right-sidebar-title sidebar-title" style="padding-top:12px;">
  <img src="<?php echo get_template_directory_uri() ?>/images/fb-group.png"></span>
  <div style="text-align:left;padding-left:7px;">
    <img src="<?php echo get_template_directory_uri() ?>/images/online-icon.png" style="vertical-align:middle">
    <span style="color:#d2c1a2"> <?php _e( 'Thành viên Online', 'mupc' ); ?>:</span>
    <span style="color:#cfcfcf;" id="discord-online">0</span>
  </div>
  <!--<div style="text-align:center;margin-left:17px;margin-top:10px"><button id="button-discord"><a
        style="text-decoration:none" id="discord-connect" href="<?php the_field('linkgroupfb', 'option'); ?>" target="_blank"><?php _e( 'Kết nối', 'mupc' ); ?></a></button></div>-->
</div>-->

<!--<div class="download-block">
  <span class="right-sidebar-title sidebar-title" style="margin-top:-19px"><?php _e( 'Tải game', 'mupc' ); ?></span>-->
  <!-- style="margin-top:-15px" -->
  <!--<div class="s-title"><?php _e( 'Các tập tin cần thiết để tham gia vào máy chủ MU  của chúng tôi', 'mupc' ); ?></div>

  <p><a href="<?php the_field('linkdowngame', 'option'); ?>" class="load-img"></a></p>
  <p><a href="<?php the_field('linkdowngame', 'option'); ?>" class="load-link"><?php _e( 'Tải xuống bản trò chơi đầy đủ (698 MB) ', 'mupc' ); ?></a></p>
</div>-->


<!-- Kho bạc lâu đài div  <div class="market-items-block">
  <span class="right-sidebar-title sidebar-title">Kho b&#7841;c l&acirc;u &#273;&agrave;i</span>
  <div class="s-title">State of the castle treasury</div>
  <div style="text-align:center;font-family: Tahoma, Geneva, sans-serif;font-size:11px">
    <div class="block-tab kazna-tab " id="kazna-server2">
      <div style="display:flex;justify-content:space-between;margin:0px 10px">
        <div><span style="color:#d2c1a2">Bonuses</span></div>
        <div><span style="color:#cfcfcf">229</span></div>
      </div>
      <div style="display:flex;justify-content:space-between;margin:0px 10px;margin-top:6px">
        <div><span style="color:#d2c1a2">Zen</span></div>
        <div><span style="font-weight:;color:#cfcfcf">8.78 kkk</span></div>
      </div>
      <br>
      <div style="margin-top:10px"><a class="menu-flash-link" href="index.html">Current Castle siege owner RoyaL
          guild</a></div>
    </div>
    <div class="block-tab kazna-tab " id="kazna-server4">
      <div style="display:flex;justify-content:space-between;margin:0px 10px">
        <div><span style="color:#d2c1a2">Bonuses</span></div>
        <div><span style="color:#cfcfcf">218</span></div>
      </div>
      <div style="display:flex;justify-content:space-between;margin:0px 10px;margin-top:6px">
        <div><span style="color:#d2c1a2">Zen</span></div>
        <div><span style="font-weight:;color:#cfcfcf">845.22 kk</span></div>
      </div>
      <br>
      <div style="margin-top:10px"><a class="menu-flash-link" href="index.html">Current Castle siege owner 12zen
          guild</a></div>
    </div>
    <div class="block-tab kazna-tab active" id="kazna-server6">
      <div style="display:flex;justify-content:space-between;margin:0px 10px">
        <div><span style="color:#d2c1a2">Bonuses</span></div>
        <div><span style="color:#cfcfcf">8082</span></div>
      </div>
      <div style="display:flex;justify-content:space-between;margin:0px 10px;margin-top:6px">
        <div><span style="color:#d2c1a2">Zen</span></div>
        <div><span style="font-weight:;color:#cfcfcf">2.03 kkk</span></div>
      </div>
      <br>
      <div style="margin-top:10px"><a class="menu-flash-link" href="index.html">Current Castle siege owner
          ZurkaS guild</a></div>
    </div>
    <div class="block-tab kazna-tab " id="kazna-server3">
      <div style="display:flex;justify-content:space-between;margin:0px 10px">
        <div><span style="color:#d2c1a2">Bonuses</span></div>
        <div><span style="color:#cfcfcf">394</span></div>
      </div>
      <div style="display:flex;justify-content:space-between;margin:0px 10px;margin-top:6px">
        <div><span style="color:#d2c1a2">Zen</span></div>
        <div><span style="font-weight:;color:#cfcfcf">5.31 kkk</span></div>
      </div>
      <br>
      <div style="margin-top:10px"><a class="menu-flash-link" href="index.html">Current Castle siege owner
          Cardinal guild</a></div>
    </div>
    <div class="block-tab kazna-tab " id="kazna-server1">
      <div style="display:flex;justify-content:space-between;margin:0px 10px">
        <div><span style="color:#d2c1a2">Bonuses</span></div>
        <div><span style="color:#cfcfcf">341</span></div>
      </div>
      <div style="display:flex;justify-content:space-between;margin:0px 10px;margin-top:6px">
        <div><span style="color:#d2c1a2">Zen</span></div>
        <div><span style="font-weight:;color:#cfcfcf">413.23 kk</span></div>
      </div>
      <br>
      <div style="margin-top:10px"><a class="menu-flash-link" href="index.html">Current Castle siege owner HOME
          guild</a></div>
    </div>
    <div class="block-tab kazna-tab " id="kazna-server5">
      <div style="display:flex;justify-content:space-between;margin:0px 10px">
        <div><span style="color:#d2c1a2">Bonuses</span></div>
        <div><span style="color:#cfcfcf">426</span></div>
      </div>
      <div style="display:flex;justify-content:space-between;margin:0px 10px;margin-top:6px">
        <div><span style="color:#d2c1a2">Zen</span></div>
        <div><span style="font-weight:;color:#cfcfcf">2.57 kkk</span></div>
      </div>
      <br>
      <div style="margin-top:10px"><a class="menu-flash-link" href="index.html">Current Castle siege owner
          Kingsman guild</a></div>
    </div>

    <br>
    <div class="border-bottom" style="padding-top:5px"></div>

    <div class="block-buttons">
      <a data-tab="kazna-server2" class="btn-block-kazna winners-flash-link " href="vn.html">Master</a>
      <a data-tab="kazna-server4" class="btn-block-kazna winners-flash-link " href="vn.html">Origin</a>
      <a data-tab="kazna-server6" class="btn-block-kazna winners-flash-link active" href="vn.html">Mega</a>
      <a data-tab="kazna-server3" class="btn-block-kazna winners-flash-link " href="vn.html">Empire</a>
      <a data-tab="kazna-server1" class="btn-block-kazna winners-flash-link " href="vn.html">Deus</a>
      <a data-tab="kazna-server5" class="btn-block-kazna winners-flash-link " href="vn.html">Extreme</a>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $('.btn-block-kazna').click(function () {
        $('.btn-block-kazna').removeClass('active');
        $(this).addClass('active');
        $('.block-tab.kazna-tab').removeClass('active');
        $('#' + $(this).attr('data-tab')).addClass('active');
      })
    });
  </script>
</div> -->

</aside>