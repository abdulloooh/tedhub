<?php

    $db = new SQLite3("cities5000.sqlite");
    $dbterm = $db->escapeString(
        trim(substr((isset($_GET['q']) ? $_GET['q'] : ""), 0, 50))
    );

    # work with the "pretty" stuff we add for search suggestions
    # -- this is a very ugly way to do this, but something
    # smarter requires hacking deeper on l.control.geosearch.js code
    $country_code = "";
    $admin1 = "";
    if (preg_match("/ \((..)\)$/", $dbterm, $matches)) {
        $country_code = strtoupper($matches[1]);
        $dbterm = preg_replace("/ \(..\)$/", "", $dbterm);
        if ($country_code == "US") {
            preg_match("/, (..)$/", $dbterm, $matches);
            $admin1 = strtoupper($matches[1]);
            $dbterm = preg_replace("/, ..$/", "", $dbterm);
        }
    }

    if ($dbterm) {

        if ($country_code) {
            $country_code = "AND country_code = '" . $db->escapeString($country_code) . "'";
        }
        if ($admin1) {
            $admin1 = "AND admin1 = '" . $db->escapeString($admin1) . "'";
        }

        $rv = $db->query("
            SELECT name, latitude, longitude, admin1, country_code
              FROM features
             WHERE name LIKE '$dbterm%'
                   $country_code
                   $admin1
             ORDER BY population DESC
             LIMIT 50
        ");

        $results = array();
        while ($row = $rv->fetchArray()) {
            if ($row['country_code'] == "US") {
                $disp_name = "$row[name], $row[admin1] ($row[country_code])";
            } else {
                $disp_name = "$row[name] ($row[country_code])";
            }
            array_push($results, "{\n\t\"name\": \"$disp_name\",\n\t\"latitude\": \"$row[latitude]\",\n\t\"longitude\": \"$row[longitude]\"\n}");
        }

        echo "[\n" . join(",\n", $results) . "\n]";

    }

?>

