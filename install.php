<?php ob_start();?>

<?php 

/*

Plugin Name:  WDL Family History and Genealogy Pedigree Chart
Plugin URI: http://lyons-barton.com/wdl-pedigree-chart
Description: Adds a 3 Generation pedigree chart to your page
Version: 1.3.5
Author: Warwick Lyons
Author URI: http://lyons-barton.com
License: © Copyright 2013. All Rights Reserved
*/













// CREATE THE SHORTCODES USED IN THIS PLUGIN

// Create Menu shortcode



function add_a_menu( $atts ) {
	extract( shortcode_atts( array(
		'famid' => '',

	), $atts ) );
ob_start();

 	include ('style_info.php');
	


	// Obtain the information for the list

	include ('tablename.php');

	$result_menu= $wpdb->get_results( "SELECT first_name, family_name, family_name, date_of_birth, date_of_death, post_id  FROM $table_name WHERE family_id = '$famid' ORDER BY family_name" );

?>

	<!-- Create the table to display the list  -->

	<table class="shortcode_tables">

	<th>First Name</th>

	<th>Family Name</th>

	<th>Date Of Birth</th>

	<th>Date Of Death</th>

	<th>View Page</th>

	<tr>

<?php

	// Loop through the results to display the obtained information
	
	foreach ($result_menu as $result_menu){ 
	
?>

	<tr>


	
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
	
	
		// Obtain the information for the styling


 	include ('style_info.php');




	

	// Obtain the information for the list

	include ('tablename.php');

	$result = $wpdb->get_results( "SELECT father_id, mother_id  FROM $table_name WHERE id = '$id' ORDER BY date_of_birth" );
	$father_id = $wpdb->get_var( "SELECT father_id FROM $table_name WHERE id = '$id'" );
	$mother_id = $wpdb->get_var( "SELECT mother_id FROM $table_name WHERE id = '$id'" );
	
	// Create $sibling depend on which parent or parents are present in the database
	
	if ((!empty($father_id) ) && (!empty($mother_id) )) {
		
	$sibling = $wpdb->get_results( "SELECT first_name, family_name, date_of_birth, post_id FROM $table_name WHERE (mother_id = '$mother_id' AND father_id = '$father_id')  AND id <> '$id'" );
	
		if ($sibling != NULL) {
	
	$siblings = "yes";
	
		} else {
		
		
	$siblings = "no";
		
		}
	
	} else if ((empty($father_id) && (!empty($mother_id) ))) {
		
	$sibling = $wpdb->get_results( "SELECT first_name, family_name, date_of_birth, post_id FROM $table_name WHERE (mother_id = '$mother_id' )  AND id <> '$id'" );
	
		if ($sibling != NULL) {
	
	$siblings = "yes";
	
		} else {
		
		
	$siblings = "no";
		
		}
	
	}  else if ((empty($mother_id) && (!empty($father_id) ))) {
		
	$sibling = $wpdb->get_results( "SELECT first_name, family_name, date_of_birth, post_id FROM $table_name WHERE (father_id = '$father_id' )  AND id <> '$id'" );
	
		if ($sibling != NULL) {
	
	$siblings = "yes";
	
		} else {
		
		
	$siblings = "no";
		
		}
	
	} else  {
		$sibling = "no_siblings";
}

	if ($siblings === "yes") {

?>	


	<!-- Create the table to display the list  -->
	
<div class="shortcode_outer">
   <div class="sibling_inner">
    
	<span class="table_heading">Sibling  </span>
	  <table class="shortcode_tables">
	
       
        <th>First Name</th>
    
		<th>Family Name</th>
        
        <th>Date of Birth</th>

		<th>View Page</th>

		<tr>
    
<?php

	// Loop through the results to display the obtained information

	foreach ($sibling as $sibling){
	$sibling_id = $sibling->id;	

?>

				<tr>

				<td ><?php echo htmlspecialchars($sibling->first_name);?></td>
   				<td><?php echo htmlspecialchars($sibling->family_name);?></td>
                <td><?php echo htmlspecialchars($sibling->date_of_birth);?></td>
				<td><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($sibling->post_id) ?>" target="blank">View Post</a></td>
		    	
                </tr>
    
<?php 

} 
?>

		</tr>
	
    </table>
    
   </div><!--End sibling_inner div -->
</div><!--End shortcode_outer div -->

<?php
	} else {
		?><span class="table_heading">Sibling  </span>
	  <table class="shortcode_tables">
	
       
        <th>First Name</th>
    
		<th>Family Name</th>
        
        <th>Date of Birth</th>

		<th>View Page</th>

		<tr>
        <td colspan="4">This person has no known siblings</td>
        </tr>
        </table>
		<?php
	}
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

include ('style_info.php');



	// Obtain the information for the list

	include ('tablename.php');
	
	if ($father_id == "0")
	{
			$result = $wpdb->get_results( "SELECT first_name, family_name, post_id FROM $table_name WHERE mother_id = '$mother_id' ORDER BY date_of_birth" );
			
	if ($result != NULL) {
	
	$children = "yes";
	
		} else {
		
		
	$children = "no";
		}
	
	} else if ($mother_id == "0") {
		$result = $wpdb->get_results( "SELECT first_name, family_name, date_of_birth, post_id FROM $table_name WHERE father_id = '$father_id' ORDER BY date_of_birth" );
		
	if ($result != NULL) {
	
	$children = "yes";
	
		} else {
		
		
	$children = "no";
		}
	
	} else {	

	$result = $wpdb->get_results( "SELECT first_name, family_name, date_of_birth, post_id FROM $table_name WHERE father_id = '$father_id' AND mother_id = '$mother_id' ORDER BY date_of_birth" );
	
	if ($result != NULL) {
	
	$children = "yes";
	
		} else {
		
		
	$children = "no";
	
		}
	}

if ($children ==="yes") {

?>

	<!-- Create the table to display the list  -->
    <div class="shortcode_outer">
    <div class="children_inner">
	<span class="table_heading">Children</span>

	<table class="shortcode_tables">


	<th>First Name</th>
	
    <th>Family Name</th>
    
    <th>Date of Birth</th>

	<th>View Page</th>

	<tr>
    
<?php
	
	// Loop through the results to display the obtained information

	foreach ($result as $result){
	$sibling_id = $sibling->id;	

?>

	<tr>

	<td ><?php echo htmlspecialchars($result->first_name);?></td>

	<td><?php echo htmlspecialchars($result->family_name);?></td>
    
    <td><?php echo htmlspecialchars($result->date_of_birth);?></td>

	<td><a href="<?php bloginfo('url'); ?>?p=<? echo htmlspecialchars($result->post_id) ?>" target="blank">View Post</a></td>

	</tr>
    
<?php
 
} 

?>

	</tr>

	</table>
</div><!--End children_inner div -->
</div><!--End shortcode_outer div -->
<?php
} else {
		?><span class="table_heading">Children  </span>
	  <table class="shortcode_tables">
	
       
        <th>First Name</th>
    
		<th>Family Name</th>
        
        <th>Date of Birth</th>

		<th>View Page</th>

		<tr>
        <td colspan="4">This person has no known Children</td>
        </tr>
        </table>
		<?php
	}


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

include ('style_info.php');


	// Obtain the information for the list

	include ('tablename.php');

	foreach( $wpdb->get_results("SELECT * FROM $table_name2 WHERE person_id = $id OR spouse_id = $id ") as $key => $row) {

// each column in your row will be accessible like this

	$spouse_id = $row->spouse_id;
	$person_id = $row->person_id;

}


	if ($id == $spouse_id){

	$result = $wpdb->get_results( "SELECT $table_name.first_name, $table_name.family_name, $table_name.post_id,  $table_name2.date_of_marriage, $table_name2.person_id, $table_name2.spouse_id  FROM $table_name JOIN $table_name2 ON $table_name.id=$table_name2.person_id WHERE ($table_name2.spouse_id = $id)" );
	
	if ($result != NULL) {
	
	$have_spouse = "yes";
	
		} else {
		
		
	$have_spouse = "no";
	
		}
	} else {

	$result = $wpdb->get_results( "SELECT $table_name.first_name, $table_name.family_name, $table_name.post_id,  $table_name2.date_of_marriage, $table_name2.person_id, $table_name2.spouse_id FROM $table_name JOIN $table_name2 ON $table_name.id=$table_name2.spouse_id WHERE $table_name2.person_id = $id" );
	
	if ($result != NULL) {
	
	$have_spouse = "yes";
	
		} else {
		
		
	$have_spouse = "no";
	
		}
		
}

if ($have_spouse === "yes") {
?>


	<!-- Create the table to display the list  -->
    <div class="shortcode_outer">
    <div class="spouse_inner">
	<span class="table_heading">Spouse</span>
	
    <table class="shortcode_tables">

	<th>First Name</th>
    
	<th>Family Name</th>
    
	<th>Date of  Marriage</th>

	<th>View Page</th>

	<tr>
    
<?php

	// Loop through the results to display the obtained information

	foreach ($result as $result){

?>

	<tr>


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
</div><!--End spouse_inner div -->
</div><!--End shortcode_outer div -->
<?php
} else {
		?><span class="table_heading">Spouse  </span>
	  <table class="shortcode_tables">
	
       
        <th>First Name</th>
    
		<th>Family Name</th>
        
        <th>Date of Marriage</th>

		<th>View Page</th>

		<tr>
        <td colspan="4">This person has no known Spouse</td>
        </tr>
        </table>
		<?php
	}

	$output = ob_get_clean();
	return $output;
	
}

add_shortcode( 'spouses', 'add_a_spouse' );










//  ********* START OF PEDIBREE TEMPLATE ********* 










//Add the pedigree code



function wdl_add_pedigree($atts) {
	extract(shortcode_atts( array(
		'id' => ' ',
	), $atts ) );
ob_start();

include ('style_info.php');

?>

	<!-- Add header to link style.css sheet to the pedigree chart-->

	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>" media="screen" />


<div id="pg_spacer"><!--Begin the Outer Container which holds the pedigree chart-->

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
    
    <span class="pers_det_text">D: </span><?php echo htmlspecialchars($f_gfather_result->date_of_death);?>
    
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
    
    <span class="pers_det_text">D: </span><?php echo htmlspecialchars($f_gmother_result->date_of_death);?>
    
    </p>

</div><!--End the Personal Div that holds the Charts Base Person's Mothers's Mother Information-->
        
</div><!--End the 3rd Div that holds the charts Grandparents--> 
    
</div><!--End the Chart Div that holds the Charts Base Person Information-->   

</div> <!--End the Outer Container which holds the pedigree chart-->

<?php

	$output = ob_get_clean();
	return $output;
}

add_shortcode('add_pedigree', 'wdl_add_pedigree');











//END OF TEST PEDIGREE TEMPLATE











// ----------------------------------------------------------------------------------------------------------------------------//











// ********* CREATE THE TABLES WDL_PERSON AND WDL_MARRIAGES ********* 



// Create the category table

function create_a_wdl_category_table () {

include ('tablename.php');
   
  $sql = "CREATE TABLE $table_name4 (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  cat_number mediumint(9) NOT NULL,
  cat_name VARCHAR(20) NOT NULL,

 
  UNIQUE KEY id (id)
    );";
	
	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_a_wdl_category_table' );


// Create the marriage table

function create_a_marriage_table () {

include ('tablename.php');
   
  $sql = "CREATE TABLE $table_name2 (
  id mediumint(9) NOT NULL AUTO_INCREMENT,

  person_id mediumint(9) NOT NULL,
  spouse_id mediumint(9) NOT NULL,
  date_of_marriage VARCHAR(11) NOT NULL,
  marriage_id mediumint(9) NOT NULL,
 
  UNIQUE KEY id (id)
    );";
	
	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_a_marriage_table' );




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
  image VARCHAR(30) NOT NULL,
  loc_of_birth VARCHAR(150) NOT NULL,
  loc_of_death VARCHAR(150) NOT NULL,
  birth_certificate VARCHAR(30) NOT NULL,
  death_certificate VARCHAR(30) NOT NULL,

  UNIQUE KEY id (id)
    );";
	
	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_a_pedigree_table' );










// Create the css table


function install_css_data() {
 include ('tablename.php');
 
$result = $wpdb->get_results( "SELECT * FROM $table_name3");
 $id_exist = $wpdb->get_var( "SELECT insert_number FROM $table_name3 ");
 $insert_number = 1;
 if ($id_exist == 1) {
	 
	  return;
	 
	 } else {

  $rows_affected = $wpdb->insert( $table_name3, array( 
  
  'insert_number' => $insert_number, 
  'table_heading_ft_fam' => $table_heading_ft_fam, 
  'table_heading_ft_size' => $table_heading_ft_size, 
  'table_heading_ft_wght' => $table_heading_ft_wght, 
  'table_heading_ft_col' => $table_heading_ft_col, 
  'table_heading_ft_style' => $table_heading_ft_style, 
  'tables_th_ft_fam' => $tables_th_ft_fam, 
  'tables_th_ft_size' => $tables_th_ft_size, 
  'tables_th_ft_wght' => $tables_th_ft_wght, 
  'tables_th_bkgrd' => $tables_th_bkgrd, 
  'tables_th_ft_col' => $tables_th_ft_col, 
  'tables_th_tx_trans' => $tables_th_tx_trans, 
  'tables_tr_ft_fam' => $tables_tr_ft_fam, 
  'tables_tr_ft_size' => $tables_tr_ft_size, 
  'tables_tr_ft_col' => $tables_tr_ft_col, 
  'tables_tr_bkgrd' => $tables_tr_bkgrd, 
  'zebra_col' => $zebra_col, 
  'link_ft_fam' => $link_ft_fam, 
  'link_ft_size' => $link_ft_size, 
  'link_ft_style' => $link_ft_style, 
  'link_tx_dec' => $link_tx_dec, 
  'link_tx_col' => $link_tx_col, 
  'link_hov_col' => $link_hov_col, 
  'sibling_tb_width' => $sibling_tb_width, 
  'sibling_tb_marg_left' => $sibling_tb_marg_left, 
  'sibling_tb_marg_right' => $sibling_tb_marg_right, 
  'spouse_tb_width' => $spouse_tb_width, 
  'spouse_tb_marg_left' => $spouse_tb_marg_left, 
  'spouse_tb_marg_right' => $spouse_tb_marg_right, 
  'children_tb_width' => $children_tb_width, 
  'children_tb_marg_left' => $children_tb_marg_left, 
  'children_tb_marg_right' => $children_tb_marg_right,

  

  
  

  

 

  


  ) );
	 }



  }





function create_css_table() {
 
  include ('tablename.php');
   
      
   $sql = "CREATE TABLE $table_name3 (
  id mediumint(9) NOT NULL AUTO_INCREMENT,

	table_heading_ft_fam varchar (40) NOT NULL,
	table_heading_ft_size varchar (5) NOT NULL,
	table_heading_ft_wght varchar (12) NOT NULL,
	table_heading_ft_col varchar (7) NOT NULL,
	table_heading_ft_style varchar (11) NOT NULL,
	tables_th_ft_fam varchar (40) NOT NULL,
	tables_th_ft_size varchar (4) NOT NULL,
	tables_th_ft_wght varchar (12) NOT NULL,

	tables_th_ft_col varchar (7) NOT NULL,
	tables_th_tx_trans varchar (10) NOT NULL,
	tables_th_bkgrd varchar (7) NOT NULL,
	tables_tr_ft_fam varchar (40) NOT NULL,
	tables_tr_ft_size varchar (4) NOT NULL,
	tables_tr_ft_col varchar (7) NOT NULL,
	tables_tr_bkgrd varchar (7) NOT NULL,
	zebra_col varchar (7) NOT NULL,
	link_ft_fam varchar (40) NOT NULL,
	link_ft_size varchar (4) NOT NULL,
	link_ft_style varchar (11) NOT NULL,
	link_tx_dec varchar (15) NOT NULL,
	link_tx_col varchar (7) NOT NULL,
	link_hov_col varchar (7) NOT NULL,
	sibling_tb_width varchar (7) NOT NULL,
	sibling_tb_marg_left varchar (12) NOT NULL,
	sibling_tb_marg_right varchar (12) NOT NULL,
	spouse_tb_width varchar (7) NOT NULL,
	spouse_tb_marg_left varchar (12) NOT NULL,
	spouse_tb_marg_right varchar (12) NOT NULL,
	children_tb_width varchar (7) NOT NULL,
	children_tb_marg_left varchar (12) NOT NULL,
	children_tb_marg_right varchar (12) NOT NULL,
	



	
	insert_number varchar (3) NOT NULL,

  UNIQUE KEY id (id)
    );";

   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
 


 

}

