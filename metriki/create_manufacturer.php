<?php
require_once "config.php";
$id_add=$_POST["id_add"];
echo $id_add;
switch ($id_add) {
	case '1':
        if (isset($_POST["name"])){
        $name = mysqli_real_escape_string($DataBase, trim($_POST["name"]));
	    $sql = "INSERT INTO color (name_color) VALUES ('$name')";
	    if(mysqli_query($DataBase, $sql)){
            echo "<h3 style='background-color: green'>Данные успешно добавлены</h3>";
        } else{
            echo "Ошибка: " . mysqli_error($DataBase);
        }
        mysqli_close($DataBase);
        }
        break;
    case '2':
        if (isset($_POST["name"])){
        $name = mysqli_real_escape_string($DataBase, trim($_POST["name"]));
	    $sql = "INSERT INTO manufacturer (name_manufacturer) VALUES ('$name')";
	    if(mysqli_query($DataBase, $sql)){
            echo "<h3 style='background-color: green'>Данные успешно добавлены</h3>";
        } else{
            echo "Ошибка: " . mysqli_error($DataBase);
        }
        mysqli_close($DataBase);
        }
        break;
    case '3':
        if (isset($_POST["name"])){
        $name = mysqli_real_escape_string($DataBase, trim($_POST["name"]));
	    $sql = "INSERT INTO matr (name_mater) VALUES ('$name')";
	    if(mysqli_query($DataBase, $sql)){
            echo "<h3 style='background-color: green'>Данные успешно добавлены</h3>";
        } else{
            echo "Ошибка: " . mysqli_error($DataBase);
        }
        mysqli_close($DataBase);
        }
        break;
    case '4':
        if (isset($_POST["name"])){
        $name = mysqli_real_escape_string($DataBase, trim($_POST["name"]));
	    $sql = "INSERT INTO naznac (name_naznac) VALUES ('$name')";
	    if(mysqli_query($DataBase, $sql)){
            echo "<h3 style='background-color: green'>Данные успешно добавлены</h3>";
        } else{
            echo "Ошибка: " . mysqli_error($DataBase);
        }
        mysqli_close($DataBase);
        }
        break;
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
                    <li class="nav-item"><a href="create_topic.php">добавление товара</a></li>
                </ul>
            </nav>
            <a class="bar-icon" id="iconBar" onclick="hideIconBar()"><i class="fa fa-bars"></i></a>
            <div class="brand"></div>
            
        </div>
    </header>
    <div class="container">
        <div class="subforum">
            <div class="subforum-titlee"><h1>Добавление</h1>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
                <div class="subforum-titlee">
                        <select name="id_add" id="id_add" class="select-categories">
                        <option value="1">Цвета</option>
                        <option value="2">Производителя</option>
                        <option value="3">Матерьяла</option>
                        <option value="4">Назначения</option>
                    </select>
                    <h1>Название</h1>
                    <input type="text" name='name' class="form-control">
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