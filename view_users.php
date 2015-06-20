<?php
require_once 'dbairplans_func.php';

session_start();
$alrt="";
if(!isset($_SESSION["usrnum"]))
{
    header("Location:defualt.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST["command"]=="disconnect")
    {
        session_destroy();
        header("Location:index.php");
    }
    else
    {
        $cmd = substr($_POST["command"],0,5);
        $recky=  substr($_POST["command"], 5);
        if($cmd=="dltit")
        {
            if(!dltusrbyid($recky))
            {
                $alrt="<script>alert('בעיה במחיקת המשתמש')</script>";
            }
            else
            {
                $alrt="<script>alert('משתמש נמחק בהצלחה')</script>";
            }
        }
        //   else 
     //   {
            
     //       header("Location:add_user.php");
     //   }
    }
}

$currency = '$'; 

?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>mainpage</title>
    <link rel="stylesheet" href="css_1.css"/>
    <style>
            #into_LS h1
            {
             position: absolute;
             top: 30px;
             left:30%;
            }
            
            #ul01 li:nth-child(1)
            {
                background-color: #c4cec8;
            }
            
            td,th 
            {
                border:1px solid #999;
                padding:0.5rem;
                //font-side: 30px;
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
                    <form method="post" action="#">
                    <h1>welcome:<?= $_SESSION["actlname"]?></h1>
                    
                    <table style="left:15%; margin-right: auto; border: 0px solid #7e8485; position: absolute; top:110px;">
                        <caption>login users</caption>
                        <thead>
                            <tr><th>real name</th><th>action</th><th>address</th></tr>
                            
                        </thead>
                        <tbody>
                            <?php 
                        $rslt=  getnotmeusers($_SESSION['usrnum']);
                            if(!$rslt)
                            {
                                echo "<tr><td colspan=2>no details</td></tr>";
                            }
                            else
                            {
                                foreach ($rslt as $row)
                                {
                                    echo "<tr><td>";
                                    echo $row["usractname"];
                                    echo "</td><td><button name=command type=submit value=dltit".$row["UserId"]."><strong> Remove</strong>&nbsp;User</button><button name=command type=submit method='post' formaction='add_user.php' value='edtme".$row["UserId"]."'/><strong> Edit</strong>&nbsp;Details</button></td>";
                                    echo "<td>".$row["ShippingAddress"]."</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                        
                        
                    </table>
                    
                    </form>
                </div>
            <div id="into_RS">
                
            </div>

                        </div>
        </section>
        <footer>
                footer
            </footer>

    </div>
<?= $alrt ?>
</body>
</html>