register_activation_hook( __FILE__, 'create_css_table' );
register_activation_hook( __FILE__, 'install_css_data' );






/* ********** CREATE THE MENU SYSTEM IN THE ADMIN AREA ********** */ 











function create_the_menus () {
	
// Create Top Admin Menu
define( 'MYPLUGINNAME_PATH', plugin_dir_url(__FILE__));

$path = MYPLUGINNAME_PATH;


    add_menu_page( 'Pedigree Chart', 'Pedigree Chart', 'manage_options', 'wdl-familytree-top-menu', 'create_main_menu',  $path.'/images/tree.gif');
	
// Stop Top Admin Menufrom appearing as a submenu
	
	add_submenu_page('wdl-familytree-top-menu','','','manage_options','wdl-familytree-top-menu','');
	
// Create Submenus	
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Start New Family', 'Start New Family', 'manage_options', 'add-submenu-start-new-family', 'start_new_family_page'); 
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Add Family Member', 'Add Family Member', 'manage_options', 'add-submenu-add-family-member', 'add_new_family_member');

	add_submenu_page( 'wdl-familytree-top-menu', 'Add Spouse', 'Add Spouse', 'manage_options', 'add-submenu-add-spouse', 'add_spouse');
		

	
	add_submenu_page( 'wdl-familytree-top-menu', 'Family Member List', 'Family Member List', 'manage_options', 'add-submenu-view-family-member', 'view_family_member');	
	

	
 	add_submenu_page( 'wdl-familytree-top-menu', 'Spouse List', 'Spouse List', 'manage_options', 'add-submenu-view-spouse', 'view_a_spouse');
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Edit Family Member', 'Edit Family Member', 'manage_options', 'add-submenu-edit-person', 'edit_person');
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Edit Marriage Date', 'Edit Marriage Date', 'manage_options', 'add-submenu-edit-marriage-date', 'edit_marriage_date');
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Broken/New Family Links', 'Edit/Create Links', 'manage_options', 'add-submenu-connect-links', 'connect_links');
	
	add_submenu_page( 'wdl-familytree-top-menu', 'Delete Family Member', 'Delete Family Member', 'manage_options', 'add-submenu-delete-person', 'delete_person');

	add_submenu_page( 'wdl-familytree-top-menu', 'Delete Marriage', 'Delete Marriage', 'manage_options', 'add-submenu-delete-marriage', 'delete_marriage_data');

	add_submenu_page( 'wdl-familytree-top-menu', 'Look and Feel', 'Look and Feel', 'manage_options', 'add-submenu-change-look', 'change_look');
	


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
    <p> If you like view more information or to view the Frequently asked Questions</p> 
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
?>
<div class="wrap">
<h2>WDL Pedigree Chart - Start A New Family</h2>
    <p>From this page you will be able to start a New Family in your family tree</p>
    <p>Enter the First Person in the Family Tree</p>
<br />
<br />
 <link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">
	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'shortcode_style.css', __FILE__ );?>">        
	
