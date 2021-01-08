<?php if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editLinkMenu')) { 
require_once('./admin/donnees/menu.php');  ?>



    		<ul class="nav nav-tabs">
      		<?php $first = true; foreach($menu as $value) { if($value['dest'] == -1) { ?>
      		    <li class="nav-item" id="tabmenu-<?php echo $value['id']; ?>">
      		    <a id="tab2menu-<?php echo $value['id']; ?>" class="<?php if($first) echo 'active'; ?> nav-link" href="#menu-<?php echo $value['id']; ?>" data-toggle="tab" style="color: black !important"><?php echo $value['name']; ?></a></li>
      		<?php $first = false; } } ?>
    		</ul>
        
    		<div class="tab-content">
    			<?php for($i = 0; $i<count($menu); $i++) { $value = $menu[$i]; if($value['dest'] == -1) {  ?>
        			<div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="menu-<?php echo $value['id']; ?>">
        				<div style="width: 100%;display: inline-block">
        					<div class="float-left">
        						<h3 id="menu-name-<?php echo $value['id']; ?>"><?php echo $value['name']; ?></h3>
        					</div>
        					<div class="float-right">
        						<?php if(!$i == 0 ) { ?><button type="button" onclick="sendDirectPost('admin.php?&action=mooveMenu&type=0&id=<?php echo $value['id']; ?>', function(data) { if(data) { menuUpdate(); }});" class="btn btn-sm btn-outline-secondary"><i class="fas fa-angle-up"></i></button><?php } ?>
        						<?php if($i<count($menu)-1) { ?><button type="button" onclick="sendDirectPost('admin.php?&action=mooveMenu&type=1&id=<?php echo $value['id']; ?>', function(data) { if(data) { menuUpdate(); }});" class="btn btn-sm btn-outline-secondary"><i class="fas fa-angle-down"></i></button><?php } ?>
        						<button  onclick="sendDirectPost('admin.php?&action=supprMenu&id=<?php echo $value['id']; ?>', function(data) { if(data) { hide('menu-<?php echo $value['id']; ?>'); hide('tabmenu-<?php echo $value['id']; ?>'); } });" class="btn btn-sm btn-outline-secondary">Supprimer</button>
        					</div>
        				</div>
        			
        			
        		<?php if(isset($value['list'])) { if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'addDropLinkMenu')) { ?>
        		 
        		 	<label class="control-label">Titre de la liste déroulante</label>
             		 <input class="form-control" type="text" onkeyup="get('tab2menu-<?php echo $value['id']; ?>').innerText = this.value; get('menu-name-<?php echo $value['id']; ?>').innerText = this.value" value="<?php echo $value['name']; ?>" name="name" />
        			
        		
        			<input type="hidden" name="type" value="1"/>
        			<input type="hidden" name="id" value="<?php echo $value['id']; ?>"/>
        			
        			<br/>
        			
        			<ul class="nav nav-tabs">
              		<?php $first = true; foreach($value['list'] as $value2) { ?>
              		    <li class="nav-item" id="tabmenu-dest-<?php echo $value2['id']; ?>">
              		    <a id="tab2menu-dest-<?php echo $value2['id']; ?>" class="<?php if($first) echo 'active'; ?> nav-link" href="#menu-dest-<?php echo $value2['id']; ?>" data-toggle="tab" style="color: black !important"><?php echo $value2['name']; ?></a></li>
              		<?php $first = false; } ?>
            		</ul>
            		
            		<?php for($u = 0; $u<count($value['list']); $u++) { $value2 = $value['list'][$u]; ?>
                		<div class="tab-pane well <?php if($u == 0) echo 'active'; ?>" id="menu-dest-<?php echo $value2['id']; ?>">
            				<div style="width: 100%;display: inline-block">
            					<div class="float-left">
            						<h3 id="menu-name-dest-<?php echo $value2['id']; ?>"><?php echo $value2['name']; ?></h3>
            					</div>
            					<div class="float-right">
            						<?php if(!$u == 0) { ?><button type="button" onclick="sendDirectPost('admin.php?&action=mooveMenu&type=0&id=<?php echo $value2['id']; ?>', function(data) { if(data) { menuUpdate(); }});" class="btn btn-sm btn-outline-secondary"><i class="fas fa-angle-up"></i></button><?php } ?>
            						<?php if($u<count($value['list'])-1) { ?><button type="button" onclick="sendDirectPost('admin.php?&action=mooveMenu&type=1&id=<?php echo $value2['id']; ?>', function(data) { if(data) { menuUpdate(); }});" class="btn btn-sm btn-outline-secondary"><i class="fas fa-angle-down"></i></button><?php } ?>
            						<button  onclick="sendDirectPost('admin.php?&action=supprMenu&id=<?php echo $value2['id']; ?>', function(data) { if(data) { hide('menu-dest-<?php echo $value2['id']; ?>'); hide('tabmenu-dest-<?php echo $value2['id']; ?>'); } });" class="btn btn-sm btn-outline-secondary">Supprimer</button>
            					</div>
            				</div>
            			
            				<label class="control-label">Titre du lien</label>
             		 		<input class="form-control" type="text" onkeyup="get('tab2menu-dest-<?php echo $value2['id']; ?>').innerText = this.value; get('menu-name-dest-<?php echo $value2['id']; ?>').innerText = this.value" value="<?php echo $value2['name']; ?>" name="name-dest<?php echo $value2['id']; ?>" />
        			
        					<?php $isPage2 = isPage($value2['url'], $pages); ?>

                          <label class="control-label">type de redirection</label>
                          <select name="methode-dest<?php echo $value2['id']; ?>" class="form-control" onclick="
                          if(parseInt(this.value) == 1) {
                            hide('typePage-dest-2-<?php echo $value2['id']; ?>');
                            show('typeLien-dest-2-<?php echo $value2['id']; ?>');
                          } else {
                            show('typePage-dest-2-<?php echo $value2['id']; ?>');
                            hide('typeLien-dest-2-<?php echo $value2['id']; ?>');
                          }
                          " required>
                            <option value="1" <?php echo $isPage2 ? '':'selected'; ?>>Lien</option>
                            <option value="2" <?php echo $isPage2 ? 'selected':''; ?>>Page</option>
                          </select>
    
                          <div id="typeLien-dest-2-<?php echo $value2['id']; ?>" <?php echo $isPage2 ? 'style="display:none;"':'';?>>
                            <label class="control-label">Lien</label>
                            <input type="text" class="form-control" value="<?php echo $value2['url']; ?>" name="lien-dest<?php echo $value2['id']; ?>" placeholder="ex: http://minecraft.net/">
                          </div>
                          <div id="typePage-dest-2-<?php echo $value2['id']; ?>" <?php echo $isPage2 ? '':'style="display:none;"';?>>
                            <label class="control-label">Page</label>
                            <select class="form-control" name="page-dest<?php echo $value2['id']; ?>">
                              <?php $o = 0;  while($o < count($pages)) { ?><option value="<?php echo $pages[$o]; ?>"<?php if($isPage2 && strpos($value2['url'], $pages[$o])) { echo 'selected';} ?>><?php echo $pages[$o]; ?></option><?php $o++; } ?>
                            </select>
                          </div>
        					
            			
            			</div>
            		<?php }  ?>
            		
        		 
        		<?php } } else { ?>
        		
        			<label class="control-label">Titre du lien</label>
             		 <input class="form-control" type="text" onkeyup="get('tab2menu-<?php echo $value['id']; ?>').innerText = this.value; get('menu-name-<?php echo $value['id']; ?>').innerText = this.value" value="<?php echo $value['name']; ?>" name="name" />
        			
        		
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
                        <option value="1" <?php echo $isPage ? '':'selected'; ?>>Lien</option>
                        <option value="2" <?php echo $isPage ? 'selected':''; ?>>Page</option>
                      </select>

                      <div id="typeLien-2-<?php echo $value['id']; ?>" <?php echo $isPage ? 'style="display:none;"':'';?>>
                        <label class="control-label">Lien</label>
                        <input type="text" class="form-control" value="<?php echo $value['url']; ?>" name="lien" placeholder="ex: http://minecraft.net/">
                      </div>
                      <div id="typePage-2-<?php echo $value['id']; ?>" <?php echo $isPage ? '':'style="display:none;"';?>>
                        <label class="control-label">Page</label>
                        <select class="form-control" name="page">
                          <?php $o = 0;  while($o < count($pages)) { ?><option value="<?php echo $pages[$o]; ?>"<?php if($isPage && strpos($value['url'], $pages[$o])) { echo 'selected';} ?>><?php echo $pages[$o]; ?></option><?php $o++; } ?>
                        </select>
                      </div>
                      
        		<?php }?>
        		
        		<div data-callback="menu-<?php echo $value['id']; ?>" data-url="admin.php?&action=editMenu&id=<?php echo $value['id']; ?>"></div>
                <div class="card-footer" style="background-color:rgba(0,0,0,0);">
                	<div class="text-center">
                    	<input type="submit" onclick="sendPost('menu-<?php echo $value['id']; ?>');" class="btn btn-success btn-block w-100" value="Valider" />
                    </div>
                </div>
        			
            </div>
        			
        		<?php } } ?>
    		</div>
<?php } ?>