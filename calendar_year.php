<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        .box{
            margin:auto;
            background-color: white;
            width: 424px;
            display:flex;
            flex-wrap: wrap;
            padding: 20px 30px 40px;
        }

        /* 預設寬度(最小)為420px，以下設置其他寬度 */
        /* 當視窗寬度大於576px，設置固定寬度630px */
        @media (min-width: 768px) {
            .box {
                width: 636px;
            }
        }

        /* 當視窗寬度大於768px，設置固定寬度839px */
        @media (min-width: 992px) {
            .box {
                width: 847px;
            }
        }

        /* 當視窗寬度大於1330px，設置固定寬度1259px*/
        @media (min-width: 1330px) {
            .box {
                width: 1271px;
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