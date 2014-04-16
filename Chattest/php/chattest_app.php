<?php
    session_start();

    include "LoginOps.php";

    if(!LoginOps::isLoggedIn()) {
        header("Location: ../index.php");
        die();
    }
?>

<html ng-app="chattestApp">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="UTF-8">
        <title>Chattest</title>
        <link rel="stylesheet" type="text/css" href="../css/ui-darkness/jquery-ui-1.10.4.custom.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/chattest.css" media="screen" />
        <!-- Color schemes -->
        <link rel="stylesheet" type="text/css" href="../css/color_schemes/tangerine_marmalade.css" 
              title="Tangerine Marmalade" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="../css/color_schemes/peppermint_tea.css"
              title="Peppermint Tea" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="../css/color_schemes/blueberry_pie.css"
              title="Blueberry Pie" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="../css/color_schemes/mango_sorbet.css"
              title="Mango Sorbet" media="screen" />

        <script type="text/javascript" src="../js/libraries/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../js/libraries/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../js/libraries/moment.min.js"></script>
        <script type="text/javascript" src="../js/angular.min.js"></script>
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../js/services.js"></script>
        <script type="text/javascript" src="../js/controllers.js"></script>
    </head>
    <body ng-controller="appBody">
        <div id="message-box">
            <div id="message-area">
                <p ng-repeat="message in messages">
                    <span class="user-message-name">{{message.name}}:</span>
                    <span class="user-message-msg">{{message.msg}}</span>
                    <span class="user-message-dt">{{message.dt.dt_ago}}</span>
                </p>
            </div>
            <div id="user-list">
                <div id="user-list-names">
                    <span class="user-list-name" ng-repeat="username in online">
                        {{username}}{{$last ? '' : ', '}}
                    </span>
                </div>
            </div>
            <div id="show-users" ng-click="showUserList();"></div>
        </div>
        <div id="control-panel-area">
            <div id="control-panel-tab">
                 ^
            </div>
            <div id="control-panel">
                <!-- Main Menu -->
                <div id="color-options" class="control-panel-options control-panel-option">
                    <span id="color-options-text" class="control-panel-options-text">
                        Color
                    </span>
                </div>
                <div id="layout-options" class="control-panel-options control-panel-option">
                    <span id="layout-options-text" class="control-panel-options-text">
                        Layout
                    </span>
                </div>
                <div id="system-options" class="control-panel-options control-panel-option">
                    <span id="system-options-text" class="control-panel-options-text">
                        System
                    </span>
                </div>
                
                <!-- Sub-Menus -->
                <div id="color-options-buttons" class="control-panel-sub-options">
                    <div id="color-options-mango" class="control-panel-options
                         control-panel-sub-option">
                        <span class="control-panel-options-text">Mango</span>
                    </div>
                    <div id="color-options-blueberry" class="control-panel-options
                         control-panel-sub-option">
                        <span class="control-panel-options-text">Blueberry</span>
                    </div>
                    <div id="color-options-peppermint" class="control-panel-options
                         control-panel-sub-option">
                        <span class="control-panel-options-text">Peppermint</span>
                    </div>
                    <div id="color-options-tangerine" class="control-panel-options
                         control-panel-sub-option">
                        <span class="control-panel-options-text">Tangerine</span>
                    </div>
                </div>
                <div id="layout-options-buttons" class="control-panel-sub-options">
                    <div id="layout-options-speechbubbles" class="control-panel-options
                         control-panel-sub-option">
                        <span class="control-panel-options-text">Coming Soon!</span>
                    </div>
                </div>
                <div id="system-options-buttons" class="control-panel-sub-options">
                    <div id="system-options-logout" class="control-panel-options
                         control-panel-sub-option">
                        <span class="control-panel-options-text" ng-click="logout();">
                            Logout
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div id="input-toolbar">
            <div id="send-msg-button" class="user-icons" 
                ng-app="" ng-click="sendMsg($event,'click');">
            </div>
            <div id="send-msg-container">
                <input id="send-msg" type="text" maxlength="500"
                       ng-keypress="sendMsg($event);">
            </div>
        </div>
    </body>
</html>