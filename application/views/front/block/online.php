<?php
mysql_query("update counters set visitor=visitor+1");
if ($this->a_general->count_get_row('access', array('date' => 'curdate() - INTERVAL 20')) > 0) {
    mysql_query("delete from access where date = curdate() - INTERVAL 20");
}
$ct = $this->a_general->get_row_no_where('counters');
$c = $this->a_general->get_row('access', array('date' => date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")))));
$i = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
if ($this->a_general->count_get_row('access', array('date' => date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y"))))) == 0) {
    mysql_query("insert into access (counter,date) values(1,CURDATE())");
} else
    mysql_query("update access set counter=counter+1 where date=CURDATE()");
//echo $c->counter;
$session = session_id();
$time = time();
$tbl_name = "user_online"; // Table name
$time_check = $time - 600; //SET TIME 10 Minute
$sql = "SELECT * FROM $tbl_name WHERE session='$session'";
$result = mysql_query($sql);
$count = mysql_num_rows($result);
if ($count == "0") {
    $sql1 = "INSERT INTO $tbl_name(session, time)VALUES('$session', '$time')";
    $result1 = mysql_query($sql1);
} else {
    $sql2 = "UPDATE $tbl_name SET time='$time' WHERE session = '$session'";
    $result2 = mysql_query($sql2);
}
$sql3 = "SELECT * FROM $tbl_name";
$result3 = mysql_query($sql3);
$count_user_online = mysql_num_rows($result3);
//return $count_user_online;
// if over 10 minute, delete session
$sql4 = "DELETE FROM $tbl_name WHERE time<$time_check";
$result4 = mysql_query($sql4);
?>
<div class="counter">
    <p><?php echo $l->lang_total_visited[$lang]?></p>
    <?php echo $this->a_general->replacenumber($ct->visitor) ?>

</div>

