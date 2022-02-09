<?php 
include("header.php");
$conn=mysqli_connect("localhost","root","","logistics");

if(isset($_POST['submit']))
{

    $siteid=chkdata($_POST['siteid']);
    $model=chkdata($_POST['model']);
    $found=mysqli_query($conn,"select * from models where model='$model'");
    $result=mysqli_fetch_array($found);

    if($result)
        {
            echo "<div style='background-color:purple; color: white;'>

            هذا السجل موجود
            </div>";
            echo "<meta http-equiv='refresh' content='2; models.php'>";
        }else{

            $model=mysqli_real_escape_string($conn,$model);
            
            $sql=mysqli_query($conn,"insert into models(siteid,model)
                                    values('$siteid','$model')");
            if($sql)
            {
                echo "<div style='background-color:purple; color: white;'>
                    تم حفظ السجل
                </div>";
                echo "<meta http-equiv='refresh' content='2; models.php'>";
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
             window.location.href='delete_models.php?modelid=' +delid+'';
             return true;
            }
         } 
    </script> 
<div class="container">
<fieldset class="fieldset">
    <form method="post" action="" class="form-group">
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
        <label for="model">Enter Model</label>
        <input class="form-control" type="text" name="model">
        <input type="submit" name="submit" value="Save">
    </form>

    <table class="table table-striped" >
        <tr><td>Siteid</td><td>Modelid</td><td>Model</td><td>Action</td></tr>
        <?php 
            $sql=mysqli_query($conn,"select * from models");
            while($result=mysqli_fetch_array($sql))
            {
            echo "<tr><td>" .$result['siteid']. "</td>";
            echo "<td>" .$result['modelid']. "</td>";
            echo "<td>" .$result['model']. "</td>";
            echo "<td><a href='edit_models.php?modelid=".$result['modelid']."'><button>Modify</button></a></td>";
            ?>
            <td><input type='button' onclick="deleteme(<?php echo $result['modelid']; ?>)" name ='delete' value='Delete'></td>
            <?php
           
            }
        ?>


    </table>
</fieldset>
</div>
 <?php 
include("footer.php");
  ?>