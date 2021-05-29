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
     <script type="text/javascript" lang="javascript" src="script.js"></script>
    </script>
</head>

<body>
    <div>
        <a href="index.php" role="button" class="btn btn-primary btn-lg btnred ">
            Indietro</a>
    </div>
    <div class="text-center">
        <div class=" text-center" autofocus>

            <h1>Zaino <?php echo $_SESSION["zaino"] ?></h1>
        </div>
        <div>

            <div class="row justify-content-center">
                <form action="aggpresidi.php" method="POST" name="affFPresidi" onSubmit="return aggiornaFormPresidi()">
                    <div class="form-group form-control">
                        <input type="text" name='elemento' placeholder='Elemento' required>
                        <input type="text" name='quantita' placeholder="Quantità" required >
                        <button type="submit" name="update" class="btn btn-primary btn-sm btnred">Update</button>
                        
                    </div>
                
                </form>
                
            </div>
            <?php
             echo"<h5 >Presidi</h5>";
             echo "</table>";
             $conn=pg_connect("host=localhost port=5432 dbname=SAP user=postgres password=admin")
             or die('Could not connect: '. pg_last_error()); 
             $cod=$_SESSION['zaino'];
             $sql=" SELECT elemento,quantità from presidi where codice='$cod' order by elemento";
             $queryRecords = pg_query($conn, $sql) or die("error to fetch inventario data");
            
             echo "<table class='text-center'>";
             echo "<thead><tr><th>Elemento</th><th>Quantità</th></tr></thead>";
             while($row=pg_fetch_array($queryRecords,null,PGSQL_ASSOC)){
                $elemento1=$row['elemento'];
                  echo "<tr><td>". $row['elemento']. "</td><td>". $row['quantità']."</td></tr>";
             }
             echo "</table>";
            echo "</br></br>";
?>
<div>

<div class="row justify-content-center">
    <form action="aggfialario.php" method="POST" name="aggFform" onSubmit="return aggiornaFormFialario()">
        <div class="form-group form-control">
            <input type="text" name='elemento' placeholder='Elemento' required>
            <input type="text" name='quantita' placeholder="Quantità"  required>
            <input type="date" name='scadenza' placeholder="Scadenza"  required>
            <button type="submit" name="update" class="btn btn-primary btn-sm btnred">Update</button>
          
            
        </div>
    
    </form>
    
</div>


<?php
             echo"<h5 >Fialario</h5>";
             $cod=$_SESSION['zaino'];
             $sql=" SELECT elemento,quantità,scadenza from inventario where codice='$cod' order by elemento";
             $queryRecords = pg_query($conn, $sql) or die("error to fetch inventario data");
             echo "<table class='centro'>";
             echo "<tr><th>Elemento</th><th>Quantità</th><th>Scadenza</th></tr></thead>";
             while($row=pg_fetch_array($queryRecords,null,PGSQL_ASSOC)){
                 $el=$row['elemento'];
                 $scad1=$row['scadenza'];
                 $scad2=date("d-m-Y", strtotime($scad1));
                  echo "<tr><td>". $row['elemento']. "</td><td>". $row['quantità']. "</td><td>".$scad2."</td></tr>";
             }
             echo "</table>";

           ?>
        </div>
</body>