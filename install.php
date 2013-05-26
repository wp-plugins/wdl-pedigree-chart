<?php ob_start();?>

<?php 

/*

Plugin Name: WDL Family History and Genealogy Pedigree Chart
Plugin URI: http://lyons-barton.com/wdl-pedigree-chart
Description: Adds a 3 Generation pedigree chart to your page
Version: 1.3.2
Author: Warwick Lyons
Author URI: http://lyons-barton.com
License: GPL2
*/










// CREATE THE SHORTCODES USED IN THIS PLUGIN










// Create Menu shortcode



function add_a_menu( $atts ) {
	extract( shortcode_atts( array(
		'famid' => '',

	), $atts ) );
ob_start();
	
?>
    

	<!-- The Page headings  -->

	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">
         
	<br />
	<br />

<?php

	// Obtain the information for the list

	include ('tablename.php');

	$result_menu= $wpdb->get_results( "SELECT first_name, family_name, family_name, date_of_birth, date_of_death, post_id  FROM $table_name WHERE family_id = '$famid' ORDER BY family_name" );

?>

	<!-- Create the table to display the list  -->

	<table class="menu_table">

	<th class="menu_heading">ID</th>

	<th class="menu_heading">First Name</th>

	<th class="menu_heading">Family Name</th>

	<th class="menu_heading">Date Of Birth</th>

	<th class="menu_heading">Date Of Death</th>

	<th class="menu_heading">View Page</th>

	<tr>

<?php

	// Loop through the results to display the obtained information
	
	foreach ($result_menu as $result_menu){ 
	
?>

	<tr class="menu_list">

	<td ><?php echo htmlspecialchars($result_menu->id);?></td>
	
    <td ><?php echo htmlspecialchars($result_menu->first_name);?></td>
	
    <td><?php echo htmlspecialchars($result_menu->family_name);?></td>
	
    <td><?php echo htmlspecialchars($result_menu->date_of_birth);?></td>

	<td><?php echo htmlspecialchars($result_menu->date_of_death);?></td>

	<td><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($result_menu->post_id) ?>" target="blank">View Post</a></td>

	</tr>
    
<?php 

}

?>

	</tr>
	
    </table>

<?php

	$output = ob_get_clean();

	return $output;
}

add_shortcode( 'addmenu', 'add_a_menu' );











// --------------------------------------------------------------------------------------------------------- //











// Create Sibling shortcode



function add_a_sibling( $atts ) {
	extract( shortcode_atts( array(
		'id' => '',

	), $atts ) );
ob_start();
	
	
?>
    

	<!-- The Page headings  -->

 	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">
         
	<br />
	<br />

<?php

	// Obtain the information for the list

	include ('tablename.php');

	$result = $wpdb->get_results( "SELECT father_id, mother_id  FROM $table_name WHERE id = '$id' ORDER BY date_of_birth" );
	$father_id = $wpdb->get_var( "SELECT father_id FROM $table_name WHERE id = '$id'" );
	$mother_id = $wpdb->get_var( "SELECT mother_id FROM $table_name WHERE id = '$id'" );
	
	// Create $sibling depend on which parent or parents are present in the database
	
	if ($father_id == 0) {
		
		$sibling = $wpdb->get_results( "SELECT first_name, family_name, post_id FROM $table_name WHERE (mother_id = '$mother_id') AND id <> '$id'" );
		
	} else if ($mother_id == 0){
			$sibling = $wpdb->get_results( "SELECT first_name, family_name, post_id FROM $table_name WHERE (father_id = '$father_id') AND id <> '$id'" );
			
	} else {
		
	$sibling = $wpdb->get_results( "SELECT first_name, family_name, post_id FROM $table_name WHERE (mother_id = '$mother_id' OR father_id = '$father_id') AND id <> '$id'" );
	
	}


?>	

<div id = "shortcode_outer">
<div id = "shortcode_inner">

	<!-- Create the table to display the list  -->
	<span class="table_heading">Siblings</span>

	<table class="menu_table">

	<th class="menu_heading">First Name</th>
    
	<th class="menu_heading">Family Name</th>

	<th class="menu_heading">View Page</th>

	<tr>
    
<?php

	// Loop through the results to display the obtained information

	foreach ($sibling as $sibling){
	$sibling_id = $sibling->id;	

?>

	<tr class="menu_list">

	<td ><?php echo htmlspecialchars($sibling->first_name);?></td>
	
    <td><?php echo htmlspecialchars($sibling->family_name);?></td>

	<td><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($sibling->post_id) ?>" target="blank">View Post</a></td>

	</tr>
    
<?php 

} 
?>

	</tr>
	
    </table>
    
</div>
</div>

<?php
	
	$output = ob_get_clean();
	return $output;
}


add_shortcode( 'siblings', 'add_a_sibling' );











// --------------------------------------------------------------------------------------------------------- //











// Create Children shortcode


function add_children( $atts ) {
	extract( shortcode_atts( array(
		'father_id' => '',
		'mother_id' => '',

	), $atts ) );
ob_start();
	?>
    

	<!-- The Page headings  -->

	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">
         
	<br />
	<br />

<?php

	// Obtain the information for the list

	include ('tablename.php');
	
	if ($father_id == "0")
	{
			$result = $wpdb->get_results( "SELECT first_name, family_name, post_id FROM $table_name WHERE mother_id = '$mother_id' ORDER BY date_of_birth" );
	} else if ($mother_id == "0") {
		$result = $wpdb->get_results( "SELECT first_name, family_name, post_id FROM $table_name WHERE father_id = '$father_id' ORDER BY date_of_birth" );
	} else {	

	$result = $wpdb->get_results( "SELECT first_name, family_name, post_id FROM $table_name WHERE father_id = '$father_id' AND mother_id = '$mother_id' ORDER BY date_of_birth" );
	}

?>

	<!-- Create the table to display the list  -->
	<span class="table_heading">Children</span>

	<table class="menu_table">

	<th class="menu_heading">First Name</th>
	
    <th class="menu_heading">Family Name</th>

	<th class="menu_heading">View Page</th>

	<tr>
    
<?php
	
	// Loop through the results to display the obtained information

	foreach ($result as $result){
	$sibling_id = $sibling->id;	

?>

	<tr class="menu_list">

	<td ><?php echo htmlspecialchars($result->first_name);?></td>

	<td><?php echo htmlspecialchars($result->family_name);?></td>

	<td><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($result->post_id) ?>" target="blank">View Post</a></td>

	</tr>
    
<?php
 
} 

?>

	</tr>

	</table>

<?php
	
	$output = ob_get_clean();
	return $output;
	
}

add_shortcode( 'children', 'add_children' );











// --------------------------------------------------------------------------------------------------------- //











// Create Spouse shortcode


function add_a_spouse( $atts ) {
	extract( shortcode_atts( array(
		'id' => '',

	), $atts ) );
ob_start();
	?>
    

	<!-- The Page headings  -->

 	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">

	<br />
	<br />

<?php

	// Obtain the information for the list

	include ('tablename.php');

	foreach( $wpdb->get_results("SELECT * FROM $table_name2 WHERE person_id = $id OR spouse_id = $id ") as $key => $row) {

// each column in your row will be accessible like this

	$spouse_id = $row->spouse_id;
	$person_id = $row->person_id;

}


	if ($id == $spouse_id){

	$result = $wpdb->get_results( "SELECT $table_name.first_name, $table_name.family_name, $table_name.post_id,  $table_name2.date_of_marriage, $table_name2.person_id, $table_name2.spouse_id  FROM $table_name JOIN $table_name2 ON $table_name.id=$table_name2.person_id WHERE ($table_name2.spouse_id = $id)" );
	} else {

	$result = $wpdb->get_results( "SELECT $table_name.first_name, $table_name.family_name, $table_name.post_id,  $table_name2.date_of_marriage, $table_name2.person_id, $table_name2.spouse_id FROM $table_name JOIN $table_name2 ON $table_name.id=$table_name2.spouse_id WHERE $table_name2.person_id = $id" );
}

?>


	<!-- Create the table to display the list  -->
	<span class="table_heading">Spouse</span>
	
    <table class="menu_table">

	<th class="menu_heading">First Name</th>
    
	<th class="menu_heading">Family Name</th>
    
	<th class="menu_heading">Date of  Marriage</th>

	<th class="menu_heading">Post ID</th>

	<tr>
    
<?php

	// Loop through the results to display the obtained information

	foreach ($result as $result){

?>

	<tr class="menu_list">


	<td ><?php echo htmlspecialchars($result->first_name);?></td>
	
    <td ><?php echo htmlspecialchars($result->family_name);?></td>
	
    <td ><?php echo htmlspecialchars($result->date_of_marriage);?></td>
	
    <td ><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($result->post_id); ?>" target="blank">View Post</a>

	</tr>
    
<?php 

} 

?>

	</tr>
    
	</table>

<?php


	$output = ob_get_clean();
	return $output;
	
}

add_shortcode( 'spouses', 'add_a_spouse' );










//  ********* START OF PEDIBREE TEMPLATE ********* 










//Add the pedigree code



