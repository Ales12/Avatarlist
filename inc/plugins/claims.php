<?php

// Disallow direct access to this file for security reasons
if (!defined("IN_MYBB")) {
    die("Direct initialization of this file is not allowed.");
}

// Miscseite
$plugins->add_hook('misc_start', 'claims_misc');

// Headerlink
$plugins->add_hook('global_start', 'claims_header');

//wer ist wo
$plugins->add_hook('fetch_wol_activity_end', 'claims_user_activity');
$plugins->add_hook('build_friendly_wol_location_end', 'claims_location_activity');

function claims_info()
{
    return array(
        "name" => "Avatarliste",
        "description" => "Eine Übersicht aller vergebenen Avatarpersonen",
        "website" => "",
        "author" => "Ales",
        "authorsite" => "",
        "version" => "1.0",
        "guid" => "",
        "codename" => "",
        "compatibility" => "18*"
    );
}

function claims_install()
{
    global $db, $mybb;

    $setting_group = array(
        'name' => 'claims',
        'title' => 'Einstellungen für die Avatarliste',
        'description' => 'Hier kannst du die Einstellungen für die Avatarliste vornehmen.',
        'disporder' => 5, // The order your setting group will display
        'isdefault' => 0
    );

    $gid = $db->insert_query("settinggroups", $setting_group);

    $setting_array = array(
        // A text setting
        'claims_avatar' => array(
            'title' => 'Profilfeld für Avatarperson',
            'description' => 'Wie lautet das Profilfeld für die Avatarperson?',
            'optionscode' => 'text',
            'value' => 'fid2', // Default
            'disporder' => 1
        ),
        // A select box
        'claims_gender' => array(
            'title' => 'Profilfeld für Avatarpersongeschlecht',
            'description' => 'Wie lautet das Profilfeld in welchen man das Geschlecht der Avatarperson angibt?',
            'optionscode' => 'text',
            'value' => 'fid3', // Default
            'disporder' => 2
        ),
        // A yes/no boolean box
        'claims_divers' => array(
            'title' => 'Auch divers anzeigen?',
            'description' => 'Soll in der Tabelle auch eine Spalte für Divers angezeigt werden?',
            'optionscode' => 'yesno',
            'value' => 1,
            'disporder' => 3
        ),
        // A yes/no boolean box
        'claims_username' => array(
            'title' => 'Usernamen in Gruppenfarben',
            'description' => 'Soll die Usernamen in Gruppenfarben dargestellt werden?',
            'optionscode' => 'yesno',
            'value' => 1,
            'disporder' => 4
        ),
    );

    foreach ($setting_array as $name => $setting) {
        $setting['name'] = $name;
        $setting['gid'] = $gid;

        $db->insert_query('settings', $setting);
    }



    $insert_array = array(
        'title' => 'claims',
        'template' => $db->escape_string('<html>
<head>
<title>{$mybb->settings[\'bbname\']} - {$lang->claims}</title>
{$headerinclude}
</head>
<body>
{$header}

<table border="0" cellspacing="{$theme[\'borderwidth\']}" cellpadding="{$theme[\'tablespace\']}" class="tborder">
<tr>
<td class="thead"><strong>{$lang->claims}</strong></td>
</tr>
<tr>
<td class="trow1">
	{$claims_overview}
</td>
</tr>
</table>
{$footer}
</body>
</html>'),
        'sid' => '-1',
        'version' => '',
        'dateline' => TIME_NOW
    );
    $db->insert_query("templates", $insert_array);
    
	$insert_array = array(
        'title' => 'claims_avatars',
        'template' => $db->escape_string('<div class="claims_avatar">{$avatarperson} - {$character}</div>'),
        'sid' => '-1',
        'version' => '',
        'dateline' => TIME_NOW
    );
    $db->insert_query("templates", $insert_array);
	    
	$insert_array = array(
        'title' => 'claims_nav',
        'template' => $db->escape_string('<li><a href="{$mybb->settings[\'bburl\']}/misc.php?action=claims" class="memberlist">{$lang->claims_nav}</a></li>'),
        'sid' => '-1',
        'version' => '',
        'dateline' => TIME_NOW
    );
    $db->insert_query("templates", $insert_array);
	    
	$insert_array = array(
        'title' => 'claims_overview',
        'template' => $db->escape_string('<div class="claims">
	<div class="claims_female"><strong>{$lang->claims_female}</strong></div>
  <div class="claims_male"><strong>{$lang->claims_male}</strong></div>
  <div class="claims_abcd"><strong>{$lang->claims_abcd}</strong></div>
  <div class="claims_f_abcd trow1">{$claims_f_abcd}</div>
  <div class="claims_m_abcd trow1">{$claims_m_abcd}</div>
  <div class="claims_efgh"><strong>{$lang->claims_efgh}</strong></div>
  <div class="claims_f_efgh trow1">{$claims_f_efgh}</div>
  <div class="claims_m_efgh trow1">{$claims_m_efgh}</div>
  <div class="claims_ijkl"><strong>{$lang->claims_ijkl}</strong></div>
  <div class="claims_f_ijkl trow1">{$claims_f_ijkl}</div>
  <div class="claims_m_ijkl trow1">{$claims_m_ijkl}</div>
  <div class="claims_mnop"><strong>{$lang->claims_mnop}</strong></div>
  <div class="claims_f_mnop trow1">{$claims_f_mnop}</div>
  <div class="claims_m_mnop trow1">{$claims_m_mnop}</div>
  <div class="claims_qrst"><strong>{$lang->claims_qrst}</strong></div>
  <div class="claims_f_qrst trow1">{$claims_f_qrst}</div>
  <div class="claims_m_qrst trow1">{$claims_m_qrst}</div>
  <div class="claims_uvwxyz"><strong>{$lang->claims_uvwxyz}</strong></div>
  <div class="claims_f_uvwxyz trow1">{$claims_f_uvwxyz}</div>
  <div class="claims_m_uvwxyz trow1">{$claims_m_uvwxyz}</div>
</div>'),
        'sid' => '-1',
        'version' => '',
        'dateline' => TIME_NOW
    );
    $db->insert_query("templates", $insert_array);
        
	$insert_array = array(
        'title' => 'claims_overview_divers',
        'template' => $db->escape_string('<div class="claims_d">
	<div class="claims_female"><strong>{$lang->claims_female}</strong></div>
  <div class="claims_male"><strong>{$lang->claims_male}</strong></div>
  <div class="claims_divers"><strong>{$lang->claims_divers}</strong></div>
  <div class="claims_abcd"><strong>{$lang->claims_abcd}</strong></div>
  <div class="claims_f_abcd trow1">{$claims_f_abcd}</div>
  <div class="claims_m_abcd trow1">{$claims_m_abcd}</div>
  <div class="claims_d_abcd trow1">{$claims_d_abcd}</div>
  <div class="claims_efgh"><strong>{$lang->claims_efgh}</strong></div>
  <div class="claims_f_efgh trow1">{$claims_f_efgh}</div>
  <div class="claims_m_efgh trow1">{$claims_m_efgh}</div>
  <div class="claims_d_efgh trow1">{$claims_d_efgh}</div>
  <div class="claims_ijkl"><strong>{$lang->claims_ijkl}</strong></div>
  <div class="claims_f_ijkl trow1">{$claims_f_ijkl}</div>
  <div class="claims_m_ijkl trow1">{$claims_m_ijkl}</div>
  <div class="claims_d_ijkl trow1">{$claims_d_ijkl}</div>
  <div class="claims_mnop"><strong>{$lang->claims_mnop}</strong></div>
  <div class="claims_f_mnop trow1">{$claims_f_mnop}</div>
  <div class="claims_m_mnop trow1">{$claims_m_mnop}</div>
  <div class="claims_d_mnop trow1">{$claims_d_mnop}</div>
  <div class="claims_qrst"><strong>{$lang->claims_qrst}</strong></div>
  <div class="claims_f_qrst trow1">{$claims_f_qrst}</div>
  <div class="claims_m_qrst trow1">{$claims_m_qrst}</div>
  <div class="claims_d_qrst trow1">{$claims_d_qrst}</div>
  <div class="claims_uvwxyz"><strong>{$lang->claims_uvwxyz}</strong></div>
  <div class="claims_f_uvwxyz trow1">{$claims_f_uvwxyz}</div>
  <div class="claims_m_uvwxyz trow1">{$claims_m_uvwxyz}</div>
  <div class="claims_d_uvwxyz trow1">{$claims_d_uvwxyz}</div>
</div>'),
        'sid' => '-1',
        'version' => '',
        'dateline' => TIME_NOW
    );
    $db->insert_query("templates", $insert_array);
	
     //CSS einfügen
     $css = array(
        'name' => 'claims.css',
        'tid' => 1,
        'attachedto' => '',
        "stylesheet" => '.claims_d {  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  grid-template-rows: min-content min-content max-content min-content max-content min-content max-content min-content max-content min-content max-content min-content max-content;
  gap: 2px 2px;
  grid-auto-flow: row;
  grid-template-areas:
    "claims_female claims_male claims_divers"
    "claims_abcd claims_abcd claims_abcd"
    "claims_f_abcd claims_m_abcd claims_d_abcd"
    "claims_efgh claims_efgh claims_efgh"
    "claims_f_efgh claims_m_efgh claims_d_efgh"
    "claims_ijkl claims_ijkl claims_ijkl"
    "claims_f_ijkl claims_m_ijkl claims_d_ijkl"
    "claims_mnop claims_mnop claims_mnop"
    "claims_f_mnop claims_m_mnop claims_d_mnop"
    "claims_qrst claims_qrst claims_qrst"
    "claims_f_qrst claims_m_qrst claims_d_qrst"
    "claims_uvwxyz claims_uvwxyz claims_uvwxyz"
    "claims_f_uvwxyz claims_m_uvwxyz claims_d_uvwxyz";
}

.claims {
  display: grid; 
  grid-template-columns: 1fr 1fr; 
  grid-template-rows: min-content min-content 1fr min-content 1fr min-content 1fr min-content 1fr min-content 1fr min-content 1fr; 
  gap: 2px 2px; 
  grid-template-areas: 
    "claims_female claims_male"
    "claims_abcd claims_abcd"
    "claims_f_abcd claims_m_abcd"
    "claims_efgh claims_efgh"
    "claims_f_efgh claims_m_efgh"
    "claims_ijkl claims_ijkl"
    "claims_f_ijkl claims_m_ijkl"
    "claims_mnop claims_mnop"
    "claims_f_mnop claims_m_mnop"
    "claims_qrst claims_qrst"
    "claims_f_qrst claims_m_qrst"
    "claims_uvwxyz claims_uvwxyz"
    "claims_f_uvwxyz claims_m_uvwxyz"; 
}

.claims_female { grid-area: claims_female;
background: #0f0f0f url(../../../images/tcat.png) repeat-x;
  color: #fff;
  border-top: 1px solid #444;
  border-bottom: 1px solid #000;
  padding: 7px;
text-align: center;
}

.claims_male { grid-area: claims_male; 
background: #0f0f0f url(../../../images/tcat.png) repeat-x;
  color: #fff;
  border-top: 1px solid #444;
  border-bottom: 1px solid #000;
  padding: 7px;
text-align: center;
}

.claims_divers { grid-area: claims_divers;
background: #0f0f0f url(../../../images/tcat.png) repeat-x;
  color: #fff;
  border-top: 1px solid #444;
  border-bottom: 1px solid #000;
  padding: 7px;
text-align: center;
}

.claims_abcd { grid-area: claims_abcd; 
	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;
}

.claims_f_abcd { grid-area: claims_f_abcd; 
padding: 5px;
}

.claims_m_abcd { grid-area: claims_m_abcd; 
padding: 5px;
}

.claims_d_abcd { grid-area: claims_d_abcd; 
padding: 5px;
}

.claims_efgh { grid-area: claims_efgh; 	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;}

.claims_f_efgh { grid-area: claims_f_efgh;
padding: 5px;
 }

.claims_m_efgh { grid-area: claims_m_efgh; 
padding: 5px;
}

.claims_d_efgh { grid-area: claims_d_efgh;
padding: 5px;
 }

.claims_ijkl { grid-area: claims_ijkl; 	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;}

.claims_f_ijkl { grid-area: claims_f_ijkl; 
padding: 5px;
}

.claims_m_ijkl { grid-area: claims_m_ijkl; 
padding: 5px;
}

.claims_d_ijkl { grid-area: claims_d_ijkl; 
padding: 5px;
}

.claims_mnop { grid-area: claims_mnop; 	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;}

.claims_f_mnop { grid-area: claims_f_mnop; 
padding: 5px;
}

.claims_m_mnop { grid-area: claims_m_mnop; 
padding: 5px;
}

.claims_d_mnop { grid-area: claims_d_mnop; 
padding: 5px;
}

.claims_qrst { grid-area: claims_qrst; 	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;}

.claims_f_qrst { grid-area: claims_f_qrst; 
padding: 5px;
}

.claims_m_qrst { grid-area: claims_m_qrst; 
padding: 5px;
}

.claims_d_qrst { grid-area: claims_d_qrst; 
padding: 5px;
}

.claims_uvwxyz { grid-area: claims_uvwxyz;	background: #ddd;
	color: #333;
	border-bottom: 1px solid #c5c5c5;
	padding: 6px;
	font-size: 12px;
	font-weight: bold;
	text-align: center; }

.claims_f_uvwxyz { grid-area: claims_f_uvwxyz; 
padding: 5px;
}

.claims_m_uvwxyz { grid-area: claims_m_uvwxyz; 
padding: 5px;
}

.claims_d_uvwxyz { grid-area: claims_d_uvwxyz; 
padding: 5px;
}


.claims_avatar{
	padding: 2px 2px 2px 10px;	
}

.claims_avatar::before{
	content:  "»";
	padding-right: 2px;
}
        ',
        'cachefile' => $db->escape_string(str_replace('/', '', 'claims.css')),
        'lastmodified' => time()
    );

    require_once MYBB_ADMIN_DIR . "inc/functions_themes.php";

    $sid = $db->insert_query("themestylesheets", $css);
    $db->update_query("themestylesheets", array("cachefile" => "css.php?stylesheet=" . $sid), "sid = '" . $sid . "'", 1);

    $tids = $db->simple_select("themes", "tid");
    while ($theme = $db->fetch_array($tids)) {
        update_theme_stylesheet_list($theme['tid']);
    }

	    // Don't forget this!
    rebuild_settings();
}

function claims_is_installed()
{

    global $mybb;
    if (isset($mybb->settings['claims_avatar'])) {
        return true;
    }

    return false;

}

function claims_uninstall()
{
    global $db;

    $db->delete_query('settings', "name IN ('claims_avatar','claims_gender','claims_divers', 'claims_username')");
    $db->delete_query('settinggroups', "name = 'claims'");

    $db->delete_query("templates", "title LIKE '%claims%'");

    require_once MYBB_ADMIN_DIR . "inc/functions_themes.php";
    $db->delete_query("themestylesheets", "name = 'claims.css'");
    $query = $db->simple_select("themes", "tid");
    while ($theme = $db->fetch_array($query)) {
        update_theme_stylesheet_list($theme['tid']);
    }

    // Don't forget this
    rebuild_settings();

}

function claims_activate()
{
    require MYBB_ROOT . "/inc/adminfunctions_templates.php";

    find_replace_templatesets("header", "#" . preg_quote('{$menu_portal}') . "#i", '{$claims_nav} {$menu_portal}');
}

function claims_deactivate()
{
    find_replace_templatesets("header", "#" . preg_quote('{$claims_nav}') . "#i", '', 0);
}




// In the body of your plugin
function claims_misc()
{
    global $mybb, $templates, $lang, $header, $headerinclude, $footer, $lang, $db;
    $lang->load("claims");

    $avatar = $mybb->settings['claims_avatar'];
    $get_gender = $mybb->settings['claims_gender'];
    $divers = $mybb->settings['claims_divers'];
    $display_username = $mybb->settings['claims_username'];

    if ($mybb->get_input('action') == 'claims') {
        // Do something, for example I'll create a page using the hello_world_template

        // Add a breadcrumb
        add_breadcrumb($lang->claims, "misc.php?action=claims");

        $get_avatars = $db->query("SELECT *
        FROM " . TABLE_PREFIX . "users u
        LEFT JOIN " . TABLE_PREFIX . "userfields uf
        on (u.uid = uf.ufid)
        where {$avatar} != ''
        and {$get_gender} != ''
        order by {$avatar} ASC
        ");

        while ($avatars = $db->fetch_array($get_avatars)) {
            $avatarperson = "";
            $character = "";

            $avatarperson = $avatars[$avatar];
            $gender = $avatars[$get_gender];

            // Usernamendarstellung
            if ($display_username == 1) {
                $username = format_name($avatars['username'], $avatars['usergroup'], $avatars['displaygroup']);
                $character = build_profile_link($username, $avatars['uid']);
            } else {
                $character = build_profile_link($avatars['username'], $avatars['uid']);
            }


            // abcd
            if (preg_match("/^(A|a|B|b|C|c|D|d)/", $avatarperson) && ($gender == 'weiblich' || $gender == 'female')) {
                eval ("\$claims_f_abcd .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(A|a|B|b|C|c|D|d)/", $avatarperson) && ($gender == 'männlich' || $gender == 'male')) {
                eval ("\$claims_m_abcd .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(A|a|B|b|C|c|D|d)/", $avatarperson) && $gender == 'divers') {
                eval ("\$claims_d_abcd .= \"" . $templates->get("claims_avatars") . "\";");
            } // efgh
            elseif (preg_match("/^(E|e|F|f|G|g|H|h)/", $avatarperson) && ($gender == 'weiblich' || $gender == 'female')) {
                eval ("\$claims_f_efgh .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(E|e|F|f|G|g|H|h)/", $avatarperson) && ($gender == 'männlich' || $gender == 'male')) {
                eval ("\$claims_m_efgh .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(E|e|F|f|G|g|H|h)/", $avatarperson) && $gender == 'divers') {
                eval ("\$claims_d_efgh .= \"" . $templates->get("claims_avatars") . "\";");
            } // ijkl
            elseif (preg_match("/^(I|i|J|j|K|k|L|l)/", $avatarperson) && ($gender == 'weiblich' || $gender == 'female')) {
                eval ("\$claims_f_ijkl .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(I|i|J|j|K|k|L|l)/", $avatarperson) && ($gender == 'männlich' || $gender == 'male')) {
                eval ("\$claims_m_ijkl .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(I|i|J|j|K|k|L|l)/", $avatarperson) && $gender == 'divers') {
                eval ("\$claims_d_ijkl .= \"" . $templates->get("claims_avatars") . "\";");
            } // mnop
            elseif (preg_match("/^(M|m|N|n|O|o|P|p)/", $avatarperson) && ($gender == 'weiblich' || $gender == 'female')) {
                eval ("\$claims_f_mnop .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(M|m|N|n|O|o|P|p)/", $avatarperson) && ($gender == 'männlich' || $gender == 'male')) {
                eval ("\$claims_m_mnop .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(M|m|N|n|O|o|P|p)/", $avatarperson) && $gender == 'divers') {
                eval ("\$claims_d_mnop .= \"" . $templates->get("claims_avatars") . "\";");
            }// qrst
            elseif (preg_match("/^(Q|q|R|r|S|s|T|t)/", $avatarperson) && ($gender == 'weiblich' || $gender == 'female')) {
                eval ("\$claims_f_qrst .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(Q|q|R|r|S|s|T|t)/", $avatarperson) && ($gender == 'männlich' || $gender == 'male')) {

                eval ("\$claims_m_qrst .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(Q|q|R|r|S|s|T|t)/", $avatarperson) && $gender == 'divers') {
                eval ("\$claims_d_qrst .= \"" . $templates->get("claims_avatars") . "\";");
            } // uvwxyz
            elseif (preg_match("/^(U|u|V|v|W|w|X|x|Y|y|Z|z)/", $avatarperson) && ($gender == 'weiblich' || $gender == 'female')) {
                eval ("\$claims_f_uvwxyz .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(U|u|V|v|W|w|X|x|Y|y|Z|z)/", $avatarperson) && ($gender == 'männlich' || $gender == 'male')) {
                eval ("\$claims_m_uvwxyz .= \"" . $templates->get("claims_avatars") . "\";");
            } elseif (preg_match("/^(U|u|V|v|W|w|X|x|Y|y|Z|z)/", $avatarperson) && $gender == 'divers') {
                eval ("\$claims_d_uvwxyz .= \"" . $templates->get("claims_avatars") . "\";");
            }


        }

        // Ob Divers oder nicht
        if ($divers == 1) {
            eval ("\$claims_overview = \"" . $templates->get("claims_overview_divers") . "\";");
        } else {
            eval ("\$claims_overview = \"" . $templates->get("claims_overview") . "\";");

        }

        // Using the misc_help template for the page wrapper
        eval ("\$page = \"" . $templates->get("claims") . "\";");
        output_page($page);
    }
}

function claims_header()
{
    global $mybb, $db, $templates, $lang, $claims_nav;
    $lang->load('claims');

    eval ("\$claims_nav = \"" . $templates->get("claims_nav") . "\";");

}
function claims_user_activity($user_activity)
{
    global $user;
    if (my_strpos($user['location'], "misc.php?action=claims") !== false) {
        $user_activity['activity'] = "claims";
    }

    return $user_activity;
}

function claims_location_activity($plugin_array)
{
    global $db, $mybb, $lang;
    $lang->load('claims');
    if ($plugin_array['user_activity']['activity'] == "claims") {
        $plugin_array['location_name'] = $lang->claims_wiw;
    }
    return $plugin_array;
}