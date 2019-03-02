<?php
/*
 * This file is part of wulacms.
 *
 * (c) Leo Ning <windywany@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace media\controllers;

use backend\classes\BackendController;
use backend\form\Plupload;
use wulaphp\app\App;

/**
 * Class InsController
 * @package media\controllers
 * @acl     m:media
 */
class InsController extends BackendController {
    use Plupload;

    public function index() {
        $max_upload = App::icfgn('max_upload@media', 20);
        $rst        = $this->upload(null, $max_upload * 1024 * 1000);
        if (isset($rst['error'])) {
            return ['done' => 0];
        }

        return $rst;
    }
}