<?php

/**
 * Class UploadCest
 */
class UploadCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->setCookie('LetMeIn', 'ImAwesome');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function unregistered(AcceptanceTester $I)
    {
        $I->amOnPage('/upload-gif');
        $I->see('Upload a GIF');

        $I->attachFile('Filedata', 'animation1.gif');

        $I->see('Preview', '.create-gif .label');
        $I->waitForElement('.create-gif .media__content img');

        $I->fillField('title', 'Animation test');
        $I->fillField(['id' => 'tags_text'], 'animation test ');

        $I->click('#create');

        $I->waitForElement('.vex.vex-theme-plain');
        $I->waitForElementNotVisible('.vex.vex-theme-plain', 60);
        $I->wait(10);
        $I->waitForJS('return document.readyState=="complete"');

        $I->see('Animation test', 'h1');
        $I->seeElement('.media__content img');
        $I->see('#animation', '.tags');
        $I->see('#test', '.tags');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function authorized(AcceptanceTester $I)
    {
        $I->amOnPage('/upload-gif');
        $I->see('Upload a GIF');

        /**
         * Log in
         */
        $email = 'nayfania@gmail.com'; //@todo need to change in the future
        $password = '27162000';
        $I->login($I, $email, $password);

        $I->attachFile('Filedata', 'animation1.gif');

        $I->see('Preview', '.create-gif .label');
        $I->waitForElement('.create-gif .media__content img');

        $I->fillField('title', 'Animation test');
        $I->fillField(['id' => 'tags_text'], 'animation test ');

        $I->click('#create');

        $I->waitForElement('.vex.vex-theme-plain');
        $I->waitForElementNotVisible('.vex.vex-theme-plain', 60);
        $I->wait(10);
        $I->waitForJS('return document.readyState=="complete"');

        $I->see('Animation test', 'h1');
        $I->seeElement('.media__content img');
        $I->see('#animation', '.tags');
        $I->see('#test', '.tags');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function premium(AcceptanceTester $I)
    {

    }
}
