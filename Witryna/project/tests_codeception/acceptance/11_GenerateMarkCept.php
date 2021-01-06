<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Generate some marks");


$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'lecturer@lecturer.com');
$I->fillField('password', 'lecturer');
$I->click('Login');
$I->seeCurrentUrlEquals('/dashboard');
$I->see("You're logged in!");

$I->amOnPage('/courses');
$I->see('Courses list');

$I->click('My courses');
$I->amOnPage('/courses/mine');
$I->see('Lecturer Lecturer courses:');

$I->see('Generate marks');
$I->click('Generate marks');

$I->amOnPage('/courses/2/generateMark');
$I->see('Generate marks');
$I->see('John Doe');

$I->click('Save mark');
$I->amOnPage('/courses/mine');

$I->click('Generate marks');

$I->fillField('mark', '4');
$I->click('Save mark');
$I->seeInDatabase("course_user", ["mark" => "4"]);

$I->amOnPage('/courses/mine');
