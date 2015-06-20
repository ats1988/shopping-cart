<?php 
require_once 'dbairplans_func.php';

session_start();
$pdt_id=0;
//$supplier_id2=0;
$action = 'noaction';
$addtitle = 'add product';
$new_product_id =null;

//$action2 = 'nonaction';
$code= $name =$price =$description =$qnt= '';
//
$product_name = $code= $name =$price =$description =$qnt= '';
$product_name_err = $price_err = $qnt_err = 
                    $code_err = '';

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
    else
    {
        
        $action = 'add_product';
   //     $pdt_id = $_POST['pdtid'];
        $code = $_POST['code'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $qnt=$_POST['qnt'];
    }
    
   
    $product_name = get_field_value_sanitized('name');
    //echo $product_name;
    if (empty($product_name)) {
        $product_name_err = "request typing product name";
    }
    elseif (!preg_match("/^[A-Za-z\x{0590}-\x{05FF} ]+$/u",$product_name)) {
        // verify that product name contains only letters or space, we use
        // the same regular expression as is used in the HTML (see the
        // function used in addMethod('pname_cust_vld'), below, except that
        // instead of \u we use \x (this is PHP for hexa) and we need to 
        // add the modifier 'u' at the end of the regexp string to support
        // UTF-8 (for Hebrew).            
        $product_name_err = "strings only"; 
    }
    elseif (mb_strlen($product_name) < 4 || mb_strlen($product_name) > 50) {
         $product_name_err = "product name need to be between 50-4 letters";
    }
   
    // price
    $price = get_field_value_sanitized('price');
    if (empty($price)) {
        $price_err = "price cost number";
    }
    elseif (!filter_var($price,FILTER_VALIDATE_FLOAT)) {
        $price_err = "numeric only";
    }
    elseif ($price < 0 || $price > 1000.0) {
        $price_err = "please type number between 0 to-1000"; 
    }
    
    // quantity
    $qnt = get_field_value_sanitized('qnt');         
    if(!empty($qnt) && !ctype_digit($qnt)) {
       // if you want to allow the number 0 (zero) (or if you allow the integer
       // number to start with zero, you cannot use filetr_var with
       // FILTER_VALIDATE_INT as it doesn't allow for leading zero
       $qnt_err = "Positive integer";
    }
    elseif ($qnt > 1000) {
       // no need to check less than zero since this was already checked
       // by the ctype_digit() function
       $qnt_err = "please type number between 0 to-1000"; 
    }
 
    // product code
    $code = get_field_value_sanitized('code'); 
    if (empty($code)) {
        $code_err = "typing product code is necessary";
    }
    elseif (!preg_match("/^[A-C]\d{3}$/",$code)) {
        $code_err = "product name need to start with letter" . "A-C" . " + 3 numerics";
    }
    elseif(get_code($code))
    {
        $code_err = "code registration is already exist,please pick another one";
    }

    
}

function get_field_value_sanitized($fld) {
    $x = filter_input(INPUT_POST,$fld,FILTER_SANITIZE_SPECIAL_CHARS);
    return trim($x);
}

    if($pdt_id != 0)
    {
        //$supplier_name = get_supplier_name($supplier_id);
        $products = get_products_by_productId($pdt_id);
    }
    else
    {
        //$supplier_name = 'כל הספקים';
        $products = get_all_products();
    }
    //$all_suppliers = get_all_suppliers();    
    
    
    if($action == 'add_product')
    {
        
            if (empty($code) || empty($name) || empty($price) || empty($qnt) || !empty($product_name_err) || !empty($price_err) || !empty($code_err) || !empty($qnt_err) ) 
            {
            $error_message = "one or more form fields were empty";
            echo '<script language="javascript">';
            echo "alert('".$error_message."')";
            echo '</script>';
            $msg = 'Product Submissions Faild';
            }
            else
            {
            // If valid, add the product to the database
            
            $new_product_id = add_product ($name,$code,$price,$description,$pdt_id,$qnt);
            if ($new_product_id > 0)
            {
                $msg = 'המוצר הוסף בהצלחה';
               
             //   header("Location:delete_product.php");
            }
            
                
            }
        
    }
    //$all_suppliers2 = get_all_suppliers(); 
    //$new_product_id = null;







