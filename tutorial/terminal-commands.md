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

+ php bin/console doctrine:query:sql "SELECT * FROM article"
+ php bin/console make:twig-extension

#### Here's the super-duper-important takeaway: I want you to use normal dependency injection everywhere - just pass each service you need through the constructor, without all this fancy service-subscriber stuff.

But then, in just a couple of places in Symfony, the main ones being Twig extensions, event subscribers and security voters - a few topics we'll talk about in the future - you should consider using a service subscriber instead to avoid a performance hit.

### Whenever possible, it's better to move code out of your controller. Usually we do this by creating a new service class and putting the logic there. But, if the logic is simple, it can sometimes live inside your entity class.

+ php bin/console doctrine:fixtures:load

#### The Criteria system is better than manually filtering, but, remember! Do not prematurely optimize. Get your app to production, then check for issues. But if you have a big collection and need to return only a small number of results, you should use Criteria immediately.

 As I always like to say, deploy first, then see where you have problems. Using a tool like Blackfire.io makes it very easy to find real issues.

 The moral of the story is this: if your page has a lot of queries because Doctrine is making extra queries across a relationship, just join over that relationship and use addSelect() to fetch all the data you need at once.

 Remember, once you set up authentication, there are only two things you can do with security: get the user object or figure out whether or not the user should have access to something, like a role. That's what isGranted() does.

 However, if you pass a key to the second argument, and that route does not have a wildcard with that name, Symfony just adds it as a query parameter.