<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Access dean's office employee to pages");

//login
$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'dean@dean.com');
$I->fillField('password', 'dean');
$I->click('Login');
$I->seeCurrentUrlEquals('/dashboard');
$I->see('Dean Dean');
$I->see("You're logged in!");

//access to users controller
$I->amOnPage('/users');
$I->see(' Newly registered users:');

$I->amOnPage('/users/1/edit');
$I->see(' Changing role of user:');
