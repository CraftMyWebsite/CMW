<style>
.blur{
    backdrop-filter: blur(8px);
}
</style>
<?php
$distant = file_get_contents('http://craftmywebsite.fr/release/version.txt');
if($distant == $versioncms){
    $typeversion = "stable";
}else{
    if($distant < $versioncms){
        $typeversion = "beta";
    }else{
        $typeversion = "outdated"; ?>
        <div class="modal blur show" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="modal" style="">
            <div class="modal-dialog modal-xl" role="document">
                    <div class="alert alert-danger">
                        <p class="text-center" style="text-align: center !important;">
                        <center>
                            <h2>ATTENTION:</h2> Il semble que vous essayez d'installer une version antérieure du CMS !<br/>
                            Le support forum / discord n'est pas assuré sur les version antérieure à la <strong><?=$distant;?></strong> or vous semblez être sur la version <strong><?=$versioncms;?></strong><br/>
                            Continuez uniquement si vous savez ce que vous faites<br/>
                        </center>
                        </p>
                </div>
            </div>
        </div>
    <?php    
    }
} ?>
<h4 class="mb-3"> Version - #<?=$versioncms;?> (<?=$typeversion;?>)</h4>

<div class="accordion" id="accordionExample">

            <h2 class="mb-3">
                <button class="btn btn-block btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Conditions Générales d'Utilisation
                </button>
            </h2>
            <div id="collapseOne" class="collapse show bg-light" aria-labelledby="headingOne" data-parent="#accordionExample" style="margin:0px;">
                <?php include('app/miscellaneous/cgu.php'); ?>
            </div>

</div>
<hr class="mb-4">
            <a href="?action=cgu" class="btn btn-primary btn-lg btn-block">J'ai lu et j'accepte les conditions générales d'utilisation</a>
