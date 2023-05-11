<?php

    
    $conxion=new PDO("sqlsrv:server=DESKTOP-0THLGS7\SQLEXPRESS;database=CAJA50","sa","Tecno!1");

    if(!$conxion){        
        echo "Error (sqlsrv_connect): ".print_r(sqlsrv_errors(), true);
    }    

    /*
    try{
        $consulta = $conxion ->prepare("SELECT * FROM CATINVEN");
        $consulta ->execute();
        $datos = $consulta ->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($datos);

        foreach($datos as &$valor){        
            echo($valor['PRODUCTO']." ".$valor['DESCRIPCIO']  );
        }


    }catch(Exception $e){
        echo("Error!");
    }
    */

?>