<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
    /**
     * @param \AcceptanceTester $I
     * @param $email
     * @param $password
     */
    public function login(\AcceptanceTester $I, $email, $password)
    {
        $I->click('Log in', '.topbar__user');
        $I->waitForElementVisible('.vex-content');

        $I->fillField('logusername', $email);
        $I->fillField('logpassword', $password);
//        $I->click(['class' => 'label', 'for' => 'remember']);
        $I->executeJS('$(".vex-overlay").hide();');
        $I->click('form#login .button._color_yellow');
        $I->waitForElementNotVisible('.vex-content');

        $I->reloadPage();

        $I->see('nayf', '.user-info');
    }
}
