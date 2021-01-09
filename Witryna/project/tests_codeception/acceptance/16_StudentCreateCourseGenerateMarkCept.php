<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Find if student can create new course or generate mark");


$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'student@student.com');
$I->fillField('password', 'student');
$I->click('Login');
$I->seeCurrentUrlEquals('/dashboard');
$I->see("You're logged in!");

$I->amOnPage('/courses');
$I->see('Courses list');

$I->click('My courses');
$I->seeCurrentUrlEquals('/courses/mine');

$I->dontSee('Create course');

$I->dontSee('Generate marks');