function testpedigree($atts) {
	extract(shortcode_atts( array(
		'id' => ' ',
	), $atts ) );
ob_start();

?>

	<!-- Add header to link style.css sheet to the pedigree chart-->

	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>" media="screen" />


<div id="container"><!--Begin the Outer Container which holds the pedigree chart-->

	<div id="chart"><!--Begin the Chart Div that holds the Charts Base Person Information-->   
    
    	<div id="leftdiv"><!--Begin the 1st Div that holds the Charts Base Person-->

  				<div id="pers1"><!--Begin the Personal Div that holds the Charts Base Person Information-->
<?php
			
	// Get the information from the person database table
			



	// Select the Charts Base Person
			
	include ('tablename.php');

		
	$result = $wpdb->get_row ( 'SELECT first_name, family_name, date_of_birth, date_of_death FROM '.$table_name.' WHERE id = '.$id.''); 
		
?>
            
	<span class="first_name_text"><?php echo htmlspecialchars($result->first_name)?></span><br /><span class="pers_family_name_text"><?php echo htmlspecialchars($result->family_name). "<br />";?> </span>
            
    <p>
    
    <span class="pers_det_text">B: </span><?php echo htmlspecialchars($result->date_of_birth);?>
			
    <br /> 
    
    <span class="pers_det_text">D: </span><?php echo htmlspecialchars($result->date_of_death);?>
    
    </p>


</div><!--End the Personal Div that holds the Charts Base Person Information-->   

</div><!--End the 1st Div that holds the Charts Base Person-->

<div id="middiv"><!--Begin the 2st Div that holds the Charts Base Person Parents-->
    
  		<div id="pers2"><!--Begin the Personal Div that holds the Charts Base Person's Father Information-->

<?php
			
	// Select the Charts Base Person's Father
			
	$father_id = $wpdb->get_var( 'SELECT father_id FROM '.$table_name.' WHERE id = "'.$id.'"');

	$f_result = $wpdb->get_row ( 'SELECT first_name, family_name, date_of_birth, date_of_death, post_id FROM '.$table_name.' WHERE id = "'.$father_id.'"');
			
?>
            
	<span class="pers_first_name_text"><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($f_result->post_id) ?>"><?php echo htmlspecialchars($f_result->first_name)?></a></span><br /><span class="pers_family_name_text"><?php echo htmlspecialchars($f_result->family_name). "<br />";?></span>
            
    <p>   
    
    <span class="pers_det_text">B: </span><?php echo htmlspecialchars($f_result->date_of_birth);?>
            
	<br /> 
    
    <span class="pers_det_text">D: </span><?php echo htmlspecialchars($f_result->date_of_death);?>
    
    </p>
                   
</div><!--End the Personal Div that holds the Charts Base Person's Father Information-->

<div id="pers3"><!--Begin the Personal Div that holds the Charts Base Person's Mother Information-->

<?php
			
	// Select the Charts Base Person's Mother
            
	$mother_id = $wpdb->get_var( 'SELECT mother_id FROM '.$table_name.' WHERE id = "'.$id.'"');
	$m_result = $wpdb->get_row ( 'SELECT first_name, family_name, date_of_birth, date_of_death, post_id FROM '.$table_name.' WHERE id = "'.$mother_id.'"');
			
?>
            
	<span class="pers_first_name_text"><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($m_result->post_id) ?>"><?php echo htmlspecialchars($m_result->first_name)?></a></span> <br /><span class="pers_family_name_text"><?php echo htmlspecialchars($m_result->family_name). "<br />";?></span>
            
    <p> 
    
    <span class="pers_det_text">B: </span><?php echo htmlspecialchars($m_result->date_of_birth);?>
            
	<br />
    
    <span class="pers_det_text">D: </span><?php echo htmlspecialchars($m_result->date_of_death);?>
    
    </p>
    
</div><!--End the Personal Div that holds the Charts Base Person's Mother Information-->

</div><!--End the 2nd Div that holds the Charts Base Person Parents-->
    
<div id="rightdiv"><!--Begin the 3rd Div that holds the charts Grandparents-->
    
<div id="pers4"><!--Begin the Personal Div that holds the Charts Base Person's Father's Father Information-->
  		 	
<?php
			
	// Select the Charts Base Person's Paternal Grandfather
					
	$f_gfather_id = $wpdb->get_var( 'SELECT father_id FROM '.$table_name.' WHERE id = "'.$father_id.'"');
	$f_gf_result = $wpdb->get_row ( 'SELECT first_name, family_name, date_of_birth, date_of_death, post_id FROM '.$table_name.' WHERE id = "'.$f_gfather_id.'"');

?>
            
	<span class="pers_first_name_text"><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($f_gf_result->post_id) ?>"><?php echo htmlspecialchars($f_gf_result->first_name)?></a></span><br /> <span class="pers_family_name_text"><?php echo htmlspecialchars($f_gf_result->family_name). "<br />";?></a></span>
            
    <p>  
    
    <span class="pers_det_text">B: </span><?php echo htmlspecialchars($f_gf_result->date_of_birth);?>
            
	<br /> 
    
    <span class="pers_det_text">D: </span><?php echo htmlspecialchars($f_gf_result->date_of_death);?>
    
    </p>
            
</div><!--End the Personal Div that holds the Charts Base Person's Father's Father Information-->

<div id="pers5"><!--Begin the Personal Div that holds the Charts Base Person's Father's Mother Information-->

<?php

	// Select the Charts Base Person's Paternal Grandmother
					
	$f_gmother_id = $wpdb->get_var( 'SELECT mother_id FROM '.$table_name.' WHERE id = "'.$father_id.'"');
	$f_gm_result = $wpdb->get_row ( 'SELECT first_name, family_name, date_of_birth, date_of_death, post_id FROM '.$table_name.' WHERE id = "'.$f_gmother_id.'"');

?>
            
	<span class="pers_first_name_text"><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($f_gm_result->post_id) ?>"><?php echo htmlspecialchars($f_gm_result->first_name)?></a></span><br /><span class="pers_family_name_text"><?php echo htmlspecialchars($f_gm_result->family_name). "<br />";?></a></span>
            
    <p> 
    
    <span class="pers_det_text">B: </span><?php echo htmlspecialchars($f_gm_result->date_of_birth);?>
            
	<br /> 
    
    <span class="pers_det_text">D: </span><?php echo htmlspecialchars($f_gm_result->date_of_death);?>
    
    </p>
    
</div><!--End the Personal Div that holds the Charts Base Person's Father's Mother Information-->

<div id="pers6"><!--Begin the Personal Div that holds the Charts Base Person's Mothers's Father Information-->

<?php

	// Select the Charts Base Person's Maternal Grandfather
					
	$m_gfather_id = $wpdb->get_var( 'SELECT father_id FROM '.$table_name.' WHERE id = "'.$mother_id.'"');
	$f_gfather_result = $wpdb->get_row ( 'SELECT first_name, family_name, date_of_birth, date_of_death, post_id FROM '.$table_name.' WHERE id = "'.$m_gfather_id.'"');

?>
            
	<span class="pers_first_name_text"><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($f_gfather_result->post_id) ?>"><?php echo htmlspecialchars($f_gfather_result->first_name)?></a></span><br /><span class="pers_family_name_text"><?php echo htmlspecialchars($f_gfather_result->family_name). "<br />";?></a></span>             
                   
    <p>
    
    <span class="pers_det_text">B: </span><?php echo htmlspecialchars($f_gfather_result->date_of_birth);?>
			
    <br />   
    
    <span class="pers_det_text">D: </span><?php echo htmlspecialchars($f_gfather_resultdate_of_death);?>
    
    </p>  
            
</div><!--End the Personal Div that holds the Charts Base Person's Mothers's Father Information-->

 <div id="pers7"><!--Begin the Personal Div that holds the Charts Base Person's Mothers's Mother Information-->
  			
<?php

	// Select the Charts Base Person's Maternal Grandmother	
			
	$m_gmother_id = $wpdb->get_var( 'SELECT mother_id FROM '.$table_name.' WHERE id = "'.$mother_id.'"');
	$f_gmother_result = $wpdb->get_row ( 'SELECT first_name, family_name, date_of_birth, date_of_death, post_id FROM '.$table_name.' WHERE id = "'.$m_gmother_id.'"');

?>
            
	<span class="pers_first_name_text"><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($f_gmother_result->post_id) ?>"><?php echo htmlspecialchars($f_gmother_result->first_name)?></a></span><br /><span class="pers_family_name_text"><?php echo htmlspecialchars($f_gmother_result->family_name). "<br />";?></a></span>
            
    <p><span class="pers_det_text">B: </span><?php echo htmlspecialchars($f_gmother_result->date_of_birth);?>
			
    <br />   
    
    <span class="pers_det_text">D: </span><?php echo htmlspecialchars($f_gmother_resultdate_of_death);?>
    
    </p>

</div><!--End the Personal Div that holds the Charts Base Person's Mothers's Mother Information-->
        
</div><!--End the 3rd Div that holds the charts Grandparents--> 
    
</div><!--End the Chart Div that holds the Charts Base Person Information-->   

</div> <!--End the Outer Container which holds the pedigree chart-->

<?php

	$output = ob_get_clean();
	return $output;
}

add_shortcode('add_pedigree', 'testpedigree');











//END OF TEST PEDIGREE TEMPLATE











// ----------------------------------------------------------------------------------------------------------------------------//











// ********* CREATE THE TWO TABLES WDL_PERSON AND WDL_MARRIAGES ********* 




// Create the person table

