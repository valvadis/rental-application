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
      | ownerId  | description         | street        | postalCode | houseNumber | apartmentNumber | city | country |
      | OWNER-ID | Example description | Random street | 33-333     | 8           | 0               | City | Country |

  Scenario: Book an apartment
    Given I have a "ApartmentTable" fixture with the following data set:
      | id              | 10000000-XXXX-YYYY-ZZZZ-APARTMENT___ |
      | street          | street                               |
      | postalCode      | 22-222                               |
      | houseNumber     | 5                                    |
      | apartmentNumber | 1                                    |
      | city            | city                                 |
      | country         | country                              |
    When I send a "POST" request to "/api/v1/apartment/10000000-XXXX-YYYY-ZZZZ-APARTMENT___/book" with data:
      """
      {
        "tenantId": "TENANT-APARTMENT-ID",
        "start": "2021-01-01",
        "end": "2021-01-03"
      }
      """
    Then The response code should be 200