<?php
include_once(SITE_PATH . '/lib/classes/Template.php');
include_once(SITE_PATH . '/lib/classes/SimpleController.php');
include_once(SITE_PATH . '/lib/classes/NewsController.php');
include_once(SITE_PATH . '/lib/classes/PressReviewController.php');
include_once(SITE_PATH . '/lib/classes/ArticleController.php');
include_once(SITE_PATH . '/lib/classes/MailController.php');
include_once(SITE_PATH . '/lib/classes/NewsService.php');
include_once(SITE_PATH . '/lib/classes/SlideshowService.php');
include_once(SITE_PATH . '/lib/classes/Article.php');
include_once(SITE_PATH . '/lib/classes/ArticleService.php');


class ReplicairController extends SimpleController {
	
	// Parameters for design view
	var $newsPreviewCount = 3;
	var $slideshowCount = 5;
	
	var $linkPaginationDefaultNews = "news-list.php?page=";
	var $linkPaginationDefaultPressReview = "pressreview-list.php?page=";
	var $linkPaginationDefaultArticle = "article.php?";
	
	// Parameters to define page to handle
	var $parameterPageIndex = "index";
	var $parameterPageNewsList = "newsList";
	var $parameterPageNews = "news";
	var $parameterPagePressReviewList = "pressreviewList";
	var $parameterPagePartenair = "partenair";
	var $parameterPagePionniers = "pionniers";
	var $parameterPageArticle = "article";
	var $parameterPageContact = "contact";
	var $parameterPageMentions = "mentions";
	var $parameterPageGallery = "gallery";
	
	// central parts
	var $targetPageIndex = "lib/includes/central/index.inc";
	var $targetPageNewsList = "lib/includes/central/news-list.inc";
	var $targetPageNews = "lib/includes/central/news.inc";
	var $targetPagePressReviewList = "lib/includes/central/pressreview-list.inc";
	var $targetPagePartenair = "lib/includes/central/partenair.inc";
	var $targetPagePionniers = "lib/includes/central/pionniers.inc";
	var $targetPageArticle = "lib/includes/central/article.inc";
	var $targetPageContact = "lib/includes/central/contact.inc";
	var $targetPageMentions = "lib/includes/central/mentions.inc";
	var $targetPageGallery = "lib/includes/central/gallery.inc";
	
	// central footers
	var $targetPageGeneralFooter = "lib/includes/central/central-footer-general.inc";
	var $targetPagePartenairFooter = "lib/includes/central/central-footer-payment.inc";
	
	var $templateSimple = "public.phtml";
	
	var $articleCategoryReplicair = "replicair";
	var $articleCategoryProject = "project";
	
	/**
	 * Handle a request for public part of the site
	 * 
	 * @param array $get : get parameters
	 * @param array $post : post parameters
	 * @param string $page : page parameter to handle
	 * @return Template
	 */
	public function handleRequest($get, $post, $page) {
		try {
			if ($page == NULL or $page == '') {
				return $this->handlePageIndex($get, $post);
			}
			elseif ($page == $this->parameterPageIndex) {
				return $this->handlePageIndex($get, $post);
			}
			elseif ($page == $this->parameterPageNewsList) {
				return $this->handlePageNewsList($get, $post);
			}
			elseif ($page == $this->parameterPageNews) {
				return $this->handlePageNews($get, $post);
			}
			elseif ($page == $this->parameterPagePressReviewList) {
				return $this->handlePagePressReviewList($get, $post);
			}
			elseif ($page == $this->parameterPagePartenair) {
				return $this->handlePagePartenair($get, $post);
			}
			elseif ($page == $this->parameterPageArticle) {
				return $this->handlePageArticle($get, $post);
			}
			elseif ($page == $this->parameterPageContact) {
				return $this->handlePageContact($post);
			}
			elseif ($page == $this->parameterPageMentions) {
				return $this->handlePageSimple($this->targetPageMentions);
			}
			elseif ($page == $this->parameterPageGallery) {
				return $this->handlePageSimple($this->targetPageGallery);
			}
			elseif ($page == "gallery2") {
				return $this->handlePageSimple("lib/includes/central/gallery2.inc");
			}
			else {
				return $this->handlePageIndex($get, $post);
			}
		}
		catch (Exception $e) {
			return $this->handleException($e);
		}
	}
	
	/**
	 * Handle demand for index page
	 * 
	 * @param array $get : get parameters
	 * @param array $post : post parameters
	 * @return Template
	 */
	private function handlePageIndex($get, $post) {
		$slideshowService = new SlideshowService();
		$t = new Template();
		$t = $this->prepareDatasForNewsPanel($t);
		$t->slideshowList = $this->getSlideshowList($slideshowService);
		$t->slideshowFileLocation = Slideshow::fileDefaultLocation;
		$t->central = $this->targetPageIndex;
		$t->centralFooter = $this->targetPageGeneralFooter;
		$t->template = $this->templateSimple;
		return $t;
	}
	
