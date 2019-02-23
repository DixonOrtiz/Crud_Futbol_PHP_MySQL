<?php include("includes/header.php") ?>
<?php include("db.php"); ?>

    <div class="d-flex" id="wrapper">

      <?php include("includes/sidebar.php") ?>

      <!-- Page Content -->
      <div id="page-content-wrapper">

        <?php include("includes/nav.php") ?>

        <div class="container-fluid">
          <h1 class="mt-4">Mostrar Equipo</h1>

          <form action="Mostrar.php" method="POST">
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
          <hr>

          <?php if(isset($_POST["equipo"])){
            $id_equipo = $_POST["equipo"];
            $query = "SELECT nombre FROM equipo WHERE id = '$id_equipo'";
            $resultado = mysqli_query($conexion, $query);
            $array = mysqli_fetch_array($resultado);
            $nombre_equipo = $array["nombre"];

            $query = "SELECT * FROM jugador WHERE id_equipo = '$id_equipo'";
            $resultado = mysqli_query($conexion, $query);

          } ?>

          <?php
          if(isset($nombre_equipo)){?>
            <h3>Jugadores de <?= $nombre_equipo ?></h3>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Posición</th>
                </tr>
              </thead>
              <tbody>

                <?php while($jugador = mysqli_fetch_array($resultado)){ ?>
                  <tr>
                    <td><?= $jugador["id"] ?></td>
                    <td><?= $jugador["nombre"] ?></td>
                    <td><?= $jugador["posicion"] ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <hr>
            <h3>Entrenador de <?= $nombre_equipo ?></h3>
            <?php
              $query = "SELECT entrenador.nombre FROM equipo
                        INNER JOIN entrenador ON equipo.id_entrenador = entrenador.id
                        WHERE equipo.id = '$id_equipo'";
              $resultado = mysqli_query($conexion, $query);
              $array = mysqli_fetch_array($resultado);
             ?>
             <div class="alert alert-success" role="alert">
               <?php
                  $nombre_entrenador = $array["nombre"];
                  echo "El entrenador de $nombre_equipo es $nombre_entrenador.";
                ?>
            </div>

            <?php
               $query = "SELECT ciudad.nombre FROM equipo
                         INNER JOIN ciudad ON equipo.id_ciudad = ciudad.id
                         WHERE equipo.id = '$id_equipo'";
               $resultado = mysqli_query($conexion, $query);
               $array = mysqli_fetch_array($resultado);
             ?>
             <div class="alert alert-success" role="alert">
               <?php
                  $nombre_ciudad = $array["nombre"];
                  echo "La ciudad de $nombre_equipo es $nombre_ciudad.";
                ?>
            </div>

          <?php } ?>

        </div>
        <!-- /#page-content-wrapper -->

      </div>
      <!-- /#wrapper -->

    <?php include("includes/footer.php") ?>
