<?php
namespace App\Service;

use Psr\Log\LoggerInterface;
use Michelf\MarkdownInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
/**
 * 
 */
class MarkdownHelper
{
	private $cache;
    private $markdown;
    private $logger;
    public function __construct(AdapterInterface $cache, MarkdownInterface $markdown, LoggerInterface $logger)
    {
    	$this->cache = $cache;
    	$this->markdown = $markdown;
    	$this->logger = $logger;
    }

	public function parse(string $source): string
	{
		if (stripos($source, 'bacon') !== false) {
            $this->logger->info('They are talking about bacon again!');
        }
		#$source = $markdown->transform($source);
		$item = $this->cache->getItem('markdown_'.md5($source));
		if(!$item->isHit()) {
			$item->set($this->markdown->transform($source));
			$this->cache->save($item);
		}
		
		return $item->get();

		#dd($cache);
	}
}