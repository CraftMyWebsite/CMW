<footer class="footer" style="overflow-x: hidden !important;">
    <div class="row">
        <div class="col-md-4  offset-md-2">
            <p class="text-muted footer-text" style="padding-left: 15px;">
                <a href="https://craftmywebsite.fr/" target="_blank">CraftMyWebsite #<?php echo $versioncms; ?></a> | <a
                        href="https://discord.gg/P94b7d5" target="_blank">Discord</a> | <a
                        href="https://github.com/CraftMyWebsite/CMW" target="_blank">GitHub</a>
            </p>
        </div>
        <div class="col-md-6">
            <p class="gray text-right footer-text" style="padding-right: 15px;">
                &copy; 2014 -
                <script>document.write(new Date().getFullYear())</script>
                CraftMyWebsite, tous droits réservé
            </p>
            <div class="custom-control custom-switch">
                <form id="darkForm" method="POST" action="">
                    <?php
                    if (isset($_SESSION['darkSwitch'])) {
                        echo '<input type="hidden" name="removeDarkSwitch" id="removeDarkSwitch" value="1">
                                <input type="checkbox" class="custom-control-input" id="darkSwitch" name="darkSwitch" value="1" checked>';

                    } else {
                        echo '<input type="checkbox" class="custom-control-input" id="darkSwitch" name="darkSwitch" value="1">';
                    }
                    ?>
                    <label class="custom-control-label" for="darkSwitch"><i class="fas fa-moon"></i> Mode Nuit</label>
                </form>
            </div>
        </div>
    </div>
</footer>
<script src="./admin/assets/js/popper.min.js"></script>
<script src="./admin/assets/js/main.js"></script>
<?php include './admin/assets/js/ckeditorManager.php'; ?>
<script src="./admin/assets/js/bootstrap.js"></script>
<script src="./admin/assets/js/dark.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.13.1/js/all.js"></script>

</body>
</html>
<!-- 

  .oooooo.   ooooooooo.         .o.       oooooooooooo ooooooooooooo ooo        ooooo oooooo   oooo oooooo   oooooo     oooo oooooooooooo oooooooooo.   .oooooo..o ooooo ooooooooooooo oooooooooooo        .o       .ooooo.   
 d8P'  `Y8b  `888   `Y88.      .888.      `888'     `8 8'   888   `8 `88.       .888'  `888.   .8'   `888.    `888.     .8'  `888'     `8 `888'   `Y8b d8P'    `Y8 `888' 8'   888   `8 `888'     `8      o888      d88'   `8. 
888           888   .d88'     .8"888.      888              888       888b     d'888    `888. .8'     `888.   .8888.   .8'    888          888     888 Y88bo.       888       888       888               888      Y88..  .8' 
888           888ooo88P'     .8' `888.     888oooo8         888       8 Y88. .P  888     `888.8'       `888  .8'`888. .8'     888oooo8     888oooo888'  `"Y8888o.   888       888       888oooo8          888       `88888b.  
888           888`88b.      .88ooo8888.    888    "         888       8  `888'   888      `888'         `888.8'  `888.8'      888    "     888    `88b      `"Y88b  888       888       888    "          888      .8'  ``88b 
`88b    ooo   888  `88b.   .8'     `888.   888              888       8    Y     888       888           `888'    `888'       888       o  888    .88P oo     .d8P  888       888       888       o       888  .o. `8.   .88P 
 `Y8bood8P'  o888o  o888o o88o     o8888o o888o            o888o     o8o        o888o     o888o           `8'      `8'       o888ooooood8 o888bood8P'  8""88888P'  o888o     o888o     o888ooooood8      o888o Y8P  `boood8'  
                                                                                                                                                                                                                                                                                                                                                                                                                                             
-->
