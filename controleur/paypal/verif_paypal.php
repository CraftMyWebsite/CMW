

<?php



$recupOpffresPaypal = $bddConnection->prepare('SELECT * FROM cmw_jetons_paypal_offres WHERE id = :id');
$recupOpffresPaypal->execute(array('id' => $_GET['offre']));
$donneesActions = $recupOpffresPaypal->fetch();

$req = 'cmd=_notify-validate';
 
foreach ($_POST as $cle => $valeur)
{
    $valeur = urlencode(stripslashes($valeur));
    $req .= "&$cle=$valeur";
}
 
// On renvoie les informations IPN à Paypal pour valider la transaction
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);// Mode de connexion par SSL.
 
// On récupère les données POST dans des variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payer_email = $_POST['payer_email'];
$id = $_POST['custom'];
 
if (!$fp) // Si la connexion avec Paypal n'a pas pu être initialisée, on affiche une erreur
{
    setFlash('Problème de connexion avec Paypal, les données IPN n\'ont pas pu être repostées', 'error');
    header('Location: crediter.php');
    exit();
}
else
{
    fputs ($fp, $header . $req);// fputs=fwrite | On envoie la variable $req à Paypal via le connexion initialisée précédemment (nommée $fp)
    while (!feof($fp))// Tant qu'on n'arrive pas à la fin de $fp
    {
        $res = fgets ($fp, 1024);
        if (strcmp ($res, "VERIFIED") == 0)// Si on trouve le mot VERIFIED (donc si les données reçues correspondent aux données de la transaction)
        {

            if ($payment_status=="Completed" AND $receiver_email==$_Serveur_['Payement']['paypalEmail'] AND (string)$payment_amount==(string)$donneesActions['prix'] AND $payment_currency=="EUR")// Si tous les paramètres sont bons, on peut procéder au traitement de la commande
            {


$file = fopen('test.txt', 'r+');
fputs($file, 'test'.$id );
fclose($file);
require_once('modele/joueur/maj.class.php');
$joueurMaj = new Maj($id, $bddConnection);
$playerData = $joueurMaj->getReponseConnection();
$playerData = $playerData->fetch();
$playerData['tokens'] = $playerData['tokens'] + $donneesActions['jetons_donnes'];
$joueurMaj->setReponseConnection($playerData);
$joueurMaj->setNouvellesDonneesTokens($playerData);
            }
        }
        else if (strcmp ($res, "INVALID") == 0) // Si on trouve le mot INVALID (données reçues != données de la transaction)
        {
            setFlash('Un problème est survenue durant le paiement, veuillez ré-essayer.', 'error');
            header('Location: crediter.php?erreur');
            exit();
        }
    }
fclose ($fp);
}
?>
