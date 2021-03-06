<?php 
session_start();
require_once 'models/Flash.php';

$return_url = base64_decode($_POST['return_url']);

if ($_POST['type'] == "add") {
    $uj_termek = [
        [
            'id'=> $_POST['id'],
            'nev'=> $_POST['nev'],
            'feltet'=> $_POST['feltet'],
            'ar'=> $_POST['ar'],
            'mennyiseg' => $_POST['mennyiseg']
        ]
    ];
	//ha letezik a termeksession
	if (isset($_SESSION['termek'])) {

		$bennevane = false;
		
		foreach ($_SESSION['termek'] as $cartitem) {		//walkthrough of session
			if ($cartitem['id'] == $_POST['id'] ) { //ha benne van kosarba
				$product[] = [
				    'nev' => $cartitem['nev'],
                    'id' => $cartitem['id'],
                    'feltet'=> $cartitem['feltet'],
                    'ar'=> $cartitem['ar'],
                    'mennyiseg'=> $_POST['mennyiseg']
                ];
				$bennevane = true;				
			}
			else {		//ha nincs benne kosarba
				$product[] = [
				    'nev' => $cartitem['nev'],
                    'id' => $cartitem['id'],
                    'feltet'=> $cartitem['feltet'],
                    'ar'=> $cartitem['ar'],
                    'mennyiseg'=> $cartitem['mennyiseg']
                ];
			}
		}
		if ($bennevane == false) {		//ha nincs benne
			$_SESSION['termek'] = array_merge($product, $uj_termek );		//
		} else {
			$_SESSION['termek'] = $product;
		}		 	
	}
	
	//ha nem letezik a termek session
	else {
		$_SESSION['termek'] = $uj_termek;
	}
	Flash::success("A termék hozzáadva a kosárhoz.");
	header('Location: ' . $return_url);
	exit;
	
} else if ($_POST['type'] == 'remove') { //else ag: post(type) = 'remove'
	foreach ($_SESSION['termek'] as $cartitem) {
		if ($cartitem['id'] != $_POST['id']) {
			$product[] = [
			    'nev' => $cartitem['nev'],
                'id' => $cartitem['id'],
                'feltet'=> $cartitem['feltet'],
                'ar'=> $cartitem['ar'],
                'mennyiseg'=> $cartitem['mennyiseg']];
		}
		//recreate session, but without that exact id
		$_SESSION['termek'] = $product;
	}
	Flash::success('A terméket törölve a kosárból.');
	header('Location: ' . $return_url);
	exit();
} else if ($_POST['type'] == 'empty') {		//kosar urites
	
	unset($_SESSION['termek']);
	Flash::success('A kosár sikeresen ürítve.');
	header('Location: ' . $return_url);
	exit();
}
