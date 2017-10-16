<?php $ManageAdmin->archivesInfo();?>
      <div class="row center game-row-padding zero-margin" class="general-info">
            
              <p class="generalStats zero-margin">
            </p>

              <div class="row center"> 
                <div class="col s6">
                        <h5 class="accc-color">Filtrage</h5>
                                <i class="ion-ios-settings-strong accc-color large"></i>
                                <div class="col s12 input-field">
                                    <label>Choisissez le filtrage</label><br>
                                    <select class="browser-default" name="" id="filter-select-type-courrier">
                                      <option value="numsuivi-search">Par identifiant de suivi courrier</option>
                                      <option value="ref-search">Par Référence</option>
                                      <option value="objet-search">Par Objet</option>
                                      <option value="dateEnr-search">Par Date</option>
                                      <option value="state-search">Par Etat de traitement</option>
                                      <option value="urgence-search">Par Niveau d'urgence</option>
                                      <option value="exp-search">Par Nom</option>
                                    </select>
                       </div>
                </div>

                <div class="col s6">
                      <div class="col s12 search-element numsuivi-search">
                            <h5 class="accc-color">Recherche par identifiant de suivi courrier</h5>
                            <i class="ion-card accc-color medium"></i>
                              <i class="ion-ios-search-strong accc-color large"></i>
                              <div class="col s12  accc-small-row-padding">
                                <form id="search-courrier-byNumSuivi-archive" class="admin-form dash-form">
                                    <div class="col s12 input-field">
                                      <input type="number"  name="num-suivi-search" class="required materialize-textarea" id="num-suivi-search-id" />
                                      <label class="" for="num-suivi-search-id">Identifiant de suivi courrier</label>
                                      <button type="submit" class="btn submit-button center" id="submit-search-courrier-suivi">Rechercher</button>
                                      <button type="reset" class="btn submit-button center" id="cancel-search-courrier-suivi">Reinitialiser</button>
                                      <div class="loaderAjax acc-medium-top-margin">
                                        <img src="../AjaxLoader/loading2.gif" />
                                      </div>
                                    </div>
                                </form>
                              </div>
                      </div>

                            <div class="col s12 search-element exp-search hidden">
                                <h5 class="accc-color">Recherche par Nom</h5>
                                  <i class="ion-android-walk accc-color medium"></i>
                                  <i class="ion-ios-search-strong accc-color large"></i>
                                  <form id="search-courrier-Exp-archive" class="admin-form dash-form">
                                      <div class="col s12 input-field">
                                        <textarea  name="num-suivi-search" class="required materialize-textarea" id="num-suivi-search-id"></textarea>
                                        <label class="" for="num-suivi-search-id">Nom</label>
                                        <button type="submit" class="btn submit-button center" id="submit-search-courrier-suivi">Rechercher</button>
                                        <button type="reset" class="btn submit-button center" id="cancel-search-courrier-exp">Reinitialiser</button>
                                        <div class="loaderAjax acc-medium-top-margin">
                                          <img src="../AjaxLoader/loading2.gif" />
                                        </div>
                                      </div>
                                  </form>
                              </div>


                              <div class="col s12 search-element urgence-search hidden">
                                      <h5 class="accc-color">Recherche par Niveau d'Urgence</h5>
                                        <i class="ion-alert  accc-color medium"></i>
                                        <i class="ion-ios-search-strong accc-color large"></i>
                                <div class="col s12 input-field">
                                    <label>Choisissez le filtrage</label><br>
                                    <select class="browser-default" name="" id="filter-select-urgence-courrier">
                                      <option value=""selected>Tout</option>
                                      <option value="normal">Normal</option>
                                      <option value="urgent">Urgent</option>
                                      <option value="information">Information</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col s12 search-element state-search hidden">
                                      <h5 class="accc-color">Recherche par Etat de Traitement</h5>
                                        <i class="ion-contrast  accc-color medium"></i>
                                        <i class="ion-ios-search-strong accc-color large"></i>
                                <div class="col s12 input-field">
                                    <label>Choisissez l'Etat</label><br>
                                    <select class="browser-default" name="" id="filter-select-state-delay">
                                      <option value="" selected>Tout</option>
                                      <option value="avance-delay">En avance sur le delai</option>
                                      <option value="retard-delay">En retard sur le délai</option>
                                      <option value="today-delay">Expirant aujourd'hui</option>
                                      <option value="undefined-delay">Indéfini(Courrier d'information)</option>
                                    </select>
                                </div>
                            </div>

                          <div class="col s12 search-element dateEnr-search hidden">
                            <h5 class="accc-color">Recherche par date</h5>
                            <i class="ion-android-calendar accc-color medium"></i>
                            <i class="ion-ios-search-strong accc-color large"></i>
                            <form id="search-courrier-byDate-archive" class="admin-form dash-form">
                              <div class="col s12 input-field">
                                  <i class="ion-calendar prefix"></i>
                                  <input id="date-form" name="date-search-courrier" type="text" class="form-control datepicker required">                              
                                  <label for="date-form">Sélectionnez une date</label>
                                  <button type="submit" class="btn submit-button center" id="submit-search-courrier-date">Rechercher</button>
                                  <button type="reset" class="btn submit-button center" id="cancel-search-courrier-date-archive">Reinitialiser</button>
                                  
                                  <div class="loaderAjax acc-medium-top-margin">
                                    <img src="../AjaxLoader/loading2.gif" />
                                  </div>
                              </div>
                            </form>
                          </div>

                          <div class="col s12 search-element ref-search hidden">
                                  <h5 class="accc-color">Recherche par référence</h5>
                                  <i class="ion-social-twitch-outline accc-color medium"></i>
                                  <i class="ion-ios-search-strong accc-color large"></i>
                                <div class="col s12  accc-small-row-padding">
                                <form id="search-courrier-ref-archive" class="admin-form dash-form">
                                    <div class="col s12 input-field">
                                      <textarea  name="num-suivi-search" class="required materialize-textarea" id="num-suivi-search-id"></textarea>
                                      <label class="" for="num-suivi-search-id">Numéro de référence</label>
                                      <button type="submit" class="btn submit-button center" id="submit-search-courrier-suivi">Rechercher</button>
                                      <button type="reset" class="btn submit-button center" id="cancel-search-courrier-ref">Reinitialiser</button>
                                      <div class="loaderAjax acc-medium-top-margin">
                                        <img src="../AjaxLoader/loading2.gif" />
                                      </div>
                                    </div>
                                </form>
                              </div>
                          </div>


                          <div class="col s12 search-element objet-search hidden">
                              <h5 class="accc-color">Recherche par objet</h5>
                              <i class="ion-android-textsms accc-color medium"></i>
                             <i class="ion-ios-search-strong accc-color large"></i>  
                              <div class="col s12  accc-small-row-padding">
                                <form id="search-courrier-obj-archive" class="admin-form dash-form">
                                    <div class="col s12 input-field">
                                      <textarea  name="num-suivi-search" class="required materialize-textarea" id="num-suivi-search-id"></textarea>
                                      <label class="" for="num-suivi-search-id">Renseigner l'objet</label>
                                      <button type="submit" class="btn submit-button center" id="submit-search-courrier-suivi">Rechercher</button>
                                      <button type="reset" class="btn submit-button center" id="cancel-search-courrier-obj">Reinitialiser</button>
                                      <div class="loaderAjax acc-medium-top-margin">
                                        <img src="../AjaxLoader/loading2.gif" />
                                      </div>
                                    </div>
                                </form>
                              </div>
                          </div>


                </div>

              </div> 
            
                <div class="row" id="gamer-info-table">
                        <table class="MyTable striped bordered bold centered" id="archives-table">
                            <thead class="orange white-text">
                                <tr>
                                      <th data-field="id">id</th>
                                      <th data-field="id">Numero suivi arrivé</th>
                                      <th data-field="id">Numero suivi départ</th>
                                      <th data-field="id">Reference</th>
                                      <th data-field="id">Type</th>
                                      <th data-field="id">Objet</th>                                                                  
                                      <th data-field="id">Expediteur</th>
                                      <th data-field="id">Destinataire</th>
                                      <th data-field="id">Date arrivée</th>
                                      <th data-field="id">Consulter arrivé</th>
                                      <th data-field="id">Agent arrivé</th>
                                      <th data-field="id">Consulter départ</th>
                                      <th data-field="id">Agent départ</th>
                                      <th data-field="id">Date départ</th>
                                      <th data-field="id" class="long-cell">Fondé(s) Imputé(s)</th>
                                      <th data-field="id" class="long-cell">Chef Sce Imputé(s)</th>
                                      <th data-field="id" class="long-cell">Agents Imputé(s)</th>
                                      <th data-field="id">Niveau Urgence</th>

                                  </tr>
                            </thead>




                            <tbody>
                            <?php foreach ($_SESSION['archiveInfo'] as $key => $value): ?>
                              <?php foreach  ($value as $ind=>$val): ?>
                                 <?php 
                                  switch ($val->state) {
                                              case 1:
                                                   switch ($val->urgence) {
                                            case 1:
                                                  if(($val->dayRest<0)){
                                                    $delayState="avance-delay";
                                                    $backStripe="accc-light-stripe-orange black-text";
                                                  }
                                                  if(($val->dayRest==0)){
                                                    $delayState="today-delay";
                                                    $backStripe="accc-light-stripe-orange black-text";  
                                                  }
                                                  if($val->dayRest>0){
                                                    $delayState="retard-delay";
                                                    $backStripe="accc-grey-treat-stripe white-text";
                                                  }
                                                    $state="normal";
                                              break;

                                            case 2:
                                                if(($val->dayRest<0) || ($val->dayRest==0)){
                                                  $backStripe="accc-alert-stripe white-text";
                                                  $delayState="avance-delay";
                                                }
                                                
                                                 if(($val->dayRest==0)){
                                                  $backStripe="accc-alert-stripe white-text";
                                                  $delayState="today-delay";
                                                }

                                                  if($val->dayRest>0){
                                                    $delayState="retard-delay";
                                                    $backStripe="accc-grey-treat-stripe white-text";                                         
                                                  }
                                                $state="urgent";
                                              break;
                                                   }
                                              break;

                                              case 2:
                                                   switch ($val->urgence) {
                                                       case 1:
                                                        $backStripe="accc-light-stripe-orange black-text";
                                                        $state="normal";
                                                        $idState=$val->state;
                                                       break;

                                                      case 2:
                                                        $backStripe="accc-alert-stripe white-text";
                                                        $state="urgent";
                                                          break;
                                                      }
                                              break;

                                              case 3:
                                                  $backStripe="accc-light-stripe-green white-text";
                                                  $state="information";
                                                  $delayState="undefined-delay";
                                              break;
                                          }
                                  ?>    
   <?php if( ($_SESSION['adminInfo']->idService==1)  || (($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable")) || (($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="secretaire")) || (($_SESSION['adminInfo']->idService==2) && ($_SESSION['adminInfo']->poste=="secretaire")) || (($_SESSION['adminInfo']->idService==2) && ($_SESSION['adminInfo']->poste=="responsable")) || ($ManageAdmin->CheckedImputation($_SESSION['adminInfo']->id,$val->id)) || ($val->state==3) ) :?>

                                  <tr class="<?php echo $state;?> <?php echo $delayState; ?> <?php echo strtoupper($val->agentarrive); ?> <?php echo strtoupper($val->agentDepart); ?> <?php echo $val->id;?> <?php echo strtoupper($val->nomChefSce);?> <?php echo strtoupper($val->destinataire);?> <?php echo strtoupper($val->nomFonde); ?> <?php echo $val->id."".$val->numSuiviDepart;?> <?php echo $backStripe; ?> <?php echo $val->id."".$val->numSuivi; ?> <?php echo strtoupper($val->reference); ?> <?php echo strtoupper($val->expediteur); ?> <?php echo strtoupper($val->objet); ?> <?php echo substr($val->dateEnr,0,10);?> <?php echo substr($val->dateTrt,0,10);?>">
                                      <td><?php echo $val->id; ?></td>
                                      <td><?php echo $val->numSuivi; ?></td>
                                      <td><?php echo $val->numSuiviDepart; ?></td>
                                      <td><?php echo $val->reference; ?></td>
                                      <td><?php 
                                        switch ($val->state) {
                                          case 1:
                                              echo "Courrier Arrivé";
                                            break;
                                          
                                          case 2:
                                              echo "Courrier Départ";
                                            break;

                                           case 3:
                                              echo "Courrier Information";
                                            break;
                                        }
                                       ?></td>
                                      <td><?php echo $val->objet; ?></td>
                                      <td><?php echo $val->expediteur; ?></td>
                                      <td><?php echo $val->destinataire; ?></td>
                                      <td><?php echo $val->dateEnr; ?></td>
                                      <td>
                                      <a href="../simple_flex/index.php?pathPdf=<?php echo $val->piece; ?>" class="path-down-courrier" target="_blank" id="<?php echo $val->piece; ?>"><i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece"></i></a>
                                      </td>
                                      <td><?php echo $val->agentarrive; ?></td>
                                      <td>
                                         <?php if($val->pieceDepart!==""):?>
                                              <a href="../simple_flex/index.php?pathPdf=<?php echo $val->pieceDepart; ?>" class="path-down-courrier" target="_blank" id="<?php echo $val->pieceDepart; ?>"><i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece"></i></a>
                                        <?php endif; ?>
                                      </td>
                                      <td><?php echo $val->agentDepart; ?></td>
                                      <td><?php echo $val->dateTrt; ?></td>
                                       <td>
                                       <?php if(!empty($val->fonde)) :?>
                                       <div class="col s12 input-field">
                                       <select class="browser-default red-text">

                                            <?php foreach ($val->fonde as $keyMemb => $keyArray): ?>
                                                  
                                                       <option><?php  echo $keyArray; ?></option>
                                                  
                                            <?php   endforeach; ?>
                                                </select>
                                            </div>
                                          <?php   endif; ?>
                                       </td>
                                       <td>
                                        <?php if(!empty($val->chefserv)) :?>
                                       <div class="col s12 input-field">
                                       <select class="browser-default red-text">

                                            <?php foreach ($val->chefserv as $keyMemb => $keyArray): ?>
                                                  
                                                       <option><?php  echo $keyArray; ?></option>
                                                  
                                            <?php   endforeach; ?>
                                                </select>
                                            </div>
                                          <?php   endif; ?>
                                       </td>
                                       <td>
                                        <?php if(!empty($val->agentserv)) :?>
                                       <div class="col s12 input-field">
                                       <select class="browser-default red-text">

                                            <?php foreach ($val->agentserv as $keyMemb => $keyArray): ?>
                                                  
                                                       <option><?php  echo $keyArray; ?></option>
                                                  
                                            <?php   endforeach; ?>
                                                </select>
                                            </div>
                                          <?php   endif; ?>
                                       </td>
                                       <td><?php  echo $state; ?></td>
                                  </tr>
                                <?php   endif; ?>
                                   <?php endforeach; ?>
                              <?php endforeach; ?> 
                            </tbody>               
                        </table>
                </div>
         </div>

  <!--Confirm Delete Member Modal Box Structure -->
  <div id="confirmDeleteMember" class="modal black center-align">
        <div class="modal-content">
            <p><img src="../../img/index/game-center-small2.png"></p>
            <h6 class="game-main-color modal-text bold">Etes-vous sûre de vouloir supprimer <span id="member-deleted"></span>
            portant l'identifiant <span id="member-deleted-id"></span> complètement du fichier d'administration ?
            </h6>
                <input type="hidden" id="avatar-deleted-member">
                  <input type="password" name="confirm-delete-password" id="conf-member-delete" class="required white-text"/>
                  <label for="conf-member-delete">Mot de passe de confirmation</label>
        </div>
        <div class="modal-footer game-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="delete-member-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>

<script src="../js/manage-admin.js"></script>
<script src="../js/filterCourrier.js"></script>