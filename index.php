<?php
    require "config.php";
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
            <input type="text" name="task" required><br>
            <button type="submit" name="submit">Add Task</button>
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