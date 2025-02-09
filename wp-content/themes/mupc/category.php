<?php get_header() ?>
<div class="container">

    <?php get_sidebar('left') // get cột trái sidebar-left.php 
    ?>
    <main class="content">
        <div class="video-block block">
            <!-- new feed -->
            <div class="adverts-block block">
                <div class="content-title">Toàn bộ tin tức</div>
                <table class="an-table">

                    <?php

                    $current_page = get_queried_object();
                    $category     = $current_page->post_name;

                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                    $query = new WP_Query(array(
                        'category_name' => $category,
                        'paged'         => $paged,
                        'posts_per_page' => 10,
                        'post_type'   => 'post',
                        'order'       => 'DESC',
                    ));
                    ?>


                    <?php if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post(); ?>
                            <tr>
                                <td><img src="<?php echo get_template_directory_uri() ?>/images/images-an_icon.png"></td>
                                <td><a href="<?php the_permalink() ?>" ><?php the_title() ?> </a></td>
                                <td><?php echo get_the_date('d/m/Y'); ?></td>
                            </tr>
                    <?php
                        }

                        wp_reset_postdata();
                    }
                    ?>

                </table>

                <div class="pagination-container" id="pagination-container">

                    <ul id="pagination" class="pagination">
                        <?php
                        $pag_args = array(
                            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'total'        => $wp_query->max_num_pages,
                            'current'      => max(1, get_query_var('paged')),
                            'format'       => '?paged=%#%',
                            'show_all'     => false,
                            'type'         => 'plain',
                            'end_size'     => 2,
                            'mid_size'     => 1,
                            'prev_next'    => true,
                            'prev_text'    => sprintf('<<'),
                            'next_text'    => sprintf('>>'),
                            'add_args'     => false,
                            'add_fragment' => '',
                        );
                        echo paginate_links($pag_args);
                        ?>
                    </ul>
                    <br>
                </div>
            </div>
    </main>

    <?php get_sidebar('right'); // get cột phải sidebar-rigt.php  
    ?>

</div>
<!-- .container -->


<?php get_footer() ?>