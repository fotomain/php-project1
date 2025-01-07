<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
//    private string $basePath;
    public array $data = array ("title"=>"no titile #1");
    public $title='';
//    function assign($key, $val) {
//        $this->data[$key] = $val;
//    }
    public function __construct(private string $basePath)
    {
//        $this->basePath = $basePath;
    }
    public function render(string $template, $dataParams)
    {
        $this->title = $dataParams->title;
//        extract($dataParams, EXTR_OVERWRITE );

        if(0!==count($dataParams)) $this->data=$dataParams;

        //buffer1
        ob_start();

//        include "{$this->basePath}/{$template}";
        $this->resolve($template);

        //buffer2
        $output = ob_get_clean();
        ob_end_clean();
        //buffer3
        return $output;
    }

    public function resolve(string $path)
    {
        return include "{$this->basePath}/{$path}";
    }

}


