<?php 

$mysqli = new mysqli('mysql-server-80', 'root', 'root_password', 'web-bootcamp-db') or die(mysqli_connect_error($mysqli));

function create() {
    global $mysqli;
    if (isset($_POST['save'])) {
        $task = $_POST['task'];
        $query = mysqli_query($mysqli, "INSERT INTO data (task) VALUES('$task');");
        if ($query) {
            header("Location: /final-project/index.php?message=added_success");
        }
    }
}

create();

function read() {
    global $mysqli;
    $query = mysqli_query($mysqli, "SELECT * FROM data WHERE completed = FALSE ORDER BY id ASC");
    while ($row = mysqli_fetch_array($query)) {
        $task = $row['task'];
        $id = $row['id'];
        $completed = $row['completed'];
    
        echo "<tr>
              <td><input id='item1' name='item1' type='checkbox' value='{$completed}'></td>
              <td><label for='item1'>{$task}</label></td>
              <td><a href = 'edit.php?edit={$id}' class='btn btn-primary'>Edit</a></td>
              <td><a href = 'index.php?delete={$id}' class='btn btn-danger'>Delete</a></td>
              </tr>";
    }
}

function readCheck() {
    global $mysqli;
    $query = mysqli_query($mysqli, "SELECT * FROM data WHERE completed = TRUE ORDER BY id ASC");
    while ($row = mysqli_fetch_array($query)) {
        $task = $row['task'];
        $id = $row['id'];
        $completed = $row['completed'];
    
        echo "<tr>
              <td><input id='item1' name='item1' type='checkbox' value='{$completed}'></td>
              <td><label for='item1'>{$task}</label></td>
              <td><a href = 'index.php?delete={$id}' class='btn btn-danger'>Delete</a></td>
              </tr>";
    }
}

function editCheck() {
    global $mysqli;
if (isset($_GET['checkbox'])) {
    $c_id = $_GET['checkbox'];
    $sql = mysqli_query($mysqli, "SELECT * FROM data WHERE id=$c_id");
    $row = mysqli_fetch_array($sql);
    $completed = $row['completed'];
} else {
    header("Location: /final-project/index.php");
}
}

//editCheck();

function updateCheck() {
    global $mysqli;
    if (isset($_POST['checkbox'])) {
        $c_completed = $_POST['completed'];
        $query = mysqli_query($mysqli, "UPDATE data SET completed='$c_completed' WHERE id=$c_id");
        if ($query) {
            header("Location: /final-project/index.php?message=added_success");
        }
    }
}

//updateCheck();

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
