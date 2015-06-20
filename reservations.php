
<?php 
require_once 'dbairplans_func.php';

session_start();
$u_id=0;
$action = 'noaction';
//$product_id=null;
$reservations_title = 'My Orders';
$u_id = $_SESSION["usrnum"];

if($_SESSION["actlname"] == null)
    {
      header("Location:defualt.php");
    }
 else
 {

     
     
     
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    //get the post data
    if($_POST["command"]=="disconnect")
    {
        session_destroy();
        header("Location:index.php");
    }
    
    
        
    
    if(isset($_POST['action']))
    {
        $action = $_POST['action'];
    }
    
   
    
 
}

 }
 //$_SESSION["usrnum"]
    /*if($action == 'present_purchase_item')
        {*/
       // $_SESSION["usrnum"] = $_POST['userid'];
       // present_purchase_item($_SESSION["usrnum"]);
        /*}*/
 
   

    
    if($u_id > 0)
    {
       $purchases= array();
        
        //$supplier_name = get_supplier_name($supplier_id);
        //$purchases = get_all_receipts_by_usrid($u_id);
       $purchases=get_all_receipts_by_usrid($u_id);
    }
    else
    {
        //$supplier_name = 'כל הספקים';
        $purchases = get_all_purchases_details();
    }
  



?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>reservations</title>
        

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
            #ul01 li:nth-child(0)
            {
                background-color: #c4cec8;
            }
            
            form#add_product_form label {display:inline-block; width:100px; font-weight: 900;}
            
            
            
            #tabs-1
            {
                top: 150px;
                position: absolute;
                width: 470px;
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
                right:3%;
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
    </style>
</head>
<body>
    <div id="wrapper">

            <header>
                
                <div id="connection" dir="ltr">
                   <form method="post" >
                       <button type="submit" name="command" value="disconnect">התנתק</button> | <?=$_SESSION["actlname"] ?>
                   </form>
                    
                </div>
                <div id="for_nav">
                    
                     
                </div>
        <div id="logo"></div>
        <div id="log_in"></div>
        <?php require_once 'master.php';?>
            </header>


        <section>
            <div id="holding">
                <div id="into_LS">
                    
                    
                    <h1>welcome:<?= $_SESSION["actlname"]?></h1>
                    <h2><?php echo $reservations_title/*.$u_id*/;?></h2>
                    
                    <br />
                    <div id="tabs-1">
                      
                    <table dir="rtl" style=" position: absolute; left:0%; border: 0px solid #7e8485; font-size: 20px; text-align: center;">
                <tr>
                    
                    <th>Units</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Purchase Date</th>
                    <th>product name</th>
                    
                    
                    
                    
                </tr>
           <?php
            //fkProductId  fkUserId  PurchaseDate  UnitPrice  TotalPayment  NumofUnits  
           ?>
          <?php   foreach ($purchases as $purchase_item) : ?>
                <tr>
                   <td style='color: gray;'><?php echo $purchase_item['NumofUnits']; ?></td>
                   <td style='color: gray;'><?php echo $purchase_item['UnitPrice']."&#8362;"; ?></td>
                   <td  style='color: brown;'><?php echo $purchase_item['TotalPayment']."&#8362;"; ?></td>
                   <td style='color: gray;'><?php echo $purchase_item['PurchaseDate']; ?></td>
                   <td style='color: gray;'><?php echo $purchase_item['ProductName']; ?>
                   
                       <form method="post" >
                        <input type="hidden" name="action" value="present_purchase_item" />
                        <input type="hidden" name="userid"
                               value="<?php echo $purchase_item['fkProductId']; ?>" />
                        <input type="hidden" name="Uid"
                               value="<?php echo $u_id; ?>" />
                        <!--<input type="submit" name="delete" value="מחק" />-->
                    </form>
                   
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
 
</body>
</html>













                     
