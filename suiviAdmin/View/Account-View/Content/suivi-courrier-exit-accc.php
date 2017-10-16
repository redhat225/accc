<?php $ManageAdmin->courrierAdminInfoAccc(); ?>
              <div class="row center game-row-padding">
                <div class="container">
                    <h4 class="accc-color bold">Courriers Départs Internes</h4>
                </div>
              </div> 

              <div class="row center basic-action-courrier">
                       <p class="accc-wrapper-button adding-filter-depart-internal">
                         <i class="ion-plus-round white-text small adding-Member-trigger"></i>
                         <i class="ion-funnel white-text small adding-Member-trigger"></i> 
                      </p>

                       <p class="accc-wrapper-button adding-courrier-depart-internal">
                         <i class="ion-plus-round white-text small adding-Member-trigger"></i>
                         <i class="ion-android-mail white-text small adding-Member-trigger"></i> 
                      </p>
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
                                      <option value="dest-search">Par destinataire</option>
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

               <div class="row center hidden" id="form-new-courrier-depart-accc-wrapper">
                  <div class="container">
                    
                        <form id="new-courrier-depart-accc-registering" class="admin-form dash-form">
                          <h5 class="accc-color bold game-bottom-small-padding">Veuillez entrer les informations pour enregistrer le courrier départ interne</h5>

                          <div class="col s12">
                                  <div class="col s6 input-field">
                                    <i class="ion-android-list small prefix game-main-color"></i>
                                    <textarea  name="register-courrier-reference" class="required materialize-textarea" id="register-courrier-reference-id"></textarea>
                                   <label class="" for="register-courrier-reference-id">Référence Courrier</label>
                                </div>
                                <div class="col s6 input-field">
                                     <i class="ion-chatbox-working small prefix game-main-color"></i>
                                    <textarea  name="register-courrier-objet" class="required materialize-textarea" id="register-courrier-objet-id"></textarea>
                                     <label class="" for="register-courrier-objet-id">Objet</label>
                                </div>

                          </div>

                          <div class="col s12">
                              <div class="col s6 input-field">
                                  <i class="ion-code-working small prefix game-main-color"></i>
                                  <textarea  name="register-courrier-suffixe" class="required materialize-textarea" id="register-courrier-suffixe-id">/MPMEF/DGTCP/ACCC/SC</textarea>
                                  <label class="active" for="register-courrier-suffixe-id">Suffixe numéro suivi</label>
                              </div>
                              <div class="col s6 input-field">
                                <i class="ion-person small prefix game-main-color"></i>
                                <textarea  name="register-courrier-expediteur" class="required materialize-textarea" id="register-courrier-expediteur-id"></textarea>
                                <label class="" for="register-courrier-expediteur-id">Expediteur</label>
                              </div>

                          </div>

                          <div class="col s12">
                             <div class="col s6 input-field">
                                  <i class="ion-person small prefix game-main-color"></i>
                                 <textarea  name="register-courrier-destinataire" class="required materialize-textarea" id="register-courrier-destinataire-id"></textarea>
                                 <label class="" for="register-courrier-destinataire-id">Destinataire</label>
                             </div>
                             <div class="col s6 input-field">
                                  <i class="ion-person small prefix game-main-color"></i>
                                  <input type="email"  name="register-courrier-mail" class="materialize-textarea" id="register-courrier-mail-id" />
                                  <label class="active" for="register-courrier-mail-id">E-mail Destinataire (optionnel)</label>
                            </div>
                          </div>

                          <div class="col s12">
                              <div class="col s6 input-field">
                                <label>Choisissez le niveau d'urgence</label><br>
                                 <select class="browser-default" name="register-courrier-urgence" id="register-courrier-urgence-id">
                                  <option value="1" selected>normal</option>
                                  <option value="2">urgent</option>
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


                          <input type="hidden" value="39" name="admin-control">
                      

                           <div class="loaderAjax acc-medium-top-margin">
                             <img src="../AjaxLoader/loading2.gif" />
                           </div>
                      </form>
                    
                  </div>
                </div>


        <div class="row" id="gamer-info-table">

                      <table class="MyTable bordered bold centered" id="archives-table">
                          <thead class="orange white-text">
                              <tr>
                                  <th data-field="id">id</th>
                                  <th data-field="id">Numero suivi</th>
                                  <th data-field="id">Reference</th>
                                  <th data-field="id">Expediteur</th>
                                  <th data-field="id">Destinataire</th>
                                  <th data-field="id">E-mail Destinataire</th>
                                  <th data-field="id">Objet</th>
                                  <th data-field="id">Consulter courrier arrivé</th>
                                  <th data-field="id">Date arrivé</th>
                                  <th data-field="id">Delai restant</th>
                                  <th data-field="id">Action</th>      
                              </tr>
                          </thead>
                          <tbody>
                           <?php foreach ($_SESSION['courrierAdminInfoAccc'] as $key => $value): ?>
                              <?php foreach  ($value as $ind=>$val): ?>
                                 <?php 
                                  switch ($val->urgence) {
                                            case 1:
                                                  if(($val->dayRest<0) || ($val->dayRest==0))
                                                    $backStripe="accc-light-stripe-orange black-text";
                                                  if($val->dayRest>0)
                                                    $backStripe="accc-grey-treat-stripe white-text";
                                                    $state="normal";
                                              break;

                                            case 2:
                                                if(($val->dayRest<0) || ($val->dayRest==0))
                                                    $backStripe="accc-alert-stripe white-text";
                                                  if($val->dayRest>0)
                                                    $backStripe="accc-grey-treat-stripe white-text";                                         
                                                $state="urgent";
                                              break;
                                          }
                                  ?>    

                                  <tr class="<?php echo $backStripe; ?> <?php echo $state; ?> <?php echo $val->id; ?> <?php echo $val->id."".$val->numSuivi; ?> <?php echo $val->reference; ?> <?php echo $val->destinataire; ?>  <?php echo $val->expediteur; ?>  <?php echo $val->objet; ?>  <?php echo substr($val->dateEnr,0,10); ?>">
                                      <td><?php echo $val->id; ?></td>
                                      <td><?php echo $val->numSuivi; ?></td>
                                      <td><?php echo $val->reference; ?></td>
                                      <td><?php echo $val->expediteur; ?></td>
                                      <td><?php echo $val->destinataire; ?></td>
                                      <td><?php echo $val->mailDest; ?></td>
                                      <td><?php echo $val->objet; ?></td>
                                      <td class="center"><a href="../simple_flex/index.php?pathPdf=<?php echo $val->pieceDepart; ?>" class="path-down-courrier" id="<?php echo $val->pieceDepart; ?>" target="_blank"><i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece" ></i></a></td>
                                      <td><?php echo $val->dateEnr; ?></td>
                                      <td>
                                        <?php
                                          $delay=$val->dayRest;
                                          if($delay>0)
                                            echo "En retard de ".$delay." jour(s)";
                                          else if($delay<0)
                                            echo "En avance de ".($delay*-1)." jour(s)";
                                          else
                                            echo "Expire Aujourd'hui";
                                        ?>    
                                      </td>
                                      <td>
                                      <?php if(($_SESSION['adminInfo']->idService==1)) :?>
                                      <i class="ion-edit white-text small btn waves-effect trash-button change-info-courrier-depart-accc-trigger"></i>
                                        <?php if(($_SESSION['adminInfo']->idService==1) && ($_SESSION['adminInfo']->poste=="responsable")) :?>
                                        <i class="ion-ios-trash white-text small btn waves-effect trash-button trash-courrier-depart-accc-trigger"></i>
                                         <?php endif; ?>
                                      <?php endif; ?>
                                      <img src="../AjaxLoader/715.gif" class="push-read-loader"/><img src="../AjaxLoader/727.gif" class="loader-trash"/>
                                      </td>
                                  </tr>
                                   <?php endforeach; ?>
                              <?php endforeach; ?>
                          </tbody>               
                            <tfoot>

                            </tfoot>
                      </table>
              </div> 


  <div id="confModInternal" class="modal white center-align">
        <div class="modal-content">
                             <p class="logo-wrapper-circle-account">
           						   <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        					  </p>
                            <form id="alter-register-courrier-depart-accc-form" class="dash-form">
                          <h5 class="accc-color bold game-bottom-small-padding">Veuillez entrer les informations pour modifier le courrier interne départ <span id="alter-depart-internal"></span></h5>

	                                  <div class="col s12 input-field">
	                                    <i class="ion-person small prefix game-main-color"></i>
	                                    <textarea  name="alter-register-courrier-suivi" class="required materialize-textarea" id="alter-register-courrier-suivi-id"></textarea>
	                                    <label class="active" for="alter-register-courrier-suivi-id">Suffixe numero suivi</label>
	                                  </div>

	                                  <div class="col s12 input-field">
	                                    <i class="ion-person small prefix game-main-color"></i>
	                                    <textarea  name="alter-register-courrier-objet" class="required materialize-textarea" id="alter-register-courrier-objet-id"></textarea>
	                                    <label class="active" for="alter-register-courrier-objet-id">Objet</label>
	                                  </div>

			                         <div class="col s12 input-field">
			                            <i class="ion-person small prefix game-main-color"></i>
			                            <textarea  name="alter-register-courrier-reference" class="required materialize-textarea" id="alter-register-courrier-reference-id"></textarea>
			                            <label class="active" for="register-courrier-reference-id">Référence Courrier</label>
			                          </div>

			                          <div class="col s12 input-field">
			                            <i class="ion-person small prefix game-main-color"></i>
			                            <textarea  name="alter-register-courrier-expediteur" class="required materialize-textarea" id="alter-register-courrier-expediteur-id"></textarea>
			                            <label class="active" for="register-courrier-expediteur-id">Expediteur</label>
			                          </div>

			                          <div class="col s12 input-field">
			                            <label>Choisissez le niveau d'urgence</label><br>
			                              <select class="browser-default" name="alter-register-courrier-urgence" id="alter-register-courrier-urgence-id">
			                                  <option value="1" selected>normal</option>
			                                  <option value="2">urgent</option>
			                              </select>
			                          </div>

			                          <div class="col s12 input-field">
			                            <i class="ion-person small prefix game-main-color"></i>
			                            <textarea  name="alter-register-courrier-destinataire" class="required materialize-textarea" id="alter-register-courrier-destinataire-id"></textarea>
			                            <label class="active" for="register-courrier-destinataire-id">Destinataire</label>
			                          </div>
			                          <div class="col s12 input-field">
			                            <i class="ion-person small prefix game-main-color"></i>
			                            <input type="email"  name="alter-register-courrier-mail" class="materialize-textarea" id="alter-register-courrier-mail-id" />
			                            <label class="active" for="register-courrier-mail-id">E-mail Destinataire (Optionnel)</label>
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

                                    <input type="hidden" value="40" name="admin-control"> 
                                    <input type="hidden" name="id-alter-register-courrier-depart-accc" id="id-alter-register-courrier-depart-accc-id">
                                    <input type="hidden" name="id-alter-register-courrier-depart-accc-suivi" id="id-alter-register-courrier-depart-accc-suivi-id">
                            </form>
                            </div>
                         </div>

  <!--Confirm Delete Courrier Modal Box Structure -->
  <div id="confirmDeleteCourrier-depart-Accc" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
            <h6 class="accc-color modal-text bold">Etes-vous sûre de vouloir supprimer le courrier portant le numéro de suivi
            <span id="courrier-deleted-id-depart"></span><span id="courrier-deleted-suivi-depart-accc"></span> complètement du fichier d'administration ? Celà aura pour éffet irreversible de supprimer les pieces jointes asociées.
            </h6>
                  <input type="hidden" id="courrier-deleted-id-depart-accc">
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="delete-courrier-depart-accc-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>
<script src="../js/manage-admin.js"></script>
<script src="../js/filterCourrier.js"></script>
 