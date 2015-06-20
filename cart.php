<?php
require_once 'dbairplans_func.php';
session_start();

if(!isset($_SESSION["pid"]))
{
   $_SESSION["pid"] = 0; 
}
//$_SESSION["pid"] = 0;
$pdt_id=0;

//$value_to_pass = $_POST["pid"];

$action = 'noaction';
$q='';
$new_product_q =null;
$productdtl = null;
$badq = null;
$qty = $_SESSION["qty"]; 
//echo "<script>alert('".$_SESSION["pid"]."');</script>";

//$_SESSION["pid"] = $pdt_id;



if($_SESSION["actlname"] == null)
    {
      header("Location:defualt.php");
    }
 else
 {

     
     
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    //$_POST['command'] = null;
    //get the post data
    
    if(isset($_POST["command"]) && $_POST["command"]=="disconnect")
    {
        session_destroy();
        header("Location:index.php");
    }
    else
    {
        
    if(isset($_POST['productid']))
    {
    
    $_SESSION["pid"] = $_POST["productid"];
    


     $pdt_id = $_POST["productid"];  
     
      //  $productdtl=  array();
       
        
        $productdtl = get_products_by_productId($_SESSION["pid"]);
        //var_dump($productdtl);
     //  echo count($productdtl);
    }
   
    
    if(isset($_POST["action"]))
    {
        $action = "insert";
         
    }

    }
    
    
  
 
 
    
}
  

 }

            $pdt_id = $_SESSION["pid"];
 
            $productdtl = get_products_by_productId($pdt_id);
        
                            if(isset($_POST["insert"]))
                            {
                              //$pdt_id = 0;
                            if(empty($_POST["howmany"]))
                            {
                              $price_err = "please insert first an initial amount";
                              //echo "<script>alert('".$price_err."')</script>";
                              $badq= $price_err;
                              
                            }
                            else if(!filter_var($_POST["howmany"],FILTER_VALIDATE_FLOAT))
                            {
                              $price_err = "only numrics";
                              //echo "<script>alert('".$price_err."')</script>";
                              $badq= $price_err;  
                              //return;
                            }
                            elseif((int)$productdtl[5] == 0)
                            {
                              $price_err = "add product to cart from products list page";
                              //echo "<script>alert('".$price_err."')</script>";
                              $badq= $price_err;
                            }
                            elseif ($_POST["howmany"] < 1 || $_POST["howmany"] > $productdtl[5])
                            {
                              $price_err = "insert number in range of 1 to-".$productdtl[5];
                              //echo "<script>alert('".$price_err."')</script>";
                              $badq= $price_err;     
                              //return;
                            }
                            
                            else
                                
                            {
                                
                            
                        global $db;
                        global $quantity; global $pdi;
                        $quantity=$productdtl[5];
                        $pdi = $productdtl[0];
                        
                        
    
    $query = "UPDATE products SET StockQuantity = '$quantity' - 1 WHERE StockQuantity=:qnt and ProductId = :pi";
    
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':qnt', $quantity); 
        $statement->bindValue(':pi', $pdi); 
        $statement->execute();
        $result = $statement->fetchAll();  
        $statement->closeCursor();
       

    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'database_error.php';
    }
/////////////////////////////
                                
                                
                                 $_SESSION["howmany"] = $_POST["howmany"];
                                 //$_SESSION["pid"] = "a".$productdtl[0]."a";
                                 header("Location:showrecipt.php");
                            }
                          }
                         
                           
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>cart</title>
    <link rel="stylesheet" href="css_1.css"/>
    <script type="js" src="jquery-1.7.1.min.js"></script>
    
      <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
        -->
        
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script>
    $(function(){
        $("#into_LS").tabs();
    });
    </script>
    <style>
            #into_LS h1
            {
             position: absolute;
             top: 30px;
             left:30%;
            }
            
            #tabs-1,#tabs-2
            {
             position: absolute;
             top: 100px;
             left:18%; 
            }
            
            #ul01 li:nth-child(0)
            {
                background-color: #c4cec8;
            }
            
            #spani:hover
            {
            background-color: white;
            }
    </style>
</head>
<body>
    <div id="wrapper">

            <header>
                <div id="connection" dir="ltr">
                   <form method="post" >
                       <button type="submit" name="command" value="disconnect">log out</button> | <?= $_SESSION["actlname"] ?>
                   </form>
                    
                </div>
                
        <div id="for_nav"></div>
        <div id="logo"></div>
        <div id="log_in"></div>
        <!--<nav>
            <ul id="ul01">
            <li><a href="#"><b>אודות</b></a></li>    
            <li><a href="Add_Product.php"><b>רכישה באתר</b></a></li>
           <li><a href="#"><b>התחבר/י</b></a></li>
           <li><a href="#"><b>הרשמה לאתר</b></a></li>  
           <li><a href="View_Products.php"><b> לסל הקניות</b></a></li>          
       
            </ul>
            
        </nav>-->
        
        <?php require_once 'master.php';  ?> 
        
            </header>

        <section>
                        <div id="holding">
                <div id="into_LS">
                   
                    
                    <h1>welcome:<?= $_SESSION["actlname"]?> : cart</h1>
                    
                    <!--<h4>מוצרי הספק: <span id=sname><?php echo $supplier_name; ?></span></h4>-->
                    
                    <br />
                    
                    
                    
                    <div id="tabs-2">
                
                       
                        
                       
                     Product_Id :  <?php echo $pdt_id;?>
                                   
                      <form method="post" >
                          <label> units in hold
                             <?php// echo $productdtl[0]."&&".$_SESSION["pid"];?>
                           <?php  
                           if(isset($_POST["butt"])==FALSE)
                           {
                               
                           if(!isset($_POST["pid"]) && empty($_POST["howmany"]))
                           {
                           echo '<h4 id="alert" style="color:red;">no item selected</h4>';
                           }
                           else{echo '<h4 id="alert" style="color:red;">emtpy textbox</h4>';}
                               
                               
                           $productdtl[5] = 0; 
                                                    //$productdtl[0] = 0;
                           }
                           else 
                           {
                           //$productdtl[0] = $pdt_id;
                           
                           echo '<h4 id="alert" style="color:blue;">continue</h4>';
                           echo 'Product Nmae: &nbsp;';
                           echo "<span id='spani' style='color:grey; font-size:18.5px;'>".$productdtl[1]."</span>";
                           }
                           ?>       
                              
                              <br/>
                              <?php echo 'current stock quantity: '.$productdtl[5];  ?>
                              <br/>
                              <input type="text" name="howmany"/>
                              <?php echo $badq;?>
                          </label>
                          <input type="hidden" name="pid" value=" <?php echo $_SESSION["pid"];  ?> " />
                          <input type="hidden" name="qty" value=" <?php echo  $productdtl[5];  ?> "/>
                          <input type="submit" name="insert" value="calculate it"/>
                          
                          
                      </form>
                     
                     
                     
                        <?php if ($action == 'insert'): ?>
                 <?php if ($new_product_q > 0): ?>
                     <span id="info">good</span><br />
                 <?php else: ?>
                         <span>something wrong</span><br />
                 <?php endif;?>
                     <script>
                          $("#info").animate({opacity:0.0},3000);
                          $("#alert").animate({opacity:0.0},3000);
                     </script>
            <?php endif;?> 
                        
                     
                        
                        
                </div>
                    </div>
            <div id="into_RS">
                
            </div>

                        </div>
        </section>
        <footer>
                footer
            </footer>

    </div>

    
    
    
</body>
</html>
