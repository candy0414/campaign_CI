$(document).ready(function(){
	$('.ui.dropdown')
	  .dropdown({
	    allowAdditions: true
	});
	$('#manage_campaign').click(function(){
		var e = document.getElementById("select_client");
		var client = e.options[e.selectedIndex].value;
		console.log(client);
		// $.ajax({
		//   type: 'post',
		//   url: 'client_management/manage_campaigns?>',
		//   data: {
		//     clientname: client
		//   },
		//   success: function(result){
		//     console.log(result);
		//   }
		// });
		window.location.href = ""+client+"/campaigns";
	});
	$('#delete_client').click(function(){

		var e = document.getElementById("select_client");
		var client = e.options[e.selectedIndex].value;
		console.log(client);
		$.ajax({
		  type: 'post',
		  url: 'client_management/deleteClient/'+client,
		  data: {
		    clientname: client
		  },
		  success: function(result){
		    console.log(result);
		    location.reload();
		  }
		});

	});
});
