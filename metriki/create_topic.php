<?php
require_once "config.php";
if (isset($_POST["name"])){
    $name = mysqli_real_escape_string($DataBase, trim($_POST["name"]));
	$cotegories = mysqli_real_escape_string($DataBase, trim($_POST["cotegories"]));
    $color = mysqli_real_escape_string($DataBase, trim($_POST["color"]));
    $mater = mysqli_real_escape_string($DataBase, trim($_POST["mater"]));
    $naznac = mysqli_real_escape_string($DataBase, trim($_POST["naznac"]));
    $text = mysqli_real_escape_string($DataBase, trim($_POST["text"]));

    $sql = "INSERT INTO medel (name,manufacturer,price,color,matr,naznac) VALUES ('$name','$cotegories','$text','$color','$mater','$naznac')";
    //echo $sql;
	if(mysqli_query($DataBase, $sql)){
        echo "<h3 style='background-color: green'>Данные успешно добавлены</h3>";
    } else{
        echo "Ошибка: " . mysqli_error($DataBase);
    }
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
            <div class="subforum-titlee"><h1>Добавление товара</h1></div>
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
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["cotegories"]) && $row['id']==$_GET["cotegories"]) echo ' selected';?>><?=$row['name_manufacturer']?></option>
                        <?}?>
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
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["color"]) && $row['id']==$_GET["color"]) echo ' selected';?>><?=$row['name_color']?></option>
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
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["mater"]) && $row['id']==$_GET["mater"]) echo ' selected';?>><?=$row['name_mater']?></option>
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
                        
                            <option value="<?=$row['id']?>" <?php if (!empty($_GET["naznac"]) && $row['id']==$_GET["naznac"]) echo ' selected';?>><?=$row['name_naznac']?></option>
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
            </form>
        </div>
    </div>
    <footer>
        <span>  </span>
    </footer>
    <script src="main.js"></script>
</body>
</html>