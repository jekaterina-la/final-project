<?php 

include('process.php');

if (isset($_GET['edit'])) {
    $e_id = $_GET['edit'];
    $sql = mysqli_query($mysqli, "SELECT * FROM data WHERE id=$e_id");
    $row = mysqli_fetch_array($sql);
    $task = $row['task'];
} else {
    header("Location: /final-project/index.php");
}

if(isset($_POST['update'])) {
   $e_task = $_POST['task'];
   $query = mysqli_query($mysqli, "UPDATE data SET task='$e_task' WHERE id=$e_id");
   if($query) {
      header("Location: index.php?message=update_success");
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final project</title>

    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>

    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous">
    </script>

    <link  
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
            crossorigin="anonymous">

    <script 
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" 
            crossorigin="anonymous">
    </script>   
</head>
<body class="p-3">
    
    <div class = "container">
        <div class = "d-flex justify-content-center">
            <div class= "pr-5">
                <table class = "table">
                        <?php read(); ?>
                </table>
                <table class = "table">
                        <?php readCheck(); ?>
                </table>
            </div>
    
            <form action= "" method = "POST" role="form">
                <div class="form-group">
                    <input type="text" class= "form-control" name= "task" value = "<?= $task; ?>">
                </div>
                <div class = "form-group">
                    <input type="submit" class="btn btn-primary" name="update" value="update">
                </div>
            </form> 
        </div>
    </div>
</body>
<!-- <script>
 $(document).ready(function(){
    $('#order').sortable({
        placeholder: 'ui-state-highlight',
        update: function(event, ui) {
            var data_id_array = new Array();
            $('#order tr').each(function() {
                data_id_array.push($(this).attr("id"));
            });
            $.ajax({
                url:"update.php",
                method:"POST",
                data:{data_id_array:data_id_array}
            })
        }
    });
}); 
</script> -->
<script 
        src="/final-project/scripts.js">
</script>
</html>