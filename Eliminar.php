<?php include("includes/header.php") ?>
<?php include("db.php") ?>

    <div class="d-flex" id="wrapper">

      <?php include("includes/sidebar.php") ?>

      <!-- Page Content -->
      <div id="page-content-wrapper">

        <?php include("includes/nav.php") ?>

        <div class="container-fluid">
          <?php if(!isset($_GET["id_jugador"])){?>
            <h1 class="mt-4">Eliminar un Jugador</h1>
          <form action="Eliminar.php" method="POST">
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

            if(isset($_POST["equipo"])){?>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Posición</th>
                    <th scope="col">Modificar</th>
                  </tr>
                </thead>
                <tbody>
              <?php
              $id_equipo = $_POST["equipo"];

              $query = "SELECT * FROM jugador WHERE id_equipo = '$id_equipo'";
              $resultado = mysqli_query($conexion, $query);

              while($jugador = mysqli_fetch_array($resultado)){?>
                <tr>
                  <td><?= $jugador["id"] ?></td>
                  <td><?= $jugador["nombre"] ?></td>
                  <td><?= $jugador["posicion"] ?></td>
                  <td> <a href="Eliminar.php?id_jugador=<?= $jugador["id"] ?>">Eliminar</a> </td>
                </tr>
            <?php } ?>
                </tbody>
              </table>
          <?php
              }
            ?>

            <?php
              if(isset($_GET["id_jugador"])){
                $id_jugador = $_GET["id_jugador"];
                $query = "DELETE FROM jugador WHERE id='$id_jugador'";
                mysqli_query($conexion, $query);
                if(mysqli_query($conexion, $query)){
                  echo "<h3>El jugador se ha eliminado satisfactoriamente.</h3>"; 
                }
              }

             ?>
      </div>
      <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include("includes/footer.php") ?>
