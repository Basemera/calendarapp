<?php namespace App\Lib;
use PDO;
use App\Database\DatabaseConfig;
use App\Model\User;
use Exception;

class Request
{
    public $params;
    public $reqMethod;
    public $contentType;
    public $requestUrl;

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->reqMethod = trim($_SERVER['REQUEST_METHOD']);
        $this->contentType = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        $this->username = !empty($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
        $this->password = !empty($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
        $this->requestUrl = $_SERVER;
    }

    public function getBody()
    {
        if ($this->reqMethod !== 'POST' || $this->reqMethod !== 'PATCH') {
            return '';
        }

        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }

    public function getJSON()
    {
        if ($this->reqMethod !== 'POST') {
            return [];
        }
        if (strcasecmp($this->contentType, 'application/json') !== 0) {
            return [];
        }
        // Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));
        // print($content);

        $decoded = json_decode($content, true);
        return $decoded;
    }

    public function getAuth() {
        // print_r($this->requestUrl);
        if ($this->username && $this->password) {
            $user = new User();
            try {
                $user = User::where('email', '=', $this->username)->firstOrFail();
            } catch (Exception $e) {
                return $e->getMessage();
            }
            
            return $user;
        }
        return FALSE;
    }
}
