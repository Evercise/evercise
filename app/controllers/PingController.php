<?php

use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Application;
use Illuminate\Cache\Repository;

/**
 * Class PingController
 */
class PingController extends Controller
{

    /**
     * @var PingElastic
     */
    private $pingElastic;
    /**
     * @var App
     */
    private $app;
    /**
     * @var DatabaseManager
     */
    private $db;
    /**
     * @var Repository
     */
    private $cache;

    /**
     * @param PingElastic $pingElastic
     * @param Application $app
     * @param DatabaseManager $db
     * @param Repository $cache
     */
    public function __construct(PingElastic $pingElastic, Application $app, DatabaseManager $db, Repository $cache)
    {

        $this->pingElastic = $pingElastic;
        $this->app = $app;
        $this->db = $db;
        $this->cache = $cache;
    }


    /**
     * Check all Services
     * @return string
     */
    public function check()
    {
        $this->checkElastic();
        $this->checkMysql();
        $this->checkCache();

        return 'All is good!';
    }


    /**
     * Check if ElasticIsWorking
     */
    public function checkElastic()
    {

        if (!$this->pingElastic->check()) {
            $this->app->abort(404);
        }

    }

    /**
     * Check if Mysql is Connecting
     */
    public function checkMysql()
    {
        if (!$this->db->connection()->getDatabaseName()) {
            $this->app->abort(404);
        }
    }


    /**
     * Check if Cache is Connecting
     */
    public function checkCache()
    {
        $rand_cache_id = str_random();

        $this->cache->add($rand_cache_id, $rand_cache_id, 300);
        if (!$this->cache->has($rand_cache_id)) {
            $this->app->abort(404);
        }

        $this->cache->forget($rand_cache_id);
    }


}