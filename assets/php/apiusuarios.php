<?php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        include('connsql.php');

        switch($_POST['opcion']){
            // valida si un usuario ya existe en la base de datos
            case 'iniciarsesion':
                // declaramos variables que recibiran los post
                $usuario = $_POST['Usuario'];
                $clave = $_POST['Clave'];

                // contruimos la consulta sql
                $query = $conxion ->prepare("SELECT * FROM TblUsuarios WHERE Usuario = '$usuario' AND Clave = HASHBYTES('SHA1','$clave')");
                // ejecutamos la consulta
                $query ->execute();

                //$res = $query ->fetchAll(PDO::FETCH_ASSOC);

                // recorremos la consulta y convertimos en Array
                $res = $query->fetchAll();                
                //print_r(count($res));
                //var_dump($res);

                // condicionamos segun el tamanio del array
                if(count($res)>0) {
                    $response["error"] = false;
                    $response["mensaje"] = "Datos correctos";
                } else {
                    $response["error"] = true;
                    $response["mensaje"] = "Datos incorrectos";                
                }

                break;

        }

        $conxion = null;
        echo json_encode($response);

    }
    
?>