<?php
include "./config.php";
include "db.php";
$conn = open_database();
session_start();

if(isset($_REQUEST["term"])){
    $sql = "SELECT * FROM trangchu WHERE gamename LIKE ?";

    if($stmt = mysqli_prepare($conn, $sql)){

        mysqli_stmt_bind_param($stmt, "s", $param_term);

        $param_term = $_REQUEST["term"] . '%';

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo '<li class="list-group-item search-result-item">'
                        .'<a class="text-dark" href="./trangChuTimKiem.php?gameid='.$row['gameid'].'">'.$row['gamename'].'</a>
                        </li>';
                }
            }
        } else{
            echo "Lỗi: $sql. " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
// close connection
closeDB($conn);
?>