function create_a_pedigree_table () {

include ('tablename.php');
   
   $sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,

  first_name VARCHAR(60) NOT NULL,
  family_name VARCHAR(50) NOT NULL,
  date_of_birth VARCHAR(11) NOT NULL,
  date_of_death VARCHAR(11) NOT NULL,
  family_id VARCHAR(60) NOT NULL,
  post_id VARCHAR(6) NOT NULL,
  father_id mediumint(9) NOT NULL,
  mother_id mediumint(9) NOT NULL,
  sex tinytext NOT NULL,
  UNIQUE KEY id (id)
    );";
	
	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_a_pedigree_table' );


// Create the marriage table

function create_a_marriage_table () {

include ('tablename.php');
   
  $sql = "CREATE TABLE $table_name2 (
  id mediumint(9) NOT NULL AUTO_INCREMENT,

  person_id mediumint(9) NOT NULL,
  spouse_id mediumint(9) NOT NULL,
  date_of_marriage VARCHAR(11) NOT NULL,
  marriage_id mediumint(9) NOT NULL
 
  UNIQUE KEY id (id)
    );";
	
	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_a_marriage_table' );










/* ********** CREATE THE MENU SYSTEM IN THE ADMIN AREA ********** */ 











function create_the_menus () {
	
// Create Top Admin Menu
define( 'MYPLUGINNAME_PATH', plugin_dir_url(__FILE__));

$path = MYPLUGINNAME_PATH;


    add_menu_page( 'Pedigree Chart', 'Pedigree Chart', 'edit_dashboard', 'wdl-familytree-top-menu', 'create_main_menu',  $path.'/images/tree.gif');
	
// Stop Top Admin Menufrom appearing as a submenu
	
	add_submenu_page('wdl-familytree-top-menu','','','manage_options','wdl-familytree-top-menu','');
	
// Create Submenus	
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Start New Family', 'Start New Family', 'edit_dashboard', 'add-submenu-start-new-family', 'start_new_family_page'); 
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Add Family Member', 'Add Family Member', 'edit_dashboard', 'add-submenu-add-family-member', 'add_new_family_member');

	add_submenu_page( 'wdl-familytree-top-menu', 'Add Spouse', 'Add Spouse', 'edit_dashboard', 'add-submenu-add-spouse', 'add_spouse');
		

	
	add_submenu_page( 'wdl-familytree-top-menu', 'Family Member List', 'Family Member List', 'edit_dashboard', 'add-submenu-view-family-member', 'view_family_member');	
	

	
 	add_submenu_page( 'wdl-familytree-top-menu', 'Spouse List', 'Spouse List', 'edit_dashboard', 'add-submenu-view-spouse', 'view_a_spouse');
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Edit Family Member', 'Edit Family Member', 'edit_dashboard', 'add-submenu-edit-person', 'edit_person');
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Edit Marriage Date', 'Edit Marriage Date', 'edit_dashboard', 'add-submenu-edit-marriage-date', 'edit_marriage_date');
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Broken/New Family Links', 'Edit/Create Links', 'edit_dashboard', 'add-submenu-connect-links', 'connect_links');
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Delete Family Member', 'Delete Family Member', 'edit_dashboard', 'add-submenu-delete-person', 'delete_person');

	add_submenu_page( 'wdl-familytree-top-menu', 'Delete Marriage', 'Delete Marriage', 'edit_dashboard', 'add-submenu-delete-marriage', 'delete_marriage_data');

	add_submenu_page( 'wdl-familytree-top-menu', 'Look and Feel', 'Look and Feel', 'edit_dashboard', 'add-submenu-change-look', 'change_look');

}

add_action('admin_menu', 'create_the_menus');











// CREATE THE MENU PAGES











//Create the Admin Main Menu Pedigree Chart Page






function create_main_menu () {
	
?>
<!-- Create the main menu page -->
<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for choosing WDL Family History</p>
    <br />
    <br />
    <p>This is a fully Functional Plugin with the only restriction being the number of family members able to be entered in the database (3 Generations) and the Look and Feel Options being restricted</p> 
    <p>As a Family Historian myself, I was disappointed to find no plugins for WordPress that offered what I needed. However, I was also lucky enough to have enough knowledge to produce a plugin that fulfilled these needs. This website uses this plugin so feel free to visit the different pages to see how it works Live.</p>

<p>Although it has been a “labour of love” it did take quite a bit of time to produce and I am constantly upgrading, as I come across things that need to be improved or I think of ideas that can enhance it.</p>

<p>This is the reason I ask for a small fee to use the full version </p>
    <br />
    <br />
    <p>If you like to view more information or to view the Frequently asked Questions</p> 
    <br />
	<a href="http://lyons-barton.com/wdl-pedigree-chart/"> More Information</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?php



}











// ------------------------------------------------------------------------------------------------------------ //










//Create the Admin Sub Menu Start New Family Page



function start_new_family_page () {
	
include ('tablename.php'); 
$row_number = $wpdb->get_results( "SELECT count(*) from $table_name" );
	$row_number = $wpdb->get_var( "SELECT count(*) from $table_name" );
	
	if ($row_number <= 06) {

		
?>
<div class="wrap">
<h2>WDL Pedigree Chart - Start A New Family</h2>
    <p>From this page you will be able to start a New Family in your family tree</p>
    <p>Enter the First Person in the Family Tree</p>
<br />
<br />
 <link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">

<div id="form">
  <fieldset>

  			
            	<form action="" method="post" name="new_person">
   			
            <p>	
            	<label for="first_name">First and Middle Names</label>
<br />
      			<input name="first_name" type="text" id="first_name" size="50" maxlength="50" />
			</p>
    
    		<p> 
            	<label for="family_name">Family Name *</label>
<br />
      			<input name="family_name" type="text" id="family_name"  size="50"  maxlength="50" />
    		</p>
            <br />
    		<p>
            	<label >Male / Female *</label>
<br />
				<select name="sex" maxlength="50">
  				<option></option>
  				<option value="Male"> Male </option>
 				<option value="Female"> Female </option>

				</select>
    		  
            </p>
            <br />


		    <p>
<label  align="left" for="date_of_birth">Date of Birth</label>
<br />
<br />
<span class="date">

Day <select name='bday'>
<option value =''></option>
<?php
$day = array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31');// etc);
foreach( $day as $k=>$v ){
echo"'<option value='$k'>$v</option>" . PHP_EOL ;
}
?>
</select>

Month <select name='bmonth'>
<option value =''></option>
<?php
$months = array('Jan'=>'January','Feb'=>'February','Mar'=>'March','Apr'=>'April','05'=>'May','Jun'=>'June','Jul'=>'July','Aug'=>'August','Sep'=>'September','Oct'=>'October','Nov'=>'November','Dec'=>'December');
foreach( $months as $k=>$v ){
echo"'<option value='$k'>$v</option>" . PHP_EOL ;
}
?>
</select>
Year <select name='byear'>
<option value =''></option>
<?php
$years = range( date('Y'), '1400');
foreach( $years as $y ){
echo"'<option value='$y'>$y</option>" . PHP_EOL ;
}
?>
</select>

</span>

			</p>
<br /><br />
    		<p>

<label align="left" for="date_of_death">Date Of Death</label>
<br />
<br />
<span class="date">

Day <select name='dday'>
<option value =''></option>
<?php
$day = array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31');// etc);
foreach( $day as $k=>$v ){
echo"'<option value='$k'>$v</option>" . PHP_EOL ;
}
?>
</select>

Month <select name='dmonth'>
<option value =''></option>
<?php
$months = array('Jan'=>'January','Feb'=>'February','Mar'=>'March','Apr'=>'April','05'=>'May','Jun'=>'June','Jul'=>'July','Aug'=>'August','Sep'=>'September','Oct'=>'October','Nov'=>'November','Dec'=>'December');
foreach( $months as $k=>$v ){
echo"'<option value='$k'>$v</option>" . PHP_EOL ;
}
?>
</select>
Year <select name='dyear'>
<option value =''></option>
<?php
$years = range( date('Y'), '1400');
foreach( $years as $y ){
echo"'<option value='$y'>$y</option>" . PHP_EOL ;
}
?>
</select>
</span>

			</p>
            <p>
            <input type="hidden" name="submitted" value="1"> 
            </p>

		    <p><br /><br /><br />
      			<input align="center" type="submit" name="submit" id="submit" value="Submit" />
      		</p>
            
			</form>
    
  </fieldset>
 <span class="required">Required Fields *<br />
</span> 

<?php

$n = rand(1,100);

include ('tablename.php');
	
// Run variable input through filters

$first_name = sanitize_text_field( $_POST['first_name'] );
$first_name = check_input( $first_name);


$family_name = sanitize_text_field( $_POST['family_name'] );
$family_name = check_input( $family_name, "Please Enter a Family Name");

$sex = sanitize_text_field( $_POST['sex'] );
$sex = check_input( $sex, "Please Enter The Sex of the New Person");

$bday = sanitize_text_field( $_POST['bday'] );
$bday = check_input( $bday);

$bmonth = sanitize_text_field( $_POST['bmonth'] );
$bmonth  = check_input( $bmonth );

$byear = sanitize_text_field( $_POST['byear'] );
$byear = check_input( $byear);

$dday = sanitize_text_field( $_POST['dday'] );
$dday = check_input( $dday);

$dmonth = sanitize_text_field( $_POST['dmonth'] );
$dmonth = check_input( $dmonth);

$dyear = sanitize_text_field( $_POST['dyear'] );
$dyear = check_input( $dyear);


$date_of_death = ($dday." ".$dmonth." ".$dyear);
$date_of_death = sanitize_text_field( $date_of_death );
$date_of_death = check_input( $date_of_death);
	
$date_of_birth = ($bday." ".$bmonth." ".$byear);
$date_of_birth = sanitize_text_field( $date_of_birth );
$date_of_birth = check_input( $date_of_birth);

include ('tablename.php');

	
$wpdb->insert($table_name,array('first_name'=>$first_name,'family_name'=>$family_name,'sex'=>$sex, 'date_of_birth'=>$date_of_birth, 'date_of_death'=>$date_of_death,'family_id'=>$family_name.$n));
	
include ('auto_new_page.php');
$wpdb->insert($table_name,array('person_id'=>$id));


} else {
?>	
	<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for Trying Out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>You have reached the maximum number of persons allowed in the Limited Version. Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with unlimited number of persons and the ability to change the Look and Feel of the Shortcode tables  to match your site</p>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?	
}
}







