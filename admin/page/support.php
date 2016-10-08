<h1><center>Gestion des tickets</center></h1>
</br>
<?php
if($aucunTicket)
    echo '<p><center>Aucun ticket n\'a été créé par les membres jusqu\'à présent !</center></p>';
else { ?>
<center><table style="width: 50%" class="table table-bordered">
    <tr>
        <th>Titre</th>
        <th style="width: 10px;">Auteur</th>
        <th style="width: 10px;">Supprimer</th>
        <th style="width: 10px;">Action</th>
    </tr>



    <?php for($i = 0; $i < count($donneesSupport); $i++) { ?>
	<form class="form-horizontal default-form" method="post" action="?&action=etatTickets&id=<?php echo $donneesSupport[$i]['id']; ?>">
	<tr>
        <td style="padding-top: 20px;"><?php echo $donneesSupport[$i]['titre']; ?></td>
        <td style="padding-top: 20px;"><?php echo $donneesSupport[$i]['auteur']; ?></td>
        <td><a href="?action=supprTicket&id=<?php echo $donneesSupport[$i]['id']; ?>" class="btn btn-danger">Supprimer</a></td>
        <td>
		<?php
		if($donneesSupport[$i]['etat'] == 0){
			echo '<button type="submit" name="etat" class="btn btn-warning" value="1" />Fermer le ticket</button>';
		}else{
			echo '<button type="submit" name="etat" class="btn btn-warning" value="0" />Ouvrir le ticket</button>';
		}
		?>
		</td>
        </tr>
        </form>
    <?php }  ?>
</table></center>
<?php } ?>