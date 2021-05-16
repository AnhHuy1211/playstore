<?php
function openDB() {
    $conn = mysqli_connect("localhost","id16501783_ak2","51900@Ak1234","id16501783_doanweb");
    return $conn;
}

function closeDB($conn) {
    $conn->close();
}
?>