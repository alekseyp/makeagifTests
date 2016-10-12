<?php

/**
 * Class YoutubeCest
 */
class YoutubeCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function unregistered(AcceptanceTester $I)
    {
        $I->amOnPage('/youtube-to-gif');
        $I->see('Youtube to GIF');

        // @todo need to posses test link
        $youtubeUrl = 'https://www.youtube.com/watch?v=8iJC5memr5k';
        $I->fillField('#url', $youtubeUrl);

        $I->click('Load Video');

        $I->waitForElement('.vex.vex-theme-plain');
        $I->waitForElementNotVisible('.vex.vex-theme-plain', 30);

        $I->see('Preview', '.create-gif .label');
        $I->seeElement('.create-gif .media__content video');

        $I->fillField('title', 'Youtube test');
        $I->fillField(['id' => 'tags_text'], 'youtube test');

        $I->click('#create');

        $I->waitForElement('.vex.vex-theme-plain');
        $I->waitForElementNotVisible('.vex.vex-theme-plain', 120);

        $I->wait(1);
        $I->waitForJS('return document.readyState=="complete"');

        $I->see('Youtube title', 'h1');
//        $I->see('#beautiful', '.tags'); @todo need to check tags - I cann`t find them
//        $I->see('#b1', '.tags');

        $I->seeElement('.media__content img');

        // @todo need to check also:
        // change start time
        // change length
        // enable audio
    }

    /**
     * @param AcceptanceTester $I
     */
    public function authorized(AcceptanceTester $I)
    {
        $I->amOnPage('/youtube-to-gif');
        $I->see('Youtube to GIF');

        /**
         * Log in
         */
        $email = 'nayfania@gmail.com'; //@todo need to change in the future
        $password = '27162000';
        $I->login($I, $email, $password);

        // @todo need to posses test link
        $youtubeUrl = 'https://www.youtube.com/watch?v=8iJC5memr5k';
        $I->fillField('#url', $youtubeUrl);

        $I->click('Load Video');

        $I->waitForElement('.vex.vex-theme-plain');
        $I->waitForElementNotVisible('.vex.vex-theme-plain', 30);

        $I->see('Preview', '.create-gif .label');
        $I->seeElement('.create-gif .media__content iframe#player');

        $I->fillField('title', 'Youtube test');
        $I->fillField(['id' => 'tags_text'], 'youtube test');

        $I->click('#create');

        $I->waitForElement('.vex.vex-theme-plain');
        $I->waitForElementNotVisible('.vex.vex-theme-plain', 120);

        $I->wait(1);
        $I->waitForJS('return document.readyState=="complete"');

        $I->see('Youtube title', 'h1');
        $I->seeElement('.media__content img');
    }
}
