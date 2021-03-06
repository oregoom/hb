<?php get_header() ?>

<?php 

if(have_posts()){
    
    while(have_posts()) : the_post(); ?>   

<div class="d-none d-lg-block container-fluid pb-0 mb-0" id="img-bg-page">
    <nav aria-label="breadcrumb" class="container d-none d-lg-block pt-4">
        <ol class="breadcrumb rounded-pill" style="background: rgba(0, 0, 0, 0.3);">
            <li class="breadcrumb-item"><a class="text-warning" href="<?php echo esc_url(home_url()); ?>">Inicio</a></li>                                
            <li class="breadcrumb-item active text-white" aria-current="page"><?php the_title(); ?></li>
        </ol>
    </nav>
    
</div>













<div class="container bg-white pt-lg-5 pt-4 pb-5 mt-lg-n5" style="border-top-left-radius: 30px; border-top-right-radius: 30px;">
    
    <div class="container">        
        <div class="row">
            
            <article class="col-xl-8 col-lg-7">
                
                <h1 class="pb-4 text-center"><strong> <?php the_title(); ?> </strong></h1>
                
                <!--//GOOGLE ADSENSE (Movil) -->
                <?php if(get_option('template_oregoom_adsense_300_250') != ''){ ?>                
                    <div class="pb-4 text-center d-lg-none">
                        
                        <?php  echo get_option('template_oregoom_adsense_300_250'); ?>
                        
                    </div>                
                <?php } ?>
                
                
                
                <?php $ID_post = get_the_ID(); ?>                
                
                <?php the_content(); ?>    
                
                <?php
                    $id_cat_page = get_post_meta($ID_post, 'hb_cat_page', true);

                    $count_historias_page = 1;

                    if($id_cat_page != ''){

                        $shortcode_query = new WP_Query( array(
                                                        'cat' => $id_cat_page,
                                                        'order'   => 'ASC',
                                                        'posts_per_page' => 200
                        ));

                        if($shortcode_query->have_posts()){ ?>

                    <div class="pt-5 border-top"><?php

                        while($shortcode_query->have_posts()) : $shortcode_query->the_post();

                            if(has_post_thumbnail()){ ?>

                                <div class="mb-4 card border-0">
                                  <div class="row no-gutters">
                                    <div class="col-lg-4 col-sm-4">
                                        <a href="<?php echo the_permalink(); ?>"><img src="<?php the_post_thumbnail_url();?>" class="card-img"></a>
                                    </div>
                                    <div class="col-lg-8 col-sm-8">
                                        <div class="card-body pt-sm-0 pl-sm-4 pt-3 pl-0 pr-0">
                                            <p class="text-muted m-0">HISTORIA <?php echo $count_historias_page++; ?></p>
                                            <h5 class="card-title h5 mb-1" style="line-height: 1.3em; font-family: Raleway, sans-serif; font-weight: 700; color: #2a3b47;"><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></h5>
                                            <?php //Funcion para extraer 100 caracteres
                                                    hb_excerpt_100_caracteres(get_the_excerpt()); ?>
                                            <a class="mt-0" href="<?php the_permalink(); ?>"><small>Seguir leyendo</small></a>
                                        </div>
                                    </div>
                                  </div>
                                </div><?php                    
                            }

                        endwhile;
                        $shortcode_query->reset_postdata();?>

                    </div><?php

                        }
                    }
                ?>
            </article>  
            <aside class="col-xl-4 col-lg-5">            
                <?php get_sidebar();?>            
            </aside>
            
        </div>        
    </div>
    
</div>

    <?php
    
    endwhile;
    wp_reset_postdata();    
} ?>



<?php

/*
 * ===============================
 * Pie de p??gina 
 */
get_footer();