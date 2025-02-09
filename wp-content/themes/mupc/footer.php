<footer class="footer">
    <div class="copyright"><?php the_field('footer', 'option'); ?></div>
</footer>

</div>
<!-- .wrapper -->

<div id="opaco" class="hidden"></div>

<div style="margin-left: -150.5px; margin-top: -157px;" id="popup" class="hidden">
    <div class="bug">
        <div class="close-btn" onclick="togglePopup(); return false;"></div>

        <div class="gallery_video" id="video">
            <div class="gallery_show"></div>
        </div>
    </div>
</div>

<div class="stream-box" style="">
    <div class="streams" style="overflow: hidden; display: block;">
             <?php 
                  $loop = new WP_Query( array(
                    'post_type' => 'steam', 
                    'orderby' => 'post_id',
                     'order' => 'ASC'
                    )); 

                   
                ?>                   
                    <?php while( $loop->have_posts() ) : $loop->the_post(); 
                     $src =  get_field('urlvideo');
                     $url = "https://www.facebook.com/plugins/video.php?autoplay=false&allowfullscreen=false&showtext=false&showcaptions=false&href=".$src."&width=224";
                    
                    ?> 
        <div class="stream" style="padding-top:5px">
        <iframe style="z-index: 0;" class="frame-video" width="224" height="126" src="<?php echo $url ?>" frameborder="0" scrolling="no" allowfullscreen="" ></iframe>
        </div>
        <?php endwhile; ?>

    </div>
    <div class="alerter noselect">
        <span style="padding-right:33px;padding-top:4px;float:left;">&nbsp;Stream Box</span>

        <img class="alert-up" style="vertical-align: middle; display: none;" src="<?php echo get_template_directory_uri() ?>/images/arrow.png">
        <img class="alert-down" style="vertical-align: middle; transform: rotate(180deg); display: inline;" src="<?php echo get_template_directory_uri() ?>/images/arrow.png">

        <span class="live" style="padding-top:4px;">
            <span class="dot blink_dot"></span>
            &nbsp;LIVE&nbsp;
        </span>
    </div>
</div>
<script>

        $('.alerter').click(function (e) {
          e.preventDefault();

          $('.streams').slideToggle();
          rotateArrow(showOnLoad = !showOnLoad);

          setTimeout(function () {
            if ($('.streams').is(':hidden')) { setCookie('hidestreambox', 1, 1000 * 3600 * 12); }
            if ($('.streams').is(':visible')) { setCookie('hidestreambox', 0, 0); }
          }, 1000);

        });

        function rotateArrow(showOnLoad) {
        if (showOnLoad) {
          if (!isMobile()) { showStreams(); }
          $('.alert-down').show(); $('.alert-up').hide();
        }
        else {
          $('.alert-down').hide(); $('.alert-up').show();
          if (!isMobile()) { hideStreams(); }
        }
      }

      function getHideCookie() {
        return parseInt(getCookie('hidestreambox'));
      };

</script>

</body>

</html>