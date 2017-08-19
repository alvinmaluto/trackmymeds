<?php

  require_once("./php/orders.php");

  class OrdersTest extends \PHPUnit_Framework_TestCase
  {
    /**
    * Test Order Constructor
    * @dataProvider providerConstructorOrder
    */
    public function testConstructorOrder($orderID, $userID, $status, $description, $signature, $priority, $pickupAddress, $pickupPostcode, $pickupState, $pickupTime, $deliveryAddress, $deliveryPostcode, $deliveryState, $deliveryTime, $recipientName, $recipientPhone)
    {
      $order = new Order($orderID, $userID, $status, $description, $signature, $priority, $pickupAddress, $pickupPostcode, $pickupState, $pickupTime, $deliveryAddress, $deliveryPostcode, $deliveryState, $deliveryTime, $recipientName, $recipientPhone);

      var_dump(get_object_vars($order));

      $this->assertEquals($orderID, $order->orderID);
      $this->assertEquals($userID, $order->userID);

      $this->assertEquals($status, $order->status);
      $this->assertEquals($description, $order->description);
      $this->assertEquals($signature, $order->signature);
      $this->assertEquals($priority, $order->priority);

      $this->assertEquals($pickupAddress, $order->pickupAddress);
      $this->assertEquals($pickupPostcode, $order->pickupPostcode);
      $this->assertEquals($pickupState, $order->pickupState);
      $this->assertEquals($pickupTime, $order->pickupTime);

      $this->assertEquals($deliveryAddress, $order->deliveryAddress);
      $this->assertEquals($deliveryPostcode, $order->deliveryPostcode);
      $this->assertEquals($deliveryState, $order->deliveryState);
      $this->assertEquals($deliveryTime, $order->deliveryTime);

      $this->assertEquals($recipientName, $order->recipientName);
      $this->assertEquals($recipientPhone, $order->recipientPhone);
    }
    /**
    * Test Order Constructor DataProvider
    */
    public static function providerConstructorOrder()
    {
      return array(
        //Create Staff Account
        array(
          "1",
      		"332",
          "Ordered",
          "Something Heavy",
          "1",
          "Express",

          "13 Somewhere Street, Someplace",
          "4201",
          "QLD",
          "2016-09-10 09:30:00",

          "29 AnotherPlace Street, SomewhereElse",
          "2920",
          "NSW",
          "2016-09-11 09:30:00",

          "Bob",
          "Darren"
        ),
        array(
          "13",
      		"423",
          "Ordered",
          "Something Else",
          "0",
          "Standard",

          "12 Merp Drive, AnotherPlace",
          "4001",
          "QLD",
          "2016-09-11 12:30:00",

          "31 Okay Street, Place",
          "1920",
          "VIC",
          "2016-09-14 09:30:00",

          "Merp",
          "Herp"
        ),
      );
  }
}

?>
