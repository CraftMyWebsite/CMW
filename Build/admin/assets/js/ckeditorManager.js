
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
						'horizontalLine',
						'|',
						'link',
						'bulletedList',
						'todoList',
						'numberedList',
						'|',
						'imageUpload',
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