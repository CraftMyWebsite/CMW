
var CK = {};
initCK();
function initCK() {
	CK = new Map();
	for (let el of document.querySelectorAll( '#ckeditor' )) {
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
		});
		
	}
}

function isset(obj) {
    return typeof obj !== 'undefined' && obj !== null;
}
