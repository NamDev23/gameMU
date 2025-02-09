<?php 
/**
* Get all images
* Template Name:  Download
*/
get_header() ?>


<div class="container">

    <?php get_sidebar('left') // get cột trái sidebar-left.php 
    ?>
    <main class="content">
        <div class="video-block block">
            <!-- new feed -->
            <div class="news-block">
                
                <?php while (have_posts()) : the_post();
                    $img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                ?>
                <div class="content-title"><?php the_title() ?></div>
                    <div class="news">
                        <div class="news-title flex-s-c">
                            <a href="<?php the_permalink() ?>"><?php the_title() ?> </a>
                            <span class="date">
                                <?php echo get_the_date('d/m/Y'); ?>
                            </span>
                        </div>
                        <?php the_content(); ?>

                        <div class="news-info flex-s-c">
                            <span class="author">Tác giả: <a href="#"><?php the_author() ?></a></span>

                        </div>
                    </div>
                <?php endwhile; ?>



<div class="muframe">
          <div style="width:486px">
            <article class="fb-page fb_iframe_widget" style="width:486px" data-href="<?php the_field('fanpage', 'option'); ?>" data-width="486" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=&amp;container_width=472&amp;hide_cover=false&amp;href=<?php the_field('fanpage', 'option'); ?>&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;width=486"><span style="vertical-align: bottom; width: 472px; height: 130px;">
              <iframe name="f1dfd901d5cc2c" width="486px" height="1000px" data-testid="fb:page Facebook Social Plugin" title="fb:page Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://web.facebook.com/v6.0/plugins/page.php?adapt_container_width=true&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df222834c4e50384%26domain%3Dmu.bless.gs%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fmu.bless.gs%252Ffff4ec5ed1ca1c%26relation%3Dparent.parent&amp;container_width=472&amp;hide_cover=false&amp;href=<?php the_field('fanpage', 'option'); ?>&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;width=486" style="border: none; visibility: visible; width: 472px; height: 130px;" class="">
              </iframe></span></article>
          </div>

        </div>

            </div>
        </div>
    </main>

    <?php get_sidebar('right'); // get cột phải sidebar-rigt.php  
    ?>

</div>
<!-- .container -->


<?php get_footer() ?>