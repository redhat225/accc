<?php if(!(isset($_SESSION['AuthClient']))) :?>

<?php 
$backGreen="backGreen";
 ?>
<div class="row center accc-small-perc-top-margin">
	<div class="container">
		<div class="container">
			<h5 class="bold white-text accc-row-padding">Agence Comptable des Creances Contentieuses</h5>
			<div class="col s4 accc-right-barrow">
				<p class="logo-wrapper-circle">
					<img src="../img/index/dgtcp-logo.jpg"/>
				</p>
			</div>
			<div class="col s8">
				<h5 class="bold white-text zero-margin">Récupération mot de passe administrateur</h5>
				 <form id="recovery-reset">
					<div class="input-field col s12">
						 <i class="prefix small ion-ios-person"></i>
					     <input id="recovery-reset-pass" name="recovery-reset-content" type="password" class="required">
					     <label for="recovery-reset">Nouveau Mot de Passe</label>
				    </div>

					<div class="input-field col s12">
						 <i class="prefix small ion-ios-person"></i>
					     <input id="recovery-reset-confirm" name="recovery-reset-content-confirm" type="password" class="required">
					     <label for="recovery-reset-confirm">Confirmer</label>
				    </div>

				    <button type="submit" id="submit-reset-button" class="btn submit-button">Changer</button>
					<div class="loaderAjax acc-medium-top-margin">
				    	<img src="../AjaxLoader/loading.gif"/>
				    </div>
				    <input type="hidden" name="client-control" value="4" />
				    <input type="hidden" name="token" value="<?php echo $token;?>" />
				 </form>
				 <p class="">
				 		<a href="index.php?p=login" class="white-text">Se connecter</a>
				 </p>

			    <p class="">
					<a href="index.php?p=recovery" class="white-text">Mot de passe oublié?</a>
				</p>
			</div>
			
		</div>
	</div>
</div>

  <!--Main Modal Box Structure -->
  <div id="Reset-Modal" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
        <p class="logo-wrapper-circle-account">
            <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        </p>
            <h6 class="accc-color modal-text bold acc-small-top-margin"></h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="modal-action white-text modal-close waves-effect waves-green bold">OK</a>
        </div>
  </div>

<?php else: ?>
<?php header("Location:index.php?p=login");?>
<?php endif; ?>