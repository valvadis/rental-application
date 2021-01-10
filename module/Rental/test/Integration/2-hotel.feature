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
      | name  | street        | postalCode | houseNumber | apartmentNumber | city | country |
      | Hotel | Random street | 33-333     | 8           | 0               | City | Country |

  Scenario: Create a hotel room
    Given I have a "HotelTable" fixture with the following data set:
      | id              | 10000000-XXXX-YYYY-ZZZZ-HOTEL_______ |
      | name            | hotel                                |
      | street          | street                               |
      | postalCode      | 33-333                               |
      | houseNumber     | 6                                    |
      | apartmentNumber | 2                                    |
      | city            | city                                 |
      | country         | country                              |
    When I send a "POST" request to "/api/v1/hotel-room" with data:
      """
      {
        "hotelId": "10000000-XXXX-YYYY-ZZZZ-HOTEL_______",
        "number": "1",
        "description": "Room next to the bathroom",
        "spaces": [{"name": "bathroom", "length": 6.5}, {"name": "main", "length": 32}]
      }
      """
    Then The response code should be 200

  Scenario: Book a hotel room
    Given I have a "HotelRoomTable" fixture with the following data set:
      | id          | 10000000-XXXX-YYYY-ZZZZ-HOTEL_ROOM__ |
      | hotelId     | 10000000-XXXX-YYYY-ZZZZ-HOTEL_______ |
      | number      | 1                                    |
      | description | Some description of hotel room       |
    When I send a "POST" request to "/api/v1/hotel-room/10000000-XXXX-YYYY-ZZZZ-HOTEL_ROOM__/book" with data:
      """
      {
        "tenantId": "TENANT-HOTEL-ID",
        "days": [
          "31-12-2020",
          "01-01-2021",
          "01-04-2021",
          "01-05-2021"
        ]
      }
      """
    Then The response code should be 200