<?php
set_time_limit(300);
error_reporting(0);

$post = $_POST;

if ($post['dbtype'] == "mysql") {
    $host = $post['host'];
    $port = $post['port'];
    $dbname = $post['database'];
    $username = $post['username'];
    $password = $post['password'];

    $db = mysqli_connect($host, $username, $password, $dbname);
    $error1 = (!$db1) ? mysqli_connect_error() : "";
} else {
    $host = "host = {$post['host']}";
    $port = "port = {$post['port']}";
    $dbname = "dbname = {$post['database']}";
    $credentials = "user = {$post['username']} password={$post['password']}";

    $db = pg_connect("$host $port $dbname $credentials");
    $error1 = (!$db1) ? pg_last_error() : "";
}

if (!$db) {
    $data = array('status' => 'failed', 'msg' => 'Database Not Connected ' . pg_last_error($db));
} else {
    $post['column'] = (isset($post['column']) && !empty($post['column'])) ? $post['column'] : 'id';
    $post['order'] = (isset($post['order']) && !empty($post['order'])) ? $post['order'] : 'ASC';

    $table = $post['table'];
    $count = $post['count'];
    $column = $post['column'];
    $order = $post['order'];

    $qry = "DELETE FROM {$table} WHERE {$column} IN (SELECT {$column} FROM {$table} ORDER BY 1 {$order} LIMIT {$count})";

    if ($post['dbtype'] == "mysql") {
        $q = mysqli_query($db, $qry);
        $delete_error = (!q) ? mysqli_error($db) : "";
    } else {
        $q = pg_query($db, $qry);
        $delete_error = (!q) ? pg_last_error($db) : "";
    }

    if (!empty($delete_error)) {
        if (!file_exists(__DIR__ . '\logs')) {
            mkdir(__DIR__ . '\logs', 0700);
            mkdir(__DIR__ . '\logs\delete', 0700);
        } else if (!file_exists(__DIR__ . '\logs\delete')) {
            mkdir(__DIR__ . '\logs\delete', 0700);
        }

        $logfile = __DIR__ . "\logs\delete\{$table}_{$offset}.log";
        $fh = fopen($logfile, 'a+');
        $error_log = "Delete Error: {$delete_error} :: \r\n {$qry}";
        fwrite($fh, $error_log);
        fclose($fh);

        $data = array('status' => 'failed', 'msg' => "Error in deleting : " . pg_last_error($db));
    } else {
        $data = array('status' => 'success', 'msg' => "{$count} Row(s) Deleted From {$table} Table");
    }
}
print_r(json_encode($data));
exit;
?>