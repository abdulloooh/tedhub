
<?php require_once "admin/common.php";?>
<!DOCTYPE html>
<html lang="<?php echo $lang['langcode'] ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Tedhub">
    <!-- <meta name="generator" content="Jekyll v4.0.1"> -->
    <title>TedHub</title>


<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.css">

<link rel="stylesheet" href="css/style.css">

    <!-- Favicons -->
<!-- <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c"> -->


    <style>
        #content{
            margin-top:100px;
        }
      p{
      	max-height: 72px;
      	white-space: wrap;
      	overflow: hidden;
      	text-overflow: ellipsis;
      }

    </style>

  </head>


  <body>

  	<!-- start from Ebx -->

<div id="tedhub">
    <!-- Why show IP here? Some installations have WiFi and Ethernet, and
         maybe you're on one but need to know the other. Also helps if my.content
         isn't working on some client devices. Also nice for when you need to ssh
         or rsync. It's visible in the Admin panel too, but it's more convenient here. -->
    <div id="ip">
        <?php showip();
# on the RACHEL-Plus we also show a battery meter
# XXX abstract this and the admin one into one piece of code
if (is_rachelplus()) {
    echo '
                <script>
                    refreshRate = 1000 * 60 * 10; // ten minutes on front page, be very conservative
                    function getBatteryInfo() {
                        $.ajax({
                            url: "admin/background.php?getBatteryInfo=1",
                            success: function(results) {
                                //console.log(results);
                                var vert = 0; // shows full charge (each icon down 12px)
                                if      (results.level < 20) { vert = -48; }
                                else if (results.level < 40) { vert = -36; }
                                else if (results.level < 60) { vert = -24; }
                                else if (results.level < 80) { vert = -12; }
                                var horz = 0; // 0 shows discharging, 40px offset shows charging
                                if (results.status == "charging" ) { horz = 40 }
                                $("#battery").css({
                                    background: "url(\'art/battery-level-sprite-light.png\')",
                                    backgroundPosition: horz+"px "+vert+"px",
                                });
                                $("#battery").prop("title", results.level + "%");
                            },
                            complete: function() {
                                setTimeout(getBatteryInfo, refreshRate);
                            }
                        });
                    }
                    $(getBatteryInfo); // onload
                </script>
                <br><b>Battery</b>: <div id="battery"></div><span id="perc"></span>
            ';
}
?>
    </div>

</div>

<!-- end from Ebx -->

    <header>
  	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  	<a class="navbar-brand" href="/index.php"><img src="images/logo.jpg" style="heigt: 70px; width: 100px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="about.php">About </a>
        </li>

        <!-- start from Ebx -->

        <?php
if (show_local_content_link()) {
    echo "<li><a href=\"http://$_SERVER[SERVER_ADDR]:8090/\" target=\"_self\">LOCAL CONTENT</a></li>";
}
?>

        <!-- end from Ebx -->


        <!-- <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li> -->
      </ul>
      <!-- <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> -->
      <li class="nav-item admin">
        <a class="btn btn-outline-success my-2 my-sm-0" href="admin/modules.php">Admin</a>
      </li>
    </div>
  </nav>
</header>

<main role="main">




  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

  	<!-- start from Ebx -->

<div id="content">

<h3>About Us</h3>

<p>TedPrime Hub is an Edtech Consulting Firm (with its parent organization - TedPrime Support Initiative) that aligns itself to the 2030 Agenda of the United Nations Sustainable Development Goals using education and technology as rallying points to build future-ready youths and workforce. </p>
<p>TedPrime Hub is revamping Nigeria’s educational sector from primary to tertiary education sector using array of innovative practices and infrastructure framework and sustainable partnerships both locally and globally.</p>

<h3>About Edubox</h3>

<p>Edubox is an innovative WiFi device that provides real time access to millions of learning resources to students without internet. It is suitable for home learning, school e-library set up, community learning centres and correctional homes. The resources are well tailored in line with Nigerian curriculum and global education standards with every user having a great access to add local learning resources.</p>
<p>For corporate partnership, enquiries or service request on Edubox Technology:</p>

<p>Visit <a href="www.tedprimehub.org">www.tedprimehub.org</a> </p>
<Twitter:>E-mail: <a href="mailto:info@tedprimehub.org">info@tedprimehub.org</a> <br>
 Twitter: <a href="https://twitter.com/tedprimehub">@tedprimehub</a> <br> Facebook: TedPrime Support Initiative <br> or call +2347080595110 </p>

<h3>Correspondence</h3>

<address>
    TedPrime Hub & Support Initiative Building, <br>
    Beside Baptist Girls’ College, Idi Aba, <br>
    Abeokuta, Ogun State, <br>
    Nigeria <br>
</address>


</div>


    <hr>

  <!-- FOOTER -->
  <?php include "footer.php";?>
</main>


<!-- jQuery library -->
<script type="text/javascript" src="js/jquery.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript" src="js/bootstrap.js"></script>

<script type="text/javascript" src="js/style_button_in_rachel_index.js"></script>

</body>
</html>

