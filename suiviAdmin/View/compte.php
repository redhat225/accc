  <?php $AuthClient->allow('admin'); ?>

<?php $headTitle="Bienvenue | Compte Administrateur"; ?>

<?php $ManageAdmin->adminInfo($_SESSION['AuthClient']->id); ?>
<!-- <?php $ManageAdmin->courrierWarning(); ?> -->
		<nav id="nav-index-game" class="orange">
			<div class="nav-wrapper">
        <p class="logo-wrapper-circle-account">
            <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        </p>

				<ul id="nav-mobile" class="right">
           <li id="alert-picto-new-courrier" class="accc-notIcon-rm" style="height:10px;"> <p class="hidden" id="real-value"></p> <span class="white-text bold alert-size-number-new-courrier" >0</span> <i class="ion-plus-round white-text small left zero-margin"></i> <i class="ion-email-unread white-text medium left zero-margin"></i> </li>
           
           <li id="alert-picto" class="hidden"> <span class="white-text bold" ></span> <i class="ion-android-alarm-clock white-text small left zero-margin"></i> <i class="ion-email white-text medium left"></i> </li>
					<li><a href="index.php?p=logout" class="btn deconnect-plateform-link">Deconnexion</a></li>
				</ul>
			</div>
		</nav>

 <div class="row zero-margin" id="game-gift-content">

  		<div class="col l2 m12 s12 center fixed" id="side-control-panel">
            <?php if(!empty($_SESSION['adminInfo']->avatar)) :?>
            <p class="avatar-game-gift acc-big-top-margin">  
            <img src="../suiviAdmin/suiviAdmin-img/avatar/<?php echo $_SESSION['adminInfo']->avatar; ?>">
            </p>
            <?php else : ?>
            <p class="acc-big-top-margin">
            <i class="ion-ios-contact-outline accc-color accc-huge-icon"></i>
            </p>
            <?php endif; ?>  				
  				<h6 class="white-text bold"><?php echo $_SESSION['adminInfo']->nom; ?> <?php echo $_SESSION['adminInfo']->prenom; ?></h6>
  				<ul id="game-gift-menu" class="left-align">
  					<li><a href="suivi-general-desktop" class="gg-li-a-elements"><i class="ion-easel small  game-main-color"></i><span>Tableau de bord</span></a></li>
           <li id="suivi-li-arrive"><a href="suivi-courrier-arrive" class="gg-li-a-elements"><i class="ion-ios-paper-outline small  game-main-color"></i><span>Courriers arrivés</span></a></li>
            <li><a href="suivi-courrier-depart" class="gg-li-a-elements"><i class="ion-ios-paper small  game-main-color"></i><span>Courriers départs</span></a></li>
    			<li><a href="suivi-profile-admin" class="gg-li-a-elements"><i class="ion-android-person small  game-main-color"></i><span>Profil</span></a></li>
            <li><a href="suivi-member-admin" class="gg-li-a-elements"><i class="ion-ios-people small  game-main-color"></i><span>Gérer Membres</span></a></li>
            <?php if( ($_SESSION['AuthClient']->idService==1) && ($_SESSION['AuthClient']->poste=="responsable")):?>
                          <li><a href="suivi-general-admin" class="gg-li-a-elements"><i class="ion-podium small  game-main-color"></i><span>Statistiques</span></a></li>
            <li><a href="suivi-notification-admin" class="gg-li-a-elements"><i class="ion-android-notifications small  game-main-color"></i><span>Notifications</span></a></li>
            <?php   endif; ?> 

            <li><a href="index.php?p=logout" class=""><i class="ion-power small  game-main-color"></i><span>Déconnexion</span></a></li>
  				</ul>
  				<h6 class="white-text bold huge-margin-top">Contactez l'Administrateur</h6>
  				<p class="contact-content white-text">
  					<i class="ion-ios-telephone small game-white"></i> 22-48-88-88
  				</p>
  		</div>


  	   <div class="col l10 m12 s12 accc-row-padding" id="game-gift-variable-content">				
              
  		</div>
  </div>			

<!--   <div class="fixed-action-btn click-to-toggle" style="bottom: 35px; right: 12px;" id="bubble-menu-admin">
      <a class="btn-floating btn-large accc-back-color admin-floating-button">
        <i class="ion-easel floating-icon-main admin" style="font-size:50px; top:15px;"></i>
      </a>
</div> -->

<p class="hide-left-panel accc-back-color hide-on-med-and-down">
  <i class="ion-ios-undo white-text small custom-hidder"></i>
</p>

<p class="hide-left-panel-med-small-device accc-back-color hide-on-large-only">
  <i class="ion-arrow-up-b white-text small custom-hidder"></i>
</p>

<a class="refresh-assets transparents-assets1 replace-transparent-assets1" href="gg-general-info">
  <i class="ion-ios-refresh accc-color custom-hidder bold"></i>
</a>

<a class="back-panel white transparents-assets2 replace-transparent-assets2" href="suivi-general-desktop">
  <i class="ion-android-arrow-dropleft-circle accc-color medium custom-hidder" style="font-size:49px;"></i>
</a>

<!-- <a class="next-panel white" href="suivi-general-desktop">
  <i class="ion-android-arrow-dropright-circle accc-color medium custom-hidder" style="font-size:49px;"></i>
