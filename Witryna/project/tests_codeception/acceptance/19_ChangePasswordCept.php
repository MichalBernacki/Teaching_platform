<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Change password");

//login
$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'student@student.com');
$I->fillField('password', 'student');
$I->click('Login');
$I->seeCurrentUrlEquals('/dashboard');
$I->see('Student Student');
$I->see("You're logged in!");

$I->click("Change password");

$I->fillField('password_old', 'student');
$I->fillField('password_new', 'student');
$I->fillField('password_new_confirmation', 'student2');

$I->click("Change Password");

$I->see("The password new must be at least 8 characters.");
$I->see("The password new confirmation does not match.");
$I->see("The password new and password old must be different.");

$I->fillField('password_old', 'student');
$I->fillField('password_new', 'student1');
$I->fillField('password_new_confirmation', 'student1');

$I->click("Change Password");

$I->seeCurrentUrlEquals('/dashboard');
$I->see('Student Student');
$I->see("You're logged in!");

//logout, only way i know
$I->resetCookie('laravel_session');

//login
$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'student@student.com');
$I->fillField('password', 'student1');
$I->click('Login');
$I->seeCurrentUrlEquals('/dashboard');
$I->see('Student Student');
$I->see("You're logged in!");

