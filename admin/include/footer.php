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



        CCCCCCCCCCCCCRRRRRRRRRRRRRRRRR                  AAA               FFFFFFFFFFFFFFFFFFFFFFTTTTTTTTTTTTTTTTTTTTTTTMMMMMMMM               MMMMMMMMYYYYYYY       YYYYYYYWWWWWWWW                           WWWWWWWWEEEEEEEEEEEEEEEEEEEEEEBBBBBBBBBBBBBBBBB      SSSSSSSSSSSSSSS IIIIIIIIIITTTTTTTTTTTTTTTTTTTTTTTEEEEEEEEEEEEEEEEEEEEEE       1111111                999999999                                LLLLLLLLLLL       TTTTTTTTTTTTTTTTTTTTTTT   SSSSSSSSSSSSSSS
     CCC::::::::::::CR::::::::::::::::R                A:::A              F::::::::::::::::::::FT:::::::::::::::::::::TM:::::::M             M:::::::MY:::::Y       Y:::::YW::::::W                           W::::::WE::::::::::::::::::::EB::::::::::::::::B   SS:::::::::::::::SI::::::::IT:::::::::::::::::::::TE::::::::::::::::::::E      1::::::1              99:::::::::99                              L:::::::::L       T:::::::::::::::::::::T SS:::::::::::::::S
   CC:::::::::::::::CR::::::RRRRRR:::::R              A:::::A             F::::::::::::::::::::FT:::::::::::::::::::::TM::::::::M           M::::::::MY:::::Y       Y:::::YW::::::W                           W::::::WE::::::::::::::::::::EB::::::BBBBBB:::::B S:::::SSSSSS::::::SI::::::::IT:::::::::::::::::::::TE::::::::::::::::::::E     1:::::::1            99:::::::::::::99                            L:::::::::L       T:::::::::::::::::::::TS:::::SSSSSS::::::S
  C:::::CCCCCCCC::::CRR:::::R     R:::::R            A:::::::A            FF::::::FFFFFFFFF::::FT:::::TT:::::::TT:::::TM:::::::::M         M:::::::::MY::::::Y     Y::::::YW::::::W                           W::::::WEE::::::EEEEEEEEE::::EBB:::::B     B:::::BS:::::S     SSSSSSSII::::::IIT:::::TT:::::::TT:::::TEE::::::EEEEEEEEE::::E     111:::::1           9::::::99999::::::9                           LL:::::::LL       T:::::TT:::::::TT:::::TS:::::S     SSSSSSS
 C:::::C       CCCCCC  R::::R     R:::::R           A:::::::::A             F:::::F       FFFFFFTTTTTT  T:::::T  TTTTTTM::::::::::M       M::::::::::MYYY:::::Y   Y:::::YYY W:::::W           WWWWW           W:::::W   E:::::E       EEEEEE  B::::B     B:::::BS:::::S              I::::I  TTTTTT  T:::::T  TTTTTT  E:::::E       EEEEEE        1::::1           9:::::9     9:::::9                             L:::::L         TTTTTT  T:::::T  TTTTTTS:::::S
