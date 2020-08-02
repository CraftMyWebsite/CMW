<script>
function previewTopic(appel)
{
	post = $(appel).val();
	contenue = nl2br(post);
	document.getElementById("previewTopic").innerText = miseEnPage(contenue);
}

function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function miseEnPage($str)
{
	$format_search =  [
    /\[b\](.*?)\[\/b\]/ig,
    /\[i\](.*?)\[\/i\]/ig,
    /\[u\](.*?)\[\/u\]/ig,
    /\[color=(.*?)\](.*?)\[\/color\]/ig,
    /\[hr\]/ig,
    /\[s(?:trike)?\](.*?)\[\/s(trike)?\]/ig,
    /\[center\](.*?)\[\/center\]/ig,
    /\[font=(.*?)\](.*?)\[\/font\]/ig,
    /\[right\](.*?)\[\/right\]/ig,
    /\[left\](.*?)\[\/left\]/ig,
    /\[justify\](.*?)\[\/justify\]/ig,
    /\[img\](.*?)\[\/img\]/ig,
    /\[img=(.*?)\](.*?)\[\/img\]/ig,
    /[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}/ig,
    /\[url\](.*?)\[\/url\]/ig,
    /\[url=(.*?)\](.*?)\[\/url\]/ig
	];
	$format_replace = [
	    '<strong>$1</strong>',
	    '<em>$1</em>',
	    '<u>$1</u>',
	    '<span style="color: $1">$2</span>',
	    '<hr/>',
	    '<s>$2</s>',
	    '<center>$1</center>',
	    '<span style="font-size:$1em;">$2</span>',
	    '<p class="text-right" style="margin-bottom: 0px;">$1</p>',
	    '<p class="text-left" style="margin-bottom: 0px;">$1</p>',
	    '<p class="text-justify" style="margin-bottom: 0px;">$1</p>',
	    '<img class="img-fluid" src="$1" />',
	    '<img class="img-fluid" src="$1" title="$2" />',
	    '<a href="mailto:$0">$0</a>',
	    '<a href="$1" target="_blank">$1</a>',
	    '<a href="$1" target="_blank">$2</a>'
	];
	for (var i =0;i<$format_search.length;i++) {
	  $str = $str.replace($format_search[i], $format_replace[i]);
	}
	while($str.match(/\[spoiler(.*)\](.+)\[\/spoiler\]/i))
	{
		var k = Math.floor(Math.random()* 1000);
		$str = $str.replace(/\[spoiler=(.*?)\](.*?)\[\/spoiler\]/i, '<a class="btn btn-primary" data-toggle="collapse" href="#spoiler'+k+'" role="button" aria-expanded="false" aria-controls="spoiler'+k+'">$1</a><div class="collapse" id="spoiler'+k+'"><div class="card card-body"><p style="margin-bottom: 0px;">$2</p></div></div>');
		var k = Math.floor(Math.random()* 1000);
		$str = $str.replace(/\[spoiler\](.*?)\[\/spoiler\]/i, '<a class="btn btn-primary" data-toggle="collapse" href="#spoiler'+k+'" role="button" aria-expanded="false" aria-controls="spoiler'+k+'">Spoiler</a><div class="collapse" id="spoiler'+k+'"><div class="card card-body"><p style="margin-bottom: 0px;">$1</p></div></div>');
	}
	$smileys_symbole = [
	<?php 
	$req = $bddConnection->query('SELECT symbole, image FROM cmw_forum_smileys ORDER BY priorite DESC');
	$smileys = $req->fetchAll();
	foreach($smileys as $key => $value)
	{
		if(array_key_exists($key+1, $smileys))
			echo '"'.$value['symbole'].'",';
		else
			echo '"'.$value['symbole'].'"';
	}
	?>
	];
	$smileys_replace = [
	<?php 
	foreach($smileys as $key => $value)
	{
		if(array_key_exists($key+1, $smileys))
			echo '"'.$value['image'].'",';
		else
			echo '"'.$value['image'].'"';
	}
	?>
	];
	for(var i = 0; i < $smileys_symbole.length; i++)
	{
		replace = $smileys_symbole[i].split("/").join("\\/").split("(").join("\\(").split(")").join("\\)").split(":").join("\\:").split("'").join("\\'").split("\"").join("\\\"");
		re = new RegExp(replace, "ig");
		$str = $str.replace(re, '<img src="'+$smileys_replace[i]+'" />');
	}
	return $str;
}
$('#NomForum').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var ancienNom = button.data('nom'); 
  var icone = button.data('icone'); 
  var id = button.data('id'); 
  var entite = button.data('entite'); 
  var modal = $(this)
  modal.find('.modal-body #nom').val(ancienNom);
  modal.find('.modal-body #icone').val(icone);
  modal.find('.modal-body #id').val(id);
  modal.find('.modal-body #entite').val(entite);
});
</script>
