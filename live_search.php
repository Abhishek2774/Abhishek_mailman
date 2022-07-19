<?php  
include "autoload.php";
$gobj = new Database();
$limit_per_page = 10;

$page ="";
$login_user = $_SESSION['login_user_Email'];
if(isset($_POST['page_no'])){
    $page = $_POST['page_no'];
}else
{
    $page = 1;
}
    $offset = ($page -1)* $limit_per_page;

 $search_value = $_POST["search"];
$sql = "SELECT * FROM All_emails WHERE  subject like '%$search_value%' ORDER BY id DESC LIMIT {$offset},{$limit_per_page}";
 $result = $gobj->mysqli->query($sql) or die("sql query failed");
 $row =$result->fetch_all(MYSQLI_ASSOC);
$output = "";

if($result->num_rows > 0){
  foreach($row as $key => $val){
    $output .="<tr>
                <td><input type='checkbox'></td>
                <td>".$val["reciver_email"]."</td>
                <td>".$val["subject"]."</td>
                <td>".$val["datetime"]."</td>
                </tr>";
  } 

//   $sql = "SELECT * FROM All_emails WHERE reciver_email='$login_user' AND reciver_status=1 ";
//   $result = $gobj->mysqli->query($sql)or die("Query failed");
//   $total_record =($result->num_rows >0);
// echo $total_record;
// die();
//   $total_pages =ceil($total_record/$limit_per_page);   
//   $output .='<div id="pagination" class="d-flex">';
//       for($i=1; $i <= $total_pages; $i++){
//           $output.="<a class='page-link' id='{$i}' href='#'>{$i}</a>";
//       }
// $output .='</div>';

  echo json_encode(["status" => true, "message" => "html_data_found", "tablehtml" => $output]);

}else{
  echo json_encode(["status" => false, "message" => "Data Not found"]);
  
 }



?>