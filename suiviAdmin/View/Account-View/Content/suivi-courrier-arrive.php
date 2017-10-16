<?php $ManageAdmin->courrierArrive($_SESSION['adminInfo']->id);?>

      <div class="row center game-row-padding zero-margin accc-row-padding" class="general-info">
             <div class="generalStats zero-margin">
                 <h4 class="accc-color bold">Courriers Arrivés</h4>
            </div>

              <div class="row center game-row-padding">
                       <p class="accc-wrapper-button adding-filter-depart-internal">
                         <i class="ion-plus-round white-text small adding-Member-trigger"></i>
                         <i class="ion-funnel white-text small adding-Member-trigger"></i> 
                      </p>

                      <?php if( ($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="agent-arrive") ) :?>
                          <p class="accc-wrapper-button adding-courrier-depart-internal">
                             <i class="ion-plus-round white-text small adding-Member-trigger"></i>
                             <i class="ion-android-mail white-text small adding-Member-trigger"></i> 
                          </p>
                      <?php endif;?>    
              </div> 

                <div class="row center hidden" id="form-new-courrier-depart-accc-wrapper">
                  <div class="container">
                        <form id="new-courrier-registering" class="admin-form dash-form">
                          <h5 class="accc-color bold game-bottom-small-padding">Veuillez entrer les informations pour enregistrer le courrier arrivé</h5>

                          <div class="col s12">
                            <div class="col s6 input-field"> 
                                 <i class="ion-chatbox-working small prefix game-main-color"></i>
                                 <textarea  name="register-courrier-objet" class="required materialize-textarea" id="register-courrier-objet-id">Echelonnement de dettes</textarea>
                                 <label class="active" for="register-courrier-objet-id">Objet</label>
                            </div>

                            <div class="col s6 input-field"> 
                               <i class="ion-code-working small prefix game-main-color"></i>
                               <textarea  name="register-courrier-suffixe" class="required materialize-textarea" id="register-courrier-suffixe-id">ECH-2016</textarea>
                               <label class="active" for="register-courrier-suffixe-id">Numéro de suivi arrivé</label>
                            </div>

                          </div>


                          <div class="col s12">
                              <div class="col s6 input-field"> 
                                    <i class="ion-person small prefix game-main-color"></i>
                                   <textarea  name="register-courrier-destinataire" class="required materialize-textarea" id="register-courrier-dest-id">ACCC</textarea>
                                   <label class="active" for="register-courrier-dest-id">Destinataire Courrier</label>
                              </div>

                              <div class="col s6 input-field"> 
                                    <i class="ion-person small prefix game-main-color"></i>
                                   <textarea  name="register-courrier-expeditor" class="required materialize-textarea" id="register-courrier-exp-id">RIEHL EMMANUEL</textarea>
                                   <label class="active" for="register-courrier-exp-id">Expéditeur Courrier</label>
                              </div>

                          </div>

                          <div class="col s12">

                            <div class="col s6 input-field"> 
                              <i class="ion-android-list small prefix game-main-color"></i>
                              <textarea  name="register-courrier-reference" class="required materialize-textarea" id="register-courrier-ref-id">ECH-2016</textarea>
                              <label class="active" for="register-courrier-ref-id">Référence Courrier</label>
                            </div>

                              <div class="col s6 input-field">
                                  <label>Choisissez le niveau d'urgence</label><br>
                                  <select class="browser-default" name="register-courrier-urgence" id="register-courrier-urgence-id">
                                      <option value="1" selected>normal</option>
                                      <option value="2">urgent</option>
                                  </select>
                              </div>

                          </div>

                          <div class="col s12">

                              <div class="col s6 input-field">
                                  <label>Choisissez le type de courrier</label><br>
                                  <select class="browser-default" name="register-courrier-type" id="register-courrier-type-id">
                                      <option value="1" selected>courrier arrivé</option>
                                      <option value="3">Autre</option>
                                  </select>
                              </div>

                              <div class="col s6 input-field">
                                <div class="file-field input-field">
                                    <div class="btn center avatar-input-button">
                                      <i class="ion-email large file-input-label"></i>
                                      <input type="file" name="avatar" accept="pdf" class="" id="courrier-scan-input">
                                    </div>
                                    <div class="file-path-wrapper">
                                      <input class="file-path validate" type="text" placeholder="scan courrier" id="file-path-courrier">
                                    </div>
                                </div>
                              </div>

                          </div>


                        <div class="container">
                            <button type="submit" class="btn submit-button left" id="register-new-courrier-submit">Enregistrer</button>
                            <button type="reset" class="btn submit-button right" id="register-internal-depart-cancel">Annuler</button>  
                        </div>

                          <input type="hidden" value="44" name="admin-control">
                                  </form>

                          <div class="loaderAjax acc-medium-top-margin">
                            <img src="../AjaxLoader/loading2.gif" />
                            <h5 class="orange-text bold">Enregistrement du courrier en cours veuillez patienter...</h5>
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
                                        <option value="numsuivi-search" selected>Par Numéro identifiant de courrier</option>
                                        <option value="ref-search">Par Référence</option>
                                        <option value="objet-search">Par Objet</option>
                                        <option value="dateEnr-search">Par Date</option>
                                        <option value="state-search">Par Etat</option>
                                        <option value="urgence-search">Par Niveau d'Urgence</option>
                                        <option value="exp-search">Par Nom</option>
                                        <option value="">Enlever le filtre</option>
                                    </select>
                       </div>
                </div>

                <div class="col s6">
                      <div class="col s12 search-element numsuivi-search">
                            <h5 class="accc-color">Recherche par numéro identifiant de courrier</h5>
                            <i class="ion-card accc-color medium"></i>
                              <i class="ion-ios-search-strong accc-color large"></i>
                              <div class="col s12  accc-small-row-padding">
                                <form id="search-courrier-byNumSuivi-archive" class="admin-form dash-form">
                                    <div class="col s12 input-field">
                                      <input type="number"  name="num-suivi-search" class="required materialize-textarea" id="num-suivi-search-id" />
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
                                      <option value="today-delay">Expirant aujourd'hui</option>undefined-delay
                                      <option value="undefined-delay">Indéfini (Courriers d'information)</option>
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
                   
                  <?php if($_SESSION['courrierArrive'][0]!==0) :?>
                        <table class="MyTable striped bordered bold centered" id="archives-table">
                            <thead class="orange white-text">
                                <tr>
                                  <th data-field="id">id</th>
                                  <th data-field="id">Numero suivi arrivé</th>
                                  <th data-field="id">Reference</th>
                                  <th data-field="id">Expediteur</th>
                                  <th data-field="id">Destinataire</th>                                  
                                  <th data-field="id">Objet</th>
                                  <th data-field="id">Consulter arrivé</th>
                                  <th data-field="id">Date arrivé</th>
                                  <th data-field="id">Delai restant</th>
                                  <th data-field="id" class="hidden">FlexFile</th>
                                  <th data-field="id">Action</th>                               
                                </tr>
                            </thead>
                            <tbody>
                           <?php foreach ($_SESSION['courrierArrive'] as $key => $value): ?>
                              <?php foreach  ($value as $ind=>$val): ?>
                                 <?php 
                                  switch ($val->urgence) {
                                            case 0:
                                                  $backStripe="accc-light-stripe-green white-text";
                                                  $state="information";
                                                  $delayState="undefined-delay";
                                            break;
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
                                  ?>    
   <?php if( ($_SESSION['adminInfo']->idService==1)  || (($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable")) || (($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="secretaire")) || (($_SESSION['adminInfo']->idService==2) && ($_SESSION['adminInfo']->poste=="secretaire")) || (($_SESSION['adminInfo']->idService==2) && ($_SESSION['adminInfo']->poste=="responsable")) || ($ManageAdmin->CheckedImputation($_SESSION['adminInfo']->id,$val->id)) || ($val->state==3) ) :?>

                                  <tr class="<?php echo $backStripe; ?> <?php echo $delayState; ?> <?php echo $state; ?> <?php echo $val->id; ?> <?php echo strtoupper($val->reference); ?> <?php echo strtoupper($val->expediteur); ?> <?php echo strtoupper($val->destinataire); ?> <?php echo strtoupper($val->objet); ?> <?php echo substr($val->dateEnr,0,10); ?>">
                                      <td><?php echo $val->id; ?></td>
                                      <td><?php echo $val->numSuivi; ?></td>
                                      <td><?php echo $val->reference; ?></td>
                                      <td><?php echo $val->expediteur; ?></td>
                                       <td><?php echo $val->destinataire; ?></td>
                                      <td><?php echo $val->objet; ?></td>
                                      
                                      <td class="center">
                                        
                                        <a href="../simple_flex/index.php?pathPdf=<?php echo $val->piece; ?>" class="path-down-courrier seenCourrier" id="<?php echo $val->piece; ?>" target="_blank">

                                        <i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece" >
                                        <?php if($val->seen==0) :?>
                                        <i class="ion-asterisk white-text small waves-effect">
                                          
                                        </i> 
                                        <?php endif; ?>

                                        </i> 
                                        </a>
                                        
                                      </td>
                                      <td><?php echo $val->dateEnr; ?></td>
                                      <td>
                                            <?php
                                              if($val->urgence!=0)
                                              {
                                               $delay=$val->dayRest;
                                                if($delay>0)
                                                  echo "En retard de ".$delay." jour(s)";
                                                else if($delay<0)
                                                  echo "En avance de ".($delay*-1)." jour(s)";
                                               else
                                              echo "Expire Aujourd'hui";
                                              }
                                              else
                                               echo "Indéfini";
                                            ?>    
                                      </td>
                                      <td class="hidden"><?php echo $val->piece; ?></td>
                                      <td>
                                      <?php if( (($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable")) || ($ManageAdmin->checkEnregistrorArrive($_SESSION['adminInfo']->id)==true) ) :?>
                                      <i class="ion-edit white-text small btn waves-effect trash-button change-arrive-courrier-trigger"></i>
                                       <?php endif; ?>
                                        <?php if(($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable")) :?>
                                        <i class="ion-ios-trash white-text small btn waves-effect trash-button trash-courrier-arrive-trigger"></i>
                                         <?php endif; ?>
                                       <?php   if($val->state!=3) :?>
                                       <?php if( ($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable") ) :?>
                                      <?php if($val->stateNotification==1):?>
                                      <i class="btn ion-android-notifications white-text small btn waves-effect trash-button des-not-trigger tooltipped" data-tooltip="Desactiver les notifications d'alerte" data-delay="50" data-position="top"></i>
                                      <?php else:?>
                                      <i class="btn ion-android-notifications-none white-text small btn waves-effect trash-button act-not-trigger tooltipped" data-tooltip="Activer les notifications d'alerte" data-delay="50" data-position="top"></i>
                                      <?php endif; ?> 
                                    <?php   endif; ?>
                                    <?php   endif; ?>
                                      <img src="../AjaxLoader/715.gif" class="push-read-loader"/><img src="../AjaxLoader/727.gif" class="loader-trash"/>
                                      </td>
                                  </tr>

                                 <?php endif; ?>
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

  <!--Confirm Delete Member Modal Box Structure -->
  <div id="confirmDeleteCourrierArr" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
            </p>

            <h6 class="game-main-color modal-text bold orange-text">Etes-vous sûre de vouloir supprimer le courrier portant le numéro de suivi <span id="suivi-arrive-deleted"></span>
            expedié par <span id="exp-deleted-arrive-courrier"></span> d'identifiant <span id="deleted-arrive-id"></span> complètement du fichier d'administration ? Celà aura pour effet irreversible de supprimer les pieces jointes associées à ce courrier.
            </h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold orange-text" id="delete-courrier-arrive-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold orange-text">Annuler</a>
        </div>
  </div>

    <!-- OFF Notifications -->
  <div id="OffNot" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
            </p>

            <h6 class="game-main-color modal-text bold orange-text">Etes-vous sûre de vouloir désactiver les notifications d'alerte pour le courrier portant le numéro identifiant <span id="del-not-courrier"></span>
            </h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold orange-text" id="del-not-courrier-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold orange-text">Annuler</a>
        </div>
  </div>

      <!-- ON Notifications -->
  <div id="OnNot" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
            </p>

            <h6 class="game-main-color modal-text bold orange-text">Etes-vous sûre de vouloir réactiver les notifications d'alerte pour le courrier portant le numéro identifiant <span id="act-not-courrier"></span>
            </h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold orange-text" id="act-not-courrier-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold orange-text">Annuler</a>
        </div>
  </div>

            <!--Box Imputation -->
  <div id="selectRespImputation" class="modal white center-align">
        <div class="modal-content accc-row-padding">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
              <?php 
                  if($_SESSION['AuthClient']->idService==2)
                  {
                    $titleImputation=" une entité";
                  }
                  if($_SESSION['AuthClient']->idService==3)
                  {
                    $titleImputation="un Chef de service";
                  }
                  if($_SESSION['AuthClient']->idService==4)
                  {
                    $titleImputation="un Agent";
                  }
               ?>
                            <form id="imputation-form" class="dash-form accc-row-padding">
                                    <h5 class="accc-color bold game-bottom-small-padding">Veuillez spécifier <?php echo $titleImputation; ?> objet de l'imputation</h5>

                                    <div class="col s12 input-field">
                                        <label>Choisissez <?php echo $titleImputation; ?></label><br>
                                          <select multiple name="imputation-selection-resp[]" id="alter-service-admin-select">
                                           <option value="">Non définie</option>
                                              <?php if($_SESSION['AuthClient']->idService>2) :?>
                                                <?php foreach ($_SESSION['recupImputResp'] as $key => $value): ?>
                                                  <option value="<?php echo $value->id; ?>"><?php echo $value->nom." ".$value->prenom; ?></option>
                                                <?php endforeach; ?>
                                              <?php endif; ?>

                                               <?php if($_SESSION['AuthClient']->idService==2) :?>
                                                <?php foreach ($_SESSION['recupResponsible'] as $key => $value): ?>
                                                  <option value="<?php echo $value->id; ?>"><?php
                                                        if($value->idService==3)
                                                            $desc="Fondé";
                                                        if($value->idService==4)
                                                            $desc="Chef de service";
                                                   echo $value->nom." ".$value->prenom."({$desc})"; ?></option>
                                                <?php endforeach; ?>
                                               <?php  endif; ?>
                                          </select>
                                    </div>

                                    <button type="submit" class="modal-action modal-close btn submit-button left" id="imp-submit">Imputer</button>
                                    <button type="reset" class="modal-action modal-close btn submit-button right" id="imp-cancel" >Annuler</button>

                                    <input type="hidden" name="suivi-courrier-imputation" id="suivi-courrier-imputation-id" value="">
                                    <input type="hidden" value="49" name="admin-control">
                                    <input type="hidden" name="pathFile" value="" id="pathFileFlex"> 
                                </form>
        </div>
  </div>

  <!--Modifier un courrier Modal Box Structure -->
  <div id="confModArrive" class="modal white center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
                            <form id="alter-register-courrier-arrive-form" class="dash-form">
                                    <h5 class="accc-color bold game-bottom-small-padding">Veuillez apporter vos modifications sur l'enregistrement du courrier arrivé <span id="numSuivi-Arrive"></span></h5>

                                    <div class="col s12 input-field">
                                      <i class="ion-person small prefix game-main-color"></i>
                                      <textarea  name="alter-courrier-objet" class="required materialize-textarea" id="alter-courrier-objet-id"></textarea>
                                      <label class="active" for="alter-courrier-objet-id">Objet</label>
                                    </div>


                                    <div class="col s12 input-field">
                                      <i class="ion-person small prefix game-main-color"></i>
                                      <textarea  name="alter-courrier-suffixe" class="required materialize-textarea" id="alter-courrier-suffixe-id"></textarea>
                                      <label class="active" for="alter-courrier-suffixe-id">Numéro de suivi arrivé</label>
                                    </div>

                                  <div class="col s12 input-field"> 
                                        <i class="ion-person small prefix game-main-color"></i>
                                       <textarea  name="register-courrier-destinataire-alter" class="required materialize-textarea" id="register-courrier-dest-alter-id">ACCC</textarea>
                                       <label class="active" for="register-courrier-dest-id">Destinataire Courrier</label>
                                  </div>


                                    <div class="col s12 input-field">
                                      <i class="ion-person small prefix game-main-color"></i>
                                      <textarea  name="alter-courrier-reference" class="required materialize-textarea" id="alter-courrier-ref-id"></textarea>
                                      <label class="active" for="alter-courrier-ref-id">Référence Courrier</label>
                                    </div>

                                    <div class="col s12 input-field">
                                      <i class="ion-person small prefix game-main-color"></i>
                                      <textarea  name="alter-courrier-expeditor" class="required materialize-textarea" id="alter-courrier-exp-id"></textarea>
                                      <label class="active" for="alter-courrier-exp-id">Expéditeur Courrier</label>
                                    </div>

                                    <div class="col s12 input-field" id="urgence-wrapper">
                                      <label>Choisissez le niveau d'urgence</label><br>
                                        <select class="browser-default" name="alter-courrier-urgence" id="alter-courrier-urgence-id">
                                            <option value="1">normal</option>
                                            <option value="2">urgent</option>
                                        </select>
                                    </div>
                                  <div class="col s12">
                                    <div class="file-field input-field">
                                        <div class="btn center avatar-input-button">
                                          <i class="ion-email large file-input-label"></i>
                                          <input type="file" name="avatar" accept="pdf" class="" id="courrier-scan-input">
                                        </div>
                                        <div class="file-path-wrapper">
                                          <input class="file-path validate" type="text" placeholder="scan courrier" id="file-path-courrier">
                                        </div>
                                    </div>
                                  </div>

                                    <button type="submit" class="modal-action modal-close btn submit-button left" id="alter-courrier-submit">Enregistrer</button>
                                    <button type="reset" class="modal-action modal-close btn submit-button right" id="alter-courrier-cancel" >Annuler</button>

                                    <input type="hidden" value="45" name="admin-control"> 
                                    <input type="hidden" name="id-alter-alter-courrier" id="id-alter-alter-courrier-id">
                            </form>
        </div>
  </div>

<script src="../js/manage-admin.js"></script>
<script src="../js/filterCourrier.js"></script>


