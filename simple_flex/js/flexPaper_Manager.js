$(document).ready(function(){

		$("#imputation-button").on('click',function(e){
			e.preventDefault();
			$("#selectRespImputation").openModal({
				dismissible:false
			});
		});

		$("#imp-submit").on('click',function(e){
			e.preventDefault();
			
			var isErrorFree= true;
			var $form =$("#imputation-form");



				if(isErrorFree)
				{
					$.ajax({
						beforeSend : function(){
							$("#preloader-wrapper-imputation").fadeIn();
						},
						data:$form.serialize(),
						url:"../serverTraitor/suiviAdmin.php",
						type:'POST',
						dataType:"text",
						success: function(data){
								$('#mainModal-suiviAdmin h6.modal-text').text(data);
								$('#mainModal-suiviAdmin').openModal({
									dismissible:false
								});
								$("#reload-page-flex").on("click",function(){
									window.location.reload();
								});
								
						},
						complete : function(){
							$("#preloader-wrapper-imputation").fadeOut();
						},
						error:function(){
								$('#mainModal-suiviAdmin h6.modal-text').text("Une erreur est survenue veuillez-vous reconnecter");
								$('#mainModal-suiviAdmin').openModal();
						}
						
					});
				}
				else
					return false;
		});

		$("#revoke-imputation-button").on('click',function(e){
				e.preventDefault();
				$("#Revoke-Imputation-box").openModal({
						dismissible:false
				});
		});



		$("#imp-revoke-submit").on('click',function(e){
			e.preventDefault();
			
			var isErrorFree= true;
			var $form =$("#imputation-form-revoke");

				if(isErrorFree)
				{
					$.ajax({
						beforeSend : function(){
							$("#preloader-wrapper-imputation").fadeIn();
						},
						data:$form.serialize(),
						url:"../serverTraitor/suiviAdmin.php",
						type:'POST',
						dataType:"text",
						success: function(data){
								$('#mainModal-suiviAdmin h6.modal-text').text(data);
								$('#mainModal-suiviAdmin').openModal({
									dismissible:false
								});
								$("#reload-page-flex").on("click",function(){
									window.location.reload();
								});
						},
						complete : function(){
							$("#preloader-wrapper-imputation").fadeOut();
						},
						error:function(){
								$('#mainModal-suiviAdmin h6.modal-text').text("Une erreur est survenue veuillez-vous reconnecter");
								$('#mainModal-suiviAdmin').openModal();
						}
						
					});
				}
				else
					return false;
		});

		


  $('.fixed-action-btn').openFAB();
});