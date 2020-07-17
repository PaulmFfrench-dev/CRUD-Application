<?php
require_once("Include/DB.php");
$SearchQueryParameter = $_GET["id"];
if(isset($_POST['Submit'])){

            $EName = $_POST["EName"];
            $SSN = $_POST["SSN"];
            $Dept = $_POST["Dept"];
            $Salary = $_POST["Salary"];
            $HomeAddress = $_POST["HomeAddress"];

            $ConnectingDB;
            $sql = "DELETE FROM emp_record WHERE id='$SearchQueryParameter'";
            $Execute = $ConnectingDB->query($sql);
            if ($Execute) {
                echo '<script>window.open("View_from_Database.php?id=Record Deleted Successfully","_self")</script>';
            }
        }

?>


<!DOCTYPE>
<html>
	<head>
	<title> Update database </title>
    <link rel="stylesheet" href="Include/style.css">
	</head>
	<body>

<?php 
    $ConnectingDB;
    $sql ="SELECT * FROM emp_record WHERE id='$SearchQueryParameter'";
    $stmt=$ConnectingDB->query($sql);
    while ($DataRows = $stmt->fetch()) {
        $ID = $DataRows["id"];
        $EName = $DataRows["ename"];
        $SSN = $DataRows["ssn"];
        $Department = $DataRows["dept"];
        $Salary = $DataRows["salary"];
        $HomeAddress = $DataRows["homeaddress"];
    }
?>



<div class="">
    <form class="" action="Delete.php?id=<?php echo $SearchQueryParameter; ?>" method="post">
        <fieldset>
            <span class="FieldInfo">Employee Name:</span>
            <input type="text" name="EName" value="<?php echo $EName; ?>">
            <br>
            <span class="FieldInfo">Social Security Number:</span>
            <input type="text" name="SSN" value="<?php echo $SSN; ?>">
            <br>
            <span class="FieldInfo">Department:</span>
            <input type="text" name="Dept" value="<?php echo $Department; ?>">
            <br>
            <span class="FieldInfo">Salary:</span>
            <input type="text" name="Salary" value="<?php echo $Salary; ?>">
            <br>
            <span class="FieldInfo">Home Address:</span>
            <br>
            <textarea name="HomeAddress" rows="8" cols="80"><?php echo $HomeAddress; ?></textarea>
            <br>
            <input type="submit" name="Submit" value="Delete your record">
        </fieldset>
    </form>
</div>

</body>
</html>