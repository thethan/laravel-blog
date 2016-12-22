Feature: Get Product Types
  In Order to get product types
  The Get product types API should be able to be called all the times

  Scenario:
    Given I send a GET request to "http://catalog.stg.hue.rest/product-types"
    Then the response code should be 200
    And the response should contain "data"