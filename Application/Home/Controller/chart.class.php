// <?php
// namespace Home\Controller;
// vendor('OFC.*');
// class chart(){
//     public function chart(){
// 	//include 'Application\OFC\php-ofc-library\open-flash-chart.php';

// 	//图名

// 	$title=new title("桥梁震动监测 ".date("Y-m"));
// 	//设置y轴刻度
// 	$y=new y_axis();
// 	$y->set_range(0, 80,5);//范围是0--100，步长为5
// 	$ylegend=new y_legend("Fail to display rotated Chinese");
// 	$ylegend->set_style('{font-size:15px;color:#0000ff;text-align:top;}');
// 	//x轴刻度
// 	$x=new x_axis();//x轴对象
// 	$xx=new x_axis_labels();//刻度标记对象
// 	$xlabel=array("2日","3日","4日","5日","6日","7日","8日","9日","10日");//刻度数组
// 	$xx->set_labels($xlabel);
// 	// $xx->set_vertical();//竖直显示文本，中文失败
// 	$x->set_labels($xx);

// 	//设置x轴名称
// 	$xlegend=new x_legend("监测时间/天");
// 	$xlegend->set_style('{font-size:15px;color:#0000ff;text-align:center;}');

// 	//折线图上的每个点
// 	$dot=new solid_dot();//空心点-hollow_dot();简单点-dot()还有其他星型之类的标记
// 	$dot->size(4)->colour("#61F946")->tooltip( "#x_label#的监测均值：#val#" );

// 	//折线图的线条
// 	$line=new line();//折线图
// 	$line->set_values(array(67,34,21,67,45,33,22,55,11));
// 	$line->colour("#FF8040");//线条颜色
// 	$line->set_key("测量均值", 12);//左上角的图例
// 	$line->set_default_dot_style($dot);//设置每个取值点鼠标滑动时的提示信息

// 	//画柱状图
// 	$bar = new bar();
// 	$bar->colour("#38A5FE");
// 	$bar->set_values( array(12,32,23,22,25,36,27,38,39) );//设置数据
// 	$bar->key("测量次数", 12);//设置图例
// 	$bar->set_tooltip("测量次数：#val#");//柱状图显示提示信息#top#==#val#

// 	//给整个图的tooltip设置一些背景字体之类的信息
// 	$tip=new tooltip();
// 	$tip->set_background_colour("#C8F9C8");

// 	//统计图实例
// 	$chart = new open_flash_chart();//新建图的实例
// 	$chart->set_bg_colour("#FBF0FF");
// 	$chart->set_title( $title );//标题
// 	$chart->add_element( $bar );//添加柱状图
// 	$chart->add_element($line);//添加折线图
// 	$chart->set_y_axis($y);//设置刻度
// 	$chart->set_x_axis($x);
// 	$chart->set_x_legend($xlegend);//设置x轴的选项名
// 	$chart->set_y_legend($ylegend);
// 	$chart->set_tooltip($tip);//设置鼠标滑过时的提示信息

// 	echo $chart->toString();//输出
// 	//$this->display();
//     }
// }