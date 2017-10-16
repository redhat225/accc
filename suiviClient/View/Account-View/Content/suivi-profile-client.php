
  					<div class="row center" id="client-info-suivi">
  						<div class="col s12">
  							<div class="container">
  								 <i class="ion-android-person accc-color accc-huge-icon"></i>
	  							<h4 class="bold accc-color zero-margin">Changez Vos informations de profil</h4>    
  								<div class="container">
			  							<form id="suivi-client-profile" class="game-row-padding dash-form acc-big-top-margin">
			  									<i class="ion-card accc-color accc-huge-icon"></i>
  												<h5 class="accc-color bold game-bottom-small-padding">Informations Personnelles</h5>

											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<input type="text" name="client-suivi-name" class="" id="client-name" value="<?php echo $_SESSION['clientInfo']->nom; ?> "disabled>
				  									<label class="active" for="client-name">Nom</label>
				  								</div>

											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<input type="text" name="client-suivi-login" class="required" id="client-login" value="<?php echo $_SESSION['clientInfo']->login; ?>">
				  									<label class="active" for="client-login">Login</label>
				  								</div>
				  								<div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<input type="text" name="client-suivi-state" class="" id="client-state" value="<?php echo $_SESSION['clientInfo']->raisonSocial; ?> "disabled>
				  									<label class="active" for="client-state">Raison Sociale</label>
				  								</div>
				  								<div class="col s12 input-field">
				  									<i class="ion-android-mail small prefix game-main-color"></i>
				  									<input type="email" name="client-suivi-mail" class="required" id="client-mail" value="<?php echo $_SESSION['clientInfo']->mail; ?>">
				  									<label class="active" for="client-mail">e-mail</label>
				  								</div>
				  								<div class="col s12 input-field">
				  									<i class="ion-ios-telephone small prefix game-main-color"></i>
				  									<input type="tel" class="required" name="client-suivi-phone"  id="client-phone" value="<?php echo $_SESSION['clientInfo']->telephone; ?>">
				  									<label class="active" for="client-phone">Nouveau Contact</label>
				  								</div>
				  								<div class="col s12 input-field">
				  									<i class="ion-android-lock small prefix game-main-color"></i>
				  									<input type="password" class="required" name="client-suivi-conf-password" id="client-password" maxlength="25">
				  									<label for="client-password">Mot de passe de confirmation</label>
				  								</div>

				  								<button type="submit" class="btn submit-button left" id="submit-profile">Changer</button>
				  								<button class="btn submit-button right">Annuler</button>

						       					 	<input type="hidden" value="1" name="client-control">
						       				 <div class="loaderAjax acc-medium-top-margin">
				    							<img src="AjaxLoader/loading2.gif" />
				   							 </div>
			  							    </form>
			  			</div>
			  					<div class="container">
			  							<form id="suivi-client-password"class="game-row-padding dash-form acc-big-top-margin">
			  								<i class="ion-android-lock accc-huge-icon accc-color acc-big-top-margin"></i>
			  								<h5 class="accc-color">Changez votre mot de passe</h5>
			  									<div class="col s12 input-field">
				  									<i class="ion-android-lock small prefix game-main-color"></i>
				  									<input type="password" class="required" name="client-suivi-conf-password" id="client-password-2" maxlength="25">
				  									<label for="client-password-2">Mot de passe de confirmation</label>
				  								</div>
				  								<div class="col s12 input-field">
				  									<i class="ion-android-lock small prefix game-main-color"></i>
				  									<input type="password" class="required" name="client-suivi-new-Password" id="client-newPass" maxlength="25">
				  									<label for="client-newPass">Nouveau mot de passe</label>
				  								</div>
				  								<button type="submit" class="btn submit-button center" id="submit-changePass-client">Changer</button>
				  								
				  								<input type="hidden" value="2" name="client-control">
				  							 <div class="loaderAjax acc-medium-top-margin" id="">
				    							<img src="AjaxLoader/loading2.gif" />
				   							 </div>
			  							</form>
			  							
			  							<div class="col s12 info-input-file">
			  								<p class="left-align bold">
			  									<i class="ion-asterisk game-main-color bold"></i>
			  									le mail doit être de la forme : <span class="game-main-color">monAddresse@provider.domaine (accCourrier@hotmail.fr)</span> 
			  								</p>
			  								<p class="left-align bold">
			  									<i class="ion-asterisk game-main-color"></i>
			  									Veuillez entrer un mot de passe contenant des lettres majuscules, des nombres pour le rendre plus sécurisé.<span class="game-main-color">ex : GamerC2015_Player</span> 
			  								</p>
			  								<p class="left-align bold">
			  									<i class="ion-asterisk game-main-color"></i>
			  									Le contact fourni doit être un numéro mobile ou fixe correspondant à l'un des différents opérateurs du secteur.
			  								</p>
			  								<p class="left-align bold">
			  									<i class="ion-ios-contact game-main-color"></i>
			  									Le login fourni doit être moins devinable en ajoutant des lettres majuscules et des nombres.
			  								</p>
			  							</div>
  								</div>
  							</div>
  						</div>
  					</div>
<script src="js/manage-client.js"></script>