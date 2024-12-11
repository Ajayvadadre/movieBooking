<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\BaseHandler;
use CodeIgniter\Session\Handlers\FileHandler;

class Session extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Session Driver
     * --------------------------------------------------------------------------
     *
     * The session storage driver to use:
     * - `CodeIgniter\Session\Handlers\FileHandler`
     * - `CodeIgniter\Session\Handlers\DatabaseHandler`
     * - `CodeIgniter\Session\Handlers\MemcachedHandler`
     * - `CodeIgniter\Session\Handlers\RedisHandler`
     *
     * @var class-string<BaseHandler>
     */
    public string $driver = FileHandler::class;

    /**
     * --------------------------------------------------------------------------
     * Session Cookie Name
     * --------------------------------------------------------------------------
     *
     * The session cookie name, must contain only [0-9a-z_-] characters
     */
    public string $cookieName = 'ci_session';

    /**
     * --------------------------------------------------------------------------
     * Session Expiration
     * --------------------------------------------------------------------------
     *
     * The number of SECONDS you want the session to last.
     * Setting to 0 (zero) means expire when the browser is closed.
     */
    public int $expiration = 7200;
    public $session = [
        'driver' => 'redis',
        'redis' => [
            'host'     => '127.0.0.1',
            'password' => null,
            'port'     => 6379,
            'timeout'  => 0,
            'database' => 0,
        ],
    ];
    /**
     * --------------------------------------------------------------------------
     * Session Save Path
     * --------------------------------------------------------------------------
     *
     * The location to save sessions to and is driver dependent.
     *
     * For the 'files' driver, it's a path to a writable directory.
     * WARNING: Only absolute paths are supported!
     *
     * For the 'database' driver, it's a table name.
     * Please read up the manual for the format with other session drivers.
     *
     * IMPORTANT: You are REQUIRED to set a valid save path!
     */
    public string $savePath = WRITEPATH . 'session';

    /**
     * --------------------------------------------------------------------------
     * Session Match IP
     * --------------------------------------------------------------------------
     *
     * Whether to match the user's IP address when reading the session data.
     *
     * WARNING: If you're using the database driver, don't forget to update
     *          your session table's PRIMARY KEY when changing this setting.
     */
    public bool $matchIP = false;

    /**
     * --------------------------------------------------------------------------
     * Session Time to Update
     * --------------------------------------------------------------------------
     *
     * How many seconds between CI regenerating the session ID.
     */
    public int $timeToUpdate = 300;

    /**
     * --------------------------------------------------------------------------
     * Session Regenerate Destroy
     * --------------------------------------------------------------------------
     *
     * Whether to destroy session data associated with the old session ID
     * when auto-regenerating the session ID. When set to FALSE, the data
     * will be later deleted by the garbage collector.
     */
    public bool $regenerateDestroy = false;

    /**
     * --------------------------------------------------------------------------
     * Session Database Group
     * --------------------------------------------------------------------------
     *
     * DB Group for the database session.
     */
    public ?string $DBGroup = null;

    /**
     * --------------------------------------------------------------------------
     * Lock Retry Interval (microseconds)
     * --------------------------------------------------------------------------
     *
     * This is used for RedisHandler.
     *
     * Time (microseconds) to wait if lock cannot be acquired.
     * The default is 100,000 microseconds (= 0.1 seconds).
     */
    public int $lockRetryInterval = 100_000;

    /**
     * --------------------------------------------------------------------------
     * Lock Max Retries
     * --------------------------------------------------------------------------
     *
     * This is used for RedisHandler.
     *
     * Maximum number of lock acquisition attempts.
     * The default is 300 times. That is lock timeout is about 30 (0.1 * 300)
     * seconds.
     */
    public int $lockMaxRetries = 300;







    // public $driver = 'Redis';

    public $lifetime = 7200;

    // public $cookieName = 'ci_session';

    public $cookieDomain = '';

    public $cookiePath = '/';

    public $cookieSecure = false;

    public $sidRegex = '[0-9a-v]{32}';

    // public $matchIP = false;

    // public $savePath = '/tmp';

    public $handler = 'CodeIgniter\Session\Handlers\FileHandler';

    public $redisConfig = [
        'host'     => '127.0.0.1',
        'password' => null,
        'port'     => 6379,
        'timeout'  => 0.0,
        'database' => 0,
    ];

    public $gcProbability = 5;

    public $gcDivisor = 100;

    public $cookieSameSite = 'Lax';

    public $cookieSamesiteNoneSecure = false;

    public $useCookies = true;

    public $timeRegular = 300;

    public $timeLong = 3600;

    public $timeOnline = 1200;

    public $timeOffline = 1800;

    public $timeExpired = 31536000;

    public $timeLastModified = 31536000;

    public $timeLastModifiedThreshold = 60;

    public $timeNow = 7200;

    public $tokenRandomBytes = 16;

    public $tokenLength = 32;

    public $tokenLengthBase32Variant = 'RFC4648';

    public $tokenLengthBase64Variant = 'MIME';

    public $tokenAlphabet = '2345679ACDEFGHJKLMNPQRTUVWXYZ';

    public $tokenAlphabetCaseSensitive = false;

    public $tokenAlphabetNumeric = '0123456789';

    public $tokenAlphabetLowercase = 'abcdefghijklmnopqrstuvwxyz';

    public $tokenAlphabetUppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public $tokenAlphabetSpecial = '!@#$%^&*()-_[]{}';

    public $tokenAlphabetWhitespace = ' \t\n\r\0\x0B';

    public $tokenAlphabetPunctuation = '!"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~';

    public $tokenAlphabetHex = '0123456789abcdef';

    public $tokenAlphabetBase32 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

    public $tokenAlphabetBase32Hex = '0123456789ABCDEFGHIJKLMNOPQRSTUV';

    public $tokenAlphabetBase64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';

    public $tokenAlphabetBase64Url = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
}
