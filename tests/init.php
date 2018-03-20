<?php
/**
 * Created by PhpStorm.
 * User: Fawaz ADISA <adisaf@programmer.net>
 * Date: 20/03/2018
 * Time: 14:09
 */
require_once __DIR__ . '/../vendor/autoload.php';

use CinetPay\CinetPay;

/*
 * Preparation des elements constituant le panier
 */
$apiKey = "21585943f75164bbc2.38014639"; //Veuillez entrer votre apiKey
$site_id = "296911"; //Veuillez entrer votre siteId
$id_transaction = CinetPay::generateTransId(); // Identifiant du Paiement
$description_du_paiement = sprintf('Mon produit de ref %s', $id_transaction); // Description du Payment
$date_transaction = date("Y-m-d H:i:s"); // Date Paiement dans votre système
$montant_a_payer = mt_rand(5, 100); // Montant à Payer : minimun est de 5 francs sur CinetPay
$identifiant_du_payeur = 'payeur@domaine.ci'; // Mettez ici une information qui vous permettra d'identifier de façon unique le payeur
$formName = "goCinetPay"; // nom du formulaire CinetPay
$notify_url = ''; // Lien de notification CallBack CinetPay (IPN Link)
$return_url = ''; // Lien de retour CallBack CinetPay
$cancel_url = ''; // Lien d'annulation CinetPay
// Configuration du bouton
$btnType = 2;//1-5xwxxw
$btnSize = 'large'; // 'small' pour reduire la taille du bouton, 'large' pour une taille moyenne ou 'larger' pour  une taille plus grande

// Paramétrage du panier CinetPay et affichage du formulaire
$cp = new CinetPay($site_id, $apiKey);
try {
    $cp->setTransId($id_transaction)
        ->setDesignation($description_du_paiement)
        ->setTransDate($date_transaction)
        ->setAmount($montant_a_payer)
        ->setDebug(true)// Valorisé à true, si vous voulez activer le mode debug sur cinetpay afin d'afficher toutes les variables envoyées chez CinetPay
        ->setCustom($identifiant_du_payeur)// optional
        ->setNotifyUrl($notify_url)// optional
        ->setReturnUrl($return_url)// optional
        ->setCancelUrl($cancel_url)// optional
        ->displayPayButton($formName, $btnType, $btnSize);
} catch (\Exception $e) {
    print $e->getMessage();
}