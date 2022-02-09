<?php 
include("header.php");
$conn=mysqli_connect("localhost","root","","logistics");

if(isset($_POST['submit']))
{

    $site=chkdata($_POST['site']);
    
    $found=mysqli_query($conn,"select * from sites where site='$site'");
    $result=mysqli_fetch_array($found);

    if($result)
        {
            echo "<div style='background-color:purple; color: white;'>

            هذا السجل موجود
            </div>";
            echo "<meta http-equiv='refresh' content='2; sites.php'>";
        }else{

            $site=mysqli_real_escape_string($conn,$site);
            
            $sql=mysqli_query($conn,"insert into sites(site)
                                    values('$site')");
            if($sql)
            {
                echo "<div style='background-color:purple; color: white;'>
                    تم حفظ السجل
                </div>";
                echo "<meta http-equiv='refresh' content='2; sites.php'>";
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
             window.location.href='delete_sites.php?siteid=' +delid+'';
             return true;
            }
         } 
    </script> 
<div class="container">
<fieldset class="fieldset">
    <form method="post" action="" class="form-group">
        <label for="site">Enter site</label>
        <input class="form-control" type="text" name="site">
        <input type="submit" name="submit" value="Save">
    </form>

    <table class="table table-striped" >
        <tr><td>Code</td><td>site</td><td>Action</td></tr>
        <?php 
            $sql=mysqli_query($conn,"select * from sites");
            while($result=mysqli_fetch_array($sql))
            {
            echo "<tr><td>" .$result['siteid']. "</td>";
            echo "<td>" .$result['site']. "</td>";
            echo "<td><a href='edit_sites.php?siteid=".$result['siteid']."'><button>Modify</button></a></td>";
            ?>
            <td><input type='button' onclick="deleteme(<?php echo $result['siteid']; ?>)" name ='delete' value='Delete'></td>
            <?php
           
            }
        ?>


    </table>
</fieldset>
</div>
 <?php 
include("footer.php");
  ?>