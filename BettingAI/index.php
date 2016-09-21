<?php
$Strategieen = array();
   
function VoegStrategieToe($PlayerID,$StrategieID){
    global $Strategieen;
    $Strategieen[Count($Strategieen)] = $PlayerID."_".$StrategieID;    
} 


//include 'Strategie_7.php';
include 'Strategie_6.php';
include 'Strategie_31.php';
//include 'StrategieVoorbeeld.php';

function Start(){
    global $Strategieen;
    //$score[een][twee]
    $score = array();
    $scoreR = array();
    for($i = 0; $i<Count($Strategieen);$i++){
        $score[$i] = array();
        for($o = 0; $o<Count($Strategieen);$o++){
            $score[$i][$o] = 0;
            $scoreR[$i][$o] = 0;
            print("a");
        }
    }
    print_r($score);
       
    //Battle($Strategieen[0],$Strategieen[0],0,0,6,7);
    
    for($Strategie1 =0;$Strategie1<Count($Strategieen);$Strategie1++){
        for($Strategie2 =0;$Strategie2<Count($Strategieen);$Strategie2++){
            for($Random1 =1;$Random1<=10;$Random1++){
                for($Random2 =1;$Random2<=10;$Random2++){
                    for($Hand1 =1;$Hand1<=10;$Hand1++){
                        for($Hand2 =1;$Hand2<=10;$Hand2++){
                            $ScoreBattle = Battle($Strategieen[$Strategie1],$Strategieen[$Strategie2],$Random1,$Random2,$Hand1,$Hand2);
                            if(!($ScoreBattle == 0)) {
                                if(gettype($ScoreBattle)== "array"){
                                    $score[$Strategie1][$Strategie2] +=$ScoreBattle[0];
                                    $scoreR[$Strategie1][$Strategie2] +=$ScoreBattle[0];               
                                }else {
                                    $score[$Strategie1][$Strategie2] +=$ScoreBattle;
                                    $scoreR[$Strategie1][$Strategie2] -=$ScoreBattle;
                                }
                            }
                            
                        }           
                    }            
                }           
            }
        }
    }
    print_r($score);
    
    //for($i = 0; $i<Count($Strategien);$i++){
    //    for($o = 0; $i<Count($Strategien);$i++){
    //        $score[$i][$o] +=  Battle();
    //    }
    //}
} 

function Battle($StrategieNaam1,$StrategieNaam2,$Random1,$Random2,$Hand1,$Hand2) {

    $FuncMove1 = "SpelerEenBeurtNul$StrategieNaam1";
    $ReturnMove1 = $FuncMove1($Random1);
    
    if($ReturnMove1 == -1) {
        return 0;
    }elseif(!($ReturnMove1 >= 5 && $ReturnMove1 <=10)) {
        print("ERROR: in move 1.\n");
        print("ERROR: $ReturnMove1 \n");
        print("ERROR: ".$StrategieNaam1." ".$StrategieNaam2." ".$Random1." ".$Random2." ".$Hand1." ".$Hand2.".\n");
        return 0;
    }
    
    $FuncMove2 = "SpelerTweeBeurtNul$StrategieNaam1";
    $ReturnMove2 = $FuncMove2($Random2,$ReturnMove1);
    
    if($ReturnMove2 == -1) {
        return 0;
    }elseif(!($ReturnMove2 >= 0 && $ReturnMove2 <=10)) {
        print("ERROR: in move 2.\n");
        print("ERROR: $ReturnMove2 \n");
        print("ERROR: ".$StrategieNaam1." ".$StrategieNaam2." ".$Random1." ".$Random2." ".$Hand1." ".$Hand2.".\n");
        return 0;
    }
    
    $FuncMove3 = "SpelerEenBeurtEen$StrategieNaam1";
    $ReturnMove3 = $FuncMove3($Random1,$Hand1,$ReturnMove1,$ReturnMove2);
    
    if($ReturnMove3 == -1) {
        return -($ReturnMove1+$ReturnMove2);
    }elseif(!($ReturnMove3 >= 0 && $ReturnMove3 <=10)) {
        print("ERROR: in move 3.\n");
        print("ERROR: $ReturnMove3 \n");
        print("ERROR: ".$StrategieNaam1." ".$StrategieNaam2." ".$Random1." ".$Random2." ".$Hand1." ".$Hand2.".\n");
        return 0;
    }
        
    $FuncMove4 = "SpelerTweeBeurtEen$StrategieNaam2";
    $ReturnMove4 = $FuncMove4($Random2,$Hand2,$ReturnMove1,$ReturnMove2,$ReturnMove3);
    
    if($ReturnMove4 == -1) {
        return $ReturnMove1+$ReturnMove2+$ReturnMove3;
    }elseif(!($ReturnMove4 >= 0 && $ReturnMove4 <=10)) {
        print("ERROR: in move 4.\n");
        print("ERROR: $ReturnMove4 \n");
        print("ERROR: ".$StrategieNaam1." ".$StrategieNaam2." ".$Random1." ".$Random2." ".$Hand1." ".$Hand2.".\n");
        return 0;
    }
    
    $FuncMove5 = "SpelerEenBeurtTwee$StrategieNaam1";
    $ReturnMove5 = $FuncMove5($Random1,$Hand1,$ReturnMove1,$ReturnMove2,$ReturnMove3,$ReturnMove4);
    
    if($ReturnMove5 == -1) {
        return -$ReturnMove5;
    }elseif(!($ReturnMove5 == 0)){
        print("ERROR: in move 5.\n");
        print("ERROR: $ReturnMove5 \n");
        print("ERROR: ".$StrategieNaam1." ".$StrategieNaam2." ".$Random1." ".$Random2." ".$Hand1." ".$Hand2.".\n");
        return -$ReturnMove5;
    }
    
    if($Hand1==$Hand2) {
        //return 0;
        return array(($ReturnMove1+$ReturnMove2+$ReturnMove3+$ReturnMove4));
    }elseif ($Hand1>$Hand2) {
        return ($ReturnMove1+$ReturnMove2+$ReturnMove3+$ReturnMove4);
    }else{
        return -($ReturnMove1+$ReturnMove2+$ReturnMove3+$ReturnMove4);
    }
    

}


Start();