<div id="form">
  <fieldset>

  			
            	<form action="" method="post" name="new_person" enctype="multipart/form-data">
   			
            <p>	
            	<label for="first_name">First and Middle Names</label>
<br />
      			<input name="name" type="text" placeholder="Please Enter A First & Middle Name" id="name" size="50" maxlength="50" />
			</p>
    
    		<p> 
            	<label for="family_name">Family Name *</label>
<br />
      			<input name="family_name" type="text" required placeholder="Please Enter A Family Name" id="family_name"  size="50"  maxlength="50" />
    		</p>
            <br />
    		<p>
            	<label >Male / Female *</label>
<br />
				<select name="sex" required maxlength="50">
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
			<br /><br />
                		

		    <p><br /><br /><br />
      			<button>Upload Details</button>
      		</p>
            
			</form>
    
  </fieldset>
 <span class="required">Required Fields *<br />
</span> 

<?php

$n = rand(1,100);

include ('tablename.php');
	
// Run variable input through filters

$first_name = sanitize_text_field( $_POST['name'] );
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






 //Writes the information to the database 
 $wpdb->insert($table_name,array('first_name'=>$first_name,'family_name'=>$family_name,'sex'=>$sex, 'date_of_birth'=>$date_of_birth, 'date_of_death'=>$date_of_death,'family_id'=>$family_name.$n));
	


