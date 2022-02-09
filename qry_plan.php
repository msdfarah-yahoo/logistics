<?php 
include("header.php");
include("db.php");
?>
<div class="container">
<fieldset class="fieldset">
<h4>Logistics Plan Report</h4>
<form method="post" action="" class="form-group">
        <label for="">Date from :</label>
        <input class="form-control" type="text" name="sdate" value="<?php echo date('y-m-d'); ?>">
        <label for="">Date to : </label>
        <input class="form-control" type="text" name="edate" value="<?php echo date('y-m-d'); ?>">
        <input type="submit" name="submit" value="Search">
    </form>
<?php

if(isset($_POST['submit']))
{
    $sdate=$_POST['sdate'];
    $edate=$_POST['edate'];
    $sql=mysqli_query($conn,"select * from qry_plan where Pdate between '$sdate' and '$edate' ");
    if($sql)
    {
    ?>
        <table class="table table-striped" >
            <tr><td>Pdate</td><td>Site</td><td>Line</td><td> PO</td><td>WO</td><td>Model</td><td> ItemCode</td><td>Item Name</td><td>Qty</td></tr>
            <?php 
                //$sql=mysqli_query($conn,"select * from plan");
                while($result=mysqli_fetch_array($sql))
                {
                echo "<tr><td>" .$result['pdate']. "</td>";
                echo "<td>" .$result['site']. "</td>";
                echo "<td>" .$result['line']. "</td>";      
                echo "<td>" .$result['po']. "</td>";
                echo "<td>" .$result['wo']. "</td>";
                echo "<td>" .$result['model']. "</td>";
                echo "<td>" .$result['itemcode']. "</td>";
                echo "<td>" .$result['item']. "</td>";
                echo "<td>" .$result['pqty']. "</td></tr>";         
                }
            ?>
        </table>
        <?php         
       }
}
?>
</fieldset>
</div>
<?php 
include("footer.php");
?>
