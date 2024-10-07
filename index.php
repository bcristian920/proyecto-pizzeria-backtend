<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Pizze il napolitano</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <header>
        <div id="header-container">
            <div id="logo">
                <img src="img/pizza.svg" alt="imagen del logo">
                <img class="logo-texto" src="img/text.svg" alt="texto del logo">
            </div>
            <nav>
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">NOSOTROS</a></li>
                    <li><a href="sucursales.html">SUCURSALES & DELIVERY</a></li>
                    <li><a href="#">CONTACTO</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="main-content">
        <h2 class="animate__animated animate__bounce">NUESTRAS PIZZAS</h2>
        <div id="cart">
            <i class="fa badge" id="badge" value=0><i class="fa-solid fa-cart-shopping fa-lg"></i></i>
        </div>

        <form accept-charset="utf-8" method="get">
            <div id="search-container">
                <input type="search" size="30" placeholder="Descripción del producto..." id="search-input"
                    name="search-input">
                <button id="search" name="search">Buscar</button>
            </div>







        </form>

        <ul class="gallery">
            <?php
           // $search = $_GET['search-input'];
            $search = isset($_GET['search-input']) ? $_GET['search-input'] : '';
            include_once("config_products.php");
            include_once("db.class.php");
            $link = new Db();

            if (isset($_GET['search'])) {
                $sql = "select c.category_name,p.image,p.product_name,p.price, date_format(p.start_date,'%d/%m/%Y') as date from products p inner join categories c on p.id_category=c.id_category  where product_name like CONCAT ('%', '$search', '%') or category_name like CONCAT('%', '$search', '%') order by p.price";
            } else {
                $sql = "select c.category_name,p.image,p.product_name,p.price, date_format(p.start_date,'%d/%m/%Y') as date from products p inner join categories c on p.id_category=c.id_category  order by p.price";
            }

            try {
                // Conexion a la Base de Datos
                $conn = new PDO("mysql:host=" . SERVER_NAME . ";dbname=" . DATABASE_NAME, USER_NAME, PASSWORD);
                //echo "Conexion Exitosa";
                //$sql = "select c.category_name,p.image,p.product_name,p.price, date_format(p.start_date,'%d/%m/%Y') as date from products p inner join categories c on p.id_category=c.id_category order by p.price";
                $stmt = $link->run($sql, NULL);

                if ($stmt->rowCount()==0){
                    echo "No hay resultados";
                    }
                    
                   /* else
                    {
                    echo "Se han encontrado " . $stmt->rowCount(). " productos";
                    }*/

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetchAll();
            } catch (PDOException $e) {
                echo "¡Error!: ";
                die();
            }
            foreach ($data as $row) {



            ?>
                <li>
                    <div class="box">
                        <figure>
                            <img src="<?php echo $row['image'] ?>" alt="fugazzeta"> <!---row es para atrapar la columna image de sql, que contiene la url de las imagenes. echo es para mostrarlo en pantalla-->
                            <figcaption>
                                <h3> <?php echo $row['category_name'] . " " . $row['product_name'] ?> </h3>
                                <p> <?php echo '$' . " " . $row['price'] ?> </p>
                                <time> <?php echo $row['date'] ?> </time>
                            </figcaption>
                        </figure>
                        <button class="button" value="1">
                            Añadir al carrito <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>




    </div>
    <footer>
        <p>Copyright &copy; <script>
                document.write(new Date().getFullYear());
            </script> Todos los derechos reservados</p>
    </footer>
    <nav id="social">
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-square-instagram"></i></a>
    </nav>
    <script>
        const countButtons = document.querySelectorAll("button").length;
        let products = [];
        for (let i = 0; i < countButtons; i++) {
            document.querySelectorAll("button")[i].addEventListener("click", showValue);
        }

        function showValue() {
            products.push(this.value);
            console.log(products);

            document.getElementById("badge").setAttribute("value", products.length);
        }
    </script>
</body>

</html>