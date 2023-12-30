<?php
    header("Access-Control-Allow-Origin: http://localhost:3306");
    header("Access-Control-Allow-Headers: X-Requested-With");
    header('Content-Type: application/json');

    
    $results = array(
        'storage.json'=> array(),
        'agents.json'=> array(),
        'categories.json'=> array(),
        'clients.json'=> array(),
        'clientsAddresses.json'=> array(),
        'list.json'=> array(),
        'products.json'=> array(),
        'stocks.json'=> array(),
    );
    $file_names = array();
    $data_posted = $_POST;
    foreach(scandir('../samples/files/') as $el) {
        if($el != '.' && $el != '..') {
            if(count(scandir('../samples/files/'.$el)) > 2) {
                foreach(scandir('../samples/files/'.$el) as $file) {
                    if($file != '.' && $file != '..') { 
                        $file_names[] = $file;
                        $file_path = '../samples/files/'.$el.'/'.$file;
                        $data = file_get_contents($file_path); 
                        $data_decoded =json_decode($data);
                        
                        foreach($data_decoded as $element) {
                            array_push($results[$file], $element);
                        }
                    }
                }
                echo json_encode(array(
                    "data"=> $results, 
                    "posted"=> $data_posted,
                    "files" => $file_names,
                    "folder_name"=> $el,
                ));
                break;
            } 
        }
        
    } 
    
    
    
    

?>