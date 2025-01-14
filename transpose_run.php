<?php

//=== RUN COMMAND
//php -f transpose_run.php input_melody1.txt -3

//=== TEST BORDERS COMMANDS
//php -f transpose_run.php input_melody2.txt 88
//php -f transpose_run.php input_melody2.txt 87
//php -f transpose_run.php input_melody3.txt -88
//php -f transpose_run.php input_melody3.txt -87

//$inputFileName = "./input_melody1.txt";
//$shiftNumber=-3;
$inputFileName = $argv[1];
$shiftNumber=(int)$argv[2];
$outputData=[];

//=== TOTAL 88
$pianoButtons=[
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
echo count($pianoButtons)."\n";

echo '============== Starting transpose... '."\n";
echo "\n";

$inputData = file_get_contents($inputFileName);
$inputData = str_replace("[[","",$inputData);
$inputData = str_replace("]]","",$inputData);

$collectionOfNotes = explode('],[', $inputData);

echo json_encode($collectionOfNotes);
echo "\n";

    for ($i = 0; $i < count($collectionOfNotes) ; $i++) {
        $oldIndex=array_search($collectionOfNotes[$i],$pianoButtons);
        $newIndex=$oldIndex + $shiftNumber;
        echo 'newIndex = '.$newIndex; echo "\n";
        if($newIndex>87 || $newIndex<0){
            echo "============== ERROR: it's not possible to transpose data ".$collectionOfNotes[$i]." with shiftNumber: ".$shiftNumber;
            exit(0);
        }
        $outputData[$i]=$pianoButtons[$newIndex];
    }

echo json_encode($outputData);
echo "\n";

$writeData=implode('],[',$outputData);
$writeData="[[".$writeData."]]";

file_put_contents("output_melody.txt", $writeData);

echo '============== Finish transpose OK!';