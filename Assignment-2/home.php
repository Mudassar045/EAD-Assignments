<?php session_start();?>
<?php 

    if($_SESSION["utype"]==1)
    {
        include('navbar.php');
      
      /*  echo "<html>";
        echo "<head></head>";
        echo "<body>";
        echo '<h1 style="text-align:center; font-family:"Courier New", Courier, monospace"><b>WELCOME TO HOMEPAGE</b></h1>' ;
        echo "</body>";
        echo "</html>";
        */
    }
    else if($_SESSION["utype"]==2)
    {
        include('usernavbar.php');
    }
    else
    {
        header('Location:login.php');
        exit();
    }

?>
<html>
<head>    
</head>
<body>
        <h1 style="text-align:center; font-family:'Courier New', Courier, monospace"><b>WELCOME TO HOMEPAGE</b></h1>        
    </body>
</html>