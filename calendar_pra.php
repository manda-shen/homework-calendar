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
        background:rgb(<?=rand(170,200);?>,<?=rand(170,200);?>,<?=rand(170,200);?>);
        margin:auto;
    }
    td{
        padding: 5px 10px;
        text-align: center;
        border: 1px solid white;
        width: 65px;
    }
    .holiday{
        background:pink;
        color: white;
    }
    .grey-text{
        color:#888;
    }
    .today{
        background:blue;
        color:white;
        font-weight:bolder;
    }
    .nav{
        width: 687px;
        margin:auto;
        
    }
    .nav td{
        border: 1px solid white;
        background: white;
    }
    .main{
        margin: auto;
        display: flex;
        flex-direction: row;
    }


</style>


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

$spDate=['2024-11-07'=>"立冬",
         '2024-06-10' => "端午節",
         '2024-09-17' => "中秋節",
         '2025-06-20' => "端午節",
         '2025-09-27' => "中秋節",
         '2026-06-30' => "端午節",
         '2026-10-07' => "中秋節",
         '2024-11-22'=>'小雪'];
$holidays = [
    '01-01' => "元旦",
    '02-10' => "農曆新年",
    '04-04' => "兒童節",
    '04-05' => "清明節",
    '05-01' => "勞動節",
    '10-10' => "國慶日"
];

?>

<div>
<h3><?php echo date("{$year}年{$month}月") ?></h3>
</div>

<div class="main">
<div class="pre_post">
    <a href="calendar_pra.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">＜</a>
</div>

<div> 
<table>

<tr class='nav'>
    <td colspan=3 style='text-align:left'>
        <a href="calendar_pra.php?year=<?=$year-1;?>&month=<?=$month;?>">前年</a>&nbsp;
        <a href="calendar_pra.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">上個月</a>&nbsp;&nbsp;&nbsp;
    </td>
    <!-- <td></td> -->
    <!-- <td></td> -->
    <td  style='text-align:center'>
        <a href="./calendar_pra.php">本月</a>&nbsp;&nbsp;&nbsp;
    </td>
    <td colspan=3 style='text-align:right'>
        <a href="calendar_pra.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">下個月</a>&nbsp;
        <a href="calendar_pra.php?year=<?=$year+1;?>&month=<?=$month;?>">明年</a>    
    </td>
    <!-- <td></td> -->
    <!-- <td></td> -->
    </tr>    


<tr>
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
    $isHoliday=($w==0 || $w==6)?'holiday':'';
    echo "<td class='$theMonth $isToday $isHoliday'>";
    echo date("j",$start_stamp);

    if(isset($spDate[date("Y-m-d",$start_stamp)])){
        echo "<br>{$spDate[date("Y-m-d",$start_stamp)]}";
    }
    if(isset($holidays[date("m-d",$start_stamp)])){
        echo "<br>{$holidays[date("m-d",$start_stamp)]}";
    }
    $start_stamp=strtotime("+1 day", $start_stamp);

    echo "</td>";
}
echo "</tr>";
}

?>
</table>
</div>

<div class="pre_post">
    <a href="calendar_pra.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">＞</a>
</div>
</div>

</body>
</html>