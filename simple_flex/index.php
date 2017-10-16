<?php session_start(); ?>
<?php 
require("../vendor/autoload.php");
use PollingEntity\NewCourrier;
use PollingEntity\Imputation;
use suiviAdmin\Entity;
$Imputation=new Imputation();
require("../bdConnect/accc-connect.php");
 ?>

<?php if(isset($_SESSION['AuthClient'])) :?>
 
 <?php  $ManageAdmin=new Entity\ManageAdmin(); 
                          $NewCourrier = new NewCourrier();
                          $idCourrier=$NewCourrier->getIdFlexReadCourrier($_REQUEST['pathPdf']);
                          $NewCourrier->setId($idCourrier);
                          $idState=$NewCourrier->getState();
                          ?>

     <?php if( ($_SESSION['AuthClient']->idService==1)  || (($_SESSION['AuthClient']->idService==1) && ($_SESSION['AuthClient']->poste=="responsable")) || (($_SESSION['AuthClient']->idService==1) && ($_SESSION['AuthClient']->poste=="secretaire")) || (($_SESSION['AuthClient']->idService==2) && ($_SESSION['AuthClient']->poste=="secretaire")) || (($_SESSION['AuthClient']->idService==2) && ($_SESSION['AuthClient']->poste=="responsable")) || ($ManageAdmin->CheckedImputation($_SESSION['AuthClient']->id,$idCourrier))) :?>

	<?php $pfdPath=$_REQUEST['pathPdf']; ?>


                 <?php   
                         if (($_SESSION['AuthClient']->idService==2) && ( ($_SESSION['AuthClient']->poste=="responsable") || ($_SESSION['AuthClient']->poste=="responsable")))
                         {
                           $ManageAdmin->recupResponsible($idCourrier);
                            $ManageAdmin->recupRevokeResponsible($idCourrier);
                          
                         }
                           else{
                                  $ManageAdmin->revokResp($_SESSION['AuthClient']->idService,$_SESSION['AuthClient']->id,$idCourrier);
                                  $ManageAdmin->ImpResp($_SESSION['AuthClient']->idService,$_SESSION['AuthClient']->id,$idCourrier);
                           }


                        
                 ?>
    <head> 
        <title>Consultation Courrier | Bienvenue <?php echo $_SESSION['AuthClient']->nom." ".$_SESSION['AuthClient']->prenom; ?> </title>                
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" />
        <style type="text/css" media="screen"> 
			html, body	{ height:100%; }
			body { margin:0; padding:0; overflow:auto; }   
			#flashContent {display: none;}
        </style> 
        <link rel="stylesheet" type="text/css" href="../bower_components/Materialize/dist/css/materialize.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="../css/accc.css"/>
        <link rel="stylesheet" type="text/css" href="../Assets/ionicons-2.0.1/css/ionicons.min.css" media="screen"/>
	    	<link rel="stylesheet" type="text/css" href="css/flexpaper_flat.css" />
        <link rel="shortcut icon" href="../img/favicon.ico" media="screen"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="../bower_components/Materialize/dist/js/materialize.min.js"></script>
		<script type="text/javascript" src="js/jquery.extensions.min.js"></script>
		<script type="text/javascript" src="js/flexpaper.js"></script>
		<script type="text/javascript" src="js/flexpaper_handlers.js"></script>
        <script type="text/javascript" src="js/flexPaper_Manager.js"></script>
        
    </head> 
    <body>  
        <div class="fixed-action-btn click-to-toggle" style="bottom: 35px; right: 12px;" id="bubble-menu-wrapper">
            <a class="btn-floating btn-large accc-back-color admin-floating-button">
              <i class="ion-android-menu floating-icon-main admin" style="font-size:50px;"></i>
            </a>

            <ul id="bubble-menu-admin">
              <li><a href="../suiviAdmin/index.php?p=logout" class="btn-floating accc-back-color"><i class="ion-power white-text floating-icon-sub"></i></a></li>
              <li><a href="../suiviAdmin/index.php?p=compte" class="btn-floating accc-back-color"><i class="ion-easel white-text floating-icon-sub"></i></a></li>
              <?php   if($idState!=3) :?>
              <?php if( ($_SESSION['AuthClient']->idService>1) && ($_SESSION['AuthClient']->poste=="responsable" || $_SESSION['AuthClient']->poste=="secretaire" ) ) :?>
              <li id="imputation-button"><a href="#!" class="btn-floating accc-back-color"><i class="ion-arrow-right-c white-text floating-icon-sub"></i></a></li>
              <li id="revoke-imputation-button"><a href="#!" class="btn-floating accc-back-color"><i class="ion-backspace white-text floating-icon-sub"></i></a></li>
          <?php endif; ?>
        <?php   endif; ?>

           </ul>
        </div>

            <!--Box Imputation -->
  <div id="selectRespImputation" class="modal white center-align">
        <div class="modal-content accc-row-padding">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
              <?php 
                  if($_SESSION['AuthClient']->idService==2)
                  {
                    $titleImputation=" une/plusieurs entité(s)";
                  }
                  if($_SESSION['AuthClient']->idService==3)
                  {
                    $titleImputation="un/plusieurs Chef(s) de service";
                  }
                  if($_SESSION['AuthClient']->idService==4)
                  {
                    $titleImputation="un/plusieur(s) Agent(s)";
                  }
               ?>
                            <form id="imputation-form" class="dash-form accc-row-padding">
                                    <h5 class="accc-color bold game-bottom-small-padding">Veuillez spécifier <?php echo $titleImputation; ?> objet(s) de l'imputation</h5>

                                    <div class="col s12 input-field">
                                        <label>Choisissez <?php echo $titleImputation; ?></label><br>
                                          <select multiple="multiple" name="imputation-selection-resp[]" id="alter-service-admin-select">
                                           <option value="" disabled selected="">Non définie</option>
                                              <?php if($_SESSION['AuthClient']->idService>2) :?>
                                                <?php foreach ($_SESSION['ImpResp'] as $key => $value): ?>
                                                  <option value="<?php echo $value->id; ?>"><?php  $desc=$value->fonction; echo $value->nom." ".$value->prenom."({$desc})"; ?></option>
                                                <?php endforeach; ?>
                                              <?php endif; ?>

                                               <?php if($_SESSION['AuthClient']->idService==2) :?>
                                                <?php foreach ($_SESSION['recupResponsible'] as $key => $value): ?>
                                                  <option value="<?php echo $value->id; ?>"><?php
                                                  $desc=$value->fonction;
                                                   echo $value->nom." ".$value->prenom."({$desc})"; ?></option>
                                                <?php endforeach; ?>
                                               <?php  endif; ?>
                                          </select>
                                    </div>

                                    <button type="submit" class="modal-action modal-close btn submit-button left" id="imp-submit">Imputer</button>
                                    <button type="reset" class="modal-action modal-close btn submit-button right" id="imp-cancel" >Annuler</button>

                                    <input type="hidden" name="suivi-courrier-imputation" id="suivi-courrier-imputation-id" value="<?php echo $idCourrier; ?>">
                                    <input type="hidden" value="49" name="admin-control">
                                    <input type="hidden" name="pathFile" value="<?php echo $_REQUEST['pathPdf']; ?>"> 
                                </form>
        </div>
  </div>



              <!--Box Revoke-Imputation -->
  <div id="Revoke-Imputation-box" class="modal white center-align">
        <div class="modal-content accc-row-padding">
            <p class="logo-wrapper-circle-account">
              <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
          </p>
              <?php 
                  if($_SESSION['AuthClient']->idService==2)
                  {
                    $titleImputation=" une/plusieurs entité(s)";
                  }
                  if($_SESSION['AuthClient']->idService==3)
                  {
                    $titleImputation="un/plusieurs Chef(s) de service";
                  }
                  if($_SESSION['AuthClient']->idService==4)
                  {
                    $titleImputation="un/plusieur(s) Agent(s)";
                  }
               ?>
                            <form id="imputation-form-revoke" class="dash-form accc-row-padding">
                                    <h5 class="accc-color bold game-bottom-small-padding">Veuillez spécifier <?php echo $titleImputation; ?> objet(s) de la révocation de l'imputation</h5>

                                    <div class="col s12 input-field">
                                        <label>Choisissez <?php echo $titleImputation; ?></label><br>
                                          <select multiple="multiple" name="imputation-selection-resp[]" id="revoke-select">
                                           <option value="" disabled selected="">Non définie</option>
                                              <?php if($_SESSION['AuthClient']->idService>2) :?>
                                                <?php foreach ($_SESSION['revokResp'] as $key => $value): ?>
                                                  <option value="<?php echo $value->id; ?>"><?php $desc=$value->fonction; echo $value->nom." ".$value->prenom."({$desc})"; ?></option>
                                                <?php endforeach; ?>
                                              <?php endif; ?>

                                               <?php if($_SESSION['AuthClient']->idService==2) :?>
                                                <?php foreach ($_SESSION['recupRevokeResponsible'] as $key => $value): ?>
                                                  <option value="<?php echo $value->id; ?>"><?php
                                                      $desc=$value->fonction;
                                                   echo $value->nom." ".$value->prenom."({$desc})"; ?></option>
                                                <?php endforeach; ?>
                                               <?php  endif; ?>
                                          </select>
                                    </div>

                                    <button type="submit" class="modal-action modal-close btn submit-button left" id="imp-revoke-submit">Révoquer imputation</button>
                                    <button type="reset" class="modal-action modal-close btn submit-button right" id="imp-cancel" >Annuler</button>

                                    <input type="hidden" name="suivi-courrier-imputation" id="suivi-courrier-imputation-id" value="<?php echo $idCourrier; ?>">
                                    <input type="hidden" value="60" name="admin-control">
                                    <input type="hidden" name="pathFile" value="<?php echo $_REQUEST['pathPdf']; ?>"> 
                                </form>
        </div>
  </div>


    <!--Main Modal Box Structure -->
  <div id="mainModal-suiviAdmin" class="modal accc-back-color-alt center-align">
        <div class="modal-content">
        <p class="logo-wrapper-circle-account">
            <a href="#" class="brand-logo"><img src="../img/index/dgtcp-logo.jpg" class="game-left-medium-padding"></a>
        </p>
            <h6 class="accc-color modal-text bold acc-small-top-margin"></h6>
        </div>
        <div class="modal-footer accc-back-color">
            <a href="#!" class="modal-action white-text modal-close waves-effect waves-green bold" id="reload-page-flex">OK</a>
        </div>
  </div>

        <div class="row center hidden accc-row-padding white" id="preloader-wrapper-imputation">   
                        <div class="loaderAjaxImp acc-medium-top-margin">
                            <img src="../AjaxLoader/78.gif" />
                        </div>
                    <h4 class="orange-text">Imputation en cours ... Veuillez patienter.</h4>
        </div>

		<div id="documentViewer" class="flexpaper_viewer" style="position:absolute;left:10px;top:10px;width:1200px;height:800px;"></div>
	        
	        <script type="text/javascript">

             $('select').material_select();

	            
	            var numPages 			= 3;

                var flexDocument=$("#documentViewer");

                function saveAnnotatedPDF(){
                    var doc = createjsPDFDoc($FlexPaper('documentViewer').getMarkList(),numPages);

                    $.post( "services/annotate.php", { 'doc' : 'FlexPaper Annotations API', 'subfolder' : '', 'stamp' :  doc.output('datauristring')},function(data){
                        if(data.indexOf("[Error") == -1){
                           $("body").append("<iframe src='" + data + "' style='display: none;' ></iframe>");
                        }else{
                            alert(data);
                        }
                    });
                }


		        
				jQuery.get((!window.isTouchScreen)?'UI_flexpaper_desktop_flat.html':'UI_flexpaper_mobile.html',
                 function(toolbarData) {


                         flexDocument.FlexPaperViewer(
                            {config: {
                            //SWFFile               :   './013587b3037315606268e0db15523601.swf',
                            PDFFile                 :   "../suiviAdmin/suiviAdmin-img/courriers/<?php echo $_REQUEST['pathPdf']; ?>",
                            Scale                   : 0.6,
                            ZoomTransition          : 'easeOut',
                            ZoomTime                : 0.5,
                            ZoomInterval            : 0.2,
                            FitPageOnLoad           : true,
                            FitWidthOnLoad          : false,
                            FullScreenAsMaxWindow   : false,
                            ProgressiveLoading      : false,
                            MinZoomSize             : 0.2,
                            MaxZoomSize             : 5,
                            SearchMatchAll          : false,
                            StickyTools             : true,

                            Toolbar                 : toolbarData,

                            BottomToolbar           : 'UI_flexpaper_annotations.html',

                            InitViewMode            : 'Portrait',
                            RenderingOrder          : 'html5,flash',
                            StartAtPage             : '',

                            ViewModeToolsVisible    : true,
                            ZoomToolsVisible        : true,
                            NavToolsVisible         : true,
                            CursorToolsVisible      : true,
                            SearchToolsVisible      : true,

                            UserCollaboration       : true,
                            CurrentUser             : "<?php echo $_SESSION['AuthClient']->nom." ".$_SESSION['AuthClient']->prenom; ?>",

                            WMode                   : 'window',
                            localeChain             : 'en_US'
                            } }
                        ).bind('onDocumentLoaded',function(){
                                loadAnnotations();
                                markRead();
                            });                    

                     	 $('#documentViewer').bind('onMarkCreated',function(e,mark){
                                mark.refNoteContent="<?php echo $_REQUEST['pathPdf'];?>";
                                mark.idResponsible="<?php echo $_SESSION['AuthClient']->id;?>";
                                var Annotation=JSON.stringify(mark);
                                var actionNote=1;
                                $.ajax({
                                    type:"POST",
                                    data:"Annotation="+Annotation+"&actionNote="+actionNote,
                                    url:'../serverTraitor/annotation.php',
                                    error : function(){ alert("La note n'a pas pu être renseignée dans la base. Veuillez réessayer");}
                                });

                         });

                        $('#documentViewer').bind('onMarkChanged',function(e,mark){
                                var Annotation=JSON.stringify(mark);
                                var actionNote=2;
                                $.ajax({
                                    type:"POST",
                                    data:"Annotation="+Annotation+"&actionNote="+actionNote,
                                    url:'../serverTraitor/annotation.php',
                                    error : function(){ alert("La note n'a pas pu être renseignée dans la base. Veuillez réessayer!");}
                                });
                         });


                         $('#documentViewer').bind('onMarkDeleted',function(e,mark){
                                var Annotation=JSON.stringify(mark);
                                var actionNote=3;
                                $.ajax({
                                    type:"POST",
                                    data:"Annotation="+Annotation+"&actionNote="+actionNote,
                                    url:'../serverTraitor/annotation.php',
                                    error : function(){ alert("La note n'a pas pu être renseignée dans la base. Veuillez réessayer!");}
                                });
                         });


                        function loadAnnotations(){
                             var actionNote=4;
                             $.post( "../serverTraitor/annotation.php", {'refNote':'<?php echo $_REQUEST['pathPdf']; ?>','actionNote':actionNote} , function(data){
                                    if(data!==0)
                                        {
                                                        var result=JSON.parse(data);
                                                        var idResponsible=<?php echo $_SESSION['AuthClient']->id; ?>;
                                                        $.each(result,function(index,value){
                                                            var content = value.content || '';
                                                            var parseContent=JSON.parse(content);
                                                            if (idResponsible!==parseContent.idResponsible) 
                                                                 parseContent.readonly=true;
                                                            $FlexPaper('documentViewer').addMark(parseContent);
                                                        });
                                            
            
                                        }
                              });  
                        }

                        function markRead(){
                            var $MarkPdf="<?php echo $pfdPath;  ?>";
                                        $.ajax({
                                        type : 'POST',
                                        url : '../serverTraitor/suiviAdmin.php',
                                        dataType:'text',
                                        data:"idCourrier="+<?php echo $idCourrier; ?>+"&admin-control="+58+"&piece="+$MarkPdf,
                                        success:function(data){
                                        },
                                        error: function(){}   
                                });
                        }
                 });

	        </script>

            <div style="position:absolute;left:830px;top:10px;font-family:Arial;font-size:12px">
                            </div>
   </body> 
</html> 
<?php else : ?>
    <?php header("Location:/suiviAdmin/"); ?>
<?php   endif; ?>

<?php else : ?>
    <?php header("Location:/suiviAdmin/"); ?>
<?php endif; ?>