C:::::C                R::::R     R:::::R          A:::::A:::::A            F:::::F                     T:::::T        M:::::::::::M     M:::::::::::M   Y:::::Y Y:::::Y     W:::::W         W:::::W         W:::::W    E:::::E               B::::B     B:::::BS:::::S              I::::I          T:::::T          E:::::E                     1::::1           9:::::9     9:::::9                             L:::::L                 T:::::T        S:::::S
C:::::C                R::::RRRRRR:::::R          A:::::A A:::::A           F::::::FFFFFFFFFF           T:::::T        M:::::::M::::M   M::::M:::::::M    Y:::::Y:::::Y       W:::::W       W:::::::W       W:::::W     E::::::EEEEEEEEEE     B::::BBBBBB:::::B  S::::SSSS           I::::I          T:::::T          E::::::EEEEEEEEEE           1::::1            9:::::99999::::::9                             L:::::L                 T:::::T         S::::SSSS
C:::::C                R:::::::::::::RR          A:::::A   A:::::A          F:::::::::::::::F           T:::::T        M::::::M M::::M M::::M M::::::M     Y:::::::::Y         W:::::W     W:::::::::W     W:::::W      E:::::::::::::::E     B:::::::::::::BB    SS::::::SSSSS      I::::I          T:::::T          E:::::::::::::::E           1::::l             99::::::::::::::9      ---------------        L:::::L                 T:::::T          SS::::::SSSSS
C:::::C                R::::RRRRRR:::::R        A:::::A     A:::::A         F:::::::::::::::F           T:::::T        M::::::M  M::::M::::M  M::::::M      Y:::::::Y           W:::::W   W:::::W:::::W   W:::::W       E:::::::::::::::E     B::::BBBBBB:::::B     SSS::::::::SS    I::::I          T:::::T          E:::::::::::::::E           1::::l               99999::::::::9       -:::::::::::::-        L:::::L                 T:::::T            SSS::::::::SS
C:::::C                R::::R     R:::::R      A:::::AAAAAAAAA:::::A        F::::::FFFFFFFFFF           T:::::T        M::::::M   M:::::::M   M::::::M       Y:::::Y             W:::::W W:::::W W:::::W W:::::W        E::::::EEEEEEEEEE     B::::B     B:::::B       SSSSSS::::S   I::::I          T:::::T          E::::::EEEEEEEEEE           1::::l                    9::::::9        ---------------        L:::::L                 T:::::T               SSSSSS::::S
C:::::C                R::::R     R:::::R     A:::::::::::::::::::::A       F:::::F                     T:::::T        M::::::M    M:::::M    M::::::M       Y:::::Y              W:::::W:::::W   W:::::W:::::W         E:::::E               B::::B     B:::::B            S:::::S  I::::I          T:::::T          E:::::E                     1::::l                   9::::::9                                L:::::L                 T:::::T                    S:::::S
 C:::::C       CCCCCC  R::::R     R:::::R    A:::::AAAAAAAAAAAAA:::::A      F:::::F                     T:::::T        M::::::M     MMMMM     M::::::M       Y:::::Y               W:::::::::W     W:::::::::W          E:::::E       EEEEEE  B::::B     B:::::B            S:::::S  I::::I          T:::::T          E:::::E       EEEEEE        1::::l                  9::::::9                                 L:::::L         LLLLLL  T:::::T                    S:::::S
  C:::::CCCCCCCC::::CRR:::::R     R:::::R   A:::::A             A:::::A   FF:::::::FF                 TT:::::::TT      M::::::M               M::::::M       Y:::::Y                W:::::::W       W:::::::W         EE::::::EEEEEEEE:::::EBB:::::BBBBBB::::::BSSSSSSS     S:::::SII::::::II      TT:::::::TT      EE::::::EEEEEEEE:::::E     111::::::111              9::::::9                                LL:::::::LLLLLLLLL:::::LTT:::::::TT      SSSSSSS     S:::::S
   CC:::::::::::::::CR::::::R     R:::::R  A:::::A               A:::::A  F::::::::FF                 T:::::::::T      M::::::M               M::::::M    YYYY:::::YYYY              W:::::W         W:::::W          E::::::::::::::::::::EB:::::::::::::::::B S::::::SSSSSS:::::SI::::::::I      T:::::::::T      E::::::::::::::::::::E     1::::::::::1 ......      9::::::9                                 L::::::::::::::::::::::LT:::::::::T      S::::::SSSSSS:::::S
     CCC::::::::::::CR::::::R     R:::::R A:::::A                 A:::::A F::::::::FF                 T:::::::::T      M::::::M               M::::::M    Y:::::::::::Y               W:::W           W:::W           E::::::::::::::::::::EB::::::::::::::::B  S:::::::::::::::SS I::::::::I      T:::::::::T      E::::::::::::::::::::E     1::::::::::1 .::::.     9::::::9                                  L::::::::::::::::::::::LT:::::::::T      S:::::::::::::::SS
        CCCCCCCCCCCCCRRRRRRRR     RRRRRRRAAAAAAA                   AAAAAAAFFFFFFFFFFF                 TTTTTTTTTTT      MMMMMMMM               MMMMMMMM    YYYYYYYYYYYYY                WWW             WWW            EEEEEEEEEEEEEEEEEEEEEEBBBBBBBBBBBBBBBBB    SSSSSSSSSSSSSSS   IIIIIIIIII      TTTTTTTTTTT      EEEEEEEEEEEEEEEEEEEEEE     111111111111 ......    99999999                                   LLLLLLLLLLLLLLLLLLLLLLLLTTTTTTTTTTT       SSSSSSSSSSSSSSS







-->
