<?php $ManageAdmin->courrierAdminInfo(); ?>
<?php $ManageAdmin->servicesInfo(); ?>
<?php $ManageAdmin->clientInfo(); ?> 
<?php $ManageAdmin->distinctExpeditor(); ?>
 <div class="row center game-row-padding">
                <div class="container">
                    <i class="ion-email accc-huge-icon accc-color"></i>
                    <i class="ion-arrow-down-c large accc-color"></i>
                    <h4 class="bold accc-color zero-margin">Courriers Arrivés</h4>
                    <h5>Consultez l'état de traitement des courries arrivés ACCC</h5>
                </div>
  </div> 
  
              <div class="row center basic-action-courrier">
                       <span class="accc-color bold adding-element-courrier-trigger" id="adding-new-courrier-trigger"><i class="ion-android-mail accc-color medium adding-Member-trigger"></i>Enregistrer courrier arrivé</span> 
                       <span class="accc-color bold adding-element-courrier-trigger" id="adding-new-filter-courrier-trigger"><i class="ion-funnel accc-color medium adding-Member-trigger"></i>Filtrages</span> 
<!--                         <span class="accc-color bold adding-element-courrier-trigger" id="assigning-service-courrier-trigger"><i class="ion-ios-navigate accc-color medium adding-Member-trigger"></i>Assigner Service Traitement</span> 
 -->              </div> 

                <div class="row center hidden" id="filtrage-courrier-wrapper">
                    <div class="container">
                        <div class="col s6">
                          <h5 class="accc-color">Filtrage</h5>
                          <i class="ion-ios-settings-strong accc-color large"></i>
                          <div class="col s12 input-field">
                              <label>Choisissez le filtrage</label><br>
                              <select class="browser-default" name="" id="filter-select-courrier">
                                <option value=""selected>Tout</option>
                                <option value="2">Délais dépassés</option>
                                <option value="3">Délais avancés</option>
                                <option value="4">Délais expirants aujourd'hui</option>
                                <option value="5">Urgents</option>
                              </select>
                          </div>
                          <div class="col s12 input-field">
                            <h5 class="accc-color">Recherche par Expediteur</h5>
                              <i class="ion-android-walk accc-color medium"></i>
                              <i class="ion-ios-search-strong accc-color large"></i>
                              <select class="browser-default" name="" id="filter-select-expeditor-courrier">
                                <option value=""selected>Tout</option>
                                  <?php foreach ($_SESSION['distinctExpeditor'] as $key => $value): ?>
                                       <option value="<?php echo $value->nom; ?>"><?php echo $value->nom; ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
<!--                           <div class="col s12 input-field">
                            <h5 class="accc-color">Recherche par Service</h5>
                              <i class="ion-ios-home accc-color medium"></i>
                              <i class="ion-ios-search-strong accc-color large"></i>
                              <select class="browser-default" name="" id="filter-select-traitor-courrier">
                                <option value=""selected>Tout</option>
                                <option value="indefined">Service non défini</option>
                                  <?php foreach ($_SESSION['servicesInfo'] as $key => $value): ?>
                                       <option value="<?php echo $value->nomService; ?>"><?php echo $value->nomService; ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div> -->
