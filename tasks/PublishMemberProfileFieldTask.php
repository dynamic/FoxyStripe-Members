<?php

namespace Dynamic\FoxyStripeMembers\Task;

use SilverStripe\Control\Director;
use SilverStripe\Dev\BuildTask;
use Symbiote\MemberProfiles\Model\MemberProfileField;
use Symbiote\MemberProfiles\Model\MemberProfileSection;

class PublishMemberProfileFieldTask extends BuildTask
{
    /**
     * @var string
     */
    protected $title = 'Publish all MemberProfile fields and sections';

    /**
     * @var string
     */
    protected $description = 'FoxyStripe Members migration task for SilverStripe 4 upgrades';

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @param $request
     */
    public function run($request)
    {
        $this->publishFields();
        $this->publishSections();
    }

    /**
     * @return \Generator
     */
    protected function getFields()
    {
        foreach (MemberProfileField::get() as $field) {
            yield $field;
        }
    }

    /**
     * @return \Generator
     */
    protected function getSections()
    {
        foreach (MemberProfileSection::get() as $section) {
            yield $section;
        }
    }

    /**
     *
     */
    public function publishFields()
    {
        $ct = 0;
        foreach ($this->getFields() as $field) {
            $field->writeToStage('Stage');
            $field->publishRecursive();
            ++$ct;
        }
        static::write_message($ct . " MemberProfileFields updated");
    }

    public function publishSections()
    {
        $ct = 0;
        foreach ($this->getSections() as $section) {
            $section->writeToStage('Stage');
            $section->publishRecursive();
            ++$ct;
        }
        static::write_message($ct . " MemberProfileSections updated");
    }

    /**
     * @param $message
     */
    protected static function write_message($message)
    {
        if (Director::is_cli()) {
            echo "{$message}\n";
        } else {
            echo "{$message}<br><br>";
        }
    }
}