<?php
/**
* A Simple Category Template
* Template Name: View list su kien
*/

get_header(); ?> 
 

 <main>
  <div class="shg_title">
    <h1 class="title">Kết quả tìm kiếm</h1>
  </div>
  <div class="news pr">
    <div class="news_content container_shg show_tab">
<?php if ( have_posts() ) : ?>
      <div class="news_list"> 
 <?php echo "Từ khóa :  " .get_search_query() ?>

<?php while ( have_posts() ) : the_post(); 
$id = get_the_ID();
$featured_img_url = "http://tienlinhmobile.net/wp-content/uploads/2022/07/logo-tien-linh-copy.png"; 
?>
        <article class="post flex pr">
          <a href="<?php the_permalink()  ?>" title="<?php the_title() ?>" class="img-news">
            <img src="<?php echo $featured_img_url?>" data-level="7" data-w="350" class=" ls-is-cached lazyloaded" data-src="<?php echo $featured_img_url?>" srcset="<?php echo $featured_img_url?> 1920w">
          </a>
          <div class="detail">
            <h3>
              <a href="<?php the_permalink()  ?>" title="<?php the_title()?>"><?php the_title();?></a>
            </h3>
            <p></p>
            <time><?php echo get_the_date('d.m.Y')?></time>
          </div>
          <div class="share flex">
            <h5>Share</h5>
            <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink()  ?>" title="" class="btn_share">Facebook</a>
          </div>
        </article>
		
        <?php endwhile; ?>
      </div>
	    <?php endif; ?>
      <a href="javascript:void(0)" title="Xem thêm" class="btn_viewmore flex_center" data-key="10" data-cat="28">
        <span>Xem thêm</span>
      </a>
    </div>
  </div>
</main>

<?php get_footer(); ?>