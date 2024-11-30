<?php
// 取得目前的樣式表，如果未設定則使用預設的 "style.css"
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'style.css';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <!-- 動態設置 CSS 樣式表 -->
    <link rel="stylesheet" href="./<?php echo htmlspecialchars($theme); ?>">
</head>

<body>

<?php
date_default_timezone_set("Asia/Taipei");

// if(isset($_GET['year'])){
//     $year=$_GET['year'];
// }else{
//     $year=date("Y");
// }

// if(isset($_GET['month'])){
//     $month=$_GET['month'];
// }else{
//     $month=date("m");
// }

// if(isset($_GET['day'])){
//     $day=$_GET['day'];
// }else{
//     $day=date("d");
// }

// 檢查是否有表單提交日期
if (isset($_GET['goto']) && !empty($_GET['goto'])) {
    $gotoDate = strtotime($_GET['goto']); 
    // 提交日期時間戳
    $year = date("Y", $gotoDate);
    $month = date("m", $gotoDate);
    $day = date("d", $gotoDate);
} else {
    // 如果沒有提交日期，使用當前日期
    $year = isset($_GET['year']) ? $_GET['year'] : date("Y");
    $month = isset($_GET['month']) ? $_GET['month'] : date("m");
    $day = isset($_GET['day']) ? $_GET['day'] : date("d");
}

// 計算上一個月和下一個月
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
include("Lunar.php");
$lunar = new Lunar();

?>
<!-- 全區顯示區塊 .allbody -->
<!-- <div class="allbody"> -->

<!-- 上面日期顯示區塊 .top -->
<div class="top">
    <div class="top1">    
        <div class="last_next">
            <a href="calendar.php?year=<?=$year-1;?>&month=<?=$month;?>&theme=<?= $theme; ?>">前年</a>
        </div>
        <div class="top_year">
            <a href="#boxContent">
                <?php echo date("{$year}") ?>
            </a>
        </div>
        <div class="last_next">
            <a href="calendar.php?year=<?=$year+1;?>&month=<?=$month;?>&theme=<?= $theme; ?>">明年</a>
        </div>    
    </div>

    <div class="top2">    
        <div class="last_next">
            <a href="calendar.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>&theme=<?= $theme; ?>">＜</a>
        </div>
        <div class="top_month">
            <?php echo date("{$month}") ?>
        </div>
        <div class="last_next">
            <a href="calendar.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>&theme=<?= $theme; ?>">＞</a>
        </div>    
    </div>

    <div class="dec_img">
        <div class="back_today">
        <a href="./calendar.php?theme=<?= $theme; ?>">Today</a>
        </div>
    </div>
    <div class="goto">
        <form action="" method="GET">
            <input type="hidden" name="theme" value="<?= $theme; ?>"> <!-- 保留樣式表參數 -->
            <input type="date" name="goto" value="<?= "$year-$month-$day"; ?>">
            <input type="submit" value=" go to ">            
        </form>
    </div>
    <div class="theme_list">
        <div class="theme"><a href="?theme=style.css">預設樣式</a></div>
        <div class="theme"><a href="?theme=white.css">小雞白</a></div>
        <div class="theme"><a href="?theme=pink.css">綿羊粉</a></div>
  
    </div>
</div>
<!-- .top結束 -->

<!-- 右邊主要月曆區塊 .calender -->
<div class="calendar">

<!-- 主月曆顯示區塊 .main -->
<div class="main">

    <!-- 月份小按鈕 .last_next -->
    <div class="last_next">
        <a href="calendar.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">＜</a>
    </div>
    <!-- .last_next結束 -->
    
    <!-- 主月曆 .main_calendar -->
    <div class="main_calendar">
    <div class="show_date">
      <?php echo "{$year}&nbsp;年&nbsp;{$month}&nbsp;月&nbsp;{$day}&nbsp;日" ?>
    </div>

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
                        $formattedDate = date("Y年n月j日", $start_stamp); // 生成完整的日期格式
                        $isToday=(date("Y-m-d",$start_stamp)==date("Y-m-d"))?'today':'';
                        $theMonth=(date("m",$start_stamp)==date("m",$firstDay_stamp))?'':'grey-text';
                        $w=date("w", $start_stamp);
                        $isWeekend=($w==0 || $w==6)?'weekend':'';
                    
                        $spDateClass = isset($spDate[date("Y-m-d", $start_stamp)]) ? 'spDate-class' : '';
                    
                        // 將所有類別合併到一起
                        echo "<td class='$theMonth $isToday $isWeekend $spDateClass' data-date='$formattedDate'>";
                        echo "<a href='#'><div class='per_day'>";
                        echo date("j", $start_stamp);

                        // 轉換為陰曆並顯示
                        $lunarDate = $lunar->convertSolarToLunar(
                            date("Y", $start_stamp),
                            date("m", $start_stamp),
                            date("d", $start_stamp)
                        );
                        echo "<br><span class='lunar_date'>{$lunarDate[1]}{$lunarDate[2]}</span>"; // 陰曆月份和日期
                    
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
    </div>
    <!-- .main_calendar結束 -->

    <!-- 月份小按鈕 .last_next -->
    <div class="last_next">
        <a href="calendar.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">＞</a>
    </div>
    <!-- .last_next結束 -->

</div>
<!-- .main結束 -->

</div>
<!-- .calender結束 -->

<script>
document.addEventListener('DOMContentLoaded', () => {
    const dateCells = document.querySelectorAll('.main_table td'); // 取得所有日期儲存格
    const showDateDiv = document.querySelector('.show_date'); // 日期顯示區塊

    dateCells.forEach(cell => {
        cell.addEventListener('click', () => {
            // 清除其他儲存格的選中狀態
            dateCells.forEach(c => c.classList.remove('selected'));

            // 設定當前點擊的儲存格為選中
            cell.classList.add('selected');

            // 更新日期顯示區
            const selectedDate = cell.getAttribute('data-date'); // 從 data-date 中取得值
            if (selectedDate) {
                const formattedDate = ` ${selectedDate.replace(/([年月日])/g, " $1 ")} `;
                showDateDiv.textContent = formattedDate.trim(); // 顯示格式化後的日期
            }
        });
    });
});

</script>

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


<script>
document.addEventListener('DOMContentLoaded', () => {
    const detailsElement = document.querySelector('#myBox');
    const boxElement = document.querySelector('#boxContent');
    
    // 當 summary 被點擊時，確保展開並滾動
    detailsElement.addEventListener('toggle', () => {
        if (detailsElement.open) {
            setTimeout(() => {
                boxElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 10);
        }
    });

    // 如果 URL 中包含 #boxContent，自動展開並滾動
    if (location.hash === '#myBox') {
        detailsElement.open = true;
        setTimeout(() => {
            boxElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 10);
    }
});
</script>

<!-- 年曆區塊 .box -->


<details id="myBox" <?= isset($_GET['year']) ? 'open' : ''; ?>>
    <summary>
        年曆
    </summary>
<div class="box" id="boxContent">


<?php
for($whichMonth=1;$whichMonth<=12;$whichMonth++){
?>
    <!-- 年曆中小月曆 .per_month -->
    <div class="per_month">
        <a href="calendar.php?year=<?=$year;?>&month=<?=$whichMonth;?>" style="text-decoration: none; color: inherit;">
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

</details>

<!-- </div> -->
<!-- .allbody結束 -->
</body>
</html>