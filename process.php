<?php 

$mysqli = new mysqli('mysql-server-80', 'root', 'root_password', 'web-bootcamp-db') or die(mysqli_connect_error($mysqli));

function create() {
    global $mysqli;
    if (isset($_POST['save'])) {
        $task = $_POST['task'];
        $order = mysqli_query($mysqli, "SELECT data_order FROM data ORDER BY data_order DESC LIMIT 1");

        while ($row = mysqli_fetch_array($order)) {
            $dataOrder = $row['data_order'];
        }

        $dataOrder = $dataOrder + 1;
        $query = mysqli_query($mysqli, "INSERT INTO data (task,data_order) VALUES('$task', '$dataOrder')");

        if ($query) {
            header("Location: /final-project/index.php?message=added_success");
        }
    }
}

create();

function read() {
    global $mysqli;
    $query = mysqli_query($mysqli, "SELECT * FROM data WHERE completed = FALSE ORDER BY data_order ASC");
    while ($row = mysqli_fetch_array($query)) {
        $task = $row['task'];
        $id = $row['id'];
    
        echo "<tr>
              <td><input id='item1' data-id='{$id}' name='item1' type='checkbox' value='1'></td>
              <td><label for='item1'>{$task}</label></td>
              <td><a href = 'edit.php?edit={$id}' class='btn btn-success'>Edit</a></td>
              <td><a href = 'index.php?delete={$id}' class='btn btn-warning'>Delete</a></td>
              </tr>";
    }
}

function readCheck() {
    global $mysqli;
    $query = mysqli_query($mysqli, "SELECT * FROM data WHERE completed = TRUE ORDER BY id ASC");
    while ($row = mysqli_fetch_array($query)) {
        $task = $row['task'];
        $id = $row['id'];
    
        echo "<tr>
              <td><input id='item1' data-id='{$id}' name='item1' type='checkbox' value='0' checked></td>
              <td><label for='item1'><del>{$task}</del></label></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><a href = 'index.php?delete={$id}' class='btn btn-warning'>Delete</a></td>
              </tr>";
    }
}

function editCheck() {
    global $mysqli;
    $c_id = $_GET['id'];
    $sql = mysqli_query($mysqli, "SELECT * FROM data WHERE id=$c_id");
    $row = mysqli_fetch_array($sql);
    $completed = $row['completed'];
} 

if (isset($_GET['id'])) {
   editCheck();
}

function updateCheck() {
    global $mysqli;
    $c_completed = $_GET['completed'];
    $c_id = $_GET['id'];
    $query = mysqli_query($mysqli, "UPDATE data SET completed='$c_completed' WHERE id=$c_id");
    if ($query) {
        header("Location: /final-project/index.php?message=added_success");
    }
}

if (isset($_GET['completed']) && ($_GET['id'])) {
   updateCheck();
}

function delete_data() {
    global $mysqli;
    if (isset($_GET['delete'])) {
        $d_id = $_GET['delete'];
        $query = mysqli_query($mysqli, "DELETE FROM data WHERE id=$d_id");
        if ($query) {
            header("Location: index.php?message=delete_success");
        }
    }
}

delete_data();
