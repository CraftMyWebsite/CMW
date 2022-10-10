<div class="modal fade" tabindex="-1" id="sqlmodal" style="" data-keyboard="false" data-backdrop="true">
    <div class="modal-dialog bg-light modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    <h2 class="modal-title">INSTALLATION > SQL:</h2>
                    <div class="alert alert-danger">
                        Il semble que vous essayez d'installer le CMS sur une base de données qui n'est pas vide <strong> et qui contient des données du CMS</strong> ! Cela peut entrainer des conflits majeurs et fausser l'installation !
                        <br/>
                    </div>
                </p>
                <h3 class="modal-title text-center center">Que voulez-vous faire ?</h3>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4">
                        <a href="?forceInstallSQL=true"class="btn btn-danger btn-block minecrafter">Forcer l'installation</a>
                    </div>
                    <div class="col-md-4">
                        <a href="?dropSQL=true" class="btn btn-success btn-block minecrafter">Vider la base de donnéees puis forcer l'installation (Recommandé) <strong>[Irréversible]</strong></a>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-block minecrafter" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
