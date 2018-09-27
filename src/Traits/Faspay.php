<?php

namespace Cendekia\FaspayTools\Traits;

trait Faspay {

    protected $memberId;
    protected $signature;
    protected $xml;
    protected $url;

    public function __construct()
    {
        $this->memberId = null;
        $this->signature = null;
        $this->xml = null;
        $this->url = null;
    }

    protected function execute(): array
    {
        $xml = $this->xml;

        $ch = curl_init(config('faspay.recurring.url_check'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode(json_encode(simplexml_load_string($output)), true);
    }

    protected function generateSignature($memberId)
    {
        $clientId = config('faspay.recurring.client_id');
        $password = config('faspay.recurring.password');

        $this->memberId = $memberId;
        $this->signature = sha1(md5($clientId.$password.$memberId));

        return $this;
    }

    protected function generateXml($requestTitle = "Pengecekan Status Recurring")
    {
        $this->xml = '<?xml version="1.0"?>'.
            '<faspay>'.
                '<request>'. $requestTitle .'</request>'.
                '<merchant_id>'. config('faspay.recurring.merchant_id') .'</merchant_id>'.
                '<merchant>'. config('faspay.recurring.merchant_name') .'</merchant>'.
                '<member_id>'. $this->memberId .'</member_id>'.
                '<member_name>'. request()->member['name'] .'</member_name>'.
                '<member_email>'. request()->member['email'] .'</member_email>'.
                '<recurring_amount>'. request()->member['amount'] .'</recurring_amount>'.
                '<signature>'. $this->signature .'</signature>'.
            '</faspay>';

        return $this;
    }
}
