<?php

	/* White Tower Constants */
	$wtdb_status = array('Active','Inactive','Deceased','Transferred');
	$wtdb_type = array('PC','NSW','TTPC','MPC');
	$wtdb_tower = array('Traditional','Salidar');
	$wtdb_rank = array('Novice','Accepted','Aes Sedai');
	$wtdb_ajah = array('','Blue','Brown','Gray','Green','Red','Yellow','White');
	$wtdb_rptitle = array('','Sitter','Ajah Head','Mistress of Novices','Keeper of the Chronicles','Amrylin Seat');
	$wtdb_talent = array('','Aligning the Matrix','Cloud Dancing','Compulsion','Create Ter\'angreal','Delving(Earth)','Dreaming','Dreamwalking','Earthsinging','Foretelling','Healing(Age of Legends)','Healing(Major)','Know Ter\'angreal','Listening to the Wind','Milking Tears','Reading Auras','Residue Ressurection','See Ta\'veren','Shielding','Sniffing','Uncommon Luck');
	$wtdb_novice = array('','Meet the Roommate','Freeday','Homesickness','Chore RP','Recovery','Prankage!','Create your own','Intro to RP Class','Novice Life');
	$wtdb_accepted = array('','Aes Sedai RP','Turning of the Wheel','Create your own','Transition','Teach a class','Take a class','One Open RP','100 Weave RP','Intro to RP Class');
	$wtdb_warders = array('','Warders','Black Tower');
	$wtdb_brs = array('','Basic Defensive Battle Weaves', 'Basic Defensive Tactics', 'Basic Battle Tactics', 'Basic Battle Weaves', 'Battle Field First Aid');
	$wtdb_brs2 = array('','Advanced Battle Weaves', 'Basic Weapon Handling', 'The Open Road', 'Quid Pro Quo');
	
	/* Adds custom styles to admin panel */
	function wtdb_character_register_head() {
    $siteurl = get_option('siteurl');
    $url = $siteurl . '/wp-content/themes/' . basename(dirname(__FILE__)) . '/admin.css';
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
	}
	add_action('admin_head', 'wtdb_character_register_head');

	add_action('init', 'wtdb_character_register');
	
	/* Creates new Characters with custom post types */
	function wtdb_character_register() {
	
		$labels = array(
   		'name' => _x('Characters', 'post type general name'),
   		'singular_name' => _x('Character', 'post type singular name'),
    	'add_new' => _x('Add New', 'wtdb_character'),
    	'add_new_item' => __('Add New Charaacter'),
    	'edit_item' => __('Edit Character'),
    	'new_item' => __('New Character'),
    	'view_item' => __('View Character'),
    	'search_items' => __('Search Characters'),
    	'not_found' =>  __('No characters found'),
   	 	'not_found_in_trash' => __('No characters found in Trash'), 
   	 	'parent_item_colon' => '',
   	 	'menu_name' => 'Characters',
			'rewrite' => array('slug' => 'character')
  	);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
			'menu_icon' => get_bloginfo('stylesheet_directory').'/flame.png',
			'menu_position' => 5
		);

		register_post_type( 'wtdb_character' , $args );
	}

	add_action("admin_init", "admin_init");
	add_action('save_post', 'save_wtdb_character');

	function admin_init(){
		add_meta_box("wtdb_character_user", "User Information", "wtdb_character_user", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_char", "Character Basic Information", "wtdb_character_char", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_details", "Character Details Information", "wtdb_character_details", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_op", "One Power Information", "wtdb_character_op", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_special", "Special Character Information", "wtdb_character_special", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_novice", "Novice Requirements", "wtdb_character_novice", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_accepted", "Accepted Requirements", "wtdb_character_accepted", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_ws", "Weapon Score Requirements", "wtdb_character_ws", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_alts", "2nd/3rd Character Requirements", "wtdb_character_alts", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_return", "Returning Character Requirements", "wtdb_character_return", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_bonds", "Bonds", "wtdb_character_bonds", "wtdb_character", "normal", "low");
		add_meta_box("wtdb_character_notes", "Administrative Notes", "wtdb_character_notes", "wtdb_character", "normal", "low");
	}

	function wtdb_character_user(){
		global $post;
		$custom = get_post_custom($post->ID);
		$handle = $custom["handle"][0];
		$email = $custom["email"][0];
?>
	<label id="wtdb_character_handle">DM Handle:</label><input name="handle" id="wtdb_character_handle" value="<?php echo $handle; ?>" /><br/>
	<label id="wtdb_character_email">Email Address:</label><input name="email" id="wtdb_character_email" value="<?php echo $email; ?>" />
<?php
	}

	function wtdb_character_char(){
		global $post;
		$custom = get_post_custom($post->ID);
		$bio_link = $custom["bio_link"][0];
		$status = $custom["status"][0];
		$type = $custom["type"][0];
		$tower = $custom["tower"][0];
		$rank = $custom["rank"][0];
		$ajah = $custom["ajah"][0];
		$rp_title = $custom["rp_title"][0];
?>
	<label id="wtdb_character_bio_link">Wiki Bio Link:</label><input name="bio_link" id="wtdb_character_bio_link" value="<?php echo $bio_link; ?>" /><br/>
	<label id="wtdb_character_status">Status:</label><select name="status" id="wtdb_character_status"><?php wtdb_status_dd($status);?></select><br/>
	<label id="wtdb_character_type">Type of Character:</label><select name="type" id="wtdb_character_type"><?php wtdb_type_dd($type);?></select><br/>
	<label id="wtdb_character_tower">Tower Choice:</label><select name="tower" id="wtdb_character_tower"><?php wtdb_tower_dd($tower);?></select><br/>
	<label id="wtdb_character_rank">Rank:</label><select name="rank" id="wtdb_character_rank"><?php wtdb_rank_dd($rank);?></select><br/>
	<label id="wtdb_character_ajah">Ajah:</label><select name="ajah" id="wtdb_character_ajah"><?php wtdb_ajah_dd($ajah);?></select><br/>
	<label id="wtdb_character_rp_title">Character's' Title:</label><select name="rp_title" id="wtdb_character_rp_title"><?php wtdb_rptitle_dd($rp_title);?></select><br/>
<?php
	}
	
	function wtdb_character_details(){
		global $post;
		$custom = get_post_custom($post->ID);
		$df = $custom["df"][0];
		$age = $custom["age"][0];
		$nation = $custom["nation"][0];
		$desc = $custom["desc"][0];
		$hair = $custom["hair"][0];
		$eyes = $custom["eyes"][0];
		$height = $custom["height"][0];
		$skin = $custom["skin"][0];
		$voice = $custom["voice"][0];
		$person = $custom["person"][0];
		$skills = $custom["skills"][0];
		$weakness = $custom["weakness"][0];
?>
	<label id="wtdb_character_df">Is the Character a Darkfriend?</label><?php wtdb_yesno($df,'df');?><br/>
	<label id="wtdb_character_age">Age:</label><input name="age" id="wtdb_character_age" value="<?php echo $age; ?>" /><br/>
	<label id="wtdb_character_nation">Nation of Origin</label><input name="nation" id="wtdb_character_nation" value="<?php echo $nation; ?>" /><br/>
	<label id="wtdb_character_desc">Description:</label><input name="desc" id="wtdb_character_desc" value="<?php echo $desc; ?>" /><br/>
	<label id="wtdb_character_hair">Hair:</label><input name="hair" id="wtdb_character_haire" value="<?php echo $hair; ?>" /><br/>
	<label id="wtdb_character_eyes">Eyes:</label><input name="eyes" id="wtdb_character_eyes" value="<?php echo $eyes; ?>" /><br/>
	<label id="wtdb_character_height">Height:</label><input name="height" id="wtdb_character_height" value="<?php echo $height; ?>" /><br/>
	<label id="wtdb_character_skin">Skin:</label><input name="skin" id="wtdb_character_skine" value="<?php echo $skin; ?>" /><br/>
	<label id="wtdb_character_voice">Voice:</label><input name="voice" id="wtdb_character_voice" value="<?php echo $voice; ?>" /><br/>
	<label id="wtdb_character_person">Personality:</label><input name="person" id="wtdb_character_person" value="<?php echo $person; ?>" /><br/>
	<label id="wtdb_character_skills">Special Skills:</label><input name="skills" id="wtdb_character_skills" value="<?php echo $skills; ?>" /><br/>
	<label id="wtdb_character_weakness">Weaknesses:</label><input name="weakness" id="wtdb_character_weakness" value="<?php echo $weakness; ?>" /><br/>
<?php
	}

	function wtdb_character_op(){
		global $post;
		$custom = get_post_custom($post->ID);
		$str_given = $custom["str_given"][0];
		$str_final = $custom["str_final"][0];
		$skill = $custom["skill"][0];
		$special = $custom["special"][0];
		$fire = $custom["fire"][0];
		$water = $custom["water"][0];
		$air = $custom["air"][0];
		$earth = $custom["earth"][0];
		$spirit = $custom["spirit"][0];
?>
	<label id="wtdb_character_str_given">Strength Given at Creation:</label><input name="str_given" id="wtdb_character_str_given" value="<?php echo $str_given; ?>" /><br/>
	<label id="wtdb_character_str_final">Final Strength:</label><input name="str_final" id="wtdb_character_str_final" value="<?php echo $str_final; ?>" /><br/>
	<label id="wtdb_character_skill">Skill:</label><input name="skill" id="wtdb_character_skill" value="<?php echo $skill; ?>" /><br/>
	<label id="wtdb_character_special">Skill Increase:</label><input name="special" id="wtdb_character_special" value="<?php echo $special; ?>" /><br/>
	<label id="wtdb_character_air">Air:</label><input name="air" id="wtdb_character_air" value="<?php echo $air; ?>" /><br/>	
	<label id="wtdb_character_earth">Earth:</label><input name="earth" id="wtdb_character_earth" value="<?php echo $earth; ?>" /><br/>	
	<label id="wtdb_character_fire">Fire:</label><input name="fire" id="wtdb_character_fire" value="<?php echo $fire; ?>" /><br/>
	<label id="wtdb_character_spirit">Spirit:</label><input name="spirit" id="wtdb_character_spirit" value="<?php echo $spirit; ?>" /><br/>
	<label id="wtdb_character_water">Water:</label><input name="water" id="wtdb_character_water" value="<?php echo $water; ?>" /><br/>	
<?php
	}
	
	function wtdb_character_special(){
		global $post;
		$custom = get_post_custom($post->ID);
		$talent = $custom["talent"][0];
		$ds = $custom["ds"][0];
		$train_ws = $custom["train_ws"][0];
		$ws = $custom["ws"][0];
		$wilder = $custom["wilder"][0];
?>
	<label id="wtdb_character_talent">Talent:</label><select name="talent" id="wtdb_character_talent"><?php wtdb_talent_dd($talent);?></select><br/>
	<label id="wtdb_character_ds">Dream Score:</label><input name="ds" id="wtdb_character_ds" value="<?php echo $ds; ?>" /><br/>
	<label id="wtdb_character_train_ws">Maximum BRS Score Approved by Staff:</label><input name="train_ws" id="wtdb_character_train_ws" value="<?php echo $train_ws; ?>" /><br/>
	<label id="wtdb_character_ws">Current BRS:</label><input name="ws" id="wtdb_character_ws" value="<?php echo $ws; ?>" /><br/>
	<label id="wtdb_character_wilder">Is this Character a Wilder?</label><?php wtdb_yesno($wilder,'wilder');?><br/>
<?php
	}
	
	function wtdb_character_novice(){
		global $post;
		$custom = get_post_custom($post->ID);
		$bio = $custom["bio"][0];
		$op_breakdown = $custom["op_breakdown"][0];
		$nquiz = $custom["nquiz"][0];
		$mon = $custom["mon"][0];
		$oprp = $custom["oprp"][0];
		$nc1 = $custom["nc1"][0];
		$nc1_link = $custom["nc1_link"][0];
		$nc2 = $custom["nc2"][0];
		$nc2_link = $custom["nc2_link"][0];
		$arches = $custom["arches"][0];
?>
	<label id="wtdb_character_bio">Bio Approved & CC'd:</label><?php wtdb_yesno($bio,'bio');?><br/>
	<label id="wtdb_character_op_breakdown">OP Break Down Complete:</label><?php wtdb_yesno($op_breakdown,'op_breakdown');?><br/>
	<label id="wtdb_character_nquiz">Novice Quiz Complete:</label><?php wtdb_yesno($nquiz,'nquiz');?><br/>
	<label id="wtdb_character_mon">Meet the Mistress of Novices:</label><input name="mon" id="wtdb_character_mon" value="<?php echo $mon; ?>" /><br/>
	<label id="wtdb_character_oprp">One Power Related RP:</label><input name="oprp" id="wtdb_character_oprp" value="<?php echo $oprp; ?>" /><br/>
	<label id="wtdb_character_nc1">Choose 1:</label><select name="nc1" id="wtdb_character_nc1"><?php wtdb_novice_dd($nc1);?></select><input name="nc1_link" id="wtdb_character_nc1_link" value="<?php echo $nc1_link; ?>" /><br/>
	<label id="wtdb_character_nc2">Choose 2:</label><select name="nc2" id="wtdb_character_nc2"><?php wtdb_novice_dd($nc2);?></select><input name="nc2_link" id="wtdb_character_nc2_link" value="<?php echo $nc2_link; ?>" /><br/>
	<label id="wtdb_character_arches">Three Arches:</label><input name="arches" id="wtdb_character_arches" value="<?php echo $arches; ?>" /><br/>
<?php
	}
	
	function wtdb_character_accepted(){
		global $post;
		$custom = get_post_custom($post->ID);
		$ac1 = $custom["ac1"][0];
		$ac1_link = $custom["ac1_link"][0];
		$ac2 = $custom["ac2"][0];
		$ac2_link = $custom["ac2_link"][0];
		$ac3 = $custom["ac3"][0];
		$ac3_link = $custom["ac3_link"][0];
		$aquiz = $custom["aquiz"][0];
		$my_ajah = $custom["my_ajah"][0];
		$oaths = $custom["oaths"][0];
?>
	<label id="wtdb_character_ac1">Choose 1:</label><select name="ac1" id="wtdb_character_ac1"><?php wtdb_accepted_dd($ac1);?></select><input name="ac1_link" id="wtdb_character_ac1_link" value="<?php echo $ac1_link; ?>" /><br/>
	<label id="wtdb_character_ac2">Choose 1:</label><select name="ac2" id="wtdb_character_ac2"><?php wtdb_accepted_dd($ac2);?></select><input name="ac2_link" id="wtdb_character_ac2_link" value="<?php echo $ac2_link; ?>" /><br/>
	<label id="wtdb_character_ac3">Choose 1:</label><select name="ac3" id="wtdb_character_ac3"><?php wtdb_accepted_dd($ac3);?></select><input name="ac3_link" id="wtdb_character_ac3_link" value="<?php echo $ac3_link; ?>" /><br/>
	<label id="wtdb_character_aquiz">Accepte Quiz Complete:</label><?php wtdb_yesno($aquiz,'aquiz');?><br/>
	<label id="wtdb_character_my_ajah">Ajah Chosen?</label><?php wtdb_yesno($my_ajah,'my_ajah');?><br/>
	<label id="wtdb_character_oathes">The Three Oaths:</label><input name="oaths" id="wtdb_character_oaths" value="<?php echo $oaths; ?>" /><br/>
<?php
	}
	
	function wtdb_character_ws(){
		global $post;
		$custom = get_post_custom($post->ID);
		$ws1 = $custom["ws1"][0];
		$ws2 = $custom["ws2"][0];
		$ws3 = $custom["ws3"][0];
		$ws4 = $custom["ws4"][0];
		$ws5 = $custom["ws5"][0];
		$ws6 = $custom["ws6"][0];
		$ws7 = $custom["ws7"][0];
		$ws1_link = $custom["ws1_link"][0];
		$ws2_link = $custom["ws2_link"][0];
		$ws3_link = $custom["ws3_link"][0];
		$ws4_link = $custom["ws4_link"][0];
		$ws5_link = $custom["ws5_link"][0];
		$ws6_link = $custom["ws6_link"][0];
		$ws7_link = $custom["ws7_link"][0];

		
?>
	<label id="wtdb_character_ws1">BRS 0 - 1:</label><select name="ws1"><?php wtdb_brs_dd($ws1);?></select><input name="ws1_link" id="wtdb_character_ws1_link" value="<?php echo $ws1_link; ?>" /><br/>
	<label id="wtdb_character_ws2">BRS 1 - 2:</label><select name="ws2"><?php wtdb_brs_dd($ws2);?></select><input name="ws2_link" id="wtdb_character_ws2_link" value="<?php echo $ws2_link; ?>" /><br/>
	<label id="wtdb_character_ws3">BRS 2 - 3:</label><select name="ws3"><?php wtdb_brs_dd($ws3);?></select><input name="ws3_link" id="wtdb_character_ws3_link" value="<?php echo $ws3_link; ?>" /><br/>
	<label id="wtdb_character_ws4">BRS 3 - 4:</label><select name="ws4"><?php wtdb_brs_dd($ws4);?></select><input name="ws4_link" id="wtdb_character_ws4_link" value="<?php echo $ws4_link; ?>" /><br/>
	<label id="wtdb_character_ws5">BRS 4 - 5:</label><select name="ws5"><?php wtdb_brs2_dd($ws5);?></select><input name="ws5_link" id="wtdb_character_ws5_link" value="<?php echo $ws5_link; ?>" /><br/>
	<label id="wtdb_character_ws6">BRS 5 - 6:</label><select name="ws6"><?php wtdb_brs2_dd($ws6);?></select><input name="ws6_link" id="wtdb_character_ws6_link" value="<?php echo $ws6_link; ?>" /><br/>
	<label id="wtdb_character_ws7">BRS 6 - 7:</label><select name="ws7"><?php wtdb_brs2_dd($ws7);?></select><input name="ws7_link" id="wtdb_character_ws7_link" value="<?php echo $ws7_link; ?>" /><br/>
<?php
	}
	
	function wtdb_character_alts(){
		global $post;
		$custom = get_post_custom($post->ID);
		$all_aquiz = $custom["all_aquiz"][0];
		$all_cd = $custom["all_cd"][0];
		$six_arches = $custom["six_arches"][0];
		$six_ac1 = $custom["six_ac1"][0];
		$six_ac1_link = $custom["six_ac1_link"][0];
		$six_ac2 = $custom["six_ac2"][0];
		$six_ac2_link = $custom["six_ac2_link"][0];
		$six_ac3 = $custom["six_ac3"][0];
		$six_ac3_link = $custom["six_ac3_link"][0];
		$six_ajah = $custom["six_ajah"][0];
		$six_oaths = $custom["six_oaths"][0];
?>
	<p>All 2nd and 3rd Characters must complete the following Requirements:</p>
		<label id="wtdb_character_all_aquiz">Accepte Quiz Complete:</label><?php wtdb_yesno($all_aquiz,'all_aquiz');?><br/>
	<label id="wtdb_character_all_cd">Character Development RP:</label><input name="all_cd" id="wtdb_character_all_cd" value="<?php echo $all_cd; ?>" /><br/>
	<p>If a person has not RP'd in the past six months with an Aes Sedai Character, they must complete all of the following requirements in addition to those above.</p>
<label id="wtdb_character_six_ac1">Choose 1:</label><select name="six_ac1" id="wtdb_character_six_ac1"><?php wtdb_accepted_dd($six_ac1);?></select><input name="six_ac1_link" id="wtdb_character_six_ac1_link" value="<?php echo $six_ac1_link; ?>" /><br/>
	<label id="wtdb_character_six_ac2">Choose 1:</label><select name="six_ac2" id="wtdb_character_six_ac2"><?php wtdb_accepted_dd($six_ac2);?></select><input name="six_ac2_link" id="wtdb_character_six_ac2_link" value="<?php echo $six_ac2_link; ?>" /><br/>
	<label id="wtdb_character_six_ac3">Choose 1:</label><select name="six_ac3" id="wtdb_character_six_ac3"><?php wtdb_accepted_dd($six_ac3);?></select><input name="six_ac3_link" id="wtdb_character_six_ac3_link" value="<?php echo $six_ac3_link; ?>" /><br/>
	<label id="wtdb_character_six_ajah">Ajah Chosen?</label><?php wtdb_yesno($six_ajah,'six_ajah');?><br/>
	<label id="wtdb_character_six_oathes">The Three Oaths:</label><input name="six_oaths" id="wtdb_character_six_oaths" value="<?php echo $six_oaths; ?>" /><br/>
<?php
	}
	
	function wtdb_character_return(){
		global $post;
		$custom = get_post_custom($post->ID);
		$update_bio = $custom["update_bio"][0];
		$ret_nquiz = $custom["ret_nquiz"][0];
		$ret_aquiz = $custom["ret_aquiz"][0];
		$ret_cd = $custom["ret_cd"][0];
?>
	<label id="wtdb_character_update_bio">Bio Updated:</label><?php wtdb_yesno($update_bio,'update_bio');?><br/>
	<label id="wtdb_character_ret_nquiz">Novice Quiz:</label><?php wtdb_yesno($ret_nquiz,'ret_nquiz');?><br/>
	<label id="wtdb_character_ret_aquiz">Accepted Quiz:</label><?php wtdb_yesno($ret_aquiz,'ret_aquiz');?><br/>
	<label id="wtdb_character_ret_cd">Character Dev RP - Bridging the Gap</label><input name="ret_cd" id="wtdb_character_ret_cd" value="<?php echo $ret_cd; ?>" /><br/>
<?php
	}
	
	function wtdb_character_bonds(){
		global $post;
		$custom = get_post_custom($post->ID);
		$name1 = $custom["name1"][0];
		$name2 = $custom["name2"][0];
		$name3 = $custom["name3"][0];
		$name4 = $custom["name4"][0];
		$div1 = $custom["div1"][0];
		$div2 = $custom["div2"][0];
		$div3 = $custom["div3"][0];
		$handle1 = $custom["handle1"][0];
		$handle2 = $custom["handle2"][0];
		$handle3 = $custom["handle3"][0];
		$handle4 = $custom["handle4"][0];
		
		
?>
	<label id="wtdb_character_name1">Warder 1:</label><input name="name1" id="wtdb_character_name1" value="<?php echo $name1; ?>" /> <label>of the</label> <select name="div1" id="wtdb_character_div1"><?php wtdb_warders_dd($div1);?></select> <label id="wtdb_character_handle1">played by</label> <input name="handle1" id="wtdb_character_handle1" value="<?php echo $handle1; ?>" /><br/>
	<label id="wtdb_character_name2">Warder 2:</label><input name="name2" id="wtdb_character_name2" value="<?php echo $name2; ?>" /> <label>of the</label> <select name="div2" id="wtdb_character_div2"><?php wtdb_warders_dd($div2);?></select> <label id="wtdb_character_handle2">played by</label> <input name="handle2" id="wtdb_character_handle2" value="<?php echo $handle2; ?>" /><br/>
	<label id="wtdb_character_name3">Warder 3:</label><input name="name3" id="wtdb_character_name3" value="<?php echo $name3; ?>" /> <label>of the</label> <select name="div3" id="wtdb_character_div3"><?php wtdb_warders_dd($div3);?></select> <label id="wtdb_character_handle3">played by</label> <input name="handle3" id="wtdb_character_handle3" value="<?php echo $handle3; ?>" /><br/>
	<label id="wtdb_character_name4">Bonded by:</label><input name="name4" id="wtdb_character_name4" value="<?php echo $name4; ?>" /> <label id="wtdb_character_handle4">played by</label> <input name="handle4" id="wtdb_character_handle4" value="<?php echo $handle4; ?>" /><br/>
<?php
	}
	
	function wtdb_character_notes(){
		global $post;
		$custom = get_post_custom($post->ID);
		$notes = $custom["notes"][0];
?>
	<textarea name="notes" id="wtdb_character_notes" value="<?php echo notes; ?>"></textarea>
<?php
	}	

	function save_wtdb_character(){
		global $post;
		update_post_meta($post->ID, "handle", $_POST["handle"]);
		update_post_meta($post->ID, "email", $_POST["email"]);
		update_post_meta($post->ID, "bio_link", $_POST["bio_link"]);
		update_post_meta($post->ID, "status", $_POST["status"]);
		update_post_meta($post->ID, "type", $_POST["type"]);
		update_post_meta($post->ID, "tower", $_POST["tower"]);
		update_post_meta($post->ID, "rank", $_POST["rank"]);
		update_post_meta($post->ID, "ajah", $_POST["ajah"]);
		update_post_meta($post->ID, "rp_title", $_POST["rp_title"]);
		update_post_meta($post->ID, "df", $_POST["df"]);
		update_post_meta($post->ID, "age", $_POST["age"]);
		update_post_meta($post->ID, "nation", $_POST["nation"]);
		update_post_meta($post->ID, "tower", $_POST["tower"]);
		update_post_meta($post->ID, "desc", $_POST["desc"]);
		update_post_meta($post->ID, "hair", $_POST["hair"]);
		update_post_meta($post->ID, "eyes", $_POST["eyes"]);
		update_post_meta($post->ID, "height", $_POST["height"]);
		update_post_meta($post->ID, "skin", $_POST["skin"]);
		update_post_meta($post->ID, "voice", $_POST["voice"]);
		update_post_meta($post->ID, "person", $_POST["person"]);
		update_post_meta($post->ID, "skills", $_POST["skills"]);
		update_post_meta($post->ID, "weakness", $_POST["weakness"]);
		update_post_meta($post->ID, "str_given", $_POST["str_given"]);
		update_post_meta($post->ID, "str_final", $_POST["str_final"]);
		update_post_meta($post->ID, "skill", $_POST["skill"]);
		update_post_meta($post->ID, "special", $_POST["special"]);
		update_post_meta($post->ID, "fire", $_POST["fire"]);
		update_post_meta($post->ID, "water", $_POST["water"]);
		update_post_meta($post->ID, "air", $_POST["air"]);
		update_post_meta($post->ID, "earth", $_POST["earth"]);
		update_post_meta($post->ID, "spirit", $_POST["spirit"]);
		update_post_meta($post->ID, "talent", $_POST["talent"]);
		update_post_meta($post->ID, "ds", $_POST["ds"]);
		update_post_meta($post->ID, "train_ws", $_POST["train_ws"]);
		update_post_meta($post->ID, "ws", $_POST["ws"]);
		update_post_meta($post->ID, "wilder", $_POST["wilder"]);
		update_post_meta($post->ID, "bio", $_POST["bio"]);
		update_post_meta($post->ID, "op_breakdown", $_POST["op_breakdown"]);
		update_post_meta($post->ID, "nquiz", $_POST["nquiz"]);
		update_post_meta($post->ID, "mon", $_POST["mon"]);
		update_post_meta($post->ID, "oprp", $_POST["oprp"]);
		update_post_meta($post->ID, "nc1", $_POST["nc1"]);
		update_post_meta($post->ID, "nc1_link", $_POST["nc1_link"]);
		update_post_meta($post->ID, "nc2", $_POST["nc2"]);
		update_post_meta($post->ID, "nc2_link", $_POST["nc2_link"]);
		update_post_meta($post->ID, "arches", $_POST["arches"]);
		update_post_meta($post->ID, "ac1", $_POST["ac1"]);
		update_post_meta($post->ID, "ac1_link", $_POST["ac1_link"]);
		update_post_meta($post->ID, "ac2", $_POST["ac2"]);
		update_post_meta($post->ID, "ac2_link", $_POST["ac2_link"]);
		update_post_meta($post->ID, "ac3", $_POST["ac3"]);
		update_post_meta($post->ID, "ac3_link", $_POST["ac3_link"]);
		update_post_meta($post->ID, "my_ajah", $_POST["my_ajah"]);
		update_post_meta($post->ID, "aquiz", $_POST["aquiz"]);
		update_post_meta($post->ID, "oaths", $_POST["oaths"]);
		update_post_meta($post->ID, "six_arches", $_POST["six_arches"]);
		update_post_meta($post->ID, "six_ac1", $_POST["six_ac1"]);
		update_post_meta($post->ID, "six_ac1_link", $_POST["six_ac1_link"]);
		update_post_meta($post->ID, "six_ac2", $_POST["six_ac2"]);
		update_post_meta($post->ID, "six_ac2_link", $_POST["six_ac2_link"]);
		update_post_meta($post->ID, "six_ac3", $_POST["six_ac3"]);
		update_post_meta($post->ID, "six_ac3_link", $_POST["six_ac3_link"]);
		update_post_meta($post->ID, "all_aquiz", $_POST["all_aquiz"]);
		update_post_meta($post->ID, "all_cd", $_POST["all_cd"]);
		update_post_meta($post->ID, "six_oaths", $_POST["six_oaths"]);
		update_post_meta($post->ID, "six_ajah", $_POST["six_ajah"]);
		update_post_meta($post->ID, "notes", $_POST["notes"]);
		update_post_meta($post->ID, "name1", $_POST["name1"]);
		update_post_meta($post->ID, "name2", $_POST["name2"]);
		update_post_meta($post->ID, "name3", $_POST["name3"]);
		update_post_meta($post->ID, "name4", $_POST["name4"]);
		update_post_meta($post->ID, "div1", $_POST["div1"]);
		update_post_meta($post->ID, "div2", $_POST["div2"]);
		update_post_meta($post->ID, "div3", $_POST["div3"]);
		update_post_meta($post->ID, "handle1", $_POST["handle1"]);
		update_post_meta($post->ID, "handle2", $_POST["handle2"]);
		update_post_meta($post->ID, "handle3", $_POST["handle3"]);
		update_post_meta($post->ID, "handle4", $_POST["handle4"]);
		update_post_meta($post->ID, "update_bio", $_POST["update_bio"]);
		update_post_meta($post->ID, "ret_nquiz", $_POST["ret_nquiz"]);
		update_post_meta($post->ID, "ret_aquiz", $_POST["ret_aquiz"]);
		update_post_meta($post->ID, "ret_cd", $_POST["ret_cd"]);
		update_post_meta($post->ID, "ws1", $_POST["ws1"]);
		update_post_meta($post->ID, "ws2", $_POST["ws2"]);
		update_post_meta($post->ID, "ws3", $_POST["ws3"]);
		update_post_meta($post->ID, "ws4", $_POST["ws4"]);
		update_post_meta($post->ID, "ws5", $_POST["ws5"]);
		update_post_meta($post->ID, "ws6", $_POST["ws6"]);
		update_post_meta($post->ID, "ws7", $_POST["ws7"]);
		update_post_meta($post->ID, "ws1_link", $_POST["ws1_link"]);
		update_post_meta($post->ID, "ws2_link", $_POST["ws2_link"]);
		update_post_meta($post->ID, "ws3_link", $_POST["ws3_link"]);
		update_post_meta($post->ID, "ws4_link", $_POST["ws4_link"]);
		update_post_meta($post->ID, "ws5_link", $_POST["ws5_link"]);
		update_post_meta($post->ID, "ws6_link", $_POST["ws6_link"]);
		update_post_meta($post->ID, "ws7_link", $_POST["ws7_link"]);
	}

	add_filter("manage_edit-wtdb_character_columns", "wtdb_character_edit_columns");
	add_action("manage_posts_custom_column",  "wtdb_character_custom_columns");

	function wtdb_character_edit_columns($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Character",
			"status" => "Status",
			"rank" => "Rank",
			"rp_title" => "Title"
		);

		return $columns;
	}

	function wtdb_character_custom_columns($column){
		global $post;
		global $wtdb_status, $wtdb_rptitle, $wtdb_rank;
		
		$custom = get_post_custom();

		switch ($column)
		{
			case "status":
				echo $wtdb_status[$custom["status"][0]];
				break;
			case "rank":
				echo wtdb_rank_output();
				break;	
			case "title":
				echo $wtdb_title[$custom["status"][0]];
				break;	
		}
	}

