<?php ob_start(); ?>

<?php



include ('tablename.php');



// Obtain the id of the last person row entered in the person table



$strSql = 'select last_insert_id() as lastId';  



  $result = mysql_query($strSql);  

  

  while($row = @mysql_fetch_assoc($result)){  

  

          $id = $row['lastId'];

		  

  }



$new_post = array(



//Create the new post with titel of first_name family_name and add the shortcode to the page.



'post_title' => $first_name . " " . $family_name,



'post_content' => '[add_pedigree id = "' . $id . '"]',



'comment_status' => 'closed',



'post_status' => 'publish',



'post_author' => $user_ID,



'post_type' => 'post',



'post_name' =>$first_name . " " . $family_name,





);



$post_id = wp_insert_post($new_post, $wp_error );
include ('tablename.php');


wp_set_object_terms( $post_id, $cat_name, 'category');

$add_post = "UPDATE $table_name SET post_id = '$post_id' where id='$id'";



mysql_query($add_post) or die (mysql_error());

	

//Once the page creation has been completed forward to the view person list



header("Location: ".bloginfo('url')."/wp-admin/admin.php?page=add-submenu-view-family-member");



?>