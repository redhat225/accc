<div class="row center accc-row-padding">
	<div class="container accc-row-padding">
	       	       	<i class="ion-easel accc-color accc-huge-icon"></i>
	       	       	<div class="">
	  				<h4 class="bold accc-color zero-margin">Tableau de bord</h4>
	  				<h6 class="bold accc-small-bottom-margin">Bienvenue <?php echo $_SESSION['adminInfo']->nom; ?> <?php echo $_SESSION['adminInfo']->prenom; ?> sur la plateforme de gestion de courriers</h6>
  			
					</div>

					<div class="row center">
					  <div class="col l4 m4 s12">
  							<div class="card gg-card center courrierArrive pointer choice-general" id="suivi-courrier-arrive">
	  							<div class="card-content admin-accc-general-card">
	  								<i class="ion-ios-paper-outline large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Courriers Arrivés
	  								</p>
	  							</div>
  							</div>
  						</div>
	
						<div class="col l4 m4 s12">
  							<div class="card gg-card center courrierDepart pointer choice-general" id="suivi-courrier-depart">
	  							<div class="card-content admin-accc-general-card">
	  								<i class="ion-ios-paper large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Courriers Départ
	  								</p>

	  							</div>
  							</div>
  						</div>
 
	  						<div class="col l4 m4 s12">
	  							<div class="card gg-card center researches-courrier pointer choice-general" id="suivi-archives-admin">
		  							<div class="card-content admin-accc-general-card">
		  								<i class="ion-android-search large accc-color-alt"></i>
		  								<p class="bold title-card-alt">
		  									Recherche Courrier
		  								</p>

		  							</div>
	  							</div>
	  						</div>
  				</div>

			<div class="row center">
  						<div class="col l4 m4 s12">
  							<div class="card gg-card center profil pointer choice-general" id="suivi-profile-admin">
	  							<div class="card-content admin-accc-general-card">
	  								<i class="ion-person large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Profil
	  								</p>

	  							</div>
  							</div>
  						</div>

						<?php if( ($_SESSION['AuthClient']->idService==1) && ($_SESSION['AuthClient']->poste=="responsable")):?>
						  <div class="col l4 m4 s12">
  							<div class="card gg-card center notifications pointer choice-general" id="suivi-notification-admin">
	  							<div class="card-content admin-accc-general-card">
	  								<i class="ion-android-notifications large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Notifications
	  								</p>
	  							</div>
  							</div>
  						</div>


	  						  <div class="col l4 m4 s12">
	  							<div class="card gg-card center stats pointer choice-general" id="suivi-general-admin">
		  							<div class="card-content admin-accc-general-card">
		  								<i class="ion-podium large accc-color-alt"></i>
		  								<p class="bold title-card-alt">
		  									Statistiques
		  								</p>

		  							</div>
	  							</div>
	  						</div>
						<?php 	endif; ?> 


					</div> 
			</div>
</div>


<script src="../js/manage-dash.js"></script>