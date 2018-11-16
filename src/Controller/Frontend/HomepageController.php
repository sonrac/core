<?php

declare(strict_types=1);

namespace Bolt\Controller\Frontend;

use Bolt\Configuration\Config;
use Bolt\Controller\BaseController;
use Bolt\Repository\ContentRepository;
use Bolt\TemplateChooser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class HomepageController extends BaseController
{
    public function __construct(Config $config, CsrfTokenManagerInterface $csrfTokenManager, TemplateChooser $templateChooser)
    {
        parent::__construct($config, $csrfTokenManager);

        $this->templateChooser = $templateChooser;
    }

    /**
     * @Route("/", methods={"GET"}, name="homepage")
     *
     * @param ContentRepository $cr
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return Response
     */
    public function homepage(ContentRepository $contentRepository): Response
    {
        $homepage = $this->getOption('theme/homepage') ?: $this->getOption('general/homepage');
        $params = explode('/', $homepage);

        // todo get $homepage content, using "setcontent"
        $record = $contentRepository->findOneBy(['contentType' => $params[0], 'id' => $params[1]]);
        if (!$record) {
            $record = $contentRepository->findOneBy(['contentType' => $params[0]]);
        }

        $templates = $this->templateChooser->homepage();

        return $this->renderTemplate($templates, ['record' => $record]);
    }
}
