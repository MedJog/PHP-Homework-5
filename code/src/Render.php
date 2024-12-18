<?php

namespace Geekbrains\Application1;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Render {

    private string $viewFolder = '/src/Views/';
    private FilesystemLoader $loader;
    private Environment $environment;


    public function __construct(){
        $this->loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . $this->viewFolder);
        $this->environment = new Environment($this->loader, [
            'cache' => $_SERVER['DOCUMENT_ROOT'].'/cache/',
        ]);
    }
// метод генерации ответа
    // public function renderPage(string $contentTemplateName = 'page-index.tpl', array $templateVariables = []) {
    //     $template = $this->environment->load('main.tpl');
        
    //     $templateVariables['content_template_name'] = $contentTemplateName;
 
    //     return $template->render($templateVariables);
    // }
    public function renderPage(string $contentTemplateName = 'page-index.tpl', array $templateVariables = [], bool $useMainLayout = true) {
        if ($useMainLayout) {
            // Если используем основной layout
            $template = $this->environment->load('main.tpl');
            $templateVariables['content_template_name'] = $contentTemplateName;
        } else {
            // Загружаем чистый шаблон напрямую
            $template = $this->environment->load($contentTemplateName);
        }
    
        return $template->render($templateVariables);
    }
}