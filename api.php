<?php
error_reporting(-1);
ini_set('display_errors', 'On');
include('conf/config.php');

/////////////////

$output = "";
// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//------------------------------

if (array_key_exists("query", $_POST) and array_key_exists("action", $_POST) and in_array($_POST["action"], ["s", "r"])) {

    $searchq = filter_var($_POST['query'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($_POST["action"] == "r") {
        $page = (array_key_exists('page',$_POST) and intval($_POST["page"]) != 0)? $_POST["page"] : 1;

        $class = "";
        $or = false;
        
        if (array_key_exists('class_A',$_POST) and strtolower($_POST["class_A"]) == "on") {
            $class = " category = 'A'  ";
            $or = true;
        }
        if (array_key_exists('class_B',$_POST) and strtolower($_POST["class_B"]) == "on") {
            $class .= ($or)? " OR " : "";
            $class .= " category = 'B'  ";
            $or = true;
        }
        if (array_key_exists('class_C',$_POST) and strtolower($_POST["class_C"]) == "on") {
            $class .= ($or)? " OR " : "";
            $class .= " category = 'C'  ";
            $or = true;
        }
        if (array_key_exists('class_P',$_POST) and strtolower($_POST["class_P"]) == "on") {
            $class .= ($or)? " OR " : "";
            $class .= " category = 'P'  ";
            $or = true;
        }
        if ($or) {
            $class .= ($or)? " AND " : "";
        }

        $publisher = (array_key_exists('publisher',$_POST) and strtolower($_POST["publisher"]) == "on")? true : false;
        $count_per_page = 20;
        $items_per_page = 20;
        $offset = ($page - 1) * $items_per_page;

        
        $query_phrase1 = ($publisher)? "SELECT* FROM magazines WHERE $class  (titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%')"
                                    : "SELECT* FROM magazines WHERE $class  titre LIKE '%$searchq%' " ;
        $q1 = $conn->query($query_phrase1);
        $count1 = $q1->rowCount();
        
        $query_phrase = ($publisher)? "SELECT* FROM magazines WHERE $class  (titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%') LIMIT $offset ,$items_per_page" 
                                    : "SELECT* FROM magazines WHERE $class  titre LIKE '%$searchq%' LIMIT $offset ,$items_per_page" ;
        $q  = $conn->query($query_phrase);
        $count = $q->rowCount();


        
        $total_page = intval($count1 / $items_per_page) + 2;
        if ($page == 1) {
            // id
            if (array_key_exists("sid",$_COOKIE)) {
                $id = $_COOKIE["sid"];
            }
            else {
                $id = uniqid(date('ymdhisa') . "_");

                setcookie(
                    "sid",
                    $id,
                    time() + (10 * 365 * 24 * 60 * 60),
                    "",
                    "",
                    true,
                    true
                );   
            }
            //user agent
            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            //get used_IP
            function getUserIpAddr() {
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    //ip from share internet
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                }
                elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    //ip pass from proxy
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                return $ip;
            }
            $ip = getUserIpAddr();

            //time 
            $date = date('y/m/d h:i:s');

            $insert = "INSERT INTO search_log (user_id, user_agent, user_ip, search_query, stime) VALUES ('$id','$user_agent','$ip','$searchq','$date') ";
            $conn->query($insert); 
        }
        header('Content-type: application/json');
        echo json_encode([
            "count" => $count1,
            "data" => $q->fetchAll(PDO::FETCH_ASSOC)
            ]);
    } else {
        $query_mostsearch = "SELECT DISTINCT lower(search_query) as sq, COUNT(search_query) as cnt FROM search_log WHERE search_log.search_query LIKE '%$searchq%' GROUP BY lower(search_query) ORDER BY cnt DESC";
        $q  = $conn->query($query_mostsearch);
        header('Content-type: application/json');
        echo json_encode($q->fetchAll(PDO::FETCH_ASSOC));
    }
}