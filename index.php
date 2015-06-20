 <?php
 session_start();
 $_SESSION["usrTyp"]="";
 $err="";
 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if ($_POST["command"]=="login")
    {
        if (empty($_POST["uid"]) || empty($_POST["pwd"]))
        {
            $err="<script>alert('Username or Password are blank')</script>";
        }
        else //  user typ data
        {
            $usrdata=array();
             require_once 'dbairplans_func.php';
             if (!($usrdata=credentialOk($_POST["uid"],$_POST["pwd"])))
             {
                $err="<script>alert('Username or Password are wrong,try again')</script>";
             }
             else //ok credetional
            
                 {
                
                 $_SESSION["usrnum"]=$usrdata["UserId"];
                 $_SESSION["actlname"]=$usrdata["usractname"];
                 $_SESSION["usrTyp"]=$usrdata["usrTyp"];
                 $_SESSION["qty"]=$usrdata["StockQuantity"];
                 
                 //$_SESSION["shipadrs"]=$usrdata["ShippingAddress"];
                // echo 'er';
                 if($_SESSION["usrTyp"]=="a") 
                 {
                     header("Location:view_users.php");
                 }
                 else
                 {
                    
                 header("Location:View_Products.php");
                 
                 }
             }
        }
    }// command is: add
    else
    {
         header("Location:add_user.php");
    }
    
    /**//**//**/
 
    
 
} 

 ?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>mainpage</title>
    <link rel="stylesheet" href="css_1.css"/>
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="jquery-1.7.1.min.js"></script>
    <style>
        button,input[type="reset"]
{

    text-align: center;
    font-size: 14px;
    font-weight: bold;
    line-height: 200%;

    
    display: inline-block;
    height: 85%;
    width: 95%;
    /*margin-bottom: 0.5em;
    padding-top: .6em;
    padding-bottom: .6em;*/
    color: #888888;
    background-color: #cccccc;
    border-radius: 5px;
    border: solid #cccccc 1px;
    box-shadow: 2px 2px 1px #888888;
    padding: 0px;
}

input[type="password"],input[type="text"]
{
    position: relative;
    width: 100%;
    height: 15px;
}


        
    </style>
</head>
<body>
    <div id="wrapper">
                
        
            <header>
                <div id="connection" dir="ltr">
                    
                       <?php 
                       if ($_SESSION["usrTyp"]!="")
                       {
                           echo  
                           '  
                               <form method="post">
                       <button type="submit" name="command" value="disconnect">Log out</button>&nbsp;'. '|&nbsp; &nbsp;'.$_SESSION["actlname"].
                   '</form>  </div>';
                          
                       }
                       else {
                            echo "sing in&nbsp;&nbsp;&nbsp;&nbsp;";
                      
               echo '         </a> <img id="arrow_down" src="arrow_down.png" /> ';
                    
            echo '         <div id="for_slide_login"> ';
                        
              echo '           ';
              echo "      <form method='post'><table style='position:relative; margin-left:-5px; margin-rigt:15px; border:0px solid black;'><tr><td>&nbsp;</td> <td><h2>Log In</h2></td> <td>&nbsp;</td></tr>";
              echo '<tr><td>';
       echo '      User Id:</td>';
         echo '    <td><input type="text" name="uid"/></td></tr>';
       echo '      <tr><td>Password:</td>';
       echo '      <td><input type="password" name="pwd"/><td/></tr>';
      //echo '      <tr><td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td></tr>';
        echo "     <tr><td><input  type='reset' value='reset'/></td>";
        echo '     <td><button type="submit" name="command" value="login">log in</button></td>';
        echo '     <td><button id="but_new" type="submit" name="command" value="add">New</button></td>';
            echo '        </tr></table></form>';
            echo  $err ;
                       
             echo '        </div>';
            echo '         <script>';
            echo '         $("#arrow_down").click(function() {';
             echo '            $("#for_slide_login").slideToggle(1000).css({"display":"block","z-index":"1"});';
              echo '       });';
            echo '         </script>';
            echo '     </div>';
                
                 }
                               
                       ?>
                
                <div id="for_nav">
                    
                   
                </div>
                    <!--  <div id="logo">&nbsp;</div>
                    <div id="log_in">&nbsp;</div> -->
        <?php require_once 'master.php';?>
                    
                </div>
            </header>


        <section style=" position: absolute; height: 876px;width: 698px;border: 0px solid yellow;background-image: url(Images/section.gif);top: 252px;left: 140px;">
            <div id="holding">
                <div id="into_LS">
                    
                    
                </div>
                <div id="into_RS">
                    
                    
                </div>
            
            </div>
       <footer>
                footer
            </footer>
        </section>
        

    </div>

</body>
</html>
