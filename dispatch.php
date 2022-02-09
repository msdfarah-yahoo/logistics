<?php 
include("header.php");
include("db.php");

if(isset($_POST['submit']))
{
    $ddate=chkdata($_POST['ddate']);
    $siteid=chkdata($_POST['siteid']);
    $lineid=chkdata($_POST['lineid']);
    $po=chkdata($_POST['po']);
    $wo=chkdata($_POST['wo']);
    $itemcode=chkdata($_POST['itemcode']);
    $dqty=chkdata($_POST['dqty']);
   // $ddate('y-m-d');    
            //$po=mysqli_real_escape_string($conn,$po);
            
            $sql=mysqli_query($conn,"insert into dispatch(ddate,siteid,lineid,po,wo,itemcode,dqty)
                                    values('$ddate',$siteid,'$lineid','$po','$wo',$itemcode,$dqty)");
            if($sql)
            {
                echo "<div class='alert alert-warning'>
                    تم حفظ السجل
                </div>";
                echo "<meta http-equiv='refresh' content='2; dispatch.php'>";
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
             window.location.href='delete_dispatch.php?poid=' +delid+'';
             return true;
            }
         } 
    </script> 
<div class="container">
<fieldset class="fieldset">
    <form method="post" action="" class="form-group">
        <label for="">Dispatch Date</label>
        <input class="form-control" type="text" name="ddate" value="<?php echo date('y-m-d'); ?>">
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
<select class="form-control" name="lineid" >
<?php
    $qry="select * from line";
    $result=mysqli_query($conn,$qry);
    while($row=mysqli_fetch_assoc($result)){
        echo"<option value='".$row['lineid']."'>".$row['line']."</option>";
    }
?>
</select>
        <label for="">Po</label>
        <input class="form-control" type="text" name="po">
        <label for="">WorkOrder</label>
        <input class="form-control" type="text" name="wo">
        <label for="">ItemCode</label>
        <input class="form-control" type="text" name="itemcode">
        <label for="">Quantity</label>
        <input class="form-control" type="text" name="dqty"></br>
        <input type="submit" name="submit" value="Save">
    </form>

</fieldset>
</div>
 <?php 
include("footer.php");
  ?>