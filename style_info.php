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





 

  ?>

  	<style>

	

	/* These settings are not changeable*/

	table.shortcode_tables {

	font-family:		Tahoma, Geneva, sans-serif;

	width:				100%;



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

a:link {



	

}     

a:visited {



}  



a:hover {



}  



a:active {



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

	width:				<? echo $sibling_tb_width; ?>;

	margin-left: 		<? echo $sibling_tb_marg_left; ?>;

	margin-right:		<? echo $sibling_tb_marg_right; ?>;

}



.spouse_inner {

	width:				<? echo $spouse_tb_width; ?>;

	margin-left: 		<? echo $spouse_tb_marg_left; ?>;

	margin-right:		<? echo $spouse_tb_marg_right; ?>;

}



.children_inner {

	width:				<? echo $children_tb_width; ?>;

	margin-left: 		<? echo $children_tb_marg_left; ?>;

	margin-right:		<? echo $children_tb_marg_right; ?>;

}



	</style>

 

