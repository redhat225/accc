$(document).ready(function(){$("ul#game-gift-menu li a:eq(0)").trigger("click"),$.ajaxSetup({cache:!0,error:function(){alert("Une érreur s'est produite veuillez réessayer")},timeout:3e5}),$(".hide-left-panel").trigger("click")}),$("#push-message-list-element").on("click",function(){$(this).find("#badge-set").removeClass("new badge").text("")}),$("#task-list-element").on("click",function(){$(this).find("#new-task-badges").removeClass("new badge").text("")}),$("#cr-list-element").on("click",function(){$(this).find("#new-cr-badges").removeClass("new badge").text("")}),$("#suggest-list-elment").on("click",function(){$(this).find("#new-suggest-badges").removeClass("new badge").text("")}),$("ul#game-gift-menu li a").on("click",function(){$(this).parent().parent().find("li").removeClass("actived"),$(this).parent().addClass("actived")}),$("ul#game-gift-menu,ul#bubble-menu-admin").find("li:not(:last-child)").on("click",function(e){e.preventDefault();var t=$(this).find("a").attr("href");$("a.back-panel").attr("href","suivi-general-desktop"),$("a.refresh-assets").attr("href",t),$.post("View/Account-View/index.php",{ssPage:t},function(e){$("#game-gift-variable-content").empty().append(e)})}),$("#bubble-menu-admin").on("click",function(e){e.preventDefault();var t="suivi-general-desktop";$("a.refresh-assets").attr("href",t),$.post("View/Account-View/index.php",{ssPage:t},function(e){$("#game-gift-variable-content").empty().append(e)})}),$("a.refresh-assets").on("click",function(e){e.preventDefault();var t=$(this).attr("href");$.post("View/Account-View/index.php",{ssPage:t},function(e){$("#game-gift-variable-content").empty().append(e)})}),$(".choice-general").on("click",function(){$("a.back-panel").attr("href","suivi-general-desktop")}),$("a.back-panel").on("click",function(e){e.preventDefault();var t=$(this).attr("href");$.post("View/Account-View/index.php",{ssPage:t},function(e){$("#game-gift-variable-content").empty().append(e),$("a.back-panel").attr("href","suivi-general-desktop")})}),$("a.refresh-general-desktop").on("click",function(e){e.preventDefault();var t="suivi-general-desktop";$.post("View/Account-View/index.php",{ssPage:t},function(e){$("#game-gift-variable-content").empty().append(e)})}),$(".hide-left-panel").on("click",function(){$("#side-control-panel").toggleClass("hidden"),$("#game-gift-variable-content").toggleClass("l10").toggleClass("l12"),$(this).find(".custom-hidder").toggleClass("ion-ios-undo").toggleClass("ion-ios-redo"),$(this).toggleClass("resizing-hidder-side-panel"),$(".transparents-assets1").toggleClass("replace-transparent-assets1"),$(".transparents-assets2").toggleClass("replace-transparent-assets2")}),$(".hide-left-panel-med-small-device").on("click",function(){$("#side-control-panel").toggleClass("hidden"),$(this).find(".custom-hidder").toggleClass("ion-arrow-up-b").toggleClass("ion-arrow-down-b"),$(this).toggleClass("resizing-hidder-side-panel")});