<?php
namespace App\Controller;
use App\Entity\Article;
use App\Service\SlackClient;
use App\Repository\ArticleRepository;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class ArticleController extends AbstractController
{
	/**
     * Currently unused: just showing a controller with a constructor!
     */
    private $isDebug;
    private $slack;

	public function __construct(bool $isDebug, SlackClient $slack)
    {
        #dd($isDebug);
        $this->isDebug = $isDebug;
        $this->slack = $slack;
    }
	/**
	* @Route("/", name="app_homepage")
	*/
	public function homepage(ArticleRepository $repository)
	{
		#$repository = $em->getRepository(Article::class);
		#dd($repository);
        $articles = $repository->findAllPublishedOrderedByNewest();
        return $this->render('article/homepage.html.twig', ["articles"=>$articles]);
	}
	/**
	* @Route("/news", name="app_newshome")
	*/
	public function newspage()
	{
		return $this->render('article/homepage.html.twig');
	}

	/**
	* @Route("/news/{slug}", name="article_show")
	*/
	public function show(Article $article, SlackClient $slack)
	{
		if($article->getSlug() === "khaaaaaan") {
            $slack->sendMessage('Kahn', 'Ah, Kirk, my old friend...');
		}

        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];
        
		return $this->render('article/show.html.twig', [
			'comments' => $comments,
			'article' => $article,
		]);
	}

	/**
	* @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
	*/
	public function toggleArticleHeart($slug)
	{
		// TODO - actually heart/unheart the article

		return new JsonResponse(['hearts' => rand(5, 100)]);
	}
}