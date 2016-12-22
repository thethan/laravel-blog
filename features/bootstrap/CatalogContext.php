<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class CatalogContext extends FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */

    /**
     * @BeforeScenario
     */
    public function setAuthentication()
    {
        $this->iAmAuthenticatingAs('society6', 'societysecrets');
    }



}
