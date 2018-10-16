<?php

namespace Dynamic\FoxyStripeMembers;

use Dynamic\FoxyStripe\Page\OrderHistoryPage;
use SilverStripe\Security\Member;
use SilverStripe\Control\Controller;
use SilverStripe\Security\Security;

/**
 * Class MemberLandingPage
 * @package Dynamic\FoxyStripeMembers
 */
class MemberLandingPage extends \Page
{
    /**
     * @var string
     */
    private static $singular_name = 'My Account Page';

    /**
     * @var string
     */
    private static $plural_name = 'My Account Pages';

    /**
     * @var string
     */
    private static $description = 'My Account landing page for FoxyStripe. Links to orders, edit account, logout.';

    /**
     * @var string
     */
    private static $table_name = 'MemberLandingPage';

    /**
     * @return \SilverStripe\ORM\DataObject
     */
    public function getOrderHistory()
    {
        return OrderHistoryPage::get()->First();
    }

    /**
     * @return \SilverStripe\ORM\DataObject
     */
    public function getMemberPage()
    {
        return FoxyCartMemberProfilePage::get()->First();
    }
}
