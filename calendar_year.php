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

        body {
            width: 100%;
            margin: 0px;
            padding: 0px;
            background-image: url('https://fastly.picsum.photos/id/119/3264/2176.jpg?hmac=PYRYBOGQhlUm6wS94EkpN8dTIC7-2GniC3pqOt6CpNU'); 
            background-repeat: no-repeat; /* 防止背景圖片重複 */
            background-position: top; /* 將背景圖片置於最上方 */
            background-size: cover; /* 讓背景圖片覆蓋整個頁面 */
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3000px;
            background-color: rgba(161, 181, 185, 0.3); 
            pointer-events: none; /* 讓遮罩不影響點擊操作 */
            z-index: -1; /* 放置在背景圖片之上 */
        }
        .front{
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
            padding: 50px;
            padding-top: 30px;
        }

                /* 當視窗寬度小於768px，設置固定寬度630px */
        @media (max-width: 768px) {
            .front {
                width: 768px;
                margin: center;
            }
        }

        .top{
            width: 300px;
            height: 300px;
            background-color: rgba(161, 181, 185, 1); 
            padding:30px 20px;
            display:flex;
            border-radius: 20px;
            color: white;
            flex-wrap: wrap;
            align-content: center;
            justify-content: flex-end;
            margin-bottom: 10px;  
            margin-left: 100px;         
        }

        .top a{
            color: inherit; 
            text-decoration: none;
        }

        .top1{
            width: 100%;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 5px;
        }
        
        .top2{
            width: 134px;
            height: 100px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 10px;
        }

        .top_year{
            width: 40%;
            font-size: 75px;
            font-weight: 1000;
            color: white;
            margin: auto;
            margin-left: 25px;
        }

        .top_month{
            width: 70px;
            color: white;
            font-size: 36px;
            font-weight: border;
            justify-self:flex-end;
            padding: 0px;
            text-align: center;
        }

        .top_month::after{
            content:"月";
            color: white;
            font-size: 12px;
            margin-left: -5px;
        }

        .dec_img{
            width: 100px;
            height: 140px;
            background-image: url('./img/bear1.png'); 
            background-repeat: no-repeat; /* 防止背景圖片重複 */
            background-size: cover; /* 讓背景圖片覆蓋整個頁面 */
            display:flex;
            justify-content: center;
            align-items: flex-end;
            padding: 0px;
            padding-bottom: 15px;
            margin-right: 10px;
            filter: drop-shadow(0px 5px 1px rgba(0, 0, 0, 0.2));
        }

        .this_month{
            width: 60px;
            height: 24px;
            font-size: 14px;
            background: rgba(88, 116, 122, 0.4);
            color: white;
            backdrop-filter: blur(3px);
            border: 2px solid white;
            box-shadow:0.7px 1px 5px rgba(0,0,0,0.1);
            border-radius: 10px;
            display:flex;
            justify-content: center;
            align-items: center;
        }

        .this_month:hover{
            background: rgba(255, 255, 255, 0.7);
            color: #58747A;
            backdrop-filter: blur(3px);
            border: 1px solid #58747A;
            box-shadow:0.7px 1px 5px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

       .main{
            width: 900px;
            height: 65vh;
            margin: auto;
            margin-top: 100px;
            margin-bottom: 50px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }



        .last_next{
            width: 30px;
            font-size: 12px;
            color: white;
            padding: 5px 8px 5px 8px;
            border-radius: 10px;
            border:0.1em solid rgba(0,0,0,0.1);
            box-shadow:0.7px 1px 5px rgba(0,0,0,0.1);
        }

        .last_next:hover{
            background-color: #E0ECEF;
            color: white;
            transition: 0.2s;
        }

        .main_table{
            width: 90%;
            background-color: white;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            padding:15px;
            margin:10px;
            border-radius:10px;
            border:0.1em solid rgba(0,0,0,0.1);
            box-shadow:0.7px 1px 5px rgba(0,0,0,0.1);
        }

        .main table{
            width: 100%;
            color: #28404A;
            border-collapse: collapse;
            border: 0;
        }

        .main_table tr {
            border: none; /* 隱藏每個 tr 的邊框 */
        }

        .main td {
            width: 14%;
            height: 12vh;
            border: 1px solid white; /* 設置儲存格之間的格線為白色 */
            border-left: 1px solid white; /* 左邊框設置為白色 */
            border-top: 1px solid white;  /* 上邊框設置為白色 */
            text-align: right; /* 文字向右對齊 */
            vertical-align: top; /* 文字向上對齊 */
        }

        .main td:hover{
            background-color: white;
        }

        .per_day{
            width: 100%;
            height: 100%;
        }

        .main_table tr:first-child td {
            height: 50px;
            text-align: center; /* 將文字水平置中 */
            vertical-align: middle; /* 將文字垂直置中 */
        }

        .main_table td:first-child {
            border-left: none; /* 移除每行第一個儲存格的左邊框 */
        }

        .main_table tr:first-child td {
        border-top: none; /* 移除第一行所有儲存格的上邊框 */
        }

        .main_table tr td:last-child {
            border-right: none;
        }/* 移除最右邊的邊框 */

        .main_table tr:last-child td {
            border-bottom: none;
        }/* 移除最下方的邊框 */

        .main a {
            color: inherit; 
            text-decoration: none;
        }

        .box{
            margin:auto;        
            background: rgba(161, 181, 185, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            width: 488px;
            display:flex;
            flex-wrap: wrap;
            padding: 20px 30px 40px;
            margin-top: 30px;
            margin-bottom: 50px;
        }

        /* 預設寬度(最小)為420px，以下設置其他寬度 */
        /* 當視窗寬度大於576px，設置固定寬度630px */
        @media (min-width: 768px) {
            .box {
                width: 700px;
                margin: auto;
                margin-bottom: 50px;
            }
        }

        /* 當視窗寬度大於768px，設置固定寬度839px */
        @media (min-width: 992px) {
            .box {
                width: 914px;
                margin-right: 95px;
                margin-bottom: 50px;
            }
        }


        table{
            color: #28404A;
            border-collapse: collapse;
            font-size: 0.8rem;
 

        }

        tr,td{
            padding: 5px;
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

        .month{
            color: #28404A;
            margin-top:8px;
            margin-bottom: 2px;
        }

        .holiday{
            color: #C46A1B;
        }

        .holidays{
            color: #C46A1B;
        }
        
        .grey-text{
            color:#9EA6A8;
        }
        .today{
            color:red;
            font-weight: bold;
        }

        .spDate-class {
            color: #6B346F;
            font-size: 12px
        }



    </style>

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
<!-- 上半區顯示區塊 -->
<div class="front">
<!-- 上面日期顯示區塊 -->
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
        <div class="this_month"><a href="./calendar_year.php">Today</a></div>
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

<!-- 主要月曆顯示區塊 -->
<div class="main">
    <div class="last_next">
        <a href="calendar_year.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">＜</a>
    </div>

    <div class="main_table"> 
        <table>
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
                        echo "<a href='./per_day.php'><div class='per_day'>";
                        echo date("j", $start_stamp);
                    
                        if(isset($spDate[date("Y-m-d",$start_stamp)])){
                            echo "<br>{$spDate[date("Y-m-d",$start_stamp)]}";
                        }
                        if(isset($holidays[date("m-d",$start_stamp)])){
                            echo "<br>{$holidays[date("m-d",$start_stamp)]}";
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
    <div class="last_next">
        <a href="calendar_year.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">＞</a>
    </div>
</div>
</div>

<!-- 下面年曆區塊 -->
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

<div class="box">

<?php
for($whichMonth=1;$whichMonth<=12;$whichMonth++){
?>

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