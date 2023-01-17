<?php
    function data($row){
        ?>
        <button type="submit" id="button3" class="todobut" name="edit" value="<?= $row[0]; ?>">edit</button>
        <button type="submit" id="button4" class="todobut" name="preview" value="<?= $row[0]; ?>">預覽</button>
        標題: <?php echo($row[1]); ?><br>
        開始時間: <?php echo($row[3]); ?><br>
        結束時間: <?php echo($row[4]); ?><br>
        處理狀態: <?php echo($row[5]); ?><br>
        優先順序: <?php echo($row[6]); ?><br>
        詳細內容: <?php echo($row[7]); ?><br>
        <?php
    }

    function uper($todo){
    if(isset($_SESSION["date"])){
        while($row=mysqli_fetch_row($todo)){
            $start_time=substr($row[3],0,2)*60+substr($row[3],3,5);
            $hr=substr($row[4],0,2)-substr($row[3],0,2);
            $min=substr($row[4],3,5)-substr($row[3],3,5);
            ?>
            <div class="work-box" id="up<?= $row[0]; ?>" draggable="true" value="<?= $row[0]; ?>" style="height:<?= ($hr*30)+(($min/30)*15); ?>px;top:<?= 145+($start_time/2)-12; ?>px;left:180px;">
                <?php data($row); ?>
            </div>
            <?php
            }
        }
    }

    function lower($todo){
        if(isset($_SESSION["date"])){
            while($row=mysqli_fetch_row($todo)){
                $end_time=substr($row[3],0,2)*60+substr($row[3],3,5);
                $hr=substr($row[4],0,2)-substr($row[3],0,2);
                $min=substr($row[4],3,5)-substr($row[3],3,5);
                ?>
                <div class="work-box" id="down<?= $row[0]; ?>" draggable="true" value="<?= $row[0]; ?>" style="position: relative;height:<?= ($hr*30)+(($min/30)*15)+20; ?>px;bottom:<?= 145+(($end_time)/2)+100; ?>px;left:185 px;">
                    <?php data($row); ?>
                </div>
                <?php
            }
        }
    }

    function up($data,$comper){
        $a=[];
        while($row=mysqli_fetch_assoc($data)){
            array_push($a,$row);
        }
        for($i=0;$i<sizeof($a)-1;$i=$i+1){
            for($j=0;$j<sizeof($a)-$i-1;$j=$j+1){
                if($a[$j][$comper]>$a[$j+1][$comper]){
                    $tamp=$a[$j];
                    $a[$j]=$a[$j+1];
                    $a[$j+1]=$tamp;
                }
            }
        }
        for($row=0;$row<count($a);$row=$row+1){
            ?>
            <tr>
                <td class="usertable" id="<?= $a[$row]["id"]; ?>">
                    <?php print_r($a[$row]["id"]); ?>
                    <button type="submit" name="edit" value="<?= $a[$row]["id"]; ?>">edit</button>
                    <button type="submit" name="preview" value="<?= $a[$row]["id"]; ?>">預覽</button>
                </td>
                <td class="usertable"><?php print_r($a[$row]["title"]); ?></td>
                <td class="usertable"><?php print_r($a[$row]["date"]); ?></td>
                <td class="usertable"><?php print_r($a[$row]["start_time"]."~".$a[$row]["end_time"]); ?></td>
                <td class="usertable"><?php print_r($a[$row]["deal"]); ?></td>
                <td class="usertable"><?php print_r($a[$row]["priority"]); ?></td>
                <td class="usertable"><?php print_r($a[$row]["detail"]); ?></td>
            </tr>
            <?php
        }
    }

    function down($data,$comper){
        $a=[];
        while($row=mysqli_fetch_assoc($data)){
            array_push($a,$row);
        }
        for($i=0;$i<count($a)-1;$i=$i+1){
            for($j=0;$j<count($a)-$i-1;$j=$j+1){
                if($a[$j][$comper]<$a[$j+1][$comper]){
                    $tamp=$a[$j];
                    $a[$j]=$a[$j+1];
                    $a[$j+1]=$tamp;
                }
            }
        }
        for($row=0;$row<count($a);$row=$row+1){
            ?>
            <tr>
                <td class="usertable" id="<?= $a[$row]["id"]; ?>">
                    <?php print_r($a[$row]["id"]); ?>
                    <button type="submit" name="edit" value="<?= $a[$row]["id"]; ?>">edit</button>
                    <button type="submit" name="preview" value="<?= $a[$row]["id"]; ?>">預覽</button>
                </td>
                <td class="usertable"><?php print_r($a[$row]["title"]); ?></td>
                <td class="usertable"><?php print_r($a[$row]["date"]); ?></td>
                <td class="usertable"><?php print_r($a[$row]["start_time"]."~".$a[$row]["end_time"]); ?></td>
                <td class="usertable"><?php print_r($a[$row]["deal"]); ?></td>
                <td class="usertable"><?php print_r($a[$row]["priority"]); ?></td>
                <td class="usertable"><?php print_r($a[$row]["detail"]); ?></td>
            </tr>
            <?php
        }
    }
?>