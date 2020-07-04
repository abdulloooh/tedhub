<!--abdullooh-->
<link rel="stylesheet" href="../../css/bootstrap.css">
<link rel="stylesheet" href="../../css/normalize-1.1.3.css">
<link rel="stylesheet" href="../../css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
<link rel="stylesheet" href="../../css/font_and_bg.css">
<link rel="stylesheet" href="../../css/module.css">
<script src="../../js/jquery-1.10.2.min.js"></script>
<script src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
<!--abdullooh-->




<!--abdullooh-->
<body>
<!--abdullooh-->


<div class="container">
<div class="indexmodule">

    <?php
        $host    = "//$_SERVER[SERVER_NAME]:81";
        $zim     = "wikipedia_en_for_schools_opt_2013";
        $baseurl = "$host/$zim";
    ?>

    <form action="<?php echo $host ?>/search" id="wikipedia-school-en-search-form">
      <div>
        <input type="text" id="wikipedia-school-en-search-box" name="pattern" value="" autocomplete="off">
        <input type="submit" name="search" value="Search">
        <input type="hidden" name="content" value="<?php echo $zim ?>">
      </div>
    </form>

    <script>
      $(function() {
        $( "#wikipedia-school-en-search-box" ).autocomplete({
          source: "<?php echo $host ?>/suggest?content=<?php echo $zim ?>",
          dataType: "json",
          cache: false,
          select: function(event, ui) {
            $( "#wikipedia-school-en-search-box" ).val(ui.item.value);
            $( "#wikipedia-school-en-search-form" ).submit();
          },
        });
      });
    </script>

    <a href="<?php echo $baseurl ?>/" target="_blank"><img src="<?php echo $dir ?>/wfs_logo_smooth.jpg" alt="Wikipedia for Schools"></a>

    <h2><a href="<?php echo $baseurl ?>/" target="_blank">Wikipedia for Schools</a></h2>

    <p>This curated selection of articles from Wikipedia can be used offline by
school children around the world. 6000 articles, 26 million words and 50,000
images make Wikipedia for Schools bigger than Harry Potter, the Lord of the
Rings and the Chronicles of Narnia put together!</p>

    <ul class="triple">
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Art.htm" target="content">Art</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Business_Studies.htm" target="content">Business Studies</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Citizenship.htm" target="content">Citizenship</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Countries.htm" target="content">Countries</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Design_and_Technology.htm" target="content">Design and Technology</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Everyday_life.htm" target="content">Everyday life</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Geography.htm" target="content">Geography</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.History.htm" target="content">History</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.IT.htm" target="content">IT</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Language_and_literature.htm" target="content">Language and Literature</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Mathematics.htm" target="content">Mathematics</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Music.htm" target="content">Music</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.People.htm" target="content">People</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Portals.htm" target="content">Portals</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Religion.htm" target="content">Religion</a></li>
	<li><a href="<?php echo $baseurl ?>/A/wp/index/subject.Science.htm" target="content">Science</a></li>
    </ul>

</div>

</div>

</body>