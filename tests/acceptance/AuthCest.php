<?php

/**
 * Class AuthCest
 */
class AuthCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->setCookie('LetMeIn', 'ImAwesome');
        $I->reloadPage();
//        document.cookie = "LetMeIn=ImAwesome; path=/";
    }

    public function signUp(AcceptanceTester $I)
    {
        $I->click('Sign up', '.topbar__user');
        $I->waitForElementVisible('.vex-content');

        $I->see('Sign up for MakeAGif', 'h1');
        $I->see('Benefits of a premium membership', 'a[href="/premium"]');
        $I->see('Facebook sign in', 'a[href="/login/facebook"]');
        $I->see('Twitter sign in', 'a[href="/login/twitter"]');

        $I->seeElement('input', ['name' => 'email']);
        $I->seeElement('input', ['name' => 'password']);
        $I->seeElement('input', ['name' => 'cpassword']);
        $I->seeElement('input', ['name' => 'username']);
        $I->seeElement('iframe', ['title' => 'recaptcha widget']);
        $I->see('sign me up!', 'button.button');
        $I->see('Already have an account? Login here.');

        // @todo need to disable recapthca
    }

    /**
     * @param AcceptanceTester $I
     */
    public function loginPopup(AcceptanceTester $I)
    {
        /**
         * Check all elements
         */
        $I->click('Log in', '.topbar__user');
        $I->waitForElementVisible('.vex-content');
        $I->see('Sign in to make a gif', 'h1');
        $I->see('Benefits of a premium membership', 'a.button');
        $I->see('Facebook sign in', 'a.button._color_facebook._social_login');
        $I->see('Twitter sign in', 'a.button._color_twitter._social_login');
        $I->seeElement('input', ['name' => 'logusername']);
        $I->seeElement('input', ['name' => 'logpassword', 'type' => 'password']);
        $I->see('Remember me!', 'form#login');
        $I->see('Sign in', 'button.button');
        $I->see('Don\'t have a free account? Join MakeaGif now', 'form#login');
        $I->see('Forgot Password', 'form#login a.link');

        /**
         * Try to login
         */
        $email = 'nayfania@gmail.com'; //@todo need to change in the future
        $password = '27162000';
        $I->fillField('logusername', $email);
        $I->fillField('logpassword', $password);
        $I->click(['class' => 'label', 'for' => 'remember']);
        $I->executeJS('$(".vex-overlay").hide();');
        $I->click('form#login .button._color_yellow');
        $I->waitForElementNotVisible('.vex-content');

        $I->reloadPage();

        $I->see('nayf', '.user-info');

        /**
         * Check Settings
         */
        $I->amOnPage('/settings');

        $I->see('GENERAL', '.toolbar ._state_active');
        $I->see('ACCOUNTS', '.toolbar');
        $I->see('SUBSCRIPTIONS', '.toolbar');

        $I->see('Upgrade to premium to unlock more options', 'a.button');
        $I->see('/user/nayf');

        /**
         * Check change info
         */
        $username = 'nayf';
        $I->submitForm('form#userSettings', [
            'email' => $email . '1',
            'username' => $username . '1',
            'display_name' => $username . '1',
        ]);
        $I->reloadPage();

        $I->seeElement('form#userSettings #email', ['value' => $email . '1']);
        $I->seeElement('form#userSettings #username', ['value' => $username . '1']);
        $I->seeElement('form#userSettings #display_name', ['value' => $username . '1']);

        $I->submitForm('form#userSettings', [
            'email' => $email,
            'username' => $username,
            'display_name' => $username,
        ]);
        $I->reloadPage();

        $I->seeElement('form#userSettings #email', ['value' => $email]);
        $I->seeElement('form#userSettings #username', ['value' => $username]);
        $I->seeElement('form#userSettings #display_name', ['value' => $username]);
    }

    public function loginDirect(AcceptanceTester $I)
    {
        $I->amOnPage('/login');

        $I->see('Benefits of a premium membership', 'a.button');
        $I->see('Facebook sign in', 'a.button._color_facebook._social_login');
        $I->see('Twitter sign in', 'a.button._color_twitter._social_login');

        $I->seeElement('input', ['name' => 'logusername']);
        $I->seeElement('input', ['name' => 'logpassword', 'type' => 'password']);
        $I->see('Remember me!', 'form#login');
        $I->see('Sign in', 'button.button');
        $I->see('Don\'t have a free account? Join MakeaGif now', 'form#login');
        $I->see('Forgot Password', 'form#login a.link');

        /**
         * Try to login
         */
        $email = 'nayfania@gmail.com'; //@todo need to change in the future
        $password = '27162000';
        $I->click(['class' => 'label', 'for' => 'remember']);
        $I->submitForm('form#login', [
            'logusername' => $email,
            'logpassword' => $password,
        ]);

        $I->seeInCurrentUrl('/');
        $I->see('nayf', '.user-info');
    }
}