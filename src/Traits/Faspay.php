<?php

namespace Cendekia\FaspayTools\Traits;

trait Faspay
{
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

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);
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

    protected function generateXml($type = null): object
    {
        switch ($type) {
            case 'update_recurring_member':
                $this->xml = $this->updateRecurringMemberXml();
                $this->url = config('faspay.recurring.url_update');
                break;
            default:
                $this->xml = $this->recurringCheck();
                $this->url = config('faspay.recurring.url_check');
                break;
        }

        return $this;
    }

    protected function recurringCheck($requestTitle = 'Pengecekan Status Recurring'): string
    {
        return '<?xml version="1.0"?>'.
            '<faspay>'.
                '<request>'.$requestTitle.'</request>'.
                '<merchant_id>'.config('faspay.recurring.merchant_id').'</merchant_id>'.
                '<merchant>'.config('faspay.recurring.merchant_name').'</merchant>'.
                '<member_id>'.$this->memberId.'</member_id>'.
                '<member_name>NA</member_name>'.
                '<member_email>'.request()->member['email'].'</member_email>'.
                '<recurring_amount>1</recurring_amount>'.
                '<signature>'.$this->signature.'</signature>'.
            '</faspay>';
    }

    protected function updateRecurringMemberXml($requestTitle = 'Pengubahan Member Recurring'): string
    {
        return '<?xml version="1.0"?>'.
            '<faspay>'.
                '<request>'.$requestTitle.'</request>'.
                '<merchant_id>'.config('faspay.recurring.merchant_id').'</merchant_id>'.
                '<merchant>FaspayBOT</merchant>'.
                '<member_id>'.$this->memberId.'</member_id>'.
                '<member_name>'.request()->member['member_name'].'</member_name>'.
                '<member_email>'.request()->member['member_email'].'</member_email>'.
                '<member_email_notif>'.request()->member['member_email_notif'].'</member_email_notif>'.
                '<process_date>'.request()->member['process_date'].'</process_date>'.
                '<recurring_amount>'.request()->member['recurring_amount'].'</recurring_amount>'.
                '<recurring_start_date>'.request()->member['recurring_start_date'].'</recurring_start_date>'.
                '<recurring_end_date>'.request()->member['recurring_end_date'].'</recurring_end_date>'.
                '<recurring_period>'.request()->member['recurring_period'].'</recurring_period>'.
                '<recurring_period_at>'.request()->member['recurring_period_at'].'</recurring_period_at>'.
                '<recurring_accumulate>'.request()->member['recurring_accumulate'].'</recurring_accumulate>'.
                '<recurring_accumulate_at>'.request()->member['recurring_accumulate_at'].'</recurring_accumulate_at>'.
                '<recurring_status>'.request()->member['recurring_status'].'</recurring_status>'.
                '<signature>'.$this->signature.'</signature>'.
            '</faspay>';
    }
}
