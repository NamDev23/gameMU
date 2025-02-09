<?php
/**
* Get all images
* Template Name:  Get all images
*/

 get_header() ?>


<div class="container">

    <?php get_sidebar('left') // get cột trái sidebar-left.php 
    ?>
    <main class="content">
                    <div class="news-block media-image">
                <div class="content-title"><?php _e( 'Thư viện ảnh', 'mupc' ); ?></div>
                <?php while (have_posts()) : the_post();
                    $img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                ?>
               
                    
						 
							
   <?php $images = get_field('thuvienanh', 'option'); ?> 
   <?php foreach ($images as $image) : ?>
			
								<div>
									<a class=" imgborder" rel="screens" data-lightbox="post" href="<?php echo $image ?>"><img  data-lightbox="post" src="<?php echo $image ?>" width="150px" height="150px"></a>
								</div>
                
	  <?php endforeach; ?>
						
			         


		
	

                  
                <?php endwhile; ?>


            </div>
    </main>

    <?php get_sidebar('right'); // get cột phải sidebar-rigt.php  
    ?>

</div>
<!-- .container -->


<?php get_footer() ?>