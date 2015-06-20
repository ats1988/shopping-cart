<?php

try
{
    $db=new PDO("mysql:host=localhost;dbname=airmodelsdb","root","");
} 
catch (PDOException $ex) 
{
    echo "db Connection problem".$ex->GetMessage();
    exit;
}


/*users table*/

function credentialOk($uid,$pwd)
{
    try
    {
        global $db;
        $cmd="select UserId,usractname,usrTyp,products.StockQuantity from users,products where usrlogin=:usrid and usrpwd=:usrpwd";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':usrid',$uid);
        $qry->bindValue(':usrpwd',$pwd);
        $qry->execute();
        $result=$qry->fetch();
        $qry->closeCursor();
        return $result;
    }
    catch (PDOException $ex)
    {
        echo "db single user select credentional problem".$ex->GetMessage();
        exit;
    }
}

function getnotmeusers($menum)
{
    try 
    {
        global $db;
        $cmd="select usractname,UserId,ShippingAddress from users where UserId<>:num and usrTyp='u'";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':num',$menum);
        $qry->execute();
        $result=$qry->fetchAll();
        $qry->closeCursor();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db multi user select problem".$ex->GetMessage();
        exit;
    }
}

function dltusrbyid($usrnum)
{
    try 
    {
        global $db;
        $cmd="delete from users where UserId=:num";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':num',$usrnum);
        $qry->execute();
        $rowcount=$qry->rowCount();
        $qry->closeCursor();
        return $rowcount;
    } 
    catch (PDOException $ex)
    {
        echo "db delete user problem".$ex->GetMessage();
        exit;
    }
}
function userexist($rqstdusrid)
{
     try
    {
        global $db;
        $cmd="select count(*) from users where usrlogin=:usrid";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':usrid',$rqstdusrid);
        $qry->execute();
        $result=$qry->fetch();
        $qry->closeCursor();
        
        return $result[0]!=0;
    }
    catch (PDOException $ex)
    {
        echo "db exist user select problem".$ex->GetMessage();
        exit;
    }
}
function adduser($uid,$pwd,$actlnm,$shipadrs)
{
  
    try 
    {
        global $db;
        $cmd="insert into users "
                . "(usrlogin,usrpwd,usractname,ShippingAddress,usrTyp)"
                . " values (:usrid,:rqstdpwd,:actlname,:rqstshipping,'u')";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':usrid',$uid);
        $qry->bindValue(':rqstdpwd',$pwd);
        $qry->bindValue(':actlname',$actlnm);
        $qry->bindValue(':rqstshipping',$shipadrs);
        $qry->execute();
        $rowcount=$qry->rowCount();
        $qry->closeCursor();
        return $rowcount;
    } 
    catch (PDOException $ex)
    {
        echo "db add user problem".$ex->GetMessage();
        exit;
    }
}
function updtusrdtls($uid,$pwd,$actlnm,$shipadrs)
{
  
    try 
    {
        global $db;
        $cmd="update users set usrpwd=:nwpwd,usractname=:nwactlname,ShippingAddress=:nwshipadrs where usrlogin=:usrid";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':usrid',$uid);
        $qry->bindValue(':nwpwd',$pwd);
        $qry->bindValue(':nwactlname',$actlnm);
        $qry->bindValue(':nwshipadrs',$shipadrs);
        $qry->execute();
        $rowcount=$qry->rowCount();
        $qry->closeCursor();
        return $rowcount;
    } 
    catch (PDOException $ex)
    {
        echo "db upd user problem".$ex->GetMessage();
        exit;
    }
}
function getuserdtlsbyid($unum)
{
    try
    {
        global $db;
        $cmd="select usrlogin,usractname,ShippingAddress from users where UserId=:uidnum";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':uidnum',$unum);
        $qry->execute();
        $result=$qry->fetch();
        $qry->closeCursor();
        return $result;
    }
    catch (PDOException $ex)
    {
        echo "db single user select credentional problem".$ex->GetMessage();
        exit;
    }
}


/*end users table*/

/**/

/*products table*/


function get_products_by_productId($pdt_id)
{
   
    global $db;
    try
    {
        $query = 'SELECT * FROM products WHERE ProductId = :pdtid';
        $statement = $db->prepare($query);
        $statement->bindValue(':pdtid',$pdt_id);
        $statement->execute();
        $result = $statement->fetch();  
        $statement->closeCursor();
    
        return $result;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php';    
        exit();
    }
}
function get_all_products()
{
    global $db;
    try
    {
        $query = 'SELECT * FROM products';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();  
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php';    
        exit();
    }
}
function get_all_nonzeriproducts()
{
    global $db;
    try
    {
        $query = 'SELECT * FROM products where StockQuantity>0';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();  
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php';    
        exit();
    }
}

function get_product($product_id)
{
    global $db;
    try
    {
        $query = 'SELECT * FROM products WHERE ProductId = :productid';
        $statement = $db->prepare($query);
        $statement->bindValue(':productid',$product_id);
        $statement->execute();
        $result = $statement->fetch();  
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php';    
        exit();
    }
}

