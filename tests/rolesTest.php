<?php

  require_once("./php/roles.php");

  class RolesTest extends \PHPUnit_Framework_TestCase
  {
    /**
    * Test Roles
    * @dataProvider providerRoles
    */
    public function testConstructorUser($role, $roleNumber, $expectedResult)
    {
      if($role === $roleNumber)
      {
        $result = true;
      }else{
        $result = false;
      }

      var_dump($role);
      var_dump($roleNumber);
      var_dump($expectedResult);
      var_dump($result);

      $this->assertEquals($expectedResult, $result);
    }
    /**
    * Roles Test DataProvider
    */
    public function providerRoles()
    {
      return array(
        //Correct
        array(Roles::Customer, 0, true),
        array(Roles::Driver, 1, true),
        array(Roles::Coordinator, 2, true),
        array(Roles::Manager, 3, true),
        array(Roles::Admin, 4, true),
        //Incorrect
        array(Roles::Admin, 0, false),
        array(Roles::Customer, 4, false),
        array(Roles::Manager, 1, false)
      );
    }
}

?>
