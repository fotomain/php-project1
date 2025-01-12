<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class AboutController{
    //version1 private TemplateEngine $view;


    public array $pianoButtons=[
        '-3,10', '-3,11', '-3,12',
        '-2,1', '-2,2', '-2,3', '-2,4', '-2,5', '-2,6', '-2,7', '-2,8', '-2,9','-2,10','-2,11', '-2,12',
        '-1,1', '-1,2', '-1,3', '-1,4', '-1,5', '-1,6', '-1,7', '-1,8', '-1,9','-1,10','-1,11', '-1,12',
         '0,1',  '0,2',  '0,3',  '0,4',  '0,5',  '0,6',  '0,7',  '0,8',  '0,9', '0,10', '0,11',  '0,12',
         '1,1',  '1,2',  '1,3',  '1,4',  '1,5',  '1,6',  '1,7',  '1,8',  '1,9', '1,10', '1,11',  '1,12',
         '2,1',  '2,2',  '2,3',  '2,4',  '2,5',  '2,6',  '2,7',  '2,8',  '2,9', '2,10', '2,11',  '2,12',
         '3,1',  '3,2',  '3,3',  '3,4',  '3,5',  '3,6',  '3,7',  '3,8',  '3,9', '3,10', '3,11',  '3,12',
         '4,1',  '4,2',  '4,3',  '4,4',  '4,5',  '4,6',  '4,7',  '4,8',  '4,9', '4,10', '4,11',  '4,12',
         '5,1'
    ];
    public array $melody=[];
    public int $shiftNumber=-3;
    public array $outputData=[];
    public function __construct(private TemplateEngine $view)
    {
        //version1 $this->view = new TemplateEngine(Paths::VIEW);
        $this->melody=['2,1','2,6','2,1','2,8','2,1','2,9'];
        for ($i = 0; $i < count($this->melody) ; $i++) {
            $oldIndex=array_search($this->melody[$i],$this->pianoButtons);
                $newIndex=$oldIndex + $this->shiftNumber;
                    $this->outputData[$i]=$this->pianoButtons[$newIndex];
        }

    }
    public function about()
    {
//        dd($this->view);
//OK!
//        echo 'About Page';

        //buffer4 => echo
        echo $this->view->render("about.php", array(
            'title' => 'About Title Text!',
            'dangerousData' => '<script> alert(123)  </script>  ',
            'pianoButtonsCount' => count($this->pianoButtons),
            'melody' => $this->melody,
            'outputData' => $this->outputData,
        ));
    }
}