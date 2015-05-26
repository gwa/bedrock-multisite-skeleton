<?php
namespace Gwa\Wordpress\WpQuery;

/**
 * A modern WordPress stack.
 *
 * @author      Daniel Bannert <bannert@greatwhiteark.com>
 * @copyright   2015 Great White Ark
 *
 * @link        http://www.greatwhiteark.com
 *
 * @license     MIT
 */

/**
 * MultisiteQuery.
 *
 * To modify what sites are queried,
 * create a sites key in the $args in the constructor parameter,
 * with a sub-element of either sites__in or sites__not_in,
 * which will be an array similar to posts__in in the WP_Query object.
 *
 * $args = array(
 *    'post_type' => 'post',
 *    'sites' => array(
 *        'sites__in' => array( 1, 2, 3, 5 )
 *    )
 * );
 *
 * @author  GWA
 */
class MultisiteQuery extends \WP_Query
{
    public $args;

    public function __construct($args = array())
    {
        $this->args = $args;
        $this->parseMultisiteArgs();
        $this->addFilters();
        $this->query($args);
        $this->remove_filters();
    }

    public function parseMultisiteArgs()
    {
        global $wpdb;

        $siteIDs = $wpdb->get_col("select blog_id from $wpdb->blogs");

        if (isset($this->args['sites']['sites__not_in'])) {
            foreach ($siteIDs as $key => $site_ID) {
                if (in_array($site_ID, $this->args['sites']['sites__not_in'])) {
                    unset($siteIDs[$key]);
                }
            }
        }

        if (isset($this->args['sites']['sites__in'])) {
            foreach ($siteIDs as $key => $site_ID) {
                if (! in_array($site_ID, $this->args['sites']['sites__in'])) {
                    unset($siteIDs[$key]);
                }
            }
        }

        $siteIDs = array_values($siteIDs);
        $this->sites_to_query = $siteIDs;
    }

    public function addFilters()
    {
        add_filter('posts_request', array(&$this, 'createAndUnionizeSelectStatements'));
        add_filter('posts_fields', array(&$this, 'addSiteIDtoPostsFields'));
        add_action('the_post', array(&$this, 'switchToBlogWhileInLoop'));
        add_action('loop_end', array(&$TiB 'restoreCurrentBlogAfterLoop'));
    }

    public function remove_filters()
    {
        remove_filter('posts_request', array(&$this, 'createAndUnionizeSelectStatements'));
        remove_filter('posts_fields', array(&$this, 'addSiteIDtoPostsFields'));
        remove_action('the_post', array(&$this, 'switchToBlogWhileInLoop'));
    }

    public function createAndUnionizeSelectStatements($sql)
    {
        global $wpdb;
        $root_site_db_prefix = $wpdb->prefix;

        $page = isset($this->args['paged']) ? $this->args['paged'] : 1;
        $posts_per_page = isset($this->args['posts_per_page']) ? $this->args['posts_per_page'] : 10;
        $s = (isset($this->args['s'])) ? $this->args['s'] : false;

        foreach ($this->sites_to_query as $key => $site_ID) {
            $new_sql_select = str_replace($root_site_db_prefix, $wpdb->prefix, $sql);
            $new_sql_select = preg_replace("/ LIMIT ([0-9]+), ".$posts_per_page."/", "", $new_sql_select);
            $new_sql_select = str_replace("SQL_CALC_FOUND_ROWS ", "", $new_sql_select);
            $new_sql_select = str_replace("# AS site_ID", "'$site_ID' AS site_ID", $new_sql_select);
            $new_sql_select = preg_replace('/ORDER BY ([A-Za-z0-9_.]+)/', "", $new_sql_select);
            $new_sql_select = str_replace(array("DESC", "ASC"), "", $new_sql_select);

            if ($s) {
                $new_sql_select = str_replace("LIKE '%{$s}%' , wp_posts.post_date", "", $new_sql_select); //main site id
                $new_sql_select = str_replace("LIKE '%{$s}%' , wp_{$site_ID}_posts.post_date", "", $new_sql_select);  // all other sites
            }

            $new_sql_selects[] = $new_sql_select;
            restore_current_blog();
        }

        if ($posts_per_page > 0) {
            $skip = ($page * $posts_per_page) - $posts_per_page;
            $limit = "LIMIT $skip, $posts_per_page";
        } else {
            $limit = '';
        }

        $orderby = "tables.post_date DESC";
        $new_sql = "SELECT SQL_CALC_FOUND_ROWS tables.* FROM ( " . implode(" UNION ", $new_sql_selects) . ") tables ORDER BY $orderby " . $limit;

        return $new_sql;
    }

    public function addSiteIDtoPostsFields($sql)
    {
        $sql_statements[] = $sql;
        $sql_statements[] = "# AS site_ID";

        return implode(', ', $sql_statements);
    }

    public function switchToBlogWhileInLoop($post)
    {
        global $blog_id;

        if ($post->site_ID && $blog_id != $post->site_ID) {
            switch_to_blog($post->site_ID);
        } else {
            restore_current_blog();
        }
    }

    public function restoreCurrentBlogAfterLoop()
    {
        restore_current_blog();
    }
}
