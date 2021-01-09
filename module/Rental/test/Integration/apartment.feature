Feature: Hotel
  In order to manage an apartment
  I want to use apartment endpoints

  Scenario: Create an apartment
    When I send a "POST" request to "/api/v1/apartment" with data:
      """
      {
        "ownerId": "OWNER-ID",
        "street": "Random street",
        "postalCode": "33-333",
        "houseNumber": "8",
        "apartmentNumber": "0",
        "city": "City",
        "country": "Country",
        "description": "Example description",
        "rooms": [{"name": "One", "size": 21.5}, {"name": "Two", "size": 41.95}]
      }
      """
    Then The response code should be 200

  Scenario: Get apartments list
    When I send a "GET" request to "/api/v1/apartment"
    Then The response code should be 200
    Then The response content should contain:
      | ownerId  | street        | postalCode | houseNumber | apartmentNumber | city | country |
      | OWNER-ID | Random street | 33-333     | 8           | 0               | City | Country |