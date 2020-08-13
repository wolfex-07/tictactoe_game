
<?php
global $con,$data,$query,$sql;
error_reporting(0);//to not let errors show on frontend. 

if(isset($_POST['submit'])){



$server="localhost";
$username="root";
$password="";
$dbname="new";

$con=mysqli_connect($server,$username,$password,$dbname);
$query="SELECT *FROM RECORD";
$data=mysqli_query($con,$query);
$total=mysqli_num_rows($data);
echo "<br>";
if($total!=0)
{
    ?>
     <font face="comic sans ms" color="darkbrown">
<table> 
      <tr >
     
       <th color="green">S.no
       </th>
       <th>name
       </td>
       <th>address
       </th>
       <th>mobile
       </th>
       
      </tr>

    <?php

    while($result=mysqli_fetch_assoc($data))
    {
       echo " <tr>
        <td>".$result['sno']."</td>
        <td>".$result['fname']." </td>
        <td>".$result['address'] ."</td>
        <td>".$result['mobno'] ."</td>
        </tr>";
        


    }
    
}else{
    echo "no records are found";
}



if(!$con){
    die("failed".mysqli_connect());
}
if($_POST['submit'])
{
$fname = $_POST['name'];
$mobno = $_POST['mobno'];
$address= $_POST['address'];
$tamount = $_POST['tamount'];
$camount = $_POST['camount'];
$ramount = ((int)$tamount -(int)$camount);


    if(($fname!="")&&($camount!=""))
    {
        $sql="INSERT INTO `new`.`record` (`fname`, `mobno`, `address`, `tamount`, `camount`,`ramount`, `Date`) 
        VALUES ('$fname', '$mobno', '$address', '$tamount', '$camount','$ramount',current_timestamp());";
        
    }

  
else{
    echo "<br> no data found!   enter data first!";
    $sql="null";
    
}

 
}

if($con->query($sql)==true){
    echo "<br> data added";

}
 else{
     echo "<br> error:(may be duplicate data or connection error or no data found error)  <br>";

 }
 


 $con->close();
//</body>
//$echo "sucess";

}


?> </table>
<!DOCTYPE html>
<html>
<body>

<h1>Transaction Record system Trial</h1>
<div>

<button type="button" onclick="alert('Hello !')">Click Me!</button>
<form action="arena.php" method="post">
        <label for="fname">Full name:</label><br>
        <input type="text" id="fname" name="name" placeholder="enter" ><br>
        <label for="mobno">mob no.:</label><br>
        <input type="number"id="mobno" name="mobno" placeholder="enter" >
        <br>
        <label for="fname">address:</label>
   <br>
        <input type="text" id="address" name="address"placeholder="enter" ><br>
        <label for="fname">Total Amount:</label><br>
        <input type="number" id="tamount" name="tamount"placeholder="enter" ><br>
        <label for="fnae">Paid/current payment:</label><br>
        <input type="number" id="camount" name="camount" placeholder="enter">
        <input type="submit" name="submit" value="Submit" >
        
        <h4>here to show/display the remaining amount to be paid</h4><br>
       
        
        Remaining amount :<input type="text" name="result" value="<?php echo  $ramount ;?>"><br>

 </form>

</div>

</html>
 