/* Drop Down and Radio Areas for Admin Section */

	function wtdb_status_dd($status) {
		global $wtdb_status;
		for($i = 0; $i < count($wtdb_status); $i++) {
			if($i == $status)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_status[$i]."</option>\n";
		}
	}
	
	function wtdb_type_dd($type) {
		global $wtdb_type;
		for($i = 0; $i < count($wtdb_type); $i++) {
			if($i == $type)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_type[$i]."</option>\n";
		}
	}	
	
	function wtdb_tower_dd($rank) {
		global $wtdb_tower;
		for($i = 0; $i < count($wtdb_tower); $i++) {
			if($i == $tower)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_tower[$i]."</option>\n";
		}
	}	
	
	function wtdb_rank_dd($rank) {
		global $wtdb_rank;
		for($i = 0; $i < count($wtdb_rank); $i++) {
			if($i == $rank)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_rank[$i]."</option>\n";
		}
	}	
	
	function wtdb_ajah_dd($ajah) {
		global $wtdb_ajah;
		for($i = 0; $i < count($wtdb_ajah); $i++) {
			if($i == $ajah)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_ajah[$i]."</option>\n";
		}
	}	
	
	function wtdb_rptitle_dd($rptitle) {
		global $wtdb_rptitle;
		for($i = 0; $i < count($wtdb_rptitle); $i++) {
			if($i == $rptitle)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_rptitle[$i]."</option>\n";
		}
	}	
	
	function wtdb_talent_dd($talent) {
		global $wtdb_talent;
		for($i = 0; $i < count($wtdb_talent); $i++) {
			if($i == $talent)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_talent[$i]."</option>\n";
		}
	}	
	
	function wtdb_novice_dd($novice) {
		global $wtdb_novice;
		for($i = 0; $i < count($wtdb_novice); $i++) {
			if($i == $novice)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_novice[$i]."</option>\n";
		}
	}
	
	function wtdb_accepted_dd($accepted) {
		global $wtdb_accepted;
		for($i = 0; $i < count($wtdb_accepted); $i++) {
			if($i == $accepted)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_accepted[$i]."</option>\n";
		}
	}
	
	function wtdb_warders_dd($div) {
		global $wtdb_warders;
		for($i = 0; $i < count($wtdb_warders); $i++) {
			if($i == $div)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_warders[$i]."</option>\n";
		}
	}
	
	function wtdb_yesno($ans,$name){
		if($ans == 'No')
			$no = "checked=\"checked\"";
		else if($ans == 'Yes')
			$yes = "checked=\"checked\"";
		echo "<input type=\"radio\" name=\"$name\" value=\"No\" $no id=\"".$ans."_no\"/><label for=\"".$ans."_no\" class=\"short_label\">No</label><input type=\"radio\" name=\"$name\" value=\"Yes\" $yes id=\"".$ans."_yes\"/><label for=\"".$ans."_yes\" class=\"short_label\">Yes</label>";
	}
	
	function wtdb_brs_dd($brs) {
		global $wtdb_brs;
		for($i = 0; $i < count($wtdb_brs); $i++) {
			if($i == $brs)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_brs[$i]."</option>\n";
		}
	}
	
	function wtdb_brs2_dd($brs) {
		global $wtdb_brs2;
		for($i = 0; $i < count($wtdb_brs2); $i++) {
			if($i == $brs)
				$checked = ' selected="selected"';
			else	
				$checked = '';
			echo "<option value=\"$i\"$checked>".$wtdb_brs2[$i]."</option>\n";
		}
	}
	
	
	/* Template Tags for the White Tower Database */
	
	function wtdb_rank_output()	{
		global $post, $wtdb_rank, $wtdb_ajah,$wtdb_rptitle;
		$custom = get_post_custom();
		
		if($custom['rank'][0] == 0)
			$rank = $wtdb_rank[$custom['rank'][0]];
		else if ($custom['rank'][0] == 1) {
			if($custom['ajah'][0] != 0)
				$rank = $wtdb_rank[$custom['rank'][0]]." aspiring to the ".$wtdb_ajah[$custom['ajah'][0]]." Ajah";
			else
				$rank = $wtdb_rank[$custom['rank'][0]];
		}		
		else {
			if($custom['rp_title'][0] == 0 )	
				$rank = $wtdb_rank[$custom['rank'][0]]." of the ".$wtdb_ajah[$custom['ajah'][0]]." Ajah";
			else if($custom['rp_title'][0] == 1 || $custom['rp_title'][0] == 2)	
				$rank = $wtdb_rptitle[$custom['rp_title'][0]]." of the ".$wtdb_ajah[$custom['ajah'][0]]." Ajah";
			else if($custom['rp_title'][0] == 3 || $custom['rp_title'][0] == 4)	
				$rank = $wtdb_rank[$custom['rp_title'][0]]."<br/>".$wtdb_rank[$custom['rank'][0]]." of the ".$wtdb_ajah[$custom['ajah'][0]]." Ajah";
			else
				$rank = $wtdb_rank[$custom['rp_title'][0]]."<br/>Raised to the ".$wtdb_ajah[$custom['ajah'][0]]." Ajah";	
		}
		
		echo $rank;
	}
	
	