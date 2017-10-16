	       <div class="row center game-row-padding zero-margin" class="general-info">
	       		
	       			<p class="generalStats zero-margin">
	  					<i class="ion-map accc-huge-icon accc-color"></i>
	  					<h4 class="accc-color zero-margin">Parcours Courrier</h4>
	  					<h6 class="bold">Consulter les niveaux de passage des courriers, Assignez des tâches courriers ...</h6>	
	  					<a href="#archives-explanation" class="btn submit-button">En savoir plus</a>	
	  				</p>
	       			
	  				      <p class="page-breadcrumb">
                            <span class="parent-breadcrumb"><a href="gg-product-purchase">Courrier</a><i class="ion-chevron-right small-right-left-margin"></i></span>
                            <span class="child-breadcrumb accc-color">Suivi Courrier <?php echo $_SESSION['singleCourrierInfo']->numSuivi; ?></span>
                          </p>

	              <div class="row" id="gamer-info-table">	
	                 
	                      <table class="MyTable striped bordered bold centered" id="road-courrier-table">
	                          <thead class="accc-back-color white-text">
	                              <tr>
	                                  <th data-field="id">Identifiant Passage</th>
	                                  <th data-field="id">Service Passage</th>
	                                  <th data-field="id">Poste Passage</th>
	                                  <th data-field="id">Responsable Passage</th>
	                                  <th data-field="id">Date Entree</th>
	                                  <th data-field="id">Date Sortie</th>
	             
	                                  <th data-field="id">Action</th>
	                              	  	
	                              </tr>
	                          </thead>
	                          <tbody>
		                       <?php foreach ($_SESSION['singleRoadCourrier'] as $key => $value):?>
	                              <tr>
	                                  <td><?php echo $value->idPassage; ?></td>
	                                  <td><?php echo $value->nomService; ?></td>
	                                  <td><?php echo $value->poste; ?></td>
	                                  <td><?php echo $value->nom." ".$value->prenom ?></td>
	                                  <td><?php echo $value->dateEnter; ?></td>
	                                  <td><?php echo $value->dateExit; ?></td>
	                                  <?php if($_SESSION['singleCourrierInfo']->state<3) :?>
		                                 	 <td class="member-action-listener">
			                                  		 <?php if(($value->id)==($_SESSION['adminInfo']->id) ) :?>
															<?php if(($_SESSION['maximumPass']->maximum)==($value->idPassage) ) :?>
																     <i class="ion-ios-trash white-text small btn waves-effect trash-button trash-passage-trigger"></i>
																     <img src="../ajaxLoader/727.gif" class="loader-trash"/>
																 <?php if(empty($value->dateExit)) :?>
	 															 		<i class='ion-android-send white-text small btn waves-effect alter-attribution-button game-tiny-top-margin passage-sortie-trigger'></i>
	 															 		<img src="../ajaxLoader/715.gif" class="push-read-loader"/>
	 															 <?php endif; ?>
															<?php endif; ?>	
													 <?php endif; ?>	
		                              	  	  </td>
	                              	  <?php endif; ?>		
	                              </tr>
	                             <?php endforeach; ?> 
	                          </tbody>               
	                      </table>
	                  
	              </div>

	           <?php if($_SESSION['singleCourrierInfo']->state<3) :?>
			   		<div class="row center" id="adding-new-passage-trigger">
                       <span class="accc-color bold adding-element-courrier-trigger" id="adding-passage-trigger"><i class="ion-plus-round accc-color medium adding-Passage-Enter-trigger"></i><i class="ion-ios-albums accc-color large adding-Passage-Enter-trigger"></i> Enregistrer Passage Entrée</span> 
            		 </div>
            		<div class="loaderAjax acc-medium-top-margin">
					    <img src="../AjaxLoader/loading2.gif" />
					 </div> 
			   <?php endif; ?>   

				<div class="row center">
					<div class="container" id="singleCourrier-info">
					     <div class="col s6 info-input-file" id="courrier-single-info-recap">
					     		<i class="ion-information-circled accc-color medium"></i>
					  		<p class="left-align bold">
					  			<i class="ion-asterisk accc-color bold"></i>
					  			Identifiant courrier: <span class="accc-color" id="idSingleCourrier"><?php echo $_SESSION['singleCourrierInfo']->idCourrier; ?></span> 
					  		</p>
					  		<p class="left-align bold">
					  			<i class="ion-asterisk accc-color bold"></i>
					  			Numéro suivi courrier: <span class="accc-color" id="idSingleNumSuivi"><?php echo $_SESSION['singleCourrierInfo']->numSuivi ;?></span> 
					  		</p>
					  		<p class="left-align bold">
					  			<i class="ion-asterisk accc-color bold"></i>
					  			Expéditeur courrier: <span class="accc-color"><?php echo $_SESSION['singleCourrierInfo']->nom ;?></span> 
					  		</p>
					  		<p class="left-align bold">
					  			<i class="ion-asterisk accc-color bold"></i>
					  			Objet courrier: <span class="accc-color"><?php echo $_SESSION['singleCourrierInfo']->objetCourrier; ?></span> 
					  		</p>
					  		<p class="left-align bold">
					  			<i class="ion-asterisk accc-color bold"></i>
					  			Service Indexé: <span class="accc-color"><?php echo $_SESSION['singleCourrierInfo']->nomService; ?></span> 
					  		</p>
					  		<p class="left-align bold">
					  			<i class="ion-asterisk accc-color bold"></i>
					  			Date Enregistrement courrier: <span class="accc-color"><?php echo $_SESSION['singleCourrierInfo']->recordDate; ?></span> 
					  		</p>
					  		<p class="left-align bold">
					  			<i class="ion-asterisk accc-color bold"></i>
					  			Délai traitement courrier: <span class="accc-color"><?php echo $_SESSION['singleCourrierInfo']->delaiTraitement; ?> jour(s)</span> 
					  		</p>
					  		<p class="left-align bold">
					  			<i class="ion-asterisk accc-color bold"></i>
					  			Date Prévue retour courrier: <span class="accc-color"><?php echo $_SESSION['singleCourrierInfo']->datePrevueTraitement; ?></span> 
					  		</p>
					  		<p class="left-align bold">
					  			<i class="ion-asterisk accc-color bold"></i>
					  			Date Effective de traitement: <span class="accc-color"><?php echo $_SESSION['singleCourrierInfo']->treatedDate; ?></span> 
					  		</p>
				  		</div>
				  		<div class="col s6 info-input-file" id="member-explanation">
				  			<i class="ion-android-warning accc-color medium"></i>
				  		<p class="left-align bold">
				  			<i class="ion-asterisk accc-color bold"></i>
				  			le mail doit être de la forme : <span class="accc-color">name@provider.com</span> 
				  		</p>
				  		<p class="left-align bold">
				  			<i class="ion-asterisk accc-color"></i>
				  			Veuillez entrer un mot de passe contenant des lettres majuscules, des nombres pour le rendre plus sécurisé.<span class="accc-color">ex : GamerC2015_Player</span> 
				  		</p>
				  		<p class="left-align bold">
				  			<i class="ion-asterisk accc-color"></i>
				  			Le contact fourni doit être un numéro mobile correspondant à l'un des différents opérateurs du secteur.
				  		</p>
				  		<p class="left-align bold">
				  			<i class="ion-asterisk accc-color"></i>
						 	 Le rôle définit les privilèges de l'utilisateur dans l'administration du service Game-gift.
						  </p>
						  				  		<p class="left-align bold">
				  			<i class="ion-asterisk accc-color"></i>
						 	 Le rôle définit les privilèges de l'utilisateur dans l'administration du service Game-gift.
						  </p><br>
			  		</div>
					</div>
				</div>



	  	   </div>

  <!--Confirm Delete Member Modal Box Structure -->

  <div id="deletePassage" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
            <h6 class="accc-color modal-text bold">
            	Etes-vous sure de vouloir supprimer ce passage ?
            </h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="passage-trash-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>

  <div id="PassageSortie" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
            <h6 class="accc-color modal-text bold">
            	Etes-vous sure de vouloir marquer ce courrier en passage de sortie?
            </h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="sortie-courrier-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>

    <div id="EnterPassage" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
            <h6 class="accc-color modal-text bold">
            	Etes-vous sure de vouloir enregistrer un nouveau passage?
            </h6>
            <input type="hidden" id="service-user" value="<?php echo $_SESSION['adminInfo']->nomService; ?>">
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold" id="passage-new-trigger">Valider</a>
            <a href="#!" class="left modal-action white-text modal-close waves-effect btn-flat bold">Annuler</a>
        </div>
  </div>

<script src="../js/manage-road-courrier-admin.js"></script>