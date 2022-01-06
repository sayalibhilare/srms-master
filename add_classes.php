<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/form.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <title>Add Class</title>
</head>
<body>
        
    <div class="title">
        <a href="dashboard.php"><img src="./images/logo1.png" alt="" class="logo"></a>
        <span class="heading">Dashboard</span>
        <a href="logout.php" style="color: white"><span class="fa fa-sign-out fa-2x">Logout</span></a>
    </div>

    <div class="nav">
        <ul>
            <li class="dropdown" onclick="toggleDisplay('1')">
                <a href="" class="dropbtn">Classes &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="1">
                    <a href="add_classes.php">Add Class</a>
                    <a href="manage_classes.php">View Class</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('2')">
                <a href="#" class="dropbtn">Students &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="2">
                    <a href="add_students.php">Add Students</a>
                    <a href="manage_students.php">Manage Students</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('3')">
                <a href="#" class="dropbtn">Results &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="3">
                    <a href="add_results.php">Add Results</a>
                    <a href="manage_results.php">Manage Results</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="main">
        <form action="" method="post">
            <fieldset>
                <legend>Add Class</legend>
                <input type="text" name="class_name" placeholder="Class Name">
                <input type="text" name="class_id" placeholder="Class ID">
                <input type="text" name="p1" id="" placeholder="ENGLISH">
                <input type="text" name="p2" id="" placeholder="MARATHI">
                <input type="text" name="p3" id="" placeholder="HINDI">
                <input type="text" name="p4" id="" placeholder="MATHEMATICS">
                <input type="text" name="p5" id="" placeholder="SCIENCE">
                <input type="text" name="p6" id="" placeholder="SOCIAL SCIENCE">
                <!-- <input type="text" name="marks" id="" placeholder="Total Marks"> -->
                <input type="submit" value="Submit" name="submit">
            </fieldset>        
        </form>
    </div>

    <div class="footer">
        <!-- <span>Designed by sayali</span> -->
    </div>
</body>
</html>

<?php 
	include('init.php');
    include('session.php');

    if(isset($_POST['class_name'],$_POST['class_id'],$_POST['p1'],$_POST['p2'],$_POST['p3'],$_POST['p4'],$_POST['p5'],$_POST['p6'])) 
    {
        $name=$_POST["class_name"];
        $id=$_POST["class_id"];
        $p1=(int)$_POST['p1'];
        $p2=(int)$_POST['p2'];
        $p3=(int)$_POST['p3'];
        $p4=(int)$_POST['p4'];
        $p5=(int)$_POST['p5'];
        $p6=(int)$_POST['p6'];
        $marks=$p1+$p2+$p3+$p4+$p5+$p6;
        // validation
        if (empty($name) or empty($id) or preg_match("/[a-z]/i",$id)) {
            if(empty($name))
                echo '<p class="error">Please enter class</p>';
            if(empty($id))
                echo '<p class="error">Please enter class id</p>';
            if(preg_match("/[a-z]/i",$id))
                echo '<p class="error">Please enter valid class id</p>';
            exit();
        }

        $sql_abc1="SELECT*FROM class WHERE id ='$id'";
      $result= $conn->query($sql_abc1);
//echo $sql_abc1;
if($result->num_rows > 0){ 
    echo '<script>alert("class-id already exist")</script>';
    
}

        else{
        $sql = "INSERT INTO `class` (`name`, `id`,`p1`,`p2`,`p3`,`p4`,`p5`,`p6`,`Total_marks`) VALUES ('$name', '$id','$p1','$p2','$p3','$p4','$p5','$p6','$marks')";
        // $result=mysqli_query($conn,$sql);
        // $row=$result->fetch_assoc();
        //  $_SESSION["user"]=$row["id"];  
        if ($conn->query($sql) === TRUE) {
            ECHO '<script>alert("NEW RECORD CREATED SUCCESFULLY")</script>';
         }  
       else{
            ECHO '<script>alert("ERROR:")</script>';
        }
    }
}

?>