<!--                         </div>
                        <div class="col s6">
                          <h5 class="accc-color">Recherche</h5>
                          <i class="ion-ios-search-strong accc-color large"></i>
                          <div class="col s12  accc-small-row-padding">
                            <form id="search-courrier-byNumSuivi" class="admin-form dash-form">
                                <div class="col s12 input-field">
                                  <textarea  name="num-suivi-search" class="required materialize-textarea" id="num-suivi-search-id"></textarea>
                                  <label class="" for="num-suivi-search-id">Numéro de suivi courrier</label>
                                   <button type="submit" class="btn submit-button center" id="submit-search-courrier-suivi">Rechercher</button>
                                   <button type="" class="btn submit-button center" id="cancel-search-courrier-suivi">Reinitialiser</button>
                                  <div class="loaderAjax acc-medium-top-margin">
                                    <img src="../AjaxLoader/loading2.gif" />
                                  </div>
                                </div>
                            </form>
                          </div>
                          <div class="col s12 accc-small-row-padding">
                            <form id="search-courrier-byDate" class="admin-form dash-form">
                              <div class="col s12 input-field">
                                  <i class="ion-calendar prefix"></i>
                                  <input id="date-form" name="date-search-courrier" type="text" class="form-control datepicker required">                              
                                  <label for="date-form">Date souhaitée formation</label>
                                  <button type="submit" class="btn submit-button center" id="submit-search-courrier-date">Rechercher</button>
                                  <button type="" class="btn submit-button center" id="cancel-search-courrier-date">Reinitialiser</button>
                                  
                                  <div class="loaderAjax acc-medium-top-margin">
                                    <img src="../AjaxLoader/loading2.gif" />
                                  </div>
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div> -->

                <div class="row center hidden" id="form-new-courrier-wrapper">
                  <div class="container">
                    <div class="container">
                        <form id="new-courrier-registering" class="accc-row-padding admin-form dash-form">

                          <i class="ion-ios-plus-outline accc-color small"></i>
                          <i class="ion-email accc-color medium"></i>
                          <h5 class="accc-color bold game-bottom-small-padding">Veuillez entrer les informations pour enregistrer le courrier</h5>

                          <div class="col s12 input-field">
                            <i class="ion-person small prefix game-main-color"></i>
                            <textarea  name="register-courrier-objet" class="required materialize-textarea" id="register-courrier-objet-id"></textarea>
                            <label class="" for="register-courrier-objet-id">Objet</label>
                          </div>


                          <div class="col s12 input-field">
                            <i class="ion-person small prefix game-main-color"></i>
                            <textarea  name="register-courrier-reference" class="required materialize-textarea" id="register-courrier-objet-id"></textarea>
                            <label class="" for="register-courrier-objet-id">Référence Courrier</label>
                          </div>

                          <div class="col s12 input-field">
                            <i class="ion-person small prefix game-main-color"></i>
                            <textarea  name="register-courrier-expeditor" class="required materialize-textarea" id="register-courrier-objet-id"></textarea>
                            <label class="" for="register-courrier-objet-id">Expéditeur Courrier</label>
                          </div>

                          <div class="col s12 input-field">
                            <label>Choisissez le niveau d'urgence</label><br>
                              <select class="browser-default" name="register-courrier-urgence" id="register-courrier-urgence-id">
                                  <option value="1" selected>normal</option>
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
                                <input class="file-path validate" type="text" placeholder="scan courrier"id="file-path-courrier">
                              </div>
                          </div>
                        </div>
