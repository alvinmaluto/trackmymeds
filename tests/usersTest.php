<?php

  require_once("./php/users.php");

  class UsersTest extends \PHPUnit_Framework_TestCase
  {
    /**
    * Test User Constructor
    * @dataProvider providerConstructorUser
    */
    public function testConstructorUser($email, $firstName, $lastName, $phone, $role, $address, $postCode, $state)
    {
      $id = null;

      $user = new User($id, $email, $firstName, $lastName, $phone, $role, $address, $postCode, $state);

      var_dump($user->email);
      var_dump($user->firstName);
      var_dump($user->lastName);
      var_dump($phone);
      var_dump($address);
      var_dump($postCode);
      var_dump($state);

      $this->assertEquals($email, $user->email);
      $this->assertEquals($firstName, $user->firstName);
      $this->assertEquals($lastName, $user->lastName);
      $this->assertEquals($phone, $user->phone);
      $this->assertEquals($address, $user->address);
      $this->assertEquals($postCode, $user->postCode);
      $this->assertEquals($state, $user->state);
    }
    /**
    * Test User Constructor DataProvider
    */
    public static function providerConstructorUser()
    {
      return array(
        //Create Staff Account
        array(
          "bob@email.com",
          "Bob","Marley",
          "(07)3129 1290",
          "0",
          "15 Herp Street, Derp",
          "4001",
          "QLD"
        ),
        array(
          "misha@rip.com",
          "Misha",
          "TheD00D",
          "3129 1290",
          "4",
          "52 Merp Drive, Derp",
          "3234",
          "VIC"
          ),
        array(
          "herp@email.com",
          "Herp",
          "Derp",
          "0429 123 123",
          "3",
          "15 Herp Street, Derp",
          "2342",
          "NSW"
        ),
      );
  }
}

?>
