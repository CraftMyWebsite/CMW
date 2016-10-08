<?php
$themes = scandir('theme/');
for($i = 2; $i < count($themes); $i++)
{
	$themes[$i - 2] = $themes[$i];
	if($i >= count($themes) - 3)
		unset($themes[$i]);
}
if($lecture['General']['theme'] == 'bootswatch')
	$themesOptions = array(	'bootstrap', 
							'bootstrap-amelia', 
							'boostrap-curelean', 
							'bootstrap-cosmo', 
							'bootstrap-cyborg', 
							'bootstrap-flatly', 
							'bootstrap-journal', 
							'bootstrap-lumen', 
							'bootstrap-readable', 
							'bootstrap-simplex', 
							'bootstrap-slate', 
							'bootstrap-spacelab', 
							'bootstrap-superhero', 
							'bootstrap-united', 
							'bootstrap-yeti' );
else
	$themesOptions = null;

?>