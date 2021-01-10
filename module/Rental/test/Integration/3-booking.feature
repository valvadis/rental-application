Feature: Booking
  In order to manage a booking
  I want to use booking endpoints

  Scenario: Get booking list
    When I send a "GET" request to "/api/v1/booking"
    Then The response code should be 200
    Then The response content should contain:
      | tenantId            | rentalType | status |
      | TENANT-APARTMENT-ID | apartment  | opened |
      | TENANT-HOTEL-ID     | hotel      | opened |

  Scenario: Accept and reject a booking
    Given I have an "ApartmentTable" fixture with the following data set:
      | id              | 20000000-XXXX-YYYY-ZZZZ-APARTMENT___ |
      | street          | street                               |
      | postalCode      | 22-222                               |
      | houseNumber     | 5                                    |
      | apartmentNumber | 1                                    |
      | city            | city                                 |
      | country         | country                              |
    Given I have a "BookingTable" fixture with the following data set:
      | id          | 10000000-XXXX-YYYY-ZZZZ-BOOKING_____ |
      | hotelRoomId |                                      |
      | apartmentId | 20000000-XXXX-YYYY-ZZZZ-APARTMENT___ |
      | tenantId    | TENANT-ID                            |
      | rentalType  | apartment                            |
      | status      | opened                               |
    When I send a "POST" request to "/api/v1/booking/10000000-XXXX-YYYY-ZZZZ-BOOKING_____/accept"
    Then The response code should be 200
    When I send a "POST" request to "/api/v1/booking/10000000-XXXX-YYYY-ZZZZ-BOOKING_____/reject"
    Then The response code should be 200