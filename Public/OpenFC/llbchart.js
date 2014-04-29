var request;//ajax
var data;
//var time=0;//当前播放时间
var url;
var curHost=window.document.location.host; //得到当前的ip地址
var intervalId;//当前interval的id号
var initSize=50;//显示数据的条数
var count;//当前的显示条数

var initYValues=new Array();//initSize);  
var initXLabels=new Array();
var newdata={
	"elements":[
		{
			"type":"line",
			"values":initYValues,
			"colour":"#FF8040",
			"text":"\u6d4b\u91cf\u5747\u503c",
			"font-size":12,
			"dot-style":{
				"type":"solid-dot",
				"dot-size":4,
				"colour":"#61F946",
				"tip":"#x_label#\u7684\u76d1\u6d4b\u5747\u503c\uff1a#val#"
				}
		}],
	"bg_colour":"#b0F0FF",
	"title":{"text":"\u6865\u6881\u9707\u52a8\u76d1\u6d4b 2014-04"},
	"y_axis":
		{
			"min":0,
			"max":180,
			"steps":10
		},
	"x_axis":
		{
			"labels":initXLabels
		},
	"x_legend":
		{
			"text":"\u76d1\u6d4b\u65f6\u95f4\/\u5929",
			"style":"{font-size:15px;color:#0000ff;text-align:center;}"
		},
	"y_legend":
		{
			"text":"Fail to display rotated Chinese",
			"style":"{font-size:15px;color:#0000ff;text-align:top;}"
		},
	"tooltip":{"background":"#C8F9C8"}
};

for(var i=0;i<10;i++){  
   initYValues[i]=i;  
   initXLabels[i]=i;  
};

//开始监控
function reloadData(){
	//findSWF("chart").load(JSON.stringify(newdata));
	if(intervalId!=null){
		clearInterval(intervalId);//停止监控
	}
	count=initYValues.length;

	CKobject.getObjectById('ckplayer_a1').ckplayer_play();//开始播放

	intervalId=window.setInterval("update()", 250); //定时刷新数据
	//return "";
}
function ckplayer_status(){
	alert("currenttime");
	if(str=='video:play'){
		//setInterval('getstart()',1000);
	}
}
//定时更新数据
function update(){
	var currentplaytime=CKobject.getObjectById('ckplayer_a1').ckplayer_getstatus().time;//当前播放时间
	var playstatus=CKobject.getObjectById('ckplayer_a1').ckplayer_getstatus().play;//播放状态
	/*if(currentplaytime!=null){
		alert("currenttime"+currentplaytime+" playstatus="+playstatus);
	}*/
	if(!playstatus){
		return;
	}
	if(count<initSize){
		//initXLabels.push("8");
		//initYValues.push(Math.random()*80);//插入新数值
		initYValues.push(parseFloat(currentplaytime));
		count++;//计数加一
		//alert(count);
	}else{
		//alert("超了喔");
		initYValues.shift();
		//initYValues.push(Math.random()*80);
		initYValues.push(parseInt(currentplaytime))
		//window.clearInterval(intervalId);
	}
	
	newdata.elements[0].values=initYValues; 
	var swf=findSWF("chart");
	swf.load(JSON.stringify(newdata));
}



function drawline(i){
	if(i==0){
		//url="Home/Chart/chart"
		//url="index.php/Home/Chart/chart";
		url="http://"+curHost+"/monitor/index.php/Home/Chart/chart";
	}else{
		url="Application/OFC/data5.php"
	}
	swfobject.embedSWF(
	"/monitor/Public/OpenFC/open-flash-chart.swf",
	"llb",
	"800",
	"400",
	"9.0.0",
	"expressInstall.swf",
	{"save_image_message":"把图形保存为图片","loading":"正在加载中..."},{},{id:"chart"});//默认函数
	//alert("drawline()"+url);
}
function stopDrawLine(){
	if(intervalId!=null){
		clearInterval(intervalId);//停止监控
		CKobject.getObjectById('ckplayer_a1').ckplayer_pause();//暂停播放
	}
}
function ofc_ready()
{
    //alert('ofc_ready');
	//findSWF("chart").load(open_flash_chart_data());
	//var a=window.setInterval(update(), 5000); 
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
		//alert("取得数据成功"+request.responseText);
		data=request.responseText;
		findSWF("chart").load(data);
	}
	//alert("取得数据失败readyState="+request.readyState);//" status="+request.status);
}

//{"data-file":"data4.php"}这种方法可行，优先级低于ofc=data4.php
function findSWF(movieName) {
  if (navigator.appName.indexOf("Microsoft")!= -1) {
//	  alert("findSWF1"+window["ie_" + movieName]);
    return window[movieName];//"ie_" + 
  } else {
//	  alert("findSWF2"+ document[movieName]);
    return document[movieName];
  }
}
function createRequest() {
//	alert("initializing XMLHttpRequest!");
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
/* 点击右键菜单项中的“Save_Image_Locally”选项时触发  
function save_image() {  
    $("input[name='imgBase64Code']").val(findSWF("chart").get_img_binary());  
    $("#savePicForm").submit();  
}*/  
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
