<?php

namespace App\Services;
// require_once('/path/to/MailchimpMarketing/vendor/autoload.php');



class MailChimp
{

    public function getData()
    {
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => env('MAIL_CHIMP_API_KEY'),
            'server' => 'us21'
        ]);

        $response = $mailchimp->ping->get();
        dd($response);
        print_r($response);
    }
}
