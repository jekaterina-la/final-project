<?php

$mysqli = new mysqli('mysql-server-80', 'root', 'root_password', 'web-bootcamp-db') or die(mysqli_connect_error($mysqli));

for($i = 0; $i<$_POST["data_id_array"]; $i++) {
    $query = "UPDATE data SET data_order = '".$i."' WHERE id = '".$_POST["data_id_array"][$i]."'";
    mysqli_query($mysqli, $query);
}

?>