// ------------------------------------------------------------------------------------------------------------ //











//Create the Admin Sub Menu Add New Family Member Page







function add_new_family_member () {
	
	include ('tablename.php'); 
$row_number = $wpdb->get_results( "SELECT count(*) from $table_name" );
	$row_number = $wpdb->get_var( "SELECT count(*) from $table_name" );
	
	if ($row_number <= 06) {
?>
<div class="wrap">


<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>"/>
<?php
include ('tablename.php');

	$sql="SELECT * FROM $table_name ORDER BY first_name"; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 

    $id=sanitize_text_field( $row["id"]); 
	$id=check_input($row["id"]);
	
	
    $first_name=sanitize_text_field( $row["first_name"]); 
	$first_name=check_input($row["first_name"]); 
	
    $family_name=sanitize_text_field( $row["family_name"]); 
	$family_name=check_input($row["family_name"]); 
	
    $date_of_birth=sanitize_text_field( $row["date_of_birth"]);
	$date_of_birth=check_input($row["date_of_birth"]);
	
    $options.="<OPTION VALUE='". $row['id']. "'>".$id."   ---  ".$first_name ." ".$family_name."   ---  ".$date_of_birth; 
	}

?> 
    <h2>WDL Pedigree Chart - Add New Family Member</h2>
    <p>From this page you will be able to add a New Family Members to your family tres</p>
    <p>&nbsp;</p>
<br />
<br />
<div id="form">
	<form action="" method="post">

<label  align="left" for="id">Select the person whose family member you are adding. *</label>
<br /><br />
	<select name="id">
  	<option><?=$options?> </option>
	</select>
<br /><br />

<label  align="left" for="family_type">Select the type of relationship;*</label>
<br />
	<input type="radio" name="family_type" value="Father"  > Father
	<input type="radio" name="family_type" value="Mother" > Mother
	<input type="radio" name="family_type" value="Sibling" > Sibling
    <input type="radio" name="family_type" value="Child" > Child

<br /><br />

    <label for="first_name">First and Middle Names</label>
  <br />  
    <input name="first_name" type="text" id="first_name" size="50"  maxlength="40" />
</p>
    <p> <label for="family_name">Family Name </label>
 <br /> 
    <input name="family_name" type="text" id="family_name"  size="50"  maxlength="50" />
</p>

    		<p>
            	<label >Male / Female *</label>
 <br /> 
			  <select name="sex" maxlength="50">
  				<option></option>
                <option value="Male"> Male </option>
 				<option value="Female"> Female </option>

				</select>
    		  
            </p>

    		    <p>
<label  align="left" for="date_of_birth">Date of Birth</label>

<br />
Day <select name='bday'>
<option value =''></option>
<?php
$day = array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31');// etc);
foreach( $day as $k=>$v ){
echo"'<option value='$k'>$v</option>" . PHP_EOL ;
}
?>
</select>

Month
<select name='bmonth'>
  <option value =''></option>
  <?php
$months = array('Jan'=>'January','Feb'=>'February','Mar'=>'March','Apr'=>'April','05'=>'May','Jun'=>'June','Jul'=>'July','Aug'=>'August','Sep'=>'September','Oct'=>'October','Nov'=>'November','Dec'=>'December');
foreach( $months as $k=>$v ){
echo"'<option value='$k'>$v</option>" . PHP_EOL ;
}
?>
</select>
Year

<select name='byear'>
  <option value =''></option>
  <?php
$years = range( date('Y'), '1400');
foreach( $years as $y ){
echo"'<option value='$y'>$y</option>" . PHP_EOL ;
}
?>
</select>


<br /><br />


<label align="left" for="date_of_death">Date Of Death</label>
<br />

Day <select name='dday'>
<option value =''></option>
<?php
$day = array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31');// etc);
foreach( $day as $k=>$v ){
echo"'<option value='$k'>$v</option>" . PHP_EOL ;
}
?>
</select>

Month <select name='dmonth'>
<option value =''></option>
<?php
$months = array('Jan'=>'January','Feb'=>'February','Mar'=>'March','Apr'=>'April','05'=>'May','Jun'=>'June','Jul'=>'July','Aug'=>'August','Sep'=>'September','Oct'=>'October','Nov'=>'November','Dec'=>'December');
foreach( $months as $k=>$v ){
echo"'<option value='$k'>$v</option>" . PHP_EOL ;
}
?>
</select>
Year <select name='dyear'>
<option value =''></option>
<?php
$years = range( date('Y'), '1400');
foreach( $years as $y ){
echo"'<option value='$y'>$y</option>" . PHP_EOL ;
}
?>
</select>
</span>
</p>
    <p>
    <p><br /><br /><br />
    <input type="submit" name="submit" id="submit" value="Submit" />
    </p>

</form>


<span class="required">Required Fields *<br />
</span>

	</div>

<?php

// Get values from form

	$person = sanitize_text_field( $_POST['person'] ); 
	$person = check_input( $_POST['person']);

	$family_type = sanitize_text_field( $_POST['family_type'] );	
	$family_type= check_input($_POST['family_type'], "You need to Choose The Type of Family Member");

	$id = sanitize_text_field( $_POST['id'] );	
	$id= check_input($_POST['id'], "Please select the Member whose Mother, Father or Sibling you are Adding");

	$first_name = sanitize_text_field( $_POST['first_name'] );	
	$first_name = check_input($_POST['first_name']);

	$family_name = sanitize_text_field( $_POST['family_name'] );		
    $family_name = check_input($_POST['family_name']);
	
	$sex = sanitize_text_field( $_POST['sex'] );
	$sex = check_input($_POST['sex'], "Please select Whether the Person is Male or Female");
	
$bday = sanitize_text_field( $_POST['bday'] );
$bday = check_input( $bday);

$bmonth = sanitize_text_field( $_POST['bmonth'] );
$bmonth  = check_input( $bmonth );

$byear = sanitize_text_field( $_POST['byear'] );
$byear = check_input( $byear);

$dday = sanitize_text_field( $_POST['dday'] );
$dday = check_input( $dday);

$dmonth = sanitize_text_field( $_POST['dmonth'] );
$dmonth = check_input( $dmonth);

$dyear = sanitize_text_field( $_POST['dyear'] );
$dyear = check_input( $dyear);


$date_of_death = ($dday." ".$dmonth." ".$dyear);
$date_of_death = sanitize_text_field( $date_of_death );
$date_of_death = check_input( $date_of_death);
	
$date_of_birth = ($bday." ".$bmonth." ".$byear);
$date_of_birth = sanitize_text_field( $date_of_birth );
$date_of_birth = check_input( $date_of_birth);

	


// Insert the values above into the person table

include ('tablename.php');

	$family_id = $wpdb->get_var( "SELECT family_id FROM $table_name WHERE id = $id" );

	$wpdb->insert($table_name,array('first_name'=>$first_name, 'family_name'=>$family_name, 'sex'=>$sex,'date_of_birth'=>$date_of_birth, 'date_of_death'=>$date_of_death, 'family_id'=>$family_id));
	
// Obtain the id of the insert above

	$strSql = 'select last_insert_id() as lastId'; 
	 
  $result = mysql_query($strSql);  
  
  while($row = @mysql_fetch_assoc($result)){  
  
          $lastid = $row['lastId'];

  }
	

$lid = $lastid;


// If the family member is the father update the father id in the parents table



if ($family_type == 'Father')



{

	$wpdb->update($table_name,

	array('father_id'=>$lid,

	),

	array('id'=>$id));

}



// If the family member is the mother update the mother id in the parents table



else if ($family_type == 'Mother')



{

	

	$wpdb->update($table_name,

	array('mother_id'=>$lid,

	),

	array('id'=>$id));




}
else if ($family_type == 'Sibling')
{
	$mother_id = $wpdb->get_var( "SELECT mother_id FROM $table_name WHERE id = '$id'");
	$father_id = $wpdb->get_var( "SELECT father_id FROM $table_name WHERE id = '$id'");

	
	$wpdb->update($table_name,

	array('mother_id'=>$mother_id,
			'father_id'=>$father_id,
	),

	array('id'=>$lid));

} else if ($family_type == 'Child')
{
	
	$parent_sex = $wpdb->get_var( "SELECT sex FROM $table_name WHERE id = '$id'");
	
		if ($parent_sex =='Male') {
		
			$wpdb->update($table_name,

			array('father_id'=>$id,
			
			),

			array('id'=>$lid));
		} else {
			
			$wpdb->update($table_name,

			array('mother_id'=>$id,
			
			),

			array('id'=>$lid));
			
		}
}
 include ('auto_new_page.php');	


} else {
?>	
	<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for Trying Out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>You have reached the maximum number of persons allowed in the Limited Version. Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with unlimited number of persons and the ability to change the Look and Feel of the Shortcode tables  to match your site</p>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDL Pedigree Chart has to offer</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?	
}
}











