<?php $ManageAdmin->TaskInfo(); ?>
<?php $ManageAdmin->memberAdminInfo(); ?>
<?php $ManageAdmin->courrierAdminInfo(); ?>

	       <div class="row center game-row-padding zero-margin" class="general-info">
	       		
	       			<p class="generalStats zero-margin">
	  					<i class="ion-ios-compose accc-huge-icon accc-color"></i>
	  					<h4 class="accc-color zero-margin">Gestion des Tâches Courriers</h4>
	  					<h6 class="bold">Consultez,Créez, Modifiez et supprimez des tâches d'éxecution relatives au traitement des courriers</h6>	
	  					<a href="#member-explanation" class="btn submit-button">En savoir plus</a>	
	  				</p>
	       		
	              <div class="row" id="gamer-info-table">
	                 
	                    <table class="MyTable striped bordered bold centered" id="task-table">
	                          <thead class="accc-back-color white-text">
	                              <tr>
	                                  <th data-field="id">Identifiant Tâche</th>
	                                  <th data-field="id">Numéro Suivi Courrier</th>
	                                  <th data-field="id">Initiateur</th>
	                                  <th data-field="id">Descriptif</th>
	                                  <th data-field="id">niveau urgence de traitement</th>
	                                  <th data-field="id">Delai restant de traitement courrier</th>
	                                  <th data-field="id">Date d'édition</th>
	                                  <th data-field="id">Status d'execution</th>
	                                  <th data-field="id">Action</th>
	                              </tr>
	                          </thead>
	                          <tbody>
	                            <?php foreach ($_SESSION['TaskInfo'] as $key => $value):?>
	                            	<?php if(($value->idInitiateur==$_SESSION['adminInfo']->id) || ($value->idExecuteur==$_SESSION['adminInfo']->id) ) :?>
		                              <tr>
		                                  <td><?php echo $value->idTache; ?></td>
		                                  <td><?php echo $value->numSuiviCourrier; ?></td>
		                                  <td>
		                                  		<?php if($value->idInitiateur==$_SESSION['adminInfo']->id): ?>
		                                  			<?php echo "Moi"; ?>
		                                  		<?php else: ?>
		                                  			<?php echo $value->nom." ".$value->prenom;?>
		                                  		<?php endif; ?>
		                                  </td>
		                                  <td><?php echo $value->descTache; ?></td>
		                                  <td><?php 
			                                  switch($value->niveauUrgence)
			                                      {
			                                          case 1: 
			                                          		echo "Normal";
			                                          break;

			                                          case 2:
			                                          		echo "Moyen";
			                                          break;

			                                          case 3: 
			                                          		echo "Urgent";
			                                          break;

			                                          case 4:
			                                          		echo "Critique";
			                                          break;
			                                      }
			                                   ?></td>
										  <td>
											<?php 
			                                  if($value->today===0)
			                                  	echo "Expire Aujourd'hui";
			                                  if($value->today>0)
			                                  	echo "En retard de ".$value->today." jour(s)";
			                                  if($value->today<0)
			                                  	echo $value->today." jours";
			                                ?> 
										  </td>
										  <td>
										  		<?php echo $value->dateDefinition; ?>
										  </td>
										  <td>
										   <?php 
			                                  switch($value->executionState)
			                                      {
			                                          case 0 : 
			                                        	  echo "En attente d'execution";
			                                          break;

			                                          case 1:
			                                       		  echo "Executé";
			                                          break;
			                                      }
			                                   ?> 
										  </td>
		                                  <td class="member-action-listener">
		                                  	<?php if ($value->idInitiateur==$_SESSION['adminInfo']->id) :?> 
		                                  	 <i class="ion-ios-trash white-text small btn waves-effect trash-button trash-task"></i>
		                                  	 <i class="ion-edit white-text small btn waves-effect trash-button edit-task"></i> 
		                                  	<?php endif; ?>

											<?php if ($value->idExecuteur==$_SESSION['adminInfo']->id) :?>
											  <?php 
			                                  switch($value->executionState)
			                                      {
			                                          case 0 : 
			                                        	  echo "<i class='ion-android-checkbox-outline-blank white-text trash-button small btn waves-effect done-task-trigger'></i>";
			                                          break;

			                                          case 1:
			                                       		  echo "<i class='ion-android-checkbox-outline white-text small trash-button btn waves-effect undone-task-trigger'></i>";
			                                          break;
			                                      }
			                                   ?>

			                                  <?php 
			                                  switch($value->seenTache)
			                                      {
			                                          case 0 : 
			                                        	  echo "<i class='ion-eye-disabled white-text trash-button small btn waves-effect seen-task-trigger'></i>";
			                                          break;

			                                          case 1:
			                                       		  echo "<i class='ion-eye white-text small trash-button btn waves-effect unseen-task-trigger'></i>";
			                                          break;
			                                      }
			                                   ?>
											<?php endif; ?>

			                                  <img src="../ajaxLoader/727.gif" class="loader-trash"/> 
			                                  <img src="../ajaxLoader/715.gif" class="push-read-loader"/> 
		                                  </td>
		                                </tr>
		                              <?php endif; ?>  
	                             <?php endforeach; ?>
	                          </tbody>               
	                      </table>
	              </div>

	              <p class="adding-Member-wrapper">
	              		<i class="ion-plus-round accc-color small adding-Task-trigger pointer"></i>
	              		<i class="ion-ios-compose accc-color medium adding-Task-trigger pointer"></i>
	  	   				<span class="accc-color bold adding-Task-trigger pointer">Ajouter une nouvelle tâche</span> 
	              </p>

	              <div class="container">
	              		<div class="container">
	              				  <form id="new-task-registering" class="accc-row-padding admin-form dash-form hidden">
			  						    <i class="ion-ios-compose accc-color accc-huge-icon"></i>
  												<h5 class="accc-color bold game-bottom-small-padding">Informations Personnelles</h5>

											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<textarea  name="suivi-task-register-desc" class="required materialize-textarea" id="suivi-task-register-desc-id"></textarea>
				  									<label class="" for="suivi-task-register-desc-id">Descriptif</label>
				  								</div>

				  								<div class="col s12 input-field">
													  <label>Choisissez le numero de suivi</label><br>
														  <select class="browser-default required" name="numSuivi-courrier-task" id="numSuivi-courrier-task-id">
															    <option value="">numéro de suivi</option>
																<?php foreach ($_SESSION['courrierAdminInfo'] as $key => $value):?>
																    <?php foreach  ($value as $ind=>$val): ?>
																    	<option value="<?php echo $val->numSuivi; ?>"><?php echo $val->numSuivi; ?></option>
																	<?php endforeach; ?>
																<?php endforeach; ?>
														  </select>
												</div>

												<div class="col s12 input-field">
													  <label>Choisissez le niveau d'urgence</label><br>
														  <select class="browser-default required" name="suivi-task-register-level" id="suivi-task-register-level">
															    <option value="">Choisissez le niveau d'urgence d'exécution de la tache</option>
															    <option value="1">Normal</option>
															   	<option value="2">Moyen</option>
															    <option value="3">Urgent</option>
															    <option value="4">Critique</option>
														  </select>
												</div>

												<div class="col s12 input-field">
													  <label>Responsable d'exécution</label><br>
														  <select class="browser-default required" name="suivi-task-executor" id="suivi-task-executor-id">
															    <option value="">Choisissez le responsable d'execution</option>
															    <?php foreach ($_SESSION['memberAdminInfo'] as $key => $value):?>
															    <?php if($value->id!==$_SESSION['adminInfo']->id) :?>
															    <option value="<?php echo $value->id; ?>"><?php echo $value->nom." ".$value->prenom; ?></option>
 																<?php endif; ?>
 																<?php endforeach; ?>	
														  </select>
												</div>

				  								<button type="submit" class="btn submit-button left" id="register-new-task-trigger">Créer</button>
				  								<button type="reset" class="btn submit-button right" id="cancel-new-task-trigger">Annuler</button>

						       					<input type="hidden" value="13" name="admin-control">
			  									

					       						 <div class="loaderAjax acc-medium-top-margin">
					    							<img src="../AjaxLoader/loading2.gif" />
					   							 </div>
			  							</form>
	              		</div>
	              </div>


	              <div class="container">
	              		<div class="container">
	              				<form id="alter-task-registering" class="accc-row-padding admin-form dash-form hidden">
			  						    <i class="ion-ios-loop-strong accc-color accc-huge-icon"></i>
  												<h5 class="accc-color bold game-bottom-small-padding">Modification Tache</h5>

											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<textarea  name="suivi-task-alter-desc" class="required materialize-textarea" id="suivi-task-alter-desc-id"></textarea>
				  									<label class="active" for="suivi-task-alter-desc-id">Descriptif</label>
				  								</div>

											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<textarea  name="suivi-task-alter-numSuivi" class="required materialize-textarea" id="suivi-task-alter-numSuivi-id" disabled></textarea>
				  									<label class="active" for="suivi-task-alter-numSuivi-id">Numéro de suivi</label>
				  								</div>

												<div class="col s12 input-field">
													  <label>Choisissez le niveau d'urgence</label><br>
														  <select class="browser-default required" name="suivi-task-alter-register-level" id="suivi-task-alter-register-level-id">
															    <option value="">Choisissez le niveau d'urgence d'exécution de la tache</option>
															    <option value="1">Normal</option>
															   	<option value="2">Moyen</option>
															    <option value="3">Urgent</option>
															    <option value="4">Critique</option>
														  </select>
												</div>

												<div class="col s12 input-field">
													  <label>Responsable d'exécution</label><br>
														  <select class="browser-default required" name="suivi-task-executor" id="suivi-task-executor-id">
															    <option value="">Choisissez le responsable d'execution</option>
															    <?php foreach ($_SESSION['memberAdminInfo'] as $key => $value):?>
															    <?php if($value->id!==$_SESSION['adminInfo']->id) :?>
															    <option value="<?php echo $value->id; ?>"><?php echo $value->nom." ".$value->prenom; ?></option>
 																<?php endif; ?>
 																<?php endforeach; ?>	
														  </select>
												</div>

				  								<button type="submit" class="btn submit-button left" id="alter-task-submit-trigger">Changer</button>
				  								<button type="reset" class="btn submit-button right" id="cancel-alter-task-trigger">Annuler</button>

						       					<input type="hidden" value="14" name="admin-control">
			  									<input type="hidden" value="" name="alter-task-id-content" id="alter-task-id">

					       						 <div class="loaderAjax acc-medium-top-margin">
					    							<img src="../AjaxLoader/loading2.gif" />
					   							 </div>
			  							</form>
	              		</div>
	              </div>
	           
	           		<div class="container">
	           			<div class="container">
	           				<form id="done-task-form" class="dash-form hidden">
	           					<i class="ion-android-checkbox-outline accc-color accc-huge-icon"></i>
  									<h5 class="accc-color bold game-bottom-small-padding">Attestation d'execution de tâche</h5>

  								<div class="col s12 input-field">
				  					<i class="ion-person small prefix game-main-color"></i>
				  					<textarea  name="suivi-task-done-suivi" class="required materialize-textarea" id="suivi-task-done-suivi-id" disabled></textarea>
				  					<label class="active" for="suivi-task-done-suivi-id">Numero de suivi</label>
				  				</div>

								<div class="col s12 input-field">
				  					<i class="ion-person small prefix game-main-color"></i>
				  					<textarea  name="suivi-task-done-desc" class="required materialize-textarea" id="suivi-task-done-desc-id"></textarea>
				  					<label class="active" for="suivi-task-done-desc-id">Compte Rendu</label>
				  				</div>

	           					<div class="col s12 input-field">
				  					<i class="ion-android-lock small prefix game-main-color"></i>
				  					<input type="password" class="required" name="done-task-conf-pass" id="done-task-conf-pass-id" maxlength="25">
				  					<label for="done-task-conf-pass-id">Mot de passe de confirmation Administrateur</label>
				  				</div>

				  				<button type="submit" class="btn submit-button left" id="done-task-submit-trigger">Changer</button>
				  				<button type="reset" class="btn submit-button right" id="cancel-done-task-trigger">Annuler</button>

						       	<input type="hidden" value="15" name="admin-control">
			  					<input type="hidden" value="" name="task-done-id-content" id="task-done-id">

					       		<div class="loaderAjax acc-medium-top-margin">
					    			<img src="../AjaxLoader/loading2.gif" />
					   			</div>
	           				</form>
	           			</div>
	           		</div>	

	              <div class="container">
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

	              </div>

	  	   </div>

  <!--Confirm Delete Member Modal Box Structure -->
  <div id="confirmDeleteTask" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
            	<a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        	</p>
            <h6 class="accc-color modal-text bold">Etes-vous sûre de vouloir supprimer la tache 
            portant l'identifiant <span id="task-deleted-id"></span> complètement du fichier d'administration ?
            </h6>
            	  <input type="hidden" id="avatar-deleted-member">
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="delete-task-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>

  <!--Confirm Undone Task Modal Box Structure -->
    <div id="confirmUndoTask" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
            <h6 class="accc-color modal-text bold">Etes-vous sûre de vouloir marqué comme non exécuté la tache <span id="task-done-undone-id"></span> ? celà aura pour effet de supprimer le compte rendu associé.
            </h6>
                <input type="hidden" id="avatar-deleted-member">
                  <input type="password" name="confirm-delete-password" id="conf-cr-task-delete-pass" class="required white-text"/>
                  <label for="conf-member-delete">Mot de passe de confirmation</label>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="undo-task-submit-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>

<script src="../js/manage-admin.js"></script>