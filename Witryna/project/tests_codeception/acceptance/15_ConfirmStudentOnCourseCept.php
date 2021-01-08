<?php
$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Confirm new student in my course");

$I->haveInDatabase('course_user',["user_id"=>2,"course_id"=>1,"confirmed"=>0,"mark"=>0]);

$I->amOnPage('/courses/1/listparticipants');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'pb@g.com');
$I->fillField('password', 'linux');
$I->click('Login');
$I->seeCurrentUrlEquals('/courses/1/listparticipants');
$I->see("List of participants:");


$I->click('Confirm');

$I->seeCurrentUrlEquals('/courses/1/listparticipants');
$I->see("List of participants:");
$I->dontSee("unconfirmed");

$I->seeInDatabase('course_user',["user_id"=>2,"course_id"=>1,"confirmed"=>1,"mark"=>0]);
