<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERROR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include_once("config_login.php");
        //https://www.php.net/manual/es/pdo.connections.php
        try {
            // Conexion a la Base de Datos
            $conn = new PDO("mysql:host=" . SERVER_NAME . ";dbname=" . DATABASE_NAME, USER_NAME, PASSWORD);
            //echo "Conexion Exitosa";
            $usr = $_POST['username']; //USER NAME DEL FORMULARIO
            $pass = $_POST['password']; //PASSWORD DEL FORMULARIO
            $hashed_pass = hash('sha256', $pass); //PARA ENCRIPTAR PASSWORD
            $sql = "select * from users where (username=:usr or email=:usr) and (active='SI') and (password=:hashed_pass)"; //NO SE VINCULA LAS VARIABLES DE PHP $ CON SQL. SE PONE :
            $stmt = $conn->prepare($sql);  //SANEA la base de datos prepared statement
            $stmt->bindValue(':usr', $usr); //se asocia el :usr con $usr
            $stmt->bindValue(':hashed_pass', $hashed_pass);
            $stmt->execute(); //RECIEN AHORA SE EJECUTA 
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row == 0) {
                //echo "Login Incorrecto";

    ?>
                <div class="alert alert-danger">
                    <a href="login.html" class="close" data-dismiss="alert">×</a>
                    <div class="text-center">
                        <h5><strong>¡Error!</strong> Login Invalido.</h5>
                    </div>
                </div>

    <?php
            } else {
                //echo "Login Correcto";
                session_start();
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $_SESSION['time'] = date('H:i:s'); //$_SESSION guarda datos dentro del servidor
                $_SESSION['username'] = $usr;
                $_SESSION['logueado'] = true; // indica que el usuario esta logueado
                header("location:welcome.php"); 
            }
        } catch (PDOException $e) {
            echo "¡Error!: ";
            die();
        }
    } else {
        exit("Error");
    }

    ?>


</body>

</html>