include ('auto_new_page.php');
$wpdb->insert($table_name,array('person_id'=>$id));




}










// ------------------------------------------------------------------------------------------------------------ //











//Create the Admin Sub Menu Add New Family Member Page







function add_new_family_member () {
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
	<form action="" method="post" enctype="multipart/form-data">

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
    <input name="first_name" type="text" placeholder="Please Enter A First and Middle Name" id="first_name" size="50"  maxlength="40" />
</p>
    <p> <label for="family_name">Family Name </label>
 <br /> 
    <input name="family_name" type="text" placeholder="Please Enter A Family Name" id="family_name"  size="50"  maxlength="50" />
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
<input type='hidden' name='submit' />
</p>
 <p><br /><br /><br />
    <input type="submit" name="submit" id="submit" value="Submit" />
    </p>

</form>


<span class="required">Required Fields *<br />
</span>

	</div>

<?php

if(isset($_POST['submit']))  {

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

}
}











// ------------------------------------------------------------------------------------------------------------ //











//Create the Admin Sub Menu Add New Spouse Page



function add_spouse () {
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

}











// ------------------------------------------------------------------------------------------------------------ //










//Create the Admin Sub Menu Fix Broken ar New Links Page


function connect_links () {
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
}
//End the Admin Sub Menu Fix Broken ar New Links Page













// ------------------------------------------------------------------------------------------------------------ //











//Create the Admin Sub Menu View Family Member Page


function view_family_member () {
	
?>

<div class="wrap">

    <h2>WDL Pedigree Chart - View Family Members</h2>
    <p>From this page you will be able to view your Family Members</p>
    
    <p>&nbsp;</p>

 	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'shortcode_style.css', __FILE__ );?>">        
	
<?php

	include ('tablename.php');
	

$result = $wpdb->get_results( "SELECT id, first_name, family_name, date_of_birth, date_of_death, family_id, post_id, image, birth_certificate, death_certificate FROM $table_name ORDER BY first_name " );

		


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

}

