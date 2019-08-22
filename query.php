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
                    <input name="search" id="search" type="search" class="form-control" id="search-input"
                        placeholder="Search for a magazine..">
                    <select name="class" id="class" class="form-control" id="search-input">
                        <option value="ALL"> ALL</option>
                        <option value="A">CLASS A</option>
                        <option value="B">CLASS B</option>
                        <option value="predateurs">CLASS PREDATEURS</option>

                    </select>
                    <button type="submit" class="btn btn-secondary" value="search"> <span
                            class="glyphicon glyphicon-search"></span>Search</button>
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
                            <button class="click-btn btn btn-default"><span class="lnr lnr-arrow-right"></span></button>
                            <div style="position: absolute; left: -5000px;">
                                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
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