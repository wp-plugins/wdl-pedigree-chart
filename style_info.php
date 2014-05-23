<?php



 include ('tablename.php');

 

 $result = $wpdb->get_results( "SELECT * FROM $table_name3 WHERE insert_number = 1 ");

 $table_heading_ft_fam = $wpdb->get_var( "SELECT table_heading_ft_fam FROM $table_name3 WHERE insert_number = 1 ");

 $table_heading_ft_size = $wpdb->get_var( "SELECT table_heading_ft_size FROM $table_name3 WHERE insert_number = 1 ");

 $table_heading_ft_wght = $wpdb->get_var( "SELECT table_heading_ft_wght FROM $table_name3 WHERE insert_number = 1 ");

 $table_heading_ft_col = $wpdb->get_var( "SELECT table_heading_ft_col FROM $table_name3 WHERE insert_number = 1 ");

 $table_heading_ft_style = $wpdb->get_var( "SELECT table_heading_ft_style FROM $table_name3 WHERE insert_number = 1 ");

 

 $tables_th_ft_fam = $wpdb->get_var( "SELECT tables_th_ft_fam FROM $table_name3 WHERE insert_number = 1 ");

 $tables_th_ft_size = $wpdb->get_var( "SELECT tables_th_ft_size FROM $table_name3 WHERE insert_number = 1 ");

 $tables_th_ft_wght = $wpdb->get_var( "SELECT tables_th_ft_wght FROM $table_name3 WHERE insert_number = 1 ");

 $tables_th_bkgrd  = $wpdb->get_var( "SELECT tables_th_bkgrd FROM $table_name3 WHERE insert_number = 1 ");

 $tables_th_ft_col = $wpdb->get_var( "SELECT tables_th_ft_col FROM $table_name3 WHERE insert_number = 1 ");

 $tables_th_tx_trans = $wpdb->get_var( "SELECT tables_th_tx_trans FROM $table_name3 WHERE insert_number = 1 ");

 

 $tables_tr_ft_fam = $wpdb->get_var( "SELECT tables_tr_ft_fam FROM $table_name3 WHERE insert_number = 1 ");

 $tables_tr_ft_size = $wpdb->get_var( "SELECT tables_tr_ft_size FROM $table_name3 WHERE insert_number = 1 ");

 $tables_tr_ft_col  = $wpdb->get_var( "SELECT tables_tr_ft_col FROM $table_name3 WHERE insert_number = 1 ");

 $tables_tr_bkgrd = $wpdb->get_var( "SELECT tables_tr_bkgrd FROM $table_name3 WHERE insert_number = 1 ");

 $zebra_col = $wpdb->get_var( "SELECT zebra_col FROM $table_name3 WHERE insert_number = 1 ");

 

 $link_ft_fam = $wpdb->get_var( "SELECT link_ft_fam FROM $table_name3 WHERE insert_number = 1 ");

 $link_ft_size = $wpdb->get_var( "SELECT link_ft_size FROM $table_name3 WHERE insert_number = 1 ");

 $link_ft_style  = $wpdb->get_var( "SELECT link_ft_style FROM $table_name3 WHERE insert_number = 1 ");

 $link_tx_dec = $wpdb->get_var( "SELECT link_tx_dec FROM $table_name3 WHERE insert_number = 1 ");

 $link_tx_col = $wpdb->get_var( "SELECT link_tx_col FROM $table_name3 WHERE insert_number = 1 ");

 $link_hov_col = $wpdb->get_var( "SELECT link_hov_col FROM $table_name3 WHERE insert_number = 1 ");

 

 

 $sibling_tb_width = $wpdb->get_var( "SELECT sibling_tb_width FROM $table_name3 WHERE insert_number = 1 ");

 $sibling_tb_marg_left = $wpdb->get_var( "SELECT sibling_tb_marg_left FROM $table_name3 WHERE insert_number = 1 ");

 $sibling_tb_marg_right  = $wpdb->get_var( "SELECT sibling_tb_marg_right FROM $table_name3 WHERE insert_number = 1 ");

 $spouse_tb_width = $wpdb->get_var( "SELECT spouse_tb_width FROM $table_name3 WHERE insert_number = 1 ");

 $spouse_tb_marg_left = $wpdb->get_var( "SELECT spouse_tb_marg_left FROM $table_name3 WHERE insert_number = 1 ");

 $spouse_tb_marg_right = $wpdb->get_var( "SELECT spouse_tb_marg_right FROM $table_name3 WHERE insert_number = 1 ");

 $children_tb_width  = $wpdb->get_var( "SELECT children_tb_width FROM $table_name3 WHERE insert_number = 1 ");

 $children_tb_marg_left = $wpdb->get_var( "SELECT children_tb_marg_left FROM $table_name3 WHERE insert_number = 1 ");

 $children_tb_marg_right = $wpdb->get_var( "SELECT children_tb_marg_right FROM $table_name3 WHERE insert_number = 1 ");




 	$wdl_title_profile_width = $wpdb->get_var( "SELECT wdl_title_profile_width FROM $table_name3 WHERE insert_number = 1 ");
	
	$wdl_title_text_ft_width = $wpdb->get_var( "SELECT wdl_title_text_ft_width FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_text_float = $wpdb->get_var( "SELECT wdl_title_text_float FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_text_pd_top = $wpdb->get_var( "SELECT wdl_title_text_pd_top FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_text_pd_left = $wpdb->get_var( "SELECT wdl_title_text_pd_left FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_text_pd_right = $wpdb->get_var( "SELECT wdl_title_text_pd_right FROM $table_name3 WHERE insert_number = 1 ");

	$wdl_first_middle_names_ft_align = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_align FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_first_middle_names_ft_family = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_family FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_first_middle_names_ft_weight = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_weight FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_first_middle_names_ft_color = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_first_middle_names_ft_size = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_size FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_first_middle_names_ft_style = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_style FROM $table_name3 WHERE insert_number = 1 ");
	
	$wdl_family_name_ft_align = $wpdb->get_var( "SELECT wdl_family_name_ft_align FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_family = $wpdb->get_var( "SELECT wdl_family_name_ft_family FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_weight = $wpdb->get_var( "SELECT wdl_family_name_ft_weight FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_color = $wpdb->get_var( "SELECT wdl_family_name_ft_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_size = $wpdb->get_var( "SELECT wdl_family_name_ft_size FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_style = $wpdb->get_var( "SELECT wdl_family_name_ft_style FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_transform =	$wpdb->get_var( "SELECT wdl_family_name_ft_transform FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_text_pd_top =	$wpdb->get_var( "SELECT wdl_family_name_text_pd_top FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_text_pd_bottom = $wpdb->get_var( "SELECT wdl_family_name_text_pd_bottom FROM $table_name3 WHERE insert_number = 1 ");

	$wdl_maiden_name_ft_align = $wpdb->get_var( "SELECT wdl_maiden_name_ft_align FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_family = $wpdb->get_var( "SELECT wdl_maiden_name_ft_family FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_weight = $wpdb->get_var( "SELECT wdl_maiden_name_ft_weight FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_color = $wpdb->get_var( "SELECT wdl_maiden_name_ft_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_size = $wpdb->get_var( "SELECT wdl_maiden_name_ft_size FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_style = $wpdb->get_var( "SELECT wdl_maiden_name_ft_style FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_transform =	$wpdb->get_var( "SELECT wdl_maiden_name_ft_transform FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_text_pd_top =	$wpdb->get_var( "SELECT wdl_maiden_name_text_pd_top FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_text_pd_bottom = $wpdb->get_var( "SELECT wdl_maiden_name_text_pd_bottom FROM $table_name3 WHERE insert_number = 1 ");
	
	$wdl_nee_ft_align = $wpdb->get_var( "SELECT wdl_nee_ft_align FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_family = $wpdb->get_var( "SELECT wdl_nee_ft_family FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_weight = $wpdb->get_var( "SELECT wdl_nee_ft_weight FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_color = $wpdb->get_var( "SELECT wdl_nee_ft_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_size = $wpdb->get_var( "SELECT wdl_nee_ft_size FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_style = $wpdb->get_var( "SELECT wdl_nee_ft_style FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_transform =	$wpdb->get_var( "SELECT wdl_nee_ft_transform FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_text_pd_left =	$wpdb->get_var( "SELECT wdl_nee_text_pd_left FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_text_pd_right = $wpdb->get_var( "SELECT wdl_nee_text_pd_right FROM $table_name3 WHERE insert_number = 1 ");
	
	$wdl_dates_ft_align =$wpdb->get_var( "SELECT wdl_dates_ft_align FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_dates_ft_family = $wpdb->get_var( "SELECT wdl_dates_ft_family FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_dates_ft_weight = $wpdb->get_var( "SELECT wdl_dates_ft_weight FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_dates_ft_color = $wpdb->get_var( "SELECT wdl_dates_ft_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_dates_ft_size = $wpdb->get_var( "SELECT wdl_dates_ft_size FROM $table_name3 WHERE insert_number = 1 ");
	
	$wdl_profile_image_pd_left = $wpdb->get_var( "SELECT wdl_profile_image_pd_left FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_profile_image_pd_right = $wpdb->get_var( "SELECT wdl_profile_image_pd_right FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_profile_image_float = $wpdb->get_var( "SELECT wdl_profile_image_float FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_profile_image_width = $wpdb->get_var( "SELECT wdl_profile_image_width FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_profile_image_height = $wpdb->get_var( "SELECT wdl_profile_image_height FROM $table_name3 WHERE insert_number = 1 ");
 

  ?>

  	<style>

#leftdiv, #middiv, #rightdiv{

	float:				left;	

	height:				400px;

	width:				33%;



}

/* Set the size and font properties for the containers that contain the Person information */



#pers1, #pers2, #pers3, #pers4, #pers5, #pers6, #pers7{



	width:				160px;

	font-size:			12px;

	color:				#000000;

	height:				56px;

}


/* Set the top position for each of the person containers*/



#pers1 {



margin-top: 		172px;

margin-left:		10px;

width:				150px;



}



#pers2 {



margin-top: 		58px;

margin-left:		10px;	

}



#pers3 {



margin-top: 		172px;

margin-left:		10px;	

}



#pers4 {



margin-top: 		2px;

margin-left:		25px;	

}



#pers5 {



margin-top: 		56px;

margin-left:		25px; 	

}



#pers6 {



margin-top: 		60px;

margin-left:		25px;	

}



#pers7 {



margin-top: 		56px;

margin-left:		25px; 	

}







/* Remove the box shadow and border of the two tree image files */



img.midline, img.rightline{

box-shadow: 0 0px 0px;	

border:				none;



}

/* Set the font properties for the person name */



.pers_family_name_text{

font-family: 		font-family:	Arial, Helvetica, sans-serif;;

text-transform:		Uppercase;

font-size:			11px;

text-shadow: 		none;

line-height:		200%;



}



.first_name_text{

font-family: 		Arial, Helvetica, sans-serif;

font-size:			14px;

text-shadow: 		none;	

font-style:			italic;



}





/*  Set the font properties for the birth and Death dates  */

.pers_det_text{

font-size:			11px;

font-weight:		bold;

text-shadow: 		none;	



}	

	/* These settings are not changeable*/
	
#children_inner table {
	
	width:				100%;
}



	table.spouse_table {

	font-family:		Tahoma, Geneva, sans-serif;

	width:				550px;



}



/* These settings are changeable*/

	.table_heading {



	font-family:		<? echo $table_heading_ft_fam; ?>;

	font-weight:		<? echo $table_heading_ft_wght; ?>;

	font-size:			<? echo $table_heading_ft_size; ?>px;

	color:				#<? echo $table_heading_ft_col; ?>;

	font-style:			<? echo $table_heading_ft_style; ?>;

	

	}

	

	table.shortcode_tables th {

	font-family:		<? echo $tables_th_ft_fam; ?>;

	font-size:			<? echo $tables_th_ft_size; ?>px;

	font-weight:		<? echo $tables_th_ft_wght; ?>;

	background:			#<? echo $tables_th_bkgrd; ?>;	

	color: 				#<? echo $tables_th_ft_col; ?>;

	text-transform:		<? echo $tables_th_tx_trans ?>;

}





	table.shortcode_tables tr {

	font-family:		<? echo $tables_tr_ft_fam; ?>;

	font-size:			<? echo $tables_tr_ft_size; ?>px;

	color: 				#<? echo $tables_tr_ft_col; ?>;

	background:			#<? echo $tables_tr_bkgrd; ?>;

}





	table.shortcode_tables tr:nth-of-type(odd) {

  	background-color:	#<? echo $zebra_col?>;

}



<!-- Set Link Properties -->



/* Remove the standard link Properties*/

.menu_link a:link {



	

}     

.menu_link a:visited {



}  



.menu_link a:hover {



}  



.menu_link a:active {



} 



/* Set the new link Properties*/

table.shortcode_tables a:link {

	

	font-family:		<? echo $link_ft_fam; ?>;

	font-size:		 	<? echo $link_ft_size; ?>px;

	font-style:			<? echo $link_ft_style; ?>;

	text-decoration:	<? echo $link_tx_dec; ?>;

	color:				#<? echo $link_tx_col; ?>;



}



table.shortcode_tables a:visited {

	

	font-family:		<? echo $link_ft_fam; ?>;

	font-size:		 	<? echo $link_ft_size; ?>px;

	font-style:			<? echo $link_ft_style; ?>;

	text-decoration:	<? echo $link_tx_dec; ?>;	

	color:				#<? echo $link_tx_col; ?>;



}



table.shortcode_tables a:active {

	

	font-family:		<? echo $link_ft_fam; ?>;

	font-size:		 	<? echo $link_ft_size; ?>px;

	font-style:			<? echo $link_ft_style; ?>;

	text-decoration:	<? echo $link_tx_dec; ?>;

	color:				#<? echo $link_tx_col; ?>;	



}





table.shortcode_tables a:hover {



	color:				#<? echo $link_hov_col; ?>;

}



/*Set Shortcode Alignment*/



.sibling_inner {

	padding-top:		30px;

	width:				<? echo $sibling_tb_width; ?>;

	margin-left: 		<? echo $sibling_tb_marg_left; ?>;

	margin-right:		<? echo $sibling_tb_marg_right; ?>;

}



.spouse_inner {

	padding-top:		30px;

	width:				<? echo $spouse_tb_width; ?>;

	margin-left: 		<? echo $spouse_tb_marg_left; ?>;

	margin-right:		<? echo $spouse_tb_marg_right; ?>;

}



.children_inner {

	padding-top:		30px;

	width:				<? echo $children_tb_width; ?>;

	margin-left: 		<? echo $children_tb_marg_left; ?>;

	margin-right:		<? echo $children_tb_marg_right; ?>;

}

/* These settings are not changeable*/

#wdl_title_container {

	width:					100%;
	height:					250px;

	
}

#wdl_title_profile {

	width:					95%;
	

}



/* These settings are changeable*/



#wdl_title_text {


	width:					<? echo $wdl_title_text_ft_width; ?>%;
	float:					<? echo $wdl_title_text_float; ?>;	
	padding-top:			<? echo $wdl_title_text_pd_top; ?>px;
	padding-left:			<? echo $wdl_title_text_pd_left; ?>px;
	padding-right:			<? echo $wdl_title_text_pd_right; ?>px;
	


}

#wdl_first_middle_names {
	
	
	text-align:				<? echo $wdl_first_middle_names_ft_align; ?>;
	font-family:			<? echo $wdl_first_middle_names_ft_family; ?>;
	font-weight:			<? echo $wdl_first_middle_names_ft_weight; ?>;
	color:					#<? echo $wdl_first_middle_names_ft_color; ?>;
	font-size:				<? echo $wdl_first_middle_names_ft_size; ?>px;
	font-style:				<? echo $wdl_first_middle_names_ft_style; ?>;


}

.wdl_family_name {
	
	
	text-align:				<? echo $wdl_family_name_ft_align; ?>;
	font-family:			<? echo $wdl_family_name_ft_family; ?>;
	font-weight:			<? echo $wdl_family_name_ft_weight; ?>;
	color:					#<? echo $wdl_family_name_ft_color; ?>;
	font-size:				<? echo $wdl_family_name_ft_size; ?>px;
	font-style:				<? echo $wdl_family_name_ft_style; ?>;
	text-transform:			<? echo $wdl_family_name_ft_transform; ?>;
	padding-top:			<? echo $wdl_family_name_text_pd_top; ?>px;
	padding-bottom:			<? echo $wdl_family_name_text_pd_bottom; ?>px;
}

.wdl_maiden_name {
	
	
	text-align:				<? echo $wdl_maiden_name_ft_align; ?>;
	font-family:			<? echo $wdl_maiden_name_ft_family; ?>;
	font-weight:			<? echo $wdl_maiden_name_ft_weight; ?>;
	color:					#<? echo $wdl_maiden_name_ft_color; ?>;
	font-size:				<? echo $wdl_maiden_name_ft_size; ?>px;
	font-style:				<? echo $wdl_maiden_name_ft_style; ?>;
	text-transform:			<? echo $wdl_maiden_name_ft_transform; ?>;
	padding-top:			<? echo $wdl_maiden_name_text_pd_top; ?>px;
	padding-bottom:			<? echo $wdl_maiden_name_text_pd_bottom; ?>px;
}
.wdl_nee {
	text-align:				<? echo $wdl_nee_ft_align; ?>;
	font-family:			<? echo $wdl_nee_ft_family; ?>;
	font-weight:			<? echo $wdl_nee_ft_weight; ?>;
	color:					#<? echo $wdl_nee_ft_color; ?>;
	font-size:				<? echo $wdl_nee_ft_size; ?>px;
	font-style:				<? echo $wdl_nee_ft_style; ?>;
	text-transform:			<? echo $wdl_nee_ft_transform; ?>;
	padding-left:			<? echo $wdl_nee_text_pd_left; ?>px;
	padding-right:			<? echo $wdl_nee_text_pd_right; ?>px;
	
}

.wdl_dates {
	

	text-align:				<? echo $wdl_dates_ft_align; ?>;
	font-family:			<? echo $wdl_dates_ft_family; ?>;
	font-weight:			<? echo $wdl_dates_ft_weight; ?>;
	color:					#<? echo $wdl_dates_ft_color; ?>;
	font-size:				<? echo $wdl_dates_ft_size; ?>px;

}

#wdl_profile_image { 

	float:					<? echo $wdl_profile_image_float; ?>;
	padding-left:			<? echo $wdl_profile_image_pd_left; ?>px;
	padding-right:			<? echo $wdl_profile_image_pd_right; ?>px;
	width:					150px;
	height:					200px;

}


	</style>

 

