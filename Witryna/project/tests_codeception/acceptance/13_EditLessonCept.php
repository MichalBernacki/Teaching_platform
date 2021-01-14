<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Lecturer can edit a lesson");

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
$I->see('korelacja');
$I->see('xcorr');
$I->click('Edit');

$I->seeCurrentUrlEquals('/courses/1/lessons/1/edit');

$I->fillField('title', 'Correlation');
$I->fillField('description', 'Correlation - description');
$I->click('Update');
$I->seeCurrentUrlEquals('/courses/1/lessons');

$I->dontSee('korelacja');
$I->dontSee('xcorr');
$I->see('Correlation');
$I->see('Correlation - description');

