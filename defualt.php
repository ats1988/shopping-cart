
<?php

$defual_error_note = "error message: Secure Connection Failed";



?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    
    <title>error Login</title>
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
            
            #ul01 li:nth-child(5)
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
            #spani 
            {
             position: absolute;
             top: 150px;
             left:8.5%;
             font-size: 25px; 
            }
    </style>
</head>
<body>
    <div id="wrapper">

            <header>
                <div id="connection" dir="ltr">
                   
                    
                </div>
                
        <div id="for_nav"></div>
        <div id="logo"></div>
        <div id="log_in"></div>
     
        
            </header>

        <section>
                        <div id="holding">
                <div id="into_LS">
                    
                    
                    
                    <br />
                    
                    
                    <div id="contain_ul">
                        <span id="spani" style="color: red;"><?php echo $defual_error_note."<br /><br />";?></span>
                        <ul>
                        <li><abbr title="delete product"><a href="index.php">Main Page</a></abbr></li>
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

