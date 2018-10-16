<?php

namespace Dynamic\FoxyStripeMembers;

use SilverStripe\Control\Controller;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;

class MemberLandingPageController extends \PageController
{
    /**
     * @var array
     */
    private static $allowed_actions = array(
        'index'
    );

    /**
     * @return bool|\SilverStripe\Control\HTTPResponse
     */
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

    /**
     * @param HTTPRequest $request
     * @return array
     */
    public function index(HTTPRequest $request)
    {
        $this->checkMember();
        return array();
    }
}
