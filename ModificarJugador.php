<?php include("includes/header.php") ?>
<?php include("db.php") ?>

    <div class="d-flex" id="wrapper">

      <?php include("includes/sidebar.php") ?>

      <!-- Page Content -->
      <div id="page-content-wrapper">

        <?php include("includes/nav.php") ?>

        <?php
          if(isset($_GET["id_jugador"])){
            $id_jugador = $_GET["id_jugador"];
            $query = "SELECT * FROM jugador WHERE id = '$id_jugador'";
            $resultado = mysqli_query($conexion, $query);
            $array = mysqli_fetch_array($resultado);
            $nombre_jugador = $array["nombre"];
          }


         ?>

        <div class="container-fluid">
          <?php if(isset($_GET["id_jugador"])){ ?>
          <h1 class="mt-4">Modificar a <?= $nombre_jugador ?></h1>

          <form action="ModificarJugador.php" method="POST">
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
              <?php
              $id_jugador = $_GET["id_jugador"];
              $query = "SELECT id_equipo FROM jugador WHERE id = '$id_jugador' ";
              $resultado = mysqli_query($conexion, $query);
              $array = mysqli_fetch_array($resultado);
               ?>
              <input type="hidden" name="id_equipo" value="<?=  $array["id_equipo"] ?>">
              <input type="hidden" name="id_jugador" value="<?= $id_jugador ?>">
            </div>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </form>
        <?php } ?>

        <?php
          if(isset($_POST["nombre_jugador"])){
            $nombre_jugador = $_POST["nombre_jugador"];
            $posicion_jugador = $_POST["posicion_jugador"];
            $id_equipo = $_POST["id_equipo"];
            $id_jugador = $_POST["id_jugador"];
            $query = "UPDATE jugador SET nombre = '$nombre_jugador', posicion = '$posicion_jugador',
                                         id_equipo = '$id_equipo' WHERE id='$id_jugador'";
            mysqli_query($conexion, $query);

            if(mysqli_query($conexion, $query)){
              echo "<h3>El jugador se ha modificado satisfactoriamente.</h3>";
            }
          }
          ?>
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
