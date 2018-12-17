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