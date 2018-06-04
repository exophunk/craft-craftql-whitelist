<?php
/**
 * CraftQL Whitelist plugin for Craft CMS 3.x
 *
 * Whitelists GraphQL Queries
 *
 * @link      https://y7k.com
 * @copyright Copyright (c) 2018 Robert Krieg
 */

namespace y7k\craftqlwhitelist\filters;

use Craft;
use yii\base\ActionFilter;

class QueryWhitelistingFilter extends ActionFilter
{

    private $whitelist = [];

    /**
     * Initialize whitelist from json export.
     * Use PersistGraphQL to export the whitelist:
     *
     * https://github.com/apollographql/persistgraphql
     *
     * @return void
     */
    public function init()
    {
        $this->whitelist = json_decode(file_get_contents(__DIR__ . '/../config/whitelist.json'), true);
    }


    /**
     * Intercepts CraftQL queries and filters them. They need to pass a whitelist test
     * and pass a validation of variables
     *
     * @return bool
     */
    public function beforeAction($action)
    {
        if (\Craft::$app->getRequest()->isOptions) {
            return true;
        }

        $request = Craft::$app->getRequest();
        $params = Craft::$app->request->getRawBody();
        $params = json_decode($params);

        $isAllowedQuery = $this->isWhitelistedQuery($params->query);
        $isAllowedVars = $this->isAllowedVars($params->operationName, $params->variables);

        if (!$isAllowedQuery || !$isAllowedVars) {
            Craft::$app->response->statusCode = 401;
            echo json_encode(['errors' => [['message' => 'Illegal graphql query']]]);
            return false;
        }
        return true;
    }


    /**
     *
     * Checks if the query is in the whitelist
     * 
     * @return bool
     */
    private function isWhitelistedQuery($query)
    {
        return isset($this->whitelist[$query]);
    }


    /**
     *
     * Temporary: Example of how to validate variables
     * (In this example, we make sure that "code" is required)
     * 
     * @return bool
     */
    private function isAllowedVars($operationName, $variables)
    {
        // if ($operationName === 'couponConnectionGraph' && (!isset($variables->code) || !$variables->code)) {
        //     return false;
        // }
        return true;
    }
}
