<?php
/**
 * Created by PhpStorm.
 * User: Fawaz ADISA <adisaf@programmer.net>
 * Date: 20/03/2018
 * Time: 14:09
 */
require_once __DIR__ . '/../vendor/autoload.php';

use CinetPay\CinetPay;

$id_transaction = $_POST['cpm_trans_id'];
if (!empty($id_transaction)) {
    try {
        $apiKey = "21585943f75164bbc2.38014639"; //Veuillez entrer votre apiKey
        $site_id = "296911"; //Veuillez entrer votre siteId

        $cp = new CinetPay($site_id, $apiKey);

        // Reprise exacte des bonnes données chez CinetPay
        $cp->setTransId($id_transaction)->getPayStatus();
        $paymentData = [
            "cpm_site_id" => $cp->_cpm_site_id,
            "signature" => $cp->_signature,
            "cpm_amount" => $cp->_cpm_amount,
            "cpm_trans_id" => $cp->_cpm_trans_id,
            "cpm_custom" => $cp->_cpm_custom,
            "cpm_currency" => $cp->_cpm_currency,
            "cpm_payid" => $cp->_cpm_payid,
            "cpm_payment_date" => $cp->_cpm_payment_date,
            "cpm_payment_time" => $cp->_cpm_payment_time,
            "cpm_error_message" => $cp->_cpm_error_message,
            "payment_method" => $cp->_payment_method,
            "cpm_phone_prefixe" => $cp->_cpm_phone_prefixe,
            "cel_phone_num" => $cp->_cel_phone_num,
            "cpm_ipn_ack" => $cp->_cpm_ipn_ack,
            "created_at" => $cp->_created_at,
            "updated_at" => $cp->_updated_at,
            "cpm_result" => $cp->_cpm_result,
            "cpm_trans_status" => $cp->_cpm_trans_status,
            "cpm_designation" => $cp->_cpm_designation,
            "buyer_name" => $cp->_buyer_name,
        ];
        // Recuperation de la ligne de la transaction dans votre base de données

        // Verification de l'etat du traitement de la commande

        // Si le paiement est bon alors ne traitez plus cette transaction : die();

        // On verifie que le montant payé chez CinetPay correspond à notre montant en base de données pour cette transaction

        // On verifie que le paiement est valide
        if ($cp->isValidPayment()) {
            echo 'Felicitation, votre paiement a été effectué avec succès';
            die();
        } else {
            echo 'Echec, votre paiement a échoué pour cause : ' . $cp->_cpm_error_message;
            die();
        }
    } catch (\Exception $e) {
        // Une erreur s'est produite
        echo "Erreur :" . $e->getMessage();
    }
} else {
    // redirection vers la page d'accueil
    die();
}