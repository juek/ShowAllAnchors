<?php
/**
 * PHP class for Typesetter CMS plugin 'Show All Achors'
 *
 * @package     ShowAllAnchors
 * @author      J. Krausz (http://typesetter-addons.grafikrausz.at)
 * @version     1.1
 */

defined('is_running') or die('Not an entry point...');

class ShowAllAnchors {

  /**
   * Typesetter filter hook
   */
  static function PageRunScript($cmd) {
    global $page, $dirPrefix;

    if( \gp\tool::LoggedIn() ){
      $ckeditor_basepath = (version_compare(\gpversion, '5.1') > 0) ?
        \gp\tool::GetDir('/include/thirdparty/ckeditor') :
        \gp\tool::GetDir('/include/thirdparty/ckeditor_34');

      $page->admin_links[] = array( 
        'ShowAllAnchors',
        '<i class="fa fa-flag"></i>',
        '',
        'title="Show All Achors" class="saa-toggle-btn"'
      );

      $page->head .= '
      <style>
        body.showAllAnchors .GPAREA a[id],
        body.showAllAnchors .GPAREA a[name] {
          background: url(' . $dirPrefix . $ckeditor_basepath . '/plugins/link/images/anchor.png) no-repeat left bottom;
          border: 1px dotted #00f;
          background-size: 16px;
          padding-left: 18px;
        } 
        body.showAllAnchors .saa-toggle-btn { background: #236fe0 !important; }
      </style>
      ';

      $page->jQueryCode .= '
        $(".saa-toggle-btn")
          .off("click")
          .on("click", function(e){
            $("body").toggleClass("showAllAnchors");
            e.preventDefault();
          });
        ';
    }
    return $cmd;
  }

}
