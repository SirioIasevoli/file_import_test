<?php
    class Agent {
        private $_id;
        private $_id_deposito;
        private $_agente;
        private $_username;

        public function __construct($id, $id_deposito, $agente, $username)
        {
            $this->_id = $id;
            $this->_id_deposito = $id_deposito;
            $this->_agente = $agente;
            $this->_username = $username;
        }
        public function save($connection) {
            $query = "
                INSERT INTO file_import_test.agenti 
                    (agenti.id,
                    agenti.agente)
                VALUES('".$this->_id."', '".$this->_agente."')
            ";
            if(check_existance('agenti', 'id', $this->_id, $connection) == 0) {
                try {
                    $connection->exec($query);
                }
                catch(\Exception $e) {
                    var_dump($e);
                };
            }
            
        }
    }
    class Category {
        private $_id;
        private $_parent;
        private $_sottogruppo;
        private $_sottogruppo_en;
        private $_sottogruppo_de;
        private $_sottogruppo_fr;
        private $_sottogruppo_es;

        public function __construct($id, $parent, $sottogruppo, $sottogruppo_en, $sottogruppo_de, $sottogruppo_fr, $sottogruppo_es) {
            $this->_id = $id;
            $this->_parent = $parent;
            $this->_sottogruppo = $sottogruppo;
            $this->_sottogruppo_en = $sottogruppo_en;
            $this->_sottogruppo_de = $sottogruppo_de;
            $this->_sottogruppo_fr = $sottogruppo_fr;
            $this->_sottogruppo_es = $sottogruppo_es;
        }
        
        public function save($connection) {
            $query = "
                INSERT INTO file_import_test.categorie 
                    (categorie.id,
                    categorie.parent,
                    categorie.nome)
                VALUES ('".$this->_id."', '".$this->_parent."', '".$this->_sottogruppo."')
            ";
            if(check_existance('categorie', 'id', $this->_id, $connection) == 0) {
                try {
                    $connection->exec($query);
                }
                catch(\Exception $e) {
                    var_dump($e);
                };
            }
            
        }
    }
    class Customer {
        private $_agente;
        private $_numconto;
        private $_id_deposito;
        private $_ragione_sociale;
        private $_codice_fiscale;
        private $_piva;
        private $_um_clienti;
        private $_ordine_minimo;

        public function __construct($agente, $numconto, $id_deposito, $ragione_sociale, $codice_fiscale, $piva, $um_clienti, $ordine_minimo)
        {
            $this->_agente = $agente;
            $this->_numconto = $numconto;
            $this->_id_deposito = $id_deposito;
            $this->_ragione_sociale = $ragione_sociale;
            $this->_codice_fiscale = $codice_fiscale;
            $this->_piva = $piva;
            $this->_um_clienti = $um_clienti;
            $this->_ordine_minimo = $ordine_minimo;
        }

        public function save($connection) {
            $query = "
                INSERT INTO file_import_test.clienti
                    (clienti.id,
                    clienti.id_agente,
                    clienti.id_depositi,
                    clienti.ragione_sociale,
                    clienti.codice_fiscale,
                    clienti.piva
                    )
                VALUES ('".$this->_numconto."', '".$this->_agente."', '".$this->_id_deposito."', '".$this->_ragione_sociale."', '".$this->_codice_fiscale."', '".$this->_piva."')
            ";
            if(check_existance('clienti', 'id', $this->_numconto, $connection) > 0) {
                try {
                    $connection->exec($query);
                }
                catch(\Exception $e) {
                    var_dump($e);
                };
            }
            
        }
    }
    class CustomerAddress {
        private $_numconto;
        private $_via;
        private $_citta;
        private $_provincia;
        private $_cap;
        private $_stato;
        private $_note;

        public function __construct($numconto, $via, $citta, $provincia, $cap, $stato, $note) {
            $this->_numconto = $numconto;
            $this->_via = $via;
            $this->_citta = $citta;
            $this->_provincia = $provincia;
            $this->_cap = $cap;
            $this->_stato = $stato;
            $this->_note = $note;
        }
        public function save($connection) {
            $query = "
                INSERT INTO file_import_test.clienti_indirizzi 
                    (clienti_indirizzi.id_cliente,
                    clienti_indirizzi.via,
                    clienti_indirizzi.citta,
                    clienti_indirizzi.provincia,
                    clienti_indirizzi.cap,
                    clienti_indirizzi.stato,
                    clienti_indirizzi.note)
                VALUES ('".$this->_numconto."', '".$this->_via."', '".$this->_citta."', '".$this->_provincia."', '".$this->_cap."', '".$this->_stato."', '".$this->_note."')
            ";
            try {
                $connection->exec($query);
            }
            catch(\Exception $e) {
                var_dump($e);
            };
        }
    }

    class Storage {
        private $_id_deposito;
        private $_descr_dep;

        public function __construct($id_deposito, $descr_dep) {
            $this->_id_deposito = $id_deposito;
            $this->_descr_dep = $descr_dep;
        }
        
        public function save($connection) {
            $query = "
                INSERT INTO file_import_test.depositi
                    (depositi.id_deposito,
                    depositi.deposito)
                VALUES('".$this->_id_deposito."', '".$this->_descr_dep."')
            ";
            try {
                $connection->exec($query);
            }
            catch(\Exception $e) {
                var_dump($e);
            };
        }
    }

    class Product {
        private $_id;
        private $_id_catalogo;
        private $_new;
        private $_oeam;
        private $_descrizione;
        private $_sottogruppo;
        private $_listino;
        private $_quantita_minima;
        private $_unita_misura;
        private $_pezzi;
        private $_confezione;

        public function __construct($id, $id_catalogo, $new, $oeam, $descrizione, $sottogruppo, $listino, $quantita_minima, $unita_misura, $pezzi, $confezione)
        {
            $this->_id = $id;
            $this->_id_catalogo = $id_catalogo;
            $this->_new = $new;
            $this->_oeam = $oeam;
            $this->_descrizione = $descrizione;
            $this->_sottogruppo = $sottogruppo;
            $this->_listino = $listino;
            $this->_quantita_minima = $quantita_minima;
            $this->_unita_misura = $unita_misura;
            $this->_pezzi = $pezzi;
            $this->_confezione = $confezione;
        }

        public function save($connection) {
            $query = "
                INSERT INTO file_import_test.prodotti
                    (prodotti.id,
                    prodotti.id_categoria,
                    prodott.id_catalogo,
                    prodotti.new,
                    prodotti.oeam,
                    prodotti.text,
                    prodotti.listino)
                VALUES ('".$this->_id."', '".$this->_sottogruppo."', '".$this->_id_catalogo."', '".$this->_new."', '".$this->_oeam."', '".$this->_descrizione."', '".$this->_listino."')
            ";
            if(check_existance('prodotti', 'id', $this->_id, $connection) > 0) {
                try {
                    $connection->exec($query);
                }
                catch(\Exception $e) {
                    var_dump($e);
                };
            }
            
        }
    }

    class ProductStock {
        private $_riferimento;
        private $_id_deposito;
        private $_stato;
        private $_umd;

        public function __construct($riferimento, $id_deposito, $stato, $umd)
        {
            $this->_riferimento = $riferimento;
            $this->_id_deposito = $id_deposito;
            $this->_stato = $stato;
            $this->_umd = $umd;
        }

        public function save($connection) {
            $query = "
                INSERT INTO file_import_test.prodotti_giacenze
                    (prodotti_giacenze.id_prodotto,
                    prodotti_giacenze.id_deposito,
                    prodotti_giacenze.stato,
                    prodotti_giacenze.dt_update)
                VALUES ('".$this->_riferimento."', '".$this->_id_deposito."', '".$this->_stato."', '".$this->_umd."')
            ";
            try {
                $connection->exec($query);
            }
            catch(\Exception $e) {
                var_dump($e);
            };
        }
    }

    class ProductList {
        private $_id_prodotto;
        private $_listino;
        private $_netto;
        private $_umd;

        public function __construct($id_prodotto, $listino, $netto, $umd) 
        {
            $this->_id_prodotto = $id_prodotto;
            $this->_listino = $listino;
            $this->_netto = $netto;
            $this->_umd = $umd;
        }

        public function save($connection) {
            $query = "
                INSERT INTO file_import_test.prodotti_listini
                    (prodotti_listini.id_prodotto,
                    prodotti_listini.listino,
                    prodotti_listini.prezzo,
                    prodotti_listini.dt)
                VALUES ('".$this->_id_prodotto."', '".$this->_listino."', '".$this->_netto."', '".$this->_umd."')
            ";
            try {
                $connection->exec($query);
            }
            catch(\Exception $e) {
                var_dump($e);
            };
        }
        
    }

    function check_existance($entity, $id_field, $id, $connection) {
        $query = "
            SELECT COUNT(*)
            FROM ".$entity."
            WHERE ".$id_field." = TRIM(".$id.")
        ";
        $result = $connection->exec($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return count($data);
    }
?>