<?php
    require "config.php";
    $updatebutton = false;
    $id = 0;
    if(isset($_POST['submit'])){
        $task = $_POST['task'];
        $query = mysqli_query($conn,"INSERT INTO tasks(task) VALUES('$task')");
        header('Location:index.php');
    }
    $query2 = mysqli_query($conn,"SELECT * FROM tasks");
    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        $query3 = mysqli_query($conn,"DELETE FROM tasks where id = $id");
        header('Location:index.php');
    }   
    if(isset($_GET['update_task'])){
        $id = $_GET['update_task'];
        $query4 = mysqli_query($conn,"SELECT * FROM tasks WHERE id = $id");
        $row = mysqli_fetch_array($query4);
        $updatedtask = $row['task'];
        $updatebutton = true;
    }
    else{
        $updatedtask = "";
    }
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $task = $_POST['task'];
        $query5 = mysqli_query($conn,"UPDATE tasks SET task = '$task' WHERE id = $id");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Todo List</title>
</head>
<body>
    <div class="container">
        <header class="header">
            <h3>Todo List</h3>
        </header>
        <form action="index.php" autocomplete="off" method="POST">
            <input type="hidden" name = "id" value="<?=$id?>"/>
            <input type="text" name="task" value = "<?=$updatedtask?>" required><br>
            <?php
            if($updatebutton == true){?>
                <button type="submit" name="update">Update</button>
            <?php 
            }else{
            ?>
                <button type="submit" name="submit">Add Task</button>
            <?php
            }
            ?>
            
        </form>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tasks</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = 1;
                while($row = mysqli_fetch_array($query2)){
                ?>
                <tr>
                    <td style="text-align: center;"><?=$id?>.</td>
                    <td class="task"><?=$row['task']?></td>
                    <td class="delete">
                        <a href="index.php?del_task=<?=$row['id']?>">X</a>
                    </td>
                    <td class="update">
                        <a href="index.php?update_task=<?=$row['id']?>">Edit</a>
                    </td>
                </tr>
                <?php
                $id++;
            }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>