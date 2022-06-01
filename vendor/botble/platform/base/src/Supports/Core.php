<?php

namespace Botble\Base\Supports;

use BaseHelper;
use Botble\Base\Supports\PclZip as Zip;
use Botble\Theme\Services\ThemeService;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Menu;
use Theme;
use ZipArchive;

class Core
{

    /**
     * @var string
     */
    protected $productId;

    /**
     * @var string
     */
    protected $apiUrl;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $verifyType;

    /**
     * @var int
     */
    protected $verificationPeriod;

    /**
     * @var string
     */
    protected $currentVersion;

    /**
     * @var string
     */
    protected $rootPath;

    /**
     * @var string
     */
    protected $licenseFile;

    /**
     * @var bool
     */
    protected $showUpdateProcess = true;

    /**
     * @var string
     */
    protected $sessionKey = '44622179e10cab6';

    /**
     * Core constructor.
     */
   

    /**
     * @return string
     */


    /**
     * @return string
     */
  

    /**
     * @return array
     */

    /**
     * @param string $url
     * @param string $data
     * @return array
     */
    

    /**
     * @return array
     */
 

    /**
     * @param string $license
     * @param string $client
     * @param bool $createLicense
     * @return array
     */
    

    /**
     * @param bool $timeBasedCheck
     * @param bool $license
     * @param bool $client
     * @return array
     */


    /**
     * @return bool
     */

    /**
     * @param bool $license
     * @param bool $client
     * @return array
     */
  

    /**
     * @return array
     */


    /**
     * @param string $updateId
     * @param string $version
     * @param bool $license
     * @param bool $client
     */







   

    /**
     * @param string $url
     * @return string
     */
    protected function getRemoteFileSize($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_NOBODY, true);

        $thisServerSame = request()->server('SERVER_NAME') ?: request()->server('HTTP_HOST');

        $thisHttpOrHttps = request()->server('HTTPS') == 'on' || request()->server('HTTP_X_FORWARDED_PROTO') == 'https'
            ? 'https://' : 'http://';

        $thisUrl = $thisHttpOrHttps . $thisServerSame . request()->server('REQUEST_URI');
        $thisIp = request()->server('SERVER_ADDR') ?: Helper::getIpFromThirdParty() ?: gethostbyname(gethostname());

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'LB-API-KEY: ' . $this->apiKey,
                'LB-URL: ' . $thisUrl,
                'LB-IP: ' . $thisIp,
                'LB-LANG: ' . 'english',
            ]
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_exec($curl);

        $filesize = curl_getinfo($curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

        if ($filesize) {
            return BaseHelper::humanFilesize($filesize);
        }

        return -1;
    }

    protected function progress($resource, $downloadSize, $downloaded)
    {
        static $prev = 0;
        if ($downloadSize == 0) {
            $progress = 0;
        } else {
            $progress = round($downloaded * 100 / $downloadSize);
        }

        if (($progress != $prev) && ($progress == 25)) {
            $prev = $progress;
            echo '<script>document.getElementById(\'prog\').value = 22.5;</script>';
            ob_flush();
        }

        if (($progress != $prev) && ($progress == 50)) {
            $prev = $progress;
            echo '<script>document.getElementById(\'prog\').value = 35;</script>';
            ob_flush();
        }

        if (($progress != $prev) && ($progress == 75)) {
            $prev = $progress;
            echo '<script>document.getElementById(\'prog\').value = 47.5;</script>';
            ob_flush();
        }

        if (($progress != $prev) && ($progress == 100)) {
            $prev = $progress;
            echo '<script>document.getElementById(\'prog\').value = 60;</script>';
            ob_flush();
        }
    }
}