<?php
function mainmenudropdown($parent, $level) {
    $result = mysql_query("SELECT a.id, a.label, a.link, Deriv1.Count FROM `categories` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `categories` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent=" . $parent);
    echo "<ul>";
    while ($row = mysql_fetch_assoc($result)) {
        if ($row['Count'] > 0) {
            echo "<li><a href='" . $row['link'] . "'>" . $row['label'] . "</a>";
            mainmenudropdown($row['id'], $level + 1);
            echo "</li>";
        } elseif ($row['Count']==0) {
            echo "<li><a href='" . $row['link'] . "'>" . $row['label'] . "</a></li>";
        } else;
    }
    echo "</ul>";
}


?>


