<?php
function mainmenu($parent, $level) {
    $result = mysql_query("SELECT a.id, a.label, a.link, Deriv1.Count FROM `categories` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `categories` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent='$parent'");
    echo "<ul>";
    while ($row = mysql_fetch_assoc($result)) {
        if ($row['Count'] > 0) {
            echo "<li><a href='" . $row['link'] . "'>" . $row['label'] . "</a>";
            mainmenu($row['id'], $level + 1);
            echo "</li>";
        } elseif ($row['Count']==0) {
            echo "<li><a href='" . $row['link'] . "'>" . $row['label'] . "</a></li>";
        } else;
    }
    echo "</ul>";
}

function adminmenu($parent, $level) {
    $result = mysql_query("SELECT a.id, a.label, a.link, Deriv1.Count FROM `categories` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `categories` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent='$parent' AND a.relevent!=2");
    echo "<ul>";
    while ($row = mysql_fetch_assoc($result)) {
        if ($row['Count'] > 0) {
            echo "<li><img src='../lib/style/images/deleteicon.png' width='10px' id='".$row['id']."'> <a href='" . $row['link'] . "'>" . $row['label'] . "</a>";
            adminmenu($row['id'], $level + 1);
            echo "</li>";
        } elseif ($row['Count']==0) {
            echo "<li><img src='../lib/style/images/deleteicon.png' width='10px' id='".$row['id']."'> <a href='" . $row['link'] . "'>" . $row['label'] . "</a></li>";
        } else;
    }
    echo "</ul>";
}

?>


