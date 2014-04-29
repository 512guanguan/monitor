//抓图
OFC = {};
OFC.jquery = {
	name: "jQuery",
	version: function(src) { return $('#' + src)[0].get_version() },
	rasterize: function(src, dst) {$('#' + dst).replaceWith(OFC.jquery.image(src)) },
	image: function(src) { return "<img src='data:image/png;base64," + $('#' + src)[0].get_img_binary() + "' />" },
	popup: function(src) {
		var img_win = window.open('', 'Image')
		with (img_win.document) {
			write('<html><head><title>生成的图片</title></head><body>' + OFC.jquery.image(src) + '</body></html>')
		}
		img_win.document.close();
	}
}
if (typeof (Control == "undefined")) { var Control = { OFC: OFC.jquery} }
 
function save_image() { 
	alert("保存图片");
	OFC.jquery.popup("chart"); //这个不是div的id，而是swf的id 不知道为何在IE里面不会弹出来，擦
    //$("input[name='imgBase64Code']").val(findSWF("chart").get_img_binary());  
    //$("#savePicForm").submit();  
}