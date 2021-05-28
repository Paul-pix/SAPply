<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>SAPply - Aggiorna zaino</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="../logo/SAPply_logo_32x32.png" sizes="32x32">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" lang="javascript" src="../js/bootstrap.min.js">
    </script>
</head>
<body>
<div>
<a href="index.php" role="button" class="btn btn-primary btn-lg  " style="background-color:#ff555f; ;color:whitesmoke">  
                           Indietro</a>
</div>
<div class="text-center">
            <div class=" text-center" autofocus>
                
                <h1>Zaino <?php echo $_SESSION["zaino"] ?></h1>
            </div>
            <div>
            <?php
             
             $conn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")
             or die('Could not connect: '. pg_last_error());
             echo"<h5 >Presidi</h5>";
             echo "</table>";
             
             $cod=$_SESSION['zaino'];
             $sql=" SELECT elemento,quantità from presidi where codice='$cod' order by elemento";
             $queryRecords = pg_query($conn, $sql) or die("error to fetch inventario data");
            
             echo "<table class='text-center'>";
             echo "<thead><tr><th>Elemento</th><th>Quantità</th><th>Edit</th></tr></thead>";
             while($row=pg_fetch_array($queryRecords,null,PGSQL_ASSOC)){
                  echo "<tr><td>". $row['elemento']. "</td><td>". $row['quantità']."</td><td><a href='aggiorna.php'?edit class='btn btn-info btn-sm' style='background-color:#ff5555 ;color:whitesmoke'>Edit</a></td></tr>";
             }
            echo "</table>";
            echo "</br></br>";
             echo"<h5 >Fialario</h5>";
             $cod=$_SESSION['zaino'];
             $sql=" SELECT elemento,quantità,scadenza from inventario where codice='$cod' order by elemento";
             $queryRecords = pg_query($conn, $sql) or die("error to fetch inventario data");
             echo "<table class='centro'>";
             echo "<tr><th>Elemento</th><th>Quantità</th><th>Scadenza</th><th>Edit</th></tr></thead>";
             while($row=pg_fetch_array($queryRecords,null,PGSQL_ASSOC)){
                  echo "<tr><td>". $row['elemento']. "</td><td>". $row['quantità']. "</td><td>".$row['scadenza']."</td><td><a href='aggiorna.php'?edit class='btn btn-info btn-sm' style='background-color:#ff5555 ;color:whitesmoke'>Edit</a></td></tr>";
             }
             echo "</table>";

           ?>
    </div>
</body>