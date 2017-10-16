	       <div class="row center game-row-padding" class="general-info">
	       	        		  <i class="ion-android-clipboard accc-color accc-huge-icon"></i>

	  				<h4 class="bold accc-color zero-margin">SERVICE DE SUIVI COURRIER CLIENT ACCC</h4>
	  				<h6 class="bold accc-small-bottom-margin">Bienvenue <?php echo $_SESSION['clientInfo']->nom; ?> sur votre espace personnel</h6>
  						
  						<div class="col s3">
  							<div class="card gg-card center">
	  							<div class="card-content">
	  								<i class="ion-paper-airplane large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Courriers Envoyés
	  								</p>

	  							</div>
	  							<div class="card-action accc-back-color-alt wrapper-value-card">
	  								<span class="accc-color bold game-big-item-account">
	  									<?php echo $_SESSION['accountClientInfo'][0]->sendCourrier; ?>
	  								</span>
	  							</div>
  							</div>
  						</div>
  						<div class="col s3">
  							<div class="card gg-card center">
	  							<div class="card-content">
	  								<i class="ion-cube large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Courriers en dépot
	  								</p>
	  							</div>
	  							<div class="card-action accc-back-color-alt wrapper-value-card">
	  								<span class="accc-color bold game-big-item-account">
	  									<?php echo $_SESSION['accountClientInfo'][6]->depotCourrier; ?>
	  								</span>
	  							</div>
  							</div>
  						</div>	
  						<div class="col s3">
  							<div class="card gg-card center">
	  							<div class="card-content">
	  								<i class="ion-android-archive large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Courriers Traités
	  								</p>

	  							</div>
	  							<div class="card-action accc-back-color-alt wrapper-value-card">
	  								<span class="accc-color bold game-big-item-account">
	  									<?php echo $_SESSION['accountClientInfo'][1]->treatedCourrier; ?>
	  								</span>
	  							</div>
  							</div>
  						</div>	
  						<div class="col s3">
  							<div class="card gg-card center">
	  							<div class="card-content">
	  								<i class="ion-android-sync large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Courriers En traitement
	  								</p>

	  							</div>
	  							<div class="card-action accc-back-color-alt wrapper-value-card">
	  								<span class="accc-color bold game-big-item-account">
	  									<?php echo $_SESSION['accountClientInfo'][2]->treatingCourrier; ?>
	  								</span>
	  							</div>
  							</div>
  						</div>	

  	</div>
  	<div class="row center">

  						<div class="col s3">
  							<div class="card gg-card center">
	  							<div class="card-content">
	  								<i class="ion-ios-time large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Temps Moyen de Traitement-Courrier
	  								</p>
	  							</div>
	  							<div class="card-action accc-back-color-alt wrapper-value-card">
	  								<span class="accc-color bold game-big-item-account">
	  									<?php echo $_SESSION['accountClientInfo'][4]->tempsMoyenTraitement; ?>
	  									jours
	  								</span>
	  							</div>
  							</div>
  						</div>
  						<div class="col s3">
  							<div class="card gg-card center">
	  							<div class="card-content">
	  								<i class="ion-ios-timer large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Courriers Ayant dépasser le delai de traitement
	  								</p>
	  							</div>
	  							<div class="card-action accc-back-color-alt wrapper-value-card">
	  								<span class="accc-color bold game-big-item-account">
	  									<?php echo $_SESSION['accountClientInfo'][5]->timeout; ?>
	  								</span>
	  							</div>
  							</div>
  						</div>
  						 <div class="col s3">
  							<div class="card gg-card center">
	  							<div class="card-content">
	  								<i class="ion-ios-paper large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Suggestions clientes Envoyées au services ACCC
	  								</p>
	  							</div>
	  							<div class="card-action accc-back-color-alt wrapper-value-card">
	  								<span class="accc-color bold game-big-item-account">
	  									<?php echo $_SESSION['accountClientInfo'][7]->sendSuggest; ?>
	  								</span>
	  							</div>
  							</div>
  						</div>
  						<div class="col s3">
  							<div class="card gg-card center">
	  							<div class="card-content">
	  								<i class="ion-android-delete large accc-color-alt"></i>
	  								<p class="bold title-card-alt">
	  									Courriers Rejetés lors du traitement
	  								</p>
	  							</div>
	  							<div class="card-action accc-back-color-alt wrapper-value-card">
	  								<span class="accc-color bold game-big-item-account">
	  									<?php echo $_SESSION['accountClientInfo'][3]->castCourrier; ?>
	  								</span>
	  							</div>
  							</div>
  						</div>
  			 </div> 