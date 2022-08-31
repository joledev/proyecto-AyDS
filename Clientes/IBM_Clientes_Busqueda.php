<html>
<head runat="server">
    <title> Clientes </title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie-edge">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="../CSS/tablas.css">

    <link href="../CSS/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../CSS/cssVentas.css" rel="stylesheet" type="text/css" />

    <script src="../JavaScript/bootstrap.js"></script>
    <script src="../JavaScript/bootstrap.min.js"></script>

</head>
<body>
    
    <header>

        <nav class="navbar navbar-expand-sm badge-dark navbar-dark">

            <a class="navbar-brand" href="index.php">
                <img src="../Images/luces.jpg" class="Icono" />
            </a>

            <ul class="navbar-nav">

                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Inicio</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="IBM_Clientes.php?case=0">Clientes</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="../Carros/IBM_Carros.php?case=0">Carros</a>
                </li>

            </ul>

            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link fab fa-facebook" href="https://www.facebook.com" target="_blank"></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fab fa-whatsapp" href="https://web.whatsapp.com/" target="_blank"></a>
                </li>
            </ul>

        </nav>

    </header>

    <br>

    <br>

    <div class="container">
    
        <h4> Registro de clientes </h4>

        <div class="row bg-light border">
        
            <div class="col-lg-8 col-md-6 col-sm-6">
            
                <a id="BtnNuevo" class="btn btn-md btn-secondary fa fa-plus-square pr-3" href="IBM_Clientes_N.php"> Nuevo Cliente </a>
                <a id="BtnMnuListado" class="btn btn-md btn-secondary fa fa-list-alt pr-3" href="IBM_Clientes_Lista.php"> Listado </a>

            </div>

            <form class="col-lg-4 col-md-6 col-sm-6" action="IBM_Clientes_Busqueda.php" method="post">
            
                <div class="row">
                
                    <dic class="col-lg-8 col-md-6 col-sm-6">
                        <td><input type="text" name="TbCriterioBusqueda" class="form-control" placeholder="Criterio de busqueda"></td>
                    </dic>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <td><input type="submit" value=" Buscar" id="BtnBuscar" class="btn btn-ms btn btn-success fa fa-file-search pr-3"></td>
                    </div>
                
                </div>

            </form>
        
        </div>

        <br>

        <table>
        
            <caption> Clientes </caption>

            <tr>
            
                <th> Nombre </th>
                <th> Celular </th>
                <th> Numero de carros </th>
                <th>  </th>

            </tr>

            <?php

                try {

                    $busqueda = $_POST['TbCriterioBusqueda'];

                    $base = new PDO('mysql:host=localhost; dbname=manolo', 'root', '');
                    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $base->exec("SET CHARACTER SET utf8");

                    $sql = "SELECT ID, NOMBRE, CELULAR, N_CARROS
                            FROM CLIENTES
                            WHERE NOMBRE LIKE '%$busqueda%' ||
                                  APELLIDO LIKE '%$busqueda%' ||
                                  CELULAR LIKE '%$busqueda%' ||
                                  TELEFONO LIKE '%$busqueda%' ||
                                  EMAIL LIKE '%$busqueda%' ||
                                  EMPRESA LIKE '%$busqueda%' ||
                                  RFC LIKE '%$busqueda%'";
                    
                    $resultado = $base->prepare($sql);
                    $resultado->execute();

                    echo 
                    "La busqueda fue: " . $busqueda . " ";

                    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {

                        echo 
                        "<tr>
            
                        <td>" . $registro['NOMBRE'] . "</td>
                        <td>". $registro['CELULAR'] . "</td>
                        <td> " . $registro['N_CARROS'] . " Carros </td>
                        <td> <a id='BtnLstEditar' class='btn btn-md btn btn-primary  fa fa-edit pr-3' href='IBM_Clientes_E.php?c=" . $registro['ID'] . "'> Editar </a> 
                             <a id='BtnLstBorrar' class='btn btn-md btn btn-danger  fa fa-trash-alt pr-3' href='IBM_Clientes_B.php?c=" . $registro['ID'] . "'> Borrar </a> 
                             <a id='BtnLstVer' class='btn btn-ms btn btn-success fa fa-file-search pr-3' href='IBM_Clientes_V.php?c=" . $registro['ID'] . "'> Ver </a> </td>
                        </tr>";

                    }

                    $resultado->closeCursor();

                } catch(Exception $e) {

                    die ('Error: ' . $e->getMessage());

                }

                $base = null;

            ?>

        </table>
    
    </div>

</body>
</html>