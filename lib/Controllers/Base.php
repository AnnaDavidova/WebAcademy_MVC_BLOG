<?php

namespace Controller;

use Framework\App;
use Utils\Context;

class Base
{
    protected $app;

    /**
     * Create object
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     *  void renderJson( $json )   - print JSON string
     *      @param      array       $data   - json structure
     *      @param      string      $type   - content-type header (default 'application/json')
     *      @return     void
     */
    public function renderJson($data, $type = 'application/json')
    {
        header('Content-Type:' . $type);
        echo json_encode($data);
        $this->app->stop();
    }

    public function renderFile($data = [])
    {
        $file = __DIR__.'/../../storage/files/'.$data['File'];
        $size = filesize($file);
        header("Content-Description: File Transfer");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename={$data['Filename']}");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: public");
        header("Cache-Control: must-revalidate");
        header("Content-Length: {$size}");

        ob_clean();
        flush();
        readfile($file);
        $content = ob_get_clean();
        echo $content;
        $this->app->stop();
    }

    public function config()
    {
        return $this->app->config;
    }

    public function getUserId()
    {
        return isset($_SESSION['UserId']) ? $_SESSION['UserId'] : null;
    }
}
