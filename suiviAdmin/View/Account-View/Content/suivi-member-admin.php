<?php $ManageAdmin->memberAdminInfo(); 
$ManageAdmin->servicesInfo();
$ManageAdmin->superior();
?>
	     <div class="row center game-row-padding zero-margin" class="general-info">
	       		
	       			<p class="generalStats zero-margin">
	  					<i class="ion-ios-people accc-huge-icon accc-color"></i>
	  					<h4 class="accc-color zero-margin">Gestion des membres</h4>
	  					<h6 class="bold">Créez, Modifiez et supprimez des membres administrateurs</h6>	
	  				</p>

	  			<p class="adding-Member-wrapper">
	              		<i class="ion-android-person-add accc-color medium adding-Member-trigger"></i>
	  	   				<span class="accc-color bold adding-Member-trigger">Ajouter Un nouveau Membre</span> 
	            </p>

	          <div class="row center" id="adding-new-member-wrapper">	
	          				<div class="container">	
	              				<form id="new-admin-registering" class="accc-row-padding admin-form dash-form hidden">
  												<h5 class="accc-color bold game-bottom-small-padding">Informations Personnelles</h5>

											    <div class="col s12">
											    	<div class="col s6 input-field">	
				  											<i class="ion-person small prefix game-main-color"></i>
				  											<textarea  name="suivi-member-register-name" class="required materialize-textarea" id="suivi-member-register-name-id"></textarea>
				  											<label class="" for="suivi-member-register-name-id">Nom</label>
											    	</div>


											  		  <div class="col s6 input-field">
				  											<i class="ion-person small prefix game-main-color"></i>
				  											<textarea  name="suivi-member-register-surname" class="required materialize-textarea" id="suivi-member-register-surname-id"></textarea>
				  											<label class="" for="suivi-member-register-surname-id">Prenom</label>
				  										</div>
				  								</div>

											    <div class="col s12">

														<div class="col s6 input-field">
				  											<i class="ion-person small prefix game-main-color"></i>
				  											<textarea  name="suivi-member-register-fonction" class="required materialize-textarea" id="suivi-member-register-fonction-id"></textarea>
				  											<label class="" for="suivi-member-register-fonction-id">Fonction</label>
				  										</div>
				  									
				  									<div class="col s6 input-field">
				  											<i class="ion-android-mail small prefix game-main-color"></i>
				  											<input type="email" name="suivi-member-register-mail" class="required" id="suivi-member-register-mail-id">
				  											<label class="" for="suivi-member-register-mail-id">e-mail(login)</label>
				  									</div>
				  								</div>


				  							<div class="col s12">	
												<div class="col s6 input-field">
													  <label>Choisissez le Niveau</label><br>
													  <select class="browser-default" name="suivi-member-register-service" id="suivi-member-register-service-id">
													   <option value="" selected disabled>Choisissez un niveau</option>
													    <?php foreach ($_SESSION['servicesInfo'] as $key => $value): ?>
													    	<option value="<?php echo $value->idService;?>"><?php echo $value->nomService; ?></option>
														<?php endforeach; ?>
													  </select>
												</div>

												<div class="col s6 input-field">
													  <label>Choisissez le privilège d'accès</label><br>
														  <select class="browser-default required" name="suivi-admin-register-access" id="suivi-admin-register-access-id">
															    <option value="" selected>Choisissez le privilège</option>
															    <option value="responsable">Responsable</option>
															   	<option value="secretaire">Secretaire</option>
															    <option value="agent" class="choice-dept-chefsce hidden">Agent</option>
															    <option value="agent-arrive" class="choice-dept-courrier hidden">Agent-arrivé</option>
															    <option value="agent-depart" class="choice-dept-courrier hidden">Agent-départ</option>
														  </select>
												</div>



				  							</div>	




												<div class="col s12 input-field hidden" id="chief-service-wrapper">
													  <label>Choisissez le supérieur de cet utilisateur</label><br>
														  <select class="browser-default" name="suivi-admin-register-sce-responsible" id="suivi-admin-register-sce-responsible">
															    <option value="" selected>Choisissez un supérieur</option>
															    <?php if ($_SESSION['superior'][0]!==0): ?>
																    <?php 	foreach ($_SESSION['superior'] as $key => $value):?>
														                <option value="<?php echo $value->id;?>" id="<?php 	echo $value->idService; ?>"><?php 	echo $value->nom." ".$value->prenom; ?></option>
																    <?php 	endforeach; ?>
															    <?php endif;?>
														  </select>
												</div>


										<div class="container">	
				  								<button type="submit" class="btn submit-button left" id="register-new-admin-trigger">Créer</button>
				  								<button type="reset" class="btn submit-button right" id="register-new-admin-cancel">Annuler</button>
										</div>


						       					<input type="hidden" value="3" name="admin-control">
			  							

					       						 <div class="loaderAjax acc-medium-top-margin">
					    							<img src="../AjaxLoader/loading2.gif" />
					   							 </div>
			  							</form>
	          				</div>

	          </div>	              				
		              


		              <div class="row center" id="gamer-info-table">
		                 
		                      <table class="MyTable striped bordered bold centered" id="member-table">
		                          <thead class="accc-back-color white-text">
		                              <tr>
		                                  <th data-field="id">Identifiant</th>
		                                  <th data-field="id">Nom</th>
		                                  <th data-field="id">Prenom</th>
		                                  <th data-field="id">Email(login)</th>
		                                  <th data-field="id">Niveau</th>
		                                  <th data-field="id">Privilège</th>
		                                  <th data-field="id">Fonction</th>
		                                  <th data-field="id" class="hidden">IdResponsible</th>
		                                  <th data-field="id" class="hidden">Avatar</th>
		                                  <th data-field="id">Action</th>
		                              </tr>
		                          </thead>
		                          <tbody>
		                             <?php foreach ($_SESSION['memberAdminInfo'] as $key => $value):?>
		                              <tr>
		                                  <td><?php echo $value->id; ?></td>
		                                  <td><?php echo $value->nom; ?></td>
		                                  <td><?php echo $value->prenom; ?></td>
		                                  <td><?php echo $value->login; ?></td>
		                                  <td><?php echo $value->nomService; ?></td>
		                                  <td><?php echo $value->poste; ?></td>
		                                  <td><?php echo $value->fonction; ?></td>
		                                  <td class="hidden"><?php echo $value->idResponsible;?></th>
		                                  <td class="hidden"><?php echo $value->avatar; ?></th>
		                                  <td class="member-action-listener"><i class="ion-edit white-text small btn waves-effect trash-button change-member-trigger"></i><i class="ion-ios-trash white-text small btn waves-effect trash-button trash-member"></i><img src="../AjaxLoader/715.gif" class="push-read-loader"/> <img src="../ajaxLoader/727.gif" class="loader-trash"/></td>
		                              </tr>
		                             <?php endforeach; ?>
		                          </tbody>               
		                      </table>
		                  
		              </div>

	     </div>



	       		




  <div id="alterMember" class="modal white center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
                         				<form id="alter-admin-registering" class="accc-row-padding admin-form dash-form hidden">
                         						<i class="ion-card accc-color large"></i>
  												<h5 class="accc-color bold game-bottom-small-padding zero-margin">Veuillez entrer les valeurs pour effectuer une modification</h5>

											    <div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<textarea name="suivi-alter-admin-name" class="required materialize-textarea" id="suivi-alter-name"></textarea>
				  									<label class="active" for="suivi-alter-name">Nom</label>
				  								</div>

				  								<div class="col s12 input-field">
				  									<i class="ion-person small prefix game-main-color"></i>
				  									<textarea name="suivi-alter-admin-surname" class="required materialize-textarea" id="suivi-alter-surname"></textarea>	
				  									<label class="active" for="suivi-alter-surname">Prenom</label>
				  								</div>

				  									<div class="col s12 input-field">
				  											<i class="ion-person small prefix game-main-color"></i>
				  											<textarea  name="suivi-member-register-alter-fonction" class="required materialize-textarea" id="suivi-member-register-fonction-alter-id"></textarea>
				  											<label class="active" for="suivi-member-register-alter-fonction-id">Fonction</label>
				  									</div>

				  								<div class="col s12 input-field">
				  									<i class="ion-android-mail small prefix game-main-color"></i>
				  									<input type="email" name="suivi-alter-admin-login" class="required" id="suivi-alter-login">
				  									<label class="active" for="suivi-alter-login">E-mail(login)</label>
				  								</div>

				  							<div class="col s12">	
												<div class="col s6 input-field">
													  <label>Choisissez le Niveau</label><br>
													  <select class="browser-default" name="service-alter-selection" id="suivi-member-register-alter-service-id">
													   <option value="" selected disabled>Choisissez un niveau</option>
													    <?php foreach ($_SESSION['servicesInfo'] as $key => $value): ?>
													    	<option value="<?php echo $value->idService;?>"><?php echo $value->nomService; ?></option>
														<?php endforeach; ?>
													  </select>
												</div>

												<div class="col s6 input-field">
													  <label>Choisissez le privilège d'accès</label><br>
														  <select class="browser-default required" name="acces-alter-selection" id="suivi-admin-register-access-alter-id">
															    <option value="" selected>Choisissez le privilège</option>
															    <option value="responsable">Responsable</option>
															   	<option value="secretaire">Secretaire</option>
															    <option value="agent" class="choice-dept-chefsce hidden">Agent</option>
															    <option value="agent-arrive" class="choice-dept-courrier hidden">Agent-arrivé</option>
															    <option value="agent-depart" class="choice-dept-courrier hidden">Agent-départ</option>
														  </select>
												</div>



				  							</div>	




												<div class="col s12 input-field hidden" id="chief-service-wrapper-alter">
													  <label>Choisissez le supérieur de cet utilisateur</label><br>
														  <select class="browser-default" name="suivi-admin-register-sce-responsible-alter" id="suivi-admin-register-alter-sce-responsible">
															    <option value="" selected>Choisissez un supérieur</option>
															    <?php if ($_SESSION['superior'][0]!==0): ?>
																    <?php 	foreach ($_SESSION['superior'] as $key => $value):?>
														                <option value="<?php echo $value->id;?>" id="<?php 	echo $value->idService; ?>"><?php 	echo $value->nom." ".$value->prenom; ?></option>
																    <?php 	endforeach; ?>
															    <?php endif;?>
														  </select>
												</div>

						       					<input type="hidden" value="4" name="admin-control">
												<input type="hidden" value=""  name="suivi-alter-adminId" class="" id="suivi-alter-id">

									<button type="submit" class="modal-action modal-close btn submit-button left" id="alter-member-submit">Enregistrer</button>
                                    <button type="reset" class="modal-action modal-close btn submit-button right" id="alter-courrier-cancel" >Annuler</button>
			  							</form> 

           </p>

        </div>

  </div>


  <!--Confirm Delete Member Modal Box Structure -->
  <div id="confirmDeleteMember" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
            	<a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        	</p>
            <h6 class="accc-color modal-text bold">Etes-vous sûre de vouloir supprimer <span id="member-deleted"></span>
            portant l'identifiant <span id="member-deleted-id"></span> complètement du fichier d'administration ?
            </h6>
            	  <input type="hidden" id="avatar-deleted-member">
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="delete-member-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>

<script src="../js/manage-admin.js"></script>