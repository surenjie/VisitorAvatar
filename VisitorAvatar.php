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

use Piwik\Plugin;

/**
 */
class VisitorAvatar extends Plugin{

    const DEFAULT_AVATAR_URL_FIELD = 'plugins/VisitorAvatar/images/default_avatar.gif';

    const DEFAULT_AVATAR_DESCRIPTION_FIELD = 'Visitor Default Avatar';

    /**
     *
     * @see Piwik\Plugin::getListHooksRegistered
     */
    public function getListHooksRegistered(){
        return array(
            'Live.getExtraVisitorDetails' => 'getVisitorAvatarDetails'
        );
    }

    /**
     *
     * @see http://developer.piwik.org/api-reference/events#livegetextravisitordetails
     */
    public function getVisitorAvatarDetails(&$result){
        // default
        $visitorAvatar = self::DEFAULT_AVATAR_URL_FIELD;
        $visitorDescription = self::DEFAULT_AVATAR_DESCRIPTION_FIELD;
        // @see Piwik\DataTable\Row
        $visitorName = $this->getVisitorNameFromCustomVariables($result['lastVisits']->getFirstRow()->getColumns()['customVariables']);
        // check
        if($visitorName){
            $visitorDescription = $visitorName;
            $visitorAvatarUrl = $this->getVisitorAvatarSetting('visitorAvatarUrl');
            if($visitorAvatarUrl){
                # //dayu.oa.com/avatars/%s/profile.jpg
                $visitorAvatar = vsprintf($visitorAvatarUrl, array($visitorName));
            }
        }
        
        $result['visitorAvatar'] = $visitorAvatar;
        $result['visitorDescription'] = $visitorDescription;
    }

    private function getVisitorNameFromCustomVariables($customVariables){
        if (is_array($customVariables)) {
            foreach ($customVariables as $customVariable) {
                for ($i = 1; $i <= 5; $i ++) {
                    if (isset($customVariable['customVariableName' . $i]) && $customVariable['customVariableName' . $i] == $this->getVisitorAvatarSetting('customVariableName')) {
                        return $customVariable['customVariableValue' . $i];
                    }
                }
            }
        }
        return "";
    }

    /**
     *
     * @see Piwik\Settings\SystemSetting
     */
    private function getVisitorAvatarSetting($name){
        $value = null;
        $settings = (new Settings('VisitorAvatar'))->getSettings();
        if(isset($settings[$name])){
            $value = $settings[$name]->getValue();
        }
        return $value;
    }

}
