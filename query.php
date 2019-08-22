<?php



error_reporting(-1);
ini_set('display_errors', 'On');
include('conf/config.php');

/////////////////

$output = "";
// Create connection
$conn   = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//------------------------------


$page = 1;
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
    if (false === $page) {
        // $page = 1;
    }
}

$search="";
if (isset($_GET['search'])) {
    $searchq = $_GET['search'];
    
    if (isset($_GET['class'])) {
        $class = $_GET['class'];
        

        
        if ($class == 'ALL') {
            $_class = "";
        } else {
            
            $_class = " category = '$class' AND ";
        }
        
    }
     
    $count_per_page = 20;
    $items_per_page = 20;
    $offset         = ($page - 1) * $items_per_page;
    
    if ($_GET['class'] == 'ALL') {
        $query_phrase1 = "SELECT* FROM magazines WHERE titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%'";
        $query_phrase  = "SELECT* FROM magazines WHERE titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%' LIMIT " . $offset . " ," . $items_per_page;
    } else {
        
        
        $query_phrase1 = "SELECT* FROM magazines WHERE  $_class (titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%'  )";
        $query_phrase  = "SELECT* FROM magazines WHERE  $_class (titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%') LIMIT " . $offset . " ," . $items_per_page;
    }
    
    $query1 = mysqli_query($conn, $query_phrase1) or die("Can't execute Query");
    $query = mysqli_query($conn, $query_phrase) or die("Can't execute Query");
    //~ $query_phrase  ="SELECT * FROM magazines  WHERE MATCH (titre, publisher) AGAINST ('.$searchq.' IN NATURAL LANGUAGE MODE) LIMIT 0 , 50 ;";
    //~ $query =mysqli_query( $conn, $query_phrase) or die("Can't execute Query") ;
    $count2     = mysqli_num_rows($query1);
    $count      = mysqli_num_rows($query);
    $total_page = intval($count2 / $items_per_page) + 2;

    if ($count == 0) {
        $output = "there is no search result
  <h2>Suggestions</h2>

<h6> Check your spelling </h6>
<h6>Try more general search query </h6>
<h6>Try different keywords </h6>
<h6>Browse Journal Rankings </h6>";
    } else {
        
    }
    while ($row = mysqli_fetch_array($query)) {
        
        
        $title     = $row['titre'];
        $ID        = $row['id'];
        $publisher = $row['publisher'];
        $ISSN      = $row['issn'];
        $ESSN      = $row['essn'];
        $FolderN   = $row['foldername'];
        $CLASSE    = $row['category'];
        $URL       = $row['url'];
        if (true) {
            $q   = str_replace(" ", "+", $title);
            $URL = "https://www.scimagojr.com/journalsearch.php?q=" . $q;
            //~ echo $URL;
        }
        
        $output .= '

    <div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">' . $title . '</h5>
        <p class="card-text">
            <p class="class">CLASS :(' . $CLASSE . ')</p>
            <p class="pub">Publisher:' . $publisher . ' | ISSN: ' . $ISSN . ', ESSN : ' . $ESSN . '</p>
        </p>
        <a href="' . $URL . '"
            class="card-link">Magazine url</a>
    </div>
</div>             
 ';
        
        
    }

   
}

//get used_ID
session_start();
$session_id=session_id();
$_SESSION['theVar'] = "theData";



//get used_IP
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$UserIpAddr = getUserIpAddr() ;




// user agent 
function getBrowser() { 
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";
  //get the platform?
  // if (preg_match('/linux/i', $u_agent)) {
  //   $platform = 'linux';
  // }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
  //  $platform = 'mac';
  // }elseif (preg_match('/windows|win32/i', $u_agent)) {
  //   $platform = 'windows';
  // }

  // get the name of the useragent yes seperately and for good reason
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Firefox/i',$u_agent)){
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  }elseif(preg_match('/OPR/i',$u_agent)){
    $bname = 'Opera';
    $ub = "Opera";
  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Apple Safari';
    $ub = "Safari";
  }elseif(preg_match('/Netscape/i',$u_agent)){
    $bname = 'Netscape';
     $UB = "NETSCAPE";
   }ELSEIF(PREG_MATCH('/EDGE/I',$U_AGENT)){
     $BNAME = 'EDGE';
     $UB = "EDGE";
   }ELSEIF(PREG_MATCH('/TRIDENT/I',$U_AGENT)){
     $BNAME = 'INTERNET EXPLORER';
     $UB = "MSIE";
   }


  return array(
    'userAgent' => $u_agent,
    'name'      => $bname,

  );
} 
$ua = getBrowser() ;
$Browser = $ua['name'];


