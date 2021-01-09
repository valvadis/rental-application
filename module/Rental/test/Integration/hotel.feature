Feature: Hotel
  In order to manage a hotel
  I want to use hotel endpoints

  Scenario: Create a hotel
    When I send a "POST" request to "/api/v1/hotel" with data:
      """
      {
        "name": "Hotel",
        "street": "Random street",
        "postalCode": "33-333",
        "houseNumber": "8",
        "apartmentNumber": "0",
        "city": "City",
        "country": "Country"
      }
      """
    Then The response code should be 200

  Scenario: Get hotels list
    When I send a "GET" request to "/api/v1/hotel"
    Then The response code should be 200
    Then The response content should contain:
      | name | street        | postalCode | houseNumber | apartmentNumber | city | country |
      | Hotel| Random street | 33-333     | 8           | 0               | City | Country |