//End the Admin Sub Menu View Family Member Page











// ------------------------------------------------------------------------------------------------------------ //











//Create the Admin Sub Menu View Spouse Page
	
	global $wpdb;




	$result = $wpdb->get_results( "SELECT $table_name.first_name, $table_name.family_name, $table_name.post_id FROM $table_name JOIN $table_name2 ON ($table_name.id=$table_name2.spouse_id) WHERE ($table_name.id = $table_name2.person_id) OR ($table_name.id = $table_name2.spouse_id)" );


function view_a_spouse () {
	
?>

<div class="wrap">

    <h2>WDL Pedigree Chart - View Spouse</h2>
    <p>From this page you will be able to edit and delete Family Members</p>
    
    <p>&nbsp;</p>

 <link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'shortcode_style.css', __FILE__ );?>">        
	
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

}



//End the Admin Sub Menu View Spouse Page











//---------------------------------------------------------------------------------------------------------------------------//











//Create the Admin Sub Menu Edit Person Page

	ob_start();
	global $wpdb;




	$result = $wpdb->get_results( "SELECT $table_name.first_name, $table_name.family_name, $table_name.post_id FROM $table_name JOIN $table_name2 ON ($table_name.id=$table_name2.spouse_id) WHERE ($table_name.id = $table_name2.person_id) OR ($table_name.id = $table_name2.spouse_id)" );

 
