<div id="menu_wrapper">
    <?php
    if($_SESSION["role"] == "instructor"){
    ?>
    <div class="menu_item_wrapper">
        <div class="menu_thumb" style="background-image: url('img/menu_icons/view.png');" onclick="location.href='index.php'"></div>
        <div class="menu_name">Ansicht</div>
    </div>
    <div class="menu_item_wrapper">
        <div class="menu_thumb" style="background-image: url('img/menu_icons/logout.png');" onclick="location.href='../modules_functions/function_logout.php'"></div>
        <div class="menu_name">Logout</div>
    </div>
    <?php
    }
    ?>
    <?php
    if($_SESSION["role"] != "instructor"){
    ?>
    <div class="menu_item_wrapper">
        <div class="menu_thumb" style="background-image: url('img/menu_icons/view.png');" onclick="location.href='index.php'"></div>
        <div class="menu_name">Ansicht</div>
    </div>
    <div class="menu_item_wrapper">
        <div class="menu_thumb" style="background-image: url('img/menu_icons/new.png');" onclick="location.href='index.php?p=1'"></div>
        <div class="menu_name">Neuer Bericht</div>
    </div>
    <div class="menu_item_wrapper">
        <div class="menu_thumb" style="background-image: url('img/menu_icons/glossary.png');" onclick="location.href='index.php?p=5'"></div>
        <div class="menu_name">Glossar</div>
    </div>
    <div class="menu_item_wrapper">
        <div class="menu_thumb" style="background-image: url('img/menu_icons/print.png');" onclick="location.href='index.php?p=4'"></div>
        <div class="menu_name">Drucken</div>
    </div>
    <div class="menu_item_wrapper">
        <div class="menu_thumb" style="background-image: url('img/menu_icons/stats.png');" onclick="location.href='index.php?p=6'"></div>
        <div class="menu_name">Statistiken</div>
    </div>
    <div class="menu_item_wrapper">
        <div class="menu_thumb" style="background-image: url('img/menu_icons/grade.png');" onclick="location.href='index.php?p=7'"></div>
        <div class="menu_name">Schulnoten</div>
    </div>
    <div class="menu_item_wrapper">
        <div class="menu_thumb" style="background-image: url('img/menu_icons/resets.png');" onclick="location.href='index.php?p=8'"></div>
        <div class="menu_name">Lab Resets</div>
    </div>
    <div class="menu_item_wrapper">
        <div class="menu_thumb" style="background-image: url('img/menu_icons/logout.png');" onclick="location.href='../modules_functions/function_logout.php'"></div>
        <div class="menu_name">Logout</div>
    </div>
    <?php
    }
    ?>
</div>

<div id="menu_close" onclick="menu();"></div>
<div id="bglayer"></div>