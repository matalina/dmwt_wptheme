<?php
/*
	Template Name: OP Table
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
			<th class="wtdb_name">Name</th>
			<th>Air</th>
			<th>Earth</th>
			<th>Fire</th>
			<th>Spirit</th>
			<th>Water</th>
			<th>Strength</th>
			<th>Skill</th>			
			<th>Potency</th>
		</tr>
	</thead>
	<tbody>
<?php 
	rewind_posts();
	$loop = new WP_Query(array('post_type' => 'wtdb_character', 'nopaging' => true, 'orderby' => 'title', 'order' => 'ASC')); 
	while ( $loop->have_posts() ) {
		$loop->the_post();
		
		$custom = get_post_custom();
		$potency = (int)$custom['str_final'][0] + (int)$custom['skill'][0];
		
		echo "<tr><td class=\"wtdb_name\"><a href=\"";
		the_permalink();
		echo "\">";
		the_title();
		echo "</a></td><td>".$custom['air'][0]."</td><td>".$custom['earth'][0]."</td><td>".$custom['fire'][0]."</td><td>".$custom['spirit'][0]."</td><td>".$custom['water'][0]."</td>";
		echo "<td>".$custom['str_final'][0];
		if($custom['str_given'][0] > 0 && $custom['str_given'][0] != $custom['str_final'][0])
			echo "(".$custom['str_given'][0].")";		
		echo "</td>";	
		echo "<td>".$custom['skill'][0];
		if($custom['special'][0] > 0)
			echo "+".$custom['special'][0];
				else
			echo "</td>";		
		echo "<td>".$potency."</td></tr>\n";
		
		}
	?>
	</tbody>
</table>	
</div>
<?php } ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>