//time 
$date = date('y/m/d h:i:s a', time());



   // most Search 
if ($search != "") {
    # code...


   $insert = "INSERT INTO search_log (user_id, user_agent, user_ip, search_query, stime) VALUES ('$session_id','$Browser','$UserIpAddr','$searchq','$date') ";
   $query2 = mysqli_query($conn, $insert); 
  
   if (!$query2) {
       printf("Error: %s\n", mysqli_error($conn));
       exit();
   }else {

   }
} 

  
$query_mostsearch = "SELECT search_query, COUNT(search_query) FROM search_log GROUP BY search_query ORDER BY COUNT(search_query) DESC" ;
$query4 = mysqli_query($conn, $query_mostsearch) or die("Can't execute Query");
$search = array(); 
while ($row=mysqli_fetch_array($query4)) $search[] =$row;


//echo json_encode($search) ;

$fp = fopen('json.json', 'w');
fwrite($fp, json_encode($search));
fclose($fp)



?>
 
 
 <!DOCTYPE html>
 <html lang="eng" class="no-js">

 <head>

     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="shortcut icon" href="img/fav.png">

     <meta name="author" content="codepixer">

     <meta name="description" content="">

     <meta name="keywords" content="">

     <meta charset="UTF-8">

     <title>Educature Education</title>
     <!--<link href="https://fonts.googleapis.com/css?family=:300,500,600" rel="stylesheet">-->
     <link rel="stylesheet" href="css/Montserrat.css">
     <!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500i" rel="stylesheet">-->
     <link rel="stylesheet" href="css/Roboto.css">

     <link rel="stylesheet" href="css/themify-icons.css">
     <link rel="stylesheet" href="css/linearicons.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/bootstrap.css">
     <link rel="stylesheet" href="css/magnific-popup.css">
     <link rel="stylesheet" href="css/nice-select.css">
     <link rel="stylesheet" href="css/animate.min.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/main.css">
     <link rel="stylesheet" href="css/style.css">
 </head>

 <body>

     <header id="header">
         <div class="container">
             <div class="row align-items-center justify-content-between d-flex">
                 <div id="logo">
                     <a href="index.html"><img src="img/logo.png" alt="" title="" /></a>
                 </div>
                 <nav id="nav-menu-container">
                     <ul class="nav-menu">
                         <li class="menu-active"><a href="index.html">Home</a></li>
                         <li><a href="about.html">About</a></li>
                         <li><a href="courses.html">Courses</a></li>
                         <li class="menu-has-children"><a href="index.html">Pages</a>
                             <ul>
                                 <li><a href="elements.html">Elements</a></li>
                             </ul>
                         </li>
                         <li class="menu-has-children"><a href="index.html">Blog</a>
                             <ul>
                                 <li><a href="blog-home.html">Blog Home</a></li>
                                 <li><a href="blog-single.html">Blog Details</a></li>
                             </ul>
                         </li>
                         <li><a href="contact.html">Contact</a></li>
                     </ul>
                 </nav>
             </div>
         </div>
     </header>
    <form action="query.php" method="get">
     <section class="search-header-area relative">
         <div class="top-part">
             <div class="big">
                 <h1 class="title">Tasnif</h1>
             </div>
         </div>
         <div class="input-part">
             <div class="form-group">
                 <input name="search" id="search"  type="search" class="form-control" id="search-input" placeholder="Search for a magazine..">
                 <select name="class" id="class" class="form-control" id="search-input">
                   <option value="ALL"> ALL</option>
                   <option value="A">CLASS A</option>
                   <option value="B">CLASS B</option>
                 <option value="predateurs">CLASS PREDATEURS</option>
  
</select>
                 <button type="submit" class="btn btn-secondary" value="search"> <span class="glyphicon glyphicon-search"></span>Search</button>
             </div>
         </div>
     </section>
     </form>
     <section class="search-results-area relative">
         <div class="container">
           <?php
print $output;
?>

             </div>
 
 
         </div>
     </section>
     <?php
