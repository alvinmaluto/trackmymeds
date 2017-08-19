<?php get_header(); ?>

<div id="main">
    <article id="main-content">
        
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
            <h2><?php the_title(); ?></h2>
            
            <?php the_content(); ?>
        
                        
        <?php endwhile; else : ?>
	<p><?php _e( 'Sorry, an error occurred' ); ?></p>
        <?php endif; ?>
        
    </article>

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>