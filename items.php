<?php 
include("header.php");
$conn=mysqli_connect("localhost","root","","logistics");

if(isset($_POST['submit']))
{

    $modelid=chkdata($_POST['modelid']);
    $item=chkdata($_POST['item']);
    $found=mysqli_query($conn,"select * from items where item='$item'");
    $result=mysqli_fetch_array($found);

    if($result)
        {
            echo "<div style='background-color:purple; color: white;'>

            هذا السجل موجود
            </div>";
            echo "<meta http-equiv='refresh' content='2; items.php'>";
        }else{

            $item=mysqli_real_escape_string($conn,$item);
            
            $sql=mysqli_query($conn,"insert into items(modelid,item)
                                    values('$modelid','$item')");
            if($sql)
            {
                echo "<div style='background-color:purple; color: white;'>
                    تم حفظ السجل
                </div>";
                echo "<meta http-equiv='refresh' content='2; items.php'>";
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
             window.location.href='delete_items.php?itemcode=' +delid+'';
             return true;
            }
         } 
    </script> 
<div class="container">
<fieldset class="fieldset">
    <form method="post" action="" class="form-group">
    <label for="">Enter model</label>      
        <select class="form-control" name="modelid" >
        <?php
            $qry="select * from models";
            $result=mysqli_query($conn,$qry);
            while($row=mysqli_fetch_assoc($result)){
                echo"<option value='".$row['modelid']."'>".$row['model']."</option>";
            }
        ?>
        </select>
        <label for="item">Enter item</label>
        <input class="form-control" type="text" name="item">
        <input type="submit" name="submit" value="Save">
    </form>

    <table class="table table-striped" >
        <tr><td>modelid</td><td>itemcode</td><td>item</td><td>Action</td></tr>
        <?php 
            $sql=mysqli_query($conn,"select * from items");
            while($result=mysqli_fetch_array($sql))
            {
            echo "<tr><td>" .$result['modelid']. "</td>";
            echo "<td>" .$result['itemcode']. "</td>";
            echo "<td>" .$result['item']. "</td>";
            echo "<td><a href='edit_items.php?itemcode=".$result['itemcode']."'><button>Modify</button></a></td>";
            ?>
            <td><input type='button' onclick="deleteme(<?php echo $result['itemcode']; ?>)" name ='delete' value='Delete'></td>
            <?php
           
            }
        ?>


    </table>
</fieldset>
</div>
 <?php 
include("footer.php");
  ?>