// ------------------------------------------------------------------------------------------------------------ //











//Create the Admin Sub Menu Add New Spouse Page



function add_spouse () {
	
	include ('tablename.php'); 
$row_number = $wpdb->get_results( "SELECT count(*) from $table_name" );
	$row_number = $wpdb->get_var( "SELECT count(*) from $table_name" );
	
	if ($row_number <= 06) {
?>
<div class="wrap">


<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>"/>
<?php
include ('tablename.php');

	$sql="SELECT id, first_name, family_name, date_of_birth, date_of_birth FROM $table_name  WHERE sex = 'Male' ORDER BY first_name "; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 

    $id=sanitize_text_field( $row["id"]); 
	$id=check_input($row["id"]);
	
    $first_name=sanitize_text_field( $row["first_name"]); 
	$first_name=check_input($row["first_name"]); 
	
    $family_name=sanitize_text_field( $row["family_name"]); 
	$family_name=check_input($row["family_name"]); 
	
    $date_of_birth=sanitize_text_field( $row["date_of_birth"]); 
	$date_of_birth=check_input($row["date_of_birth"]); 
	
    $options.="<OPTION VALUE='". $row['id']. "'>".$id."   ---   ".$first_name ." ".$family_name."    --- ".$date_of_birth; 
	}

?> 
    <h2>WDL Pedigree Chart - Add Spouse</h2>
    <p>From this page you will be able to add a New Family Members to your family trees</p>
    <p>&nbsp;</p>
<br />
<br />
<div id="form">
	<form action="" method="post">

<label  align="left" for="person_id">Select the 1st person. *</label>
	<p></p>
	<select name="person_id" style="width: 400px" >
  	<option><?=$options?> </option>
	</select>
    
    <?php
	$sql="SELECT id, first_name, family_name, date_of_birth, date_of_birth FROM $table_name  WHERE sex = 'Female' ORDER BY first_name"; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 

    $id=sanitize_text_field( $row["id"]); 
	$id=check_input($row["id"]);
	
    $first_name=sanitize_text_field( $row["first_name"]); 
	$first_name=check_input($row["first_name"]); 
	
    $family_name=sanitize_text_field( $row["family_name"]); 
	$family_name=check_input($row["family_name"]); 
	
    $date_of_birth=sanitize_text_field( $row["date_of_birth"]); 
	$date_of_birth=check_input($row["date_of_birth"]); 
    $options.="<OPTION VALUE='". $row['id']. "'>".$id."   ---   ".$first_name ." ".$family_name."    --- ".$date_of_birth; 
	}
	?>

<label  align="left" for="spouse_id">Select the 2nd person. *</label>
	<p></p>
	<select name="spouse_id" style="width: 400px">
  	<option><?=$options?> </option>
	</select>


<br />
<br />
    <p>
<label  align="left" for="date_of_marriage">Date of Marriage</label>
<br />
<br />
<span class="date">

Day <select name='mday'>
<option value =''></option>
<?php
$months = array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31');// etc);
foreach( $months as $k=>$v ){
echo"'<option value='$k'>$v</option>" . PHP_EOL ;
}

?>

    </select>

	Month <select name='mmonth'>
	<option value =''></option>

<?php

	$months = array('Jan'=>'January','Feb'=>'February','Mar'=>'March','Apr'=>'April','05'=>'May','Jun'=>'June','Jul'=>'July','Aug'=>'August','Sep'=>'September','Oct'=>'October','Nov'=>'November','Dec'=>'December');
	foreach( $months as $k=>$v ){
	echo"'<option value='$k'>$v</option>" . PHP_EOL ;
	}

?>

	</select>
	Year <select name='myear'>
	<option value =''></option>

<?php

	$years = range( date('Y'), '1400');
	foreach( $years as $y ){
	echo"'<option value='$y'>$y</option>" . PHP_EOL ;
	}

?>
	</select>

	</span>
 
    <br />
	<br />
    
    <p>
    
    <br />
    <br />
    <br />
    
    <input type="submit" name="submit" id="submit" value="Submit" />
    </p>

	</form>

	<span class="required">Required Fields *<br />
	</span>

	</div>
	</div>

<?php

	// Get values from form

	$person = sanitize_text_field( $_POST['person'] ); 
	$person = check_input( $_POST['person']);

	$person_id = sanitize_text_field( $_POST['person_id'] );	
	$person_id= check_input($_POST['person_id'], "You need to Choose The 1st Person");

	$spouse_id = sanitize_text_field( $_POST['spouse_id'] );	
	$spouse_id= check_input($_POST['spouse_id'], "You need to Choose The 2nd Person");
	
	$mday = sanitize_text_field( $_POST['mday'] );
	$mday = check_input( $mday);

	$mmonth = sanitize_text_field( $_POST['mmonth'] );
	$mmonth = check_input( $mmonth);

	$myear = sanitize_text_field( $_POST['myear'] );
	$myear = check_input( $myear);


	$date_of_marriage = ($mday." ".$mmonth." ".$myear);
	$date_of_marriage = sanitize_text_field( $date_of_marriage );
	$date_of_marriage = check_input( $date_of_marriage);
		

	// Insert the values above into the person table

	include ('tablename.php');

	//	$family_id = $wpdb->get_var( "SELECT family_id FROM $table_name WHERE id = $id" );

	$wpdb->insert($table_name2,array('person_id'=>$person_id, 'spouse_id'=>$spouse_id, 'date_of_marriage'=>$date_of_marriage));
	
	$strSql = 'select last_insert_id() as lastId';  

  	$result = mysql_query($strSql);  
  
  	while($row = @mysql_fetch_assoc($result)){  
  
    $marriage_id = $row['lastId'];
		  
}

	$wpdb->update($table_name2,
	array('marriage_id'=>check_input($marriage_id)),
	array('id'=>check_input($marriage_id)));




	//Once the page creation has been completed forward to the view person list

	header("Location: ".bloginfo('url')."/wp-admin/admin.php?page=add-submenu-view-spouse");

} else {
?>	
	<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for Trying Out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>You have reached the maximum number of persons allowed in the Limited Version. Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with unlimited number of persons and the ability to change the Look and Feel of the Shortcode tables  to match your site</p>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?	
}
}











// ------------------------------------------------------------------------------------------------------------ //










//Create the Admin Sub Menu Fix Broken ar New Links Page


function connect_links () {
	include ('tablename.php'); 
$row_number = $wpdb->get_results( "SELECT count(*) from $table_name" );
	$row_number = $wpdb->get_var( "SELECT count(*) from $table_name" );
	
	if ($row_number <= 06) {
?>	


<h2>WDL Pedigree Chart - Fix broken or Add New Family Links</h2>
    <p>From this page you will be able to Fix broken or Add New Family Links</p>
    <p>Links break for all sorts of reasons. Use this page to re-established these broken links </p>
    <p>This page also changes the family ID to the fathers Family ID when the parent chosen is the the father of the child.</p>
<br />
<br />



<?php

include ('tablename.php');	

$sql="SELECT id, first_name, family_name, date_of_birth, date_of_birth FROM $table_name ORDER BY first_name"; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 

    $id=sanitize_text_field( $row["id"]); 
	$id=check_input($row["id"]);
	
    $first_name=sanitize_text_field( $row["first_name"]); 
	$first_name=check_input($row["first_name"]); 
	
    $family_name=sanitize_text_field( $row["family_name"]); 
	$family_name=check_input($row["family_name"]); 
	
    $date_of_birth=sanitize_text_field( $row["date_of_birth"]); 
	$date_of_birth=check_input($row["date_of_birth"]); 
    $options.="<OPTION VALUE='". $row['id']. "'>".$id."   ---   ".$first_name ." ".$family_name."    --- ".$date_of_birth; 
	$options2.="<OPTION VALUE='". $row['id']. "'>".$id."   ---   ".$first_name ." ".$family_name."    --- ".$date_of_birth; 
	}
?>
    <form action="" method="post" name="new_link">

	<label  align="left" for="person_id">Select First Person. *</label>
	
    <p></p>
	
    <select name="person_id" id="person_id" style="width: 400px">
  	
    <option><?=$options?> </option>
	
    </select>
    <br />
    <br />
    Link as the son or daughter of
    <br />
    <br />
    <label  align="left" for="parent_id">Parent</label>  
    <p></p>
    <select name="parent_id" id="parent_id" style="width: 400px">
  	
    <option><?=$options2?> </option>
	
    </select>

	  <p></p>


       <input type="submit" name="submit" id="submit" value="Submit" />
    
    </form>


<?php

//Get values from Form

	$person_id = sanitize_text_field( $_POST['person_id'] ); 
	$person_id = check_input( $_POST['person_id']);

	$parent_id = sanitize_text_field( $_POST['parent_id'] ); 
	$parent_id = check_input( $_POST['parent_id']);

		
	$parent = $wpdb->get_results( "SELECT * FROM $table_name WHERE id = '$parent_id'" );
	
	$parent_sex = $wpdb->get_var ("SELECT sex from $table_name WHERE id = '$parent_id'");

	if ($parent_sex == 'Male'){
	$family_id = $wpdb->get_var ("SELECT family_id from $table_name WHERE id = '$parent_id'");
		
		$wpdb->update($table_name,
	array('father_id'=>check_input($parent_id), 'family_id'=>check_input($family_id)),
	array('id'=>check_input($person_id)));
	

	
	} else {
		
		$wpdb->update($table_name,
	array('mother_id'=>check_input($parent_id)),
	array('id'=>check_input($person_id)));
		
	}
} else {
?>	
	<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for Trying Out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>You have reached the maximum number of persons allowed in the Limited Version. Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with unlimited number of persons and the ability to change the Look and Feel of the Shortcode tables  to match your site</p>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?	
}
}
//End the Admin Sub Menu Fix Broken ar New Links Page













