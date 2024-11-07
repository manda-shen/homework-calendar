<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    table{
        border-collapse:collapse;
    }
    td{
        padding: 5px 10px;
        text-align: center;
        border: 1px solid #999;
    }
    .holiday{
        background:pink;
        color:#999;
    }
    .grey-text{
        color:#999;
    }
    .today{
        background:blue;
        color:white;
        font-weight:bolder;
    }
    
</style>


<ul>
    <li>有上個月下個月的按鈕</li>
    <li>萬年曆都在同一個頁面同一個檔案</li>
    <li>有前年和明年的按鈕</li>
</ul>




<?php 

?>


<table>
<tr>
    <td></td>
    <td>日</td>
    <td>一</td>
    <td>二</td>
    <td>三</td>
    <td>四</td>
    <td>五</td>
    <td>六</td>
</tr>
<?php



if(isset($_GET['year'])){
    $year=$_GET['year'];
}else{
    $year=date("Y");
}

if(isset($_GET['month'])){
    $month=$_GET['month'];
}else{
    $month=date("m");
}


if($month-1<1){
    $prevMonth=12;
    $prevYear=$year-1;
}else{
    $prevMonth=$month-1;
    $prevYear=$year;
}

if($month+1>12){
    $nextMonth=1;
    $nextYear=$year+1;
}else{
    $nextMonth=$month+1;
    $nextYear=$year;
}



?>

<h3><?php echo date("{$year}年{$month}月") ?></h3>
<a href="calendar.php?year=<?=$year-1;?>&month=<?=$month;?>">前年</a>&nbsp;
<a href="calendar.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">上個月</a>&nbsp;&nbsp;&nbsp;
<a href="./calendar.php">本月</a>&nbsp;&nbsp;&nbsp;
<a href="calendar.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">下個月</a>&nbsp;
<a href="calendar.php?year=<?=$year+1;?>&month=<?=$month;?>">明年</a>




<?php


$firstDay="{$year}-{$month}-1";
$firstDay_stamp=strtotime($firstDay);

$week_firstDay=date("w", $firstDay_stamp);
$start_stamp=strtotime("-$week_firstDay days",$firstDay_stamp);

for($i=0;$i<6;$i++){
    echo "<tr>";
    echo "<td>";
    echo $i+1;
    echo "</td>";
    for($j=0;$j<7;$j++){
        $isToday=(date("Y-m-d",$start_stamp)==date("Y-m-d"))?'today':'';
        $theMonth=(date("m",$start_stamp)==date("m",$firstDay_stamp))?'':'grey-text';
        $w=date("w", $start_stamp);
        $isHoliday=($w==0 || $w==6)?'holiday':'';
        echo "<td class='$theMonth $isToday $isHoliday'>";

        echo date("j",$start_stamp);
        $start_stamp=strtotime("+1 day", $start_stamp);


        echo "</td>";
    }
    echo "</tr>";
}

?>
</table>


</body>
</html>