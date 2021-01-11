<?php
$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Change user's role");

$I->amOnPage('/users');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'dean@dean.com');
$I->fillField('password', 'dean');
$I->click('Login');
$I->seeCurrentUrlEquals('/users');
$I->see("Newly registered users:");
$I->seeInDatabase("users", ["name" => "John Doe","role_id"=>"1"]);

$I->click('Change Role');
$I->seeCurrentUrlEquals('/users/1/edit');

$I->click('Change', 'button');

$I->seeCurrentUrlEquals('/users');
$I->seeInDatabase("users", ["name" => "John Doe","role_id"=>"2"]);
