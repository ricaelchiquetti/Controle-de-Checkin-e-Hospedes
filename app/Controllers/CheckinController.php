<?php

namespace App\Controllers;

use App\Models\Checkin;
use App\Models\Services\CheckinModelService;

/**
 * Controller relacionado aos Check-in
 * @package App\Controller
 * @author Ricael V. Chiquetti <ricaelchiquetti28@gmail.com>
 */
class CheckinController extends ControllerBase {

    /**
     * {@inheritDoc}
     * @return CheckinModelService
     */
    public function getModelService(): CheckinModelService {
        return $this->ModelService ??= new CheckinModelService(new Checkin());
    }
}
