<?php

namespace Cyvelnet\Billplz;

use Closure;
use Cyvelnet\Billplz\Transporters\Transport;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Monolog\Logger;

/**
 * Class Billplz
 * @package Cyvelnet\Billplz
 */
class Billplz
{

    /**
     *
     */
    const CREATE_BILL_URL = 'https://www.billplz.com/api/v2/bills';

    /**
     *
     */
    const GET_BILL_URL = 'https://www.billplz.com/api/v2/bills';

    /**
     *
     */
    const DELETE_BILL_URL = 'https://www.billplz.com/api/v2/bills';

    /**
     * @var Transport
     */
    private $transport;
    /**
     * @var Bill
     */
    private $bill;

    /**
     * @param Transport $transport
     * @param BillBody $bill
     */
    function __construct(Transport $transport, BillBody $bill)
    {
        $this->transport = $transport;
        $this->bill = $bill;
    }


    /**
     * issue a bill to customer
     * @param $callback
     * @return \Cyvelnet\Billplz\Transporters\TransportResponse
     */

    public function issue($callback)
    {
        if (!$callback instanceof Closure) {
            throw new InvalidArgumentException('Callback is not valid.');
        }

        call_user_func($callback, $this->bill);

        return $this->transport->sendCreateBillRequest($this->bill);

    }

    /**
     * get a bill information
     * @param $billId
     * @return \Cyvelnet\Billplz\Transporters\TransportResponse
     */
    public function get($billId)
    {
        return $this->transport->sendGetBillRequest($billId);
    }

    /**
     * delete an existing bill
     * @param $billId
     * @return \Cyvelnet\Billplz\Transporters\TransportResponse
     */
    public function delete($billId)
    {
        return $this->transport->sendDeleteBillRequest($billId);
    }
}
