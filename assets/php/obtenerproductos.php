<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include('connsql.php');

        $producto = $_POST['producto'];

        try {
            // contruimos la consulta sql            
            $consulta = $conxion -> prepare("SELECT PRODUCTO,DESCRIPCIO,LINEA,PRECIO,
            cast('' as xml).value('xs:base64Binary(sql:column(\"IMAGEN\"))', 'varchar(max)') AS IMAGEN
                                                            FROM
                                                                (SELECT 
                                                                PRODUCTO,DESCRIPCIO,B.DESC_LIN AS LINEA,
                                                                CASE 
                                                                    WHEN ESQIMP='01' THEN ROUND(PRECIOP * 1.15,2)
                                                                    WHEN ESQIMP='02' THEN ROUND(PRECIOP * 1.18,2)
                                                                    ELSE ROUND(PRECIOP,2)
                                                                END AS PRECIO,
                                                                CAST(A.IMAGEN as varbinary(MAX)) AS IMAGEN
                                                                FROM CATINVEN A
                                                                LEFT JOIN LINEAS B ON A.LINEA = B.CLV_LIN
                                                                WHERE PRODUCTO = '$producto'
                                                                ) AS T");
            // ejecutamos la consulta
            $consulta ->execute();

            // recorremos la consulta y convertimos en Array                      
            $respuestaconsulta = $consulta->fetchAll(PDO::FETCH_ASSOC);


            $response["tablaproductos"] = $respuestaconsulta;
            $response["mensajeobtenerproductos"] = "Productos obtenidos con éxito";
        }catch(Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }

        $conxion = null;        
        echo json_encode($response);
    }

?>