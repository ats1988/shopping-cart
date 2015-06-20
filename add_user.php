<?php
$uid="";
$actlnm="";
$shipadrs="";
require_once 'dbairplans_func.php';
$err="";

$atrb="";
$btnvlu="";
$ttl="add user";
$cmdnm="addit";
$cptn="הוסף";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $cmd=substr($_POST["command"],0,5);
   
   
    if ($cmd=="addit")
    {
        $ttl="add user";
        $cptn="הוסף";
        $uid=$_POST["uid"];
        $actlnm=$_POST["actlname"];
        $shipadrs=$_POST["shipadrs"];
        if (empty($_POST["uid"]) || empty($_POST["pwd"]) || empty($_POST["actlname"]) || empty($_POST["shipadrs"]))
        {
            $err="<script>alert('One or more details found empty')</script>";
        }
        else //  user typ data
        {
           
            if (userexist($_POST["uid"]))
            {
               $err="<script>alert('username is already exist');$('#uid').focus();</script>"; 
            }
            else
            {
                if (!adduser($_POST["uid"],$_POST["pwd"],$_POST["actlname"],$_POST["shipadrs"]))
                {
                   $err="<script>alert('Add user faild')</script>";   
                }
                else 
                {
                    $err="<script>alert('welcome to air plans models ');window.location.href='index.php';</script>";  
                }

            }
        }
    }//addit
    elseif ($cmd=="updit") 
    {
        $ttl="change user";
        $cmdnm="updit";
        $cptn="עדכן";
        $atrb='readonly="readonly"';
        $uid=$_POST["uid"];
        $actlnm=$_POST["actlname"];
        $shipadrs=$_POST["shipadrs"];
        if (empty($_POST["pwd"]) || empty($_POST["actlname"]) || empty($_POST["shipadrs"]))
        {
            $err="<script>alert(' One or more details found empty')</script>";
        }
        else //  user typ data
        {
            if (!updtusrdtls($_POST["uid"],$_POST["pwd"],$_POST["actlname"],$_POST["shipadrs"]))
            {
               $err="<script>alert('Update user details faild')</script>";   
            }
            else 
            {
                $err="<script>alert('Update user details succeed');window.location.href='view_users.php';</script>";  

            }
        }

    }//updit
   
    elseif ($cmd=="edtme") // when it come from viewusers
    {
        $ttl="change user";
        $recky=substr($_POST["command"],5);
        $atrb='readonly="readonly"';
        list($uid,$actlnm,$shipadrs)=getuserdtlsbyid($recky);
        $cmdnm="updit";
        $cptn="עדכן";
    }//edtme
   
}//post
        
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title><?= $ttl ?></title>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css_1.css"/>
    <style>
        #tabb
        {
            
            position: absolute;
            left:15%; top:11.5%;
            font-size: 21px;
            box-shadow: 5px 5px 15px #07526e inset;
        }
        
  form button,input[type="reset"] {
  width:55px;
  height:35px;
  display:block;
  font-family:Arial, "Helvetica", sans-serif;
  font-size:13px;
  font-weight:bold;
  color:grey;
  text-decoration:none;
  text-transform:uppercase;
  text-align:center;
  text-shadow:1px 1px 0px #07526e;
  /*padding-top:6px;*/
  /*margin-left:auto;
  margin-right:auto;*/
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

form button:active,input[type="reset"]:active {
  top:3px;
  box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #07526e, 0px 5px 3px #999;
}

form button:before,input[type="reset"]:before{
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

form button:active:before,input[type="reset"]:active:before {
  top:-3px;
  box-shadow:inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #032b3a, 1px 1px 0px 0px #044a64, 2px 2px 0px 0px #044a64, 2px 5px 0px 0px #044a64, 6px 4px 2px #0b698b, 0px 10px 5px #999 ;
}
        
    </style>
</head>
<body>
    <div id="wrapper">

            <header>
        <div id="for_nav"></div>
        <div id="logo"></div>
        <div id="log_in"></div>
        <nav></nav>
            </header>


        <section>
            <div id="holding">
                <div id="into_LS">
                    
                    
       <form method="post">
           <table id="tabb"><tr><td>&nbsp;</td><td style="font-size:35px;"><?=$ttl ?></td><td>&nbsp;</td></tr>
            <tr><td>User Id:</td>
            <td><input id="uid" type="text" name="uid" maxlength="14" <?=$atrb ?> size="14" value="<?=$uid ?>"/></td>
            </tr>
            <tr><td>Password:</td>
            <td><input type="password" name="pwd" maxlength="14" size="14"/></td>
            </tr>
            <tr><td>Actual Name:</td>
            <td><input type="text" name="actlname" maxlength="14" size="14" value="<?=$actlnm ?>"/></td>
            </tr>
            <tr><td>Address</td>
            <td><input type="text" name="shipadrs" maxlength="14" size="14" value="<?=$shipadrs ?>"/></td>
            </tr>
            <tr><td>
            <input type="reset" value="reset"/></td>
            <td><button type="submit" name="command" value="<?=$cmdnm ?>"><?= $cptn ?></button></td>
            <td><button type="button" onclick="window.location.href='index.php'" >חזרה לדף כניסה</button></td></tr>
               <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
            </table>
       </form>
       
                <?= $err ?>    
                    
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
