<?php $ManageAdmin->crInfo();?>
              <div class="row center game-row-padding">
                <div class="container">
                    <i class="ion-android-list accc-huge-icon accc-color"></i>
                    <h4 class="bold accc-color zero-margin">Comptes Rendus</h4>
                    <h5>Consultez et modifiez les comptes rendus d'exécution des tâches</h5>
                </div>
              </div> 
              <div class="row" id="gamer-info-table">

                      <table class="MyTable bordered bold centered " id="cr-admin-table">
                          <thead class="orange white-text">
                              <tr>
                                  <th data-field="id">identifiant compte-rendu</th>
                                  <th data-field="id">identifiant tâche associée</th>
                                  <th data-field="id">Tâche</th>
                                  <th data-field="id">Responsable d'execution</th>
                                  <th data-field="id">Numéro suivi courrier associé</th>
                                  <th data-field="id">date édition</th>
                                  <th data-field="id">Compte rendu</th>
                                  <th data-field="id">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                           <?php foreach ($_SESSION['crInfo'] as $key => $value): ?>
                           <tr>
                             <?php if(($value->idInitiateur==$_SESSION['adminInfo']->id) || ($value->id==$_SESSION['adminInfo']->id) ) :?>
                                  <td><?php echo $value->idCompteRendu; ?></td>
                                  <td><?php echo $value->idTache; ?></td>
                                  <td><?php echo $value->descTache; ?></td>
                                  <td><?php echo $value->nom." ".$value->prenom; ?></td>
                                  <td><?php echo $value->numSuiviCourrier; ?></td>
                                  <td><?php echo $value->dateEdition; ?></td>
                                  <td><?php echo $value->contenu; ?></td>
                                  <td>  
                                    <?php if(($value->id)==($_SESSION['adminInfo']->id)) :?>
                                      <i class="ion-edit white-text small btn waves-effect trash-button edit-cr"></i> 
                                    <?php endif; ?>
                                     <?php if(($value->idInitiateur)==($_SESSION['adminInfo']->id)) :?>
                                        <?php 
                                        switch($value->state)
                                            {
                                                case 0 : 
                                                  echo "<i class='ion-android-checkbox-outline-blank white-text trash-button small btn waves-effect seen-cr-trigger'></i>";
                                                break;

                                                case 1:
                                                  echo "<i class='ion-android-checkbox-outline white-text small trash-button btn waves-effect notseen-cr-trigger'></i>";
                                                break;
                                            }
                                         ?>  
                                        <?php endif; ?> 
                                         <img src="../ajaxLoader/715.gif" class="push-read-loader"/> 
                                  </td>
                             </tr>
                            <?php endif; ?>
                           <?php endforeach; ?>
                          </tbody>               
                            <tfoot>

                            </tfoot>
                      </table>
              </div> 

              <div class="row center hidden" id="alter-cr-courrier-wrapper">
                  <div class="container">
                    <div class="container">
                        <form id="alter-cr-tache" class="accc-row-padding admin-form dash-form">
                           <i class="ion-android-refresh accc-color medium"></i>
                          <i class="ion-android-list accc-color accc-huge-icon"></i>
                          <h5 class="accc-color bold game-bottom-small-padding">Modification Compte-Rendu</h5>

                          <div class="col s12 input-field">
                            <i class="ion-person small prefix game-main-color"></i>
                            <textarea  name="suivi-alter-cr-desc" class="required materialize-textarea" id="suivi-alter-cr-desc-id"></textarea>
                            <label class="active" for="suivi-alter-cr-desc-id">Descriptif</label>
                          </div>

                          <div class="col s12 input-field">
                            <i class="ion-android-lock small prefix game-main-color"></i>
                            <input type="password" class="required" name="admin-suivi-conf-password" id="gg-password" maxlength="25">
                            <label for="gg-password">Mot de passe de confirmation Administrateur</label>
                          </div>

                          <button type="submit" class="btn submit-button left" id="alter-cr-courrier-submit">Enregistrer</button>
                          <button type="reset" class="btn submit-button right" id="alter-cr-courrier-cancel">Annuler</button>

                          <input type="hidden" value="18" name="admin-control">
                          <input type="hidden" name="id-cr-alter" id="id-task-cr-id">

                             <div class="loaderAjax acc-medium-top-margin">
                            <img src="../AjaxLoader/loading2.gif" />
                           </div>

                      </form>
                    </div>
                  </div>
              </div>

                <div class="container">
                    <div class="col s12 info-input-file" id="member-explanation">
                   <p class="left-align bold">
                      <i class="ion-asterisk game-main-color bold"></i>
                      Il existe un code de couleur permettant de mieux interpreter l'état detraitement du courrier : 
                      <br>
                      Blanc : Courrier en dépot <br>
                      Gris : En cours de traitement <br>
                      Vert : Courrier Traité dispobnible <br>
                      Rouge : Courrier Rejeté (Consulter Observation pour plus d'informations) 
                  </div>

                </div>

<script src="../js/manage-admin.js"></script>