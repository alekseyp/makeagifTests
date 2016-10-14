<?php

/**
 * Class PremiumCest
 */
class PremiumCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->setCookie('LetMeIn', 'ImAwesome');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function checkAvailability(AcceptanceTester $I)
    {
        $I->wantToTest('unregistered');

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

        $I->wantToTest('registered');
        $I->login($I, 'nayfania@gmail.com', '27162000');
        $I->amOnPage('/premium');
        $I->see('Unlock premium now', 'a[href="/premium/get/?signup&return"]');
        $I->see('Go premium', 'a[href="/premium/get/?signup&return"]');

        $I->click('Unlock premium now');

        $I->seeInCurrentUrl('/premium/get?signup&return');
        $I->see('Premium subscription');
        $I->see('PREMIUM MONTHLY');
        $I->see('PREMIUM 3 MONTHS');
        $I->see('PREMIUM 6 MONTHS');
        $I->see('$ 11.99');
        $I->see('$ 11.99 per month');
        $I->see('$ 24.99');
        $I->see('$ 8.33 per month');
        $I->see('$ 29.99');
        $I->see('~ $ 5.00 per month');
        $I->see('UNLOCK PREMIUM');
    }
}
