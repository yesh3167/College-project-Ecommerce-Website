
<?php include '../conn.inc.php'; ?>
<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$prods=@$_SESSION["prods"];
$salt="YSm0MskVKa";

?>

<?php
	if (@$_SESSION['login']==true){
        $login=true;
        $uid=$_SESSION['userid'];
        if(@$_SESSION['fromCart']==true)
        $r=mysqli_query($conn,"INSERT INTO `transactions`(`txnId`, `uid`, `products`, `amount`) VALUES ('$txnid',$uid,'$prods','$amount')") or die(mysqli_error($conn));
        $r=mysqli_query($conn,"update userdetailstb set cart='[]' where id='$uid'") or die(mysqli_error($conn));
        // $cart=(json_decode($ordi['products'],TRUE));
        // foreach($cart as $i => $value){       
        // $selectQuery="select * from productdetails where id=$i";
        //     $qu = mysqli_query($conn,$selectQuery) or die(mysqli_error($conn));
        //     $q=mysqli_fetch_assoc($qu);  
    
    }else{
        header("Location: login.php");
        exit;
    }
?>

<?php
// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   } else {
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
		   }
?>	

<a href="../index.php">Go Back</a>