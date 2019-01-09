<?php

namespace Dynamic\FoxyStripeMembers;

use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\Session;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\Form;
use SilverStripe\Security\IdentityStore;
use SilverStripe\Security\Member;
use Symbiote\MemberProfiles\Pages\MemberProfilePageController;

class FoxyCartMemberProfilePageController extends MemberProfilePageController
{
    /**
     * @return array|HTMLText
     */
    public function index(HTTPRequest $request)
    {
        if (isset($_GET['BackURL'])) {
            Session::set('MemberProfile.REDIRECT', $_GET['BackURL']);
        }
        $mode = Member::currentUser() ? 'profile' : 'register';
        $data = Member::currentUser() ? $this->indexProfile() : $this->indexRegister();
        if (is_array($data)) {
            return $this->customise($data)->renderWith(array('FoxyCartMemberProfilePage_'.$mode, FoxyCartMemberProfilePage::class, 'Page'));
        }
        return $data;
    }

    /**
     * Handles validation and saving new Member objects, as well as sending out validation emails.
     */
    public function register($data, Form $form)
    {
        if ($member = $this->addMember($form)) {
            if (!$this->RequireApproval && $this->EmailType != 'Validation' && !$this->AllowAdding) {
                if($member->canLogin()){
					Injector::inst()->get(IdentityStore::class)->logIn($member);
				}
            }

            if (isset($data['backURL'])) {
                $this->redirect($data['backURL']);
            }

            if ($this->RegistrationRedirect) {
                if ($this->PostRegistrationTargetID) {
                    $this->redirect($this->PostRegistrationTarget()->Link());
                    return;
                }

                if ($sessionTarget = Session::get('MemberProfile.REDIRECT')) {
                    Session::clear('MemberProfile.REDIRECT');
                    if (Director::is_site_url($sessionTarget)) {
                        $this->redirect($sessionTarget);
                        return;
                    }
                }
            }

            return $this->redirect($this->Link('afterregistration'));
        } else {
            return $this->redirectBack();
        }
    }
}
