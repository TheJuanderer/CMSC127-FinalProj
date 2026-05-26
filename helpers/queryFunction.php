<?php

//all purpose query function
include 'DBConnector.php';


function query($conn, $req){
    $result = $conn->query($req);
    return $result;
}

?>