?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>add product</title>
        

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css_1.css"/>
    <link rel="stylesheet" type="text/css" href="jqueryvalidator.css" /> 

    <script type="js" src="jquery-1.7.1.min.js"></script>
    
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    
    <script src='scripts/jquery.js'></script>
    <script src='scripts/jquery.validate.min.js'></script>
    <script src="JQforvalidatepage.js"></script>
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
             top: 110px;
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
           
            
            
            
            
  #frm2 input[type="submit"] {
  width:105px;
  height:35px;
  display:block;
  font-family:Arial, "Helvetica", sans-serif;
  font-size:19px;
  font-weight:bold;
  color:#fff;
  text-decoration:none;
  text-transform:uppercase;
  text-align:center;
  text-shadow:1px 1px 0px #07526e;
  padding-top:6px;
  margin-left:auto;
  margin-right:auto;
  left:0px; top:0px;
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

/*label {right: -25px; font-size: 16px; direction:ltr;} */
.srv_err{direction:ltr; text-align: left;} 
input[type="text"]{ min-width: 100%; position: relative;}          
 
td:nth-child(5n+3) {direction:ltr;}

table, th, td {
    border: 1px solid black;
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
                    <h2 style="left:25%;"><?php echo $addtitle;?></h2>
                    
                    <br />
                    <div id="tabs-1">
                      
                        
                        
                        <form id="frm2" dir="rtl" id="add_product_form" method="post">

               <!-- <label>ספק:</label>
                <select name="productid">
                <?php foreach ($all_products as $productN) : ?>
                    <option 
                       value="<?php echo $productN['ProductId']; ?>"
                       <?php if($productN['ProductId'] == $pdt_id) echo 'selected'; ?>>
                       product code in use:<?php echo $productN['Price']; ?>
                    </option>
                <?php endforeach; ?>
                </select>-->
                <br /><br />

                <table>
                <tr>  
                
                <td><input maxlength="4" type="text" id="code" name="code" value="<?php echo $code; ?>" /></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;<span class="srv_err"><?php echo $code_err;?></span></td>
                <td>P code: <span class="req">*</span></td>

                </tr>
                <tr>

                <td><input type="text" id="name" name="name" value="<?php echo $name; ?>"/></td>
                <td><span class="srv_err"><?php echo $product_name_err; ?></span></td>
                <td>P name: <span class="req">*</span></td>

                </tr>
                <tr>

                <td><input type="text" id="price" name="price" value="<?php echo $price; ?>"/></td>
                <td><span class="srv_err"><?php echo $price_err; ?></span></td>
                <td>P price:<span class="req">*</span></td>
                
                </tr>
                <tr>

                <td><textarea name="description"><?php echo $description; ?></textarea></td>
                <td>&nbsp;</td>
                <td>Description: </td>
                                
                </tr>
                <tr>
                
                <td><input type="text" id="qnt" name="qnt" value="<?php echo $qnt; ?>"/></td>
                <td><span class="srv_err"><?php echo $qnt_err; ?></span></td>
                <td>Units in Stock: </td>

                </tr>
                <tr>
                
                <td><input type="submit" value="ADD" /></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                
                </tr>
                </table>
                <br /><br />
            </form>  
            <?php if ($action == 'add_product'): ?>
                 <?php if ($new_product_id > 0): ?>
                     <h4 id="info">product successfully added to DB</h4><br>
                 <?php else: ?>
                     <h4 id="info" style="color:red;">Product Submissions Faild</h4><br>
                 <?php endif;?>
                     <script>
                          $("#info").animate({opacity:0.0},3000);
                     </script>
            <?php endif;?> 
                        
                        
                        
                        
                        
                        
                        
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













                     
