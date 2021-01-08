<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("View student's courses");

//login
$I->amOnPage('/dashboard');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'student@student.com');
$I->fillField('password', 'student');
$I->click('Login');
$I->seeCurrentUrlEquals('/dashboard');
$I->see('Student Student');
$I->see("You're logged in!");

$I->amOnPage('/courses');
$I->see('Courses list');

$I->click('My courses');
$I->amOnPage('/courses/mine');
$I->see('Student Student courses:');
$I->see('Course');
$I->dontSee('Edit course');

$I->click('Course');

$courseId = $I->grabFromDatabase('courses', 'id', ['name'=>'Course']);
$I->amOnPage('/courses/'.$courseId);

