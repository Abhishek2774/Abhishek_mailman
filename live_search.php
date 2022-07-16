<?php  
 $search_value = $_POST["search"];
$conn = new mysqli("localhost","root","hestabit","bitmail") or die("connection failed");
$sql = "SELECT * FROM All_emails WHERE  reciver_email like '%{$search_value}%' ";//OR age Like '%{$search_value}%'
  $result = mysqli_query($conn, $sql) or die("sql query failed");
$output = "";

if(mysqli_num_rows($result) > 0){
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