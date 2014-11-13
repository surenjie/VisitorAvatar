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
        // default const
        $visitorAvatar = self::DEFAULT_AVATAR_URL_FIELD;
        $visitorDescription = self::DEFAULT_AVATAR_DESCRIPTION_FIELD;
        // @see Piwik\DataTable\Row
        $customVariables = $result['lastVisits']->getFirstRow()->getColumns()['customVariables'];
        $visitorName = $this->getVisitorNameFromCustomVariables($customVariables);
        // check exist
        if($visitorName){
            $visitorAvatarUrl = $this->getVisitorAvatarSetting('visitorAvatarUrl');
            if($visitorAvatarUrl){
                /* //rtx.oa.com/avatars/%s/profile.jpg */
                $visitorAvatar = vsprintf($visitorAvatarUrl, array($visitorName));
            }
            $visitorDescriptionText = $this->getVisitorAvatarSetting('visitorDescriptionText');
            if($visitorDescriptionText){
                /* my rtx is %s */
                $visitorDescription = vsprintf($visitorDescriptionText, array($visitorName));
            }else{
                $visitorDescription = $visitorName;
            }
        }
        // sync result
        $result['visitorAvatar'] = $visitorAvatar;
        $result['visitorDescription'] = $visitorDescription;
    }

    private function getVisitorNameFromCustomVariables($customVariables){
        $visitorName = "";
        if(is_array($customVariables)){
            $prefix = "customVariable";
            // Name of the custom variable
            $customVariableName = $this->getVisitorAvatarSetting('customVariableName');
            foreach($customVariables as $id => $customVariable){
                $name = $prefix.'Name'.$id;
                $value = $prefix.'Value'.$id;
                if(isset($customVariable[$name]) && $customVariable[$name] == $customVariableName){
                    $visitorName = $customVariable[$value];
                    break;
                }
            }
        }
        return $visitorName;
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
