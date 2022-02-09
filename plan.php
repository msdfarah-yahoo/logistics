<?php 
include("header.php");
$conn=mysqli_connect("localhost","root","","logistics");

if(isset($_POST['submit']))
{

    $pdate=chkdata($_POST['pdate']);
    $siteid=chkdata($_POST['siteid']);
    $lineid=chkdata($_POST['lineid']);
    $po=chkdata($_POST['po']);
    $wo=chkdata($_POST['wo']);
    $itemcode=chkdata($_POST['itemcode']);
    $pqty=chkdata($_POST['pqty']);
   // $pdate('y-m-d');    
            //$po=mysqli_real_escape_string($conn,$po);
            $found=mysqli_query($conn,"select * from plan where po='$po' and wo='$wo' and itemcode='$itemcode'");
            $result=mysqli_fetch_array($found);
        
    if($result)
        {
            echo "<div style='background-color:purple; color: white;'>
            هذا الصنف موجود
            </div>";
            echo $result['po'].' - ',$result['wo'].' - '.$result['itemcode'];
            echo "<meta http-equiv='refresh' content='2; plan.php'>";
        }else{

            $sql=mysqli_query($conn,"insert into plan(pdate,siteid,lineid,po,wo,itemcode,pqty)
                                    values('$pdate',$siteid,$lineid,'$po','$wo',$itemcode,$pqty)");
            if($sql)
            {
                echo "<div style='background-color:purple; color: white;'>
                    تم حفظ السجل
                </div>";
                echo "<meta http-equiv='refresh' content='2; plan.php'>";
            }

        }
}
function chkdata($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

 ?>

   <script language="javascript">
         function deleteme(delid)
            {
             if(confirm("هل انت متأكد تريد حذف هذا السجل"))
             {
             window.location.href='delete_pos.php?poid=' +delid+'';
             return true;
            }
         } 
    </script> 
<div class="container">
<fieldset class="fieldset">
    <form method="post" action="" class="form-group">
        <label for="">Enter pdate</label>
        <input class="form-control" type="text" name="pdate" value="<?php echo date('y-m-d'); ?>">

<label for="">Enter Site</label>      
<select class="form-control" name="siteid" >
<?php
    $qry="select * from sites";
    $result=mysqli_query($conn,$qry);
    while($row=mysqli_fetch_assoc($result)){
        echo"<option value='".$row['siteid']."'>".$row['site']."</option>";
    }
?>
</select>

<label for="">Enter Line</label>
<select class="form-control" name="lineid" >
<?php
    $qry="select * from line";
    $result=mysqli_query($conn,$qry);
    while($row=mysqli_fetch_assoc($result)){
        echo"<option value='".$row['lineid']."'>".$row['line']."</option>";
    }
?>
</select>
        <label for="">Enter WorkOrder</label>
        <input class="form-control" type="text" name="wo">
        <label for="">Enter Po</label>
        <input class="form-control" type="text" name="po">
        <label for="">Enter ItemCode</label>
        <input class="form-control" type="text" name="itemcode">
        <label for="">Enter Quantity</label>
        <input class="form-control" type="text" name="pqty">
        <input type="submit" name="submit" value="Save">
    </form>
</fieldset>
</div>
 <?php 
include("footer.php");
  ?>