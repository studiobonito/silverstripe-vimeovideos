<?php

ShortcodeParser::get()->register('Vimeo', array('VimeoVideo','VimeoShortCodeHandler'));

HtmlEditorConfig::get('cms')->enablePlugins(array('vmsc' => '../../../vimeovideos/javascript/editor_plugin.js'));
HtmlEditorConfig::get('cms')->insertButtonsAfter('anchor', 'vmsc');