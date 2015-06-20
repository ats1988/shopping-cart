

<?php 
require_once 'dbairplans_func.php';

session_start();
$pdt_id=0;
//$supplier_id2=0;
$action = 'noaction';
$detailstitle = 'details';

if(!isset($_GET['productid']))
{
    
    include 'view_productdetails.php';
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    //get the post data
    if($_POST["command"]=="disconnect")
    {
        session_destroy();
        header("Location:index.php");
    }
}


$product_id = $_GET['productid'];
$product = get_product($product_id);


?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>add product</title>
        

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css_1.css"/>
    <link rel="stylesheet" type="text/css" href="jqueryvalidator.css" /> 

    <script type="js" src="jquery-1.7.1.min.js"></script>
    
    <style>
            #into_LS h1
            {
             position: absolute;
             top: 70px;
             left:25%;
            }
            
            #into_LS h2
            {
             position: absolute;
             top: 100px;
             right:25%;
            }
            
            #tabs-1,#tabs-2
            {
             position: absolute;
             top: 150px;
             left:15%; 
            }
            
            form#add_product_form label {display:inline-block; width:100px; font-weight: 900;}
            
            
            
            #tabs-1
            {
                left: 23%;
                border:0px solid pink;
                width:250px ;
                height: 400px;
            }
            
            #span11
            {
                position: absolute;
                left:3%;
                top:3%;
            }
            
            .plabel
            {
  width:105px;
  height:35px;
  display:block;
  font-family:Arial, "Helvetica", sans-serif;
  font-size:18px;
  font-weight:bold;
  color:#fff;
  text-decoration:none;
  text-transform:uppercase;
  text-align:center;
  text-shadow:1px 1px 0px #07526e;
  padding-top:6px;
  margin-left:auto;
  margin-right:auto;
  left:0px; top:7.5px;
  position:relative;
  cursor:pointer;
  border: none;
  border-left:solid 1px #2ab7ec;
  background-image: linear-gradient(bottom, rgb(14,137,182) 0%, rgb(22,179,236) 100%);
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #07526e, 0px 10px 5px #999;
            }
            
            
            .plab
            {
  width:155px;
  height:18px;
  display:block;
  font-family:Arial, "Helvetica", sans-serif;
  font-size:15px;
  font-weight:bold;
  color:gold;
  text-decoration:none;
  text-transform:uppercase;
  text-align:center;
  text-shadow:1px 1px 0px #07526e;
  padding-top:6px;
  margin-left:auto;
  margin-right:auto;
  left:0px; top:16px;
  position:relative;
  cursor:pointer;
  border: none;
  border-left:solid 1px #2ab7ec;
  background-image: linear-gradient(bottom, rgb(14,137,182) 0%, rgb(22,179,236) 100%);
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #07526e, 0px 10px 5px #999;
            }
           
    </style>
</head>
<body>
    <div id="wrapper">

            <header>
                
                <div id="connection" dir="ltr">
                   <form method="post" >
                       <button type="submit" name="command" value="disconnect">log out</button> | <?=$_SESSION["actlname"] ?>
                   </form>
                    
                </div>
        <div id="for_nav"></div>
        <div id="logo"></div>
        <div id="log_in"></div>
        <nav></nav>
            </header>


        <section>
            <div id="holding">
                <div id="into_LS">
                    <span id="span11"><a href="view_products.php"><button value="הסרת מוצרים">Products list page</button></a></span>
                    
                    
                    <h1>welcome:<?= $_SESSION["actlname"]?></h1>
                    <h2><?php echo $detailstitle;?></h2>
                    
                    <br />
                    <div id="tabs-1" dir='rtl'>
                        <?php
                         echo "<span class='plabel'>product name&nbsp;</span><span class='plab' style='height:50px; font-size:15px;'>{$product['ProductName']}</span> <br />";
                         echo "<span class='plabel'>product code&nbsp;</span><span class='plab'>{$product['Code']}</span> <br />";
                         echo "<span class='plabel'>price:&nbsp</span><span class='plab'>{$product['Price']}</span> <br />";
                         echo "<span class='plabel'>description&nbsp;</span><span class='plab' style='height:50px; font-size:11px;'>{$product['SupplierInfo']}</span> <br />";
                         echo "<span class='plabel'>units in stock&nbsp;</span><span class='plab'>{$product['StockQuantity']}";
                        ?>
                        
                        
                    </div>    
                    
                </div>
            <div id="into_RS">
                <div id="connection" dir="rtl" style="display: none;">
                
                </div>
            </div>
            </div>
            
        </section>
        
            <footer>
                footer
            </footer>

        

    </div>
 
</body>
</html>













                     
