<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Repositories\Customer\ICustomerRepository;
use App\Services\Customer\CustomerServices;
use PHPUnit\Framework\TestCase;

class CustomerServiceTest extends TestCase
{
    private $_customerRepositoryMock;

    public static function setUpBeforeClass(): void
    {

    }

    protected function setUp(): void
    {
        $this->_customerRepositoryMock = $this->createMock(ICustomerRepository::class);
    }

    protected function tearDown(): void
    {

    }

    public static function tearDownAfterClass(): void
    {

    }

    public function test_getCustomers_ifAnyCustomerExists_returnsAllCustomers(){
        //arrange
        $customers = collect([new Customer(), new Customer()]);
        $this->_customerRepositoryMock
            ->method('all')
            ->willReturn($customers);

        //act & assert
        $customerService = new CustomerServices($this->_customerRepositoryMock);
        $this->assertCount(2,$customerService->getCustomers());
    }

    public function test_getCustomerById_ifAnyCustomerExists_returnTheCustomer() {
        //arrange
        $id = "1";
        $modelMock = $this->createMock(Customer::class);
        $this->_customerRepositoryMock
            ->expects($this->once())
            ->method('getById')
            ->with($id)
            ->willReturn($modelMock);

        //act & assert
        $customerService = new CustomerServices($this->_customerRepositoryMock);
        $customerService->getCustomerById($id);
    }
}
