<style>

@charset "utf-8";

/* CSS Document */



/* Set the properties for the admin area forms */

form{

width:				400px;	

	}

	

form change_css{



width:				450px;	

	}

	

fieldset#look {



	border-color:				#D3D3D3;

	border-style:				solid;

	border-width:				2px;

}





fieldset#look input{

	float:						right;

	margin-right:				10px;



}



form p.form_look{

	margin-left:				10px;

	font-size: 					14px;

	line-height:				30px;



}



.form_heading {

	font-weight:		bold;

	font-size:			16px;

	padding-left:				10px;

}



.form_subheading{

	font-weight:		bold;

	font-size:			14px;

	padding:			20px 0px 20px 10px;

	text-decoration:	underline;



}

	

label {

font-weight:		bold;

line-height:		3em;

}



#look_tbl_name {

	float:				left;

}



#look_inner_tbl_heading{

	float:				right;

	

}







#inner_form{

padding-left:150px;



}







/* Set the link Properties*/

.pers_first_name_text a:link {
	
	font-family: 		Arial, Helvetica, sans-serif;

	font-size:		14px; 

	color:			#2175B4; 

	font-style:		italic;
	
	text-decoration:	none;

	

}     

.pers_first_name_text a:visited {
	
	font-family: 		Arial, Helvetica, sans-serif;

	font-size:		14px; 

	color:#2175B4; 

	font-style:	italic;

}  



.pers_first_name_text a:hover {
	
	font-family: 		Arial, Helvetica, sans-serif;

	font-size:		14px; 

	color:			#ff0000; 

	font-style:		italic;
	
	text-decoration:	underline;

}  



.pers_first_name_text a:active {
	
	font-family: 		Arial, Helvetica, sans-serif;

	font-size:		14px; 

	color:			#2175B4; 

	font-style:		italic;

} 






 	















table.menu_table  {

width:				100%;

font-family:		Tahoma, Geneva, sans-serif;

font-size:			12px;	

border-collapse:	collapse;

background:			#FFFFFF;

}

table th.menu_heading{

text-align:			left;

background-color:	#666;

line-height:		2em;

color:				#FFF;

}



table th.menu_heading_fn{

text-align:			left;

background-color:	#666;

line-height:		2em;

color:				#FFF;

width:				20%;

}

table th.menu_heading_famn{

text-align:			left;

background-color:	#666;

line-height:		2em;

color:				#FFF;

width:				15%;

}



table th.menu_heading_married{

text-align:			left;

background-color:	#666;

line-height:		2em;

color:				#FFF;

width:				20%;

}



table td.text_marriage{



font-style:			italic;

text-align:			left;





}





table th.menu_heading.small{

text-align:			center;

background-color:	#666;

width:				115px;



}



table th.menu_heading.small_l{

text-align:			left;

background-color:	#666;

width:				150px;



}







table td.small{

text-align:			center;

}



table td.medium{

text-align:			center;

}

table tr.menu_list{

text-align:			left;

border-bottom:		1px solid #CCC;

line-height:		2em;

}









/* Set the properties for the admin area table lists */



table.admin_tables  {

width:				90%;

font-family:		Tahoma, Geneva, sans-serif;

font-size:			13px;	

border-width:		0px;

}



table.admin_tables th {

text-align:			left;

background-color:	#333;

}



table.admin_tables tr {

line-height:		2em;

border-bottom:		1px solid black;

}

table tr.admin_tr{

text-align:			left;

border-bottom:		1px solid #CCC;

}





.form_error {

width:				600px;	

padding:			20px 0px 0px 20px;



}



/* Set external container for pedigree chart	*/



#container {



width:					100%;

height:					500px;

display:				inline-block;







}



#chart {



width:					550px;

height:					475px;



background-image:		url("pedigree_bk.jpg");

background-repeat:		no-repeat;

display: block;

margin-left: auto;

margin-right: auto;

}



#sibling{

display: block;

margin-left: auto;

margin-right: auto;	

}





/* Set the basis properties for the #leftdiv, #middiv, #rightdiv which hold the family members information  */



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

font-family: 		Tahoma, Geneva, sans-serif;



text-transform:		Uppercase;

font-size:			14px;

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

p{

text-shadow: 		none;

line-height:		100%;

}



p.subheading{

font-family:		Tahoma, Geneva, sans-serif;

font-weight:		bold;

font-size:			14px;	

}







.required{

font-family:		Tahoma, Geneva, sans-serif;	

font-size:			12px;	





}





#form {

width:				500px;	

}



#example {

	margin:		10px;

	line-height:	1.5em;

}



#example a:link {



	line-height:	1.5em;

}



hr {

	width:			100%;

}





/* Set spouse view properties*/



#view_spouse {

width:				100%;	

	

}



/*Set styling for shortcode tables*/












<!-- End Link Properties -->



.shortcode_outer {

	width:				100%;
	height:				100%;



}





/*End styling for shortcode tables*/





.date {	

width: 400px;

float: right;	

}



/* Style Change Look Menu Page */

fieldset {

width:				495px;

}

#change_look_form {

width:				1000px;	

}


#change_look_outer {

	width:				1000px;

}

#change_look_bottom {


	width:				1000px;

}

#change_look_top {

	width:				1000px;
	height:				850px;

}

#change_look_top_left {
	
	float:				left;

}

#change_look_top_right{
	
	float:				right;

}

#change_look_left {

	float:				left;

}

#change_look_right {

	float:				right;

}

#change_look_submit input{

	margin-top:  		20px;
	font-size:			18px;
}

#change_look_form_heading {
	
	height:			300px;



}
</style>