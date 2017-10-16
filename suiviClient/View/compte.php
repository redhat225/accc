<?php $AuthClient->allow('client'); ?>

<?php $headTitle="Bienvenue | Compte Client"; ?>

<?php $ManageClient->clientInfo($_SESSION['AuthClient']->id); ?>


    <nav id="nav-index-game" class="orange">
      <div class="nav-wrapper">
        <p class="logo-wrapper-circle-account">
            <a href="#" class="brand-logo"><img src="img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        </p>
        <ul class="hide-on-large-only left">
          <a href="index.php?p=logout"><i class="ion-android-exit medium accc-color"></i></a>
        </ul>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="index.php?p=logout" class="btn deconnect-plateform-link">Deconnexion</a></li>
        </ul>
      </div>
    </nav>

 <div class="row zero-margin" id="game-gift-content">

  		<div class="col l2 m12 s12 center fixed" id="side-control-panel">  				
  				<h6 class="white-text bold"><?php echo $_SESSION['clientInfo']->nom; ?></h6>
  				<ul id="game-gift-menu" class="left-align">
  					<li><a href="suivi-general-client" class="gg-li-a-elements"><i class="ion-android-clipboard small  game-main-color"></i><span>Info Générales</span></a></li>
  					<li><a href="suivi-profile-client" class="gg-li-a-elements"><i class="ion-android-person small  game-main-color"></i><span>Profil</span></a></li>
  					<li><a href="suivi-courrier-client" class="gg-li-a-elements"><i class="ion-ios-email-outline small  game-main-color"></i><span>Courriers</span></a></li>
  					<li><a href="suivi-suggest-client" class="gg-li-a-elements"><i class="ion-ios-paper-outline small  game-main-color"></i><span>Suggestions</span></a></li>
            <li><a href="suivi-about-client" class="gg-li-a-elements"><i class="ion-help-buoy small  game-main-color"></i><span>A propos</span></a></li>
  					<li><a href="index.php?p=login" class="gg-li-a-elements"><i class="ion-android-home small  game-main-color"></i><span>Revenir au site</span></a></li>
  				</ul>
  				<h6 class="white-text bold acc-huge-top-margin">Partagez</h6>
  				<p class="share-icons-content">
  					<i class="ion-social-youtube-outline small game-white"></i>
  					<i class="ion-social-facebook small game-white"></i>
  					<i class="ion-social-googleplus small game-white"></i>
  				</p>
  				<h6 class="white-text bold">Contactez-nous</h6>
  				<p class="contact-content white-text">
  					<i class="ion-ios-telephone small game-white"></i> 23-45-78-96
  				</p>
  		</div>


  	   <div class="col l10 m12 s12 accc-row-padding" id="game-gift-client-variable-content">				
              
  		</div>
  </div>			

  <div class="fixed-action-btn click-to-toggle" style="bottom: 35px; right: 12px;">
    <a class="btn-floating btn-large accc-back-color admin-floating-button">
      <i class="ion-ios-email floating-icon-main admin" style="font-size:50px;"></i>
    </a>

    <ul id="bubble-menu-admin">
      <li><a href="suivi-general-client" class="btn-floating accc-back-color"><i class="ion-android-clipboard white-text floating-icon-sub"></i></a></li>
      <li><a href="suivi-profile-client" class="btn-floating accc-back-color"><i class="ion-android-person white-text floating-icon-sub"></i></a></li>
      <li><a href="suivi-courrier-client" class="btn-floating accc-back-color"><i class="ion-email white-text floating-icon-sub"></i></a></li>
      <li><a href="suivi-suggest-client" class="btn-floating accc-back-color"><i class="ion-ios-paper white-text floating-icon-sub"></i></a></li>
      <li><a href="suivi-about-client" class="btn-floating accc-back-color"><i class="ion-help-buoy white-text floating-icon-sub"></i></a></li>
      <li><a href="index.php?p=login" class="btn-floating accc-back-color"><i class="ion-android-home white-text floating-icon-sub"></i></a></li>
   </ul>
  </div>

<p class="hide-left-panel accc-back-color hide-on-med-and-down">
  <i class="ion-ios-undo white-text small custom-hidder"></i>
</p>

<p class="hide-left-panel-med-small-device accc-back-color hide-on-large-only">
  <i class="ion-arrow-up-b white-text small custom-hidder"></i>
</p>

<a class="refresh-assets  hide-on-med-and-down" href="gg-general-info">
  <i class="ion-ios-refresh accc-color custom-hidder bold"></i>
</a>

  <!--Main Modal Box Structure -->
  <div id="mainModal-suiviClient" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
        <p class="logo-wrapper-circle-account">
            <a href="#" class="brand-logo"><img src="img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        </p>
            <h6 class="accc-color modal-text bold acc-small-top-margin"></h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="modal-action white-text modal-close waves-effect waves-green bold">OK</a>
        </div>
  </div>


<footer class="page-footer accc-back-color-green zero-margin zero-padding white-text">
	<div class="footer-copyright">
		<div class="container white-text">
			 © 2016 Direction Générale du Trésor et de la Comptabilité Publique
			 <a href="" class="right white-text">Tous droits réservés</a>
		</div>
	</div>
</footer> 
<script src="js/account-client.js"></script>
