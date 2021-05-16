<?php
function openDB() {
    $conn = mysqli_connect("remotemysql.com","oTP4am9uMs","hGgwg6q1aC","oTP4am9uMs");
    return $conn;
}

function closeDB($conn) {
    $conn->close();
}
?>
