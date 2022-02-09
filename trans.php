<?php 
include("header.php");
include("db.php");

if(isset($_POST['submit']))
{
    $tdate=chkdata($_POST['tdate']);
    $siteid=chkdata($_POST['siteid']);
    $lineid=chkdata($_POST['lineid']);
    $po=chkdata($_POST['po']);
    $wo=chkdata($_POST['wo']);
    $itemcode=chkdata($_POST['itemcode']);
    $tqty=chkdata($_POST['tqty']);
    $dn=chkdata($_POST['dn']);
    $driverid=chkdata($_POST['driverid']);
    $trip=chkdata($_POST['trip']);
    $notices=chkdata($_POST['notices']);
    //$po=mysqli_real_escape_string($conn,$po);
    $founds=mysqli_query($conn,"select * from plan where po='$po' and wo='$wo' and itemcode='$itemcode'");
    $results=mysqli_fetch_array($founds);

    if(empty($results))
    {
        echo "<div style='background-color:purple; color: white;'>
        هذا الصنف غير موجود بالخطة
        </div>";
        echo $results['po'].' - ',$results['wo'].' - '.$results['itemcode'];
        echo "<meta http-equiv='refresh' content='2; trans.php'>";
        exit();
    }else{       
            $sql=mysqli_query($conn,"insert into trans(tdate,siteid,lineid,po,wo,itemcode,tqty,dn,driverid,trip,notices)
                                    values('$tdate',$siteid,$lineid,'$po','$wo',$itemcode,$tqty,'$dn',$driverid,$trip,'$notices')");
            if($sql)
            {
                echo "<div style='background-color:purple; color: white;'>
                    تم حفظ السجل
                </div>";
                echo "<meta http-equiv='refresh' content='2; trans.php'>";
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
             window.location.href='delete_trans.php?poid=' +delid+'';
             return true;
            }
         } 
    </script> 
<div class="container">
<fieldset class="fieldset">
    <form method="post" action="" class="form-group">
        <label for="">Enter tdate</label>
        <input class="form-control" type="text" name="tdate" value="<?php echo date('y-m-d'); ?>">
        <label for="">Enter Site</label>
        
<select class="form-control" name="siteid" >
<?php
    $qry="select * from sites order by siteid desc";
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
        <label for="">Enter Po</label>
        <input class="form-control" type="text" name="po">
        <label for="">Enter WorkOrder</label>
        <input class="form-control" type="text" name="wo">
        <label for="">Enter ItemCode</label>
        <input class="form-control" type="text" name="itemcode">
        <label for="">Enter Quantity</label>
        <input class="form-control" type="text" name="tqty">
        <label for="">Driver</label>
        <label for="">Enter Dn</label>
        <input class="form-control" type="text" name="dn">
        <label for="">Driver</label>
<select class="form-control" name="driverid" >
<?php
    $qry="select * from drivers";
    $result=mysqli_query($conn,$qry);
    while($row=mysqli_fetch_assoc($result)){
        echo"<option value='".$row['driverid']."'>".$row['dname']."</option>";
    }
?>
</select>
    <label for="">Trip</label>
    <input class="form-control" type="text" name="trip">
    <label for="">Notices</label>
    <input class="form-control" type="text" name="notices">
    <br />
    <input type="submit" name="submit" value="Save">
    </form>

</fieldset>
</div>
 <?php 
include("footer.php");
  ?>