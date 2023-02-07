  <?php

    require 'dbBroker.php';
    require 'model/vrste_usluga.php';
    require 'model/tretman.php';

    session_start();
    if (!isset($_SESSION["user_id"])) {
        header('Location:index.php');
        exit();
    }


    $vrsta = Vrsta::vratiSve($conn);
    $response = Tretman::vratiSve($conn);

    if (!$response) {
        echo "Greska prilikom konekcije sa bazom";
        die();
    }

    if ($response->num_rows == 0) {
        echo "Tabela je prazna!";
        die();
    } else {



    ?>


      <!DOCTYPE html>
      <html lang="en">

      <head>

          <meta charset="UTF-8">
          <link rel="icon" href="img/logo1.png" />
          <link rel="stylesheet" type="text/css" href="css/home.css">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <!-- <link rel="stylesheet" type="text/css" href="css/home.css"> -->

      </head>

      <body>




      <nav class="navbar navbar-dark bg-dark navbar-expand-sm mb-4 ">
              <img class="nav-icon" src="img/finalLogo.png" />

              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="logOut.php">Log out</a>
                  </ul>
              </div>
          </nav>
          <!--bootstrap class koji automatski odvaja tekst od leve margine-->
          <div class="container my-3">

              <!--<h1 class="text-center">SALON SHINE</h1>-->
              <p id="delete-message" class="text-dark"></p>

              <div class="form-outline w-25">
                  <button type="button" class="btn btn-dark my-4" data-bs-toggle="modal" data-bs-target="#dodaj-tretman-modal">
                      Dodaj novi tretman
                  </button>
                  <input type="text" class="form-control mb-2" name="search_text" id="search_text" placeholder="Pretrazi usluge...">
              </div>
          </div>



          <div id="background-img">
          </div>



          <div class="container" style="margin-top: 0.5%">
              <table class="table table-hover table-dark" id="table_id">
                  <thead class="thead">
                      <tr>
                          <th scope="col">Naziv tretmana</th>
                          <th scope="col">Trajanje(min)</th>
                          <th scope="col">Cena</th>
                          <th scope="col">Vrsta usluge</th>
                          <th scope="col">Opcije</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        while ($red = $response->fetch_array()) :
                        ?>

                          <tr>
                              <td> <?php echo $red["naziv_tretmana"] ?> </td>
                              <td> <?php echo $red["trajanje"] ?> </td>
                              <td> <?php echo $red["cena"] ?> </td>
                              <td> <?php echo $red["naziv_usluge"] ?> </td>
                              <td>
                                  <button class="btn btn-success edit_tretman" data-bs-toggle="modal" data-bs-target="#izmeni-tretman-modal" data-id1="<?php echo $red["id_tretmana"] ?>"><span class="fa fa-edit"></span></button>

                                  <button class="btn btn-danger" id="btnDelete" data-id="<?php echo $red["id_tretmana"] ?>"><span class="fa fa-trash"></span></button>
                              </td>
                          </tr>

                  <?php
                        endwhile;
                    }
                    ?>
                  </tbody>
              </table>





              <!-- Modal -->
              <div class="modal fade" id="dodaj-tretman-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">

                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Unos novog tretmana</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form action="#" method="post" id="formaDodajTretman" role="form">
                                  <div class="form-group">
                                      <label for="naziv_tretmana">Naziv tretmana</label>
                                      <input type="text" class="form-control" name="naziv_tretmana" placeholder="Unesite naziv"></input>
                                  </div>
                                  <div class="form-group">
                                      <label for="trajanje">Trajanje(min)</label>
                                      <input type="text" class="form-control" name="trajanje" placeholder="Unesite trajanje"></input>
                                  </div>
                                  <div class="form-group">
                                      <label for="cena">Cena</label>
                                      <input type="text" class="form-control" name="cena" placeholder="Unesite cenu"></input>
                                  </div>
                                  <div class="form-group">
                                      <label for="vrsta">Vrsta usluge:</label>

                                      <select class="form-control" name="vrsta" id="vrsta">
                                          <?php foreach ($vrsta as $v) : ?>
                                              <option value="<?php echo $v->id_usluge; ?>">
                                                  <?php echo $v->naziv_usluge; ?>
                                              </option>
                                          <?php endforeach; ?>
                                      </select>

                                  </div>
                                  <div class="modal-footer">
                                      <button type="submit" id="btnDodaj" name="btnDodaj" class="btn btn-dark">Sacuvaj</button>
                                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvori</button>
                                  </div>
                              </form>
                          </div>

                      </div>

                  </div>
              </div>



              <!-- ####################################################################################################################### -->

              <div class="modal fade" id="izmeni-tretman-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">

                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Izmena tretmana</h5>

                          </div>
                          <div class="modal-body">

                              <form action="handler/update.php" method="POST" id="formaIzmeniTretman">

                                  <input type="hidden" class="form-control" name="edit_id_p" id="edit_id_p"></input>

                                  <div class="form-group">
                                      <label for="up_naziv_tretmana">Naziv tretmana</label>
                                      <input type="text" class="form-control" name="up_naziv_tretmana" id="up_naziv_tretmana"></input>
                                  </div>
                                  <div class="form-group">
                                      <label for="up_trajanje">Trajanje(min)</label>
                                      <input type="text" class="form-control" name="up_trajanje" id="up_trajanje"></input>
                                  </div>
                                  <div class="form-group">
                                      <label for="up_cena">Cena</label>
                                      <input type="text" class="form-control" name="up_cena" id="up_cena"></input>
                                  </div>
                                  <div class="form-group">
                                      <label for="up_vrsta">Vrsta usluge:</label>

                                      <select class="form-control" name="up_vrsta" id="up_vrsta">
                                          <?php foreach ($vrsta as $v) : ?>
                                              <option value="<?php echo $v->id_usluge; ?>">
                                                  <?php echo $v->naziv_usluge; ?>
                                              </option>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>

                                  <div class="modal-footer">
                                      <button type="submit" name="btnIzmeni" id="btnIzmeni" class="btn btn-dark">Sacuvaj</button>
                                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvori</button>
                                  </div>
                              </form>
                          </div>

                      </div>

                  </div>
              </div>








              <!--##########################################################################################################################-->

              <div class="modal" id="obrisiTretman">
                  <div class="modal-dialog">

                      <div class="modal-content">
                          <div class="modal-header">
                              <h3 class="text-dark">Obrisi Tretman</h3>
                          </div>

                          <div class="modal-body">

                              <p>Da li zelite da izbrisete izabrani Tretman?</p>

                              <button type="button" id="btnObrisi" class="btn btn-success">Obrisi</button>
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvori</button>

                          </div>
                      </div>
                  </div>
              </div>


          </div>





          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
          <script src="js/main.js"></script>



      </body>

      </html>