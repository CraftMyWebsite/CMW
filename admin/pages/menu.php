<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Gestion des Menus
    </h2>
</div>
<?php if (!$_Permission_->verifPerm('PermsPanel', 'menus', 'showPage')) { ?>
    <div class="col-md-12 text-center">
        <div class="alert alert-danger">
            <strong>Vous avez aucune permission pour accéder aux menus.</strong>
        </div>
    </div>
<?php } else {
    ?>
    <div class="alert alert-success">
        <strong>Vous pouvez créer et modifier des menus qui seront visibles sur la barre du menu principal. Vous pouvez
            aussi éditer des listes déroulantes. Ce lien basique contient juste un nom et une adresse, vous pouvez
            choisir parmis 2 catégories pour l'adresse: une page du site (par exemple une page "nous rejoindre !") ou un
            lien direct(comme un lien "faire un don"). Vous devez créer la page avant de la mettre sur le menu ! Pour
            gérer une liste déroulante, vous y attribuez au départ un nom et un premier élément de la liste, vous
            pourrez rajouter une infinité de liens sur votre liste par la suite!</strong>
    </div>
    <div class="row">
        <?php if ($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'addLinkMenu')) { ?>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title"><strong>Création d'un lien</strong></h3>
                    </div>
                    <div class="card-body" id="newLien">

                        <label class="control-label">Nom</label>
                        <input type="text" class="form-control" name="name" placeholder="Nom du lien" required>

                        <label class="control-label">Liste déroulante</label>
                        <select name="dest" class="form-control" required>
                            <option value="-1" selected>Aucune</option>
                            <?php foreach ($menu as $value) {
                                if (isset($value['list'])) { ?>
                                    <option id="list-option-<?php echo $value['id']; ?>"
                                            value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                <?php }
                            } ?>
                        </select>

                        <label class="control-label">type de redirection</label>
                        <select name="methode" class="form-control" onclick="
          if(parseInt(this.value) == 1) {
            hide('typePage');
            show('typeLien');
          } else {
            show('typePage');
            hide('typeLien');
          }
          " required>
                            <option value="1">Lien</option>
                            <option value="2">Page</option>
                        </select>

                        <div id="typeLien">
                            <label class="control-label">Lien</label>
                            <input type="text" class="form-control" name="lien" placeholder="ex: http://minecraft.net/">
                        </div>
                        <div id="typePage" style="display:none;">
                            <label class="control-label">Page</label>
                            <select class="form-control" name="page">
                                <?php $i = 0;
                                while ($i < count($pages)) { ?>
                                    <option id=""
                                            value="<?php echo $pages[$i]; ?>"><?php echo $pages[$i]; ?></option><?php $i++;
                                } ?>
                            </select>
                        </div>
                    </div>

                    <script>initPost('newLien', 'admin.php?action=addMenu', function (data) {
                            if (data) {
                                menuUpdate();
                                clearAllInput('newLien');
                            }
                        });</script>
                    <div class="card-footer">
                        <div class="text-center">
                            <input type="submit" onclick="sendPost('newLien', null);"
                                   class="btn btn-success btn-block w-100" value="Valider"/>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        if ($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'addDropLinkMenu')) { ?>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title"><strong>Création d'une liste déroulante</strong></h3>
                    </div>
                    <div class="card-body" id="newListe">

                        <label class="control-label">Nom</label>
                        <input type="text" class="form-control" name="name" placeholder="Nom de la liste" required>

                        <input type="hidden" name="dest" value="-1"/>

                        <small>Vous pourrez éditer la liste plus tard..</small>
                    </div>

                    <script>initPost('newListe', 'admin.php?action=addMenu', function (data, ret) {
                            if (data) {
                                menuUpdate();
                                let id = parseInt(ret.substring(ret.indexOf('[DIV]') + 5).replace(" ", ""));
                                getElementByName('newLien', 'dest').insertAdjacentHTML("beforeend", "<option value='" + id + "'>" + getElementByName('newListe', 'name').value + "</option>");
                                clearAllInput('newListe');
                            }
                        });</script>
                    <div class="card-footer">
                        <div class="text-center">
                            <input type="submit" onclick="sendPost('newListe', null, false);"
                                   class="btn btn-success btn-block w-100" value="Valider"/>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        if ($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editLinkMenu')) { ?>

            <div class="col-md-12 col-xl-12 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title"><strong>Modifier les Menus</strong></h3>
                    </div>
                    <div class="card-body" id="allMenu">


                        <ul class="nav nav-tabs">
                            <?php $first = true;
                            foreach ($menu as $value) {
                                if ($value['dest'] == -1) { ?>
                                    <li class="nav-item" id="tabmenu-<?php echo $value['id']; ?>">
                                        <a id="tab2menu-<?php echo $value['id']; ?>"
                                           class="<?php if ($first) echo 'active'; ?> nav-link"
                                           href="#menu-<?php echo $value['id']; ?>" data-toggle="tab"
                                           style="color: black !important"><?php echo $value['name']; ?></a></li>
                                    <?php $first = false;
                                }
                            } ?>
                        </ul>

                        <div class="tab-content">
                            <?php for ($i = 0; $i < count($menu); $i++) {
                                $value = $menu[$i];
                                if ($value['dest'] == -1) { ?>
                                    <div class="tab-pane well <?php if ($i == 0) echo 'active'; ?>"
                                         id="menu-<?php echo $value['id']; ?>">
                                        <div style="width: 100%;display: inline-block">
                                            <div class="float-left">
                                                <h3 id="menu-name-<?php echo $value['id']; ?>"><?php echo $value['name']; ?></h3>
                                            </div>
                                            <div class="float-right">
                                                <button <?php if ($i == 0) {
                                                    echo 'style="display:none;"';
                                                } ?> type="button" id="tabmenu-<?php echo $value['id']; ?>-up"
                                                     onclick="sendDirectPost('admin.php?&action=mooveMenu&type=0&id=<?php echo $value['id']; ?>', function(data) { if(data) { menuMooveUp(get('tabmenu-<?php echo $value['id']; ?>')); }});"
                                                     class="btn btn-sm btn-outline-secondary"><i
                                                            class="fas fa-angle-up"></i></button>
                                                <button <?php if ($i == count($menu) - 1) {
                                                    echo 'style="display:none;"';
                                                } ?> type="button" id="tabmenu-<?php echo $value['id']; ?>-down"
                                                     onclick="sendDirectPost('admin.php?&action=mooveMenu&type=1&id=<?php echo $value['id']; ?>', function(data) { if(data) { menuMooveDown(get('tabmenu-<?php echo $value['id']; ?>')); }});"
                                                     class="btn btn-sm btn-outline-secondary"><i
                                                            class="fas fa-angle-down"></i></button>
                                                <button onclick="sendDirectPost('admin.php?&action=supprMenu&id=<?php echo $value['id']; ?>', function(data) { if(data) { <?php if (isset($value['list'])) { ?>menuRemovelist('list-option-<?php echo $value['id']; ?>');<?php } ?>hide('menu-<?php echo $value['id']; ?>', true); hide('tabmenu-<?php echo $value['id']; ?>',true, function() { checkMenuForMoove(); }); } });"
                                                        class="btn btn-sm btn-outline-secondary">Supprimer
                                                </button>
                                            </div>
                                        </div>


                                        <?php if (isset($value['list'])) { ?>

                                            <label class="control-label">Titre de la liste déroulante</label>
                                            <input class="form-control" type="text"
                                                   onkeyup="get('tab2menu-<?php echo $value['id']; ?>').innerText = this.value; get('menu-name-<?php echo $value['id']; ?>').innerText = this.value"
                                                   value="<?php echo $value['name']; ?>" name="name"/>


                                            <input type="hidden" name="type" value="1"/>
                                            <input type="hidden" name="id" value="<?php echo $value['id']; ?>"/>

                                            <br/>

                                            <ul class="nav nav-tabs">
                                                <?php $first = true;
                                                foreach ($value['list'] as $value2) { ?>
                                                    <li class="nav-item" id="tabmenu-dest-<?php echo $value2['id']; ?>">
                                                        <a id="tab2menu-dest-<?php echo $value2['id']; ?>"
                                                           class="<?php if ($first) echo 'active'; ?> nav-link"
                                                           href="#menu-dest-<?php echo $value2['id']; ?>"
                                                           data-toggle="tab"
                                                           style="color: black !important"><?php echo $value2['name']; ?></a>
                                                    </li>
                                                    <?php $first = false;
                                                } ?>
                                            </ul>
                                            <div class="tab-content">
                                                <?php for ($u = 0; $u < count($value['list']); $u++) {
                                                    $value2 = $value['list'][$u]; ?>
                                                    <div class="tab-pane well <?php if ($u == 0) echo 'active'; ?>"
                                                         id="menu-dest-<?php echo $value2['id']; ?>">
                                                        <div style="width: 100%;display: inline-block">
                                                            <div class="float-left">
                                                                <h3 id="menu-name-dest-<?php echo $value2['id']; ?>"><?php echo $value2['name']; ?></h3>
                                                            </div>
                                                            <div class="float-right">
                                                                <button <?php if ($u == 0) {
                                                                    echo 'style="display:none;"';
                                                                } ?> id="tabmenu-dest-<?php echo $value2['id']; ?>-up"
                                                                     type="button"
                                                                     onclick="sendDirectPost('admin.php?&action=mooveMenu&type=0&id=<?php echo $value2['id']; ?>', function(data) { if(data) { menuMooveUp(get('tabmenu-dest-<?php echo $value2['id']; ?>')); }});"
                                                                     class="btn btn-sm btn-outline-secondary"><i
                                                                            class="fas fa-angle-up"></i></button>
                                                                <button <?php if ($u == count($value['list']) - 1) {
                                                                    echo 'style="display:none;"';
                                                                } ?> id="tabmenu-dest-<?php echo $value2['id']; ?>-down"
                                                                     type="button"
                                                                     onclick="sendDirectPost('admin.php?&action=mooveMenu&type=1&id=<?php echo $value2['id']; ?>', function(data) { if(data) { menuMooveDown(get('tabmenu-dest-<?php echo $value2['id']; ?>')); }});"
                                                                     class="btn btn-sm btn-outline-secondary"><i
                                                                            class="fas fa-angle-down"></i></button>
                                                                <button onclick="sendDirectPost('admin.php?&action=supprMenu&id=<?php echo $value2['id']; ?>', function(data) { if(data) { hide('menu-dest-<?php echo $value2['id']; ?>', true); hide('tabmenu-dest-<?php echo $value2['id']; ?>', true, function() { checkMenuForMoove(); }); } });"
                                                                        class="btn btn-sm btn-outline-secondary">
                                                                    Supprimer
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <label class="control-label">Titre du lien</label>
                                                        <input class="form-control" type="text"
                                                               onkeyup="get('tab2menu-dest-<?php echo $value2['id']; ?>').innerText = this.value; get('menu-name-dest-<?php echo $value2['id']; ?>').innerText = this.value"
                                                               value="<?php echo $value2['name']; ?>"
                                                               name="name-dest<?php echo $value2['id']; ?>"/>

                                                        <?php $isPage2 = isPage($value2['url'], $pages); ?>

                                                        <label class="control-label">type de redirection</label>
                                                        <select name="methode-dest<?php echo $value2['id']; ?>"
                                                                class="form-control" onclick="
                                                                if(parseInt(this.value) == 1) {
                                                                hide('typePage-dest-2-<?php echo $value2['id']; ?>');
                                                                show('typeLien-dest-2-<?php echo $value2['id']; ?>');
                                                                } else {
                                                                show('typePage-dest-2-<?php echo $value2['id']; ?>');
                                                                hide('typeLien-dest-2-<?php echo $value2['id']; ?>');
                                                                }
                                                                " required>
                                                            <option value="1" <?php echo $isPage2 ? '' : 'selected'; ?>>
                                                                Lien
                                                            </option>
                                                            <option value="2" <?php echo $isPage2 ? 'selected' : ''; ?>>
                                                                Page
                                                            </option>
                                                        </select>

                                                        <div id="typeLien-dest-2-<?php echo $value2['id']; ?>" <?php echo $isPage2 ? 'style="display:none;"' : ''; ?>>
                                                            <label class="control-label">Lien</label>
                                                            <input type="text" class="form-control"
                                                                   value="<?php echo $value2['url']; ?>"
                                                                   name="lien-dest<?php echo $value2['id']; ?>"
                                                                   placeholder="ex: http://minecraft.net/">
                                                        </div>
                                                        <div id="typePage-dest-2-<?php echo $value2['id']; ?>" <?php echo $isPage2 ? '' : 'style="display:none;"'; ?>>
                                                            <label class="control-label">Page</label>
                                                            <select class="form-control"
                                                                    name="page-dest<?php echo $value2['id']; ?>">
                                                                <?php $o = 0;
                                                                while ($o < count($pages)) { ?>
                                                                    <option value="<?php echo $pages[$o]; ?>"<?php if ($isPage2 && strpos($value2['url'], $pages[$o])) {
                                                                        echo 'selected';
                                                                    } ?>><?php echo $pages[$o]; ?></option><?php $o++;
                                                                } ?>
                                                            </select>
                                                        </div>


                                                    </div>
                                                <?php } ?>
                                            </div>


                                        <?php } else { ?>

                                            <label class="control-label">Titre du lien</label>
                                            <input class="form-control" type="text"
                                                   onkeyup="get('tab2menu-<?php echo $value['id']; ?>').innerText = this.value; get('menu-name-<?php echo $value['id']; ?>').innerText = this.value"
                                                   value="<?php echo $value['name']; ?>" name="name"/>


                                            <input type="hidden" name="type" value="0"/>
                                            <input type="hidden" name="id" value="<?php echo $value['id']; ?>"/>

                                            <?php $isPage = isPage($value['url'], $pages); ?>

                                            <label class="control-label">type de redirection</label>
                                            <select name="methode" class="form-control" onclick="
                                                    if(parseInt(this.value) == 1) {
                                                    hide('typePage-2-<?php echo $value['id']; ?>');
                                                    show('typeLien-2-<?php echo $value['id']; ?>');
                                                    } else {
                                                    show('typePage-2-<?php echo $value['id']; ?>');
                                                    hide('typeLien-2-<?php echo $value['id']; ?>');
                                                    }
                                                    " required>
                                                <option value="1" <?php echo $isPage ? '' : 'selected'; ?>>Lien</option>
                                                <option value="2" <?php echo $isPage ? 'selected' : ''; ?>>Page</option>
                                            </select>

                                            <div id="typeLien-2-<?php echo $value['id']; ?>" <?php echo $isPage ? 'style="display:none;"' : ''; ?>>
                                                <label class="control-label">Lien</label>
                                                <input type="text" class="form-control"
                                                       value="<?php echo $value['url']; ?>" name="lien"
                                                       placeholder="ex: http://minecraft.net/">
                                            </div>
                                            <div id="typePage-2-<?php echo $value['id']; ?>" <?php echo $isPage ? '' : 'style="display:none;"'; ?>>
                                                <label class="control-label">Page</label>
                                                <select class="form-control" name="page">
                                                    <?php $o = 0;
                                                    while ($o < count($pages)) { ?>
                                                        <option value="<?php echo $pages[$o]; ?>"<?php if ($isPage && strpos($value['url'], $pages[$o])) {
                                                            echo 'selected';
                                                        } ?>><?php echo $pages[$o]; ?></option><?php $o++;
                                                    } ?>
                                                </select>
                                            </div>

                                        <?php } ?>

                                        <script>initPost('menu-<?php echo $value['id']; ?>', 'admin.php?&action=editMenu&id=<?php echo $value['id']; ?>');</script>
                                        <div class="card-footer" style="background-color:rgba(0,0,0,0);">
                                            <div class="text-center">
                                                <input type="submit"
                                                       onclick="sendPost('menu-<?php echo $value['id']; ?>');"
                                                       class="btn btn-success btn-block w-100" value="Valider"/>
                                            </div>
                                        </div>

                                    </div>

                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>


        <?php } ?>
    </div>
<?php } ?>
