<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Add file to lesson");


$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'lecturer@lecturer.com');
$I->fillField('password', 'lecturer');
$I->click('Login');
$I->seeCurrentUrlEquals('/dashboard');
$I->see("You're logged in!");

$I->amOnPage('/courses');
$I->see('Courses list');

$I->amOnPage('/courses/2/lessons');
$I->see('Lessons');

$I->see('Create new lesson');
$I->click('Create new lesson');
$I->seeCurrentUrlEquals('/courses/2/lessons/create');
$I->fillField('title', 'Mutex');
$I->fillField('description', 'Mutex - description');
$I->fillField('date', '2021-06-23');
$I->fillField('time', '12:00:00');
$I->click('Create');
$I->seeCurrentUrlEquals('/courses/2/lessons');

$I->click('Join');
$I->seeCurrentUrlEquals('/courses/2/lessons/3');
$I->see('Upload file here');

$I->attachFile('file', '../unit.suite.yml');

$I->click('Upload file');
$I->seeCurrentUrlEquals('/courses/2/lessons/3');
$I->see('unit.suite.yml');
$I->seeInDatabase("lesson_materials", ["file_name" => "unit.suite.yml"]);

$I->click('Upload file');
$I->see('The file field is required.');

$I->click('Delete file');
$I->dontSeeInDatabase("lesson_materials", ["file_name" => "unit.suite.yml"]);

$I->attachFile('file', '../acceptance.suite.yml');
$I->click('Upload file');
$I->seeCurrentUrlEquals('/courses/2/lessons/3');
$I->see('acceptance.suite.yml');
$I->seeInDatabase("lesson_materials", ["file_name" => "acceptance.suite.yml"]);

$I->amOnPage('/courses/2/lessons');

$I->click('Delete');
$I->seeCurrentUrlEquals('/courses/2/lessons');
$I->dontSeeInDatabase("lesson_materials", ["file_name" => "unit.suite.yml"]);
