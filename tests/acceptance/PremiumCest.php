<?php

/**
 * Class PremiumCest
 */
class PremiumCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function checkAvailability(AcceptanceTester $I)
    {
        $I->amOnPage('/premium');

        $I->see('Create Mind-Blowing Premium GIFs', '.title');
        $I->see('Create GIFs Even Faster', 'h3');

        $I->see('Unlock premium now', 'a.button');

        $I->seeElement('.compare__visual a img');
        $I->seeElement('.compare__visual .media video');

        $I->see('Sign up today!', '.title');

        $I->see('Unregistered', 'table .compare__name');
        $I->see('Registered', 'table .compare__name');
        $I->see('Premium', 'table .compare__name');

        $I->see('Animated Gif Maker (from video URLs and Uploads)', 'h3');
        $I->see('Animated Gif Maker (from images)', 'h3');

        $I->click('Go premium');
        $I->seeInCurrentUrl('/join');
    }
}
