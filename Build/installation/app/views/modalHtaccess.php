<div class="modal fade" tabindex="-1" id="htaccessModal">
    <div class="modal-dialog bg-light modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    <h2 class="modal-title">INSTALLATION > HTACCESS:</h2>
                    <div class="alert alert-danger">
                        <strong>Attention : Vous pouvez vous exposez à des failles critiques !</strong>
                        <br/>
                        Il semble que votre site soit susceptible de provoquer des failles htaccess rendant plusieurs informations sensibles visibles à la vue de tous ! Le test peut cependant être un faux positif, pour en être sur dirigez-vous vers notre <a href="https://discord.gg/wMVAeug" target="_blank">Discord</a> ou sur notre <a href="https://craftmywebsite.fr/forum" target="_blank">forum</a> pour vous aider. Sinon vous pouvez essayer par vous même en allant sur <a href="../modele/config/config.yml" target="_blank">ce lien</a>, si vous atterrissez sur une demande d'authentification, alors c'est un faux positif, si vous voyez du texte c'est que votre site est réellement exposé à des failles critiques.
                    </div>
                </p>
                <h3 class="modal-title text-center center">Que voulez-vous faire ?</h3>
            </div>
            <div class="modal-footer">
                <div class="row" style="width: 100%;">
                    <div class="col-md-6">
                        <a href="?forceHtaccess=true" class="btn btn-danger btn-block minecrafter">Forcer l'installation</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block minecrafter" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>