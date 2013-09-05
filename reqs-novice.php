<?php
/*
	Template Name: Novice Requirements Table
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
					
<?php 
	rewind_posts();
	$loop = new WP_Query(array('post_type' => 'wtdb_character', 'nopaging' => true, 'orderby' => 'title', 'order' => 'ASC'));
	
	$novice_output = "";
	$accepted_output = "";
	$alt_output = "";
	$ret_output = "";
	$ws_output = "";
	
	while ( $loop->have_posts() ) {
		$loop->the_post();
		
		$custom = get_post_custom();
		
		if($custom['rank'][0] == 0) {
			$novice_output .= "<tr>";
			$novice_output .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td>";
			if($custom['bio'][0] == 'Yes') 
				$novice_output .= "<td>Yes</td>";
			else 
				$novice_output .= "<td>No</td>";	
			if($custom['nquiz'][0] == 'Yes') 
				$novice_output .= "<td>Yes</td>";
			else 
				$novice_output .= "<td>No</td>";
			if($custom['op_breakdown'][0] == 'Yes') 
				$novice_output .= "<td>Yes</td>";
			else 
				$novice_output .= "<td>No</td>";	
			if($custom['mon'][0]) 
				$novice_output .= "<td><a href=\"".$custom['mon'][0]."\">Yes</a></td>";
			else 
				$novice_output .= "<td>No</td>";	
			if($custom['oprp'][0]) 
				$novice_output .= "<td><a href=\"".$custom['oprp'][0]."\">Yes</a></td>";
			else 
				$novice_output .= "<td>No</td>";		
			if($custom['nc1'][0]) 
				$novice_output .= "<td><a href=\"".$custom['nc1_link'][0]."\">Yes</a></td>";
			else 
				$novice_output .= "<td>No</td>";	
			if($custom['arches'][0]) 
				$novice_output .= "<td><a href=\"".$custom['arches'][0]."\">Yes</a></td>";
			else 
				$novice_output .= "<td>No</td>";	
			$novice_output .= "</tr>";	
		}
		
		}
	?>
	<h2>Novice Table</h3>
	<table class="wtdb_table">
		<thead>
			<tr>
				<th>Name</th>
				<th>BIO</th>
				<th>QUZ</th>
				<th>OPBD</th>
				<th>MON</th>
				<th>OPRP</th>
				<th>NC1</th>
				<th>ARCH</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $novice_output;?>
		</tbody>
	</table>

</div>
<?php } ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>