function edit_person() {



?>

<div class="wrap">
    <?php screen_icon();?>
	<div class="wrap">
    <?php screen_icon();?>
    <br />
    <br />
    <br />
    <h2>WDL Family History and Genealogy Pedigree Chart</h2>
    <p> Thankyou for Trying out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>This Link has been deactivated in the Limited Version. <br /><br />Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with:</p>
    
    <ul>
		
        <li>- Edit Family Member Activated</li>
        <li>- Edit Marriage Date Activated</li>
        <li>- Edit/Create Links Activated</li>
        <li>- Delete Family Member Activated</li>
        <li>- Delete Marriage Activated</li>
        <li>- Change the Look and Feel to match your site</li>
		<li>- Change the Font Properties (type, color, size, decoration)</li>
		<li>- Change the Table size and location</li>
		<li>- Change the Color Properties.</li>
		<li>- Remove the Three Generation Restriction</li>
	</ul>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

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



//End the Admin Sub Menu Edit Person Page











//---------------------------------------------------------------------------------------------------------------------//











//Create the Admin Sub Menu Edit Marriage Page


function edit_marriage_date () {
	


?>

<div class="wrap">
    <?php screen_icon();?>
	<div class="wrap">
    <?php screen_icon();?>
    <br />
    <br />
    <br />
    <h2>WDL Family History and Genealogy Pedigree Chart</h2>
    <p> Thankyou for Trying out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>This Link has been deactivated in the Limited Version. <br /><br />Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with:</p>
    
    <ul>
		
        <li>- Edit Family Member Activated</li>
        <li>- Edit Marriage Date Activated</li>
        <li>- Edit/Create Links Activated</li>
        <li>- Delete Family Member Activated</li>
        <li>- Delete Marriage Activated</li>
        <li>- Change the Look and Feel to match your site</li>
		<li>- Change the Font Properties (type, color, size, decoration)</li>
		<li>- Change the Table size and location</li>
		<li>- Change the Color Properties.</li>
		<li>- Remove the Three Generation Restriction</li>
	</ul>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

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


//End the Admin Sub Menu Edit Marriage Page












//----------------------------------------------------------------------------------------------------------------------------//











// Add Delete Marriage Page



function delete_person () {


?>

<div class="wrap">
    <?php screen_icon();?>
	<div class="wrap">
    <?php screen_icon();?>
    <br />
    <br />
    <br />
    <h2>WDL Family History and Genealogy Pedigree Chart</h2>
    <p> Thankyou for Trying out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>This Link has been deactivated in the Limited Version. <br /><br />Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with:</p>
    
    <ul>
		
        <li>- Edit Family Member Activated</li>
        <li>- Edit Marriage Date Activated</li>
        <li>- Edit/Create Links Activated</li>
        <li>- Delete Family Member Activated</li>
        <li>- Delete Marriage Activated</li>
        <li>- Change the Look and Feel to match your site</li>
		<li>- Change the Font Properties (type, color, size, decoration)</li>
		<li>- Change the Table size and location</li>
		<li>- Change the Color Properties.</li>
		<li>- Remove the Three Generation Restriction</li>
	</ul>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

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









//---------------------------------------------------------------------------------------------------------------------//















// Add Delete Marriage Page



function delete_marriage_data () {


?>

<div class="wrap">
    <?php screen_icon();?>
	<div class="wrap">
    <?php screen_icon();?>
    <br />
    <br />
    <br />
    <h2>WDL Family History and Genealogy Pedigree Chart</h2>
    <p> Thankyou for Trying out the WDL Genealogy and Family History Pedigree Chart</p>

    <br />
    <br />
    <p>This Link has been deactivated in the Limited Version. <br /><br />Please Purchase the Full Version of WDL Pedigree Chart for only $9.99 AUD</p> 
    <br />
	
    <p> The Full version offers everything you see here but with:</p>
    
    <ul>
		
        <li>- Edit Family Member Activated</li>
        <li>- Edit Marriage Date Activated</li>
        <li>- Edit/Create Links Activated</li>
        <li>- Delete Family Member Activated</li>
        <li>- Delete Marriage Activated</li>
        <li>- Change the Look and Feel to match your site</li>
		<li>- Change the Font Properties (type, color, size, decoration)</li>
		<li>- Change the Table size and location</li>
		<li>- Change the Color Properties.</li>
		<li>- Remove the Three Generation Restriction</li>
	</ul>
    <a href="http://www.lyons-barton.com/wdl-pedigree-chart/" target="blank" alt="Full Version of WDL Pedigree Chart" />See What the Full Version of WDl Pedigree Chart has to offer</a>

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










// --------------------------------------------------------------------------------------------------------------------------------------//







// Add Change Look Menu

function change_look () {



	

?>
<div class="wrap">
<h2>WDL Pedigree Chart - Change the Look and Feel</h2>
    <p>From this page you will be able to change the look and feel of your site</p><br />
    

 <link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>">
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'shortcode_style.css', __FILE__ );?>">    

<?php
include ('style_info.php');





?>    
	
<div id="change_look_form">
            <div id="example">
            <p><strong>Important Notes: </strong>
            <br />
            <hr />

            <br />
           <strong> COLORS </strong>
            <br />
            Use the <a href="http://www.w3schools.com/tags/ref_colorpicker.asp" target="blank">Hexadecimal Format</a> 
            <br />
            For example: for Black use   000000 , for White use  ffffff etc
            <br />
            <br />
            <strong>No Leading # </strong>
            <br />
            <hr />
            <br />
            <strong>WIDTHS AND MARGINS</strong>
            <br />
            Use a % for both. For example: Table Width   50% , Margin Left   10% ,Margin Right  40%
            <br />
            <br />
            <hr />
            <br />
            <strong>FONT SIZE</strong>
            <br />
            Use numbers. For example: 12 or 12.5
             <br />
             <br />
            <strong>No px at the end. </strong>
            </p>
            <hr /> 
           <br />
            <strong>FONT WEIGHT</strong>
            <br />
            <br />
            bold, normal, inherit
            <br />
          
            <br />
             <strong>FONT STYLE</strong>
            <br />
            <br />
            normal, italic, oblique, inherit
            <br />
            
            <br />
               <strong>TEXT TRANSFORM</strong>
            <br />
            <br />
            none, capitalize, uppercase, lowercase, inherit
            <br />
                        <br />
              <strong>TEXT DECORATION</strong>
            <br />
            <br />
            none, underline, overline, line-through, blink, inherit
            <br />
            <br />
            <hr />
            <br />
            </div>   
  			<p><strong>Please Note:</strong> Depending on your Setup you may need to Reload the Page to view the changes</p>


<div id="change_look_outer">

<input type="button" value="Reload Page" onClick="document.location.reload(true)">

<form action="" method="post" id="change_css">
 <br /><br />



<p class="form_heading">CSS for Menu, Sibling, children, Spouse Shortcode</p>


<div id="change_look_bottom">

 <div id="change_look_left"> 
   			
   	<fieldset id="look">
   			<p class="form_heading">Menu Name</p>
          
     		<p class="form_look">	
          	Font
			
      		<input name="table_heading_ft_fam" type="text" id="table_heading_ft_fam" size="25" maxlength="40" value="<? echo htmlspecialchars($table_heading_ft_fam)?>"/>
			</p>
      		
            <p class="form_look">	
            Font Size
			
      		<input name="table_heading_ft_size" type="text" id="table_heading_ft_size" size="25" maxlength="5" value="<? echo htmlspecialchars($table_heading_ft_size)?>" />
			</p>
                  
            <p class="form_look">	
            Font Weight
			
      		<input name="table_heading_ft_wght" type="text" id="table_heading_ft_wght" size="25" maxlength="12" value="<? echo htmlspecialchars($table_heading_ft_wght)?>"/>
			</p>
            
            <p class="form_look">	
            Font Color
		
      		<input name="table_heading_ft_col" type="text" id="table_heading_ft_col" size="25" maxlength="7" value="<? echo htmlspecialchars($table_heading_ft_col)?>"/>
			</p>
            
                        <p class="form_look">	
            Font Style
		
      		<input name="table_heading_ft_style" type="text" id="table_heading_ft_style" size="25" maxlength="7" value="<? echo htmlspecialchars($table_heading_ft_style)?>"/>
			</p>

         </fieldset>




		<fieldset id="look">
   			<p class="form_heading">Menu Column Headings</p>
          
     		<p class="form_look">	
          	Font
			
      		<input name="tables_th_ft_fam" type="text" id="tables_th_ft_fam" size="25" maxlength="40" value="<? echo htmlspecialchars($tables_th_ft_fam)?>" />
			</p>
      		
            <p class="form_look">	
            Font Size
			
      		<input name="tables_th_ft_size" type="text" id="tables_th_ft_size" size="25" maxlength="5" value="<? echo htmlspecialchars($tables_th_ft_size)?>"/>
			</p>
                  
            <p class="form_look">	
            Font Weight
			
      		<input name="tables_th_ft_wght" type="text" id="tables_th_ft_wght" size="25" maxlength="12" value="<? echo htmlspecialchars($tables_th_ft_wght)?>"/>
			</p>
            
            <p class="form_look">	
            Font Color
			
      		<input name="tables_th_ft_col" type="text" id="tables_th_ft_col" size="25" maxlength="7" value="<? echo htmlspecialchars($tables_th_ft_col)?>"/>
			</p>
            
             <p class="form_look">	
            Text Transform
			
      		<input name="tables_th_tx_trans" type="text" id="tables_th_tx_trans" size="25" maxlength="11" value="<? echo htmlspecialchars($tables_th_tx_trans)?>"/>
			</p>
            
            <p class="form_look">	
            Background Color
			
      		<input name="tables_th_bkgrd" type="text" id="tables_th_bkgrd" size="25" maxlength="7" value="<? echo htmlspecialchars($tables_th_bkgrd)?>"/>
			</p>
            
      </fieldset>

		<fieldset id="look">
   			<p class="form_heading">Menu Rows</p>
          
     		<p class="form_look">	
          	Font
			
      		<input name="tables_tr_ft_fam" type="text" id="tables_tr_ft_fam" size="25" maxlength="40" value="<? echo htmlspecialchars($tables_tr_ft_fam)?>"/>
			</p>
      		
            <p class="form_look">	
            Font Size
			
      		<input name="tables_tr_ft_size" type="text" id="tables_tr_ft_size" size="25" maxlength="5" value="<? echo htmlspecialchars($tables_tr_ft_size)?>"/>
			</p>
                  
            
            <p class="form_look">	
            Font Color
			
      		<input name="tables_tr_ft_col" type="text" id="tables_tr_ft_col" size="25" maxlength="7" value="<? echo htmlspecialchars($tables_tr_ft_col)?>"/>
			</p>
            
            <p class="form_look">	
            Background Color
			
      		<input name="tables_tr_bkgrd" type="text" id="tables_tr_bkgrd" size="25" maxlength="7" value="<? echo htmlspecialchars($tables_tr_bkgrd)?>"/>
			</p>
            
                       <p class="form_look">	
            Zebra Color
			
      		<input name="zebra_col" type="text" id="zebra_col" size="25" maxlength="7" value="<? echo htmlspecialchars($zebra_col)?>"/>
			</p>
            
      </fieldset>
   </div> <!--- end change_look_left div --->  
   <div id="change_look_right">		
      
            		<fieldset id="lookcss">

   			<p class="form_heading">Menu Width and Position</p>
            

            <p class="form_subheading">Sibling Menu</p>

          
     		<p class="lookcss">	
          	Table Width
			
      		<input name="sibling_tb_width" type="text" id="sibling_tb_width" size="25" maxlength="7" value="<? echo htmlspecialchars($sibling_tb_width)?>"/>
			</p>
      		
            <p class="lookcss">	
            Margin Left
      		<input name="sibling_tb_marg_left" type="text" id="sibling_tb_marg_left" size="25" maxlength="12" value="<? echo htmlspecialchars($sibling_tb_marg_left)?>"/>
			</p>
                  
            
            <p class="lookcss">	
            Margin Right
			
      		<input name="sibling_tb_marg_right" type="text" id="sibling_tb_marg_right" size="25" maxlength="12" value="<? echo htmlspecialchars($sibling_tb_marg_right)?>" />
			</p>
            
<p class="form_subheading">Spouse Menu</p>

          
     		<p class="lookcss">	
          	Table Width
			
      		<input name="spouse_tb_width" type="text" id="spouse_tb_width" size="25" maxlength="7" value="<? echo htmlspecialchars($spouse_tb_width)?>"/>
			</p>
      		
            <p class="lookcss">	
            Margin Left
      		<input name="spouse_tb_marg_left" type="text" id="spouse_tb_marg_left" size="25" maxlength="12" value="<? echo htmlspecialchars($spouse_tb_marg_left)?>"/>
			</p>
                  
            
            <p class="lookcss">	
            Margin Right
			
      		<input name="spouse_tb_marg_right" type="text" id="spouse_tb_marg_right" size="25" maxlength="12" value="<? echo htmlspecialchars($spouse_tb_marg_right)?>"/>
			</p>
            
            <p class="form_subheading">Children Table</p>

          
     		<p class="form_look">	
          	Table Width
			
      		<input name="children_tb_width" type="text" id="children_tb_width" size="25" maxlength="7" value="<? echo htmlspecialchars($children_tb_width)?>"/>
			</p>
      		
            <p class="lookcss">	
            Margin Left
      		<input name="children_tb_marg_left" type="text" id="children_tb_marg_left" size="25" maxlength="12" value="<? echo htmlspecialchars($children_tb_marg_left)?>"/>
			</p>
                  
            
            <p class="lookcss">	
            Margin Right
			
      		<input name="children_tb_marg_right" type="text" id="children_tb_marg_right" size="25" maxlength="12" value="<? echo htmlspecialchars($children_tb_marg_right)?>" />
			</p>
            
      </fieldset>
      
      <fieldset id="lookcss">
   			<p class="form_heading">Menu Links</p>
       
     		<p class="lookcss">	
          	Font
			
      		<input name="link_ft_fam" type="text" id="link_ ft_fam" size="25" maxlength="40"  value="<? echo htmlspecialchars($link_ft_fam)?>"/>
			</p>
            
      
      		
            <p class="lookcss">	
            Font Size
			
      		<input name="link_ft_size" type="text" id="link_ ft_size" size="25" maxlength="5"  value="<? echo htmlspecialchars($link_ft_size)?>"/>
			</p>
                  
            
            <p class="lookcss">	
            Font Style
			
      		<input name="link_ft_style" type="text" id="link_ ft_style" size="25" maxlength="11"  value="<? echo htmlspecialchars($link_ft_style)?>"/>
			</p>
            
            <p class="lookcss">	
            Text Decoration
			
      		<input name="link_tx_dec" type="text" id="link_ tx_dec" size="25" maxlength="15" value="<? echo htmlspecialchars($link_tx_dec)?>" />
			</p>
            
                <p class="lookcss">	
            Link Color
			
      		<input name="link_tx_col" type="text" id="llink_tx_col" size="25" maxlength="7" value="<? echo htmlspecialchars($link_tx_col)?>" />
			</p>
            
            <p class="lookcss">	
            Link Hover
			
      		<input name="link_hov_col" type="text" id="link_hov_col" size="25" maxlength="7" value="<? echo htmlspecialchars($link_hov_col)?>" />
			</p>
            

            
      </fieldset>
   </div> <!-- end change_look_right--->   
    </div> <!-- end change_look_bottom--->   



<div id="change_look_submit">		    <p><br /><br /><br />
      			<input  type="submit" name="submit" id="submit" value="Submit" onClick="document.location.reload(true)"/>
<input type="button" value="Reload Page" onClick="document.location.reload(true)">
      		</p>


           
			</form>

<p><strong>Please Note:</strong> Depending on your Setup you may need to Reload the Page to view the changes</p>
</div> <!-- end change_look_submit div --->
</div> <!-- end change_look_outer div --->
<?php

if(isset($_POST['submit'])) {

	include ('tablename.php');
	
	// Collect data from Form for Table Name
	
    $table_heading_ft_fam = sanitize_text_field( $_POST["table_heading_ft_fam"]); 
	$table_heading_ft_fam = check_input($table_heading_ft_fam); 
	
	$table_heading_ft_size = sanitize_text_field( $_POST["table_heading_ft_size"]); 
	$table_heading_ft_size = check_input($table_heading_ft_size); 
	
	$table_heading_ft_wght = sanitize_text_field( $_POST["table_heading_ft_wght"]); 
	$table_heading_ft_wght = check_input($table_heading_ft_wght); 
	
	$table_heading_ft_col = sanitize_text_field( $_POST["table_heading_ft_col"]); 
	$table_heading_ft_col = check_input($table_heading_ft_col); 
	
	$table_heading_ft_style = sanitize_text_field( $_POST["table_heading_ft_style"]); 
	$table_heading_ft_style = check_input($table_heading_ft_style); 
	
	
	// Collect data from Form for Table Column Headings
	
    $tables_th_ft_fam = sanitize_text_field( $_POST["tables_th_ft_fam"]); 
	$tables_th_ft_fam = check_input($tables_th_ft_fam); 
	
	$tables_th_ft_size = sanitize_text_field( $_POST["tables_th_ft_size"]); 
	$tables_th_ft_size = check_input($tables_th_ft_size); 
	
	$tables_th_ft_wght = sanitize_text_field( $_POST["tables_th_ft_wght"]); 
	$tables_th_ft_wght = check_input($tables_th_ft_wght); 
	
	$tables_th_ft_col = sanitize_text_field( $_POST["tables_th_ft_col"]); 
	$tables_th_ft_col = check_input($tables_th_ft_col); 
	
	$tables_th_tx_trans = sanitize_text_field( $_POST["tables_th_tx_trans"]); 
	$tables_th_tx_trans = check_input($tables_th_tx_trans); 
	
	$tables_th_bkgrd = sanitize_text_field( $_POST["tables_th_bkgrd"]); 
	$tables_th_bkgrd = check_input($tables_th_bkgrd); 
	
	
		// Collect data from Form for Table Rows
	
    $tables_tr_ft_fam = sanitize_text_field( $_POST["tables_tr_ft_fam"]); 
	$tables_tr_ft_fam = check_input($tables_tr_ft_fam); 
	
	$tables_tr_ft_size = sanitize_text_field( $_POST["tables_tr_ft_size"]); 
	$tables_tr_ft_size = check_input($tables_tr_ft_size); 
	
	$tables_tr_ft_col = sanitize_text_field( $_POST["tables_tr_ft_col"]); 
	$tables_tr_ft_col = check_input($tables_tr_ft_col); 
	
	$tables_tr_bkgrd = sanitize_text_field( $_POST["tables_tr_bkgrd"]); 
	$tables_tr_bkgrd = check_input($tables_tr_bkgrd); 
	
	$zebra_col = sanitize_text_field( $_POST["zebra_col"]); 
	$zebra_col = check_input($zebra_col); 
	

	


	

		
	
		
$wpdb->update($table_name3,

	array(
	// Update data from Form for Table Name	
	
	'table_heading_ft_fam'=>$table_heading_ft_fam,
	'table_heading_ft_size'=>$table_heading_ft_size,
	'table_heading_ft_wght'=>$table_heading_ft_wght,
	'table_heading_ft_col'=>$table_heading_ft_col,
	'table_heading_ft_style'=>$table_heading_ft_style,


	// Update data from Form for Table Column Headings

	'tables_th_ft_fam'=>$tables_th_ft_fam,
	'tables_th_ft_size'=>$tables_th_ft_size,
	'tables_th_ft_wght'=>$tables_th_ft_wght,
	'tables_th_ft_col'=>$tables_th_ft_col,	
	'tables_th_bkgrd'=>$tables_th_bkgrd,
	'tables_th_tx_trans'=>$tables_th_tx_trans,

	// Update data from Form for Table Rows	
	
	'tables_tr_ft_fam'=>$tables_tr_ft_fam,
	'tables_tr_ft_size'=>$tables_tr_ft_size,
	'tables_tr_ft_col'=>$tables_tr_ft_col,
	'tables_tr_bkgrd'=>$tables_tr_bkgrd,
	'zebra_col'=>$zebra_col,


	


	),

	array('id'=> 1));
?>
<script type="text/javascript" src="<?php echo plugins_url( 'script.js', __FILE__ );?>"></script>
<script>
refreshPage();
</script>
<?





	
}

}









// ----------------------------------------------------------------------------------------------------------------//



// Create the Wordpress Category.

function create_wdl_category(){
	include ('tablename.php');
if ( is_term( $cat_name , 'category' ) ) {
	
	$category_exist = "yes";
	
} else {
	
	$category_exist = "no";

}

if ($category_exist = "no") {

	$cat_number = wp_create_category($cat_name);
	
 	$result = $wpdb->get_results( "SELECT * FROM $table_name4 WHERE cat_number = $cat_number ");

	$name = $wpdb->get_var( "SELECT cat_name FROM $table_name4 WHERE cat_number = $cat_number ");
	
	if ($name === $cat_name){
	
		return;
	
	} else {
		$wpdb->insert($table_name4,array('cat_number'=>$cat_number, 'cat_name'=>$cat_name));
		
		}
}

}
add_action( 'admin_init', 'create_wdl_category', 1 );






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