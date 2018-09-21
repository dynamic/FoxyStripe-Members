<?php

class MemberLandingPage extends Page
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

    public function getOrderHistory()
    {
        return OrderHistoryPage::get()->First();
    }

    public function getMemberPage()
    {
        return FoxyCartMemberProfilePage::get()->First();
    }
}

class MemberLandingPage_Controller extends Page_Controller
{
    private static $allowed_actions = array(
        'index'
    );

    public function checkMember()
    {
        if (Member::currentUser()) {
            return true;
        } elseif ($MemberPage = FoxyCartMemberProfilePage::get()->First()) {
            Controller::redirect($MemberPage->Link());
        } else {
            return Security::permissionFailure($this, _t(
                'AccountPage.CANNOTCONFIRMLOGGEDIN',
                'Please login to view this page.'
            ));
        }
    }

    public function Index()
    {
        $this->checkMember();
        return array();
    }
}
