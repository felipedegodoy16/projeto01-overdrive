<?php 
    require_once 'Endereco.php';

    class EnderecoDAO {
        // Atributo
        private Endereco $endereco;

        // Construtor da classe
        public function __construct($endereco) {
            $this->endereco = $endereco;
        }

        // Método para verificação de endereço
        public function verificaEndereco() {
            try {

                // Query
                $sql = "SELECT * FROM enderecos WHERE
                cep = :cep AND numero = :numero AND
                rua = :rua AND cidade = :cidade AND
                estado = :estado AND bairro = :bairro LIMIT 1;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":cep", $this->getEndereco()->getCep(), PDO::PARAM_STR);
                $stmt->bindValue(":numero", $this->getEndereco()->getNumero(), PDO::PARAM_STR);
                $stmt->bindValue(":rua", $this->getEndereco()->getRua(), PDO::PARAM_STR);
                $stmt->bindValue(":cidade", $this->getEndereco()->getCidade(), PDO::PARAM_STR);
                $stmt->bindValue(":estado", $this->getEndereco()->getEstado(), PDO::PARAM_STR);
                $stmt->bindValue(":bairro", $this->getEndereco()->getBairro(), PDO::PARAM_STR);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $dado = $stmt->fetchAll();
                
                foreach($dado as $d){
                    $d['id_end'];
                    $d['cep'];
                    $d['numero'];
                    $d['rua'];
                    $d['cidade'];
                    $d['estado'];
                    $d['bairro'];
                }

                // Verificando existência do endereço no banco
                if(count($dado) > 0){
                    $this->getEndereco()->setId($d['id_end']);
                    return $dado[0];
                }

                return -1;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para inserção do endereço no Banco
        public function inserirEndereco(){
            try {

                // Recebendo retorno de outro método
                $dadoVerificado = $this->verificaEndereco();
            
                // Verificando existência de um endereço já existente
                if($dadoVerificado == -1){

                    // Query
                    $sql = "INSERT INTO enderecos VALUES
                    (DEFAULT, :cep, :numero, :rua, :cidade, :estado, :bairro);";

                    // Conectando ao banco e preparando query
                    $stmt = ConnectionFactory::getConexao()->prepare($sql);
                    $stmt->bindValue(":cep", $this->getEndereco()->getCep(), PDO::PARAM_STR);
                    $stmt->bindValue(":numero", $this->getEndereco()->getNumero(), PDO::PARAM_STR);
                    $stmt->bindValue(":rua", $this->getEndereco()->getRua(), PDO::PARAM_STR);
                    $stmt->bindValue(":cidade", $this->getEndereco()->getCidade(), PDO::PARAM_STR);
                    $stmt->bindValue(":estado", $this->getEndereco()->getEstado(), PDO::PARAM_STR);
                    $stmt->bindValue(":bairro", $this->getEndereco()->getBairro(), PDO::PARAM_STR);

                    // Executando query no banco
                    $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                    $this->verificaEndereco();
                }

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Getters e Setters
        public function getEndereco() {
            return $this->endereco;
        }

        public function setEndereco($endereco) {
            $this->endereco = $endereco;
        }
    }