function delete_product($pdt_id)
{
    global $db;
    try
    {
        $query = 'DELETE FROM products WHERE ProductId = :productid';
        $statement = $db->prepare($query);
        $statement->bindValue(':productid',$pdt_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php';    
        exit();
    }
}

function add_product($name,$code,$price, $description,$pdt_id,$q) 
{
    global $db;
    $query = 'INSERT INTO products
                 (ProductName, Code, Price, SupplierInfo,ProductId,StockQuantity)
              VALUES
                 (:name, :code,  :price, :description, :pdtid, :qnt)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name); 
        $statement->bindValue(':code', $code);
        $statement->bindValue(':price', $price); 
        $statement->bindValue(':description', $description);
        $statement->bindValue(':pdtid', $pdt_id);
        $statement->bindValue(':qnt', $q);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $product_id = $db->lastInsertId();
        return $product_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'database_error.php';
    }
}

function get_code($code_on)
{
    global $db;
    try
    {
        $query = 'SELECT Code FROM products WHERE Code = :COD';
        $statement = $db->prepare($query);
        $statement->bindValue(':COD',$code_on);
        $statement->execute();
        $result = $statement->fetch();  
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php';    
        exit();
    }
}






/*end products table*/



/* suppliers functions*/


/* -----------optional------------- >_>_>_>
function get_supplier($supplier_id)
{
    global $db;
    try
    {
        $query = 'SELECT * FROM purchases WHERE  fkProductId = :supplierid';
        $statement = $db->prepare($query);
        $statement->bindValue(':supplierid',$supplier_id);
        // throw new PDOException('This is an error message');
        $statement->execute();
        $result = $statement->fetch();  
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php'; 
        exit();
    }
}

function get_supplier_name($supplier_id)
{
    global $db;
    try
    {
        $query = 'SELECT NumofUnits FROM purchases WHERE  fkProductId = :supplierid';
        $statement = $db->prepare($query);
        $statement->bindValue(':supplierid',$supplier_id);
        // throw new PDOException('This is an error message');
        $statement->execute();
        $result = $statement->fetch();  
        $statement->closeCursor();
        return $result['NumofUnits'];
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php'; 
        exit();
    }
}
function get_all_suppliers()
{
    global $db;
    try
    {
        $query = 'SELECT * FROM purchases';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();  
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php'; 
        exit();
    }
}



*/
/*end of suppliers functions*/

/*
 
 
function insert_into_purchases_table($qty,$totalpayment,$unitprice, $purchasedate,$fkproductid,$fkuserid) 
{
    global $db;
    $query = 'INSERT INTO purchases
                 (NumofUnits,TotalPayment,UnitPrice,fkProductId,fkUserId)  
              VALUES
                 (:qnt, :total,  :uprice, :fkpdtid, :fkusrid)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':qnt', $qty); 
        $statement->bindValue(':total', $totalpayment);
        $statement->bindValue(':uprice', $unitprice); 
        $statement->bindValue(':fkpdtid', $fkproductid);
        $statement->bindValue(':fkusrid', $fkuserid);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $pdt_id = $db->lastInsertId();
        return $pdt_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'database_error.php';
    }
}
  
 
 */
///////////
/*
function update_qty($qty,$pi) 
{
    global $db;
    $query = "UPDATE products SET StockQuantity = StockQuantity - 1 WHERE StockQuantity=:qnt and ProductId = :pi";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':qnt', $qty); 
        $statement->bindValue(':pi', $pi); 
        $statement->execute();
        $statement->closeCursor();

        
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'database_error.php';
    }
}
*/
 
////////////


function present_purchase_item($fkusrid)
{
    global $db;
    try
    {
        $query = 'DELETE FROM purchases WHERE fkUserId = :fkusrid';
        $statement = $db->prepare($query);
        $statement->bindValue(':fkusrid',$fkusrid);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php';    
        exit();
    }
}
/*
function get_all_receipts_by_usrid($fkusrid)
{
    global $db;
    try
    {
        $query = 'SELECT purchases.*,ProductName FROM purchases,products WHERE purchases.fkProductId=products.ProductId and  fkUserId = :fkusrid';
        $statement = $db->prepare($query);
        $statement->bindValue(':fkusrid',$fkusrid);
        // throw new PDOException('This is an error message');
        $statement->execute();
        $result = $statement->fetch();  
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php'; 
        exit();
    }
}*/

function get_all_purchases_details()
{
    global $db;
    try
    {
        $query = 'SELECT purchases.*,ProductName FROM purchases,products WHERE purchases.fkUserId=products.UserId';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();  
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $ex) 
    {
        $error_message = $ex->getMessage();
        include 'database_error.php';    
        exit();
    }
}




function get_all_receipts_by_usrid($fkusrid)
{
    global $db;
    try
    {
        /*$query = 'SELECT purchases.* FROM purchases';*/
        $query = 'SELECT purchases.*,ProductName FROM purchases,products WHERE purchases.fkProductId=products.ProductId and  fkUserId = :fkusrid';
        $statement = $db->prepare($query);
        $statement->bindValue(':fkusrid',$fkusrid);
        $statement->execute();
        $result = $statement->fetchAll();  
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $ex) 
    {
    
        $error_message = $ex->getMessage();
        include 'database_error.php'; 
        exit();
    }
}





////////////
/*
 * 
 * 
 * 
function add_to_purchases($qty) 
{
    global $db;
    $query = 'INSERT INTO purchases
                 (NumofUnits)  
              VALUES
                 (:qnt)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':qnt', $qty); 
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
       //          $product_id = $db->lastInsertId();
        return $product_id;        
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'database_error.php';
    }
}

 * 
 * 
 *  */
