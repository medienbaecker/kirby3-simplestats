<?php

namespace daandelange\SimpleStats;

// README :
// - RGPD stuff : you remain responsible. Depending on how you configure SimpleStats, behaviour changes and so do you obligations. Know what you are doing.
// - Logs : Be aware that some user data can get logged. Better turn logging off in production, or be sure to read and erase them.
// - Maybe : Add .htaccess rules for .sqlite and .log/.txt files, prevent direct access.
// - With simplestats as analytics engine, you are hosting sensitive user data. Read getkirby.com/guides/secure for optimal privacy recomendations.

return [
    'log' => [
        'tracking'  => true, // Enable tracking errors.
        'warnings'  => true, // Functional warnings. Mostly db related.
        'verbose'   => true, // For testing / dev, logs almost anything else.
        'file'      => kirby()->root('config') . '/../logs/simplestats_errors.txt',
    ],

    // Tracking options
    'tracking' => [
        'database'      => kirby()->root('config') . '/../logs/simplestats.sqlite',
        // Respect DNT
        // pagecountermode : hits, uniquehitsUA, uniquehitsSession (not yet)
        //'trackUniqueHitsOnly'   => true, // set to false for hitcounter behaviour
        'enableReferers'   => true, // Enables tracking of referers. Gives an insigt of who links your website.
        'enableDevices'    => true, // Enables tracking of minimal hardware configurations (device information)
        'enableVisits'     => true, // Enables tracking of page visits
        'salt'             => 'CHANGEME', // Salt used to obfuscate unique user string.
        'uniqueSeconds'    => 1*24*60*60, // Anonimised user data is deleted after this delay, don't touch for now.
        // Dont change onLoad yet !!! (keep to true)
        'onLoad'   => true, // Tracks when the page is served by the router (increases load time). If false, you need to add an image to all trackable templates (not yet available), you'll get better load performance, and "naturaly" exclude most bots.
        // Set to false to track from an image, which can naturally prevent calls from most robots, and speed up page loads. (recommended: set to false)
            // Track hits on page serve or using an image ?
            // Delete by crontask or afterLoad ?

        // Tracking blacklist
        'ignore' => [
            'roles' => kirby()->roles()->toArray( function($v){return $v->id();} ), // By default, don't track connected users.
            'pages' => [], // Array of plain text page uris.
        ],
    ],

    // Enable/Disable the admin panel and API
    'panel' => [
        'enable'            => true, // Only disables the API (for now...) makes the panel unusable.
        'authorizedRoles'   => ['admin'], // Role (ids) that are allowed to view page statistics
    ]

    // Todo: Add refferer tracking via pingback ? Webmentions ?

    // (Settings ideas from k2-stats)
    // stats.days - Keep daily stats for how many days ?
    // stats.date.format

];
