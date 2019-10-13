$(document).ready(function(){
	$('#searchButton').click(function(){
		var keywords = $("input[name='keywords']").val();
		// console.log(keywords);
		var realKeywords = $("input[name='realKeywords']").val();
		if(keywords == realKeywords) {
			alert('Keyword is a match');
			window.open("../task/goSearch/"+keywords+"/"+$("input[name='search_engine']").val(), '_blank');
			$('#from3').css('display','block');
		}
		else{
			alert('Keyword is not a match');
		}
	});
	$('#submitUrl').click(function(){

		var site_url = $("input[name='site_url']").val();
		var real_site_url = $("input[name='real_site_url']").val();
		var lengthOfUrl = real_site_url.length;
		// console.log(real_site_url[lengthOfUrl-1]);
		if(real_site_url[lengthOfUrl-1] == '/') {
			real_site_url = real_site_url.substring(0, lengthOfUrl-1);
			lengthOfUrl--;
		}
		var str = site_url.substring(0, lengthOfUrl);
		// console.log(str);

		if(str == real_site_url) {
			
			var timeLeft = 30;
		    var elem = document.getElementById('some_div');
		    
		    var timerId = setInterval(countdown, 1000);
		    
		    function countdown() {
		      if (timeLeft == -1) {
		      	$('#from5').css('display','block');
		      	elem.innerHTML = "";
		        clearTimeout(timerId);
		        
		      } else {
		        elem.innerHTML = timeLeft + ' seconds remaining';
		        timeLeft--;
		      }
		    }
		}
		else{
			alert('Page URL is not correct.');
		}
	});
	$('#submit_v_url').click(function(){

		var v_url = $("input[name='VerifyUrl']").val();
		var real_v_url = $("input[name='realVerifyUrl']").val();
		var str;
		var strstr;
		var reststr;

		if(v_url.length > real_v_url.length) {
			str = v_url.substring(0, real_v_url.length);
			strstr = real_v_url;
			reststr = v_url[v_url.length -1];
			// console.log(reststr);
		}
		if(v_url.length < real_v_url.length){
			str = real_v_url.substring(0, v_url.length);
			strstr = v_url;
			reststr = real_v_url[real_v_url.length -1];
			// console.log(reststr);
		}
		if(v_url.length == real_v_url.length) {
			str = v_url;
			strstr = real_v_url;
			reststr = '/';
		}
		if(str == strstr && reststr == '/') {
			// window.location.href = "../"+$("input[name='employee_url']").val()+"/completion";

			$.ajax({
			  type: 'post',
			  url: "../task/updateReport/"+$("input[name='employee_url']").val(),
			  data: {
			    site_url: $("input[name='site_url']").val()
			  },
			  success: function(result){
			    // console.log(result);
			    // location.reload();
			    window.location.href = "../"+$("input[name='employee_url']").val()+"/completion";
			  }
			});
		}

		else{
			alert('Verify URL is not correct');
		}
	});
});