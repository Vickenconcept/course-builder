<?php

use Google\Ads\GoogleAds\V8\Services\CampaignServiceClient;
use Google\Ads\GoogleAds\OAuth2\OAuth2ClientBuilder;
// use Google\Ads\GoogleAds\V8\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\V8\GoogleAdsClient;
use Google\Ads\GoogleAds\V8\Services\KeywordPlanIdea;
use Google\Ads\GoogleAds\V8\Services\KeywordPlanIdeaSelector;
use Google\Ads\GoogleAds\V8\Services\LanguageConstants;
use Google\Ads\GoogleAds\V8\Services\LocationNames;
use Google\Ads\GoogleAds\V8\Services\SeedKeywordAndUrlSeed;
use Google\Ads\GoogleAds\V8\Services\UrlSeed;


class GoogleAdsService
{
    protected $googleAdsClient;

    public function __construct()
    {
        $this->googleAdsClient = (new GoogleAdsClient())->newBuilder()
            ->fromFile(env('GOOGLE_ADS_CONFIG_PATH'))
            ->withOAuth2Credential(
                (new OAuth2ClientBuilder())->fromFile(env('GOOGLE_ADS_CREDENTIALS_PATH'))
                
            )
            ->build();
    }

    public function getCampaigns()
    {
        $campaignServiceClient = $this->googleAdsClient->getCampaignServiceClient();
        $customerId = env('GOOGLE_ADS_LOGIN_CUSTOMER_ID');

        $response = $campaignServiceClient->listCampaigns($customerId);
        $campaigns = $response->getCampaigns();

        return $campaigns;
    }


    public function getKeywordSearchResults($userSearchQuery)
    {
        $keywordPlanIdeaServiceClient = $this->googleAdsClient->getKeywordPlanIdeaServiceClient();

        // Create a keyword plan idea selector.
        $keywordPlanIdeaSelector = new KeywordPlanIdeaSelector();
        $keywordPlanIdeaSelector->setLanguageConstraints([LanguageConstants::ENGLISH]);
        $keywordPlanIdeaSelector->setGeoTargetConstants([LocationNames::COUNTRY_USA]);

        // Use a SeedKeywordAndUrlSeed to specify the search query.
        $seed = new SeedKeywordAndUrlSeed();
        $seed->setKeyword($userSearchQuery);

        // Set the seed in the keyword plan idea selector.
        $keywordPlanIdeaSelector->setKeywordAndUrlSeed($seed);

        // Retrieve the keyword search results.
        $response = $keywordPlanIdeaServiceClient->generateKeywordIdeas($keywordPlanIdeaSelector);

        // Process and return the keyword search results.
        $keywordIdeas = [];
        foreach ($response->getResults() as $result) {
            /** @var KeywordPlanIdea $result */
            $keywordIdeas[] = $result->getText();
        }

        return $keywordIdeas;
    }
}
