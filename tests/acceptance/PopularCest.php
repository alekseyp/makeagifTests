<?php

/**
 * Class PopularCest
 */
class PopularCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function checkAvailability(AcceptanceTester $I)
    {
        $I->amOnPage('/all-gifs');

        /**
         * Check top menu
         */
        $I->see('Browse GIFs', '.topbar__menu');
        $I->see('Popular', '.topbar__menu');
        $I->see('Create a GIF', '.topbar__menu');
        $I->see('Extras', '.topbar__menu');

        $I->see('Log in', '.topbar__user');
        $I->see('Sign up', '.topbar__user');

        $I->seeElement('.header form input#q'); // search form

        $I->see('All GIFs', '.toolbar');
        $I->see('Popular Now', '.toolbar');
        $I->see('Newest', '.toolbar');
        $I->see('Create a GIF', '.toolbar');

        /**
         * Check number of gifs
         */
        $I->seeNumberOfElements('.card-list .card', 24);

        $I->see('Load more gifs', '.pager');
        $I->seeElement('.pager ul.pagination');

        /**
         * Check footer menu
         */
        $I->see('Browse GIFs', '.footer');
        $I->see('Popular', '.footer');
        $I->see('Pictures to GIF', '.footer');
        $I->see('YouTube to GIF', '.footer');
        $I->see('Video to GIF', '.footer');
        $I->see('Webcam to GIF', '.footer');
        $I->see('Upload a GIF', '.footer');
        $I->see('Request Deletion', '.footer');

        /**
         * Check pagination
         */
        $I->click('2', '.pager ul.pagination');

        $I->canSeeInCurrentUrl('/all-gifs/popular/2');

        $I->see('2', '.pager ul.pagination li.current');
        $I->seeNumberOfElements('.card-list .card', 24);
    }
}
