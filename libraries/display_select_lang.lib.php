<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Code for displaying language selection
 *
 * @package PhpMyAdmin
 */
if (! defined('PHPMYADMIN')) {
    exit;
}

/**
 * Sorts available languages by their true english names
 *
 * @param array &$a the array to be sorted
 * @param mixed &$b a required parameter
 *
 * @return the sorted array
 * @access  private
 */
function PMA_Language_cmp(&$a, &$b)
{
    return (strcmp($a[1], $b[1]));
} // end of the 'PMA_Language_cmp()' function

/**
 * Displays for for language selection
 *
 * @param boolean $use_fieldset whether to use fieldset for selection
 * @param boolean $show_doc     whether to show documentation links
 *
 * @return void
 *
 * @access  public
 */
function PMA_Language_select($use_fieldset = false, $show_doc = true)
{
    if (count($GLOBALS['available_languages']) == 1) {
        // no use in switching languages, there is only one available
        return;
    }

    global $cfg, $lang;

    echo '<form method="post" action="index.php" target="_parent">';

    $_form_params = array(
        'db' => $GLOBALS['db'],
        'table' => $GLOBALS['table'],
    );
    echo PMA_generate_common_hidden_inputs($_form_params);

    // For non-English, display "Language" with emphasis because it's
    // not a proper word in the current language; we show it to help
    // people recognize the dialog
    $language_title = __('Language')
        . (__('Language') != 'Language' ? ' - <em>Language</em>' : '');
    if ($show_doc) {
        $language_title .= PMA_Util::showDocu('faq7_2');
    }
    if ($use_fieldset) {
        echo '<fieldset><legend lang="en" dir="ltr">'
            . $language_title . '</legend>';
    } else {
        echo '<bdo lang="en" dir="ltr"><label for="sel-lang">'
            . $language_title . ':</label></bdo>';
    }

    echo '<select name="lang" class="autosubmit" lang="en" dir="ltr" id="sel-lang">';

    uasort($GLOBALS['available_languages'], 'PMA_Language_cmp');
    foreach ($GLOBALS['available_languages'] as $id => $tmplang) {
        $lang_name = PMA_langName($tmplang);

        //Is current one active?
        if ($lang == $id) {
            $selected = ' selected="selected"';
        } else {
            $selected = '';
        }

        echo '        ';
        echo '<option value="' . $id . '"' . $selected . '>' . $lang_name
            . '</option>' . "\n";
    }

    echo '</select>';

    if ($use_fieldset) {
        echo '</fieldset>';
    }

    echo '</form>';

} // End of function PMA_Language_select
?>
