<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="This site provides you with the latest changes from the CarbonROM Gerrit.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Changelog - CarbonROM</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="96x96" href="../assets/images/android-chrome-96x96.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="CarbonROM Changelog">
    <link rel="apple-touch-icon-precomposed" href="../assets/images/apple-touch-icon.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="../assets/images/mstile-150x150.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="../assets/favicon/favicon-32x32.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../assets/css/material.teal-red.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
      <header class="demo-header mdl-layout__header mdl-layout__header--scroll mdl-color--grey-100 mdl-color-text--grey-800">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">CarbonROM</span>
        </div>
      </header>
      <div class="demo-ribbon"></div>
      <main class="demo-main mdl-layout__content">
        <div class="demo-container mdl-grid">
          <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
            <div class="demo-crumbs mdl-color-text--grey-500">
              CarbonROM &gt; Daily Changelog
            </div>
  <?php
// Set default branch
$branch = "cr-7.0";
$opposite_branch = "cr-6.1";

if (isset($_COOKIE['cr_changelog_branch'])) {
    $branch = $_COOKIE["cr_changelog_branch"];
    if ($branch == "cr-6.1") {
        $opposite_branch = "cr-7.0";
    }
}

// Get JSON Data
$jsonraw = file_get_contents("https://review.carbonrom.org/changes/?q=status:merged+branch:" + $branch);
$json = json_decode(preg_replace('/^.+\n/', '', $jsonraw));

// Set date
$date = 0;

// Info for users
echo "<h3>CarbonROM Changelog</h3>";
echo "<h5>*Changes do not indicate successful weekly compilation*</h5>";

foreach ($json as $item) {
    // Get date of change from JSON
    $changeDate = substr($item->updated, 0, -18);

    // Create date header to make reading easier if one doesn't exist
    if ($date != $changeDate) {
        echo "<p><b>--- Changed on $changeDate ---</b></p>";
        $date = $changeDate;
    }

    // Show the change
    echo '<p>' . substr($item->project,10) . ': <a href="https://review.carbonrom.org/#/c/' . $item->_number . 
'">' . 
$item->subject . '</a>';
}
?>

          </div>
        </div>
        <footer class="demo-footer mdl-mini-footer">
          <div class="mdl-mini-footer--left-section">
            <ul class="mdl-mini-footer--link-list">
              <li><a href="mailto:support@carbonrom.org">Help</a></li>
              <li><a href="https://legal.carbonrom.org/privacy">Privacy and Terms</a></li>
              <li><a href="https://legal.carbonrom.org/agreements">User Agreement</a></li>
            </ul>
          </div>
        </footer>
      </main>
    </div>
    <a href="<?php setcookie("cr_changelog_branch", $opposite_branch); header("Refresh:0"); ?>" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">Show <?php echo $opposite_branch ?> Changelog</a>
    <a href="https://review.carbonrom.org/" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">Visit Gerrit</a>
    <script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
  </body>
</html>
