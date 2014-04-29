var request;//ajax
var data;
var time=0;
var url;
function createRequest() {
	alert("initializing XMLHttpRequest!");
  try {
    request = new XMLHttpRequest();
  } catch (trymicrosoft) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (othermicrosoft) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (failed) {
        request = false;
      }
    }
  }
  if (!request)
    alert("Error initializing XMLHttpRequest!");
}
function drawline(i){
	if(i==0){
		//url="Application/OFC/data4.php"
		url="index.php/Home/Chart/chart"
	}else{
		url="Application/OFC/data5.php"
	}
	swfobject.embedSWF(
	"/monitor/Public/OpenFC/open-flash-chart.swf",
	"llb",
	"400",
	"300",
	"9.0.0",
	"expressInstall.swf",
	{"data-file":"data.json"},{},{id:"chart"});//默认函数
	alert("drawline()"+url);
}
function ofc_ready()
{
    alert('ofc_ready');
	//findSWF("chart").load(open_flash_chart_data());
	//setInterval(function (){update();}, 2000);  
}

function open_flash_chart_data() {
	createRequest();//ajax初始化请求
	alert( 'reading data'+request);
	request.open("GET",url, true);
	request.onreadystatechange = ofc_return;
	request.send();
	return "";
	//data={"elements" : [{"type" : "bar","text" : "\u5317\u4eac","values" : [9.9355,9.9355,9.9355]}]};
	//return JSON.stringify(data);
}
function ofc_return(){
	//alert( 'ofc_return' );
	if (request.readyState == 4){
		alert("取得数据成功"+request.responseText);
		data=request.responseText;
		findSWF("chart").load(data);
	}
	//alert("取得数据失败readyState="+request.readyState);//" status="+request.status);
}

//{"data-file":"data4.php"}这种方法可行，优先级低于ofc=data4.php
function reloadData(){
	var i=document.getElementById("page").value;
	if(i==0){
		//url="Application/OFC/data4.php"
		url="index.php/Home/Chart/chart"
	}else{
		url="Application/OFC/data5.php"
	}
	createRequest();//ajax初始化请求
	alert( 'reload data'+request);
	request.open("GET",url, true);
	request.onreadystatechange = ofc_return;
	request.send();
	return "";
}
function setTitle(){
	var title=document.getElementById("title").value;
	alert(title);
	set_title(title);
}
function findSWF(movieName) {
  if (navigator.appName.indexOf("Microsoft")!= -1) {
	  alert("findSWF1"+window["ie_" + movieName]);
    return window[movieName];//"ie_" + 
  } else {
	  alert("findSWF2"+ document[movieName]);
    return document[movieName];
  }
}

/** 点击右键菜单项中的“Save_Image_Locally”选项时触发  
function save_image() {  
    $("input[name='imgBase64Code']").val(findSWF("chart").get_img_binary());  
    $("#savePicForm").submit();  
}  
*/
/**

<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
        codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
        width="500"
		height="550" id="ie_chart" align="middle">
	<param name="allowScriptAccess" value="always" />
	<param name="movie" value="open-flash-chart.swf" />
	<param name="quality" value="high" />
	<!--IE内核会调用上面的配置                火狐自动调用的是下面的配置 -->>
	<embed src="open-flash-chart.swf" mce_src="open-flash-chart.swf"
		   quality="high"
		   bgcolor="#FFFFFF"
		   width="500"
		   height="350"
		   name="open-flash-chart"
		   align="middle"
		   allowScriptAccess="always"
		   type="application/x-shockwave-flash"
		   pluginspage="http://www.macromedia.com/go/getflashplayer" 
		   id="chart"/>
</object>
*/