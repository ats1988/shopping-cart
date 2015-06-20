
<?php
require_once 'dbairplans_func.php';
session_start();

$pdt_id=0;
$action = 'noaction';
$newnew= $_SESSION["new"] = array();
$_SESSION["pid"] = 0;

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
    
    if($_POST["command"]=="disconnect")
    {
        session_destroy();
        header("Location:index.php");
    }
    
    
    
    
    
    
    
    
   // else
   // {
        
 //   if(isset($_POST['productid']))
  //  {
   //     $pdt_id = $_POST['pdtid'];
    //}
 //   if(isset($_POST['action']))
  //  {
   //     $action = $_POST['action'];
    //}
    
  //  }
    
}

 }
  //  if($action == 'buy')
  //  {
   //     $product_id = $_POST['productid'];
        //delete_product($product_id);
  //  }
    
  //  if($pdt_id != 0)
  //  {
        //$supplier_name = get_supplier_name($supplier_id);
   //     $products = get_products_by_productId($pdt_id);
   // }
   // else
   // {
        /*$supplier_name = 'כל הספקים';*/
        $products = get_all_nonzeriproducts();
       
   // }
    //$all_suppliers = get_all_suppliers();
       
        
    
   
    ////$newnew = $_SESSION["new"];
    ////$quantity = $product['StockQuantity'];
    ////$pdi = $product['ProductId'];
    
    ////$newnew = update_qty($quantity, $pdi);
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>mainpage</title>
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
            
            #tabs-2
            {
                border:0px solid pink;
                width: 95% ;
                height: 690px;
                left: 10px;
                overflow: auto;
                overflow-x: hidden;
                overflow-y: auto;
                border:0px solid pink;
                
            }
            
            td,th 
            {
                border:1px solid #999;
                padding:0.5rem;
                //font-side: 30px;
            }
            
            /*button[name=submit]
            {
                position: absolute;
                left: 0px;
                width: 100%;
                height: 100%;
            }*/
            
            table a:active,table a:after,table a:visited
            {
                color:blue;
            }
            table a:hover
            {
                //font-size: 27px;
                color:#79498c;
            }
            
            table td 
            {
  box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #07526e, 0px 10px 5px #999;
            }
            
  #frm2 button {
  width:55px;
  height:35px;
  display:block;
  font-family:Arial, "Helvetica", sans-serif;
  font-size:12px;
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

#frm2 button:active {
  top:3px;
  box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #07526e, 0px 5px 3px #999;
}

#frm2 button:before {
  //content:"1";
  width:35px;
  height:25px;
  display:block;
  position:absolute;
  padding-top:10px;
  top:0px;
  margin-left:-37px;
  font-size:16px;
  font-weight:bold;
  color:#8fd1ea;
  text-shadow:1px 1px 0px #07526e;
  border-right:solid 1px #07526e;
  background-image: linear-gradient(bottom, rgb(10,94,125) 0%, rgb(14,139,184) 100%);
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
  box-shadow:inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #032b3a, 0px 10px 5px #999 ;
}

#frm2 button:active:before {
  top:-3px;
  box-shadow:inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #032b3a, 1px 1px 0px 0px #044a64, 2px 2px 0px 0px #044a64, 2px 5px 0px 0px #044a64, 6px 4px 2px #0b698b, 0px 10px 5px #999 ;
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
                   
                    
                    <h1>welcome:<?= $_SESSION["actlname"]?></h1>
                    
                    <!--<h4>מוצרי הספק: <span id=sname><?php echo $supplier_name; ?></span></h4>-->
                    
                    <br />
                    
                    
                    
                    <div id="tabs-2">
                <table dir="rtl" style=" position: absolute; left:0%; border: 0px solid #7e8485; font-size: 20px; text-align: center;">
                <tr>
                    <th>&nbsp;</th>
                    <th>Product name</th>
                    <th>price</th>
                    <th>description</th>
                    <th>Units in Stock</th>
                    
                </tr>
            <?php 
            foreach ($products as $product) : ?>
                    <tr>
                   <td><form id='frm2' method="post" action="cart.php" >
                        <!--<input type="hidden" name="action" value="buy" />-->
                        <input type="hidden" name="productid"
                               value="<?php echo $product['ProductId']; ?>" />
                        <input type="hidden" name="pdtid"
                               value="<?php echo $pdt_id; ?>" />
                        <button type="submit" name="butt" value="itspressed" style="height: 55px;">add to cart</button>
                        
                   </form>
                   </td>
                   <td><a href="view_productdetails.php?productid=<?php echo $product['ProductId']; ?>"><?php echo $product['ProductName']; ?></a></td>
                   <td><?php echo $product['Price']."&#8362;"; ?></td>
                   <td><?php echo $product['SupplierInfo']; ?></td>
                   <td style="color: #79498c;"><?php echo $product['StockQuantity']; ?></td>
                   
                </tr>
            <?php endforeach;?>
            </table>
                    <?php $_POST["productid"] = $_SESSION["pid"];?>
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
