<?php $ManageAdmin->archivesInfo(); ?>
<?php $ManageAdmin->courrierAdminInfo(); ?>
<?php $ManageAdmin->clientInfo(); ?>
<?php $ManageAdmin->distinctExpeditor(); ?>
      <div class="row center game-row-padding zero-margin" class="general-info">
            
              <p class="generalStats zero-margin">
                    <i class="ion-email accc-huge-icon accc-color"></i>
                    <i class="ion-arrow-up-c large accc-color"></i>
              <h4 class="accc-color zero-margin">Courriers Départs</h4>
              <h6 class="bold">Gestion des courriers départs de l'ACCC</h6>  
            </p>

                        <div class="row center">
<!--                 <span class="accc-color bold adding-element-courrier-trigger" id="adding-new-filter-archive-trigger"><i class="ion-funnel accc-color medium adding-Member-trigger"></i>Filtrages</span>  -->
                <span class="accc-color bold adding-element-courrier-trigger" id="adding-new-exit-courrier-trigger"><i class="ion-android-mail accc-color medium adding-Member-trigger"></i>Enregistrer courrier départ accc</span>        
            </div> 
<!-- 
                <div class="row center hidden" id="filtrage-archive-courrier-wrapper">
                    <div class="container">
                          <div class="col s6">
                            <h5 class="accc-color">Filtrage</h5>
                            <i class="ion-ios-settings-strong accc-color large"></i>
                            <div class="col s12 input-field">
                                <label>Choisissez le filtrage</label><br>
                                <select class="browser-default" name="" id="filter-select-archive-courrier">
                                  <option value=""selected>Tout</option>
                                  <option value="3">Traités à l'avance</option>
                                  <option value="4">Traités en retard</option>
                                </select>
                            </div>
                           <div class="col s12 input-field">
                            <h5 class="accc-color">Recherche par Expediteur</h5>
                              <i class="ion-android-walk accc-color medium"></i>
                              <i class="ion-ios-search-strong accc-color large"></i>
                              <select class="browser-default" name="" id="filter-select-expeditor-archive-courrier">
                                <option value=""selected>Tout</option>
                                  <?php foreach ($_SESSION['distinctExpeditor'] as $key => $value): ?>
                                       <option value="<?php echo $value->nom; ?>"><?php echo $value->nom; ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                           </div>
                        <div class="col s6">
                          <h5 class="accc-color">Recherche</h5>
                          <i class="ion-ios-search-strong accc-color large"></i>
                          <div class="col s12  accc-small-row-padding">
                            <form id="search-courrier-byNumSuivi-archive" class="admin-form dash-form">
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
                            <form id="search-courrier-byDate-archive" class="admin-form dash-form">
                              <div class="col s12 input-field">
                                  <i class="ion-calendar prefix"></i>
                                  <input id="date-form" name="date-search-courrier" type="text" class="form-control datepicker required">                              
                                  <label for="date-form">Date enregistrement courrier</label>
                                  <button type="submit" class="btn submit-button center" id="submit-search-courrier-date">Rechercher</button>
                                  <button type="" class="btn submit-button center" id="cancel-search-courrier-date-archive">Reinitialiser</button>
                                  
                                  <div class="loaderAjax acc-medium-top-margin">
                                    <img src="../AjaxLoader/loading2.gif" />
                                  </div>
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div> -->

                <div class="row center hidden" id="sortie-service-courrier-wrapper">
                    <div class="container">
                        <div class="container">
                            <form id="sortie-courrier-form" class="dash-form">
                                    <i class="ion-android-mail accc-color medium"></i>
                                    <h5 class="accc-color bold game-bottom-small-padding">Veuillez entrer les informations de courrier départ accc</h5>

                                  <div class="file-field input-field">
                                      <div class="btn center avatar-input-button">
                                        <i class="ion-email large file-input-label"></i>
                                        <input type="file" name="avatar" accept="pdf" class="required" id="courrier-scan-input">
                                      </div>
                                      <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="scan courrier"id="file-path-courrier">
                                      </div>
                                   </div>

                                   <div class="col s12 input-field">
                                        <label>Choisissez le numéro de suivi</label><br>
                                        <select class="browser-default" name="sortie-courrier-suivi" id="sortie-courrier-suivi-id">
                                         <option value="" selected>Choisissez un numero de suivi</option>
                                             <?php foreach ($_SESSION['courrierAdminInfo'] as $key => $value): ?>
                                               <?php foreach  ($value as $ind=>$val): ?>
                                               <option value="<?php echo $val->numSuivi; ?>"><?php echo $val->numSuivi; ?></option>
                                               <?php endforeach; ?>
                                             <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col s12 input-field">
                                      <i class="ion-person small prefix game-main-color"></i>
                                      <textarea  name="sortie-courrier-obs" class="required materialize-textarea" id="sortie-courrier-obs-id"></textarea>
                                      <label class="" for="sortie-courrier-obs-id">Observation de traitement</label>
                                    </div>

                                    <button type="submit" class="btn submit-button left" id="sortie-courrier-submit">Enregistrer</button>
                                    <button type="reset" class="btn submit-button right"id="sortie-courrier-cancel" >Annuler</button>

                                    <input type="hidden" value="24" name="admin-control"> 
                                    <input type="hidden" name="id-exit-courrier" id="id-exit-courrier-id">

                                 <div class="loaderAjax acc-medium-top-margin">
                                <img src="../AjaxLoader/loading2.gif" />
                               </div>


                            </form>
                        </div>
                    </div>  
                </div>
            
                <div class="row" id="gamer-info-table">
                   
                        <table class="MyTable striped bordered bold centered responsive-table" id="archives-table">
                            <thead class="black orange-text">
                                <tr>
                                    <th data-field="id">id</th>
                                    <th data-field="id">référence</th>
                                    <th data-field="id">Numero suivi courrier</th>
                                    <th data-field="id">Objet courrier</th>
                                    <th data-field="id">Action</th>
                                    <th data-field="id">Expediteur</th>
                                    <th data-field="id">Date enregistrement</th>
                                    <th data-field="id">Date traitement</th>
                                </tr>
                            </thead>
                            <tbody>
                           <?php foreach ($_SESSION['archiveInfo'] as $key => $value): ?>
                              <?php foreach  ($value as $ind=>$val): ?>
                                <?php 
                                      if($val->nbresJoursTreatment<=15)
                                       $backStripe="accc-green-treat-stripe white-text";
                                      if($val->nbresJoursTreatment>=15)
                                       $backStripe="accc-alert-stripe white-text"; 
                                 ?>

                                  <tr class="<?php echo $backStripe; ?> <?php echo $val->numSuivi; ?> <?php echo $val->filterPickDate; ?> <?php echo $val->nom; ?>">
                                      <td><?php echo $val->idCourrier; ?></td>
                                      <td><?php echo $val->nom; ?></td>
                                      <td><?php echo $val->numSuivi; ?></td>
                                      <td><?php echo $val->objetCourrier; ?></td>
                                      <td><a href="../serverTraitor/download.php?piece=<?php echo $val->pieces; ?>" class="path-down-courrier" id="<?php echo $val->pieces; ?>"><i class="ion-arrow-down-a white-text small btn waves-effect trash-button get-join-piece"></i></a><i class="ion-edit white-text small btn waves-effect trash-button change-info-courrier-sortie-trigger"></i></td>
                                      <td><?php echo $val->recordDate; ?></td>
                                      <td><?php echo $val->treatedDate; ?></td>
                                      <td><?php echo $val->Obs; ?></td>                                                                                                                                                                                             
                                  </tr>
                                   <?php endforeach; ?>
                              <?php endforeach; ?>
                            </tbody>               
                        </table>
                    
                </div>


                <div class="row center hidden" id="alter-register-courrier-sortie-wrapper">
                    <div class="container">
                        <div class="container">
                            <form id="alter-register-courrier-sortie-form" class="dash-form">
                                    <i class="ion-email accc-color medium"></i>
                                    <i class="ion-edit accc-color large"></i>
                                    <h5 class="accc-color bold game-bottom-small-padding">Veuillez apporter vos modifications sur le courrier départ client</h5>

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
                                    <textarea  name="alter-register-courrier-sortie-suivi" class="materialize-textarea" id="alter-register-courrier-sortie-suivi-id" disabled></textarea>
                                    <label class="active" for="alter-register-courrier-sortie-suivi-id">numero de suivi</label>
                                  </div>

                                  <div class="col s12 input-field">
                                    <i class="ion-person small prefix game-main-color"></i>
                                    <textarea  name="alter-register-courrier-sortie-objet" class="materialize-textarea" id="alter-register-courrier-sortie-objet-id" disabled></textarea>
                                    <label class="active" for="alter-register-courrier-sortie-objet-id">Objet</label>
                                  </div>

                                  <div class="col s12 input-field">
                                    <i class="ion-person small prefix game-main-color"></i>
                                    <textarea  name="alter-register-courrier-sortie-obs" class="required materialize-textarea" id="alter-register-courrier-sortie-obs-id"></textarea>
                                    <label class="active" for="alter-register-courrier-sortie-obs-id">Observations</label>
                                  </div>

                                    <button type="submit" class="btn submit-button left" id="alter-courrier-sortie-submit">Enregistrer</button>
                                    <button type="reset" class="btn submit-button right"id="alter-courrier-sortie-cancel" >Annuler</button>

                                    <input type="hidden" value="38" name="admin-control"> 
                                    <input type="hidden" name="id-alter-sortie-courrier-suivi" id="id-alter-sortie-courrier-suivi-id">
                                    <input type="hidden" name="id-alter-sortie-courrier" id="id-alter-sortie-courrier-id">

                                 <div class="loaderAjax acc-medium-top-margin">
                                <img src="../AjaxLoader/loading2.gif" />
                               </div>


                            </form>
                        </div>
                    </div>  
                </div>

<!--         <div class="container">
             <div class="col s12 info-input-file" id="member-explanation">
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
        </div> -->


         </div>

<script src="../js/manage-admin.js"></script>
<script src="../js/filterCourrier.js"></script>