<?php

namespace Kinedu\PaymentGateways\SrPago;

use Exception;
use Kinedu\PaymentGateways\ApiResource;
use SrPago\OxxoPayment as SrPagoOxxoPayment;
use SrPago\Error\SrPagoError;

class OxxoPayment extends ApiResource
{
    /**
     * Generate a new reference for an Oxxo payment.
     *
     * @param  int  $amount
     * @param  string  $description
     * @return array
     */
    public function charge(int $amount, string $description)
    {
        try {
            $payload = [
                'description' => $description,
                'amount' => $amount,
            ];

            return SrPagoOxxoPayment::create($payload);
        } catch (SrPagoError $e) {
            throw new Exception($e->getError()['message']);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
