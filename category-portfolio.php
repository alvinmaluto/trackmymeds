<?php get_header(); ?>

<div id="main">
    <article id="main-content">
        
        <h1>My Portfolio</h1>
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
            
            <a href="<?php the_permalink(); ?>">
             <?php the_post_thumbnail('thumbnail'); ?>
             <h2><?php the_title(); ?></h2>
             
             <?php the_excerpt(); ?>
             
            </a>
           
        <?php endwhile; else : ?>
	<p><?php _e( 'Sorry, an error occurred' ); ?></p>
        <?php endif; ?>
        
    </article>

</div>

<?php get_footer(); ?>