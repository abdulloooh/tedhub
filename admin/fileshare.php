<?php
require_once "common.php";
if (!authorized()) {exit();}

global $lang;
$page_title = $lang['file_share'];
$page_nav = "file-share";
$page_script = "";
include "head.php";

?>
<link rel="stylesheet" href="../css/bootstrap.css">
<style>
    *, ::after , ::before {
        box-sizing: unset;
    }
    body
        {
            line-height: unset;
        }
</style>
<link rel="stylesheet" href="../css/bootstrap-theme.css">

<main role="main">
<div class="container marketing">
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

    //pick only en-file_share
    $clone_file_share_sub_array = $fsmods['en-file_share']; //remove file share
    unset($fsmods['en-file_share']);
    $file_share = array("en-file_share" => $clone_file_share_sub_array);
    $fsmods = $fsmods + $file_share;
    $fsmods = array_slice($fsmods, -1, 1);
    // $fsmods['en-file_share'] = $clone_file_share_sub_array; //add it back to the end

    # whether or not we were able to get anything
    # from the DB, we show what we found in the filesystem
    // die(var_dump($fsmods));

    foreach (array_values($fsmods) as $mod) {
        if ($mod['hidden'] || !$mod['fragment']) {continue;}
        $dir = $mod['dir'];
        $moddir = $mod['moddir'];
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
</div>
</main>




<?php
include "foot.php";
?>