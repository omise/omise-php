<?php
require_once dirname(__FILE__).'/TestConfig.php';

use Omise\Account;

class AccountTest extends TestConfig
{
    /**
     * @test
     */
    public function retrieve()
    {
        $account = Account::retrieve();

        $this->assertSame('account', $account['object']);
        $this->assertSame('account_test_fixture', $account['id']);
    }

    /**
     * @test
     */
    public function reload()
    {
        $account = OmiseAccount::retrieve();
        $account->reload();

        $this->assertSame('account', $account['object']);
        $this->assertSame('account_test_fixture', $account['id']);
    }
}
