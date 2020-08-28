
var CK = {};
initCK();
function initCK() {
	CK = new Map();
	for (let el of document.querySelectorAll("[data-UUID]" )) {
		ClassicEditor.create(el, {
				
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
						'|',
						'link',
						'bulletedList',
						'numberedList',
						'todoList',
						'|',
						'indent',
						'outdent',
						'|',
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
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',
				
			} )
		.catch( error => {console.log( error );} )
		.then(editor => { 
			CK.set(el, editor); 
			if(isset(el.getAttribute('data-UUID'))) {
				editor.editing.view.document.on( 'keyup', ( evt, data ) => { localStorage.setItem('CKEDITOR-'+el.getAttribute('data-UUID'), editor.getData());} );
				if(isset(localStorage.getItem('CKEDITOR-'+el.getAttribute('data-UUID')))) {
					if(!isset(editor.getData()) || editor.getData() == "" ) 
					{
						editor.setData(localStorage.getItem('CKEDITOR-'+el.getAttribute('data-UUID')));
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
	localStorage.removeItem('CKEDITOR-'+el.getAttribute('data-UUID'));
}