<?php include("includes/header.php") ?>
<?php include("db.php") ?>

    <div class="d-flex" id="wrapper">

      <?php include("includes/sidebar.php") ?>

      <!-- Page Content -->
      <div id="page-content-wrapper">

        <?php include("includes/nav.php") ?>

        <div class="container-fluid">
          <?php if(!isset($_POST["nombre_jugador"])){ ?>
          <h1 class="mt-4">Insertar jugadores a un club</h1>

          <form action="Insertar.php" method="POST">
            <div class="form-group">
              <label >Seleccione un equipo</label>
              <select class="custom-select" name="equipo">
                <?php

                  $query = "SELECT * FROM equipo";
                  $resultado = mysqli_query($conexion, $query);

                  while($equipo = mysqli_fetch_array($resultado)){?>
                    <option value="<?= $equipo['id'] ?>"> <?= $equipo["nombre"] ?> </option>
                  <?php } ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
        <?php } ?>

          <hr>

          <?php

          if(isset($_POST["equipo"])){
            $id_equipo = $_POST["equipo"];
            $query = "SELECT nombre FROM equipo WHERE id = '$id_equipo'";
            $resultado = mysqli_query($conexion, $query);
            $array = mysqli_fetch_array($resultado);

            $nombre_equipo = $array["nombre"];

          }


            if(isset($_POST["equipo"])){?>
              <h2>Ingrese un jugador para: <?= $nombre_equipo ?></h2>
              <form action="Insertar.php" method="POST">
                <div class="form-group">
                  <label for="nombre_jugador">Nombre: </label>
                  <input onkeypress="return soloLetras(event)" type="text" class="form-control" id="nombre_jugador" name="nombre_jugador">
                </div>
                <div class="form-group">
                  <label for="posicion_jugador">Posición: </label>
                  <select class="custom-select" name="posicion_jugador">
                    <?php
                      $query = "SELECT DISTINCT posicion FROM jugador";
                      $resultado = mysqli_query($conexion, $query);
                     ?>
                    <?php while($row = mysqli_fetch_array($resultado)){ ?>
                      <option value="<?= $row["posicion"] ?>"><?= $row["posicion"] ?></option>
                    <?php } ?>
                  </select>
                  <input type="hidden" name="id_equipo" value="<?= $_POST["equipo"]  ?>">
                </div>
                <button type="submit" class="btn btn-primary">Insertar</button>
              </form>
            <?php } ?>

            <?php
              if(isset($_POST["nombre_jugador"])){
                $nombre_jugador = $_POST["nombre_jugador"];
                $posicion_jugador = $_POST["posicion_jugador"];
                $id_equipo = $_POST["id_equipo"];

                $query = "INSERT INTO jugador (nombre, posicion, id_equipo)
                          VALUES ('$nombre_jugador', '$posicion_jugador', '$id_equipo')";
                mysqli_query($conxion, $query);

                if(mysqli_query($conexion, $query)){
                  echo "<h3>El jugador se ha añadido satisfactoriamente.</h3>";
                }
              }

             ?>

        </div>
      </div>
      <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- SCRIPT -->

    <script>
        function soloLetras(e){
           key = e.keyCode || e.which;
           tecla = String.fromCharCode(key).toLowerCase();
           letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
           especiales = "8-37-39-46";

           tecla_especial = false
           for(var i in especiales){
                if(key == especiales[i]){
                    tecla_especial = true;
                    break;
                }
            }

            if(letras.indexOf(tecla)==-1 && !tecla_especial){
                return false;
            }
        }
    </script>

    <?php include("includes/footer.php") ?>
