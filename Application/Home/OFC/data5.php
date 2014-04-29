<?php
require_once('./OFC/OFC_Chart.php');

$title = new OFC_Elements_Title( '****检测 '.date("Y-m-d") );

//设置线条
$line_dot = new OFC_Charts_Line();
$line_dot->set_values(array(6,2,7,8,10,12,7,6,5,12,10,9,11,4,3,2,9));//值
$line_dot->set_colour('#A73403');//线条颜色
$line_dot->set_key("振幅", 12);//图例


$labels=array("1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月");
$x_label=new OFC_Elements_Axis_X_Label_Set();
$x_label->set_labels($labels);//x轴刻度设置
// $x_label->set_vertical();//中文无法旋转

$x=new OFC_Elements_Axis_X();
$x->set_offset(false);
$x->set_steps(1);//设置步长
$x->set_colour( '#A2ACBA');
$x->set_labels($x_label);//附上刻度


$y=new OFC_Elements_Axis_Y();
$y->set_range(0,16,2);//y轴刻度范围
$y->set_colour( '#A2ACBA');

$x_legend=new OFC_Elements_Legend_X("观测时间");
$x_legend->set_style('{font-size:18px;color:#0000ff;text-align:center}');
//设置图标以及XY轴
$chart = new OFC_Chart();
$chart->set_title( $title );//表名
$chart->set_x_axis($x);//设置刻度
$chart->set_y_axis($y);
$chart->set_x_legend($x_legend);
$chart->add_element($line_dot);//画图

echo $chart->toPrettyString();
?>