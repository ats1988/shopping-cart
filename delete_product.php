
<?php 
require_once 'dbairplans_func.php';

session_start();
$pdt_id=0;
$action = 'noaction';
//$product_id=null;
$deletetitle = 'Remove Product';
//$new_product_id =null;

//$action2 = 'nonaction';
/*
$code= $name =$price =$description =$qnt= '';
//
$product_name = $code= $name =$price =$description =$qnt= '';
$product_name_err = $price_err = $qnt_err = 
                    $code_err = '';*/

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    //get the post data
    if(isset($_POST["command"]) && $_POST["command"]=="disconnect")
    {
        session_destroy();
        header("Location:index.php");
    }
    
    if(isset($_POST['productid']))
    {
        $pdt_id = $_POST['pdtid'];
    }
    if(isset($_POST['action']))
    {
        $action = $_POST['action'];
    }
    
   
    
 
}

    if($action == 'delete_product')
        {
        $product_id = $_POST['productid'];
        delete_product($product_id);
        }
 
   

    
    if($pdt_id != 0)
    {
        $products= array();
        //$supplier_name = get_supplier_name($supplier_id);
        $products = get_products_by_productId($pdt_id);
    }
    else
    {
        //$supplier_name = 'כל הספקים';
        $products = get_all_products();
    }
  



?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>delete product</title>
        

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css_1.css"/>

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
             right:45%;
            }
            /*
            #tabs-1,#tabs-2
            {
             position: absolute;
             top: 150px;
             left:15%; 
            }
            */
            form#add_product_form label {display:inline-block; width:100px; font-weight: 900;}
            
            
            
            #tabs-1
            {
                top: 150px;
                position: absolute;
                border:0px solid pink;
                width: 95% ;
                height: 620px;
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
            #span11
            {
                position: absolute;
                left:3%;
                top:3%;
            }
            
            input[type=submit] {
            margin-right:15%;
            border-radius: 3px;
            font-size:larger;
                               }
                               .delete_form
                               {
                               }
                               
                           table td 
            {
  box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #07526e, 0px 10px 5px #999;
            }
            
  #frm2 input[type="submit"] {
  width:80px;
  height:35px;
  display:block;
  font-family:Arial, "Helvetica", sans-serif;
  font-size:16px;
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

#frm2 input[type="submit"]:active {
  top:3px;
  box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #07526e, 0px 5px 3px #999;
}

#frm2 input[type="submit"]:before {
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

#frm2 input[type="submit"]:active:before {
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
        <nav></nav>
            </header>


        <section>
            <div id="holding">
                <div id="into_LS">
                    <span id="span11"><a href="manage_products.php"><button value="ניהול מוצרים">Manage Products page</button></a></span>
                    
                    
                    <h1>welcome:<?= $_SESSION["actlname"]?></h1>
                    <h2><?php echo $deletetitle;?></h2>
                    
                    <br />
                    <div id="tabs-1">
                      
                    <table dir="rtl" style=" position: absolute; left:3%; border: 0px solid #7e8485; font-size: 20px;">
                <tr>
                    <th>&nbsp;</th>
                    <th>product code</th>
                    <th>price</th>
                    <th>Units in Stock</th>
                    
                </tr>
           
          <?php   foreach ($products as $product) : ?>
                <tr>
                    <!--<td><a href="view_productdetails.php?productid=<?php echo $product['ProductId']; ?>"><?php echo $product['Code']; ?></a></td>-->
                   <td><form id='frm2' class="delete_form" method="post" >
                        <input type="hidden" name="action" value="delete_product" />
                        <input type="hidden" name="productid"
                               value="<?php echo $product['ProductId']; ?>" />
                        <input type="hidden" name="pdtid"
                               value="<?php echo $pdt_id; ?>" />
                        <input type="submit" name="delete" value="remove" />
                    </form></td>
                   <td><?php echo $product['Code']; ?></td>
                   <td><?php echo $product['Price']; ?></td>
                   <td style="color:green;"><?php echo $product['StockQuantity']; ?></td>
                   
                </tr>
            <?php endforeach; ?>
            </table>
                        
                        
                        
                        
                        
                        
                        
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
 <script>
    
    $("form.delete_form").submit( function()
    {
        var result = confirm("Are you sure, you want to remove it from DB?");
        if (result==true)
            return true;
        else
            return false;
    });
    
    
    
    
</script>
</body>
</html>













                     
