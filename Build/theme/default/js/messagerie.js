$('#modalRep').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var destinataire = button.data('to'); // Extract info from data-* attributes
  var modal = $(this)
  if(destinataire == undefined)
  	modal.find('.modal-title').text('Nouveau message');
  else
  	modal.find('.modal-title').text('Nouveau message pour ' + destinataire);
  modal.find('.modal-body #destinataire').val(destinataire);
});

$('#modalMessage').on('show.bs.modal', function (event) {
	console.log('test');
	var button = $(event.relatedTarget);
	var idConv = button.data('id');
	var correspondant = button.data('with');
	var modal = $(this);
	modal.find('.modal-title').text("Conversation avec "+ correspondant);
	modal.find('#Conversation').html("<center><img src='theme/default/img/gif-charge.gif' alt='chargement...'/></center>");
	modal.find(".destinataire").attr("value", correspondant);
	$.ajax({
		method: "POST",
		url: '?action=getConversationMessage',
		data: { id: idConv }
	}).done(function(donnees){
		if(donnees != 'false')
		{
			modal.find('#Conversation').html(donnees);
			
			$("#i"+idConv).removeClass("fa-envelope");
			$("#i"+idConv).removeClass("fas");
			$("#i"+idConv).addClass("far");
			$("#i"+idConv).addClass("fa-envelope-open");
		}
		else
		{
			modal.find('#Conversation').html("<h2>Erreur: Vous n'avez pas les accès pour cette conversation !</h2>");
		}
	});
});

function getConversations(page)
{
	$("#accordion").html("<center><img src='theme/default/img/gif-charge.gif' alt='chargement...'/></center>");
	$.ajax({
		method: "POST",
		url: '?action=getConversations',
		data: { page: page }
	}).done(function(donnees){
		$("#accordion").html(donnees);
	});
}

function getMessages(id, page)
{
	$('#Conversation').html("<center><img src='theme/default/img/gif-charge.gif' alt='chargement...'/></center>");
	$.ajax({
		method: "POST",
		url: '?action=getConversationMessage',
		data: { id: id, page: page }
	}).done(function(donnees){
		$("#Conversation").html(donnees);
	});
}