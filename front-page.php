<?php get_header(); ?>

<div id="main">

    <article id="main-content">


	<div id="mywork">
	    <h2>My Work</h2>

	    <!--use a custom wordpress loop to fetch content
		other than the content automatically assigned to
		this template -->

	    <?php query_posts( array (
	    'category_name'          => 'mywork', //write which category to get
	    'posts_per_page'         => '16' //how many posts to get
	    )); ?>

	    <?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>

	    <?php endwhile; wp_reset_query(); ?>
	</div>

	<hr>
      <h2>Instagram</h2>

      <?php query_posts( array (
      'category_name'          => 'instagram-feed', //write which category to get
      'posts_per_page'         => '1' //how many posts to get
      )); ?>

      <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>

      <?php endwhile; wp_reset_query(); ?>

    </article>

</div>

<?php get_footer(); ?>
