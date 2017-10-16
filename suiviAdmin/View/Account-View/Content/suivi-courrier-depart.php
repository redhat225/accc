<?php $ManageAdmin->courrierDepart();?>
      <div class="row center game-row-padding zero-margin" class="general-info">
            
              <p class="generalStats zero-margin">
                  <h4 class="accc-color bold">Courriers départ</h4>
              <!-- <a href="#archives-explanation" class="btn submit-button">En savoir plus</a> --> 
            </p>

              <div class="row center">
                       <p class="accc-wrapper-button adding-filter-depart-internal">
                         <i class="ion-plus-round white-text small adding-Member-trigger"></i>
                         <i class="ion-funnel white-text small adding-Member-trigger"></i> 
                        </p>
                          <?php if( ($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="agent-depart") ) :?>
                            <p class="accc-wrapper-button adding-courrier-depart-internal">
                                <i class="ion-plus-round white-text small adding-Member-trigger"></i>
                                <i class="ion-android-mail white-text small adding-Member-trigger"></i> 
                             </p> 
                          <?php endif;?> 
              </div> 

                <div class="row center hidden" id="form-new-courrier-depart-accc-wrapper">
                  <div class="container">
                        <form id="new-courrier-depart-registering" class="accc-row-padding admin-form dash-form">
                          <h5 class="accc-color bold game-bottom-small-padding">Veuillez entrer les informations pour enregistrer le courrier depart</h5>

                          <div class="col s12 input-field">
                            <i class="ion-card small prefix game-main-color"></i>
                            <input type="number" name="register-courrier-suivi-depart" class="required materialize-textarea" id="register-courrier-objet-id" />
                            <label class="" for="register-courrier-objet-id">Identifiant courrier arrivé</label>
                          </div>



                            <div class="col s12 input-field">
                              <i class="ion-code-working small prefix game-main-color"></i>
                              <textarea  name="numSuiviDepart" class="required materialize-textarea" id="numSuiviDepart-id"></textarea>
                              <label class="" for="numSuiviDepart-id">Numéro suivi départ</label>
                            </div>

                          <div class="col s12">
                            <div class="file-field input-field">
                                <div class="btn center avatar-input-button">
                                  <i class="ion-android-document large file-input-label"></i>
                                  <input type="file" name="avatar" accept="pdf" class="required" id="courrier-scan-input">
                                </div>
                                <div class="file-path-wrapper">
                                  <input class="file-path validate" type="text" placeholder="scan decharge" id="file-path-courrier">
                                </div>
                            </div>
                          </div>
                          <div class="container">
                          <button type="submit" class="btn submit-button left" id="register-new-courrier-submit">Enregistrer</button>
                          <button type="reset" class="btn submit-button right" id="register-internal-depart-cancel">Annuler</button>
                          </div>


                          <input type="hidden" value="47" name="admin-control">
                      

                          <div class="loaderAjax acc-medium-top-margin">
                            <img src="../AjaxLoader/loading2.gif" />
                           </div>
                      </form>
                  </div>
                </div>

          <div class="row center hidden" id="Filtrage-wrapper"> 
                <div class="col s6">
                        <h5 class="accc-color">Filtrage</h5>
                                <i class="ion-ios-settings-strong accc-color large"></i>
                                <div class="col s12 input-field">
                                    <label>Choisissez le filtrage</label><br>
                                    <select class="browser-default" name="" id="filter-select-type-courrier">
                                      <option value="numsuivi-search" selected>Par Numéro identifiant courrier</option>
                                      <option value="ref-search">Par référence</option>
                                      <option value="objet-search">Par objet</option>
                                      <option value="dateEnr-search">Par Date</option>
                                      <option value="urgence-search">Par Niveau d'Urgence</option>
                                      <option value="exp-search">Par Nom</option>
                                      <option value="">Enlever le filtre</option>
                                    </select>
                       </div>
                </div>

                <div class="col s6">
                      <div class="col s12 search-element numsuivi-search">
                            <h5 class="accc-color">Recherche par numero identifiant courrier</h5>
                            <i class="ion-card accc-color medium"></i>
                              <i class="ion-ios-search-strong accc-color large"></i>
                              <div class="col s12  accc-small-row-padding">
                                <form id="search-courrier-byNumSuivi-archive" class="admin-form dash-form">
                                    <div class="col s12 input-field">
                                      <input type="number"  name="num-suivi-search" class="required materialize-textarea" id="num-suivi-search-id" />
                                      <label class="" for="num-suivi-search-id">Numéro identifiant courrier</label>
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
                                      <option value="information">Information</option>
                                    </select>
                                </div>
                            </div>


                          <div class="col s12 search-element dateEnr-search hidden">
                            <h5 class="accc-color">Recherche par Date</h5>
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
                   
                  <?php if($_SESSION['courrierDepart'][0]!==0) :?>
                        <table class="MyTable striped bordered bold centered" id="archives-table">
                            <thead class="orange white-text">
                                <tr>
                                  <th data-field="id">id</th>
                                  <th data-field="id">Numero suivi départ</th>
                                  <th data-field="id">Numero suivi arrivé</th>
                                  <th data-field="id">Destinataire</th>
                                  <th data-field="id">Expediteur</th>
                                  <th data-field="id">Objet</th>
                                  <th data-field="id">Consulter arrivé</th>
                                  <th data-field="id">Consulter départ</th>
                                  <th data-field="id">Date arrivé</th>
                                  <th data-field="id">Date départ</th>                              
                                  <th data-field="id">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                           <?php foreach ($_SESSION['courrierDepart'] as $key => $value): ?>
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

                             <?php if( ($_SESSION['adminInfo']->idService==1)  || (($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable")) || (($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="secretaire")) || (($_SESSION['adminInfo']->idService==2) && ($_SESSION['adminInfo']->poste=="secretaire")) || (($_SESSION['adminInfo']->idService==2) && ($_SESSION['adminInfo']->poste=="responsable")) || ($ManageAdmin->CheckedImputation($_SESSION['adminInfo']->id,$val->id)) ) :?>

                                  <tr class="<?php echo $backStripe; ?> <?php echo $state; ?> <?php echo $val->id; ?> <?php echo $val->id."".$val->numSuivi; ?> <?php echo $val->id."".$val->numSuiviDepart; ?> <?php echo $val->reference; ?> <?php echo strtoupper($val->expediteur); ?> <?php echo $val->objet; ?> <?php echo substr($val->dateEnr,0,10); ?> <?php echo strtoupper($val->destinataire); ?> <?php echo substr($val->dateTrt,0,10); ?>">
                                      <td><?php echo $val->id; ?></td>
                                      <td><?php echo $val->numSuiviDepart; ?></td>
                                      <td><?php echo $val->numSuivi; ?></td>
                                      <td><?php echo $val->destinataire; ?></td>
                                      <td><?php echo $val->expediteur; ?></td>
                                      <td><?php echo $val->objet; ?></td>
                                      <td><a href="../simple_flex/index.php?pathPdf=<?php echo $val->piece; ?>&state=<?php echo $val->state; ?>" class="path-down-courrier" target="_blank" id="<?php echo $val->piece; ?>"><i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece"></i></a></td>
                                      <td>
                                        <a href="../simple_flex/index.php?pathPdf=<?php echo $val->pieceDepart; ?>&state=<?php echo $val->state; ?>" class="path-down-courrier" target="_blank" id="<?php echo $val->pieceDepart; ?>"><i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece"></i></a> 
                                        </td>
                                      <td><?php echo $val->dateEnr; ?></td>
                                      <td><?php echo $val->dateTrt; ?></td>

                                      <td>
                                      <?php if( ( ($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable") ) || ($ManageAdmin->checkEnregistrorDepart($_SESSION['adminInfo']->id)) ) :?>
                                      <i class="ion-edit white-text small btn waves-effect trash-button change-scan-depart-courrier-trigger"></i>
                                      <?php   endif; ?>
                                      <?php if(($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable")) :?>
                                      <i class="ion-trash-a white-text small btn waves-effect trash-button trash-courrier-depart-trigger"></i>
                                    <?php endif; ?>
                                      <img src="../AjaxLoader/715.gif" class="push-read-loader"/><img src="../AjaxLoader/727.gif" class="loader-trash"/></td>
                                  </tr>

                                  <?php   endif; ?> 
                                   <?php endforeach; ?>
                              <?php endforeach; ?>
                            </tbody>               
                        </table>
                  <?php else: ?>
                        <i class="ion-android-warning accc-huge-icon accc-color"></i>
                        <h4 class="accc-color zero-margin">Pas de courrier départ enregistré</h4>
                  <?php endif; ?>

                </div>
         </div>
  <!--Modifier un courrier Modal Box Structure -->
  <div id="confModDepart" class="modal white center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
                            <form id="alter-register-courrier-depart-form" class="dash-form">
                                    <h5 class="accc-color bold game-bottom-small-padding">Veuillez apporter vos modifications sur l'enregistrement du courrier départ <span id="numSuivi-Arrive"></span></h5>

                                  <div class="col s12">
                                    <div class="file-field input-field">
                                        <div class="btn center avatar-input-button">
                                          <i class="ion-android-document large file-input-label"></i>
                                          <input type="file" name="avatar" accept="pdf" class="required" id="courrier-scan-input-external-depart">
                                        </div>
                                        <div class="file-path-wrapper">
                                          <input class="file-path validate" type="text" placeholder="scan courrier" id="file-path-courrier">
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col s12 input-field">
                                    <i class="ion-code-working small prefix game-main-color"></i>
                                    <textarea  name="numSuiviDepart" class="required materialize-textarea" id="numSuiviDepart-id-alter"></textarea>
                                    <label class="active" for="numSuiviDepart-id-alter">Numéro suivi départ</label>
                                  </div>

                                    <button type="submit" class="modal-action modal-close btn submit-button left" id="alter-courrier-submit-alter-depart-external">Enregistrer</button>
                                    <button type="reset" class="modal-action modal-close btn submit-button right" id="alter-courrier-cancel" >Annuler</button>

                                    <input type="hidden" value="48" name="admin-control"> 
                                    <input type="hidden" name="id-alter-alter-courrier-depart" id="id-alter-alter-courrier-id-depart-internal">
                            </form>
        </div>
  </div>

  <!--Confirm Delete Courrier Member Modal Box Structure -->
  <div id="confirmDeleteCourrierDep" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
            </p>

            <h6 class="game-main-color modal-text bold orange-text">Etes-vous sûre de vouloir supprimer le courrier portant le numéro de suivi <span id="suivi-arrive-deleted"></span>
            expedié par <span id="exp-deleted-arrive-courrier"></span> d'identifiant <span id="deleted-arrive-id"></span> complètement du fichier d'administration ? Celà aura pour effet irreversible de supprimer les pieces jointes associées à ce courrier.
            </h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="delete-courrier-depart-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>
<script src="../js/manage-admin.js"></script>
<script src="../js/filterCourrier.js"></script>
