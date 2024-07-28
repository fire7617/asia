<?php
namespace App\Contracts;

interface OrderInterface
{
	/*訂單格式檢查*/
	public function checkFormat($order);
	/*訂單格式轉換*/
	public function transFormat($order);
}
