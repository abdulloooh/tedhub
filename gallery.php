
<?php require_once("admin/common.php"); ?>
<!DOCTYPE html>
<html lang="<?php echo $lang['langcode'] ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TedHub">
    <title>TedHub</title>


<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<link rel="stylesheet" href="css/bootstrap-theme.css">


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
        #tedhub{
            margin-top:100px;
        }

      p{
      	max-height: 72px;
      	white-space: wrap;
      	overflow: hidden;
      	text-overflow: ellipsis;
      }

      
    </style>


    
    <link rel="stylesheet" href="css/style.css">
  </head>


  <body>

  	<!-- start from Ebx -->

<div id="tedhub">
   
    
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
      
      <!-- <li class="nav-item admin">
        <a class="btn btn-outline-success my-2 my-sm-0" href="admin/modules.php">Admin</a>
      </li> -->
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
<div class="row">

<?php

    $modcount = 0;

    $fsmods = getmods_fs();

    # if there were any modules found in the filesystem
    if ($fsmods) {

        # get a list from the databases (where the sorting
        # and visibility is stored)
        $dbmods = getmods_db();

        # populate the module list from the filesystem 
        # with the visibility/sorting info from the database
        foreach (array_keys($dbmods) as $moddir) {
            if (isset($fsmods[$moddir])) {
                $fsmods[$moddir]['position'] = $dbmods[$moddir]['position'];
                $fsmods[$moddir]['hidden'] = $dbmods[$moddir]['hidden'];
            }
        }

        # custom sorting function in common.php
        uasort($fsmods, 'bypos');
        
       
        //re-arrange course list to bring file share to the end
        $clone_file_share_sub_array = $fsmods['en-file_share']; //remove file share
        unset ($fsmods['en-file_share']);
        $file_share = array("en-file_share" => $clone_file_share_sub_array);
        $fsmods = $file_share + $fsmods;
        // $fsmods['en-file_share'] = $clone_file_share_sub_array; //add it back to the end


        # whether or not we were able to get anything
        # from the DB, we show what we found in the filesystem
        // die(var_dump($fsmods));


        foreach (array_values($fsmods) as $mod) {
            if ($mod['hidden'] || !$mod['fragment']) { continue; }
            $dir  = $mod['dir'];
            $moddir  = $mod['moddir'];
            include $mod['fragment']; 
            // if ($mod['moddir'] == 'en-file_share');
            ++$modcount;
        }

    }

    if ($modcount == 0) {
        echo $lang['no_mods_error'];
    }

?>

</div>
</div>
  	<!-- End from Ebx -->

    <hr>

  </div><!-- /.container -->

  <!-- FOOTER -->
  <footer class="container">
    <!-- <p class="float-right"><a href="#">Back to top</a></p> -->
    <p>&copy; 2020 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>
</main>


<!-- jQuery library -->
<script type="text/javascript" src="js/jquery.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript" src="js/bootstrap.js"></script>

<script type="text/javascript" src="js/style_button_in_rachel_index.js"></script>

</body>
</html>