</a> -->
  <!--Main Modal Box Structure -->
  <div id="mainModal-suiviAdmin" class="modal accc-back-color-alt center-align">
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

    <div id="mainModal-Warning-Count" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
        <p class="logo-wrapper-circle-account">
            <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        </p>
            <h6 class="accc-color modal-text bold acc-small-top-margin"></h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="modal-action white-text modal-close waves-effect waves-green bold" id="see-warning-list-trigger">Voir la liste</a>
        </div>
  </div>

    <!--Listing Warning courrier Structure -->
  <div id="mainModal-Warning" class="modal white center-align modal-fixed-footer">
        <div class="modal-content">
        <p class="logo-wrapper-circle-account">
            <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        </p>
                <h5 class="orange-text bold acc-row-a">Liste des courriers en retard de traitement</h5>
                        <table class="MyTable striped bordered bold centered" id="member-table">
                            <thead class="orange white-text">
                                <tr>
                                  <th data-field="id">Id</th>
                                  <th data-field="id">Exp</th>
                                  <th data-field="id">Dest</th>                                  
                                  <th data-field="id">Objet</th>
                                  <th data-field="id">Jours de retard</th>
                                  <th data-field="id">Voir</th>                               
                                </tr>
                            </thead>
                            <tbody>
                           <?php foreach ($_SESSION['courrierWarning'] as $key => $value): ?>
                             <tr>
                                 <td><?php echo $value->id; ?></td>
                                 <td><?php echo $value->expediteur; ?></td>
                                 <td><?php echo $value->destinataire; ?></td>
                                 <td><?php echo $value->objet; ?></td>
                                 <td><?php 
                                    echo $value->dayRest;
                                  ?></td>
                                 <td class="center">  
                                     <a href="../simple_flex/index.php?pathPdf=<?php echo $value->piece; ?>" class="path-down-courrier" id="<?php echo $value->piece; ?>" target="_blank">
                                     <i class="ion-document-text white-text small btn waves-effect trash-button get-join-piece left-zero" >
                                    </i>
                                     </a>
                                 </td>                               
                             </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>


        </div>



        <div class="modal-footer accc-back-color">
            <a href="#!" class="modal-action white-text modal-close waves-effect waves-green bold">OK</a>
        </div>
  </div>

  <!--NewCourriers Notification Box Structure -->
  <div id="Notification-newCourrier" class="modal accc-back-color-alt center-align">
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

<footer class="page-footer accc-back-color-green zero-margin zero-padding white-text">
	<div class="footer-copyright">
		<div class="container white-text">
			 © 2016 Direction Générale du Trésor et de la Comptabilité Publique
			 <a href="" class="right white-text">Tous droits réservés</a>
		</div>
	</div>
</footer> 
<script src="../js/account-admin.js"></script>
<script src="../js/howler.js-master/howler.js-master/howler.min.js"></script>
<script src="../js/notificationRefresh.js"></script>
<script>
$(document).ready(function(){
  $("#alert-picto-new-courrier").on('click',function(){
      $("#suivi-li-arrive").trigger("click");
  });


  $("#member-table tbody tr:odd").addClass("accc-light-stripe-orange");
  $("#alert-picto").on('click',function(){
      $("#mainModal-Warning").openModal({
              dismissible:false
      });
  });


    //Load unread newCourrier/loadImputationion
  
       <?php if(( ($_SESSION['adminInfo']->idService)<3) && ( ($_SESSION['adminInfo']->poste)!=="agent-arrive") ) :?>
        setInterval(loadNewCourrier,10000);
        <?php endif; ?>
         
      <?php   if(($_SESSION['adminInfo']->idService)>2) : ?>
        setInterval(loadImputation,10000);
      <?php   endif; ?>
    

    //keeping session alive every 20 minutes
    setInterval(function(){$.post('../refresh_session/refresh.php');},1200000);

  });

function loadNewCourrier(){
        $.ajax({
        type : 'POST',
        url : '../serverTraitor/suiviAdmin.php',
        dataType:'text',
        data:"admin-control="+57,
        success:function(data){
        if($.isNumeric(data))
        {
          if(data>0)
          {
            $valueLoad=parseInt(data);
            $valueNotRead=parseInt($("#alert-picto-new-courrier p").text());
            if($valueLoad>$valueNotRead)
            { 
              var $realtimeValue=parseInt($("#alert-picto-new-courrier span").text());
               $("#alert-picto-new-courrier span").text($realtimeValue+1);
               $("#alert-picto-new-courrier p").text($valueLoad);
               playNot();
               Materialize.toast("Un nouveau courrier arrivé vient d'être enregistré", 6000); 
            }
            
          }
        }

        },
        error: function(){}
    });
}


function loadImputation(){
      $.ajax({
        type : 'POST',
        url : '../serverTraitor/suiviAdmin.php',
        dataType:'text',
        data:"admin-control="+59,
        success:function(data){
        if($.isNumeric(data))
        {
          if(data>0)
          {
            $valueLoad=parseInt(data);
            $valueNotRead=parseInt($("#alert-picto-new-courrier p").text());
            if($valueLoad>$valueNotRead)
            { 
              var $realtimeValue=parseInt($("#alert-picto-new-courrier span").text());
               $("#alert-picto-new-courrier span").text($realtimeValue+1);
               $("#alert-picto-new-courrier p").text($valueLoad);
               playNot();
               Materialize.toast("Un nouveau courrier vous a été imputé", 6000); 
            }
          }          
        }

          
        },
        error: function(){} 
    });
}


function playNot(){
                  var sound = new Howl({
                urls: ['../Audio/glass.mp3'],
                volume : 0.2
                }).play();
}


</script>

