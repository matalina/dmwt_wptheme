<?php
/*
	Template Name: Aes Sedai Age Listing
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
	}	
	$loop = new WP_Query(array('post_type' => 'wtdb_character', 'nopaging' => true, 'orderby' => 'title', 'order' => 'ASC'));
	
			
	$output250 = '';
	$output230 = '';
	$output210 = '';
	$output190 = '';
	$output170 = '';
	$output150 = '';
	$output130 = '';
	$output110 = '';
	$output90 = '';
	$outputUnder = '';
	$outputSalidar = '';
	
	while ( $loop->have_posts() ) {
		$loop->the_post();
		
		$custom = get_post_custom();
		$status = $wtdb_status[$custom['status'][0]];
		$age = $custom['age'][0];
		$rank = $custom['rank'][0];
		$tower = $custom['tower'][0];
		$title = $wtdb_title[$custom['title'][0]];
		
		if((int)$age >= 250) {
			$output250 .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";
		}
		else if((int)$age >= 230) {
			$output230 .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";
		}
		else if((int)$age >= 210) {
			$output210 .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";
		}
		else if((int)$age >= 190) {
			$output190 .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";
		}
		else if((int)$age >= 170) {
			$output170 .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";	
		}
		else if((int)$age >= 150) {
			$output150 .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";
		}
		else if((int)$age >= 130) {
			$output130 .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";
		}
		else if((int)$age >= 110) {
			$output110 .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";
		}
		else if((int)$age >= 90) {
			$output90 .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";
		}
		else if((int)$age < 90 && $rank == 2 && $tower != 1) {
			$outputUnder .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";
		}
		else if($rank == 2 && $tower == 1) {
			$outputSalidar .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td><td>$age</td><td>".$title."</td><td>$status</td></tr>\n";
		}
		
		
	}
	?>
<table class="no_wtdb_table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Age</th>
			<th>Title</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>	
		<tr><th colspan="4">Legendary - 250+</th></tr>
		<?php echo $output250; ?>
		<tr><th colspan="4">Mythical - 230 to 249</th></tr>
		<?php echo $output230;?>
		<tr><th colspan="4">Ancient - 210 to 229</th></tr>
		<?php echo $output210;?>
		<tr><th colspan="4">Elder - 190 to 209</th></tr>
		<?php echo $output190;?>
		<tr><th colspan="4">Venerable - 170 to 189</th></tr>
		<?php echo $output170;?>
		<tr><th colspan="4">Veteran - 150 to 169</th></tr>
		<?php echo $output150;?>
		<tr><th colspan="4">Mature - 130 to 149</th></tr>
		<?php echo $output130;?>
		<tr><th colspan="4">Experienced - 110 to 129</th></tr>
		<?php echo $output110;?>
		<tr><th colspan="4">Tested - 90 to 109</th></tr>
		<?php echo $output90;?>
		<tr><th colspan="4">Young - 89 and Under</th></tr>
		<?php echo $outputUnder;?>
		<tr><th colspan="4">Salidar - 77 and Under in Salidar</th></tr>
		<?php echo $outputSalidar;?>
	</tbody>	
</table>	
</div>
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_footer(); ?>