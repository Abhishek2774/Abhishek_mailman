<?php
session_start();
include "autoload.php";
$gobj = new Database();

$limit_per_page = 10;

$page = "";
$login_user = $_SESSION['login_user_Email'];
if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit_per_page;

$sql = "SELECT * FROM All_emails WHERE (((sender_status=0 and reciver_status=1) or
    (sender_status=0 and reciver_status=0)) and sender_email='$login_user') or (reciver_email='$login_user' and 
   (reciver_status=0 and sender_status=1)) ORDER BY id DESC LIMIT {$offset},{$limit_per_page}";
$result = $gobj->mysqli->query($sql) or die("Query failed");
$output = "";
if ($result->num_rows > 0) {

    $output .= '<table>
    <tr>
        <th id="col_head" scope="col"><h4>Trash</h4></th>
        <th id="col_head" scope="col">Draft@mailman.com</th>
        <th id="col_head" scope="col">Email Subject</th>
        <th id="col_head" scope="col">YY/MM/DD</th>
        <th id="col_head" scope="col"></th>
        </tr>';

    while ($row = $result->fetch_assoc()) {

        $output .= "<tr class='rowclick' data-id='{$row["id"]}'><td><input type='checkbox' class='check' data-id='{$row["id"]}'></td><td>{$row["reciver_email"]}</td><td>{$row["subject"]}</td><td>{$row["datetime"]}</td></tr>";
    }
    $output .= "</table>";


    $sql = "SELECT * FROM All_emails WHERE (((sender_status=0 and reciver_status=1) or
    (sender_status=0 and reciver_status=0)) and sender_email='$login_user') or (reciver_email='$login_user' and 
   (reciver_status=0 and sender_status=1))";

    $result = $gobj->mysqli->query($sql) or die("Query failed");
    $total_record = mysqli_num_rows($result);
    // echo $total_record;
    $total_pages = ceil($total_record / $limit_per_page);
    // echo $total_pages;
    $output .= '<div id="pagination" class="d-flex">';
    for ($i = 1; $i <= $total_pages; $i++) {
        $output .= "<a class='page-link' id='{$i}' href='#'>{$i}</a>";
    }
    $output .= '</div>';
    echo $output;
} else {
    echo "No Record Found";
}
