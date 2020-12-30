<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Access dean's office employee to pages");

//login
$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'lecturer@lecturer.com');
$I->fillField('password', 'lecturer');
$I->click('Login');
$I->seeCurrentUrlEquals('/dashboard');
$I->see('Lecturer Lecturer');
$I->see("You're logged in!");

//can't access to users controller
$I->amOnPage('/users');
$I->see('403');

$I->amOnPage('/users/1/edit');
$I->see('403');
