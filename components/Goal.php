<?php namespace Paul\Patreon\Components;

use Cms\Classes\ComponentBase;
use Paul\Patreon\Models\Settings;

class Goal extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Goal Component',
            'description' => 'No description provided yet...'
        ];
    }
    public function init()
    {
      $this->page['patreon_url'] = Settings::get('patreon_url');
      $register_client = new \Patreon\API(Settings::get('access_token'));
      $campaign_response = $register_client->fetch_campaign();
      
      // Handle access_token expiring:
      if (isset($campaign_response['errors'])) {
          $oauth_client = new \Patreon\OAuth(Settings::get('client_id'), Settings::get('api_key'));
          // Get a fresher access token
          $tokens = $oauth_client->refresh_token(Settings::get('refresh_token'), null);
          // echo Settings::get('refresh_token').'</br>';
          if (isset($tokens['access_token'])) {
              // Set new token
              $access_token = $tokens['access_token'];
              Settings::set('refresh_token', $tokens['refresh_token']);
              Settings::set('access_token', $access_token);
          } else {
              // print_r($tokens);
              $this->addCss('/plugins/paul/patreon/assets/css/error.css');
              return;
          }
      }
      $campaign = $campaign_response['data'];
      $included = $campaign_response['included'];
      $goal = null;
      if ($included != null) {
        foreach ($included as $obj) {
          if ($obj["type"] == "goal") {
            $pledge = $obj;
            $this->page['goalPercentage'] =json_encode($pledge['attributes']['completed_percentage']);
            $this->page['amount_cents'] = Settings::get('amount_cents');
            break;
          }
        }
      }
    }
    public function onRun()
    {
      $this->addCss('/plugins/paul/patreon/assets/css/goal.css');
      $this->addJs('/plugins/paul/patreon/assets/js/goal.js');
    }
    public function defineProperties()
    {
        return [];
    }
}