<!--                           <div class="col s12 input-field">
                            <i class="ion-android-mail small prefix game-main-color"></i>
                            <input type="number" name="register-courrier-delay" class="required" id="register-courrier-delay-id">
                            <label class="" for="register-courrier-delay-id">Délai Traitement</label>
                          </div> -->

                          <button type="submit" class="btn submit-button left" id="register-new-courrier-submit">Enregistrer</button>
                          <button type="reset" class="btn submit-button right">Annuler</button>

                          <input type="hidden" value="12" name="admin-control">
                      

                          <div class="loaderAjax acc-medium-top-margin">
                            <img src="../AjaxLoader/loading2.gif" />
                           </div>

                      </form>
                    </div>
                  </div>
                </div>


  <div class="row" id="gamer-info-table">

                      <table class="MyTable bordered bold centered responsive-table" id="courrier-admin-table">
                          <thead class="black orange-text">
                              <tr>
                                  <th data-field="id">identifiant courrier</th>
                                  <th data-field="id">Expéditeur courrier</th>
                                  <th data-field="id">Numero suivi courrier</th>
                                  <th data-field="id">Télécharger</th>
                                  <th data-field="id">Objet courrier</th>
                                  <th data-field="id">Date enregistrement</th>
                                  <th data-field="id">Date prévue retour</th>
                                  <th data-field="id">Jours de traitement restants</th>
                                  <th data-field="id">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                           <?php foreach ($_SESSION['courrierAdminInfo'] as $key => $value): ?>
                              <?php foreach  ($value as $ind=>$val): ?>
                                 <?php 
                                  switch ($val->state)
                                        {
                                            case 2:
                                                  $dayRest=$val->dayRest; 
                                                switch($val->niveauUrgence)
                                                {
                                                  case 1:
                                                        if($dayRest>0)
                                                      $backStripe="accc-orange-treat-stripe white-text";
                                                        if($dayRest<0)
                                                      $backStripe="accc-green-treat-stripe white-text";
                                                        if($dayRest==0)
                                                      $backStripe="accc-grey-treat-stripe white-text";  
                                                  break;
                                                  case 2:
                                                      if($dayRest>0)
                                                      $backStripe="accc-alert-stripe expired white-text";
                                                        if($dayRest<0)
                                                      $backStripe="accc-alert-stripe load white-text";
                                                        if($dayRest==0)
                                                      $backStripe="accc-alert-stripe deadline white-text";  
                                                  break;
                                                }
                                                $state="En cours de traitement";
                                                $idState=$val->state;
                                            break;
                                          }
                                  ?>    

                                  <tr class="<?php echo $backStripe; ?> <?php echo $val->numSuivi; ?> <?php echo $val->filterPickDate; ?> <?php echo $val->nom; ?> <?php echo $val->nomService; ?>">
                                      <td><?php echo $val->idCourrier; ?></td>
                                      <td><?php echo $val->nom; ?></td>
                                      <td><?php echo $val->numSuivi; ?></td>
                                      <td><a href="../serverTraitor/download.php?piece=<?php echo $val->pieces; ?>" class="path-down-courrier" id="<?php echo $val->pieces; ?>"><i class="ion-arrow-down-a white-text small btn waves-effect trash-button get-join-piece"></i></a></td>
                                      <td><?php echo $val->objetCourrier; ?></td>
                                      <td><?php echo $val->recordDate; ?></td>
                                      <td><?php echo $val->datePrevueTraitement; ?></td>
                                      <td>
                                        <?php 
                                          if($val->dayRest>0) 
                                            echo "En retard de ".$val->dayRest." jour(s)";
                                          if($val->dayRest<0) 
                                            echo "En avance de ".($val->dayRest*-1)." jour(s)";
                                          if($val->dayRest==0) 
                                            echo "Expire aujourd'hui";
                                         ?>
                                      </td>                                                                                                                                                                                     
                                      <td><i class="ion-edit white-text small btn waves-effect trash-button change-info-courrier-trigger"></i><i class="ion-ios-trash white-text small btn waves-effect trash-button trash-courrier-trigger"></i> <img src="../ajaxLoader/715.gif" class="push-read-loader"/><img src="../ajaxLoader/727.gif" class="loader-trash"/></td>
                                  </tr>
                                   <?php endforeach; ?>
                              <?php endforeach; ?>
                          </tbody>               
                            <tfoot>

                            </tfoot>
                      </table>
              </div> 


                <div class="row center hidden" id="assigning-service-courrier-wrapper">
                    <div class="container">
                        <div class="container">
                            <form id="assiging-service-form" class="dash-form">

                              <i class="ion-ios-plus-outline accc-color small"></i>
                              <i class="ion-ios-navigate accc-color large"></i>
                              <h5 class="accc-color bold game-bottom-small-padding">Veuillez entrer les informations d'assignation courrier</h5>

                              <div class="col s12 input-field">
                                  <label>Choisissez le numero de suivi</label><br>
                                  <select class="browser-default" name="assigning-courrier-suivi" id="assigning-courrier-suivi-id">
                                       <option value="" selected>Choisissez un numéro de suivi</option>
                                        <?php foreach ($_SESSION['courrierAdminInfo'] as $key => $value):?>
                                          <?php foreach ($value as $index => $val):?>
                                          <option value="<?php echo $val->idCourrier; ?>"><?php echo $val->numSuivi;?></option>
                                          <?php endforeach; ?>
                                        <?php endforeach; ?>
                                  </select>
                              </div>

                              <div class="col s12 input-field">
                                  <label>Choisissez le service traitant le courrier</label><br>
                                  <select class="browser-default" name="assigning-courrier-service" id="assigning-courrier-service-id">
                                   <option value="" selected>Choisissez un service</option>
                                    <?php foreach ($_SESSION['servicesInfo'] as $key => $value):?>
                                      <option value="<?php echo $value->idService; ?>"><?php echo $value->nomService;?></option>
                                  <?php endforeach; ?>
                                  </select>
                              </div>

                              <button type="submit" class="btn submit-button left" id="assiging-courrier-submit">Enregistrer</button>
                              <button type="reset" class="btn submit-button right"id="assiging-courrier-cancel" >Annuler</button>

                              <input type="hidden" value="23" name="admin-control">
                            

                                 <div class="loaderAjax acc-medium-top-margin">
                                <img src="../AjaxLoader/loading2.gif" />
                               </div>


                            </form>
                        </div>
                    </div>  
                </div>
                

                <div class="row center hidden" id="alter-register-courrier-wrapper">
                    <div class="container">
                        <div class="container">
                            <form id="alter-register-courrier-form" class="dash-form">
                                    <i class="ion-email accc-color medium"></i>
                                    <i class="ion-edit accc-color large"></i>
                                    <h5 class="accc-color bold game-bottom-small-padding">Veuillez apporter vos modifications sur l'enregistrement  du courrier</h5>

                                  <div class="file-field input-field">
                                   <div class="btn center avatar-input-button">
                                        <i class="ion-email large file-input-label"></i>
                                        <input type="file" name="avatar" accept="pdf" class="" id="courrier-scan-input">
                                      </div>
                                      <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="scan courrier"id="file-path-courrier">
                                      </div>
                                  </div>

                                  <div class="col s12 input-field">
                                    <i class="ion-person small prefix game-main-color"></i>
                                    <textarea  name="alter-register-courrier-suivi" class="materialize-textarea" id="alter-register-courrier-suivi-id" disabled></textarea>
                                    <label class="active" for="alter-register-courrier-suivi-id">numero de suivi</label>
                                  </div>

                                  <div class="col s12 input-field">
                                    <i class="ion-person small prefix game-main-color"></i>
                                    <textarea  name="alter-register-courrier-objet" class="required materialize-textarea" id="alter-register-courrier-objet-id"></textarea>
                                    <label class="active" for="alter-register-courrier-objet-id">Objet</label>
                                  </div>

                                    <button type="submit" class="btn submit-button left" id="alter-courrier-submit">Enregistrer</button>
                                    <button type="reset" class="btn submit-button right"id="alter-courrier-cancel" >Annuler</button>

                                    <input type="hidden" value="25" name="admin-control"> 
                                    <input type="hidden" name="id-alter-register-courrier" id="id-alter-register-courrier-id">
                                    <input type="hidden" name="id-alter-scan-courrier" id="id-alter-scan-courrier-id">
                                    <input type="hidden" name="id-state-treatment" id="id-state-treatment-id">

                                 <div class="loaderAjax acc-medium-top-margin">
                                <img src="../AjaxLoader/loading2.gif" />
                               </div>


                            </form>
                        </div>
                    </div>  
                </div>


