<?php 
$backGreen="backGreen";
 ?>
<div class="row center accc-small-perc-top-margin">
	<div class="container">
		<div class="container">
			<h5 class="bold white-text accc-row-padding">Agence Comptable des Creances Contentieuses</h5>
			<div class="col s4 accc-right-barrow">
				<p class="logo-wrapper-circle">
					<img src="img/index/dgtcp-logo.jpg"/>
				</p>
			</div>
			<div class="col s8">
				<h5 class="white-text zero-margin">Consultez l'état de traitement de votre courrier	</h5>
				 <form id="login-client-acc">
					<div class="input-field col s12">
						 <i class="prefix small ion-android-list"></i>
					     <input id="login-client" name="login-client-content" type="number" class="required">
					     <label for="login-client">Numéro identifiant de suivi</label>
				    </div>
				    <button type="submit" id="submit-login-client" class="btn submit-button">Consulter</button>
					<div class="loaderAjax acc-medium-top-margin">
				    	<img src="AjaxLoader/loading.gif" />
				    </div>
				    <div class="error-form-wrapper acc-small-top-margin">
				    	<span id="error-login-client-content" class="white-text hidden"></span>
				    </div>

				    <input type="hidden" name="client-control" value="1" />
				 </form>
			</div>
		</div>
	</div>
</div>

  <!--State Treatment courrier Modal Box Structure -->
  <div id="stateTreatment" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
            </p>
            <h6 class="game-main-color modal-text bold orange-text" id="stateTreatment-text-wrapper">
            </h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="right modal-action white-text waves-effect modal-close btn-flat bold">OK</a>
        </div>
  </div>