<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Lecturer can create a lesson");

//login
$I->amOnPage('/courses');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'lecturer@lecturer.com');
$I->fillField('password', 'lecturer');
$I->click('Login');
$I->seeCurrentUrlEquals('/courses');

$I->click('Details');
$I->seeCurrentUrlEquals('/courses/1/lessons');
$I->see('Teoria Sygnalow');

$I->amOnPage('/courses/1/lessons');
$I->click('Create new lesson');
$I->seeCurrentUrlEquals('/courses/1/lessons/create');
$I->fillField('title', 'Correlation');
$I->fillField('description', 'Correlation - description');
$I->fillField('date', '2021-06-23');
$I->fillField('time', '12:00:00');
$I->click('Create');
$I->seeCurrentUrlEquals('/courses/1/lessons');

$I->see('Correlation');
$I->see('Correlation - description');
$I->see('2021-06-23');
$I->see('12:00:00');
