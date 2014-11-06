<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
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
        $setting->defaultValue = 'RTX';
        $setting->inlineHelp = 'Custom variable name where you set the user identifier (e.g. username, mail, rtx)';
        $this->addSetting($setting);

        $setting = new SystemSetting('visitorAvatarUrl', 'Visitor Avatar URL rules');
        $setting->readableByCurrentUser = true;
        $setting->type = self::TYPE_STRING;
        $setting->defaultValue = '';
        $setting->inlineHelp = 'Example : "//rtx.oa.com/avatars/%s/profile.jpg"';
        $this->addSetting($setting);

    }
}
