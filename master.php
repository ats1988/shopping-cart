<nav>
            
            <ul id="ul01">
                 
<?php


if ( $_SESSION["usrTyp"]=='a')
{
    echo ' 
            <li><b><a href="view_users.php">Users Panel</a></b></li>
           <li><a href="manage_products.php"><b>Manage Products</b></a></li>'            
       
            ;

}
 else {
    echo '
        
        <li><a href="reservations.php"><b>My Orders/י</b></a></li>
        
         '
      ;
}         



  
?>
               
            
           <li><a href="cart.php"><b>Shopping Cart</b></a></li>
           <li><a href="View_Products.php?pageSet=true"><b>Products List</b></a></li>
           <li><a href="About.php"><b>About</b></a></li>

    </ul>
            
        </nav>
<?php 
/*
 if(isset($_GET["pageSet"]))
 {
     $msg = "not good"; $slide="#for_slide_login";
 echo "<script type='text/javascript'>
     alert('$msg');
 $('$slide').show().css({'display':'block','z-index':'1'});
</script>";
 
 }
     
 */
?>
