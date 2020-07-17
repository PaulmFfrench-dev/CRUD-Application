<?php

$nameError="";
$ssnError="";
$deptError="";
$salaryError="";

if(isset($_POST['Submit'])){
    if(empty($_POST["EName"])){
        $nameError="Name is Required";
    }else{ 
        $Name=Test_User_Input($_POST["EName"]);
        if(!preg_match("/[a-zA-Z. ]/",$Name))
        {
		    $nameError="Only Letters and white spaces are allowed";
		}//If name is not equal to regex then replace earlier error with current
    }

    if(empty($_POST["SSN"])){
		$ssnError="SSN is Required";
	}
	else{ 
        $ssn=Test_User_Input($_POST["SSN"]);
        if(!preg_match("/(?!666|000|9\\d{2})\\d{3}-(?!00)\\d{2}-(?!0{4})\\d{4}/",$ssn))
        {
		    $ssnError="Invalid format, only use numbers";
		}
    }
    
	if(empty($_POST["Dept"])){
		$deptError="Dept is Required";
	}
	else{ 
        $dept=Test_User_Input($_POST["Dept"]);
        if(!preg_match("/[a-zA-Z.\ ]/",$dept))
        {
            $deptError="Department name is invalid";
        }
    }

    if(empty($_POST["Salary"])){
		$salaryError="Salary is Required";
	}
	else{ 
        $salary=Test_User_Input($_POST["Salary"]);
        if(!preg_match("/\d{1,6}(?:\.\d{0,2})?/",$salary))
        {
            $salaryError="Salary is not numeric";
        }
    }

    if(!empty($_POST["EName"])&&!empty($_POST["SSN"])&&!empty($_POST["Dept"])&&!empty($_POST["Salary"])){
        if((preg_match("/[a-zA-Z.\ ]/",$Name)==true)
        &&(preg_match("/(?!666|000|9\\d{2})\\d{3}-(?!00)\\d{2}-(?!0{4})\\d{4}/",$ssn)==true)
        &&(preg_match("/[a-zA-Z.\ ]/",$dept)==true)
        &&(preg_match("/\d{1,6}(?:\.\d{0,2})?/",$salary)==true))
        {
            require_once("Include/DB.php");
            $EName = $_POST["EName"];
            $SSN = $_POST["SSN"];
            $Dept = $_POST["Dept"];
            $Salary = $_POST["Salary"];
            $HomeAddress = $_POST["HomeAddress"];
            $ConnectingDB;
            $sql = "INSERT INTO emp_record(ename,ssn,dept,salary,homeaddress)
            VALUES(:enamE,:ssN,:depT,:salarY,:homeaddresS)";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':enamE',$EName);
            $stmt->bindValue(':ssN',$SSN);
            $stmt->bindValue(':depT',$Dept);
            $stmt->bindValue(':salarY',$Salary);
            $stmt->bindValue(':homeaddresS',$HomeAddress);
            $Execute = $stmt->execute();
            if ($Execute) {
                echo '<span class="success">"Record has been added successfully"</span>';
            }
        }else {
            echo  '<span class="FieldInfoHeading">"Please add your Name, SSN, dept and salary"</span>';
        }
    }

}
function Test_User_Input($Data){
    return $Data;
}  

?>


<!DOCTYPE>
<html>
	<head>
	<title> Insert data into database </title>
    <link rel="stylesheet" href="Include/style.css">
	</head>
	<body>

<?php ?>


<div class="">
    <form class="" action="Insert_into_Database.php" method="post">
        <fieldset>
            <span class="FieldInfo">Employee Name:</span>
            <input type="text" name="EName" value="">
            <span class="Error">*<?php echo $nameError; ?></span>
            <br>
            <span class="FieldInfo">Social Security Number:</span>
            <input type="text" name="SSN" value="">
            <span class="Error">*<?php echo $ssnError; ?></span>
            <br>
            <span class="FieldInfo">Department:</span>
            <input type="text" name="Dept" value="">
            <span class="Error">*<?php echo $deptError; ?></span>
            <br>
            <span class="FieldInfo">Salary:</span>
            <input type="text" name="Salary" value="">
            <span class="Error">*<?php echo $salaryError; ?></span>
            <br>
            <span class="FieldInfo">Home Address:</span>
            <br>
            <textarea name="HomeAddress" rows="8" cols="80"></textarea>
            <br>
            <input type="submit" name="Submit" value="Submit your record">
        </fieldset>
    </form>
</div>

</body>
</html>