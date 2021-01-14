<?php
$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Give pluses and presence");

$I->seeInDatabase('lesson_time_user',["lesson_time_id"=>1,"user_id"=>1,"presence"=>1,"pluses"=>4]);

$I->amOnPage('/courses/1/lessons/1');
$I->seeCurrentUrlEquals('/login');
$I->fillField('email', 'pb@g.com');
$I->fillField('password', 'linux');
$I->click('Login');
$I->seeCurrentUrlEquals('/courses/1/lessons/1');
$I->see("Presence and pluses");

$I->click('Presence and pluses');

$I->seeCurrentUrlEquals('/courses/1/lessons/1/presence');

$I->selectOption("pluses1","5");
$I->selectOption("presence1","0");

$I->click("Apply");

$I->see("Presence and pluses");
$I->seeCurrentUrlEquals('/courses/1/lessons/1');

$I->seeInDatabase('lesson_time_user',["lesson_time_id"=>1,"user_id"=>1,"presence"=>0,"pluses"=>0]);
$I->click('Presence and pluses');

$I->seeCurrentUrlEquals('/courses/1/lessons/1/presence');

$I->selectOption("pluses1","5");
$I->selectOption("presence1","1");

$I->click("Apply");

$I->see("Presence and pluses");
$I->seeCurrentUrlEquals('/courses/1/lessons/1');

$I->seeInDatabase('lesson_time_user',["lesson_time_id"=>1,"user_id"=>1,"presence"=>1,"pluses"=>5]);
