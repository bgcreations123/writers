<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart)
	{
		if ($oldCart) {
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $pages, $details, $id) {
		$storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item, 'pages' => $pages, 'details' => $details];
		if ($this->items) {
			if (array_key_exists($id, $this->items)) {
				$storedItem = $this->items[$id];
			}
		}
		$storedItem['qty'] ++;
		$storedItem['price'] = $item->price * $storedItem['qty'];
		$this->items[$id] = $storedItem;
		$this->totalQty ++;
		$this->totalPrice += $item->price * $pages;
	}

	public function updateItem($qty, $id)
	{
		$workingQty = $qty - $this->items[$id]['qty'];
		$workingTotalPrice = $this->items[$id]['price'] * $this->items[$id]['pages'];

		// dd(abs($itemPrice));

		$this->items[$id]['qty'] += $workingQty;
		$this->totalQty += $workingQty;
		$this->totalPrice += $workingQty * $workingTotalPrice;

		if ($this->items[$id]['qty'] <= 0){
			unset($this->items[$id]);
		}
	}

	public function reduceByOne($id)
	{
		$this->items[$id]['qty'] --;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQty --;
		$this->totalPrice -= $this->items[$id]['item']['price'] * $this->items[$id]['item']['pages'];

		if ($this->items[$id]['qty'] <= 0){
			unset($this->items[$id]);
		}
	}

	public function removeItem($id)
	{
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['pages'];
		unset($this->items[$id]);
	}

	public function updateCart()
	{
		//
	}
}