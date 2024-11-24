<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

<?php
date_default_timezone_set("Asia/Taipei");

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

include("holiday.php");

?>
<!-- 全區顯示區塊 .allbody -->
<div class="allbody">

<!-- 上面日期顯示區塊 .top -->
<div class="top">
    <div class="top1">    
        <div class="last_next">
            <a href="calendar_year.php?year=<?=$year-1;?>&month=<?=$month;?>">前年</a>
        </div>
        <div class="top_year">
            <?php echo date("{$year}") ?>
        </div>
        <div class="last_next">
            <a href="calendar_year.php?year=<?=$year+1;?>&month=<?=$month;?>">明年</a>
        </div>    
    </div>
    <div class="dec_img">
        <div class="back_today">
            <a href="./calendar_year.php">Today</a>
        </div>
    </div>
    <div class="top2">    
        <div class="last_next">
            <a href="calendar_year.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">＜</a>
        </div>
        <div class="top_month">
            <?php echo date("{$month}") ?>
        </div>
        <div class="last_next">
            <a href="calendar_year.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">＞</a>
        </div>    
    </div>
</div>
<!-- .top結束 -->

<!-- 右邊主要月曆及年曆區塊 .calender -->
<div class="calendar">

<!-- 主要月曆顯示區塊 .main -->
<div class="main">

    <!-- 月份小按鈕 .last_next -->
    <div class="last_next">
        <a href="calendar_year.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">＜</a>
    </div>
    <!-- .last_next結束 -->

    <!-- 主月曆 .main_table -->
    <div class="main_table"> 
        <table>
            <tr class="week_mark">
                <td>日</td>
                <td>一</td>
                <td>二</td>
                <td>三</td>
                <td>四</td>
                <td>五</td>
                <td>六</td>
            </tr>

            <?php
            
                $firstDay="{$year}-{$month}-1";
                $firstDay_stamp=strtotime($firstDay);
                
                $week_firstDay=date("N", $firstDay_stamp);
                $start_stamp=strtotime("-$week_firstDay days",$firstDay_stamp);
                
                for($i=0;$i<6;$i++){
                    echo "<tr>";
                    for($j=0;$j<7;$j++){
                        $isToday=(date("Y-m-d",$start_stamp)==date("Y-m-d"))?'today':'';
                        $theMonth=(date("m",$start_stamp)==date("m",$firstDay_stamp))?'':'grey-text';
                        $w=date("w", $start_stamp);
                        $isWeekend=($w==0 || $w==6)?'weekend':'';
                    
                        $spDateClass = isset($spDate[date("Y-m-d", $start_stamp)]) ? 'spDate-class' : '';
                    
                        // 將所有類別合併到一起
                        echo "<td class='$theMonth $isToday $isWeekend $spDateClass'>";
                        echo "<a href='./#memo'><div class='per_day'>";
                        echo date("j", $start_stamp);
                    
                        if(isset($spDate[date("Y-m-d",$start_stamp)])){
                            echo "<br>{$spDate[date("Y-m-d",$start_stamp)]}";
                        }
                        if(isset($holidays[date("m-d",$start_stamp)])){
                            echo "<br><span class='holidays'>{$holidays[date("m-d",$start_stamp)]}</span>";
                        }
                        $start_stamp=strtotime("+1 day", $start_stamp);
                        echo "</div></a>";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                
            ?>
        </table>
    </div>
    <!-- .main_table結束 -->

    <!-- 月份小按鈕 .last_next -->
    <div class="last_next">
        <a href="calendar_year.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">＞</a>
    </div>
    <!-- .last_next結束 -->

</div>
<!-- .main結束 -->


<!-- ---------以下年曆區塊----------- -->
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

<!-- 年曆區塊 .box -->
<div class="box">

<?php
for($whichMonth=1;$whichMonth<=12;$whichMonth++){
?>
    <!-- 年曆中小月曆 .per_month -->
    <div class="per_month">
        <a href="calendar_year.php?year=<?=$year;?>&month=<?=$whichMonth;?>" style="text-decoration: none; color: inherit;">
        <table>
            <div>
                <h2 class="month">
                    <?php echo $whichMonth?>
                </h2>
            </div>

<?php
$firstDay="{$year}-{$whichMonth}-1";
$firstDay_stamp=strtotime($firstDay);

$week_firstDay=date("N", $firstDay_stamp);
$start_stamp=strtotime("-$week_firstDay days",$firstDay_stamp);

for($i=0;$i<6;$i++){
    echo "<tr>";
    for($j=0;$j<7;$j++){
        $isToday=(date("Y-m-d",$start_stamp)==date("Y-m-d"))?'today':'';
        $theMonth=(date("m",$start_stamp)==date("m",$firstDay_stamp))?'':'grey-text';
        $w=date("w", $start_stamp);
        $isWeekend=($w==0 || $w==6)?'weekend':'';
        echo "<td class='$theMonth $isToday $isWeekend'>";
        echo date("j",$start_stamp);
        $start_stamp=strtotime("+1 day", $start_stamp);
    }
    echo "</tr>";
}

?> 
        </table>
        </a>
    </div>
    <!-- 年曆中小月曆 .per_month -->

<?php    
}
?>


</div>
<!-- .box結束 -->
</div>
<!-- .calender結束 -->
</div>
<!-- .allbody結束 -->
</body>
</html>