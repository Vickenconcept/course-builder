<?php

namespace App\Services;
// require_once('/path/to/MailchimpMarketing/vendor/autoload.php');
use MailchimpMarketing\ApiClient;
use Vendor\Package\ApiClient as MailchimpApiClient;
use MailchimpMarketing\ApiException; 
use Illuminate\Support\Facades\Crypt;




class MailChimpService
{

    public function getData()
    {
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => env('MAIL_CHIMP_API_KEY'),
            'server' => 'us21'
        ]);

        $response = $mailchimp->ping->get();
        // dd($response);
        print_r($response);
    }

    // public function subscribe($email)
    // {
    //     $user = auth()->user(); // Assuming the user is authenticated
    //     $setting = $user->setting; // Retrieve the related setting using the 'setting' relationship

    //     $apiKey = $setting->mailchimp_api_key;
    //     $prefixKey = $setting->mailchimp_prefix_key;
    //     $decryptedApiKey = Crypt::decryptString($apiKey);
    //     $client = new \MailchimpMarketing\ApiClient();
    //     $client->setConfig([

    //         'apiKey' => $decryptedApiKey,
    //         'server' => $prefixKey,
    //     ]);

    //     $response = $client->lists->addListMember("3c54a618ea", [
    //         "email_address" => $email,
    //         "status" => "pending",
    //     ]);
    // }

    public function subscribe($email, $apiKey, $prefixKey)
    {
        $client = new \MailchimpMarketing\ApiClient();
        $client->setConfig([
            'apiKey' => Crypt::decryptString($apiKey),
            'server' => $prefixKey,
        ]);

        try {
            // Make the Mailchimp API call to add the member
            $response = $client->lists->addListMember("3c54a618ea", [
                "email_address" => $email,
                "status" => "pending",
            ]);
            
        }catch (\Exception $e) {
            // Check if the error message contains "Member Exists"
            if (strpos($e->getMessage(), "Member Exists") !== false) {
                // Ignore the "Member Exists" error and continue
            } else {
                // Handle other API errors
                // Log the error or take appropriate action
            }
        }
        

        // return $response; // Return the response if needed
    }
}
