<?php
    $model_series = [
        "auggies" =>[

            "model"=>"",

            
            "text"=>  "COMING THIS FALL
MORE AMAZING EVENTS
FROM OUR PARTNERS",
            "model_offset" => ["x"=>0,
                                "y"=>3,
                                "z"=>0],
            "model_scale" => ["x"=>15,
                                "y"=>15,
                                "z"=>15],
            "text_offset" => ["x"=>0,
                              "y"=>1.5,
                              "z"=>0]
        ],
        [
           
            

            "model"=>"/assets/models/partners/auggies.glb",            "text"=> "Nomination Deadline
SEPTEMBER 8

AWEXR.COM",
"model_offset" => ["x"=>0,
"y"=>2,
"z"=>0],
"model_scale" => ["x"=>15,
"y"=>15,
"z"=>15],

"text_offset" => ["x"=>0,
"y"=>0,
"z"=>0]


        ],
        "rpg2" => [
            "model"=>"/assets/models/partners/RPG2XRSI.glb",            "text"=> "SEPTEMBER 24
            
The Second Edition of the First 
VIRTUAL REALITY GOLF TOURNAMENT
Benefiting the XR Safety Initiative

READYPLAYERGOLF.CLUB",
"model_offset" => ["x"=>0,
"y"=>2,
"z"=>0],

"model_scale" => ["x"=>15,
"y"=>30,
"z"=>15],

"text_offset" => ["x"=>0,
"y"=>-1.5,
"z"=>0]


        ], 
        "vrara" => [
            "model"=>"/assets/models/partners/vrara.glb",
            
            "text"=> "SEPTEMBER 29 - OCTOBER 01
European Timezone

VRARGLOBALSUMMIT.COM
",
"model_offset" => ["x"=>0,
"y"=>1,
"z"=>0],

"model_scale" => ["x"=>15,
"y"=>15,
"z"=>15],

"text_offset" => ["x"=>0,
"y"=>-1.5,
"z"=>0]


        ],
        "awe2021" => [
            "model"=>"/assets/models/partners/AWE.glb",            "text"=> "NOVEMBER 9-11
SANTA CLARA, CALIFORNIA
            
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
        "pos_x"=>-51,
        "pos_y"=>160,
        "pos_z"=>-75,
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
