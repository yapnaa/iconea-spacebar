* php bin/console config:dump KnpMarkdownBundle
* php bin/console config:dump twig

+ php bin/console debug:autowiring
+ php bin/console debug:container --show-private

##### But here are the two big takeaways:

-- There are many services in the container and each has an id.
-- The services you'll use 99% of the time show up in debug:autowiring and are easy to access.

+ php bin/console config:dump framework
+ php bin/console debug:config framework
+ php bin/console debug:container --parameters

+ php bin/console about

##### Commands are services too. So if you needed your SlackClient service, you would just add a __construct() method and autowire it! When you do this, you need to call parent::__construct(). Commands are a rare case where there is a parent constructor!

+ php bin/console make:entity
+ php bin/console make:migration
+ php bin/console doctrine:migrations:migrate
+ php bin/console doctrine:migrations:status
