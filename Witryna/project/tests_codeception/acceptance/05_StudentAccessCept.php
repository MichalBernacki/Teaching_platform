<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Access dean's office employee to pages");

//login
$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'student@student.com');
$I->fillField('password', 'student');
$I->click('Login');
$I->seeCurrentUrlEquals('/dashboard');
$I->see('Student Student');
$I->see("You're logged in!");

//can't access to users controller
$I->amOnPage('/users');
$I->see('403');

$I->amOnPage('/users/1/edit');
$I->see('403');

//can access to courses controller
$I->amOnPage('/courses');
$I->see('Courses list ');
$I->amOnPage('/courses/1/join');
$I->see('Successfully joined the course ');

