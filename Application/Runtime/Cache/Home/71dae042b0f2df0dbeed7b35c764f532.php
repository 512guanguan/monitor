<?php if (!defined('THINK_PATH')) exit();?><html>
<head><meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<script type="text/javascript" src="/monitor/Public/OpenFC/swfobject.js"></script>
<script type="text/javascript" src="/monitor/Public/OpenFC/llbchart.js"></script>
</head>
<body onload="drawline(0)">
<p>我要在下面显示内容</p><br/>
<div id="llb"></div><br/>
<p>画图类型(0 or 1)<input type="text" id="page"><button onclick="reloadData(0)">画图</button></p><br/>
<p>设计标题<input type="text" id="title"><button onclick="setTitle()">重命名</button></p><br/>
 <a href="javascript:setTitle();">set title</a>
<!--div style="width:400; height: 350px; border: 5px solid #D1EFD1;" id="llb1"-->
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
</body>
</html>