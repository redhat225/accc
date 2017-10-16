<?php $ManageAdmin->clientInfo(); ?>
	       <div class="row center game-row-padding zero-margin" class="general-info">
	       		
	       			<p class="generalStats zero-margin">
	  					<i class="ion-android-contact accc-huge-icon accc-color"></i>
	  					<h4 class="accc-color zero-margin">Gestion des clients</h4>
	  					<h6 class="bold">Créez vos clients expéditeurs de courrier</h6>	
	  					<a href="#member-explanation" class="btn submit-button">En savoir plus</a>	
	  				</p>
	       		
	              <div class="row" id="gamer-info-table">
	                 
	                      <table class="MyTable striped bordered bold centered" id="client-table">
	                          <thead class="accc-back-color white-text">
	                              <tr>
	                                  <th data-field="id">Identifiant</th>
	                                  <th data-field="id">Nom</th>
	                                  <th data-field="id">Login</th>
	                                  <th data-field="id">Email</th>
	                                  <th data-field="id">Date Inscription</th>
	                                  <th data-field="id">Raison Sociale</th>
	                                  <th data-field="id">Téléphone</th>
	                                  <th data-field="id">Action</th>
	                              </tr>
	                          </thead>
	                          <tbody>
	                            <?php foreach ($_SESSION['clientInfo'] as $key => $value):?>
		                              <tr>
		                                  <td><?php echo $value->id; ?></td>
		                                  <td><?php echo $value->nom; ?></td>
		                                  <td><?php echo $value->login; ?></td>
		                                  <td><?php echo $value->mail; ?></td>
										  <td><?php echo $value->date_inscription; ?></td>
										  <td><?php echo $value->raisonSocial; ?></td>	
										  <td><?php echo $value->telephone; ?></td>
		                                  <td class="member-action-listener"><i class="ion-ios-trash white-text small btn waves-effect trash-button trash-client"></i> <img src="../ajaxLoader/727.gif" class="loader-trash"/></td>
		                              </tr>
	                             <?php endforeach; ?>
	                          </tbody>               
	                      </table>
	                  
	              </div>
	              <p class="adding-client-wrapper">
	              		
	              		<i class="ion-android-contact accc-color medium adding-Member-trigger"></i>
	  	   				<span class="accc-color bold adding-Member-trigger">Ajouter Un nouveau Client</span> 
	              </p>

	              <div class="container">
	              		<div class="container">
	              				<form id="new-client-registering" class="accc-row-padding admin-form dash-form hidden">
			  						<i class="ion-android-contact accc-color accc-huge-icon"></i>
  												<h5 class="accc-color bold game-bottom-small-padding">Informations Personnelles</h5>

											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<textarea  name="suivi-client-register-name" class="required materialize-textarea" id="suivi-client-reg-name"></textarea>
				  									<label class="" for="suivi-client-reg-name">Nom</label>
				  								</div>

												<div class="col s12 input-field">
													  <label>raison sociale</label><br>
													  <select class="browser-default" name="raison-client-register-selection" id="raison-client-register">
													    <option value=""selected>Choisissez la raison sociale</option>
													    <option value="entreprise">Entreprise</option>
													   	<option value="particulier">Particulier</option>
													  </select>
												</div>

				  								<div class="col s12 input-field">
				  									<i class="ion-android-mail small prefix game-main-color"></i>
				  									<input type="email" name="suivi-client-register-email" class="required" id="suivi-client-reg-email">
				  									<label class="" for="suivi-client-reg-email">e-mail</label>
				  								</div>

				  								<div class="col s12 input-field">
				  									<i class="ion-android-mail small prefix game-main-color"></i>
				  									<input type="text" name="suivi-client-register-login" class="required" id="suivi-client-reg-login">
				  									<label class="" for="suivi-client-reg-login">login</label>
				  								</div>

												<div class="col s12 input-field">
				  									<i class="ion-ios-telephone small prefix game-main-color"></i>
				  									<input type="tel" class="required" name="suivi-client-register-phone"  id="suivi-client-reg-phone">
				  									<label class="" for="suivi-client-reg-phone">Contact</label>
				  								</div>

				  								<button type="submit" class="btn submit-button left" id="register-new-client-submit">Créer</button>
				  								<button type="reset" class="btn submit-button right">Annuler</button>

						       					<input type="hidden" value="6" name="admin-control">
			  							

					       						 <div class="loaderAjax acc-medium-top-margin">
					    							<img src="../AjaxLoader/loading2.gif" />
					   							 </div>
			  							</form>
	              		</div>
	              </div>
	            

	             <div class="container">
	              		<div class="container">
	              				<form id="alter-client-registering" class="accc-row-padding admin-form dash-form hidden">
			  						<i class="ion-android-create accc-color accc-huge-icon"></i>
  												<h5 class="accc-color bold game-bottom-small-padding">Informations Client</h5>

											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<textarea name="suivi-client-register-name" class="required materialize-textarea" id="suivi-alter-client-name-id"></textarea>
				  									<label class="active" for="suivi-alter-client-name-id">Nom</label>
				  								</div>
					  								
											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<textarea name="suivi-client-register-login" class="required materialize-textarea" id="suivi-alter-client-login-id"></textarea>
				  									<label class="active" for="suivi-alter-client-login-id">Login</label>
				  								</div>

				  								<div class="col s12 input-field">
				  									<i class="ion-android-mail small prefix game-main-color"></i>
				  									<input type="email" name="suivi-client-register-email" class="required" id="suivi-alter-client-email-id">
				  									<label class="active" for="suivi-alter-client-email-id">e-mail</label>
				  								</div>

												<div class="col s12 input-field">
													  <label>raison sociale</label><br>
													  <select class="browser-default" name="raison-client-register-selection" id="raison-client-alter-id">
													    <option value="">Choisissez la raison sociale</option>
													    <option value="entreprise">Entreprise</option>
													   	<option value="particulier">Particulier</option>
													  </select>
												</div>

												<div class="col s12 input-field">
				  									<i class="ion-ios-telephone small prefix game-main-color"></i>
				  									<input type="tel" class="required" name="suivi-client-register-phone"  id="suivi-client-alter-phone-id">
				  									<label class="active" for="suivi-client-alter-phone-id">Contact</label>
				  								</div>
				  								<button type="submit" class="btn submit-button left" id="alter-client-credentials">Changer</button>
				  								<button type="reset" class="btn submit-button right" id="cancel-client-alter">Annuler</button>

						       					<input type="hidden" value="7" name="admin-control">
												<input type="hidden" value=""  name="suivi-alter-client" class="" id="suivi-alter-client-id">

					       						 <div class="loaderAjax acc-medium-top-margin">
					    							<img src="../AjaxLoader/loading2.gif" />
					   							 </div>
			  							</form>
	              		</div>
	              </div>


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

  <!--Confirm Delete Member Modal Box Structure -->
  <div id="confirmDeleteClient" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
            	<a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        	</p>
            <h6 class="accc-color modal-text bold">Etes-vous sûre de vouloir supprimer <span id="member-deleted"></span>
            portant l'identifiant <span id="member-deleted-id"></span> complètement du fichier d'administration ?
            </h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="delete-client-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>

<script src="../js/manage-admin.js"></script>