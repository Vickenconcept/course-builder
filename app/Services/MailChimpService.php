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
        print_r($response);
    }

   
    public function subscribe($email, $apiKey, $prefixKey,$list_id)
    {
        $client = new \MailchimpMarketing\ApiClient();
        $client->setConfig([
            'apiKey' => $apiKey,
            // 'apiKey' => Crypt::decryptString($apiKey),
            'server' => $prefixKey,
        ]);

        try {
            $response = $client->lists->addListMember($list_id, [
                "email_address" => $email,
                "status" => "pending",
            ]);
            
        }catch (\Exception $e) {
            if (strpos($e->getMessage(), "Member Exists") !== false) {
            } else {
               
            }
        }
        

        // return $response; // Return the response if needed
    }

    public function getAllLists($apiKey, $prefixKey)
    {
        $client = new \MailchimpMarketing\ApiClient();
        $client->setConfig([
            'apiKey' => $apiKey,
            // 'apiKey' => Crypt::decryptString($apiKey),
            'server' => $prefixKey,
        ]);
    
        return $response = $client->lists->getAllLists();


        // try {
        //     $client = new \MailchimpMarketing\ApiClient();
    
        //     $client->setConfig([
        //         'apiKey' => Crypt::decryptString($apiKey),
        //         'server' => $prefixKey,
        //     ]);
    
        //     $response = $client->lists->getAllLists();
    
        //     // Handle the response or perform other actions if needed
    
        //     // Assuming a successful response, you can redirect the user or do further processing
        //     return redirect()->back()->with('success', 'Lists retrieved successfully!');
        //     // dd('ddd');
        // } catch (\Exception $e) {
        //     // Handle the exception, which could be due to an invalid API key or other errors
        //     return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        // }
    }
}
