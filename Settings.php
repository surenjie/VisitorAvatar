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

use Piwik\Settings\SystemSetting;
use Piwik\Settings\Setting;

class Settings extends \Piwik\Plugin\Settings{

    protected function init(){

        $setting = new SystemSetting('customVariableName', 'Name of the custom variable');
        $setting->readableByCurrentUser = true;
        $setting->type = self::TYPE_STRING;
        $setting->defaultValue = '';
        $setting->inlineHelp = 'Custom variable name where you set the user identifier (e.g. rtx, mail, username)';
        $this->addSetting($setting);

        $setting = new SystemSetting('visitorAvatarUrl', 'Visitor Avatar URL rules');
        $setting->readableByCurrentUser = true;
        $setting->type = self::TYPE_STRING;
        $setting->defaultValue = 'plugins/VisitorAvatar/images/default_avatar.gif';
        $setting->inlineHelp = 'Example : "//rtx.oa.com/avatars/%s/profile.jpg"';
        $this->addSetting($setting);

        $setting = new SystemSetting('visitorDescriptionText', 'Visitor Description Text rules');
        $setting->readableByCurrentUser = true;
        $setting->type = self::TYPE_STRING;
        $setting->defaultValue = '%s';
        $setting->inlineHelp = 'Example : "my rtx is %s"';
        $this->addSetting($setting);

    }
}
