<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Student can join to the course");

//login
$I->amOnPage('/courses');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'student@student.com');
$I->fillField('password', 'student');
$I->click('Login');
$I->seeCurrentUrlEquals('/courses');

$I->click('Join');
$I->seeCurrentUrlEquals('/courses/1/join');
$I->see('Successfully joined the course');

$I->amOnPage('/courses');
$I->amOnPage('/courses/1/join');
$I->seeCurrentUrlEquals('/courses/1/join');
$I->see('Already joined this course');



