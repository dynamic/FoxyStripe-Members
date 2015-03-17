<?php

if (class_exists('MemberProfilePage')) {

    /*
     * Extends Member Profiles by ajshort. Adds a Simple theme template with subnavigation
     */
    class FoxyCartMemberProfilePage extends MemberProfilePage {

        private static $hide_ancestor = 'MemberProfilePage';

        private static $singular_name = 'Member Page';
        private static $plural_name = 'Member Pages';
        private static $description = 'Members can register and edit their profile';

		public function getCMSFields(){
			$fields = parent::getCMSFields();



			$this->extend('updateCMSFields', $fields);
			return $fields;
		}

    }

    class FoxyCartMemberProfilePage_Controller extends MemberProfilePage_Controller {

        public function index() {
            if (isset($_GET['BackURL'])) {
                Session::set('MemberProfile.REDIRECT', $_GET['BackURL']);
            }
            $mode = Member::currentUser() ? 'profile' : 'register';
            $data = Member::currentUser() ? $this->indexProfile() : $this->indexRegister();
            if (is_array($data)) {
                return $this->customise($data)->renderWith(array('FoxyCartMemberProfilePage_'.$mode, 'FoxyCartMemberProfilePage', 'Page'));
            }
            return $data;
        }

        /**
         * Handles validation and saving new Member objects, as well as sending out validation emails.
         */
        public function register($data, Form $form) {
            if($member = $this->addMember($form)) {
                if(!$this->RequireApproval && $this->EmailType != 'Validation' && !$this->AllowAdding) {
                    $member->logIn();
                }

                if(isset($data['backURL'])){
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

}