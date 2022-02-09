<?php 
include("header.php");
include("db.php");
?>
<div class="container">
<fieldset class="fieldset">
<h4>Logistics Dispatch Report</h4>
<hr>
<form method="post" action="" class="form-group">
        <label for="">Enter site :</label>
        <input type="text" name="site" size="10">
        <label for="">Enter Line :</label>
        <input type="text" name="line" size="10">
        <label for="">Enter Wo :</label>
        <input type="text" name="wo" size="10">
        <label for="">Enter Po :</label>
        <input type="text" name="po" size="10">
        <input type="submit" name="submit" value="Search">
    </form>
    <br>
    <?php

if(isset($_POST['submit']))
{
    $site=$_POST['site'];
    $line=$_POST['line'];
    $wo=$_POST['wo'];
    $po=$_POST['po'];
       $sql=mysqli_query($conn,"select * from qry_dispatch_balance where site like '$site%' and line like '$line%' and wo = '$wo' and po = '$po' ");
    if($sql)
    {
    ?>
        <table class="table table-striped" >
            <tr><td>Ddate</td><td>site</td><td>Line</td><td> Wo</td><td> Po</td><td> ItemCode</td><td>Item Name</td><td>Dispatch</td><td>Transfer</td><td>Balance</td></tr>
            <?php 
                //$sql=mysqli_query($conn,"select * from dispatch");
                while($result=mysqli_fetch_array($sql))
                {
                echo "<tr><td>" .$result['ddate']. "</td>";
                echo "<td>" .$result['site']. "</td>";
                echo "<td>" .$result['line']. "</td>";      
                echo "<td>" .$result['po']. "</td>";
                echo "<td>" .$result['wo']. "</td>";
                echo "<td>" .$result['itemcode']. "</td>";
                echo "<td>" .$result['item']. "</td>";
                echo "<td>" .$result['dqty']. "</td>";
                echo "<td>" .$result['tqty']. "</td>";
                echo "<td>" .$result['dbalance']. "</td></tr>";         
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
