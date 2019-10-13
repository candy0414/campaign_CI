$(document).ready(function(){
	var str = $("textarea[name='defaultText1']").val();
	console.log(str);
	console.log($("input[name='employee_url']").val());
	var res = str.replace(" {{Employee URL}}", $("input[name='employee_url']").val());
	$("textarea[name='defaultText1']").text(res);
	res = res.replace("{{password for Employee}}", $("input[name='defaultEmployeePassword']").val());
	$("textarea[name='defaultText1']").text(res);
});