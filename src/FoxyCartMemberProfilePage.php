<?php

namespace Dynamic\FoxyStripeMembers;

use SilverStripe\Control\Session;
use SilverStripe\Security\Member;
use SilverStripe\Forms\Form;
use SilverStripe\Control\Director;
use Symbiote\MemberProfiles\Pages\MemberProfilePage;

/*
 * Extends Member Profiles by ajshort. Adds a Simple theme template with subnavigation
 */
class FoxyCartMemberProfilePage extends MemberProfilePage
{
    /**
     * @var string
     */
    private static $hide_ancestor = 'MemberProfilePage';

    /**
     * @var string
     */
    private static $singular_name = 'Edit Account Page';

    /**
     * @var string
     */
    private static $plural_name = 'Edit Account Pages';

    /**
     * @var string
     */
    private static $description = 'FoxyStripe customers can register and edit their profile';

    /**
     * @var string
     */
    private static $table_name = 'FoxyCartMemberProfilePage';
}
