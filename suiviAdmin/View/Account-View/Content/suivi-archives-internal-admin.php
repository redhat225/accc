<?php $ManageAdmin->archivesInfoInternal();?>
      <div class="row center game-row-padding zero-margin" class="general-info">
            
              <p class="generalStats zero-margin">
              <i class="ion-android-search accc-huge-icon accc-color"></i>
              <h4 class="accc-color zero-margin">Recherches</h4>
              <h6 class="bold">Rechercher un courrier interne par critères</h6> 
            </p>

              <div class="row center"> 
                <div class="col s6">
                        <h5 class="accc-color">Filtrage</h5>
                                <i class="ion-ios-settings-strong accc-color large"></i>
                                <div class="col s12 input-field">
                                    <label>Choisissez le filtrage</label><br>
                                    <select class="browser-default" name="" id="filter-select-type-courrier">
                                      <option value="numsuivi-search" selected>Par numéro de suivi</option>
                                      <option value="ref-search">Par référence</option>
                                      <option value="objet-search">Par objet</option>
                                      <option value="dateEnr-search">Par date enregistrement</option>
                                      <option value="urgence-search">Par niveau d'urgence</option>
                                      <option value="exp-search">Par expediteur</option>
                                    </select>
                       </div>
                </div>

                <div class="col s6">
                      <div class="col s12 search-element numsuivi-search">
                            <h5 class="accc-color">Recherche par numero suivi</h5>
                            <i class="ion-card accc-color medium"></i>
                              <i class="ion-ios-search-strong accc-color large"></i>
                              <div class="col s12  accc-small-row-padding">
                                <form id="search-courrier-byNumSuivi-archive" class="admin-form dash-form">
                                    <div class="col s12 input-field">
                                      <input type="text"  name="num-suivi-search" class="required materialize-textarea" id="num-suivi-search-id" />
                                      <label class="" for="num-suivi-search-id">Numéro de suivi courrier</label>
                                      <button type="submit" class="btn submit-button center" id="submit-search-courrier-suivi">Rechercher</button>
                                      <button type="" class="btn submit-button center" id="cancel-search-courrier-suivi">Reinitialiser</button>
                                      <div class="loaderAjax acc-medium-top-margin">
                                        <img src="../AjaxLoader/loading2.gif" />
                                      </div>
                                    </div>
                                </form>
                              </div>
                      </div>

                            <div class="col s12 search-element exp-search hidden">
                                <h5 class="accc-color">Recherche par Expediteur</h5>
                                  <i class="ion-android-walk accc-color medium"></i>
                                  <i class="ion-ios-search-strong accc-color large"></i>
                                  <form id="search-courrier-Exp-archive" class="admin-form dash-form">
                                      <div class="col s12 input-field">
                                        <textarea  name="num-suivi-search" class="required materialize-textarea" id="num-suivi-search-id"></textarea>
                                        <label class="" for="num-suivi-search-id">Nom expediteur</label>
                                        <button type="submit" class="btn submit-button center" id="submit-search-courrier-suivi">Rechercher</button>
                                        <button type="" class="btn submit-button center" id="cancel-search-courrier-exp">Reinitialiser</button>
                                        <div class="loaderAjax acc-medium-top-margin">
                                          <img src="../AjaxLoader/loading2.gif" />
                                        </div>
                                      </div>
                                  </form>
                              </div>

                              <div class="col s12 search-element urgence-search hidden">
                                      <h5 class="accc-color">Recherche par niveau d'urgence</h5>
                                        <i class="ion-alert  accc-color medium"></i>
                                        <i class="ion-ios-search-strong accc-color large"></i>
                                <div class="col s12 input-field">
                                    <label>Choisissez le filtrage</label><br>
                                    <select class="browser-default" name="" id="filter-select-urgence-courrier">
                                      <option value=""selected>Tout</option>
                                      <option value="normal">Normal</option>
                                      <option value="urgent">Urgent</option>
                                    </select>
                                </div>
                            </div>


                          <div class="col s12 search-element dateEnr-search hidden">
                            <h5 class="accc-color">Recherche par date enregistrement</h5>
                            <i class="ion-android-calendar accc-color medium"></i>
                            <i class="ion-ios-search-strong accc-color large"></i>
                            <form id="search-courrier-byDate-archive" class="admin-form dash-form">
                              <div class="col s12 input-field">
                                  <i class="ion-calendar prefix"></i>
                                  <input id="date-form" name="date-search-courrier" type="text" class="form-control datepicker required">                              
                                  <label for="date-form">Sélectionnez une date</label>
                                  <button type="submit" class="btn submit-button center" id="submit-search-courrier-date">Rechercher</button>
                                  <button type="" class="btn submit-button center" id="cancel-search-courrier-date-archive">Reinitialiser</button>
                                  
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
                                      <button type="" class="btn submit-button center" id="cancel-search-courrier-ref">Reinitialiser</button>
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
                                      <button type="" class="btn submit-button center" id="cancel-search-courrier-obj">Reinitialiser</button>
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
                   
                  <?php if($_SESSION['archivesInfoInternal'][0]!==0) :?>
                        <table class="MyTable striped bordered bold centered" id="archives-table">
                            <thead class="accc-back-color-green white-text">
                                <tr>
                                  <th data-field="id">id</th>
                                  <th data-field="id">Reference</th>
                                  <th data-field="id">Numero suivi courrier</th>
                                  <th data-field="id">Expediteur</th>
                                  <th data-field="id">Objet</th>
                                  <th data-field="id">Consulter départ</th>
                                  <th data-field="id">Consulter arrivé</th>
                                  <th data-field="id">Date départ</th>
                                  <th data-field="id">Date arrivé</th>
                                  <th data-field="id">Date Rédaction</th>
                                  <th data-field="id">Etat de traitement</th>
                                  </tr>
                            </thead>
                            <tbody>
                           <?php foreach ($_SESSION['archivesInfoInternal'] as $key => $value): ?>
                              <?php foreach  ($value as $ind=>$val): ?>
                                 <?php 
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
                                  ?>    

                                  <tr class="<?php echo $state; ?> <?php echo $val->id; ?>  <?php echo $backStripe; ?> <?php echo $val->id."".$val->numSuivi; ?> <?php echo strtoupper($val->reference); ?>  <?php echo strtoupper($val->expediteur); ?>  <?php echo strtolower($val->objet); ?>  <?php echo substr($val->dateEnr,0,10); ?>">
                                      <td><?php echo $val->id; ?></td>
                                      <td><?php echo $val->reference; ?></td>
                                      <td><?php echo $val->id."".$val->numSuivi; ?></td>
                                      <td><?php echo $val->expediteur; ?></td>
                                      <td><?php echo $val->objet; ?></td>

                                      <td>
                                      <a href="../simple_flex/index.php?pathPdf=<?php echo $val->pieceDepart; ?>" class="path-down-courrier" target="_blank" id="<?php echo $val->pieceDepart; ?>"><i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece"></i></a>
                                      </td>
                                      <td>
                                         <?php if($val->pieceArrive!==""):?>
                                              <a href="../simple_flex/index.php?pathPdf=<?php echo $val->pieceArrive; ?>" class="path-down-courrier" target="_blank" id="<?php echo $val->pieceArrive; ?>"><i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece"></i></a>
                                        <?php endif; ?>
                                      </td>
                                      <td><?php echo $val->dateEnr; ?></td>
                                      <td><?php echo $val->dateTrt; ?></td>
                                      <td><?php echo $val->dateRedaction; ?></td>
                                      <td><?php 
                                        switch ($val->state) {
                                          case 1:
                                              echo "Courrier Départ(Sortant)";
                                            break;
                                          
                                          case 2:
                                              echo "Courrier Arrivé(Entrant)";
                                            break;
                                        }
                                       ?></td>
                                  </tr>
                                   <?php endforeach; ?>
                              <?php endforeach; ?>
                            </tbody>               
                        </table>
                  <?php else: ?>
                        <i class="ion-android-warning accc-huge-icon accc-color"></i>
                        <h4 class="accc-color zero-margin">Pas de courrier enregistré</h4>
                  <?php endif; ?>

                </div>
         </div>

<script src="../js/manage-admin.js"></script>
<script src="../js/filterCourrier.js"></script>