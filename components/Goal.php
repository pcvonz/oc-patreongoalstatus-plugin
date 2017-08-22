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
            $this->page['goalPercentage'] =json_encode($pledge['attributes']['completed_percentage']);
            $this->page['patreon_url'] = Settings::get('patreon_url');
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
