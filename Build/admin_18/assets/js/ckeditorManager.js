
var CK = {};
initCK();
function initCK() {
	CK = new Map();
	for (let el of document.querySelectorAll( '#ckeditor' )) {
		ClassicEditor.create(el)
		.catch( error => {console.log( error );} )
		.then(editor => { 
			CK.set(el, editor); 
			if(isset(el.getAttribute('data-UUID'))) {
				editor.editing.view.document.on( 'keyup', ( evt, data ) => { localStorage['CKEDITOR-'+el.getAttribute('data-UUID')] = editor.getData();} );
				if(isset(localStorage['CKEDITOR-'+el.getAttribute('data-UUID')])) {
					if(!isset(editor.getData()) || editor.getData() == "" ) 
					{
						editor.setData(localStorage['CKEDITOR-'+el.getAttribute('data-UUID')]);
					}
				}
			}
		});
		
	}
}

function destroyCK() {
	for (let c of CK.keys()) {
		CK.get(c).destroy();
	}
	CK = new Map();
}

function removeCK(el) {
	localStorage.splice('CKEDITOR-'+el.getAttribute('data-UUID'), 1);
}