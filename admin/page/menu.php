<center><div class="row">
	<h1><center>Créer un lien</center></h1>
<div style="width: 85%" class="alert alert-dismissable alert-success">
    <center>Vous pouvez créer et modifier des liens qui seront visibles sur la barre du menu principal. Vous pouvez aussi éditer des listes déroulantes. Ces dernières sont plus compliquées à créer.<br />
Ce lien basique contient juste un nom et une adresse, vous pouvez choisir parmis 2 catégories pour l'adresse: une page du site (par exemple une page "nous rejoindre !") ou un lien direct(comme un lien "faire un don").<br />
Vous devez créer la page avant de la mettre sur le menu !<br />
Pour gérer une liste déroulante, vous y attribuez au départ un nom et un premier élément de la liste, vous pourrez rajouter une infinitée de liens sur votre liste par la suite !
	</center>
</div>


	<div class="col-md-6 well" style="height: 415px;">
		<h4>Créer un lien Menu</h4>
		<form role="form" method="post" action="?&action=newLienMenu">
			<div class="form-group">
				<label>Nom</label>
				<input style="width: 50%" type="text" class="form-control" name="menuTexte" placeholder="Nom du lien">
			</div>
			<div class="radio">
				<label>
				<input type="radio" name="methode" value="1" checked>
				Lien 
				</label><input style="width: 50%" type="text" class="form-control" name="menuLien" placeholder="ex: http://minecraft.net/">
			</div>
			<div class="radio">
				<label>
				<input type="radio" name="methode" value="2">
				Page
				</label>
				<select style="width: 50%" class="form-control" name="page">
					<?php
					$i = 0;
					while($i < count($pages))
					{
						?><option value="<?php echo $pages[$i]; ?>"><?php echo $pages[$i]; ?></option><?php $i++;
					} ?>
				</select>
			</div>
		  <button type="submit" class="btn btn-primary">Créer un lien</button>
		</form>
	</div>
	<div class="col-md-6 well">
		<h4>Créer une liste déroulante</h4>
		<form role="form" method="post" action="?&action=newListeMenu">
			<div class="form-group">
				<label>Nom</label>
				<input style="width: 50%" type="text" class="form-control" name="menuTexte" placeholder="Nom de la liste">
			</div>
			<div class="form-group">
				<label>Lien #1</label>
				<input style="width: 50%" type="text" class="form-control" name="lienTexte" placeholder="Nom du lien">
			<div class="radio">
				<label>
				<input type="radio" name="methode" value="1" checked>
				Lien 
				</label><input style="width: 50%" type="text" class="form-control" name="menuLien" placeholder="ex: http://minecraft.net/">
			</div>
			<div class="radio">
				<label>
				<input type="radio" name="methode" value="2">
				Page
				</label>
				<select style="width: 50%" class="form-control" name="page">
					<?php
					$i = 0;
					while($i < count($pages))
					{
						?><option value="<?php echo $pages[$i]; ?>"><?php echo $pages[$i]; ?></option><?php $i++;
					} ?>
				</select>
			</div>
			</div>
			<em>Vous pourrez rajouter des liens plus tard ..</em>
		  <button type="submit" class="btn btn-primary">Créer une liste déroulante</button>
		</form>
	</div>
