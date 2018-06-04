# CraftQL Whitelist plugin for Craft CMS 3.x

This plugin intercepts CraftQL queries and filters them. They need to pass a whitelist test and pass a validation of variables.


## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require /craftql-whitelist

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for CraftQL Whitelist.

## CraftQL Whitelist Overview

CraftQL Whitelist validates GraphQL queries against a whitelist and only allows queries that are part of the list. You need to use [https://github.com/apollographql/persistgraphql](persistgraphql) to export the whitelist.

A common command would be:

```
persistgraphql api/graphql/  --add_typename --extension=gql plugins/craft-craftql-whitelist/src/config/whitelist.json
```

This exports all *.gql files in the folder "api/graphql" and saves it directly inside the plugin folder.
