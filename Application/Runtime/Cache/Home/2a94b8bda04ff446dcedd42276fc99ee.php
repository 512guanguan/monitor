<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<script type="text/javascript" src="/monitor/Public/OpenFC/swfobject.js"></script>
	<script type="text/javascript" src="/monitor/Public/OpenFC/llbchart.js"></script>

	<script type="text/javascript" src="/monitor/Public/OpenFC/jquery-2.1.0for-development.js"></script>
	<script type="text/javascript" src="/monitor/Public/OpenFC/save_image.js"></script>

	<link rel="stylesheet" href="/monitor/Public/css/home.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/monitor/Public/css/reset.css" type="text/css" media="screen">

</head>
<body onload="drawline(0)">
	<!-- 头部 -->
	<!-- 导航条
================================================== -->
<header>
	<div class="border-bot">
		<div class="main">
			<h1><a href="#">运动估计</a></h1>
			<nav>
				<ul class="menu">
					<li><a class="active" onclick="reloadData(0)" >Home</a></li>
					<li><a onclick="reloadData(1)">Events</a></li>
				</ul>
			</nav>
			<div class="clear"></div>
		</div>
	</div>
</header>

	<!-- 右边 -->
	<block name=right>
<div class="main">
	<div class="wrapper">
		<div id="llb" class="wrapper">这是swf不能正常显示时的内容</div><br/>
		<p>画图类型(0 or 1)<input type="text" id="page"><button onclick="reloadData()">开始监控</button>
		<button onclick="stopDrawLine()">停止监控</button></p><br/>
		<p>设计标题<input type="text" id="title"><button onclick="setTitle()">重命名</button></p><br/>
		<input type="button" onclick="OFC.jquery.rasterize('chart', 'zgr')" value="生成图片"></input>
		<div id="zgr">这里用来显示导出的图片</div>


		<div id="video" class="wrapper"><div id ="a1"></div></div></br>
	</div>