// ------------------------------------------------------------------------------------------------------------ //











//Create the Admin Sub Menu View Family Member Page


function view_family_member () {
	include ('tablename.php'); 
$row_number = $wpdb->get_results( "SELECT count(*) from $table_name" );
	$row_number = $wpdb->get_var( "SELECT count(*) from $table_name" );
	
	if ($row_number <= 06) {
	
?>

<div class="wrap">

    <h2>WDL Pedigree Chart - View Family Members</h2>
    <p>From this page you will be able to view your Family Members</p>
    
    <p>&nbsp;</p>

 	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">

<?php

	include ('tablename.php');

	$result = $wpdb->get_results( "SELECT id, first_name, family_name, date_of_birth, date_of_death, family_id, post_id FROM $table_name ORDER BY first_name " );

?>

	<table class="menu_table">
	<th class="menu_heading small">
	ID
	</th>
	<th class="menu_heading_fn">
	First Name
	</th>
	<th class="menu_heading">
	Family Name
	</th>
	<th class="menu_heading small">
	Date Of Birth
	</th>
	<th class="menu_heading small">
	Date Of Death
	</th>
	<th class="menu_heading small">
	Family ID
	</th>
	<th class="menu_heading small">
	View Post
	</th>

<?php

	foreach ($result as $result){ ?>
    
	<tr class="menu_list">
	<td class="small" ><?php echo htmlspecialchars($result->id);?></td>
	<td ><?php echo htmlspecialchars($result->first_name);?></td>
	<td ><?php echo htmlspecialchars($result->family_name);?></td>
	<td class="small"><?php echo htmlspecialchars($result->date_of_birth);?></td>
	<td class="small"><?php echo htmlspecialchars($result->date_of_death);?></td>
	<td class="small" ><?php echo htmlspecialchars($result->family_id);?></td>
	<td class="small"><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($result->post_id); ?>" target="blank">View Post</a></td>

	</tr>

<?php 

}

?>

	</table>
	<tbody>

</div>

<?php 

} else {
?>	
	<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for Trying Out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>You have reached the maximum number of persons allowed in the Limited Version. Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with unlimited number of persons and the ability to change the Look and Feel of the Shortcode tables  to match your site</p>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?	
}
}

//End the Admin Sub Menu View Family Member Page











// ------------------------------------------------------------------------------------------------------------ //











//Create the Admin Sub Menu View Spouse Page
	
	global $wpdb;




	$result = $wpdb->get_results( "SELECT $table_name.first_name, $table_name.family_name, $table_name.post_id FROM $table_name JOIN $table_name2 ON ($table_name.id=$table_name2.spouse_id) WHERE ($table_name.id = $table_name2.person_id) OR ($table_name.id = $table_name2.spouse_id)" );


function view_a_spouse () {
	
	include ('tablename.php'); 
$row_number = $wpdb->get_results( "SELECT count(*) from $table_name" );
	$row_number = $wpdb->get_var( "SELECT count(*) from $table_name" );
	
	if ($row_number <= 06) {
	
?>

<div class="wrap">

    <h2>WDL Pedigree Chart - View Spouse</h2>
    <p>From this page you will be able to edit and delete Family Members</p>
    
    <p>&nbsp;</p>

 <link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">

<?php

	include ('tablename.php'); 


	$result = $wpdb->get_results( "SELECT DISTINCT
 	
	a.id,
    a.first_name AS spouse1_first_name,
    a.family_name AS spouse1_family_name,
    j.date_of_marriage,
    j.marriage_id,
    b.id,  
	j.person_id,
	b.first_name AS spouse2_first_name,
    b.family_name AS spouse2_family_name

	FROM $table_name2 j
  	INNER JOIN $table_name a
    ON a.id = j.person_id
  	INNER JOIN $table_name b
    ON  b.id = j.spouse_id
	
	"  );

	$spouse_id = $wpdb->get_var ("SELECT spouse_id from $table_name2 WHERE person_id = '.$result->id.'");

?>

<div id = "view_spouse">


	<table class="menu_table">


	<th class="menu_heading_fn">
	First Name</th>
	<th class="menu_heading_famn">
	Family Name</th>

	<th class="menu_heading_married">
	Marriage Date
	</th>

	<th class="menu_heading_fn">
	First Name</th>
	<th class="menu_heading_famn">
	Family Name</th>



	<tr>

<?php

	// Loop through the results to display the obtained information

	foreach ($result as $result){

?>
	
    <tr class="menu_list">

	<td ><?php echo htmlspecialchars($result->spouse1_first_name);?></td>
	<td ><?php echo htmlspecialchars($result->spouse1_family_name);?></td>

	<td class="text_marriage" ><?php echo htmlspecialchars($result->date_of_marriage);?></td>

	<td ><?php echo htmlspecialchars($result->spouse2_first_name);?></td>
	<td ><?php echo htmlspecialchars($result->spouse2_family_name);?></td>



	</tr>

<?php 

} 



?>

	</tr>

	</table>


</div> <!-- end view_spouse div -->

</div>

<?php 

} else {
?>	
	<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for Trying Out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>You have reached the maximum number of persons allowed in the Limited Version. Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with unlimited number of persons and the ability to change the Look and Feel of the Shortcode tables  to match your site</p>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?	
}
}



//End the Admin Sub Menu View Spouse Page











//---------------------------------------------------------------------------------------------------------------------------//











//Create the Admin Sub Menu Edit Person Page

	ob_start();
	global $wpdb;




	$result = $wpdb->get_results( "SELECT $table_name.first_name, $table_name.family_name, $table_name.post_id FROM $table_name JOIN $table_name2 ON ($table_name.id=$table_name2.spouse_id) WHERE ($table_name.id = $table_name2.person_id) OR ($table_name.id = $table_name2.spouse_id)" );

 
function edit_person() {
	
	include ('tablename.php'); 
$row_number = $wpdb->get_results( "SELECT count(*) from $table_name" );
	$row_number = $wpdb->get_var( "SELECT count(*) from $table_name" );
	
	if ($row_number <= 06) {
		

	include ('tablename.php');
	$p_id = NULL;

	$sql="SELECT * FROM $table_name ORDER BY first_name"; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 



    $p_id=sanitize_text_field( $row["id"]); 
	$p_id=check_input($p_id);
	
	
    $p_first_name=sanitize_text_field( $row["first_name"]); 
	$p_first_name=check_input($p_first_name); 
	
    $p_family_name=sanitize_text_field( $row["family_name"]); 
	$p_family_name=check_input($p_family_name); 
	
    $p_date_of_birth=sanitize_text_field( $row["date_of_birth"]);
	$p_date_of_birth=check_input($p_date_of_birth);
	
    $p_options.="<OPTION VALUE='".$p_id. "'>".$p_id."   ---  ".$p_first_name ." ".$p_family_name."   ---  ".$p_date_of_birth; 
	}

?> 

    <h2>WDL Pedigree Chart - Edit Family Member</h2>
    <p>From this page you will be able to Edit Family Members</p>
    
    <p>&nbsp;</p>

	<br />
	<br />


<div id="form">

	<form action="" method="post">

	<label  align="left" for="p_id"><strong>Step 1:</strong> Select the Person you wish to make changes to*</label>

	<br />
	<br />
    
	<select name="p_id" onchange='this.form.submit()'>
  	
    <option><?=$p_options?> </option>
	
    </select>

	<noscript><input type="submit" value="choose"></noscript>

	</form>

	<br />
 	<br />
    
</div>

<?php

	$p_id = sanitize_text_field( $_POST[p_id]);
	$p_id = check_input( $p_id,"You Need to Select the Person who You are Making Changes To");


	$result = $wpdb->get_results( "SELECT first_name, family_name, date_of_birth, date_of_death, id  FROM $table_name"); 



	$first_name = $wpdb->get_var( "SELECT first_name FROM $table_name WHERE id = $p_id" );
	$first_name =sanitize_text_field($first_name);
	$first_name =check_input($first_name);

	$family_name = $wpdb->get_var( "SELECT family_name FROM $table_name WHERE id = $p_id" );
	$family_name =sanitize_text_field($family_name);
	$family_name =check_input($family_name);


	$date_of_birth = $wpdb->get_var( "SELECT date_of_birth FROM $table_name WHERE id = $p_id" );
	$date_of_birth =sanitize_text_field($date_of_birth);
	$date_of_birth =check_input($date_of_birth);

	$date_of_death = $wpdb->get_var( "SELECT date_of_death FROM $table_name WHERE id = $p_id" );
	$date_of_death =sanitize_text_field($date_of_death);
	$date_of_death =check_input($date_of_death);



	$sex = $wpdb->get_var( "SELECT sex FROM $table_name WHERE id = $p_id" );
	$sex =sanitize_text_field($sex);
	$sex =check_input($sex);

?>

<div id="form">

  	<fieldset>

  	<legend class="legend"><strong>Step 2:</strong> Make the Required Changes.</legend>

	<br />

	<div id="inner_form">
  	
    <form action="" method="post" name="edit_person" >

   	<input name="p_id" id="p_id" type="hidden" value="<? echo htmlspecialchars($p_id)?>" />

    <p>

    <label for="first_name"><strong>First and Middle Names</strong></label><br />

    <input name="first_name" default=""   type="text" id="first_name" value="<? echo htmlspecialchars($first_name)?>"  " maxlength="50" />

	</p>

	<br />

    <p> 
    
    <label for="family_name"><strong>Family Name</strong></label><br />

    <input name="family_name" default="" type="text" id="family_name" value="<? echo htmlspecialchars($family_name)?>"  maxlength="50" />

	</p>

	<br />
    
    <p>

    <label for="date_of_birth"><strong>Date of Birth</strong></label><br />

    <input type="text" default=""  name="date_of_birth" id="date_of_birth" value="<? echo htmlspecialchars($date_of_birth)?>" maxlength="20"/>

	</p>

	<br />    
    
    <p>

    <label for="date_of_death"><strong>Date Of Death</strong> </label><br />
      
    <input type="text" default="" name="date_of_death" id="date_of_death" value="<? echo htmlspecialchars($date_of_death)?>" maxlength="20" />
    
    </p>

    <br />
   
    <p>  
    
    <label for="date_of_death"><strong>Sex</strong></label>
    
    <br />
        
    <input type="text" default=""  name="sex" id="sex" value="<? echo htmlspecialchars($sex)?>" maxlength="6" />
      
  	</p>

	<br />

    <p>

    <input type="submit" name="submit" id="submit" value="Submit" />

    </p>

  	</form>

  	</div>  

  	</fieldset>


</div>

<?php

	if(isset($_POST['submit'])) {



	$first_name = sanitize_text_field($_POST['first_name']);
	$first_name = check_input( $first_name);

	$family_name = sanitize_text_field($_POST['family_name']);
	$family_name = check_input( $family_name);

	$date_of_birth = sanitize_text_field($_POST['date_of_birth']);
	$date_of_birth = check_input( $date_of_birth);

	$date_of_death = sanitize_text_field($_POST['date_of_death']);
	$date_of_death = check_input( $date_of_death);

	$sex = sanitize_text_field($_POST['sex']);
	$sex = check_input( $sex);

	$p_id = sanitize_text_field($_POST['p_id']);
	$p_id = check_input( $p_id);

	include ('tablename.php');


	$wpdb->update($table_name,
	array('first_name'=>$first_name,'family_name'=>$family_name,'date_of_birth'=>$date_of_birth,'date_of_death'=>$date_of_death,'sex'=>$sex
	),
	array('id'=>$p_id));
	
	$ch_post_id = $wpdb->get_var( "SELECT post_id FROM $table_name WHERE id =$p_id" );	
	$table_name = $wpdb->prefix . "posts";

	$wpdb->update('wp_posts',
	array('post_title'=>$first_name." ".$family_name
	),
	array('id'=>$ch_post_id));
	
	header("Location: ".bloginfo('url')."/wp-admin/admin.php?page=add-submenu-view-family-member");
}

} else {
?>	
	<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for Trying Out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>You have reached the maximum number of persons allowed in the Limited Version. Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with unlimited number of persons and the ability to change the Look and Feel of the Shortcode tables  to match your site</p>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?	
}
}



