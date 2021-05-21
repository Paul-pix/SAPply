<?php
    session_start();
?>

<html>
    <head>
        <title>SAPply - Gestione zaino</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="icon" type="image/png" href="../logo/SAPply_logo_32x32.png" sizes="32x32">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" lang="javascript" src="../js/bootstrap.min.js">
        </script>
    </head>
    <body class="text-center">

        <header>
            <div class="d-flex flex-column container-left">

                <div class="details">
                    <img src="../images/logo/SAPply_logo_128x128.png" alt="">
                    <h1>Zaino <?php echo $_SESSION['zaino'] ?></h1>
                </div>
                
                <nav id="navbar" class="nav-menu navbar text-center">
                    <ul>
                        <li><a href="#panoramica" class="nav-link scrollto active"><i class="bx"></i> <span>Panoramica</span></a></li>
                        <li><a href="#contenuto" class="nav-link scrollto active"><i class="bx"></i> <span>Contenuto</span></a></li>
                        <li><a href="#aggiorna_inventario" class="nav-link scrollto active"><i class="bx"></i> <span>Aggiorna inventario</span></a></li>
                        <li><a href="#preleva" class="nav-link scrollto active"><i class="bx"></i> <span>Preleva</span></a></li>
                        <li><a href="#consegna" class="nav-link scrollto active"><i class="bx"></i> <span>Consegna</span></a></li>
                    </ul>
                </nav>
                
               
               <a href="../home/index.php" role="button" class="btn btn-primary btn-lg foot " style="background-color:white ;color:#ff5555">  
                            Indietro</a>
            </div> 
        </header>

        <div class="container-right text-center">
                <section id="panoramica" class="panoramica section" autofocus>
                <div><h1>Panoramica</h1></div>
                <!--ultimo volontario che ha usato lo zaino,nome zaino,data ultimo utilizzo,rifornito-->

            </section>
            <section id="contenuto" class="contenuto section">
                <div><h1>Contenuto</h1></div>
            </section>
            <section id="aggiorna_inventario" class="aggiorna_inventario section">
                <div><h1>Aggiorna inventario</h1></div>
            </section>
            <section id="preleva" class="preleva section">
                <div class="center">
                <h1>Preleva</h1>
            
                <form action="panoramica.php" class="form-signin" method="POST" name="prelevaForm" onSubmit="return prelevaForm()">  
                    <input type="text" name="inputName" class="form-control" placeholder="Name"  required/>
                    <input type="date" name="inputDate" class="form-control" required/>
                    
                </form>

                <button class="btn btn-lg btn-primary btn-block" name="prelevaButton" type="submit" style="background-color:#ff5555 ;color:whitesmoke">Preleva</button>
            </div>
                </section>
            <section id="consegna" class="consegna section">
                    <div><h1>Consegna</h1></div>
                    </section>
        </div>

    </body>
</html>