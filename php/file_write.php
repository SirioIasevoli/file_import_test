<?php
require_once ('Classes/DBEntities.php');
header('Content-Type: application/json');       


try{
    $my_conn = new PDO('mysql:host=127.0.0.1;port=8686;dbname=file_import_test', 'root', 'root');
} catch(Exception $e) {
    var_dump($e); die;
}


$data = $_POST['data'];
$folder_name = $_POST['folder_name'];
if(!file_exists('../samples/working')) mkdir('../samples/working', 0755, true);

if(array_key_exists('storage.json', $data)) {
    foreach($data['storages.json'] as $el) {
        $entity = new Storage(
            $el['id_deposito'],
            $el['descr_dep'],
        );
        $entity->save($my_conn);
    }
}

if(array_key_exists('agents.json', $data)) {
    foreach($data['agents.json'] as $el) {
        $entity = new Agent(
            $el['id'],
            $el['id_deposito'],
            $el['agente'],
            $el['username'],
        );
        $entity->save($my_conn);
    }
    
}
if(array_key_exists('categories.json', $data)) {
    foreach($data['categories.json'] as $el) {
        $entity = new Category(
            $el['id'],
            $el['parent'],
            $el['sottogruppo'],
            $el['sottogruppo_en'],
            $el['sottogruppo_de'],
            $el['sottogruppo_fr'],
            $el['sottogruppo_es'],
        );
        $entity->save($my_conn);
    }
    
}
if(array_key_exists('clients.json', $data)) {
    foreach($data['clients.json'] as $el) {
        $entity = new Customer(
            $el['agente'],
            $el['numconto'],
            $el['id_deposito'],
            $el['ragione_sociale'],
            $el['codice_fiscale'],
            $el['piva'],
            $el['um_clienti'],
            $el['ordine_minimo'],
        );
        $entity->save($my_conn);
    }
}

if(array_key_exists('clientsAddresses.json', $data)) {
    foreach($data['clientsAddresses.json'] as $el) {
        $entity = new CustomerAddress(
            $el['numconto'],
            $el['via'],
            $el['citta'],
            $el['provincia'],
            $el['cap'],
            $el['stato'],
            $el['note'],
        );
        $entity->save($my_conn);
    }
}

if(array_key_exists('list.json', $data)) {
    foreach($data['list.json'] as $el) {
        $entity = new ProductList(
            $el['id_prodotto'],
            $el['listino'],
            $el['netto'],
            $el['umd'],
        );
        $entity->save($my_conn);
    }
} 
if(array_key_exists('products.json', $data)) {
    foreach($data['products.json'] as $el) {
        $entity = new Product(
            $el['id'],
            $el['id_catalogo'],
            $el['new'],
            $el['oeam'],
            $el['descrizione'],
            $el['sottogruppo'],
            $el['listino'],
            $el['quantita_minima'],
            $el['unita_misura'],
            $el['pezzi'],
            $el['confezione'],
        );
        $entity->save($my_conn);
    }
}
if(array_key_exists('stocks.json', $data)) {
    foreach($data['stocks.json'] as $el) {
        $entity = new ProductStock(
            $el['riferimento'],
            $el['id_deposito'],
            $el['stato'],
            $el['umd'],
        );
        $entity->save($my_conn);
    }

}

foreach(scandir('../samples/files/'.$folder_name) as $file) {
    if(!file_exists('../samples/working/'.$folder_name)) mkdir('../samples/working/'.$folder_name, 0755, true);
    $path = '../samples/files/'.$folder_name.'/'.$file;
    $to = '../samples/working/'.$folder_name.'/'.$file;
    rename($path, $to);
}
echo json_encode(array(
    'data'=>$data,
    'working_dir'=> $to,
))


?>