<?php
    $name1 = "조진용";
    $name2 = "황목치승";
    $name3 = "이도";
    $name4 = "David Kim";
    $name5 = "남궁옥분";

    function separateName($name){

        $stopwords = array("황목","황보", "남궁", "제갈");
        if(strlen($name) != mb_strlen($name, 'utf-8')) { //2-byte char
	    // 2 or 3 Korean chars naming
			$name_chars = strlen($name);

		if($name_chars == 6) {
			$surname = mb_strcut($name, 0, 3);
			if(in_array($surname, $stopwords)){
				$sn='';
				$gn='';
				}else{ // no stop word
				$sn = $surname;
				$gn = mb_strcut($name, 3, strlen($name) - 3);
				}
			}else{ // do not separate sn and givenName
				if($name_chars > 6) {
					$snt = mb_strcut($name, 0, 6);
					if(in_array($snt, $stopwords)){
						$sn = mb_strcut($snt, 0, 6);
						$gn = mb_strcut($name, 6, strlen($name) - 6);
					}else{
						$sn = mb_strcut($snt, 0, 3);
						$gn = mb_strcut($name, 3, strlen($name) - 3);
					}
				}
			}
		}else{ //1-byte char
			$enm = explode(" ", $name);
			if( count($enm) > 1) {
				$gn = $enm[0];
				$sn = $enm[count($enm) -1 ];
			}else{
				$sn = '';
				$gn = '';
			}
		}
		return array("sn" => $sn, "gn" => $gn);
    }

    $name = separateName($name5);
    echo "sn: ". $name['sn'] . " gn: ". $name['gn'];

?>
