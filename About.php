
<?php 
require_once 'dbairplans_func.php';

session_start();
$pdt_id=0;
$action = 'noaction';
//$product_id=null;
$Abouttitle = 'about';


if($_SESSION["actlname"] == null)
    {
      header("Location:defualt.php");
    }
 else
 {
 
 
     

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    if(isset($_POST["command"]) && $_POST["command"]=="disconnect")
    {
        session_destroy();
        header("Location:index.php");
    }
    
}

 }

?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>about</title>
        

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css_1.css"/>

    <script type="js" src="jquery-1.7.1.min.js"></script>
    
    
    <style>
            #ul01 li:nth-child(0)
            {
                background-color: #c4cec8;
            }
            
            #into_LS #span22
            {
             position: absolute;
             top: 100px;
             right:45%;
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
                left: 13%;
                border:0px solid pink;
                width:350px ;
                height: 620px;
                overflow: auto;
                overflow-x: hidden;
                overflow-y: auto;
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
        <?php require_once 'master.php';?>
            </header>


        <section>
            <div id="holding">
                <div id="into_LS">
                    
                    
                    <span id="span22" style="font-size: 30px;"><?php echo $Abouttitle;?></span>
                    <br />
                    <br />
                    <div id="tabs-1" dir='ltr' style='font-family: serif; font-size: 18px;'><br /><br />
                        <br /><br />
                        <br /><br />
                        aviv tsfira (ats)<br /><br />
                        <br /><br />
                        avivtsfira@gmail.com<br /><br />
                        <br /><br />
                        <br /><br />
                        
                    
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
        var result = confirm("האם ברצונך למחוק את המוצר ממסד הנתונים?");
        if (result==true)
            return true;
        else
            return false;
    });
    
    
    
    
</script>
</body>
</html>













                     
