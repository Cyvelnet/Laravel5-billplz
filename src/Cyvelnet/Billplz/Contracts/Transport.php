<?php namespace Cyvelnet\Billplz\Contracts;

use Cyvelnet\Billplz\BillBody;

/**
 * Interface Transport
 * @package Cyvelnet\Billplz\Contracts
 */
interface Transport
{
    /**
     * create a bill
     * @param $body
     * @return mixed
     */
    public function sendCreateBillRequest(BillBody $body);

    /**
     * get a bill
     * @param $billId
     * @return mixed
     */
    public function sendGetBillRequest($billId);

    /**
     * delete a bill
     * @param $billId
     * @return mixed
     */
    public function sendDeleteBillRequest($billId);
}
