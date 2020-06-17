<?php
class services
{
    private $ajax_file_name;
    private $ajax_file_action;
    private $ajax_file_path;
    private $ajax_file_item;
    private $json_data;
    private $url;
    private $user;
    private $error;
    
    public function __construct()
    {
        global $K;        

        $this->error = FALSE;
        $this->json_data = array();
        $this->ajax_file_item = FALSE;
        $this->url = array();
        
        $this->parseUrl();
    
        if (count( $this->url ) < 2) $this->error = TRUE; 
        else {
            $this->ajax_file_name = trim( $this->url[0] );
            $this->ajax_file_action = trim( $this->url[1] );            
            $this->ajax_file_path = $K->INCPATH.'controllers/actionajax/'. $this->ajax_file_name .'.php';
        }

    }

    public function parseUrl()
    {
        $url = substr($_SERVER['REQUEST_URI'], 1);

        $url = explode('/', $url);
            
        $delete = TRUE;
        foreach ($url as $key=>$value) {
            if ($url[$key] == 'services' && $delete) {
                unset($url[$key]);
                $delete = FALSE;
            } elseif ($delete) {
                unset( $url[$key] );
            }
        
            if (!ctype_alnum($value)) {
                unset($url[$key]);
            }
        }

        $this->url = array_values($url);
    }

    private function _isJson($string) 
    {
        return json_decode($string) !== NULL;
    }
    
    private function _parseAjaxResponse( $response )
    {
        if (empty($response) || strlen($response) === 0) return FALSE;
        
        $parsed_response = array();
        
        if (!$this->_isJson($response)) $parsed_response['html'] = $response;
        else {
            $parsed_response = json_decode($response, TRUE);
            if (is_string($parsed_response)) $parsed_response = array();
        }
        
        if (!isset($parsed_response['html'])) $parsed_response['html'] = $response;
        
        return $parsed_response;
    }
    
    public function load()
    {
        if ($this->error) return FALSE;
             
        $ajax_action = $this->ajax_file_action;
        $ajax_item = $this->ajax_file_item;

        ob_start();
        require($this->ajax_file_path);
        $result = ob_get_contents();
        ob_end_clean();
        
        $result = $this->_parseAjaxResponse($result);
        $html_result = $result? $result['html'] : '';

        $this->ajax_data['data'] = array();
        $this->ajax_data['data']['html'] = $html_result;
        $this->ajax_data['data']['status'] = (!empty($html_result) && ($html_result == 'OK' || mb_substr($html_result, 0, 5) != 'ERROR'))? 'OK' : 'ERROR';
        $this->ajax_data['data']['message'] = (!empty($html_result) && mb_substr($html_result, 0, 5) == 'ERROR' )? mb_substr($html_result, 6, mb_strlen($html_result)) : '';
        
        if ($result) {
            foreach ($result as $key => $value) {
                if (!isset($this->ajax_data['data'][$key])) $this->ajax_data['data'][$key] = $value;
            }
        }
        unset($result);

        return json_encode($this->ajax_data);
    }
}
?>