<?php get_header(); ?>

lalalalala
<?php 
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); 
			//
			// Post Content here
			//
			echo "<a href=".get_permalink().">".get_the_title()."</a>";
			echo get_the_content();
		} // end while
	} // end if
?>

<?php get_footer(); ?>