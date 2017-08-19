<?php get_header(); ?>

<div id="main">
    <article id="main-content">
        
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
            <h2>
                <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
                </a>
            </h2>
            
            <?php the_content(); ?>
            
            <!--<?php the_excerpt(); ?> -->
            
            <a href="<?php the_permalink(); ?>">
                Read more...
            </a>
                
            <p>Posted on <?php the_date(); ?> by <?php the_author(); ?></p>
            <p><?php the_category(); ?></p>
            <p><?php the_tags(); ?></p>
            
        <?php endwhile; else : ?>
	<p><?php _e( 'Sorry, it broke' ); ?></p>
        <?php endif; ?>
        
	
	<?php previous_posts_link("Newer stuff"); ?>
	<?php next_posts_link("Older stuff"); ?>
    
	<p>
	    <?php the_posts_pagination()?>
	</p>
    </article>

    
    
<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>