Feature: As a User
  I want to be able to get data from the gateway

  Scenario:
    Given I send a GET request to "http://catalog.stg.hue.rest/product-types"
    Then the response code should be 401
    And the response should contain json:
    """
    {
      "errors": [
        {
          "status": 401,
          "title": "Unauthorized",
          "detail": "Missing or invalid `Authorization` header"
        }
      ]
    }
    """

  Scenario:
    Given I am authenticating as "society6" with "societysecrets" password
    And I send a GET request to "http://catalog.stg.hue.rest/product-types"
    Then the response code should be 200
    And the response should contain json:
    """
    {
      "errors": [
        {
          "status": 401,
          "title": "Unauthorized",
          "detail": "Missing or invalid `Authorization` header"
        }
      ]
    }
    """
