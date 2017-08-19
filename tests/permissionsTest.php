<?php

  require_once("./php/permissions.php");

  class PermissionsTest extends \PHPUnit_Framework_TestCase
  {
    /**
    * Test Permission Checking
    * @dataProvider providerCheckPermission
    */
    public function testCheckPermission($role, $permission, $expectedResult)
    {
      $result = checkPermission($role, $permission);

      var_dump($role);
      var_dump($permission);
      var_dump($expectedResult);
      var_dump($result);

      $this->assertEquals($expectedResult, $result);
    }
    /**
    * Check Permission DataProvider
    */
    public static function providerCheckPermission()
    {
      require_once './php/roles.php';
      return array(
        //Create Staff Account
        array(Roles::Customer, 'create-staff-account.php', false),
        array(Roles::Driver, 'create-staff-account.php', false),
        array(Roles::Coordinator, 'create-staff-account.php', false),
        array(Roles::Manager, 'create-staff-account.php', true),
        array(Roles::Admin, 'create-staff-account.php', true),

        //View Order
        array(Roles::Customer, 'view-order.php', false),
        array(Roles::Driver, 'view-order.php', true),
        array(Roles::Coordinator, 'view-order.php', true),
        array(Roles::Manager, 'view-order.php', true),
        array(Roles::Admin, 'view-order.php', true),

        //Phone Order
        array(Roles::Customer, 'phone-order.php', false),
        array(Roles::Driver, 'phone-order.php', false),
        array(Roles::Coordinator, 'phone-order.php', true),
        array(Roles::Manager, 'phone-order.php', true),
        array(Roles::Admin, 'phone-order.php', true),

        //Edit Accounts
        array(Roles::Customer, 'edit-accounts.php', false),
        array(Roles::Driver, 'edit-accounts.php', false),
        array(Roles::Coordinator, 'edit-accounts.php', false),
        array(Roles::Manager, 'edit-accounts.php', false),
        array(Roles::Admin, 'edit-accounts.php', true),

        //View Users
        array(Roles::Customer, 'view-users.php', false),
        array(Roles::Driver, 'view-users.php', false),
        array(Roles::Coordinator, 'view-users.php', false),
        array(Roles::Manager, 'view-users.php', true),
        array(Roles::Admin, 'view-users.php', true),

        //Edit Order Information
        array(Roles::Customer, 'edit-order.php', false),
        array(Roles::Driver, 'edit-order.php', false),
        array(Roles::Coordinator, 'edit-order.php', true),
        array(Roles::Manager, 'edit-order.php', true),
        array(Roles::Admin, 'edit-order.php', true),

        //Edit Package Information
        array(Roles::Customer, 'package-information.php', false),
        array(Roles::Driver, 'package-information.php', false),
        array(Roles::Coordinator, 'package-information.php', false),
        array(Roles::Manager, 'package-information.php', true),
        array(Roles::Admin, 'package-information.php', true)
      );
  }
}

?>
