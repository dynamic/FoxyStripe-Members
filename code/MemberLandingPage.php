<?php

class MemberLandingPage extends Page {

    public function getOrderHistory() {
        return OrderHistoryPage::get()->First();
    }

    public function getMemberPage() {
        return FoxyCartMemberProfilePage::get()->First();
    }

}

class MemberLandingPage_Controller extends Page_Controller {

    private static $allowed_actions = array(
        'index'
    );

    public function checkMember() {
        if(Member::currentUser()) {
            return true;
        } else {
            return Security::permissionFailure ($this, _t (
                'AccountPage.CANNOTCONFIRMLOGGEDIN',
                'Please login to view this page.'
            ));
        }
    }

    public function Index() {

        $this->checkMember();
        return array();

    }

}