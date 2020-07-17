<?php
require_once("Include/DB.php");
      


?>


<!DOCTYPE>
<html>
	<head>
	<title> View data from database </title>
    <link rel="stylesheet" href="Include/style.css">
	</head>
	<body>
    <h2 class="success"><?php echo @$_GET["id"]; ?></h2>
    <div>
        <fieldset>
            <form class="" action="View_from_Database.php" method="GET">
                <input type="text" name="Search" value="" placeholder="Search by name / ssn">
                <input type="Submit" name="SearchButton" value="Search record">
            </form>
        </fieldset>
    </div>
    <?php
    if(isset($_GET["SearchButton"])){
        $ConnectingDB;
        $Search=$_GET["Search"];
        $sql = "SELECT * FROM emp_record WHERE ename=:searcH OR ssn=:searcH";
        $stmt=$ConnectingDB->prepare($sql);
        $stmt->bindvalue(':searcH',$Search);
        $stmt->execute();
        while($DataRows = $stmt->fetch()){
            $ID             = $DataRows["id"];
            $EName          = $DataRows["ename"];
            $SSN            = $DataRows["ssn"];
            $Department     = $DataRows["dept"];
            $Salary         = $DataRows["salary"];
            $HomeAddress    = $DataRows["homeaddress"];
        ?>
        <div>
        <table width="1000" border="5" align="center">
            <caption>Search Result</caption>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>SSN</th>
                <th>Department</th>
                <th>Home Address</th>
                <th>Search Again</th>
            </tr>
            <tr>
                <td><?php echo $ID ?></td>
                <td><?php echo $EName ?></td>
                <td><?php echo $SSN ?></td>
                <td><?php echo $Department ?></td>
                <td><?php echo $Salary ?></td>
                <td>$HomeAddress</td>
                <td> <a href="View_from_Database.php">Search Again</a></td>
            </tr>
        </table>
        </div>
        
        
<?php      
        } //Ending of while Loop
    } //Ending of submit

?>
<table width="1000" border="5" align="center">
    <caption>View from database</caption>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>SSN</th>
            <th>Department</th>
            <th>Salary</th>
            <th>HomeAddress</th>
        </tr>
    <?php 
        $ConnectingDB;
        $sql ="SELECT * FROM emp_record";
        $stmt = $ConnectingDB->query($sql);
        while($DataRows=$stmt->fetch()){
            $ID = $DataRows["id"];
            $EName = $DataRows["ename"];
            $SSN = $DataRows["ssn"];
            $Department = $DataRows["dept"];
            $Salary = $DataRows["salary"];
            $HomeAddress = $DataRows["homeaddress"];
    ?>
    <tr>
        <td><?php echo $ID?></td>
        <td><?php echo $EName?></td>
        <td><?php echo $SSN?></td>
        <td><?php echo $Department?></td>
        <td><?php echo $Salary?></td>
        <td><?php echo $HomeAddress?></td>
        <td><a href="Update.php?id=<?php echo $ID; ?>">Update</a></td>
        <td><a href="Delete.php?id=<?php echo $ID; ?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>

<div>
   
</div>

</body>
</html>