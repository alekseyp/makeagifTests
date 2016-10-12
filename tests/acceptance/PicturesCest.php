<?php

/**
 * Class PicturesCest
 */
class PicturesCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function unregistered(AcceptanceTester $I)
    {
        $I->amOnPage('/pictures-to-gif');
        $I->see('Pictures to GIF');

        // Upload 3 images
        $I->attachFile('#Filedata', 'image1.jpg');
        $I->attachFile('#Filedata', 'image2.jpg');
        $I->attachFile('#Filedata', 'image3.jpg');
        // Check pictures preview
        $I->seeNumberOfElements('#thumbnails .card', 3);

        $I->click('Continue');

        $I->fillField('title', 'Beautiful');
        $I->fillField(['id' => 'tags_text'], 'beautiful b1 ');
        // @todo need to check it after create
        $I->selectOption('select#delay_select', 'slower 1000ms delay');
        $I->selectOption('select#resize', 'To smallest cropped');

        $I->click('#create');

        $I->waitForElement('.vex.vex-theme-plain');
        $I->waitForElementNotVisible('.vex.vex-theme-plain', 30);

        $I->wait(1);
        $I->waitForJS('return document.readyState=="complete"');

        $I->see('Beautiful', 'h1');
        $I->see('#beautiful', '.tags');
        $I->see('#b1', '.tags');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function authorized(AcceptanceTester $I)
    {
        $I->amOnPage('/pictures-to-gif');
        $I->see('Pictures to GIF');

        /**
         * Log in
         */
        $email = 'nayfania@gmail.com'; //@todo need to change in the future
        $password = '27162000';
        $I->login($I, $email, $password);

        /**
         * Upload pictures
         */

        // Upload 3 images
        $I->attachFile('#Filedata', 'image1.jpg');
        $I->attachFile('#Filedata', 'image2.jpg');
        $I->attachFile('#Filedata', 'image3.jpg');
        // Check pictures preview
        $I->seeNumberOfElements('#thumbnails .card', 3);

        $I->click('Continue');

        $I->fillField('title', 'Beautiful');
        $I->fillField(['id' => 'tags_text'], 'beautiful b1 ');
        // @todo need to check it after create
        $I->selectOption('select#delay_select', 'slower 1000ms delay');
        $I->selectOption('select#resize', 'To smallest cropped');

        $I->click('#create');

        $I->waitForElement('.vex.vex-theme-plain');
        $I->waitForElementNotVisible('.vex.vex-theme-plain', 30);

        $I->wait(1);
        $I->waitForJS('return document.readyState=="complete"');

        $I->see('Beautiful', 'h1');
        $I->see('#beautiful', '.tags');
        $I->see('#b1', '.tags');
    }
}
