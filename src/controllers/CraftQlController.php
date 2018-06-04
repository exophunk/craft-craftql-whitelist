<?php
/**
 * CraftQL Whitelist plugin for Craft CMS 3.x
 *
 * Whitelists GraphQL Queries
 *
 * @link      https://y7k.com
 * @copyright Copyright (c) 2018 Robert Krieg
 */

namespace y7k\craftqlwhitelist\controllers;

use y7k\craftqlwhitelist\filters\QueryWhitelistingFilter;
use markhuot\CraftQL\Controllers\ApiController;

class CraftQlController extends ApiController
{

    public function behaviors()
    {
        return array_merge(
            [
                'queryWhitelisting' => [
                    'class' => QueryWhitelistingFilter::className(),
                ],
            ],
            parent::behaviors()
        );
    }
}
