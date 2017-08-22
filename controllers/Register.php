<?php namespace Paul\Patreon\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use \Patreon\API;
use \Patreon\OAuth;
use Paul\Patreon\Models\Settings;

class Register extends Controller
{
    public $client_id;
    public $client_secret;
    public $redirect_uri;
    public $creator_id;
    public $actual_link;

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Paul.Patreon', 'Patreon');
        $this->client_id = Settings::get('client_id');
        $this->client_secret = Settings::get('api_key');
        $this->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $this->creator_id = 'test';
        $this->actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $this->vars['url'] = '<a href=http://www.patreon.com/oauth2/authorize?response_type=code&client_id='.$this->client_id.'&redirect_uri='.$this->actual_link.' >Click here to connect your patreon</a>';
        $this->vars['accountStatus'] = '<b> not </b>';
    }
    public function index()
    {
    }
    public function onLoad()
    {
      if (isset($_GET['code'])) {
        $oauth_client = new \Patreon\OAuth($this->client_id, $this->client_secret);
        $tokens = $oauth_client->get_tokens($_GET['code'], $this->redirect_uri);
        $access_token = $tokens['access_token'];
        $refresh_token = $tokens['refresh_token'];
        Settings::set('refresh_token', $refresh_token);
        Settings::set('access_token', $access_token);
        
        $register_client = new \Patreon\API(Settings::get('access_token'));
        $patron_response = $register_client->fetch_campaign();
        $patron = $patron_response['data'];
        $string = json_encode($patron);
        $included = $patron_response['included'];
        $goal = null;
        if ($included != null) {
          foreach ($included as $obj) {
            if ($obj["type"] == "goal") {
              $pledge = $obj;
              $amount_cents = $pledge['attributes']['amount_cents'];
              $amount_dollars = $amount_cents / 100;
              $amount_cents = $amount_cents % 100;
              if ($amount_cents < 9) {
                $amount_cents = '0'.$amount_cents;
              }
              Settings::set('amount_cents', '$'.$amount_dollars.'.'.$amount_cents);
              break;
            }
          }
        }
      } 
      if(Settings::get('access_token') != null) {
         $this->vars['accountStatus'] = '';
      }
    }
}