//End the Admin Sub Menu Edit Person Page











//---------------------------------------------------------------------------------------------------------------------//











//Create the Admin Sub Menu Edit Marriage Page


function edit_marriage_date () {
	
	include ('tablename.php'); 
$row_number = $wpdb->get_results( "SELECT count(*) from $table_name" );
	$row_number = $wpdb->get_var( "SELECT count(*) from $table_name" );
	
	if ($row_number <= 06) {
	
?>	

	 <link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">

<?php
	ob_start();
	include ('tablename.php');

	$sql="SELECT id, first_name, family_name, date_of_birth, date_of_birth FROM $table_name  WHERE sex = 'Male' ORDER BY first_name "; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 



    $id=sanitize_text_field( $row["id"]); 
	$id=check_input($row["id"]);
	
    $first_name=sanitize_text_field( $row["first_name"]); 
	$first_name=check_input($row["first_name"]); 
	
    $family_name=sanitize_text_field( $row["family_name"]); 
	$family_name=check_input($row["family_name"]); 
	
    $date_of_birth=sanitize_text_field( $row["date_of_birth"]); 
	$date_of_birth=check_input($row["date_of_birth"]); 
	
    $options.="<OPTION VALUE='". $row['id']. "'>".$id."   ---   ".$first_name ." ".$family_name."    --- ".$date_of_birth; 
	}

?> 
    <h2>WDL Pedigree Chart - Add Spouse</h2>
    
    <p>From this page you will be able to add a New Family Members to your family trees</p>
    <p>&nbsp;</p>

	<br />
	<br />

<div id="form">
	
    <form action="" method="post" name="new_person">

	<label  align="left" for="person_id">Select Spouse 1. *</label>
	
    <p></p>
	
    <select name="person_id" id="person_id" style="width: 400px">
  	
    <option><?=$options?> </option>
	
    </select>

    <br />
    <br  />
    
<?php

	$sql="SELECT id, first_name, family_name, date_of_birth, date_of_birth FROM $table_name  WHERE sex = 'Female' ORDER BY first_name"; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 
	unset ($spouse_id);

    $id=sanitize_text_field( $row["id"]); 
	$id=check_input($row["id"]);
	
    $first_name=sanitize_text_field( $row["first_name"]); 
	$first_name=check_input($row["first_name"]); 
	
    $family_name=sanitize_text_field( $row["family_name"]); 
	$family_name=check_input($row["family_name"]); 
	
    $date_of_birth=sanitize_text_field( $row["date_of_birth"]); 
	$date_of_birth=check_input($row["date_of_birth"]); 
    $options_f.="<OPTION VALUE='". $row['id']. "'>".$id."   ---   ".$first_name ." ".$family_name."    --- ".$date_of_birth; 
	}
	
?>

	<label  align="left" for="spouse_id">Select Spouse 2. *</label>
	
    <p></p>
	
    <select name="spouse_id"  id="spouse_id" style="width: 400px">
  	
    <option><?=$options_f?> </option>
	
    </select>
     
    <p>

    <input type="submit" name="choose" id="choose" value="Choose Marriage Partners" />

    </p>

	</form>
    
    <br />
    <br />
    <br />
    
    <hr width=85% align="center" />
    
    <br />
    <br />
    <br />    

<?php

	include ('tablename.php');
    $person_id = sanitize_text_field( $_POST["person_id"]); 
	$person_id=check_input($person_id,"You Need to Select Spouse 1"); 

	
    $spouse_id=sanitize_text_field( $_POST["spouse_id"]); 
	$spouse_id=check_input($spouse_id,"You Need to Select Spouse 2"); 
	

	
	$result = $wpdb->get_results( "SELECT first_name, family_name,id  FROM $table_name"); 



	$first_name = $wpdb->get_var( "SELECT first_name FROM $table_name WHERE id = $person_id" );
	$first_name =sanitize_text_field($first_name);
	$first_name =check_input($first_name);

	$family_name = $wpdb->get_var( "SELECT family_name FROM $table_name WHERE id = $person_id" );
	$family_name  =sanitize_text_field($family_name );
	$family_name  =check_input($family_name );

	$first_name_sp = $wpdb->get_var( "SELECT first_name FROM $table_name WHERE id = $spouse_id" );
	$first_name_sp =sanitize_text_field($first_name_sp);
	$first_name_sp =check_input($first_name_sp);

	$family_name_sp = $wpdb->get_var( "SELECT family_name FROM $table_name WHERE id = $spouse_id" );
	$family_name_sp =sanitize_text_field($family_name_sp );
	$family_name_sp  =check_input($family_name_sp );

	$result2 = $wpdb->get_results( "SELECT date_of_marriage, person_id, spouse_id  FROM $table_name2"); 

	$date_of_marriage = $wpdb->get_var( "SELECT date_of_marriage FROM $table_name2 WHERE person_id = $person_id AND spouse_id = $spouse_id" );
	$date_of_marriage =sanitize_text_field($date_of_marriage);
	$date_of_marriage =check_input($date_of_marriage);


	echo $first_name." ".$family_name;
	unset ($first_name);
	unset ($family_name);

?>

	<br />
    <br />

MARRIED

	<br />
    <br />

<?php

	echo $first_name_sp." ".$family_name_sp ;
	unset ($first_name_sp);
	unset ($family_name_sp);


?>

	<br />
    <br />
    
on the

	<br />
    <br />

	<form action="" method="post" >
    
    <p>
	
    <input type="text" default="" name="date_of_m" id="date_of_m" value="<? echo htmlspecialchars($date_of_marriage)?>" maxlength="20" />
    
    </p>

	<input name="person_id" id="person_id" type="hidden" value="<? echo htmlspecialchars($person_id)?>" />
   	
    <input name="spouse_id" id="spouse_id" type="hidden" value="<? echo htmlspecialchars($spouse_id)?>" />

    <input type="submit" name="submit" id="submit" value="Submit" />
 
    </form>
    
