<?php
ini_set('max_execution_time', 300); // 5 minutes
error_reporting(0);

$post = $_POST;

if ($post['db1']['dbtype'] == "mysql") {
    $host = $post['db1']['host'];
    $port = $post['db1']['port'];
    $dbname = $post['db1']['database'];
    $username = $post['db1']['username'];
    $password = $post['db1']['password'];

    $db1 = mysqli_connect($host, $username, $password, $dbname);
    $error1 = (!$db1) ? mysqli_connect_error() : "";
} else {
    $host = "host = {$post['db1']['host']}";
    $port = "port = {$post['db1']['port']}";
    $dbname = "dbname = {$post['db1']['database']}";
    $credentials = "user = {$post['db1']['username']} password={$post['db1']['password']}";

    $db1 = pg_connect("$host $port $dbname $credentials");
    $error1 = (!$db1) ? pg_last_error() : "";
}

if ($post['db2']['dbtype'] == "mysql") {
    $host = $post['db2']['host'];
    $port = $post['db2']['port'];
    $dbname = $post['db2']['database'];
    $username = $post['db2']['username'];
    $password = $post['db2']['password'];

    $db2 = mysqli_connect($host, $username, $password, $dbname);
    $error2 = (!$db2) ? mysqli_connect_error() : "";
} else {
    $host = "host = {$post['db2']['host']}";
    $port = "port = {$post['db2']['port']}";
    $dbname = "dbname = {$post['db2']['database']}";
    $credentials = "user = {$post['db2']['username']} password={$post['db2']['password']}";

    $db2 = pg_connect("$host $port $dbname $credentials");
    $error2 = (!$db2) ? pg_last_error($db2) : "";
}

if (!$db1 || !$db2) {
    $data = array('status' => 'failed', 'msg' => 'Connection Error: ' . $error1 . ' ' . $error2);
} else {
    $post['column'] = (isset($post['column']) && !empty($post['column'])) ? $post['column'] : 'id';
    $post['order'] = (isset($post['order']) && !empty($post['order'])) ? $post['order'] : 'ASC';

    $table = $post['table'];
    $count = $post['count'];
    $column = $post['column'];
    $order = $post['order'];
    $offset = $post['offset'];

    if ($post['db1']['dbtype'] == "mysql") {
        //$qry1 = mysqli_query($db1, "SELECT * FROM {$table} WHERE header_id = 839");
        $qry1 = mysqli_query($db1, "SELECT * FROM `{$table}` ORDER BY {$column} LIMIT {$count} OFFSET {$offset}");
        if (!$qry1) {
            $selerror = mysqli_error($qry1);
            if (!file_exists(__DIR__ . '\logs')) {
                mkdir(__DIR__ . '\logs', 0700);
            }

            $logfile = __DIR__ . "\logs\\{$table}_{$offset}.log";
            $fh = fopen($logfile, 'a+');
            $error_log = "Select Error: {$selerror} :: \r\n SELECT * FROM `{$table}` ORDER BY {$column} LIMIT {$count} OFFSET {$offset} \r\n \r\n";
            fwrite($fh, $error_log);
            fclose($fh);
        } else {
            $res1 = mysqli_fetch_all($qry1, MYSQLI_ASSOC);
        }
    } else {
        //$qry1 = pg_query($db1, "SELECT * FROM {$table} WHERE header_id = 839");
        $qry1 = pg_query($db1, "SELECT * FROM \"{$table}\" ORDER BY {$column} LIMIT {$count} OFFSET {$offset}");
        $res1 = pg_fetch_all($qry1);
    }

    if (!empty($res1)) {
        $count = count($res1);
        $getColumns = array_keys($res1[0]);
        $insertColumns = implode('", "', $getColumns);
        $insertColumns = '"' . $insertColumns . '"';
        $values = [];
        $inserted = 0;
        foreach ($res1 as $r) {
            $col = "";
            foreach ($getColumns as $c) {
                if ($post['db2']['dbtype'] == "mysql") {
                    $r[$c] = mysqli_real_escape_string($db2, $r[$c]);
                } else {
                    $r[$c] = pg_escape_string($db2, $r[$c]);
                }
                if (empty($col)) {
                    if ((empty($r[$c]) || strpos($r[$c], '0000-00') !== false) && $r[$c] != '0') {
                        $col .= "(NULL";
                    } else {
                        $col .= "('{$r[$c]}'";
                    }
                } else {
                    if ((empty($r[$c]) || strpos($r[$c], '0000-00') !== false) && $r[$c] != '0') {
                        $col .= ", NULL";
                    } else {
                        $col .= ", '{$r[$c]}'";
                    }
                }
            }
            $col .= ")";
            $values = $col;

            // Insert single row
            if ($post['db2']['dbtype'] == "mysql") {
                $insqry = mysqli_query($db2, "INSERT INTO `{$table}` ({$insertColumns}) VALUES {$values}");
                $inserror = (!$insqry) ? mysqli_error($db2) : "";
            } else {
                $insqry = pg_query($db2, "INSERT INTO \"{$table}\" ({$insertColumns}) VALUES {$values}");
                $inserror = (!$insqry) ? pg_last_error($db2) : "";
            }

            if ($insqry) {
                $inserted++;
            } else {
                if (!file_exists(__DIR__ . '\logs')) {
                    mkdir(__DIR__ . '\logs', 0700);
                }

                $logfile = __DIR__ . "\logs\\{$table}_{$offset}.log";
                $fh = fopen($logfile, 'a+');
                $error_log = "Insert Error: {$inserror} :: \r\n INSERT INTO {$table} ({$insertColumns}) VALUES {$values} \r\n \r\n";
                fwrite($fh, $error_log);
                fclose($fh);
                //$data = array('status' => 'failed', 'msg' => "Insert Error: ".$inserror);
            }
        }

        $data = array('status' => 'success', 'msg' => "{$count} Row(s) Selected From {$table} Table and {$inserted} Row(s) Inserted.");
    } else {
        $data = array('status' => 'failed', 'msg' => "0 Row Selected From {$table} Table");
    }
}
print_r(json_encode($data));
exit;
?>