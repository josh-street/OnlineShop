<?php
// function called within the index.php file, with the parameters (0,1). This selects all the parents (e.g. Categories), and the level (e.g. Sub-categories as the 2nd level).
function mainmenu($parent, $level) {
    // Complex mysql statement that selects one category or sub category using an increasing loop number. 
    // It sorts the table data such that the category is outputted first followed by its sub categorys and so on.
    $result = mysql_query("SELECT a.id, a.label, a.link, Deriv1.Count FROM `categories` a  LEFT OUTER JOIN 
        (SELECT parent, COUNT(*) AS Count FROM `categories` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent='$parent'");
    echo "<ul>";
    while ($row = mysql_fetch_assoc($result)) {
        // This echoes the HTML to the client and the output from the mysql is placed in the innerHTML of the file. 
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

function cmsmenu($parent, $level) {
    $result = mysql_query("SELECT a.id, a.label, a.link, Deriv1.Count FROM `categories` a  LEFT OUTER JOIN 
        (SELECT parent, COUNT(*) AS Count FROM `categories` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent='$parent' AND a.relevent!=2");
    echo "<ul>";
    while ($row = mysql_fetch_assoc($result)) {
        if ($row['Count'] > 0) {
            echo "<li><img src='../lib/style/images/deleteicon.png' alt='Delete Category' width='15' id='".$row['id']."'> <a href='" . $row['link'] . "'>" . $row['label'] . "</a>";
            cmsmenu($row['id'], $level + 1);
            echo "</li>";
        } elseif ($row['Count']==0) {
            echo "<li><img src='../lib/style/images/deleteicon.png' alt='Delete Category' width='15' id='".$row['id']."'> <a href='" . $row['link'] . "'>" . $row['label'] . "</a></li>";
        } else;
    }
    echo "</ul>";
}

?>


