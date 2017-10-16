<?php $ManageAdmin->courrierArriveInfo(); ?>
      <div class="row center game-row-padding zero-margin" class="general-info">
            
              <p class="generalStats zero-margin">
                   <h4 class="accc-color bold">Courriers internes Arrivés</h4> 
            </p>
            <div class="row center">
                       <p class="accc-wrapper-button adding-filter-depart-internal">
                         <i class="ion-plus-round white-text small adding-Member-trigger"></i>
                         <i class="ion-funnel white-text small adding-Member-trigger"></i> 
                      </p>

                       <p class="accc-wrapper-button adding-courrier-depart-internal">
                         <i class="ion-plus-round white-text small adding-Member-trigger"></i>
                         <i class="ion-android-mail white-text small adding-Member-trigger"></i> 
                      </p>    
            </div> 
                <div class="row center hidden" id="form-new-courrier-depart-accc-wrapper">
                    <div class="container">
                        <div class="container">
                            <form id="arrive-courrier-accc-form" class="dash-form">
                                    <div class="col s12 input-field">
                                      <i class="ion-card small prefix game-main-color"></i>
                                      <input type="number" name="register-courrier-suivi-depart" class="required materialize-textarea" id="register-courrier-objet-id" />
                                      <label class="active" for="register-courrier-objet-id">Numero de suivi courrier partiel</label>
                                    </div>

                                    <div class="col s12 input-field">
                                         <i class="ion-android-calendar small prefix game-main-color"></i>
                                        <input id="date-form" name="date-search-courrier" type="date" class="form-control datepicker">           
                                        <label for="date-form">Précisez une date de rédaction</label>
                                    </div>

                                    <div class="col s12">
                                      <div class="file-field input-field">
                                          <div class="btn center avatar-input-button">
                                            <i class="ion-email large file-input-label"></i>
                                            <input type="file" name="avatar" accept="pdf" class="required" id="courrier-scan-input">
                                          </div>
                                          <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" placeholder="scan courrier" id="file-path-courrier">
                                          </div>
                                      </div>
                                    </div>


                                    
                                        <button type="submit" class="btn submit-button left" id="sortie-courrier-submit">Enregistrer</button>
                                        <button type="reset" class="btn submit-button right" id="register-internal-depart-cancel" >Annuler</button> 
                                    
                                    <input type="hidden" value="42" name="admin-control"> 

                                 <div class="loaderAjax acc-medium-top-margin">
                                <img src="../AjaxLoader/loading2.gif" />
                               </div>


                            </form>
                        </div>
                    </div>  
                </div>
            
                       <div class="row center hidden" id="Filtrage-wrapper"> 
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
                                      <option value="dest-search">Par expediteur</option>
                                      <option value="" >Enlever le filtre</option>
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
                              <div class="col s12 search-element dest-search hidden">
                                <h5 class="accc-color">Recherche par Destinataire</h5>
                                  <i class="ion-person-stalker accc-color medium"></i>
                                  <i class="ion-ios-search-strong accc-color large"></i>
                                  <form id="search-courrier-Exp-archive-dest" class="admin-form dash-form">
                                      <div class="col s12 input-field">
                                        <textarea  name="num-suivi-search" class="required materialize-textarea" id="num-suivi-search-id"></textarea>
                                        <label class="" for="num-suivi-search-id">Nom Destinataire</label>
                                        <button type="submit" class="btn submit-button center" id="submit-search-courrier-suivi">Rechercher</button>
                                        <button type="reset" class="btn submit-button center" id="cancel-search-courrier-exp-dest">Reinitialiser</button>
                                        <div class="loaderAjax acc-medium-top-margin">
                                          <img src="../AjaxLoader/loading2.gif" />
                                        </div>
                                      </div>
                                  </form>
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
                   
                        <table class="MyTable striped bordered bold centered" id="archives-table">
                            <thead class="orange white-text">
                                <tr>
                                  <th data-field="id">id</th>
                                  <th data-field="id">Numero suivi</th>
                                  <th data-field="id">Expediteur</th>
                                  <th data-field="id">Destinataire</th>
                                  <th data-field="id">Objet</th>
                                  <th data-field="id">Consulter départ</th>
                                  <th data-field="id">Consulter arrivé</th>
                                  <th data-field="id">Date départ</th>
                                  <th data-field="id">Date arrivé</th>
                                  <th data-field="id">Date rédaction</th>
                                  <th data-field="id">Action</th>    
                                </tr>
                            </thead>
                            <tbody>
                           <?php foreach ($_SESSION['courrierArriveInfo'] as $key => $value): ?>
                              <?php foreach  ($value as $ind=>$val): ?>
                                   <?php 
                                  switch ($val->urgence) {
                                            case 1:
                                                    $backStripe="accc-light-stripe-orange black-text";
                                                    $state="normal";
                                              break;

                                              case 2:
                                                    $backStripe="accc-alert-stripe white-text";                               
                                                    $state="urgent";
                                              break;
                                          }
                                  ?>   
                                  <tr class="<?php echo $backStripe; ?> <?php echo $state; ?> <?php echo $val->id; ?> <?php echo $val->id."".$val->numSuivi; ?> <?php echo $val->reference; ?> <?php echo $val->destinataire; ?>  <?php echo $val->expediteur; ?>  <?php echo $val->objet; ?>  <?php echo substr($val->dateEnr,0,10); ?>">
                                      <td><?php echo $val->id; ?></td>
                                      <td><?php echo $val->numSuivi; ?></td>
                                      <td><?php echo $val->expediteur; ?></td>
                                      <td><?php echo $val->destinataire; ?></td>
                                      <td><?php echo $val->objet; ?></td>
                                      <td class="center"><a href="../simple_flex/index.php?pathPdf=<?php echo $val->pieceDepart; ?>" class="path-down-courrier" id="<?php echo $val->pieceDepart; ?>" target="_blank"><i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece" ></i></a></td>
                                      <td class="center"><a href="../simple_flex/index.php?pathPdf=<?php echo $val->pieceArrive; ?>" class="path-down-courrier" id="<?php echo $val->pieceArrive; ?>" target="_blank"><i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece" ></i></a></td>
                                      <td><?php echo $val->dateEnr; ?></td>
                                      <td><?php echo $val->dateTrt; ?></td>
                                      <td><?php echo $val->dateRedaction; ?></td>
                                      
                                      
                                      <td>
                                      <?php if(($_SESSION['adminInfo']->idService==1)) :?>
                                      <i class="ion-edit white-text small btn waves-effect trash-button change-info-courrier-arrive-accc-trigger"></i>
                                        <?php if(($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable")) :?>
                                        <i class="ion-ios-trash white-text small btn waves-effect trash-button trash-courrier-arrive-accc-trigger"></i>
                                         <?php endif; ?>
                                      <?php endif; ?>
                                      <img src="../AjaxLoader/715.gif" class="push-read-loader"/><img src="../AjaxLoader/727.gif" class="loader-trash"/>
                                      </td>
                                  </tr>
                                   <?php endforeach; ?>
                              <?php endforeach; ?>
                            </tbody>               
                        </table>
                    
                </div>
         </div>


                <div id="confModInternal-2" class="modal white center-align">
                      <div class="modal-content">
                            <p class="logo-wrapper-circle-account">
                                       <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
                            </p>
                              <form id="alter-register-courrier-arrive-accc-form" class="dash-form">
                                    <h5 class="accc-color bold game-bottom-small-padding">Veuillez apporter vos modifications sur le courrier arrivé interne <span id="courrier-alter-arrive-internal-info"></span></h5>

                                  <div class="file-field input-field">
                                   <div class="btn center avatar-input-button">
                                        <i class="ion-email large file-input-label"></i>
                                        <input type="file" name="avatar" accept="pdf" class="required" id="courrier-scan-input-arrive-alter-internal">
                                      </div>
                                      <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="scan courrier" id="file-path-courrier">
                                      </div>
                                  </div>

                                    <div class="col s12 input-field">
                                        <i class="ion-android-calendar small prefix game-main-color"></i>
                                        <input id="date-form-alter-arrive-internal" name="date-search-courrier" type="date" class="form-control datepicker">           
                                        <label for="date-form-alter-arrive-internal">Précisez une date de rédaction</label>
                                    </div>

                                    <button type="submit" class="modal-action modal-close btn submit-button left" id="alter-courrier-sortie-submit">Enregistrer</button>
                                    <button type="reset" class="modal-action modal-close btn submit-button right" id="alter-courrier-cancel" >Annuler</button>

                                    <input type="hidden" value="43" name="admin-control"> 
                                    <input type="hidden" name="id-alter-sortie-courrier" id="id-alter-sortie-courrier-id">

                                 <div class="loaderAjax acc-medium-top-margin">
                                <img src="../AjaxLoader/loading2.gif" />
                               </div>


                            </form>
                       </div>
                  </div>


  <!--Confirm Delete Courrier Modal Box Structure -->
  <div id="confirmDeleteCourrier-arrive-Accc" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
            <h6 class="accc-color modal-text bold">Etes-vous sûre de vouloir supprimer le courrier portant le numéro de suivi
            <span id="courrier-deleted-id-arrive"></span><span id="courrier-deleted-suivi-arrive-accc"></span> complètement du fichier d'administration ? Celà aura pour éffet irreversible de supprimer les pieces jointes asociées.
            </h6>
                  <input type="hidden" id="courrier-deleted-id-depart-accc">
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="delete-courrier-arrive-accc-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>


<script src="../js/manage-admin.js"></script>
<script src="../js/filterCourrier.js"></script>