<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }
       .main{
            width: 60%;
            margin: auto;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .main_table{
            background-color: white;
            padding:15px;
            padding-top:0px;
            margin:10px;
            border-radius:10px;
            border:0.1em solid rgba(0,0,0,0.1);
            box-shadow:0.7px 1px 5px rgba(0,0,0,0.1);
        }

        .main table{
            width: 488px;
            color: #000;
            border-collapse: collapse;
        }

        .main tr, 
        .main td {
            padding-right:5px;
        }

        .main a {
            color: inherit; 
            text-decoration: none;
        }

        .spDate-class {
            color: pink;
            font-size: 12px

}

        .box{
            margin:auto;
            background-color: white;
            width: 488px;
            display:flex;
            flex-wrap: wrap;
            padding: 20px 30px 40px;
        }

        /* 預設寬度(最小)為420px，以下設置其他寬度 */
        /* 當視窗寬度大於576px，設置固定寬度630px */
        @media (min-width: 768px) {
            .box {
                width: 700px;
            }
        }

        /* 當視窗寬度大於768px，設置固定寬度839px */
        @media (min-width: 992px) {
            .box {
                width: 914px;
            }
        }


        table{
            color: #000;
            border-collapse: collapse;
            font-size: 0.8rem;
 

        }

        tr,td{
            padding: 5px;
        }

        h2{
            margin-top: 10px;
            margin-bottom: 2px;
            color: #74ACAC;
        }

        .per_month{
            background-color: white;
            padding:15px;
            padding-top:0px;
            margin:10px;
            border-radius:10px;
            border:0.1em solid rgba(0,0,0,0.1);
            box-shadow:0.7px 1px 5px rgba(0,0,0,0.1);
        }
        .month::after{
            content:" 月";
            color: #74ACAC;
            font-size: 14px;
        }

        .holiday{

            color: #3CAEAE;
        }
        .grey-text{
            color:#ccc;
        }
        .today{
            color:red;
            font-weight: bold;
        }



    </style>

</head>

<body>

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

<div class="main_table"> 
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

    $spDateClass = isset($spDate[date("Y-m-d", $start_stamp)]) ? 'spDate-class' : '';

    // 將所有類別合併到一起
    echo "<td class='$theMonth $isToday $isHoliday $spDateClass'>";
    echo date("j", $start_stamp);

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


<div class="box">
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



<?php
for($whichMonth=1;$whichMonth<=12;$whichMonth++){
?>

<div class="per_month"><a href="calendar_pra.php?year=<?=$year;?>&month=<?=$whichMonth;?>" style="text-decoration: none; color: inherit;">
<table>

<div>
<h2 class="month"><?php echo $whichMonth?></h2>
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
        $isHoliday=($w==0 || $w==6)?'holiday':'';
        echo "<td class='$theMonth $isToday $isHoliday'>";
        echo date("j",$start_stamp);
        $start_stamp=strtotime("+1 day", $start_stamp);

    }
    echo "</tr>";
}

?> 
</table>
</a>
</div>

<?php    
}
?>

</div>


</body>

</html>