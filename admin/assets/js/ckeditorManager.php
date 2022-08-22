<script>
var CK = new Map();
initCK();
function initCK() {
	CK = new Map();
	for (let el of document.querySelectorAll("[data-UUID]" )) {
		var option = {};
		if(isset(el.getAttribute("data-UUID")) && el.getAttribute("data-UUID").includes("PHP")) {
			option = {
						toolbar: {
							items: [
								'viewSource',
								'heading',
								'|',
								'fontBackgroundColor',
								'fontFamily',
								'fontSize',
								'fontColor',
								'highlight',
								'|',
								'bold',
								'underline',
								'italic',
								'horizontalLine',
								'|',
								'link',
								'bulletedList',
								'todoList',
								'numberedList',
								'|',
								<?php if(isset($_Serveur_['uploadImage']) && isset($_Serveur_['uploadImage']['maxFileSize']) && isset($_Serveur_['uploadImage']['maxSize'])) { echo "'uploadImage',"; }  ?>
								'blockQuote',
								'mediaEmbed',
								'undo',
								'redo',
								'viewSourceAdmin'
							]
						},
						language: 'fr',
						image: {
							toolbar: [
								'imageTextAlternative',
								'imageStyle:full',
								'imageStyle:side'
							]
						},
						licenseKey: '',
						simpleUpload: {
							uploadUrl: 'index.php?action=uploadCKImg',
							withCredentials: false,
							headers: {
								'X-CSRF-TOKEN': 'CSFR-Token',
								Authorization: ''
							}
						}
						
					};
		} else {
				option = {
						toolbar: {
							items: [
								'viewSource',
								'heading',
								'|',
								'fontBackgroundColor',
								'fontFamily',
								'fontSize',
								'fontColor',
								'highlight',
								'|',
								'bold',
								'underline',
								'italic',
								'horizontalLine',
								'|',
								'link',
								'bulletedList',
								'todoList',
								'numberedList',
								'|',
								<?php if(isset($_Serveur_['uploadImage']) && isset($_Serveur_['uploadImage']['maxFileSize']) && isset($_Serveur_['uploadImage']['maxSize'])) { echo "'uploadImage',"; }  ?>
								'blockQuote',
								'mediaEmbed',
								'undo',
								'redo'
							]
						},
						language: 'fr',
						image: {
							toolbar: [
								'imageTextAlternative',
								'imageStyle:full',
								'imageStyle:side'
							]
						},
						licenseKey: '',
						simpleUpload: {
							uploadUrl: 'index.php?action=uploadCKImg',
							withCredentials: false,
							headers: {
								'X-CSRF-TOKEN': 'CSFR-Token',
								Authorization: ''
							}
						}
						
					};
		}
		ClassicEditor.create(el, option) .catch( error => {console.log( error );} )
			.then(editor => { 
				CK.set(el, editor); 
				
			});
			
	}
}


function isset(obj) {
    return typeof obj !== 'undefined' && obj !== null;
}

function addBlockQuote(ck,ht, auteur) {

	CK.get(document.getElementById(ck)).setData("<blockquote>"+auteur+",<br/>"+document.getElementById(ht).innerHTML+"</blockquote><br/>&gt;&gt;"+CK.get(document.getElementById(ck)).getData());

}

function destroyCK() {
	CK.forEach(function(v,k) {
		v.destroy()
	    .catch( error => {
	        console.log( error );
	    } );
	}) 
}

//fix ck link dans les modals
$( "modal" ).each(function() {
	$( this ).modal( {
		focus: false,
		show: false
	});
});


<?php if(isset($_GET['upload'])) {
	switch(intval($_GET['upload'])) {
		case 0:
			echo 'notif("error", "Erreur", "Une erreur interne est survenue.");';
			break;
		case 1:
			echo 'notif("error", "Erreur", "L\'extension n\'est pas valide.");';
			break;
		case 2:
			echo 'notif("error", "Erreur", "L\'image est trop volumineuse.");';
			break;
		case 3:
			echo 'notif("error", "Erreur", "Les dimensions de l\'image sont incorrecte.");';
			break;
		case 4:
			echo 'notif("success", "Action effectuée !","");';
			break;
		case 5:
			echo 'notif("error", "Erreur", "Vous n\'avez pas les permissions suffisante.");';
			break;
	}
} ?>
</script>