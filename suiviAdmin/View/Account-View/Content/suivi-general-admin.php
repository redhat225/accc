<div class="row center">
<i class="ion-podium accc-color accc-huge-icon"></i>
<h4>Statistiques</h4>
	<canvas id="myChart" width="400" height="400"></canvas>
</div>
<script src="../js/nnnick/chartjs/Chart.js"></script>
<script>
	$(document).ready(function(){
		var ctx = $("#myChart").get(0).getContext("2d");
		var data = [
				    {
				        value:  500 ,
				        color: "green",
				        highlight: "grey",
				        label: "Tickets Attribués"
				    },
				    {
				    	value: 500,
				        color:"orange",
				        highlight: "grey",
				        label: "Tickets Gagnés"
				    }
				];

			var myNewChart = new Chart(ctx).Doughnut(data,{animationSteps : 0}) ;		
			
	});

</script>