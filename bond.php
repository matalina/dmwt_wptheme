<?php
/*
	Template Name: Bonds
*/
?>
<?php get_header(); ?>

		<div id="container" class="one-column">
			<div id="content" role="main">

<?php if ( have_posts() ) { the_post() ?>
							
				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-above -->

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php //twentyten_posted_on(); ?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
					
<table class="wtdb_table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Bonds</th>
		</tr>
	</thead>
	<tbody>
<?php 
	rewind_posts();
	$loop = new WP_Query(array('post_type' => 'wtdb_character', 'nopaging' => true, 'orderby' => 'title', 'order' => 'ASC'));
	while ( $loop->have_posts() ) {
		$loop->the_post();
		
		$custom = get_post_custom();
		
		if($custom['name1'][0] || $custom['name2'][0] || $custom['name3'][0] || $custom['name4'][0]) {
			
		
			echo "<tr><td class=\"wtdb_name\"><a href=\"";
			the_permalink();
			echo "\">";
			the_title();
			echo "</a></td><td>";
			if($custom['name1'][0]) {
				echo "Bonded to ".$custom['name1'][0]." of the ".$wtdb_warders[$custom['div1'][0]]." played by ".$custom['handle1'][0]."<br/>\n";
			}
			if($custom['name2'][0]) {
				echo "Bonded to ".$custom['name2'][0]." of the ".$wtdb_warders[$custom['div2'][0]]." played by ".$custom['handle2'][0]."<br/>\n";
			}
			if($custom['name3'][0]) {
				echo "Bonded to ".$custom['name3'][0]." of the ".$wtdb_warders[$custom['div3'][0]]." played by ".$custom['handle3'][0]."<br/>\n";
			}
			if($custom['name4'][0]) {
				echo "Bonded by ".$custom['name4'][0]." played by ".$custom['handle4'][0]."<br/>\n";
			}
			echo "</td></tr>\n";	
		}
	}	
	?>
	</tbody>
</table>	
</div>
<?php } ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>