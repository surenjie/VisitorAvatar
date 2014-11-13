# Piwik VisitorAvatar Plugin

Custom display visitors avatar(URL) and description(Title & Alt)

http://plugins.piwik.org/VisitorAvatar

## Description

  * Step1 Tracking Code

    Reference:
      
      http://piwik.org/docs/custom-variables/#track-a-custom-variable-in-javascript
    
      http://developer.piwik.org/api-reference/tracking-javascript#custom-variables

    Example:

    ```JavaScript
    // you can set up to 5 custom variables for each visitor
    _paq.push([
        "setCustomVariable", 
        1, 
        "RTX", 
        document.cookie.match(new RegExp("(^| )_login_name=([^;]*)(;|$)"))[2], 
        "visit"
    ]);
    ```

  * Step2 Plugin Settings

    1. Name of the custom variable : 
      
      "RTX" (Previous set of custom variable names, no default)

    2. Visitor avatar url rules : 
      
      "//rtx.oa.com/avatars/%s/profile.jpg" (The default is "plugins/VisitorAvatar/images/default_avatar.gif")

    3. Visitor description text rules : 
      
      "my rtx is %s" (The default is "%s")


  * Step3 Visitor Profile

    _View Visitors custom avatar and description_

## Tutorial

![Step1 Tracking Code](https://raw.githubusercontent.com/surenjie/VisitorAvatar/master/screenshots/Step1_Tracking_Code.png "Step1 Tracking Code")

![Step2 Plugin Settings](https://raw.githubusercontent.com/surenjie/VisitorAvatar/master/screenshots/Step2_Plugin_Settings.png "Step2 Plugin Settings")

![Step3 Visitor Profile](https://raw.githubusercontent.com/surenjie/VisitorAvatar/master/screenshots/Step3_Visitor_Profile.png "Step3 Visitor Profile")

## Support

Please direct any feedback to i@renjie.me

If you experience any issues feel free to file an issue at https://github.com/surenjie/VisitorAvatar/issues