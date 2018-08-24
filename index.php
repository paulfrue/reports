<?php
session_start();
include("sql.php");
?>

<html>
    <head>
	<meta charset="utf-8">
        <title>Ausbildungsberichte</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <script language="javascript" type="text/javascript" src="script/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="script/script.js"></script>
    </head>
    <body>
        <div id="bg"></div>
		<div id="bg_lenseffect"></div>
        <div id="wrapper">
            
            <?php
			include ("modules_layout/layout_timetable.php");
            
            if(isset($_SESSION['loggedin'])) {
                
                include("modules_layout/layout_menu.php");
                
                if(!isset($_GET['p'])) {
                    include("modules_pages/page_view.php");
                }
                
                if($_GET['p'] == 1) {
                    include("modules_pages/page_new.php");
                }
                
                if($_GET['p'] == 4) {
                    include("modules_pages/page_printselect.php");
                }
                
                if($_GET['p'] == 5) {
                    include("modules_pages/page_glossary.php");
                }
                if($_GET['p'] == 6) {
                    include("modules_pages/page_stats.php");
                }
                if($_GET['p'] == 7) {
                    include("modules_pages/page_grades.php");
                }
                if($_GET['p'] == 8) {
                    include("modules_pages/page_resets.php");
                }
            }
            
            else{
                include("modules_pages/page_login.php");
            }
            ?>
        </div>
    </body>
</html>