<?php 
include("header.php");
$conn=mysqli_connect("localhost","root","","logistics");

if(isset($_POST['submit']))
{

    $color=chkdata($_POST['color']);
    
    $found=mysqli_query($conn,"select * from colors where color='$color'");
    $result=mysqli_fetch_array($found);

    if($result)
        {
            echo "<div style='background-color:purple; color: white;'>

            هذا السجل موجود
            </div>";
            echo "<meta http-equiv='refresh' content='2; colors.php'>";
        }else{

            $color=mysqli_real_escape_string($conn,$color);
            
            $sql=mysqli_query($conn,"insert into colors(color)
                                    values('$color')");
            if($sql)
            {
                echo "<div style='background-color:purple; color: white;'>
                    تم حفظ السجل
                </div>";
                echo "<meta http-equiv='refresh' content='2; colors.php'>";
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
             window.location.href='delete_colors.php?colorid=' +delid+'';
             return true;
            }
         } 
    </script> 
<div class="container">
<fieldset class="fieldset">
    <form method="post" action="" class="form-group">
        <label for="color">Enter color</label>
        <input class="form-control" type="text" name="color">
        <input type="submit" name="submit" value="Save">
    </form>

    <table class="table table-striped" >
        <tr><td>Code</td><td>color</td><td>Action</td></tr>
        <?php 
            $sql=mysqli_query($conn,"select * from colors");
            while($result=mysqli_fetch_array($sql))
            {
            echo "<tr><td>" .$result['colorid']. "</td>";
            echo "<td>" .$result['color']. "</td>";
            echo "<td><a href='edit_colors.php?colorid=".$result['colorid']."'><button>Modify</button></a></td>";
            ?>
            <td><input type='button' onclick="deleteme(<?php echo $result['colorid']; ?>)" name ='delete' value='Delete'></td>
            <?php
           
            }
        ?>


    </table>
</fieldset>
</div>
 <?php 
include("footer.php");
  ?>