</div>
<script type="text/javascript" src="/monitor/Public/ckplayer/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript">
	//如果你不需要某项设置，可以直接删除，注意var flashvars的最后一个值后面不能有逗号
	var videosrc='/monitor/Public/video/testvideo.mp4';
	var flashvars={
		f:videosrc,//'http://movie.ks.js.cn/flv/other/1_0.flv',//视频地址
		a:'',//调用时的参数，只有当s>0的时候有效
		s:'0',//调用方式，0=普通方法（f=视频地址），1=网址形式,2=xml形式，3=swf形式(s>0时f=网址，配合a来完成对地址的组装)
		c:'0',//是否读取文本配置,0不是，1是
		x:'',//调用xml风格路径，为空的话将使用ckplayer.js的配置
		//i:'http://www.ckplayer.com/images/loadimg3.jpg',//初始图片地址
		//d:'http://www.ckplayer.com/down/pause6.1_1.swf|http://www.ckplayer.com/down/pause6.1_2.swf',//暂停时播放的广告，swf/图片,多个用竖线隔开，图片要加链接地址，没有的时候留空就行
		//u:'',//暂停时如果是图片的话，加个链接地址
		//l:'http://www.ckplayer.com/down/adv6.1_1.swf|http://www.ckplayer.com/down/adv6.1_2.swf',//前置广告，swf/图片/视频，多个用竖线隔开，图片和视频要加链接地址
		//r:'',//前置广告的链接地址，多个用竖线隔开，没有的留空
		//t:'10|10',//视频开始前播放swf/图片时的时间，多个用竖线隔开
		y:'',//这里是使用网址形式调用广告地址时使用，前提是要设置l的值为空
		//z:'http://www.ckplayer.com/down/buffer.swf',//缓冲广告，只能放一个，swf格式
		e:'3',//视频结束后的动作，0是调用js函数，1是循环播放，2是暂停播放并且不调用广告，3是调用视频推荐列表的插件，4是清除视频流并调用js功能和1差不多，5是暂停播放并且调用暂停广告
		v:'80',//默认音量，0-100之间
		p:'0',//视频默认0是暂停，1是播放
		h:'0',//播放http视频流时采用何种拖动方法，=0不使用任意拖动，=1是使用按关键帧，=2是按时间点，=3是自动判断按什么(如果视频格式是.mp4就按关键帧，.flv就按关键时间)，=4也是自动判断(只要包含字符mp4就按mp4来，只要包含字符flv就按flv来)
		q:'',//视频流拖动时参考函数，默认是start
		m:'0',//默认是否采用点击播放按钮后再加载视频，0不是，1是,设置成1时不要有前置广告
		o:'',//当m=1时，可以设置视频的时间，单位，秒
		w:'',//当m=1时，可以设置视频的总字节数
		g:'',//视频直接g秒开始播放
		//j:'',//视频提前j秒结束
		//k:'30|60',//提示点时间，如 30|60鼠标经过进度栏30秒，60秒会提示n指定的相应的文字
		//n:'这是提示点的功能，如果不需要删除n和j的值|提示点测试60秒',//提示点文字，跟k配合使用，如 提示点1|提示点2
		wh:'',//这是6.2新增加的宽高比，可以自己定义视频的宽高或宽高比如：wh:'4:3',或wh:'1080:720'
		ct:'2',//6.2新增加的参数，主要针对有些视频拖动时时间出错的修正参数，默认是2，自动修正，1是强制修正，0是强制不修正
		//调用播放器的所有参数列表结束
		//以下为自定义的播放器参数用来在插件里引用的
		my_url:encodeURIComponent(window.location.href)//本页面地址
		//调用自定义播放器参数结束
		};
	var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always'};//这里定义播放器的其它参数如背景色（跟flashvars中的b不同），是否支持全屏，是否支持交互
	var attributes={id:'ckplayer_a1',name:'ckplayer_a1',menu:'false'};
	//下面一行是调用播放器了，括号里的参数含义：（播放器文件，要显示在的div容器，宽，高，需要flash的版本，当用户没有该版本的提示，加载初始化参数，加载设置参数如背景，加载attributes参数，主要用来设置播放器的id）
	//swfobject.embedSWF('/monitor/Public/ckplayer/ckplayer.swf', 'a1', '600', '400', //'10.0.0','/monitor/Public/ckplayer/expressInstall.swf', flashvars, params, attributes);
	CKobject.embedSWF('/monitor/Public/ckplayer/ckplayer.swf','a1','ckplayer_a1','600','400',flashvars,params);
	/*播放器地址，容器id，宽，高，需要flash插件的版本，flashvars,params,attributes
	  如果你因为目前的swfobject和你项目中的存在冲突，不想用swfobject.embedSWF调用，也可以用如下代码进行调用
	  CKobject.embedSWF('ckplayer/ckplayer.swf','a1','ckplayer_a1','600','400',flashvars,params);
	  CKobject.embedSWF(播放器路径,容器id,播放器id/name,播放器宽,播放器高,flashvars的值,其它定义也可省略);
	  此时可以删除ckplayer.js中的最后一行，交互的部分也要改成CKobject.getObjectById('ckplayer_a1')
	*/
	//调用ckplayer的flash播放器结束
	/*
	下面三行是调用html5播放器用到的
	var video='视频地址和类型';
	var support='支持的平台或浏览器内核名称';	
	*/
	var video=['http://movie.ks.js.cn/flv/other/1_0.mp4->video/mp4','http://www.ckplayer.com/webm/0.webm->video/webm','http://www.ckplayer.com/webm/0.ogv->video/ogg'];
	var support=['iPad','iPhone','ios','android+false','msie10+false'];//默认的在ipad,iphone,ios设备中用html5播放,android,ie10上没有安装flash的也调用html5
	CKobject.embedHTML5('video','ckplayer_a1',600,400,video,flashvars,support);
	/*
	如果不想使用html5播放器，只要把上面三行去掉就可以了
	=================================================================
	以下代码并不是播放器里的，只是播放器应用时用到的
	=================================================================
	*/
</script>
</block>

</body>
</html>