<?php

if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['actions']['editTheme']) {
	if(isset($_POST['color_theme_main'], $_POST['color_theme_hover'], $_POST['color_theme_focus'], $_POST['color_panel_main'], $_POST['color_panel_hover'], $_POST['color_panel_focus'])) {
		$configTheme = new Lire('modele/config/config.yml');
		$_Theme_ = $configTheme->GetTableau();
		$_Theme_['color']["theme"]['main'] = $_POST["color_theme_main"];
		$_Theme_['color']["theme"]['hover'] = $_POST["color_theme_hover"];
		$_Theme_['color']["theme"]['focus'] = $_POST["color_theme_focus"];
		$_Theme_['color']["panel"]['main'] = $_POST["color_panel_main"];
		$_Theme_['color']["panel"]['hover'] = $_POST["color_panel_hover"];
		$_Theme_['color']["panel"]['focus'] = $_POST["color_panel_focus"];
		new Ecrire('modele/config/config.yml', $_Theme_);
	}
}

?>