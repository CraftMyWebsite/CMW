for (let el of document.querySelectorAll( '#ckeditor' )) {
	ClassicEditor.create(el).catch( error => {console.log( error );} );
}