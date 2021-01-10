<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Create new course");


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
$I->see('Course course');

$I->click('Create course');
$I->see('Create new course');

$I->fillField('name', 'Bazy Danych');
$I->fillField('description', 'kurs podstawowy baz danych');

$I->click('Create');

$I->click('My courses');
$I->seeCurrentUrlEquals('/courses/mine');
$I->see('Bazy Danych');
$I->see('kurs podstawowy baz danych');

$I->seeInDatabase("courses", ["name" => "Bazy Danych", "description" => "kurs podstawowy baz danych"]);

$I->click('Create course');
$I->see('Create new course');

$I->click('Create');
$I->see("The name field is required.");
$I->see("The description field is required.");

$I->fillField('description', 'kurs podstawowy komputerowych systemów pomiarowych');

$I->click('Create');

$I->see("The name field is required.");

$I->fillField('name', 'KSP');
$I->fillField('description', 'kurs podstawowy komputerowych systemów pomiarowych');
$I->click('Create');

$I->click('My courses');
$I->seeCurrentUrlEquals('/courses/mine');
$I->see('KSP');
$I->see('kurs podstawowy komputerowych systemów pomiarowych');

$I->seeInDatabase("courses", ["name" => "KSP", "description" => "kurs podstawowy komputerowych systemów pomiarowych"]);


