<?php if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editLinkMenu')) { 
	$type = intval($_POST['type']);
	require("modele/menu.class.php");
	$Menu = new menu($bddConnection);
	if($type == 0) {
	    $data = array();
	    $data['name'] = $_POST['name'];
	    if(isset($_POST['methode'])) {
	        if($_POST['methode'] == 1)
	        {
	            $data['url'] = !empty($_POST['lien']) ? $_POST['lien'] : "index.php";
	        } else {
	            $data['url'] = '?&page='. urlencode($_POST['page']);
	        }
	    } else {
	        $data['url'] = null;
	    }
	    $Menu->editMenu($data, intval($_POST['id']));
	} else if($type == 1) {
	    $data = array();
	    $data['name'] = $_POST['name'];
	    $data['url'] = null;
	    $Menu->editMenu($data, intval($_POST['id']));
	    
	    $m = $Menu->getMenuWithDest(intval($_POST['id']));
	    foreach($m as $value) {
	        $data = array();
	        $data['name'] = $_POST['name-dest'.$value['id']];
	        if(isset($_POST['methode-dest'.$value['id']])) {
	            if($_POST['methode-dest'.$value['id']] == 1)
	            {
	                $data['url'] = !empty($_POST['lien-dest'.$value['id']]) ? $_POST['lien-dest'.$value['id']] : "index.php";
	            } else {
	                $data['url'] = '?&page='. urlencode($_POST['page-dest'.$value['id']]);
	            }
	        } else {
	            $data['url'] = null;
	        }
	        $Menu->editMenu($data, $value['id']);
	    }
	}
}
?>