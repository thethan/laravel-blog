<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\WebApiExtension\Context\WebApiContext;


/**
 * Defines application features from the specific context.
 */
class FeatureContext extends WebApiContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $client = new \GuzzleHttp\Client([]);
        $this->setClient($client);

        $this->iAmAuthenticatingAs(env('HUE_CATALOG_USERNAME'), env('HUE_CATALOG_PASSWORD'));
    }

}