<!--                 <div class="container">
                    <div class="col s12 info-input-file" id="member-explanation">
                   <p class="left-align bold">
                      <i class="ion-asterisk game-main-color bold"></i>
                      Il existe un code de couleur permettant de mieux interpreter l'état detraitement du courrier : 
                      <br>
                        Blanc : Courrier Enregistrés au service courrier. <br>
                        Rouge : Courrier en cours de traitement ayant dépassés le delai de traitement. <br>
                        Vert :  Courrier en cours de traitement en avance sur le delai de traitement.  <br>
                        Orange : Courrier en cours de traitement dont le délai de traitement expire aujourd'hui. 
                  </div>

                </div> -->

  <!--Confirm Delete Courrier Modal Box Structure -->
  <div id="confirmDeleteCourrier" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
            <h6 class="accc-color modal-text bold">Etes-vous sûre de vouloir supprimer le courrier portant le numéro de suivi
            <span id="courrier-deleted-suivi"></span> complètement du fichier d'administration ? Celà aura pour éffet irreversible de supprimer les pieces jointes associées.
            </h6>
                  <input type="hidden" id="courrier-deleted-id">
                  <input type="hidden" id="courrier-join-piece">
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="delete-courrier-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>
<script src="../js/manage-admin.js"></script>
<!-- <script src="../js/datePicker/legacy.js"></script> -->
<script src="../js/filterCourrier.js"></script>