	/**
	 * Handle demand for news list page
	 *
	 * @param array $get : get parameters
	 * @param array $post : post parameters
	 * @return Template
	 */
	private function handlePageNewsList($get, $post) {
		$newsController = new NewsController();
		if (isset($get[$newsController->parameterPage])) {
			$t = $newsController->prepareTemplateForList(true, false, $newsController->elementsByPage, $get[$newsController->parameterPage],$this->linkPaginationDefaultNews);
		}
		else {
			$t = $newsController->prepareTemplateForListDefault(true, false, $this->linkPaginationDefaultNews);
		}
		$t = $this->prepareDatasForNewsPanel($t);
		$t->central = $this->targetPageNewsList;
		$t->template = $this->templateSimple;
		return $t;
	}
	
	/**
	 * Handle demand for news page
	 *
	 * @param array $get : get parameters
	 * @param array $post : post parameters
	 * @return Template
	 */
	private function handlePageNews($get, $post) {
		$newsController = new NewsController();
		$t = $newsController->prepareTemplateForPreview($get);
		$t = $this->prepareDatasForNewsPanel($t);
		$t->central = $this->targetPageNews;
		$t->template = $this->templateSimple;
		return $t;
	}
	
	/**
	 * Handle demand for press review list page
	 *
	 * @param array $get : get parameters
	 * @param array $post : post parameters
	 * @return Template
	 */
	private function handlePagePressReviewList($get, $post) {
		$pressreviewController = new PressReviewController();
		if (isset($get[$pressreviewController->parameterPage])) {
			$t = $pressreviewController->prepareTemplateForList(true, false, $pressreviewController->elementsByPage, $get[$pressreviewController->parameterPage],$this->linkPaginationDefaultPressReview);
		}
		else {
			$t = $pressreviewController->prepareTemplateForListDefault(true, false, $this->linkPaginationDefaultPressReview);
		}
		
		$t = $this->prepareDatasForNewsPanel($t);
		$t->central = $this->targetPagePressReviewList;
		$t->template = $this->templateSimple;
		return $t;
	}
	
	/**
	 * Handle demand for partners page
	 *
	 * @param array $get : get parameters
	 * @param array $post : post parameters
	 * @return Template
	 */
	private function handlePagePartenair($get, $post) {
		$t = new Template();
		$t = $this->prepareDatasForNewsPanel($t);
		$t->central = $this->targetPagePartenair;
		$t->centralFooter = $this->targetPagePartenairFooter;
		$t->template = $this->templateSimple;
		return $t;
	}
	
	/**
	 * Handle demand for contact page
	 *
	 * @param array $get : get parameters
	 * @param array $post : post parameters
	 * @return Template
	 */
	private function handlePageContact($post) {
		$mailController = new MailController();
		$t = $mailController->handleMail($post);
		$t = $this->prepareDatasForNewsPanel($t);
		$t->central = $this->targetPageContact;
		//$t->centralFooter = $this::targetPageGeneralFooter;
		$t->template = $this->templateSimple;
		return $t;
	}
	
	/**
	 * Handle demand for contact page
	 *
	 * @param array $get : get parameters
	 * @param array $post : post parameters
	 * @return Template
	 */
	private function handlePageSimple($central) {
		$t = new Template();
		$t = $this->prepareDatasForNewsPanel($t);
		$t->central = $central;
		$t->template = $this->templateSimple;
		return $t;
	}
	
	/**
	 * Handle demand for article page
	 *
	 * @param array $get : get parameters
	 * @param array $post : post parameters
	 * @return Template
	 */
	private function handlePageArticle($get, $post) {
		$central = $this->targetPageArticle;
		$articleController = new ArticleController();
		if (isset($get[$articleController->parameterCategory])) {
			$category = $get[$articleController->parameterCategory];
			if (isset($get[$articleController->parameterPage])) {
				$page = $get[$articleController->parameterPage];
				$t = $articleController->prepareTemplateForListByCategory(TRUE,FALSE,$articleController->elementsByPage,$page,$this->linkPaginationDefaultArticle,$category);
			}
			else {
				$t = $articleController->prepareTemplateForListByCategory(TRUE,FALSE,$articleController->elementsByPage,1,$this->linkPaginationDefaultArticle,$category);
			}
		}
		else {
			$t = $articleController->prepareTemplateForListByCategory(TRUE,FALSE,$articleController->elementsByPage,1,$this->linkPaginationDefaultArticle,"replicair");
		}
		$t = $this->prepareDatasForNewsPanel($t);
		$t->central = $this->targetPageArticle;
		$t->centralFooter = $this->targetPageGeneralFooter;
		$t->template = $this->templateSimple;
		return $t;
	}
	
	
	/**
	 * Prepare datas for News preview panel
	 * 
	 * @param Template $t
	 */
	private function prepareDatasForNewsPanel(Template $t) {
		$newsService = new NewsService();
		$t->newsPreviewList = $newsService->search(true, false, 0, $this->newsPreviewCount);
		//$date = new DateTimeFrench("now",new DateTimeZone('UTC'));
		$date = new DateTimeCustom(DateTimeCustom::NOW);
		$t->newsPreviewDate = $date->format("d F");
		$t->newsFileLocation = News::fileDefaultLocation;
		return $t;
	}
	
	/**
	 * 
	 * @param SlideshowService $service
	 * @return Array[Slideshow]
	 */
	private function getSlideshowList(SlideshowService $service) {
		return $service->search(true, false, 0, $this->slideshowCount);
	}
	
}
?>