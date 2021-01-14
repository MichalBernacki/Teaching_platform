<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Lecturer can add a date to lesson");

//login
$I->amOnPage('/courses');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'pb@g.com');
$I->fillField('password', 'linux');
$I->click('Login');

$I->seeCurrentUrlEquals('/courses');

$I->click('Details');
$I->seeCurrentUrlEquals('/courses/1/lessons');
$I->see('Teoria Sygnalow');

$I->click('Add/edit dates');
$I->seeCurrentUrlEquals('/courses/1/lessons/1/dates');
$I->click('Add new date');
$I->seeCurrentUrlEquals('/courses/1/lessons/1/dates/create');
$I->fillField('date', '2023-06-23');
$I->fillField('time', '14:14:00');
$I->click('Create');
$I->seeCurrentUrlEquals('/courses/1/lessons/1/dates');

$I->see('Teoria Sygnalow');
$I->see('2023-06-23');
$I->see('14:14:00');

$I->see('07:45:00');

$I->click('Delete');
$I->seeCurrentUrlEquals('/courses/1/lessons/1/dates');
$I->dontSee('07:45:00');

$I->see('2021-01-11');
$I->see('09:30:00');
$I->click('Edit');

$I->seeCurrentUrlEquals('/courses/1/lessons/1/dates/2/edit');
$I->fillField('date', '2021-01-12');
$I->fillField('time', '15:15:15');
$I->click('Update');

$I->seeCurrentUrlEquals('/courses/1/lessons/1/dates');
$I->dontSee('2021-01-11');
$I->dontSee('09:30:00');

$I->see('2021-01-12');
$I->see('15:15:15');