for ($i = 1; $i < $total_page; $i++) {
    $pageurl = "http://127.0.0.1/dashboard/TheSearch-master%20-%20Copie/TheSearch-master/query.php?search=$searchq&page=$i";
    echo ' <a href="' . $pageurl . '">' . $i . '</a>';
    
    
    
    
    
}
?>
    <footer class="footer-area section-gap">
         <div class="container">
             <div class="row">
                 <div class="col-lg-2 col-md-6 single-footer-widget">
                     <h4>Top Products</h4>
                     <ul>
                         <li><a href="index.html#">Managed Website</a></li>
                         <li><a href="index.html#">Manage Reputation</a></li>
                         <li><a href="index.html#">Power Tools</a></li>
                         <li><a href="index.html#">Marketing Service</a></li>
                     </ul>
                 </div>
                 <div class="col-lg-2 col-md-6 single-footer-widget">
                     <h4>Quick Links</h4>
                     <ul>
                         <li><a href="index.html#">Jobs</a></li>
                         <li><a href="index.html#">Brand Assets</a></li>
                         <li><a href="index.html#">Investor Relations</a></li>
                         <li><a href="index.html#">Terms of Service</a></li>
                     </ul>
                 </div>
                 <div class="col-lg-2 col-md-6 single-footer-widget">
                     <h4>Features</h4>
                     <ul>
                         <li><a href="index.html#">Jobs</a></li>
                         <li><a href="index.html#">Brand Assets</a></li>
                         <li><a href="index.html#">Investor Relations</a></li>
                         <li><a href="index.html#">Terms of Service</a></li>
                     </ul>
                 </div>
                 <div class="col-lg-2 col-md-6 single-footer-widget">
                     <h4>Resources</h4>
                     <ul>
                         <li><a href="index.html#">Guides</a></li>
                         <li><a href="index.html#">Research</a></li>
                         <li><a href="index.html#">Experts</a></li>
                         <li><a href="index.html#">Agencies</a></li>
                     </ul>
                 </div>
                 <div class="col-lg-4 col-md-6 single-footer-widget">
                     <h4>Newsletter</h4>
                     <p>You can trust us. we only send promo offers,</p>
                     <div class="form-wrap" id="mc_embed_signup">
                         <form target="_blank"
                             action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                             method="get" class="form-inline">
                             <input class="form-control" name="EMAIL" placeholder="Your Email Address"
                                 onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''"
                                 onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Your Email Address '"
                                 required="" type="email" data-cf-modified-fe4646238a4462a1619516de-="">
                             <button class="click-btn btn btn-default"><span
                                     class="lnr lnr-arrow-right"></span></button>
                             <div style="position: absolute; left: -5000px;">
                                 <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
                                     type="text">
                             </div>
                             <div class="info"></div>
                         </form>
                     </div>
                 </div>
             </div>
             <div class="footer-bottom row align-items-center">
                 <p class="footer-text m-0 col-lg-8 col-md-12">
                     Copyright &copy;<script type="fe4646238a4462a1619516de-text/javascript">
                         document.write(new Date().getFullYear());
                     </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                         aria-hidden="true"></i> by
                     <a href="https://colorlib.com" target="_blank">Colorlib</a>
                 </p>
                 <div class="col-lg-4 col-md-12 footer-social">
                     <a href="index.html#"><i class="fa fa-facebook"></i></a>
                     <a href="index.html#"><i class="fa fa-twitter"></i></a>
                     <a href="index.html#"><i class="fa fa-dribbble"></i></a>
                     <a href="index.html#"><i class="fa fa-behance"></i></a>
                 </div>
             </div>
         </div>
     </footer>


     <div id="back-top">
         <a title="Go to Top" href="index.html#"></a>
     </div>

     <script src="js/vendor/jquery-2.2.4.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/popper.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/vendor/bootstrap.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/easing.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/hoverIntent.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/superfish.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/jquery.ajaxchimp.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/jquery.magnific-popup.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/owl.carousel.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/owl-carousel-thumb.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/jquery.sticky.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/jquery.nice-select.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/parallax.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/waypoints.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/wow.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/jquery.counterup.min.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/mail-script.js" type="fe4646238a4462a1619516de-text/javascript"></script>
     <script src="js/main.js" type="fe4646238a4462a1619516de-text/javascript"></script>


     <script src="js/rocket-loader.min.js" data-cf-settings="fe4646238a4462a1619516de-|49" defer=""></script>
 </body>

 </html>