<?php namespace Paul\Patreon\Components;

use Cms\Classes\ComponentBase;
use Paul\Patreon\Models\Settings;

class Goal extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Goal Component',
            'description' => "Adds a small widget that displays the percentage complete of a patreon campaign."
        ];
    }
    private function patreonRequest()
    {
        $register_client = new \Patreon\API(Settings::get('access_token'));
        $campaign_response = $register_client->fetch_campaign();

        // Handle access_token expiring:
        if (isset($campaign_response['errors'])) {
            $oauth_client = new \Patreon\OAuth(Settings::get('client_id'), Settings::get('client_secret'));
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
                return false;
            }
        }
        $campaign = $campaign_response['data'];
        $included = $campaign_response['included'];
        $goal = null;
        if ($included != null) {
            foreach ($included as $obj) {
                if ($obj["type"] == "goal") {
                    $pledge = $obj;
                    Settings::set('completed_percentage', $pledge['attributes']['completed_percentage']).'343';
                    Settings::set('time_since_last_update', time());
                    break;
                }
            }
        }
    }
    public function init()
    {
        $this->page['patreon_url'] = Settings::get('patreon_url');
        $refresh_time = Settings::get('refresh_time');
        // Make sure refresh time is never 0
        if ( $refresh_time == '' || $refresh_time < 5) {
            $refresh_time = 5;
        }
        if ((Settings::get('time_since_last_update') + $refresh_time * 60) < time()) {
            $this->patreonRequest();
        }
        $this->page['amount_cents'] = Settings::get('amount_cents');
        $this->page['goalPercentage'] = Settings::get('completed_percentage');
    }
    public function onRun()
    {
        $this->addCss('/plugins/paul/patreon/assets/css/goal.css');
        $this->addJs('/plugins/paul/patreon/bower_components/tween.js/src/Tween.js');
        $this->addJs('/plugins/paul/patreon/assets/js/goal.js');
    }
    public function defineProperties()
    {
        return [];
    }
}
