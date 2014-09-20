
function getTitle(){
	var url = $("#url").val();
	if (url!="" && /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.test(url)) {
		$.get("ajax/gettitle.ajax.php", {url:url},function(data){
			$("#title").val(data);
			});
	}
}