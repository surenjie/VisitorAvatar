<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @see http://developer.piwik.org/guides/getting-started-part-1
 *
 */
namespace Piwik\Plugins\VisitorAvatar;

use Piwik\Piwik;
use Piwik\Settings\SystemSetting;

class Settings extends \Piwik\Plugin\Settings{
    /** @var SystemSetting */
    public $customVariableName;

    /** @var SystemSetting */
    public $visitorAvatarUrl;

    /** @var SystemSetting */
    public $visitorDescriptionText;

    private $exampleTranslateText;

    protected function init(){
        $this->exampleTranslateText = Piwik::translate('VisitorAvatar_Example');
        // PluginDescription
        $this->setIntroduction(Piwik::translate('VisitorAvatar_PluginDescription'));
        // SystemSetting
        $this->createCustomVariableNameSetting();
        $this->createVisitorAvatarUrlSetting();
        $this->createVisitorDescriptionTextSetting();
    }

    private function createCustomVariableNameSetting(){
        $this->customVariableName = new SystemSetting('customVariableName', Piwik::translate('VisitorAvatar_CustomVariableName'));
        $this->customVariableName->type  = static::TYPE_STRING;
        $this->customVariableName->inlineHelp = $this->exampleTranslateText.' : "rtx", "mail", "login", "username"';
        $this->customVariableName->description   = Piwik::translate('VisitorAvatar_CustomVariableName2');
        $this->customVariableName->readableByCurrentUser = true;

        $this->addSetting($this->customVariableName);
    }

    private function createVisitorAvatarUrlSetting(){
        $this->visitorAvatarUrl = new SystemSetting('visitorAvatarUrl', Piwik::translate('VisitorAvatar_VisitorAvatarUrl'));
        $this->visitorAvatarUrl->type  = static::TYPE_STRING;
        $this->visitorAvatarUrl->defaultValue = 'plugins/VisitorAvatar/images/default_avatar.gif';
        $this->visitorAvatarUrl->inlineHelp = $this->exampleTranslateText.' : "//rtx.oa.com/avatars/%s/profile.jpg"';
        $this->visitorAvatarUrl->readableByCurrentUser = true;

        $this->addSetting($this->visitorAvatarUrl);
    }

    private function createVisitorDescriptionTextSetting(){
        $this->visitorDescriptionText = new SystemSetting('visitorDescriptionText', Piwik::translate('VisitorAvatar_VisitorDescriptionText'));
        $this->visitorDescriptionText->type  = static::TYPE_STRING;
        $this->visitorDescriptionText->defaultValue = '%s';
        $this->visitorDescriptionText->inlineHelp = $this->exampleTranslateText.' : "my rtx is %s", "login : %s"';
        $this->visitorDescriptionText->readableByCurrentUser = true;

        $this->addSetting($this->visitorDescriptionText);
    }
}
