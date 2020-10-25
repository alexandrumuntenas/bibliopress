<?php

        // Valores MYSQL
        $serverMySQL = 'localhost'; //Host de la base de datos
        $dbMySQL = 'bibliopress'; //Nombre de la base de datos
        $userMySQL = 'root'; //Usuario de la base de datos
        $pwdMySQL = ''; //Contraseña del usuario de la base de datos
        $tableMySQL = 'bp_catalogo';  //Nombre de la tabla en la base de datos
        
        
        // Credenciales subida de archivos
        
        $userUpload = 'a3media'; //Usuario de carga
        $pwdUpload = '4312'; //Contraseña del usuario de carga
        
        // Otros parametros
        $sname = 'IES Montevives'; //Nombre de la biblioteca/institución
        
        $databaseconnection = mysqli_connect($serverMySQL,$userMySQL,$pwdMySQL,$dbMySQL);
        
        //Parámetro Lista
        $CantidadMostrar=9;
        