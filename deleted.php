    <!-- start from Ebx -->

<!-- removed from index where div with id of rachel and gallery where div with id of tedhub -->

<div id="rachel">
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

    <!-- Three columns of text below the carousel
    <div class="row"> -->

    <!--   <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
        <h2>Heading</h2>
        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div> -->


      <!-- <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
        <h2>Heading</h2>
        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div> -->
<!-- 
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
        <h2>Heading</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div> -->

    <!-- </div>/.row -->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">
<!-- 
    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div>

    <hr class="featurette-divider">
 -->
    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->

