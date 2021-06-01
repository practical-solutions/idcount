<?php
/**
 * Idcount Plugin 
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author: Gero Gothe <gero.gothe@medizindoku.de>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();
define('DEBUG',false);

/**
 * Class action_plugin_searchform
 */
class action_plugin_idcount extends DokuWiki_Action_Plugin {

    # Registers a callback function for a given event
    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook('AJAX_CALL_UNKNOWN', 'BEFORE', $this,'_ajax_call');
    }


    public function _generate_ID(){
        if (file_exists(DOKU_INC.'data/meta/idcount.txt')) {
            $n = intval(file_get_contents(DOKU_INC.'data/meta/idcount.txt'));
            $n++;
        } else $n = 1;
        file_put_contents(DOKU_INC.'data/meta/idcount.txt',$n);
        $d = intval($this->getConf('digits'));
        return sprintf('%0'.$d.'d', $n);
    }


    public function _ajax_call(Doku_Event $event, $param) {

        if ($event->data !== 'idcount_generate') {
            return;
        }

        # No other ajax call handlers needed
        $event->stopPropagation();
        $event->preventDefault();
        
        echo $this->getConf('prefix').$this->_generate_ID();

    }
    
}

// vim:ts=4:sw=4:et:
