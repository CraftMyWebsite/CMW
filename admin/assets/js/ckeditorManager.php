<script>
var option = {
	toolbar: {
		items: [
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
			<?php if(isset($_Serveur_['uploadImage']) && isset($_Serveur_['uploadImage']['maxFileSize']) && isset($_Serveur_['uploadImage']['maxSize'])) { echo "'imageUpload',"; }  ?>
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
			Authorization: 'Bearer <JSON Web Token>'
		}
	}
				
};

var CK = new Map();
initCK();
function initCK() {
	CK = new Map();
	for (let el of document.querySelectorAll("[data-UUID]" )) {
		ClassicEditor.create(el, option )
		.catch( error => {console.log( error );} )
		.then(editor => { 
			CK.set(el, editor); 
			if(isset(el.innerText) && el.innerText.replace(" ", "") != "") {
				editor.setData(el.innerText);
			}
		});
		
	}
}


function isset(obj) {
    return typeof obj !== 'undefined' && obj !== null;
}

function addBlockQuote(ck,ht, auteur) {

	CK.get(document.getElementById(ck)).setData("<blockquote>"+auteur+",<br/>"+document.getElementById(ht).innerHTML+"</blockquote><br/>>>"+CK.get(document.getElementById(ck)).getData());

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
</script>