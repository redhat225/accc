$(document).ready(function(){$.ajaxSetup({error:function(){alert("Une érreur s'est produite veuillez réessayer")},timeout:3e5,type:"POST",dataType:"text",url:"../serverTraitor/accc-client.php"}),$("#recovery-admin-acc").on("submit",function(e){e.preventDefault();var t=!0;if($("input.required",this).each(function(){0==validateElement.isValid(this)&&(t=!1)}),!t)return!1;var a=$(this);$.ajax({beforeSend:function(){$(".loaderAjax").fadeIn(),$("#submit-recovery").fadeOut()},data:a.serialize(),success:function(e){$("#Recovery-Modal h6").text(e),$("#Recovery-Modal").openModal()},complete:function(){$(".loaderAjax").fadeOut(),$("#submit-recovery").fadeIn()}})}),$("#login-client-acc").on("submit",function(e){e.preventDefault();var t=!0;if($("input.required",this).each(function(){0==validateElement.isValid(this)&&(t=!1)}),!t)return!1;var a=$(this);$.ajax({beforeSend:function(){$(".loaderAjax").fadeIn(),$("#submit-login-client").fadeOut()},data:a.serialize(),success:function(e){$("#stateTreatment h6").text(e),$("#stateTreatment").openModal()},complete:function(){$(".loaderAjax").fadeOut(),$("#submit-login-client").fadeIn()}})}),$("#recovery-reset").on("submit",function(e){e.preventDefault();var t=!0;$("input.required",this).each(function(){0==validateElement.isValid(this)&&(t=!1)});var a=$("#recovery-reset-pass").val(),n=$("#recovery-reset-confirm").val();if(a!=n&&(t=!1,alert("Les deux mots de passe ne sont pas identiques")),!t)return!1;var i=$(this);$.ajax({beforeSend:function(){$(".loaderAjax").fadeIn(),$("#submit-reset-button").fadeOut()},data:i.serialize(),success:function(e){$("#Reset-Modal h6").text(e),$("#Reset-Modal").openModal()},complete:function(){$(".loaderAjax").fadeOut(),$("#submit-reset-button").fadeIn()}})}),$("#login-admin-acc").on("submit",function(e){e.preventDefault();var t=!0;if($("input.required",this).each(function(){0==validateElement.isValid(this)&&(t=!1)}),!t)return!1;var a=$(this);$.ajax({beforeSend:function(){$(".loaderAjax").fadeIn(),$("#submit-login-admin").fadeOut(),$("span#error-login-admin-content").fadeOut()},data:a.serialize(),success:function(e){"ko"==e&&$("span#error-login-admin-content").text("La combinaison login/mot de passe est incorrect, veuillez réessayer").fadeIn(),"ok"==e&&($("span#error-login-admin-content").text("").fadeOut(),window.location.href="index.php?p=compte"),"ok"!==e&&"ko"!==e&&($("span#error-login-admin-content").text("").fadeOut(),window.location.href="../simple_flex/index.php?pathPdf="+e)},complete:function(){$(".loaderAjax").fadeOut(),$("#submit-admin-client").fadeIn()}})})}),validateElement={isValid:function(e){var t=!0,a=$(e),n=(a.attr("id"),a.attr("name"),a.val()),i=a[0].type.toLowerCase();switch(i){case"text":/^[a-z0-9_-]{8,25}$/i.test(n)||(t=!1);break;case"file":""==n&&(t=!1);break;case"password":/^[a-z0-9_-]{8,25}$/i.test(n)||(t=!1);break;case"number":(!/^[0-9]{1,9}$/.test(n)||0>n||""===n||0==n)&&(t=!1);break;case"textarea":0==n.length||0==n.replace(/\s/g,"").length?t=!1:/^[a-z0-9\s-!?()éè&àùê'./]{2,150}$/i.test(n)||(t=!1);break;case"email":/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/i.test(n)||(t=!1);break;case"tel":/^([0-9]{2}){4}$/.test(n)||(t=!1)}var r=t?"valid":"invalid";return t?a.removeClass("invalid").addClass(r):a.removeClass("valid").addClass(r),a.unbind("change.isValid").bind("change.isValid",function(){validateElement.isValid(this)}),t}};