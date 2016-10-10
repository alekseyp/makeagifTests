<?php

/**
 * Class YoutubeCest
 */
class VideoCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function unregistered(AcceptanceTester $I)
    {
        /**
         * mp4
         */
        $I->amOnPage('/video-to-gif');
        $I->see('Video to GIF');

        $I->attachFile('uploaded_file', 'video1.mp4');

        $I->waitForElement('.vex.vex-theme-plain');
        $I->waitForElementNotVisible('.vex.vex-theme-plain', 30);

        $I->see('Preview', '.create-gif .label');
        $I->seeElement('.create-gif .media__content video');

        $I->fillField('title', 'Video test');
        $I->fillField(['id' => 'tags_text'], 'video test');

        $I->wait(5);

        $I->click('#create');

        $I->waitForElement('.vex.vex-theme-plain');
        $I->waitForElementNotVisible('.vex.vex-theme-plain', 30);
        $I->wait(1);
        $I->waitForJS('return document.readyState=="complete"');

        $I->see('Video test', 'h1');
        $I->seeElement('.media__content img');

        //@todo need to check also:
        // webm
        // dailymotion & vevo URl
        // start time
        // length time
        // audio
        // tags
    }
}
