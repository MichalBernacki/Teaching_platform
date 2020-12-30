<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("View lecturer's courses");

//login
$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'lecturer@lecturer.com');
$I->fillField('password', 'lecturer');
$I->click('Login');
$I->seeCurrentUrlEquals('/dashboard');
$I->see('Lecturer Lecturer');
$I->see("You're logged in!");

$I->amOnPage('/courses');
$I->see('Course course');

$I->click('My courses');
$I->amOnPage('/courses/mine');
$I->see('Lecturer Lecturer courses:');
$I->see('Course course');
$I->see('Edit course');

