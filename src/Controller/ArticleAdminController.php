<?php
namespace App\Controller;
use App\Entity\Article;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleAdminController extends AbstractController
{
	/**
     * @Route("/admin/article/new")
     */
	public function new(EntityManagerInterface $em)
	{
		die('todo');
	}
}