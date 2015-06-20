
<?php
require_once 'dbairplans_func.php';
session_start();
 $uid = null;
 $usermname =  $_SESSION["actlname"];
 $pdt_id=0;
$pddtl = get_products_by_productId($pdt_id);
$qty = $_SESSION["howmany"];
 

 $pddtl = null;
 

                         
                            //else
                            //{
                               $pdt_id = $_SESSION['pid'];
$q=$_SESSION['howmany'];
$productdtl = get_products_by_productId( $pdt_id);
$m=$productdtl["Price"];
$total=$m * $q;
$uid = $_SESSION["usrnum"];


$query = 'INSERT INTO purchases
                 (NumofUnits, TotalPayment, UnitPrice, PurchaseDate, fkProductId, fkUserId)
              VALUES
                 (:nunits, :total,  :uprice, now(), :fkpid, :fkuid)';

try {
        $statement = $db->prepare($query);
        $statement->bindValue(':nunits', $q); 
        $statement->bindValue(':total', $total);
        $statement->bindValue(':uprice', $productdtl[3]); 
        $statement->bindValue(':fkpid', $pdt_id);
        $statement->bindValue(':fkuid', $uid);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        /*$product_id = $db->lastInsertId();
        return $product_id;*/
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'database_error.php';
    }







                           // }
                            
                            
                       //   } 




//echo $total;
?>

  
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>printing exmpl</title>
    <style type="text/css">
        th {
            background-color: #a8a9b6;
        }

        @media print {
            .donotprint {
                visibility: hidden;
            }

            .flipage {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>

    
<table dir="rtl" style="left:50%; margin-right: auto; border: 1px solid #7e8485; position: absolute;">

    <tr>
        <th>Total</th>
        <th>units</th>
        <th>price</th>
        <th>Purchaser Name</th>
    </tr>
    <tr>
        <?php 
       echo "<td>".$total."</td>";
       echo "<td>".$q."</td>";
       echo "<td>".$productdtl[3]."</td>";
       echo "<td>".$usermname."</td>";
     ?>
    </tr>
    <tr>
        <td style="background-color: #D5D5D5;">&nbsp;</td>
        <td style="background-color: #D5D5D5;">&nbsp;</td>
        <td style="background-color: #D5D5D5;">&nbsp;</td>
        <td style="background-color: #D5D5D5;">
            <button name="print" value="print it" class="donotprint" onclick="window.print()">הדפסה</button></td>
    </tr>
    
</table>


<br />








    
    


<?php 



?>


</body>
</html>
