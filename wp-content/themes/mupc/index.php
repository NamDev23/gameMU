<?php get_header();




?>


<div class="container">

  <?php get_sidebar('left') // get cột trái sidebar-left.php 
  ?>
  <main class="content">
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'login') {
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