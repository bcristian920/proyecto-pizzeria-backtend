<?php

/*echo "Estoy en PHP 8";
$foo = "foobar";
$bar = "barbaz";
echo 'Esta ', 'cadena ', 'está ', 'hecha ', 'con múltiple parámetros.', chr(10);
echo 'Esta ' . 'cadena ' . 'está ' . 'hecha ' . 'con concatenación.' . "\n";

echo <<<END
Aquí se utiliza la sintaxis de "here document" para mostrar
múltiples líneas con interpolación de $variable. Nótese
que el finalizador de here document debe aparecer en una 
línea con solamente un punto y coma. ¡Nada de espacios extra!
END;

define("MENSAJE","Bienvenido/a ");
$nameUser="Ana"; //$ es variable

   echo MENSAJE.$nameUser;
   $name="HOLA";

if (isset($name)){
echo "Esta definida";
}
else{
echo "No esta difinida";
}*/


/*funcion isset (): Devuelve TRUE si es una variable
 esta definida y tiene un valor NO NULL*/

//echo $_POST ['password']; contraseña sin encriptar
/*if ($_SERVER['REQUEST_METHOD']==='POST'){ //hace que si o si se tenga que pasar por el login
//arreglo $SERVER, pasa por el string MEHOD, envia los datos del metodo POST 
   echo $_POST ['username'];
   
   $pass=$_POST ['password']; //encripta la contraseña
   $hash_pass= hash('sha256',$pass);
   echo $hash_pass;
   }
   
   else{
       exit("TE ATRAPE"); //funcion EXIT 
   }*/


//define es constante en php
//$mbd = new PDO('mysql:host=localhost;dbname=prueba', $usuario, $contraseña);  PARA CONECTARSE CON MYSQL/BASE DE DATOS
// PDO es una clase
/*try {
   $conn = new PDO("mysql:host=". SERVER_NAME. ";dbname=" . DATABASE_NAME, USER_NAME, PASSWORD);
   echo "Conexion Exitosa";
   }
   catch (PDOException $e) {  //$e VARIABLE OBJETO TIENE METODO Y PROPIEDADES
     echo "¡Error!: " . $e->getMessage() . "<br/>";
     die();                  // VA CON FLECHA PORQUE PUEDE CONCATENAR CON EL .
                              //getMessage ES METODO POR EL PARENTESIS
                              
   }
     
   }*/

   //select username,email,password,active from users where (username='maria' or email='maria@bigdata.com') and active='SI' and password=sha2('123456',256);

include_once('db.class.php');

$link = new Db();
$link -> conection;


?>