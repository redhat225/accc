
  					<div class="row center" id="admin-info-suivi">
  						<div class="col s12">
  							<div class="container">   
  								<div class="container">

  									   <form id="admin-avatar-change-form" class="dash-form admin-form" enctype="multipart/form-data">
  									 		<?php if(empty($_SESSION['adminInfo']->avatar)) :?>	
  									 			<i class="ion-ios-contact-outline accc-huge-icon accc-color"></i>
  									 		<?php else : ?>
  									 		  	<p class="avatar-game-gift">
  													<img src="../suiviAdmin/suiviAdmin-img/avatar/<?php echo $_SESSION['adminInfo']->avatar;?>">
  												</p>
  									 		<?php endif; ?>

  									 		<h5 class="accc-color bold">Changez votre avatar</h5>
  									 			<div class="file-field input-field">
												      <div class="btn center avatar-input-button">
												        <i class="ion-ios-contact large file-input-label"></i>
												        <input type="file" name="avatar" accept="image/*" class="required">
												      </div>
												      <div class="file-path-wrapper">
												        <input class="file-path validate" type="text" placeholder="avatar">
												      </div>
											    </div>
											    <button type="submit" class="btn submit-button" id="change-profile-avatar-submit">Changer</button>
  									 			
						       					<input type="hidden" value="1" name="admin-control">

				       						 <div class="loaderAjax acc-medium-top-margin">
				    							<img src="../AjaxLoader/loading2.gif" />
				   							 </div>

  									 	</form>
			  			</div>
			  					<div class="row center">	
			  						<div class="col s6">	
			  							<form id="suivi-admin-profile" class="game-row-padding dash-form acc-big-top-margin">
			  									<i class="ion-card accc-color accc-huge-icon"></i>
  												<h5 class="accc-color bold game-bottom-small-padding">Informations Personnelles</h5>

											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<input type="text" name="admin-suivi-name" class="" id="admin-name" value="<?php echo $_SESSION['adminInfo']->nom; ?> "disabled>
				  									<label class="active" for="admin-name">Nom</label>
				  								</div>
				  								<div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<input type="text" name="admin-suivi-surname" class="" id="admin-name" value="<?php echo $_SESSION['adminInfo']->prenom; ?> "disabled>
				  									<label class="active" for="admin-name">Prenom</label>
				  								</div>

											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<input type="email" name="admin-suivi-login" class="required" id="admin-login" value="<?php echo $_SESSION['adminInfo']->login; ?>" disabled>
				  									<label class="active" for="admin-login">Login</label>
				  								</div>
				  								<div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<input type="text" name="admin-suivi-service" class="" id="admin-service" value="<?php echo $_SESSION['adminInfo']->nomService; ?> " disabled>
				  									<label class="active" for="admin-service">Service</label>
				  								</div>
				  								<div class="col s12 input-field">
				  									<i class="ion-android-mail small prefix game-main-color"></i>
				  									<input type="text" name="admin-suivi-poste" class="" id="admin-poste" value="<?php echo $_SESSION['adminInfo']->poste; ?>" disabled>
				  									<label class="active" for="admin-poste">Poste</label>
				  								</div>
			  							    </form>
			  						</div>

			  						<div class="col s6">	
			  							<form id="suivi-admin-password"class="game-row-padding dash-form acc-big-top-margin">
			  								<i class="ion-android-lock accc-huge-icon accc-color acc-big-top-margin"></i>
			  								<h5 class="accc-color bold">Changez votre mot de passe</h5>
			  									<div class="col s12 input-field">
				  									<i class="ion-android-lock small prefix game-main-color"></i>
				  									<input type="password" class="required" name="admin-suivi-conf-password" id="admin-password-2" maxlength="25">
				  									<label for="admin-password-2">Mot de passe actuel</label>
				  								</div>
				  								<div class="col s12 input-field">
				  									<i class="ion-android-lock small prefix game-main-color"></i>
				  									<input type="password" class="required" name="admin-suivi-new-Password" id="admin-newPass" maxlength="25">
				  									<label for="admin-newPass">Nouveau mot de passe</label>
				  								</div>
				  								<button type="submit" class="btn submit-button center" id="submit-changePass-admin">Changer</button>
				  								
				  								<input type="hidden" value="2" name="admin-control">
				  							 <div class="loaderAjax6 acc-medium-top-margin hidden" id="">
				    							<img src="../AjaxLoader/loading2.gif" />
				   							 </div>
			  							</form>
			  						</div>
			  					</div>

  								
  							</div>
  						</div>
  					</div>
<script src="../js/manage-admin.js"></script>