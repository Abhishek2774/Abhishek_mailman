<?php  
include "autoload.php";
$gobj = new Database();
 $search_value = $_POST["search"];
$sql = "SELECT * FROM All_emails WHERE  subject like '%{$search_value}%' ";
  $result = $gobj->mysqli->query($sql) or die("sql query failed");
$output = "";

if($gobj->mysqli->num_rows > 0){
    $output .= '<table border="1" width="100px" cellspacing="0" cellpadding="10px">';
            while($row = mysqli_fetch_assoc($result)){
                
                $output .="<tr>
                <td><input type='checkbox'></td>
                <td>{$row["reciver_email"]}</td>
                <td>{$row["subject"]}</td>
                <td>{$row["datetime"]}</td>
                </tr>";
                $output.="</table>";
            }
           
            echo $output;

}else{ echo "result not Found"; }



?>