<?php

namespace App\Controllers;

use App\Models\Hospede;
use App\Models\Services\HospedeModelService;

/**
 * Controller relacionado aos hóspedes
 * @package App\Controller
 * @author Ricael V. Chiquetti <ricaelchiquetti28@gmail.com>
 */
class HospedeController extends ControllerBase {

    /**
     * {@inheritDoc}
     * @return HospedeModelService
     */
    public function getModelService(): HospedeModelService {
        return $this->ModelService ??= new HospedeModelService(new Hospede());
    }
}
