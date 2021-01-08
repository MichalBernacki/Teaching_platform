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
$I->see('Courses list');

$I->click('My courses');
$I->amOnPage('/courses/mine');
$I->see('Lecturer Lecturer courses:');

$I->see('Course course');
$I->see('Edit course');

$courseId = $I->grabFromDatabase('courses', 'id', ['name'=>'Course']);
$I->amOnPage('/courses/' . $courseId . '/edit');

$I->fillField('name', 'Course 2');
$I->fillField('description', 'Description 2');
$I->click('Update');

$I->amOnPage('/courses');
$I->click('My courses');

$I->see('Course 2');
$I->see('Description 2');

