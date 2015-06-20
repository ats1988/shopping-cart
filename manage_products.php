
<?php
require_once 'dbairplans_func.php';

session_start();
$pdt_id=0;
$action = 'noaction';
//$new_product_id =null;

//$action2 = 'nonaction';
//$code= $name =$price =$description =$qnt= '';
//
//$product_name = $code= $name =$price =$description =$qnt= '';
//$product_name_err = $price_err = $qnt_err = 
                    //$code_err = '';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    //get the post data
    if(isset($_POST["command"])==true && $_POST["command"]=="disconnect")
    {
        session_destroy();
        header("Location:index.php");
    }
    else
    {
    
        $pdt_id = $_POST['pdtid'];
    
    
    }
    
   
    
    
    
    /*
    $product_name = get_field_value_sanitized('name');
    echo $product_name;
    if (empty($product_name)) {
        $product_name_err = "יש להקליד שם מוצר";
    }
    elseif (!preg_match("/^[A-Za-z\x{0590}-\x{05FF} ]+$/u",$product_name)) {
        // verify that product name contains only letters or space, we use
        // the same regular expression as is used in the HTML (see the
        // function used in addMethod('pname_cust_vld'), below, except that
        // instead of \u we use \x (this is PHP for hexa) and we need to 
        // add the modifier 'u' at the end of the regexp string to support
        // UTF-8 (for Hebrew).            
        $product_name_err = "יש להקליד אך ורק אותיות"; 
    }
    elseif (mb_strlen($product_name) < 4 || mb_strlen($product_name) > 12) {
         $product_name_err = "שם מוצר צריך להיות לפחות 4 תווים ולא יותר מ-12";
    }
   
    // price
    $price = get_field_value_sanitized('price');
    if (empty($price)) {
        $price_err = "יש להקליד מחיר המוצר";
    }
    elseif (!filter_var($price,FILTER_VALIDATE_FLOAT)) {
        $price_err = "יש להקליד ערך מספרי";
    }
    elseif ($price < 0 || $price > 1000.0) {
        $price_err = "יש להקליד מספר בין 0 ל-1000"; 
    }
    
    // quantity
    $qnt = get_field_value_sanitized('qnt');         
    if(!empty($qnt) && !ctype_digit($qnt)) {
       // if you want to allow the number 0 (zero) (or if you allow the integer
       // number to start with zero, you cannot use filetr_var with
       // FILTER_VALIDATE_INT as it doesn't allow for leading zero
       $qnt_err = "יש להקליד מספר שלם וחיובי";
    }
    elseif ($qnt > 1000) {
       // no need to check less than zero since this was already checked
       // by the ctype_digit() function
       $qnt_err = "יש להקליד מספר בין 0 ל-1000"; 
    }
 
    // product code
    $code = get_field_value_sanitized('code'); 
    if (empty($code)) {
        $code_err = "יש להקליד קוד מוצר";
    }
    elseif (!preg_match("/^[P]\d{1}$/",$code)) {
        $code_err = "הקוד צריך להתחיל באות " . "P" . " ולאחריה 3 ספרות";
    }

    */
}
/*
function get_field_value_sanitized($fld) {
    $x = filter_input(INPUT_POST,$fld,FILTER_SANITIZE_SPECIAL_CHARS);
    return trim($x);
}*/
/*
    if($action == 'delete_product')
    {
        $product_id = $_POST['productid'];
        delete_product($product_id);
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
        
        if (empty($code) || empty($name) || empty($price) ) {
            $error_message = "אחד או יותר מהשדות הדורשים לא מולא.";
            echo '<script language="javascript">';
            echo "alert('".$error_message."')";
            echo '</script>';
        } else {
            // If valid, add the product to the database
            
            $new_product_id = add_product ($name,$code,$price,$description,$pdt_id,$qnt);
            if ($new_product_id > 0)
            {
                $msg = 'המוצר הוסף בהצלחה';
               
             //   header("Location:delete_product.php");
            }
            else
                $msg = 'המוצר לא הוסף למסד הנתונים. קוד המוצר משוייך כבר למוצר קיים';
        }
        
    }
    //$all_suppliers2 = get_all_suppliers(); 
    */
    
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>manage products</title>
    <link rel="stylesheet" href="css_1.css" />
    <!--<link rel="stylesheet" type="text/css" href="jqueryvalidator.css" /> take it_1-->
    <script type="js" src="jquery-1.7.1.min.js"></script>
    
      <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
        -->
        
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    
    <script src='scripts/jquery.js'></script>
    <script src='scripts/jquery.validate.min.js'></script>
    <style>
            #contain_ul ul
            {
             position: absolute;
             top: 24%;
             right: 33%;
             display: inline;
            }
            #contain_ul li
            {
                height: 65px;
                width: 85px;
                display:inline-block;
                background-color:#d3d5db;
                text-align: center;
                font-family: fantasy;
                font-size: 24px;
            }
            
            #contain_ul li:hover
            {
                background-color: #7e8485;
            }
            
            #into_LS h1
            {
             position: absolute;
             top: 70px;
             right:35%;
            }
            
            #tabs-1,#tabs-2
            {
             position: absolute;
             top: 150px;
             left:0%; 
            }
            
            form#add_product_form label {display:inline-block; width:100px; font-weight: 900;}
            
            #ul01 li:nth-child(2)
            {
                background-color: #c4cec8;
            }
            
            #tabs-2
            {
                left: 23%;
                border:0px solid pink;
                width:250px ;
                height: 620px;
                overflow: auto;
                overflow-x: hidden;
                overflow-y: auto;
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
                    
                    
                    <br />
                    
                    
                    <div id="contain_ul">
                     
                        <ul>
                        <li><abbr title="add product"><a href="add_product.php">Add product</a></abbr></li> &nbsp;&nbsp;
                        <li><abbr title="delete product"><a href="delete_product.php">Delete Product</a></abbr></li>
                    </ul><br/>
                    
                        
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
