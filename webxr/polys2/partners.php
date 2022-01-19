<?php
    $model_series = [
        "auggies" =>[

            "model"=>"",

            
            "text"=>  "MORE AMAZING XR EVENTS
FROM OUR PARTNERS
IN 2022 ",
            "model_offset" => ["x"=>0,
                                "y"=>-1,
                                "z"=>0],
            "model_scale" => ["x"=>15,
                                "y"=>15,
                                "z"=>15],
            "text_offset" => ["x"=>0,
                              "y"=>3,
                              "z"=>0]
        ],
        "xrwomen" => [
            "model"=>"/assets/models/partners/XRWomen.glb",            "text"=> "Wednesdays
XRWOMEN.COM",
"model_offset" => ["x"=>0,
"y"=>1,
"z"=>0],

"model_scale" => ["x"=>20,
"y"=>20,
"z"=>20],

"text_offset" => ["x"=>0,
"y"=>0,
"z"=>0]


        ], 
        "fivars" => [
            "model"=>"/assets/models/partners/fivars.glb",            "text"=> "FESTIVAL OF INTERNATIONAL 
VIRTUAL AND AUGMENTED REALITY
STORYTELLING
FEBRUARY 21-28, 2022
FIVARS.NET",
"model_offset" => ["x"=>0,
"y"=>2,
"z"=>0],

"model_scale" => ["x"=>8,
"y"=>5,
"z"=>8],

"text_offset" => ["x"=>0,
"y"=>1,
"z"=>0]


        ], 
        
        [
           
            

            "model"=>"/assets/models/partners/Gatherverse.glb",            "text"=> "February 22-23, 2022
gatherversesummit.com",
"model_offset" => ["x"=>0,
"y"=>1,
"z"=>0],
"model_scale" => ["x"=>35,
"y"=>35,
"z"=>35],

"text_offset" => ["x"=>0,
"y"=>-1,
"z"=>0]


        ],
        "vrara" => [
            "model"=>"/assets/models/partners/vrara-immerse.glb",
            
            "text"=> "March 20, 2022
June 1, 2022
IMMERSEGLOBALNETWORK.COM
",
"model_offset" => ["x"=>0,
"y"=>0,
"z"=>0],

"model_scale" => ["x"=>36,
"y"=>40,
"z"=>36],

"text_offset" => ["x"=>0,
"y"=>-1.5,
"z"=>0]


        ],
        "awe2022" => [
            "model"=>"/assets/models/partners/AWE.glb",            "text"=> "2022
USA JUNE 1-3 Santa Clara, California
ASIA AUGUST 26-27 Shenzhen, China
EU OCTOBER 20-21 Lisbon, Portugal
AWEXR.COM",
"model_offset" => ["x"=>0,
"y"=>1.5,
"z"=>0],
"model_scale" => ["x"=>20,
"y"=>20,
"z"=>20],

"text_offset" => ["x"=>0,
"y"=>-1,
"z"=>0]


        ]

    ];

    $coords =[
        "pos_x"=>60,
        "pos_y"=>0,
        "pos_z"=>-0,
        "rot_x"=>0,
        "rot_y"=>180,
        "rot_z"=>0,
        "scale"=>1,
        "start_x"=>0,
        "start_y"=>0,
        "start_z"=>10,
        "offset_x"=>-40,
        "offset_y"=>0,
        "offset_z"=>0,
    ];


?>


<a-assets timeout="800000">

<?php
    foreach($model_series as $key=> $model){
        print "";
    


?>
<a-asset-item id="<?=$key?>" response-type="arraybuffer" src="<?=$model['model']?>"></a-asset-item>

<?php
}
?>

</a-assets>

<?php
//var_dump($model_series);
   displayModelSeries($model_series,$coords);
?>
