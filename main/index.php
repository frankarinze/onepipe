<?php
include('compare.php');
$conn = mysqli_connect("localhost", "root", "", "onepipedb");

if (isset($_POST["import"])) {  

    $fileName = $_FILES["file"]["tmp_name"];
    $fileName_two = $_FILES["file_two"]["tmp_name"];
 //insert  first csv file
    if ($_FILES["file"]["size"] > 0 || $_FILES["file_two"]["size"] > 0 ) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into tb_one (userId,fullname,answer)
                values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "')";
                    $result = mysqli_query($conn, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }  
    }
    //insert  second csv file
   
        $file_two = fopen($fileName_two, "r");
        
        while (($column = fgetcsv($file_two, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into tb_two (userId,fullname,answer)
                values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "')";
                    $result = mysqli_query($conn, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }  
    
    
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Exam Compare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
    
    </head>
    
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Exam Compare</a>
      
    </div>

    <div class="collapse navbar-collapse" id="navbar-main">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home </a></li>
        <li><a href="#">Compare</a></li>
        <li><a href="#">History</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="container box">
   <br />
   <h2 align="center">Compare submissions for similarity.</h2><br />
   
   <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
    
                <h4 align="center">Import paper one</h4>
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                

                <h4 align="center">Import paper two</h4>
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file_two"
                        id="file_two" accept=".csv">
                
                <button style="margin-top:10px;" type="submit" id="submit" name="import"
                        class="btn-submit">Compare</button>
                        </div>
            </form>
            <br />
        </div>
               <?php
            $paper_one = "SELECT * FROM tb_one";
            $result = mysqli_query($conn, $paper_one);

            $paper_two = "SELECT * FROM tb_two";
            $result_two = mysqli_query($conn, $paper_two);
            
            if (mysqli_num_rows($result) > 0) {
                ?>
            <table id='userTable'>
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Students Name</th>      
                    <th>First Answer</th>                
                </tr>
            </thead>
<?php              
                while ($row = mysqli_fetch_array($result)) {
                    ?>                  
                <tbody>
                <tr>
                    <td><?php  echo $row['userId']; ?></td>
                    <td><?php  echo $row['fullname']; ?></td>   
                    <td><?php  echo $row['answer']; ?></td>                
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php }

        //selecting paper_two
        if (mysqli_num_rows($result_two) > 0) {
            ?>
        <table id='userTable'>
        <thead>
            <tr>
                <th>Number</th>
                <th>Students Name</th>      
                <th>Second Answer</th>                
            </tr>
        </thead>
<?php              
            while ($row = mysqli_fetch_array($result_two)) {
                ?>                  
            <tbody>
            <tr>
                <td><?php  echo $row['userId']; ?></td>
                <td><?php  echo $row['fullname']; ?></td>   
                <td><?php  echo $row['answer']; ?></td>                
            </tr>
                <?php
            }
            ?>
            </tbody>
    </table>
    <?php }
         ?>


        <?php
        $sqlSelect = "SELECT * FROM tb_one";
        $result = mysqli_query($conn, $sqlSelect);
        
        $row = mysqli_fetch_array($result);

        $sqlSelect2 = "SELECT * FROM tb_two";
        $result2 = mysqli_query($conn, $sqlSelect2);
        
        $row2 = mysqli_fetch_array($result2);

$string1 = $row['answer'];
$string2= $row2['answer'];
?>
</div>

<h2>Compare result: </h2>
<?php 
$compare_result = compareStrings($string1, $string2);
?>
<p>The answers are <b><?php echo $compare_result ?>%</b> Similar</p>


 
  </div>

</div>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/custom.js"></script>
    <script src="js/main.js"></script>

</body>


</html>