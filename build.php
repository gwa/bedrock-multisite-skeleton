<?php
/**
 * A singleton class to run some build functions such as creating dummy tables and enable plugins on the fly.
 *
 * @author David Ogilo
 * @version 1.0
 */
class Build {

    private $db;
    private $tables;
    private $options;

    private static $_instance;

    private function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;

        $this->setArguments();
        $this->init();
    }

    /**
     * Initiates the build script process.
     */
    private function init()
    {
        if ( $this->getTables() )
        {
            //Suppress all errors from showing - errors related to foreign keys constraints on tables.
            $this->db->suppress_errors( true );

            $this->dropTables();

            $this->db->suppress_errors( false );
        }

        $this->install();

        if ( array_key_exists( 'plugins', $this->options ) && $this->options['plugins'] )
            $this->activatePlugins( $this->options['plugins'] );

        exit( 0 );
    }

    /**
     * Checks the arguments passed to the script and runs functions depending on the arguments passed.
     *
     * @return null
     */
    private function setArguments()
    {
        $longOptions = array( 'plugins::' );

        $this->options = getopt( '', $longOptions );

        return null;
    }

    /**
     * Drops dummy PHPUNIT tables;
     *
     * @return boolean
     */
    private function dropTables()
    {
        static $loop;
        $count = 0;

        if ( !$tables = $this->getTables() ) return false;

        if ( !isset( $loop ) )
            print '=== DELETING TABLES ===' . PHP_EOL . PHP_EOL;

        foreach( $tables as $index => $table )
        {
            $name = $table['Tables_in_' . DB_NAME];
            $type = $table['Table_type'];

            switch( $type )
            {
                case 'VIEW':
                    $sql = "DROP VIEW $name";
                    break;

                default:
                    $sql = "DROP TABLE $name";
                    break;
            }

            if ( !$this->db->query( $sql ) ) continue;

            unset( $this->tables[$index] );

            $count++;

            print $name . PHP_EOL;
        }

        if ( count( $tables ) > $count )
        {
            $loop = true;
            return $this->dropTables();
        }

        print PHP_EOL . 'Complete.' . PHP_EOL . PHP_EOL;

        return true;
    }

    /**
     * Returns an array of PHPUNIT tables
     *
     * @return array
     */
    private function getTables()
    {
        if ( empty( $this->tables ) )
        {
            $sql = "SHOW FULL TABLES IN " . DB_NAME . " WHERE Tables_in_" . DB_NAME . " LIKE '" . PHPUNIT_DB_PREFIX . "%'";
            $this->tables = $this->db->get_results( $sql, ARRAY_A );
        }

        return $this->tables;
    }

    /**
     * Installs WordPress
     *
     * @return boolean
     */
    private function install()
    {
        print '=== INSTALLING PHPUNIT WORDPRESS INSTANCE ===' . PHP_EOL . PHP_EOL;

        if ( is_array( wp_install( 'PHPUNIT', 'phpunit', 'phpunit@example.com', true, null, 'phpunit' ) ) )
            print 'Complete.' . PHP_EOL . PHP_EOL;
        else
        {
            print 'Failed.' . PHP_EOL . PHP_EOL;

            exit( 1 );
        }

        return true;
    }

    /**
     * Enables plugins on the fly. If plugins are already activated, then nothing happens.
     *
     * @param string $plugins - a ',' delimited string.
     * @return boolean
     */
    private function activatePlugins( $plugins )
    {
        $plugins = explode( ',', $plugins );

        print "=== ACTIVATING PLUGINS ===" . PHP_EOL . PHP_EOL;

        foreach( $plugins as &$plugin )
        {
            if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin ) && !is_file( WP_PLUGIN_DIR . '/' . $plugin ) )
                $plugin .= '/' . $plugin . '.php';

            print $plugin . PHP_EOL;
        }

        unset( $plugin );

        if ( activate_plugins( $plugins ) !== true )
        {
            print PHP_EOL . 'Failed.' . PHP_EOL . PHP_EOL;

            exit( 1 );
        }

        print PHP_EOL . 'Complete.' . PHP_EOL . PHP_EOL;

        return true;
    }


    /**
     * Returns the build instance
     *
     * @return Build
     */
    public static function getInstance()
    {
        if ( empty( self::$_instance ) )
            self::$_instance = new Build();

        return self::$_instance;
    }
}

( PHP_SAPI === 'cli' ) || die( 'Access Denied' );

//Initiaties the install process by bypassing redirect to install.php
define( 'WP_INSTALLING', true );

//Override default function to prevent sending an email on install
function wp_new_blog_notification( $blogTitle, $blogURL, $userID, $password ){}

require_once( 'bootstrap.php' );
require_once( ABSPATH . 'web/wp/wp-admin/includes/upgrade.php');

Build::getInstance();
?>