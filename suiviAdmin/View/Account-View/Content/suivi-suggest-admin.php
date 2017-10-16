<?php $ManageAdmin->suggestInfo(); ?>
              <div class="row center game-row-padding">
                <div class="container">
                    <i class="ion-ios-paper-outline accc-huge-icon accc-color"></i>
                    <h4 class="bold accc-color">Suggestions Clientes</h4>
                    <h5>Consultez les suggestions clientes par rapports aux traitements courriers des services de l'ACCC.</h5>
                </div>
                <a href="#suggest-explanation" class="btn submit-button">En savoir plus</a>  
              </div> 

              <div class="row" id="gamer-info-table">
                  
                      <table class="MyTable striped bordered bold centered responsive-table" >
                          <thead class="accc-back-color white-text">
                              <tr>
                                  <th data-field="id">Identifiant suggestion</th>
                                  <th data-field="id">Identifiant Courrier</th>
                                  <th data-field="id">Numéro Suivi Courrier</th>
                                  <th data-field="id">Expéditeur</th>
                                  <th data-field="id">Suggestion</th>
                                  <th data-field="id">Date Envoi</th>
                                  <th data-field="id">Service Indexé</th>
                                  <th data-field="id">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($_SESSION['suggestInfo'] as $key => $value): ?>
                                  <tr>
                                      <td><?php echo $value->idSuggestion; ?></td>
                                      <td><?php echo $value->idCourrierSuggest; ?></td>
                                      <td><?php echo $value->numSuivi; ?></td>
                                      <td><?php echo $value->nomExp; ?></td>
                                      <td><?php echo $value->suggestion; ?></td>
                                      <td><?php echo $value->dateEnvoi; ?></td>
                                      <td><?php echo $value->nomService; ?></td>
                                      <td>
                                        <?php 
                                        switch($value->state)
                                            {
                                                case 0 : 
                                                  echo "<i class='ion-android-checkbox-outline-blank white-text trash-button small btn waves-effect seen-suggest-trigger'></i>";
                                                break;

                                                case 1:
                                                  echo "<i class='ion-android-checkbox-outline white-text small trash-button btn waves-effect notseen-suggest-trigger'></i>";
                                                break;
                                            }
                                         ?>   
                                         <img src="../ajaxLoader/715.gif" class="push-read-loader"/> 
                                      </td>
                                  </tr>
                              <?php endforeach ?>
                          </tbody>               
                            <tfoot>

                            </tfoot>
                      </table>
               
              </div>


              <div class="container">
                    <div class="col s12 info-input-file" id="suggest-explanation">
                <p class="left-align bold">
                  <i class="ion-asterisk game-main-color bold"></i>
                  le mail doit être de la forme : <span class="game-main-color">monAddresse@provider.domaine (gamecenter@hotmail.fr)</span> 
                </p>
                <p class="left-align bold">
                  <i class="ion-asterisk game-main-color"></i>
                  Veuillez entrer un mot de passe contenant des lettres majuscules, des nombres pour le rendre plus sécurisé.<span class="game-main-color">ex : GamerC2015_Player</span> 
                </p>
                <p class="left-align bold">
                  <i class="ion-asterisk game-main-color"></i>
                  Le contact fourni doit être un numéro mobile correspondant à l'un des différents opérateurs du secteur.
                </p>
                <p class="left-align bold">
                  <i class="ion-asterisk game-main-color"></i>
                 Le rôle définit les privilèges de l'utilisateur dans l'administration du service Game-gift.
                </p>
              </div>

                </div>

<script src="../js/manage-admin.js"></script>