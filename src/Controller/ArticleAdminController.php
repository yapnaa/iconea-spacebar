<?php
namespace App\Controller;
use App\Entity\Article;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleAdminController extends AbstractController
{
	/**
     * @Route("/admin/article/new", name="admin_article_new")
     * @IsGranted("ROLE_ADMIN_ARTICLE")
     */
	public function new(EntityManagerInterface $em)
	{
		die('todo');
	}

    /**
     * @Route("/admin/article/{id}/edit")
     */
    public function edit(Article $article)
    {
    	if (!$this->isGranted('MANAGE', $article)) {
            throw $this->createAccessDeniedException('No access!');
        }
        dd($article);
    }
}