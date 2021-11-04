<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/student.css">
    <title>Result</title>
    <style>
        .container{
    max-width: 582px;
    border: 8px solid #166868;
    padding: 50px;
    background-color: #f1eaea;
    margin: auto;
    margin-top: 45px;
}
#one{
    font: italic bold 26px/30px Georgia, serif;
    COLOR: #a7426c;
    margin-left: 2px;
}
mark { 
  background-color: white;
  color: black;
}
        
    </style>
</head>
<body>
    <?php
        include("init.php");

        if(!isset($_GET['class']))
            $class=null;
        else
            $class=$_GET['class'];
        $rn=$_GET['rn'];

        // validation
        if (empty($class) or empty($rn) or preg_match("/[a-z]/i",$rn)) {
            if(empty($class))
                echo '<p class="error">Please select your class</p>';
            if(empty($rn))
                echo '<p class="error">Please enter your roll number</p>';
            if(preg_match("/[a-z]/i",$rn))
                echo '<p class="error">Please enter valid roll number</p>';
            exit();
        }

        $name_sql=mysqli_query($conn,"SELECT `name` FROM `students` WHERE `rno`='$rn' and `class_name`='$class'");
        while($row = mysqli_fetch_assoc($name_sql))
        {
        $name = $row['name'];
        }

        $result_sql=mysqli_query($conn,"SELECT `p1`, `p2`, `p3`, `p4`, `p5`,`p6`, `marks`, `percentage` FROM `result` WHERE `rno`='$rn' and `class`='$class'");
        while($row = mysqli_fetch_assoc($result_sql))
        {
            $p1 = $row['p1'];
            $p2 = $row['p2'];
            $p3 = $row['p3'];
            $p4 = $row['p4'];
            $p5 = $row['p5'];
            $p6 = $row['p6'];
            $mark = $row['marks'];
            $percentage = $row['percentage'];
        }
        if(mysqli_num_rows($result_sql)==0){
            echo "no result";
            exit();
        }
        $class_sql=mysqli_query($conn,"SELECT `p1`, `p2`, `p3`, `p4`, `p5`,`p6`, `Total_marks` FROM `class` WHERE `name`='$class'");
        while($row = mysqli_fetch_assoc($class_sql))
        {
            $paper1 = $row['p1'];
            $paper2 = $row['p2'];
            $paper3 = $row['p3'];
            $paper4 = $row['p4'];
            $paper5 = $row['p5'];
            $paper6 = $row['p6'];
            $marks = $row['Total_marks'];
           
        }
        
    ?>

    <div class="container">
        <div class="details">
            <p id='one'>EXAMINATION CERTIFICATE</p>
            <span>Name:</span> <?php echo $name ?> <br>
            <span>Class:</span> <?php echo $class; ?> <br>
            <span>Roll No:</span> <?php echo $rn; ?> <br>
        </div><br>
        <table class="table table-bordered table-secondary">
    <thead>
      <tr>
        <th>SUBJECTS</th>
        <th>Total Marks</th>
        <th>Marks Obtained</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>ENGLISH</td>
        <td> <?php echo '<p>'.$paper1.'</p>';?></td>
        <td><?php echo '<p>'.$p1.'</p>';?></td>
      </tr>
      <tr>
        <td>MARATHI</td>
        <td><?php echo '<p>'.$paper2.'</p>';?></td>
        <td> <?php echo '<p>'.$p2.'</p>';?></td>
      </tr>
      <tr>
        <td>HINDI</td>
        <td> <?php echo '<p>'.$paper3.'</p>';?></td>
        <td> <?php echo '<p>'.$p3.'</p>';?></td>
      </tr>
      <tr>
        <td>MATHS</td>
        <td><?php echo '<p>'.$paper4.'</p>';?></td>
        <td><?php echo '<p>'.$p4.'</p>';?></td>
      </tr>
      <tr>
        <td>SCIENCE</td>
        <td><?php echo '<p>'.$paper5.'</p>';?></td>
        <td> <?php echo '<p>'.$p5.'</p>';?></td>
      </tr>
      <tr>
        <td>SOCIAL SCIENCE</td>
        <td><?php echo '<p>'.$paper6.'</p>';?></td>
        <td> <?php echo '<p>'.$p6.'</p>';?></td>
      </tr>
    </tbody>
  </table>
        
        <div class="result">
            <?php echo '<p>Total Marks:&nbsp'.$mark.'/'.$marks.'</p>';?>
            <?php echo '<p>Percentage:&nbsp'.$percentage.'%</p>';?>
            <?php if($percentage>50 and $p1>50 and  $p2>50 and  $p3>50 and  $p4>50 and  $p5>50 and   $p6>50) 
               {
              echo '<p id="two">Result:<mark>Pass</mark></p>';
            }
            else{
                echo'<p id="two">Result:<mark>Fail</mark></p>';
            }
            ?>

        </div>

        <div class="button">
            <button onclick="window.print()">Print Result</button>
        </div>
    </div>
</body>
</html>