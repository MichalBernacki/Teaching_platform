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
$I->seeCurrentUrlEquals('/courses/mine');
$I->see('Lecturer Lecturer courses:');

$I->see('Generate marks');
$I->click('Generate marks');

$I->seeCurrentUrlEquals('/courses/2/generateMark');
$I->see('Generate marks');
$I->see('John Doe');

$I->click('Save mark');
$I->seeCurrentUrlEquals('/courses/2/generateMark');

$I->fillField('mark', '4');
$I->click('Save mark');
$I->seeInDatabase("course_user", ["mark" => "4"]);

$I->seeCurrentUrlEquals('/courses/mine');

$I->click('Generate marks');
$I->fillField('mark', '3.5');
$I->click('Save mark');
$I->seeInDatabase("course_user", ["mark" => "3.5"]);

$I->click('Generate marks');
$I->fillField('mark', '3.75');
$I->click('Save mark');
$I->seeInDatabase("course_user", ["mark" => "4"]);

$I->click('Generate marks');
$I->fillField('mark', '3.25');
$I->click('Save mark');
$I->seeInDatabase("course_user", ["mark" => "3.5"]);

$I->click('Generate marks');
$I->fillField('mark', '1');
$I->click('Save mark');
$I->see('The mark must be at least 2.');


$I->fillField('mark', '7');
$I->click('Save mark');
$I->see('The mark may not be greater than 5.');




