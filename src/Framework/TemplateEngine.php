<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
//    private string $basePath;
    public array $data = ["title"=>"no titile #1"];
//    function assign($key, $val) {
//        $this->data[$key] = $val;
//    }
    public function __construct(private string $basePath)
    {
//        $this->basePath = $basePath;
    }
    public function render(string $template, $dataParams=[])
    {
        if(0!==count($dataParams)) $this->data=$dataParams;

        //buffer1
        ob_start();

        include "{$this->basePath}/{$template}";

        //buffer2
        $output = ob_get_clean();
        ob_end_clean();
        //buffer3
        return $output;
    }
}


