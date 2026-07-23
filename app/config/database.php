<?php

// classe para gerenciar a conexão com o banco de dados PostgreSQL
class Database {
    // valores padrão caso o arquivo .env não exista
    private static string $host = '';
    private static string $port = '';
    private static string $dbname = '';
    private static string $user = '';
    private static string $password = '';

    // variável para armazenar a conexão PDO
    private static ?PDO $conexao = null;
    private static bool $configLoaded = false;

    // método para carregar as configurações do arquivo .env
    private static function loadConfig(): void {
        if (self::$configLoaded) {
            return;
        }

        $envFile = __DIR__ . '/../../.env';

        if (is_file($envFile)){
            // lê o arquivo .env linha por linha, ignorando linhas vazias e comentários
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if ($lines !== false) {
                foreach ($lines as $line) {
                    $line = trim($line);

                    if ($line === '' || $line[0] === '#') {
                        continue;
                    }

                    $parts = explode('=', $line, 2);

                    if (count($parts) !== 2) {
                        continue;
                    }

                    $name = trim($parts[0]);
                    $value = trim($parts[1]);
                    
                    // remove aspas duplas e aspas simples do início e do fim do valor, se existirem
                    if ((strlen($value) >= 2) && (($value[0] === '"' && $value[strlen($value) - 1] === '"') || ($value[0] === "'" && $value[strlen($value) - 1] === "'"))) {
                        $value = substr($value, 1, -1);
                    }

                    // armazena a variável de ambiente no array $_ENV e também define a variável de ambiente usando putenv
                    $_ENV[$name] = $value;
                    putenv($name . '=' . $value);
                }
            }
        }

        self::$host = self::getEnvValue('DB_HOST', 'localhost');
        self::$port = self::getEnvValue('DB_PORT', '5432');
        self::$dbname = self::getEnvValue('DB_NAME', 'bellocard');
        self::$user = self::getEnvValue('DB_USER', 'postgres');
        self::$password = self::getEnvValue('DB_PASSWORD', 'password');

        self::$configLoaded = true;
    }

    // método auxiliar para obter o valor de uma variável de ambiente, com um valor padrão caso não exista
    private static function getEnvValue(string $key, string $default): string{
        // caso a variável de ambiente esteja definida no array $_ENV e não seja uma string vazia, retorna o valor dela
        if (array_key_exists($key, $_ENV) && $_ENV[$key] !== ''){
            return $_ENV[$key];
        }

        // caso a variável de ambiente esteja definida no sistema operacional e não seja uma string vazia, retorna o valor dela
        $value = getenv($key);
        if ($value !== false && $value !== ''){
            return $value;
        }
        
        // caso a variável de ambiente não esteja definida, retorna o valor padrão fornecido
        return $default;
    }

    // metodo para obter a conexão com o banco de dados
    public static function getConnection(): PDO{
        self::loadConfig();

        if (self::$conexao === null){
            // DSN é a string de conexão que contém informações sobre o banco de dados
            $dsn = 'pgsql:host=' . self::$host
                . ';port=' . self::$port
                . ';dbname=' . self::$dbname;

            try {
                // cria uma nova conexão PDO
                self::$conexao = new PDO($dsn, self::$user, self::$password);
                // configura o modo de erro do PDO para exceções
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // configura os dados para serem retornados como arrays associativos
                self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // em caso de erro, exibe a mensagem de erro e termina a execução
                die('Erro na conexão com o banco de dados: ' . $e->getMessage());
            }
        }
        return self::$conexao;
    }
}