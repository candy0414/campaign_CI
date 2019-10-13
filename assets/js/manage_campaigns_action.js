$(document).ready(function(){
	$('.view_report').click(function(){
		// console.log($(this).data("name"));
		var campaignName = $(this).data("name");
		var clientName = $(this).data("value");
		var c_id = $(this).data('id');
		// window.location.href = ""+campaignName+"/report";
		$.ajax({
		  type: 'post',
		  url: "../manage_campaigns/setC_id",
		  data: {
		    c_id: c_id
		  },
		  success: function(result){
		    console.log(result);
		    // location.reload();
		    window.location.href = ""+campaignName+"/report";
		  }
		});

	});
	$('.view_campaign').click(function(){
		var campaignName = $(this).data("name");
		// window.location.href = ""+campaignName+"/view_campaign";
		var c_id = $(this).data('id');
		$.ajax({
		  type: 'post',
		  url: "../manage_campaigns/setC_id",
		  data: {
		    c_id: c_id
		  },
		  success: function(result){
		    console.log(result);
		    // location.reload();
		    window.location.href = ""+campaignName+"/view_campaign";
		  }
		});
	});
	$('.edit_campaign').click(function(){
		var campaignName = $(this).data("name");
		// window.location.href = ""+campaignName+"/edit";
		var c_id = $(this).data('id');
		$.ajax({
		  type: 'post',
		  url: "../manage_campaigns/setC_id",
		  data: {
		    c_id: c_id
		  },
		  success: function(result){
		    console.log(result);
		    // location.reload();
		    window.location.href = ""+campaignName+"/edit";
		  }
		});
	});
	$('.delete_campaign').click(function(){
		console.log("came");
		var campaignName = $(this).data("name");
		var c_id = $(this).data('id');
		$.ajax({
		  type: 'post',
		  url: '../manage_campaigns/deleteCampaign/',
		  data: {
		    c_id: c_id
		  },
		  success: function(result){
		    console.log(result);
		    location.reload();
		  }
		});
	});

	$('.stop_campaign').click(function(){
		var campaign_id = $(this).data('id');
		var flag = $(this).data('flag');

		$.ajax({
		  type: 'post',
		  url: '../manage_campaigns/stopCampaignAPI/',
		  data: {
		    campaign_id: campaign_id
		  },
		  success: function(result){
		    console.log(result);
		    // location.reload();
		  }
		});

		if(flag == "PENDING_REVIEW") {
			var c_id = $(this).data('c_id');
			console.log(c_id);
			$('.delete_campaign[data-id="'+c_id+'"]').click();
		}
		console.log(c_id);
		console.log(campaign_id);
		
	});

	$('.pause_campaign').click(function(){
		
		var campaign_id = $(this).data('id');
		console.log(campaign_id);
		$.ajax({
		  type: 'post',
		  url: '../manage_campaigns/pauseCampaignAPI/',
		  data: {
		    campaign_id: campaign_id
		  },
		  success: function(result){
		    console.log(result);
		    location.reload();
		  }
		});
	});

	$('.resume_campaign').click(function(){
		
		var campaign_id = $(this).data('id');
		console.log(campaign_id);
		$.ajax({
		  type: 'post',
		  url: '../manage_campaigns/resumeCampaignAPI/',
		  data: {
		    campaign_id: campaign_id
		  },
		  success: function(result){
		    console.log(result);
		    location.reload();
		  }
		});
	});

});