</div>
</br>
<div class="row">
	<h1><center>Editez vos liens</center></h1>
	<h3><center>Edition des liens basiques</center></h3>
	</br>
		<ul class="nav nav-tabs">
	<?php
	for($i = 0; $i < count($lectureMenu['MenuTexte']); $i++)
	{
		?>
		<li class="<?php if($i == 0) echo 'active'; ?>">
            <a href="#editLiens<?php echo $i; ?>" data-toggle="tab"><?php echo $lectureMenuA['MenuTexte'][$i]; ?></a>
        </li>

		<?php
	}
	?>
		</ul>
		<div class="tab-content">
	<?php
	for($i = 0; $i < count($lectureMenu['MenuTexte']); $i++)
	{
		?>
		<form class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="editLiens<?php echo $i; ?>" method="post" action="?&action=modifierLien&id=<?php echo $i; ?>">
            <h4>Lien de menu #<?php echo $lectureMenu['MenuTexte'][$i]; ?><a class="label label-danger pull-right" href="?&action=supprLienMenu&id=<?php echo $i; ?>">Supprimer le lien...</a></h4>
			<div class="row">
			<div class="row col-md-offset-1 col-md-10 col-md-offset-1">
				<div class="form-group">
					<label>Titre du lien</label>
					<input style="width: 50%" class="form-control" type="text" value="<?php echo $lectureMenu['MenuTexte'][$i]; ?>" name="texteLien" />
				</div>

			<div class="form-group">
				<label>Lien #1</label>
				<input style="width: 50%" type="text" class="form-control" name="lienTexte" placeholder="Nom du lien">
			<div class="radio">
				<label>
				<input type="radio" name="methode" value="1" checked>
				Lien 
				</label><input style="width: 50%" type="text" class="form-control" name="menuLien" placeholder="ex: http://minecraft.net/" value="<?php echo $lectureMenu['MenuLien'][$i]; ?>" name="lienLien">
			</div>
			<div class="radio">
				<label>
				<input type="radio" name="methode" value="2">
				Page
				</label>
				<select style="width: 50%" class="form-control" name="page">
					<?php
					$j = 0;
					while($j < count($pages))
					{
						?><option value="<?php echo $pages[$j]; ?>"><?php echo $pages[$j]; ?></option><?php $j++;
					} ?>
				</select>
			</div>
			</div>
			</br>
				<input type="submit" class="btn btn-success" />
			</div>
			</div>
		</form>
		<?php
	}
	?>
		</div>
	</br>
	<h3><center>Edition des menus déroulants</center></h3>
    <ul class="nav nav-tabs">    
    <?php
    $j = 0;
	for($i = 0; $i < count($lectureMenu['MenuTexte']); $i++)
	{
		if(isset($lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]]))
		{
		    ?>
		    <li class="<?php if($j == 0) echo 'active'; ?>">
                <a href="#editLiensDeroul<?php echo $i; ?>" data-toggle="tab"><?php echo $lectureMenu['MenuTexte'][$i]; ?></a>
            </li>
		    <?php
            $j++;
        }
	} ?>
    </ul>
    <div class="tab-content">
    <?php
        $j = 0;
	for($i = 0; $i < count($lectureMenu['MenuTexte']); $i++)
	{
		if(isset($lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]]['0']))
		{
		?>
        <div class="tab-pane <?php if($j == 0) echo 'active'; ?>" id="editLiensDeroul<?php echo $i; ?>">
			<h4>Menu déroulant: #<?php echo $lectureMenu['MenuTexte'][$i]; ?></h4>
			<form role="form" method="post" class="form-changer-liste-deroulante row" action="?&action=editMenuListe">
				<div class="form-group">
					<label>Titre de la liste déroulante</label>
					<input style="width: 50%" type="text" class="form-control" placeholder="Le nom de la liste déroulante" name="titreListe" value="<?php echo $lectureMenu['MenuTexte'][$i]; ?>" />
				</div>
                <div class="row">
				<?php
				if($lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]]['0'] != "LastLinkDontDelete") {
				for($j = 0; $j < count($lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]]); $j++)
				{ 
					if(preg_match("#\?&page=#", $lectureMenu['MenuListeDeroulanteLien'][$lectureMenu['MenuTexte'][$i]][$j]))
						$method = 1;
					elseif($lectureMenu['MenuListeDeroulanteLien'][$lectureMenu['MenuTexte'][$i]][$j] == '-divider-')
						$method = 2;
					else
						$method = 0;
					
					
				?>
				<div class="form-group">
					<label>Lien <?php echo $lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]][$j]; ?> </label>
					<input style="width: 50%" type="text" class="form-control" name="lienTexte<?php echo $j; ?>" placeholder="Texte du lien" value="<?php echo $lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]][$j]; ?>">
					<div class="radio">
						<label>
						<input type="radio" name="methode<?php echo $j; ?>" value="1" <?php if($method == 0) echo 'checked'; ?>>
						Lien 
						</label><input style="width: 50%" type="text" class="form-control" name="menuLien<?php echo $j; ?>" value="<?php echo $lectureMenu['MenuListeDeroulanteLien'][$lectureMenu['MenuTexte'][$i]][$j]; ?>"placeholder="ex: http://minecraft.net/">
					</div>
					<div class="radio">
						<label>
						<input type="radio" name="methode<?php echo $j; ?>" value="2" <?php if($method == 1) echo 'checked'; ?>>
						Page
						</label>
						<select style="width: 50%" class="form-control" name="page<?php echo $j; ?>">
							<?php
							$l = 0;
							if(!empty($pages))
								while($l < count($pages))
								{
									?><option value="<?php echo $pages[$l]; ?>"><?php echo $pages[$l]; ?></option><?php $l++;
								} ?>
						</select>
					</div>
					<div class="radio">
						<label>
						<input type="radio" name="methode<?php echo $j; ?>" value="3" <?php if($method == 2) echo 'checked'; ?>>
						Diviseur
					</div>
					<a class="btn btn-danger" href="?&action=supprLienMenuDeroulant&id=<?php echo $i; ?>&id2=<?php echo $j; ?>">Supprimer le lien: <?php echo $lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]][$j]; ?></a>
				</div>
				<?php }
				} else { echo "<div class='alert alert-danger' style='text-align: center;'>Veuillez créer un lien pour cette liste ou la supprimer</div>"; } ?>
                </div>
				<input type="submit" class="btn btn-success" value="Valider mes changements" />
			</form>
		<?php } 
		if(isset($lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]]))
		{
		?>
			<h4>Ajouter un lien dans la liste: #<?php echo $lectureMenu['MenuTexte'][$i]; ?></h4>
			<form role="form" method="post" class="form-changer-liste-deroulante" action="?&action=nouveauMenuListeLien&liste=">
                <input type="hidden" name="listeNum" value="<?php echo $lectureMenu['MenuTexte'][$i]; ?>" />
				<div class="form-group">
					<label>Titre du lien</label>
					<input style="width: 50%" type="text" class="form-control" name="nomLien" placeholder="Le nom du lien" />
				</div>		
				<div class="radio">
					<label>
					<input type="radio" name="methode" value="1" checked>
					Lien 
					</label><input style="width: 50%" type="text" class="form-control" name="menuLien" placeholder="ex: http://minecraft.net/">
				</div>
				<div class="radio">
					<label>
					<input type="radio" name="methode" value="2">
					Page
					</label>
					<select style="width: 50%" class="form-control" name="page">
						<?php
						$l = 0;
						if(!empty($pages))
							while($l < count($pages))
							{
								?><option value="<?php echo $pages[$l]; ?>"><?php echo $pages[$l]; ?></option><?php $l++;
							} ?>
					</select>
				</div>
				<div class="radio">
					<label>
					<input type="radio" name="methode" value="3">
					Diviseur
				</div>	
			
				<input type="hidden" name="categorie" value="<?php echo $lectureMenu['MenuTexte'][$i]; ?>" />
			
				<input type="submit" class="btn btn-success" value="Valider mes changements" />			
			</form>
        </div>		
        <?php
		$j++;
		}
	}
	?>
    </div>
</div>
</center>

