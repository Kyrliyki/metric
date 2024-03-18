<?php
require_once "config.php";
if (isset($_POST["name"])){
    $name = mysqli_real_escape_string($DataBase, trim($_POST["name"]));
	$cotegories = mysqli_real_escape_string($DataBase, trim($_POST["cotegories"]));
    $color = mysqli_real_escape_string($DataBase, trim($_POST["color"]));
    $mater = mysqli_real_escape_string($DataBase, trim($_POST["mater"]));
    $naznac = mysqli_real_escape_string($DataBase, trim($_POST["naznac"]));
    $text = mysqli_real_escape_string($DataBase, trim($_POST["text"]));
    $id=$_POST["id"];
    $sql = "UPDATE medel SET name='".$name."', manufacturer=".$cotegories.", price=".$text." , color=".$color." , matr=".$mater." , naznac=".$naznac." WHERE id='".$id."'";
    
	if(mysqli_query($DataBase, $sql)){
        echo "<h3 style='background-color: green'>Данные успешно добавлены</h3>";
    } else{
        //echo "Ошибка: " . mysqli_error($DataBase);
    }
    mysqli_close($DataBase);
    header("location: forums.php");
}
if($_POST["delit"]=='Удалить'){
    $id=$_POST["id"];
    $sql = "DELETE FROM medel WHERE id=".$id;
    echo $sql;
    if(mysqli_query($DataBase, $sql)){
        echo "<h3 style='background-color: green'>Данные успешно добавлены</h3>";
    } else{
        //echo "Ошибка: " . mysqli_error($DataBase);
    }
    header("location: forums.php");
    mysqli_close($DataBase);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSell</title>
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
                    <li class="nav-item"><a href="forums.php">главная</a></li>
                    <li class="nav-item"><a href="create_manufacturer.php">добавление производителя</a></li>
                </ul>
            </nav>
            <a class="bar-icon" id="iconBar" onclick="hideIconBar()"><i class="fa fa-bars"></i></a>
            <div class="brand"></div>
            
        </div>
    </header>
    <div class="container">
        <div class="subforum">
            <div class="subforum-titlee"><h1>Изменение товара</h1></div>
            <?
                $sql = "SELECT t1.* , t2.name_manufacturer , t3.name_color , t4.name_mater , t5.name_naznac
                FROM medel AS t1 
                    JOIN manufacturer AS t2  ON t1.manufacturer=t2.id
                    JOIN color AS t3  ON t1.color=t3.id
                    JOIN matr AS t4  ON t1.matr=t4.id
                    JOIN naznac AS t5 ON t1.naznac=t5.id
                    WHERE t1.id=".$_GET["id"];
                if(!empty($sql)){
                $result = $DataBase->query($sql);
                foreach($result as $row){
                $cotegories_old=$row["manufacturer"];
                $color_old=$row["color"];
                $matr_old=$row["matr"];
                $naznac_old=$row["naznac"];
                
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="subforum-titlee">
                    <h1>Название</h1>
                    <input type="text" name='name' class="form-control">
                </div>
                <div class="subforum-titlee">
                    
                        <label for="cotegories">Выберите Производителя:</label>
                        <select name="cotegories" id="cotegories" class="select-categories">
                        <?
                        $sql="SELECT name_manufacturer , id
                        FROM manufacturer";
                        $search = $DataBase->query($sql);
                        foreach($search as $row){?>
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["cotegories"]) && $row['id']==$cotegories_old) echo ' selected';?>><?=$row['name_manufacturer']?></option>
                        <?}}?>
                    </select>
                    
                </div> 
                <div class="subforum-titlee">
                    
                        <label for="cotegories">Выберите цвет:</label>
                        <select name="color" id="cotegories" class="select-categories">
                        <?
                        $sql="SELECT name_color , id
                        FROM color";
                        $search = $DataBase->query($sql);
                        foreach($search as $row){?>
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["color"]) && $row['id']==$color_old) echo ' selected';?>><?=$row['name_color']?></option>
                        <?}?>
                    </select>
              
                </div>
                <div class="subforum-titlee">
                   
                        <label for="cotegories">Выберите матерьял:</label>
                        <select name="mater" id="cotegories" class="select-categories">
                        <?
                        $sql="SELECT name_mater , id
                        FROM matr";
                        $search = $DataBase->query($sql);
                        foreach($search as $row){?>
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["mater"]) && $row['id']==$matr_old) echo ' selected';?>><?=$row['name_mater']?></option>
                        <?}?>
                    </select>
                   
                </div>
                <div class="subforum-titlee">
                    
                        <label for="cotegories">Выберите назначение:</label>
                        <select name="naznac" id="cotegories" class="select-categories">
                        <?
                        $sql="SELECT name_naznac , id
                        FROM naznac";
                        $search = $DataBase->query($sql);
                        foreach($search as $row){?>
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["naznac"]) && $row['id']==$naznac_old) echo ' selected';?>><?=$row['name_naznac']?></option>
                        <?}?>
                    </select>
                    
                </div> 
                <div class="subforum-titlee">
                    <h1>Цена</h1>
                    <input type="text" name='text' class="form-control">
                </div>
                
                <div class="subforum-titlee">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </div>
                </div>
                <input type="hidden" name ="id" id="id" value ="<?=$_GET["id"]?>">
            </form>
            <?}?>
        </div>
        <?
        $sql = "SELECT t1.* , t2.name_manufacturer , t3.name_color , t4.name_mater , t5.name_naznac
        FROM medel AS t1 
             JOIN manufacturer AS t2  ON t1.manufacturer=t2.id
             JOIN color AS t3  ON t1.color=t3.id
             JOIN matr AS t4  ON t1.matr=t4.id
             JOIN naznac AS t5 ON t1.naznac=t5.id
             WHERE t1.id=".$_GET["id"];
        
        $result = $DataBase->query($sql);
        foreach($result as $row){
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name ="id" id="id" value ="<?=$_GET["id"]?>">
        <div class="subforum">
            <div class="subforum-titlee">
                    <input type="submit" name="delit" class="btn btn-primary" value="Удалить">
            </div>
        </div>
        </form>
                
        <div class="container">
            <div class="subforum">
                <div class="subforum-titlee"><h1>Было</h1></div>
            </div>
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
        <div class="subforum-row">
                  
            <div class="subforum-description subforum-column">
                <h4><a href=post_by_id.php?post_id=<?=$row["id"]?>><?=$row["name"]?></a></h4>
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
        <?}?>
    </div>
    <footer>
        <span>  </span>
    </footer>
    <script src="main.js"></script>
</body>
</html>