<?php

namespace Modules\Portal\Http\ViewComposers\Layouts\Subviews;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;


class AlertsComposer extends SuperComposer 
{

    const DANGER = 'danger';
    const WARNING = 'warning';
    const SUCCESS = 'success';
    const SECONDARY = 'secondary';

    private $event_validations;
    private $number_alert;
    private $badge_color;


    public function assign($view)
    {
        $this->eventValidations($view->event_validations);
    }

    public function eventValidations($event_validations)
    {
        $number_alert_pending = 0;
        $number_alert_waring = 0;
        $number_alert_success = 0;

        foreach ($event_validations as $event_validation) {
            switch ($event_validation->porcentage_completed) {
                case 0:
                $event_validation->alert_color = self::SECONDARY;
                $number_alert_pending++;
                break;
                case 100:
                $event_validation->alert_color = self::SUCCESS;
                $number_alert_success++;
                break;    
                default:
                $event_validation->alert_color = self::WARNING;
                $number_alert_waring++;
                break;
            }
        }

        if($number_alert_pending != 0)
        {
            $this->number_alert = $number_alert_pending;
            $this->badge_color = self::DANGER;
        }elseif($number_alert_waring != 0)
        {
            $this->number_alert = $number_alert_waring;
            $this->badge_color = self::WARNING;
        }else 
        {
            $this->number_alert = $number_alert_success;
            $this->badge_color = self::SUCCESS;
        }

        $this->event_validations = $event_validations;
    }

    public function view($view)
    {
        $view->with('event_validations', $this->event_validations);
        $view->with('number_alert', $this->number_alert);
        $view->with('badge_color', $this->badge_color);
    }

}
