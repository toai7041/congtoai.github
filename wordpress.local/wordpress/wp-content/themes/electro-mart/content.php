<?php
/**
 * @package Electro Mart
 */
?>
 <div class="BLogStyle-01">
 <div class="ContentStyle-ForSite">     
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>         
		  <?php if( get_theme_mod( 'electro_mart_hide_postfeatured_image' ) == '') { ?> 
			 <?php if (has_post_thumbnail() ){ ?>
                <div class="BlogImgDiv <?php if( esc_attr( get_theme_mod( 'electro_mart_blogimg_fullwidth' )) ) { ?>imgFull<?php } ?>">
                 <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                </div>
             <?php } ?> 
          <?php } ?> 
       
        <header class="entry-header">
           <?php if ( 'post' == get_post_type() ) : ?>
                <div class="BlogMeta-Strip">
                   <?php if( get_theme_mod( 'electro_mart_hide_blogdate' ) == '') { ?> 
                      <div class="post-date"> <i class="far fa-clock"></i>  <?php echo esc_html( get_the_date() ); ?></div><!-- post-date --> 
                    <?php } ?> 
                    
                    <?php if( get_theme_mod( 'electro_mart_hide_postcats' ) == '') { ?> 
                      <span class="blogpost_cat"> <i class="far fa-folder-open"></i> <?php the_category( __( ', ', 'electro-mart' ));?></span>
                   <?php } ?>                                                   
                </div><!-- .BlogMeta-Strip -->
            <?php endif; ?>
            <h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>                           
                                
        </header><!-- .entry-header -->          
        <?php if ( is_search() || !is_single() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">           
         <p>
            <?php $electro_mart_arg = get_theme_mod( 'electro_mart_postsfullcontent_options','Excerpt');
              if($electro_mart_arg == 'Content'){ ?>
                <?php the_content(); ?>
              <?php }
              if($electro_mart_arg == 'Excerpt'){ ?>
                <?php if(get_the_excerpt()) { ?>
                  <?php $excerpt = get_the_excerpt(); echo esc_html( electro_mart_string_limit_words( $excerpt, esc_attr(get_theme_mod('electro_mart_postexcerptrange','30')))); ?>
                <?php }?>
                
                 <?php
					$electro_mart_postmorebuttontext = get_theme_mod('electro_mart_postmorebuttontext');
					if( !empty($electro_mart_postmorebuttontext) ){ ?>
					<a class="morebutton" href="<?php the_permalink(); ?>"><?php echo esc_html($electro_mart_postmorebuttontext); ?></a>
                <?php } ?>                
              <?php }?>
           </p>
                    
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'electro-mart' ) ); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'electro-mart' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php endif; ?>
        <div class="clear"></div>
    </div><!-- .ContentStyle-ForSite-->
    </article><!-- #post-## -->
</div>