<?php

	if(isset($_POST['submit'])) {

	$date_of_marriage = check_input( $date_of_m);


	$date_of_m = sanitize_text_field($_POST['date_of_m']);
	$date_of_m = check_input( $date_of_m);
	$date_of_marriage = $date_of_m;

	$person_id = sanitize_text_field($_POST['person_id']);
	$person_id = check_input( $person_id);

	$spouse_id = sanitize_text_field($_POST['spouse_id']);
	$spouse_id = check_input( $spouse_id );

	include ('tablename.php');
	
	$wpdb->update($table_name2,
	array('date_of_marriage'=>$date_of_m),
	array('person_id'=>$person_id,
	'spouse_id'=>$spouse_id));
	
	header("Location: ".bloginfo('url')."/wp-admin/admin.php?page=add-submenu-view-spouse");

}

} else {
?>	
	<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for Trying Out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>You have reached the maximum number of persons allowed in the Limited Version. Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with unlimited number of persons and the ability to change the Look and Feel of the Shortcode tables  to match your site</p>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?	
}
}


//End the Admin Sub Menu Edit Marriage Page











//----------------------------------------------------------------------------------------------------------------------------//











//Create the Admin Sub Menu Delete Person Page



	ob_start();
	global $wpdb;




	$result = $wpdb->get_results( "SELECT $table_name.first_name, $table_name.family_name, $table_name.post_id FROM $table_name JOIN $table_name2 ON ($table_name.id=$table_name2.spouse_id) WHERE ($table_name.id = $table_name2.person_id) OR ($table_name.id = $table_name2.spouse_id)" );

 
function delete_person() {
	
	include ('tablename.php'); 
$row_number = $wpdb->get_results( "SELECT count(*) from $table_name" );
	$row_number = $wpdb->get_var( "SELECT count(*) from $table_name" );
	
	if ($row_number <=06) {
		

	include ('tablename.php');
	$p_id = NULL;

	$sql="SELECT * FROM $table_name ORDER BY first_name"; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 

    $p_id=sanitize_text_field( $row["id"]); 
	$p_id=check_input($p_id);
	
	
    $p_first_name=sanitize_text_field( $row["first_name"]); 
	$p_first_name=check_input($p_first_name); 
	
    $p_family_name=sanitize_text_field( $row["family_name"]); 
	$p_family_name=check_input($p_family_name); 
	
    $p_date_of_birth=sanitize_text_field( $row["date_of_birth"]);
	$p_date_of_birth=check_input($p_date_of_birth);
	
    $p_options.="<OPTION VALUE='".$p_id. "'>".$p_id."   ---  ".$p_first_name ." ".$p_family_name."   ---  ".$p_date_of_birth; 
	}

?> 

    <h2>WDL Pedigree Chart - Delete Family Member</h2>
    <p>From this page you will be able to Edit Family Members</p>
    
    <p>&nbsp;</p>

	<br />
	<br />

	<div id="form">
  
	<form action="" method="post">

	<label  align="left" for="p_id"><strong>Step 1:</strong> Select the Person you wish to Delete*</label>

	<br />
    <br />
    
	<select name="p_id">
  	
    <option><?=$p_options?> </option>
	
    </select>
    
    <br />
    <br />

	<input type="submit" name="submit" id="submit" value="Delete Person" />

	</form>

	<br />
	<br />


<?php

	$p_id = sanitize_text_field( $_POST[p_id]);
	$p_id = check_input( $p_id,"You Need to Select the Person who You Wish To Delete");

	$post_id = $wpdb->get_var( "SELECT post_id FROM $table_name WHERE id = $p_id" );

	$id = $p_id;

	$wpdb->query( "DELETE FROM $table_name WHERE id = $p_id" );

	wp_delete_post($post_id);
} else {
?>	
	<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for Trying Out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>You have reached the maximum number of persons allowed in the Limited Version. Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with unlimited number of persons and the ability to change the Look and Feel of the Shortcode tables  to match your site</p>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?	
}
}


//End the Admin Sub Menu Delete Person Page











//---------------------------------------------------------------------------------------------------------------------//











// Add Delete Marriage Page



function delete_marriage_data () {
	
	include ('tablename.php'); 
$row_number = $wpdb->get_results( "SELECT count(*) from $table_name" );
	$row_number = $wpdb->get_var( "SELECT count(*) from $table_name" );
	
	if ($row_number <= 06) {

?>	

	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">
  
<?php

	ob_start();
	include ('tablename.php');

	$sql="SELECT id, first_name, family_name, date_of_birth, date_of_birth FROM $table_name  WHERE sex = 'Male' ORDER BY first_name "; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 



    $id=sanitize_text_field( $row["id"]); 
	$id=check_input($row["id"]);
	
    $first_name=sanitize_text_field( $row["first_name"]); 
	$first_name=check_input($row["first_name"]); 
	
    $family_name=sanitize_text_field( $row["family_name"]); 
	$family_name=check_input($row["family_name"]); 
	
    $date_of_birth=sanitize_text_field( $row["date_of_birth"]); 
	$date_of_birth=check_input($row["date_of_birth"]); 
	
    $options.="<OPTION VALUE='". $row['id']. "'>".$id."   ---   ".$first_name ." ".$family_name."    --- ".$date_of_birth; 
	}

?> 
    
    <h2>WDL Pedigree Chart - Add Spouse</h2>
    <p>From this page you will be able to add a New Family Members to your family trees</p>
    
    <p>&nbsp;</p>

	<br />
	<br />

<div id="form">
	
    <form action="" method="post" name="new_person">

	<label  align="left" for="person_id">Select Spouse 1. *</label>
	
    <p></p>
    
	<select name="person_id" id="person_id" style="width: 400px">
  	
    <option><?=$options?> </option>
	
    </select>

    <br />
    <br  />
    
<?php

	$sql="SELECT id, first_name, family_name, date_of_birth, date_of_birth FROM $table_name  WHERE sex = 'Female' ORDER BY first_name"; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 
	unset ($spouse_id);

    $id=sanitize_text_field( $row["id"]); 
	$id=check_input($row["id"]);
	
    $first_name=sanitize_text_field( $row["first_name"]); 
	$first_name=check_input($row["first_name"]); 
	
    $family_name=sanitize_text_field( $row["family_name"]); 
	$family_name=check_input($row["family_name"]); 
	
    $date_of_birth=sanitize_text_field( $row["date_of_birth"]); 
	$date_of_birth=check_input($row["date_of_birth"]); 
    $options_f.="<OPTION VALUE='". $row['id']. "'>".$id."   ---   ".$first_name ." ".$family_name."    --- ".$date_of_birth; 
	}

?>

	<label  align="left" for="spouse_id">Select Spouse 2. *</label>
	
    <p></p>
	
    <select name="spouse_id"  id="spouse_id" style="width: 400px">
  	
    <option><?=$options_f?> </option>
	
    </select>
    
    <p>

    <input type="submit" name="submit" id="submit" value="Delete Marriage" />

    </p>

	</form>
    
    <br />
    <br />
    <br />
    
    <hr width=85% align="center" />
    
    <br />
    <br />
    <br />  
      
<?php

	include ('tablename.php');
    $person_id = sanitize_text_field( $_POST["person_id"]); 
	$person_id=check_input($person_id,"You Need to Select Spouse 1"); 

	
    $spouse_id=sanitize_text_field( $_POST["spouse_id"]); 
	$spouse_id=check_input($spouse_id,"You Need to Select Spouse 2"); 
	

	


	$wpdb->query( "DELETE FROM $table_name2 WHERE person_id = $person_id AND spouse_id = $spouse_id" );


} else {
?>	
	<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for Trying Out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>You have reached the maximum number of persons allowed in the Limited Version. Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with unlimited number of persons and the ability to change the Look and Feel of the Shortcode tables  to match your site</p>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?	
}
}



// End Delete Marriage Page








// --------------------------------------------------------------------------------------------------------------------------------------//





function change_look () {

?>
<!-- Create the main menu page -->
<div class=""wrap">
    <?php screen_icon();?>
    <h2>WDL Family History</h2>
    <p> Thankyou for choosing WDL Family History</p>
    <br />
    <br />
    <p>This is a Functional Plugin with the only restriction being the number of family members able to be entered in the database (3 Generations) and the Look and Feel Option being restricted</p> 
    <p>To change the colors, fonts and tables produced by the shortcode please purchase the full version available  <a href="http://lyons-barton.com/wdl-pedigree-chart/" target ="blank">here</a> for only AUD $9.99</p>

<p>With the Full Version you can:</p>
<p>
<ul>
<li>Do everything you can with this version,plus</li>
<li>Change the Look and Feel to match your site</li>
<li>Change the Font Properties (type, color, size, decoration)</li>
<li>Change the Table size and location</li>
<li>Change the Color Properties.</li>
</ul></p>

<p>This is the reason I ask for a small fee to use the full version </p>
    <br />
    <br />
    <p>If you like to view more information or to view the Frequently asked Questions</p> 
    <br />
	<a href="http://lyons-barton.com/wdl-pedigree-chart/"> More Information</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?php



}






function check_input($data, $problem='')
{
    $data = strip_tags($data);
	$data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

  
    if ($problem && strlen($data) == 0)
    {
        die($problem);
    }
    return $data;
}

function check_input_sanitize($data, $problem='')
{

  	$data = sanitize_text_field($data);
  
    if ($problem && strlen($data) == 0)
    {
        die($problem);
    }
    return $data;
}
?>