
              <div class="row center game-row-padding">
                <div class="container">
                    <i class="ion-email accc-huge-icon accc-color"></i>
                    <h4 class="bold accc-color zero-margin">Courriers</h4>
                    <h5>Consultez l'état de traitement de vos courriers accc</h5>
                </div>
              </div> 

              <div class="row" id="gamer-info-table">
                      <table class="MyTable striped bordered bold centered responsive-table" >
                          <thead class="accc-back-color white-text">
                              <tr>
                                  <th data-field="id">identifiant courrier</th>
                                  <th data-field="id">Numero suivi courrier</th>
                                  <th data-field="id">Objet courrier</th>
                                  <th data-field="id">Service indexé</th>
                                  <th data-field="id">Date enregistrement</th>
                                  <th data-field="id">Délai traitement(jours)</th>
                                  <th data-field="id">Date prévue retour</th>
                                  <th data-field="id">Date effective traitement</th>
                                  <th data-field="id">Etat de traitement</th>
                                  <th data-field="id">Observation traitement</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($_SESSION['courrier'] as $key => $value): ?>
                                  <tr>
                                      <td><?php echo $value->idCourrier; ?></td>
                                      <td><?php echo $value->numSuivi; ?></td>
                                      <td><?php echo $value->objetCourrier; ?></td>
                                      <td><?php echo $value->nomService; ?></td>
                                      <td><?php echo $value->recordDate; ?></td>
                                      <td><?php echo $value->delaiTraitement; ?></td>
                                      <td><?php echo $value->datePrevueTraitement; ?></td>
                                      <td><?php echo $value->treatedDate; ?></td>
                                      <td>
                                        <?php 
                                          switch ($value->state) {
                                            case 1:
                                                echo "En dépot";
                                              break;

                                              case 2:
                                                echo "En cours de traitement";
                                              break;

                                              case 3:
                                                echo "Traité disponible";
                                              break;

                                              case 4:
                                                echo "Rejeté";
                                              break;
                                          }
                                         ?>
                                      </td>
                                      <td><?php echo $value->Obs; ?></td>
                                  </tr>
                              <?php endforeach ?>
                          </tbody>               
                            <tfoot>

                            </tfoot>
                      </table>
              </div>   