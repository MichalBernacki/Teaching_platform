<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Lecturer can delete a lesson");

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

$I->click('Delete');
$I->seeCurrentUrlEquals('/courses/1/lessons');

$I->dontSee('korelacja');
$I->dontSee('xcorr');
