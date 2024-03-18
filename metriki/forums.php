<?php
session_start();
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    
</head>

<body>
    <header>
        <!--NavBar Section-->
       
        <div class="navbar">
            <nav class="navigation hide" id="navigation">
                <span class="close-icon" id="close-icon" onclick="showIconBar()"><i class="fa fa-close"></i></span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="create_manufacturer.php">добавление производителя</a></li>
                    <li class="nav-item"><a href="create_topic.php">добавление товара</a></li>
                </ul>
            </nav>
            <a class="bar-icon" id="iconBar" onclick="hideIconBar()"><i class="fa fa-bars"></i></a>
            
            
        </div>
    </header>
    <div class="container">
        <div class="subforum">
            <div class="subforum-title">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                    <a>Поиск по названию</a>
                    <input type="search" name="search_name">
                    <a>по произодителю</a>
                    <select name="cotegories" id="cotegories" class="select-categories">
                        <option value="">Все Производители</option>
                        <?
                        $sql="SELECT name_manufacturer , id
                        FROM manufacturer";
                        $search = $DataBase->query($sql);
                        foreach($search as $row){?>
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["cotegories"]) && $row['id']==$_GET["cotegories"]) echo ' selected';?>><?=$row['name_manufacturer']?></option>
                        <?}?>
                    </select>
                    <a>по цвету</a>
                    <select name="color" id="cotegories" class="select-categories">
                        <option value="">Все цвета</option>
                        <?
                        $sql="SELECT name_color , id
                        FROM color";
                        $search = $DataBase->query($sql);
                        foreach($search as $row){?>
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["color"]) && $row['id']==$_GET["color"]) echo ' selected';?>><?=$row['name_color']?></option>
                        <?}?>
                    </select>
                    <a>по матерьялу</a>
                    <select name="mater" id="cotegories" class="select-categories">
                        <option value="">Все матерьялы</option>
                        <?
                        $sql="SELECT name_mater , id
                        FROM matr";
                        $search = $DataBase->query($sql);
                        foreach($search as $row){?>
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["mater"]) && $row['id']==$_GET["mater"]) echo ' selected';?>><?=$row['name_mater']?></option>
                        <?}?>
                    </select>
                    <a>по назначению</a>
                    <select name="naznac" id="cotegories" class="select-categories">
                        <option value="">Все назначения</option>
                        <?
                        $sql="SELECT name_naznac , id
                        FROM naznac";
                        $search = $DataBase->query($sql);
                        foreach($search as $row){?>
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["naznac"]) && $row['id']==$_GET["naznac"]) echo ' selected';?>><?=$row['name_naznac']?></option>
                        <?}?>
                    </select>
                    <h1></h1>
                    <a>Поиск по цене от</a>
                    <input type="search" name="search_price_ot">
                    <a> до </a>
                    <input type="search" name="search_price_do">
                    <input type="submit" name="submit" class="primaryy" value="Выбрать">
                </from>
            </div>
            <div class="subforum-row">
                    
                    <div class="subforum-description subforum-column">
                        <h4><a>Название</a></h4>
                    </div>
                    <div class="subforum-stats subforum-column ">
                        <b>Производитель</b>
                    </div>
                    <div class="subforum-info subforum-column">
                        <b>Цвет</b> 
                        
                    </div>
                    <div class="subforum-info subforum-column">
                        <b>Матерьял</b> 
                        
                    </div>
                    <div class="subforum-info subforum-column">
                        <b>Цена</b> 
                        
                    </div>
                    </div>
            
            <?
            if(!empty($_GET["cotegories"])){
                $cotegories="AND t1.manufacturer=".$_GET["cotegories"];
            }
            if(!empty($_GET["color"])){
                $color="AND t1.color=".$_GET["color"];
            }
            if(!empty($_GET["mater"])){
                $mater="AND t1.matr=".$_GET["mater"];
            }
            if(!empty($_GET["naznac"])){
                $naznac="AND t1.naznac=".$_GET["naznac"];
            }
            if(!empty($_GET["search_price_ot"]) and !empty($_GET["search_price_do"])){
                $search_price_dobl="AND t1.price>'".$_GET["search_price_ot"]."' AND t1.price<".$_GET["search_price_do"];
            }
            elseif (!empty($_GET["search_price_ot"]) and empty($_GET["search_price_do"])) {
                $search_price_ot="AND t1.price>".$_GET["search_price_ot"];
            }
            elseif(empty($_GET["search_price_ot"]) and !empty($_GET["search_price_do"])){
                $search_price_do="AND t1.price<".$_GET["search_price_do"];
            }

            $sql = "SELECT t1.* , t2.name_manufacturer , t3.name_color , t4.name_mater , t5.name_naznac
                FROM medel AS t1 
                     JOIN manufacturer AS t2  ON t1.manufacturer=t2.id
					 JOIN color AS t3  ON t1.color=t3.id
					 JOIN matr AS t4  ON t1.matr=t4.id
					 JOIN naznac AS t5 ON t1.naznac=t5.id
                     WHERE t1.name LIKE '%".$_GET["search"]."%'".$cotegories." ".$color." ".$mater." ".$naznac." ".$search_price_dobl." ".$search_price_ot." ".$search_price_do;
           // echo $sql;
            
            $result = $DataBase->query($sql);
            //print_r( $result);
            if(!empty($result)){
                foreach($result as $row){?>
                    <div class="subforum-row">
                    
                        <div class="subforum-description subforum-column">
                        <h4><a href=post_by_id.php?id=<?=$row["id"]?>><?=$row["name"]?></a></h4>
                        </div>
                        <div class="subforum-stats subforum-column ">
                            <b><?= $row["name_manufacturer"]?></b>
                        </div>
                        <div class="subforum-info subforum-column">
                            <b><?= $row["name_color"]?></b> 
                            
                        </div>
                        <div class="subforum-info subforum-column">
                            <b><?= $row["name_mater"]?></b> 
                            
                        </div>
                        <div class="subforum-info subforum-column">
                            <b><?= $row["price"]?></b> 
                            
                        </div>
                    </div>
            
            <?  }
            }
            
            ?>
            
            
        </div>
        
    </div>


    <footer>
        <span>  </span>
    </footer>
    <script src="main.js"></script>
</body>
</html>